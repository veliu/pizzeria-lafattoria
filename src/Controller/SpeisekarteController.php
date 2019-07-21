<?php

namespace App\Controller;

use App\Entity\Dish;
use App\Entity\DishGroup;
use App\Repository\DishRepository;
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

        return $this->render('speisekarte/index.html.twig', [
            'dishGroups' => $dishGroups
        ]);
    }
}
