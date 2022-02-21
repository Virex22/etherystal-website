<?php

namespace App\Controller;

use App\Entity\Rarety;
use App\Form\RaretyType;
use App\Repository\RaretyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ethadmin/rarety")
 */
class RaretyController extends AbstractController
{
    /**
     * @Route("/", name="rarety_index", methods={"GET"})
     */
    public function index(RaretyRepository $raretyRepository): Response
    {
        return $this->render('rarety/index.html.twig', [
            'rareties' => $raretyRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="rarety_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $rarety = new Rarety();
        $form = $this->createForm(RaretyType::class, $rarety);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($rarety);
            $entityManager->flush();

            return $this->redirectToRoute('rarety_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('rarety/new.html.twig', [
            'rarety' => $rarety,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="rarety_show", methods={"GET"})
     */
    public function show(Rarety $rarety): Response
    {
        return $this->render('rarety/show.html.twig', [
            'rarety' => $rarety,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="rarety_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Rarety $rarety, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(RaretyType::class, $rarety);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('rarety_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('rarety/edit.html.twig', [
            'rarety' => $rarety,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="rarety_delete", methods={"POST"})
     */
    public function delete(Request $request, Rarety $rarety, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $rarety->getId(), $request->request->get('_token'))) {
            $entityManager->remove($rarety);
            $entityManager->flush();
        }

        return $this->redirectToRoute('rarety_index', [], Response::HTTP_SEE_OTHER);
    }
}
