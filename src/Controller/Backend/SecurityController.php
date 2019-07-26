<?php

namespace App\Controller\Backend;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends BaseController
{
    /**
     * @Route("/login", name="login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        $this->preDispatch();

        // if ($this->getUser()) {
        //    $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $this->templateVars["errorMessage"] = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $this->templateVars["lastUsername"] = $authenticationUtils->getLastUsername();

        $this->templateVars["title"] = 'Login';
        $this->templateVars["navbarEnabled"] = false;

        return $this->render('backend/security/login.html.twig', $this->templateVars);
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logout()
    {
        $this->preDispatch();

        throw new \Exception('This method can be blank - it will be intercepted by the logout key on your firewall');
    }
}
