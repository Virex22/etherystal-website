<?php

namespace App\Controller;

use App\Form\ContactType;
use App\Service\MailService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(Request $request,MailService $mailService): Response
    {
        $form = $this->createForm(ContactType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $mailService->sendMail($form->get("email")->getData(),$form->get("message")->getData(),"Contact etherystal");
        }

        return $this->render('home/home.html.twig', [
            'controller_name' => 'HomeController',
            'form' => $form->createView()
        ]);
    }
}