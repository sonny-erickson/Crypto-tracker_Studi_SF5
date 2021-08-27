<?php

namespace App\Controller;

use App\Entity\Transaction;
use App\Form\TransactionType;
use App\Form\RmTransactionType;
use App\Repository\TransactionRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TransactionController extends AbstractController
{
    /**
     * @Route("/add/transaction", name="add-transaction")
     */
    public function addTransaction(Request $request)
    {
        try {
            $transaction = new Transaction();
            $form = $this->createForm(TransactionType::class, $transaction );
            $form->handleRequest($request);
            if($form->isSubmitted() && $form->isValid()) {
                $transaction->setDate((new \DateTime()));
                $em = $this->getDoctrine()->getManager();
                $em->persist($transaction);
                $em->flush();
                $this->addFlash('success','Transaction ajouté');
                return $this->redirectToRoute('home');
            }
         }catch (\Exception $e){
             $this->addFlash('error','Problème avec l\'ajout d\'une transaction, recommencer ultérieurement');
             return $this->redirectToRoute("add-crypto");
             }
        return $this->render('main/addTransaction.html.twig',[
            'form' => $form->createView()
        ]);
    }
    
    /**
     * @Route("/remove/transaction", name="remove-transaction")
     */
    public function removeTransaction(TransactionRepository $transactionRepository, Request $request)
    {
        try {
            $form = $this->createForm(RmTransactionType::class);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $transaction = $form->getData('transaction');
                $trans = $transaction['transaction'];
                $idToRemove = $trans->getId('id');
                $idToRemoveRepo = $transactionRepository->findOneBy(['id' => $idToRemove]);
                $em = $this->getDoctrine()->getManager();
                $em->remove($idToRemoveRepo);
                $em->flush();
                $this->addFlash('success', 'Transaction supprimé');
                return $this->redirectToRoute('home');
            }

        }catch (\Exception $e){
        $this->addFlash('error',"Problème avec l'ajout d'une transaction, recommencer ultérieurement");
        return $this->redirectToRoute("add-crypto");
        }
        return $this->render('main/removeTransaction.html.twig',[
            'form' => $form->createView()
        ]);
    }
}
