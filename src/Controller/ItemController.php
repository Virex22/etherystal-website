<?php

namespace App\Controller;

use App\Entity\Etherystal;
use App\Form\SearchType;
use App\Repository\ColorRepository;
use App\Repository\EtherystalRepository;
use App\Repository\MaterialRepository;
use DateTime;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use function PHPUnit\Framework\isNull;

class ItemController extends AbstractController
{
    /**
     * @Route("/item", name="item")
     */
    public function item(Request $request, EtherystalRepository $etherystalRepository, ColorRepository $colorRepository, MaterialRepository $materialRepository): Response
    {
        $form = $this->createForm(SearchType::class);

        $form->handleRequest($request);

        $mostResearchedEtherystal = $etherystalRepository->findBy([], ['view' => 'DESC'], 10);

        $searchType = [
            "itemID",
            "material",
            "color"
        ];

        if ($form->isSubmitted() && $form->isValid()) {
            $filter = $searchType[$request->get("choice")];
            if ($request->get("choice") == 0)
                $value = $form->get("search")->getData();
            else if ($request->get("choice") == 1)
                $value = $materialRepository->findOneBy(['materialID' => $form->get("search")->getData()]);
            else if ($request->get("choice") == 2)
                $value = $colorRepository->findOneBy(['colorID' => $form->get("search")->getData()]);

            $etherystalResults = $etherystalRepository->findBy([$filter => $value]);
            return $this->render('item/index.html.twig', [
                'form' => $form->createView(),
                'results' => $etherystalResults,
                'searched' =>  true,
                'mostResearchedEtherystal' => $mostResearchedEtherystal
            ]);
        }

        return $this->render('item/index.html.twig', [
            'form' => $form->createView(),
            'results' => null,
            'searched' =>  false,
            'mostResearchedEtherystal' => $mostResearchedEtherystal
        ]);
    }

    /**
     * @Route("/item/{itemID}", name="item_view")
     */
    public function item_View(Etherystal $etherystal, EtherystalRepository $etherystalRepository, EntityManagerInterface $entityManager): Response
    {
        //find same item
        $sameColorEtherystal = $etherystalRepository->findBy(["color" => $etherystal->getColor()]);
        $sameMaterialEtherystal = $etherystalRepository->findBy(["material" =>  $etherystal->getMaterial()]);

        unset($sameColorEtherystal[array_search($etherystal, $sameColorEtherystal)]);
        shuffle($sameColorEtherystal);
        array_slice($sameColorEtherystal, 0, 10);

        unset($sameMaterialEtherystal[array_search($etherystal, $sameMaterialEtherystal)]);
        shuffle($sameMaterialEtherystal);
        array_slice($sameMaterialEtherystal, 0, 10);

        // set item view
        if ($etherystal->getLastTimeViewed()) {
            if ($etherystal->getLastTimeViewed()->diff(new DateTime())->h >= 1) {
                $etherystal->setView($etherystal->getView() + 1);
                $etherystal->setLastTimeViewed(new DateTime());
            }
        } else {
            $etherystal->setView($etherystal->getView() + 1);
            $etherystal->setLastTimeViewed(new DateTime());
        }
        $entityManager->persist($etherystal);
        $entityManager->flush($etherystal);

        return $this->render('item/view.html.twig', [
            'etherystal' => $etherystal,
            'properties' => json_decode($etherystal->getProperty(), true),
            'sameColor' => $sameColorEtherystal,
            'sameMaterial' => $sameMaterialEtherystal,
        ]);
    }
}
