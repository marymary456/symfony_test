<?php

namespace App\Controller\User;

use App\Form\User\LoginType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SignInController extends Controller
{
    /**
     * @Route("/signin", name="sign_in")
     */
    public function loginAction(Request $request, AuthenticationUtils $authUtils)
    {

        $form = $this->createForm(LoginType::class, array(
            'action' => $this->generateUrl('sign_in'),
            'method' => 'POST',
        ));
        $form->handleRequest($request);

        $error = $authUtils->getLastAuthenticationError();
        $lastUsername = $authUtils->getLastUsername();
        return $this->render('sign_in/index.html.twig', array(
            'form' => $form->createView(),
            'last_username' => $lastUsername,
            'error'         => $error,
        ));
    }
}
