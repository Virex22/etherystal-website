<?php

namespace App\Controller;

use App\Entity\Etherystal;
use App\Form\EtherystalType;
use App\Repository\EtherystalRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ethadmin/etherystal")
 */
class EtherystalController extends AbstractController
{
    /**
     * @Route("/", name="etherystal_index", methods={"GET"})
     */
    public function index(EtherystalRepository $etherystalRepository): Response
    {
        return $this->render('etherystal/index.html.twig', [
            'etherystals' => $etherystalRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="etherystal_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $etherystal = new Etherystal();
        $etherystal->setView(0);
        $form = $this->createForm(EtherystalType::class, $etherystal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($etherystal);
            $entityManager->flush();

            return $this->redirectToRoute('etherystal_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('etherystal/new.html.twig', [
            'etherystal' => $etherystal,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="etherystal_show", methods={"GET"})
     */
    public function show(Etherystal $etherystal): Response
    {
        return $this->render('etherystal/show.html.twig', [
            'etherystal' => $etherystal,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="etherystal_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Etherystal $etherystal, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(EtherystalType::class, $etherystal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('etherystal_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('etherystal/edit.html.twig', [
            'etherystal' => $etherystal,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="etherystal_delete", methods={"POST"})
     */
    public function delete(Request $request, Etherystal $etherystal, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$etherystal->getId(), $request->request->get('_token'))) {
            $entityManager->remove($etherystal);
            $entityManager->flush();
        }

        return $this->redirectToRoute('etherystal_index', [], Response::HTTP_SEE_OTHER);
    }
}