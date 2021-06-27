<?php

namespace App\Controller;

use App\Entity\Crypto;
use App\Form\CryptoType;
use App\Service\ApiService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CryptoController extends AbstractController
{
    /**
     * @Route("/add/crypto", name="add-crypto")
     */
    public function addCrypto(Request $request, ApiService $apiService)
    {
        //try{
        $crypto = new Crypto();
        $form = $this->createForm(CryptoType::class, $crypto );
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            //$crypto->setDate((new \DateTime()));
            $cryptoToAdd = $form['name']->getData();
            $bla = $apiService->getCrypto($cryptoToAdd['id']);
          //  $crypto->setAcronym($bla.);
          //  $crypto->setImage();




            dump($bla);die();
            $em = $this->getDoctrine()->getManager();
            $em->persist($crypto);
            $em->flush();
            $this->addFlash('success','Transaction added');
            return $this->redirectToRoute('home');
        }
        // }catch (\Exception $e){
        //$this->addFlash('error','Problem with this transaction, retry later');
        //return $this->redirectToRoute("add-crypto");
        //}
        return $this->render('main/addCrypto.html.twig',[
            'form' => $form->createView()
        ]);
    }

}
