<?php

namespace App\Controller;

use App\Entity\DishGroup;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class LpController extends AbstractController
{
    /**
     * @Route("/impressum", name="impressum")
     */
    public function impressum()
    {
        $dishGroups = $this->getDoctrine()->getRepository(DishGroup::class)->getDishGroups(true);

        return $this->render('landingpages/impressum.html.twig', [
            "dishGroups" => $dishGroups,
            "title" => " | Impressum"
        ]);
    }

    /**
     * @Route("/datenschutz", name="datenschutz")
     */
    public function datenschutz()
    {
        $dishGroups = $this->getDoctrine()->getRepository(DishGroup::class)->getDishGroups(true);

        return $this->render('landingpages/datenschutz.html.twig', [
            "dishGroups" => $dishGroups,
            "title" => " | Datenschutz"
        ]);
    }
}
