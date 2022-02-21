<?php

namespace App\Controller;

use App\Entity\Material;
use App\Form\SearchType;
use App\Repository\MaterialRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MaterialController extends AbstractController
{

    /**
     * @Route("/material/{materialID}", name="material_view")
     */
    public function item_View(Material $material, materialRepository $materialRepository): Response
    {
        return $this->render('material/view.html.twig', [
            'material' => $material,
            'allMaterials' => $materialRepository->findBy([], ["materialID" => "DESC"])
        ]);
    }
}
