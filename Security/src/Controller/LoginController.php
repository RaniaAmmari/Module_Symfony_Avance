<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Form\LoginType;
use App\Entity\User;


class LoginController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */

    public function loginForm (Request $request): Response
    {
        $user = new User;
        $form = $this->createForm(LoginType::class,$user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
  
            $form = $form->getData();
            $this->addFlash('success', 'Informations Créer!');
            return $this->redirectToRoute('app_login');
        }   
                
        return $this->render('Logger/login.html.twig', [
            'form' => $form-> createView() ]);
       
 }
 }