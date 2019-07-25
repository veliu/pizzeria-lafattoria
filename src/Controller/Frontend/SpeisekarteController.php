<?php

namespace App\Controller\Frontend;

use App\Entity\DishGroup;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SpeisekarteController extends AbstractController
{
    /**
     * @Route("/speisekarte", name="speisekarte")
     */
    public function index()
    {
        $dishGroups = $this->getDoctrine()->getRepository(DishGroup::class)->getDishGroups(true);

        return $this->render('frontend/speisekarte/index.html.twig', [
            'title' => " | Speisekarte",
            'dishGroups' => $dishGroups
        ]);
    }
}
