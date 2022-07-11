<?php

namespace App\Controller;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;
use App\Form\ResgisterType;
use App\Repository\UserRepository;

class LoginController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        return $this->render('login/home.html.twig', [
            'controller_name' => 'LoginController',
        ]);
    }

        /**
     * @Route("/Register", name="Regsiter")
     */
    public function SignUp(Request $request, ManagerRegistry $doctrine, UserPasswordEncoderInterface $userPasswordEncoder): Response
     {
        $User = new User();
    $form = $this->createForm(ResgisterType::class, $User);
    $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $User->setRoles(['ROLE_USER']);
            $entityManager = $doctrine->getManager();
            $User->setPassword(
                $userPasswordEncoder->encodePassword(
                        $User,
                        $form->get('Password')->getData()
                    )
                );       
            $entityManager->persist($User);
            $entityManager->flush();  
            $this->addFlash('success', 'Created! ');
            return $this->redirectToRoute('app_login');
        }
    return $this->render('login/signup.html.twig', [
        'form' => $form->createView(),
        'Email' => $User,

    ]);
    }
/**
 * @Route("/utilisateurs", name="utilisateurs")
 */
public function usersList(UserRepository $users)
{
    return $this->render('admin/users.html.twig', [
        'users' => $users->findAll(),
    ]);
}
    
//         /**
//      * @Route("/connect", name="connect")
//      */
//     public function SignIn(): Response
//      {
//     return $this->render('login/signin.html.twig');
//     }
 }
