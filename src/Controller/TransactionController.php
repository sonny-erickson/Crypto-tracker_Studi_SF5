<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TransactionController extends AbstractController
{
    /**
     * @Route("/add", name="add-crypto")
     */
    public function add()
    {
        return $this->render('main/addTransaction.html.twig');
    }
    
    /**
     * @Route("/remove", name="remove-crypto")
     */
    public function remove()
    {
        return $this->render('main/removeTransaction.html.twig');
    }
}
