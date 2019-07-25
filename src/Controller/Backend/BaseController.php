<?php


namespace App\Controller\Backend;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

abstract class BaseController extends AbstractController
{
    protected $templateVars;

    protected function preDispatch()
    {
        $this->templateVars["successMessage"] = NULL;
        $this->templateVars["errorMessage"] = NULL;
        $this->templateVars["title"] = '';
        $this->templateVars["navbarEnabled"] = true;
    }
}