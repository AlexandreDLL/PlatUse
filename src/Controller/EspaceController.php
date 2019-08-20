<?php

namespace App\Controller;

use App\Form\UpdateUserType;
use App\Repository\UserRepository;
use App\Repository\ScoreRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class EspaceController extends AbstractController
{
    /**
     * @Route("/espace", name="espace")
     */
    public function index(ScoreRepository $repoScore, Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder)
    {
        if ($this->getUser()!=NULL)
        {
            $user=$this->getUser();
            $idUser=$user->getIdUser();
    
            $meillTemps1=$repoScore->findMeilleurTemps($idUser, 1);
            $meillTemps2=$repoScore->findMeilleurTemps($idUser, 2);

            $tempsTotal=$meillTemps1['temps_score']+$meillTemps2['temps_score'];
    
            $scores=$repoScore->findByUser($idUser);
    
            $user=$this->getUser();
            $password=$user->getPassword();
    
            $form=$this->createForm(UpdateUserType::class, $user);
            $form->handleRequest($request);
    
            //Traitement du formulaire de création de topic
            if ($form->isSubmitted() && $form->isValid())
            {
                if ($_POST['password']!="")
                {
                    $nPassword=htmlspecialchars($_POST['password']);
                    $passwordConfirm=htmlspecialchars($_POST['password_confirm']);
                    $ancientPassword=htmlspecialchars($_POST['ancient_password']);
    
                    if (password_verify($ancientPassword, $password) && $nPassword==$passwordConfirm)
                    {
                        $hash=$encoder->encodePassword($user, $nPassword);
                        $user->setPassword($hash);
                    }
                    else
                    {
                        return $this->render('espace/espace.html.twig', [
                            'formUpdate'=>$form->createView(),
                            'meillTemps1'=>$meillTemps1,
                            'meillTemps2'=>$meillTemps2,
                            'tempsTotal'=>$tempsTotal,
                            'scores'=>$scores,
                            'erreur'=>'Mot de passe incorrect'
                        ]);
                    }
                }
                $manager->flush();
    
                return $this->render('espace/espace.html.twig', [
                    'formUpdate'=>$form->createView(),
                    'meillTemps1'=>$meillTemps1,
                    'meillTemps2'=>$meillTemps2,
                    'tempsTotal'=>$tempsTotal,
                    'scores'=>$scores,
                    'message'=>'Changement effectuer'
                ]);
            }
    
            return $this->render('espace/espace.html.twig', [
                'formUpdate'=>$form->createView(),
                'meillTemps1'=>$meillTemps1,
                'meillTemps2'=>$meillTemps2,
                'tempsTotal'=>$tempsTotal,
                'scores'=>$scores
            ]);
        }
        return $this->render('espace/espace.html.twig');
    }

    /**
     * @Route("/desinscription", name="desinscription")
     */
    public function desinscription(UserRepository $repoUser)
    {
        $user=$this->getUser();
        $verif=$repoUser->desinscriptionAll($user->getIdUser());

        if ($verif)
        {
            return $this->redirectToRoute('deconnexion');
        }
        else
        {
            return $this->render('accueil/index.html.twig', [
                'erreur'=>'Erreur lors de la procédure de désinscription.'
            ]);
        }
    }
}
