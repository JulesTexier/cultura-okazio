<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Repository\UserRepository;
use App\Form\UserType;


class UserController extends AbstractController
{
    #[Route('/', name: 'home')]

    public function index():Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        return $this->render('user/index.html.twig', [
            'form' => $form->createView()
        ]);
        }
}
