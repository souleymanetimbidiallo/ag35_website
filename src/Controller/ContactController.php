<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index(): Response
    {
        return $this->render('contact.html.twig');
    }

    /**
     * @Route("/send-contact", name="send-contact")
     */
    public function sendMessage(): Response
    {
        return $this->render('contact.html.twig');
    }
}
