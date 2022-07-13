<?php

namespace App\Controller;

use App\Entity\User;
use Omines\DataTablesBundle\DataTableFactory;
use Symfony\Component\HttpFoundation\Request;
use Omines\DataTablesBundle\Column\TextColumn;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Omines\DataTablesBundle\Adapter\ArrayAdapter;
use Omines\DataTablesBundle\Adapter\Doctrine\ORMAdapter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProfileController extends AbstractController
{
    
    /**
     * @Route("/admin", name="admin")
     */
    public function adminProfil( Request $request, DataTableFactory $dataTableFactory )
    
    { 
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $repos=$this->getDoctrine()->getRepository(User::class);
        $users=$repos->findAll();


        $table = $dataTableFactory->create()
        ->add('userName', TextColumn::class)
        ->add('Email', TextColumn::class)
        ->createAdapter(ORMAdapter::class, [
            'entity' => User::class,
        ])
        ->handleRequest($request);

    if ($table->isCallback()) {
        return $table->getResponse();
    }
      
        return $this->render('profile/admin.html.twig', ['datatable' => $table]);
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
