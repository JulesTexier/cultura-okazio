<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request; // Importation de la classe Request
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Repository\UserRepository;
use App\Form\UserType;
use Symfony\Component\Validator\Constraints as Assert;



class UserController extends AbstractController
{
    #[Route('/', name: 'home')]

    public function index(Request $request):Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) { 
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            echo '<script>alert("Adresse enregistrée. Merci et à bientôt ")</script>';
            return $this->redirectToRoute('home');            
        }
        return $this->render('user/index.html.twig', [
            'form' => $form->createView()
        ]);
        }

}
