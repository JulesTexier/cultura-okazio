<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request; // Importation de la classe Request
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class UserController extends AbstractController
{
    #[Route('/', name: 'home')]

    public function addUser(Request $request, ManagerRegistry $doctrine)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) { 
            $em = $doctrine->getManager();
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute('thanks');            
        }
        return $this->render('user/adduser.html.twig', [
            'form' => $form->createView()
        ]);
        }



    #[Route('/thanks', name: 'thanks')]

    public function index()
    {
        return $this->render('user/thanks.html.twig', [
        ]);
        }

}
