<?php

namespace App\Controller\Backend;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends BaseController
{
    /**
     * @Route("/backend", name="backend_dashboard")
     */
    public function index()
    {
        $this->preDispatch();

        $this->templateVars["title"] = 'Backend Dashboard';

        return $this->render('backend/dashboard/index.html.twig', $this->templateVars);
    }
}
