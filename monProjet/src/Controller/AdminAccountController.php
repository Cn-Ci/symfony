<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class AdminAccountController extends AbstractController
{
    /**
     * Permet de se connecter
     * 
     * @Route("/admin/login", name="admin_account_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        
        return $this->render('admin/account/login.html.twig', [
            'username' => $lastUsername, 
            'error' => $error
        ]);
    }

    /**
     * Permet de se deconnecter
     * 
     * @Route("/admin/logout", name="admin_account_logout")
     * @return void
     */
    public function logout() {
        // .. rien !
    }

    
}
