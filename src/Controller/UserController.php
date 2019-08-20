<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\InscriptionType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends AbstractController
{
    /**
     * @Route("/user", name="user")
     */
    public function index(Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder)
    {
        $nUser=new User();

        $form=$this->createForm(InscriptionType::class, $nUser);
        $form->handleRequest($request);

        //Traitement du formulaire de création de topic
        if ($form->isSubmitted() && $form->isValid())
        {
            $hash=$encoder->encodePassword($nUser, $nUser->getPassword());
            $nUser->setPassword($hash);

            $manager->persist($nUser);
            $manager->flush();

            return $this->render('accueil/index.html.twig', [
                'message'=>'Vous êtes désormais inscrit. Bon jeu à vous et merci.'
            ]);
        }

        return $this->render('user/index.html.twig', [
            'formInscription'=>$form->createView()
        ]);
    }

    /**
     * @Route("/connexion", name="connexion")
     */
    public function connexion()
    {
        return $this->redirectToRoute('accueil');
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logout(){}

    /**
     * @Route("/deconnexion", name="deconnexion")
     */
    public function deconnexion()
    {
        return $this->render('accueil/index.html.twig', [
            'message'=>'Vous êtes bien déconnecté.'
        ]);
    }
}
