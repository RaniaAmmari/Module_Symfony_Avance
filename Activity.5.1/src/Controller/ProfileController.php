<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;

class ProfileController extends AbstractController
{
    

    /**
     * @Route("/index", name="profile")
     */
    public function Profil(): Response
    {  $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        return $this->render('profile/index.html.twig', [
            'controller_name' => 'ProfileController',
        ]);
    }
    /**
     * @Route("/admin", name="admin")
     */
    public function adminProfil(): Response
    
    { 
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $repos=$this->getDoctrine()->getRepository(User::class);
        $users=$repos->findAll();
      
        return $this->render('profile/admin.html.twig', [
            'controller_name' => 'ProfileController',
            'users'=>$users
        ]);
    }
 /**
     * @Route("/user", name="user")
     */
    public function user(): Response
    
    { 
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
      
        return $this->render('profile/user.html.twig', [
            'controller_name' => 'ProfileController',
         
        ]);
    }
   /**
 * @Route("/access-denied", name="app_access_denied")
 */
public function accessDenied()
{
    if ( $this->getUser() ) {
        return $this->redirectToRoute('profile');
    }

    return $this->redirectToRoute('app_login');
}   
}
