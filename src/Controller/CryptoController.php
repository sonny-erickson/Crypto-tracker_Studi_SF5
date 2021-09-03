<?php

namespace App\Controller;

use App\Entity\Crypto;
use App\Form\CryptoType;
use App\Repository\CryptoRepository;
use App\Service\ApiService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CryptoController extends AbstractController
{
    /**
     * @Route("/add/crypto", name="add-crypto")
     */
    public function addCrypto(Request $request,ApiService $apiService, CryptoRepository $cryptoRepository)
    {
        try{
        $crypto = new Crypto();
        $form = $this->createForm(CryptoType::class, $crypto );
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $cryptoToAdd = $form['name']->getData();
            if($cryptoRepository->findOneBy(["name" => $cryptoToAdd])){
                $this->addFlash('error','Crypto existe déjà');
                return $this->redirectToRoute("add-crypto");
            }
            $callApi = $apiService->getCrypto($cryptoToAdd);
            $getImage = $callApi["image"];
            $getImageSmall = $getImage["small"];
            $crypto->setName($callApi["name"]);
            $crypto->setAcronym($callApi["symbol"]);
            $crypto->setImage($getImageSmall);
            $em = $this->getDoctrine()->getManager();
            $em->persist($crypto);
            $em->flush();
            $this->addFlash('success','Crypto added');
            return $this->redirectToRoute('home');
        }
        }catch (\Exception $e){
        $this->addFlash('error','Retry with lowercase, or retry later');
        return $this->redirectToRoute("add-crypto");
        }
        return $this->render('main/addCrypto.html.twig',[
            'form' => $form->createView()
        ]);
    }

}
