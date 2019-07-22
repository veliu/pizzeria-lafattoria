<?php

namespace App\Controller;

use App\Entity\DishGroup;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends BaseController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        $dishGroups = $this->getDoctrine()->getRepository(DishGroup::class)->getDishGroups(true);

        return $this->render('home/index.html.twig', [
            'title' => "",
            'dishGroups' => $dishGroups,
        ]);
    }
}
