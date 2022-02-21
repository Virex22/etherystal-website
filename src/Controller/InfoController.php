<?php

namespace App\Controller;

use App\Entity\Color;
use App\Entity\Rarety;
use App\Form\NegotiationType;
use App\Repository\ColorRepository;
use App\Repository\RaretyRepository;
use App\Service\MailService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InfoController extends AbstractController
{
    /**
     * @Route("/info", name="info")
     */
    public function index(): Response
    {
        return $this->render('info/index.html.twig', [
            'controller_name' => 'InfoController',
        ]);
    }

    /**
     * @Route("/mention-legal", name="mention_legal")
     */
    public function mentionLegal(): Response
    {
        return $this->render('info/mention_legal.html.twig', [
            'controller_name' => 'InfoController',
        ]);
    }
    /**
     * @Route("/color/{colorID}", name="color_view")
     */
    public function color_View(Color $color, ColorRepository $colorRepository): Response
    {
        return $this->render('color/view.html.twig', [
            'color' => $color,
            'allColor' => $colorRepository->findBy([], ["colorID" => "DESC"])
        ]);
    }
    /**
     * @Route("/rarety/{name}", name="rarety_view")
     */
    public function rarity_View(Rarety $color, RaretyRepository $raretyRepository): Response
    {
        return $this->render('rarety/view.html.twig', [
            'rarety' => $color,
            'allRarety' => $raretyRepository->findAll()
        ]);
    }
    /**
     * @Route("/price_negotiation", name="price_negotiation")
     */
    public function price_negotiation(Request $request, MailService $mailService): Response
    {
        $form = $this->createForm(NegotiationType::class);
        $form->handleRequest($request);
        
        $typeOfRequest = [
            'Bundle',
            'lower or free for advertising',
            'other'
        ];
        if ($form->isSubmitted() && $form->isValid()) {
            $mailService->sendMail($form->get("email")->getData(),$form->get("message")->getData(),"Etherystal negociation : " . $typeOfRequest[$form->get("typeOfRequest")->getData()]);
            return $this->redirectToRoute('home');
        }


        return $this->render('price_negotiation/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}