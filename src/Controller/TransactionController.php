<?php

namespace App\Controller;

use App\Entity\Transaction;
use App\Form\TransactionType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TransactionController extends AbstractController
{
    /**
     * @Route("/add", name="add-crypto")
     */
    public function add(Request $request)
    {
        //try{
        $transaction = new Transaction();
        $form = $this->createForm(TransactionType::class, $transaction );
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $transaction->setDate((new \DateTime()));
            $em = $this->getDoctrine()->getManager();
            $em->persist($transaction);
            $em->flush();
            $this->addFlash('success','Transaction added');
            return $this->redirectToRoute('home');
        }
       // }catch (\Exception $e){
        //$this->addFlash('error','Problem with this transaction, retry later');
        //return $this->redirectToRoute("add-crypto");
        //}
        return $this->render('main/addTransaction.html.twig',[
            'form' => $form->createView()
        ]);
    }
    
    /**
     * @Route("/remove", name="remove-crypto")
     */
    public function remove()
    {
        return $this->render('main/removeTransaction.html.twig');
    }
}
