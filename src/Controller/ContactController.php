<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Service\ParameterService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use App\Repository\ServiceRepository;

class ContactController extends AbstractController
{


    /**
     * @Route("/contact", name="app_contact")
     */
    public function index(
        ParameterService $parameterService,
        Request $request,
        EntityManagerInterface $manager,
        MailerInterface $mailer,
        ServiceRepository $serviceRepository
    ): Response {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, null, [
            'service_repository' => $serviceRepository,
        ]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $contact = $form->getData();
            $manager->persist($contact);
            $manager->flush();

            //Sending Mail with Mailer Bundle
            $email = (new Email())
                ->from($contact->getEmail())
                ->to('admin@ag35.com')
                ->subject($contact->getTitre())
                ->html($contact->getMessage());

            $mailer->send($email);

            $this->addFlash(
                'success',
                'Votre demande a été envoyé avec succès ! Nous reviendrons vers vous dans les plus bref délais.'
            );

            return $this->redirectToRoute('app_contact');
        }

        $parametres = [
            'site_name' => $parameterService->getSiteName(),
            'site_logo' => $parameterService->getSiteLogo(),
            'address' => $parameterService->getSiteAdresse(),
            'email' => $parameterService->getSiteEmail(),
            'telephone' => $parameterService->getSiteTelephone(),
            'lien_page_fb' => $parameterService->getLienPageFb(),
            'lien_groupe_fb' => $parameterService->getLienGroupeFb(),
            'lien_whatsApp' => $parameterService->getLienWhatsApp()
        ];
        $choices = $serviceRepository->findAllTitres();
        //dd($choices);
        return $this->render('contact.html.twig', [
            'current_menu' => 'contact',
            'parametres'   => $parametres,
            'form' => $form->createView(),
            'choices' => $choices,
        ]);
    }

    /**
     * @Route("/send-contact", name="send-contact")
     */
    public function sendMessage(): Response
    {
        return $this->render('contact.html.twig');
    }
}
