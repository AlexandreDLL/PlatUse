<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TelechargerController extends AbstractController
{
    /**
     * @Route("/telecharger", name="telecharger")
     */
    public function index()
    {
        return $this->render('telecharger/telecharger.html.twig');
    }
}
