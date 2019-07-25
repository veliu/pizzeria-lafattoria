<?php

namespace App\Controller\Backend;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function index()
    {
        return $this->render('backend/dashboard/index.html.twig', [
            'title' => 'backend dashboard',
            'controller_name' => 'DashboardController',
        ]);
    }
}
