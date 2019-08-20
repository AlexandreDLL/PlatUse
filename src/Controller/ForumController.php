<?php

namespace App\Controller;

use App\Entity\Topic;
use App\Entity\Reponse;
use App\Form\TopicType;
use App\Form\ReponseType;
use App\Repository\TopicRepository;
use App\Repository\ReponseRepository;
use App\Repository\CategorieRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ForumController extends AbstractController
{
    /**
     * @Route("/forum", name="forum")
     */
    public function index(CategorieRepository $repo, TopicRepository $repoTopic, Request $request, ObjectManager $manager)
    {
        $categorie1=$repo->find(1);
        $categorie2=$repo->find(2);
        $categorie3=$repo->find(3);

        $topicRecent1=$repo->findLastTopic(1);
        $topicRecent2=$repo->findLastTopic(2);
        $topicRecent3=$repo->findLastTopic(3);

        $topics1=$repoTopic->findByCategorie(1);
        $topics2=$repoTopic->findByCategorie(2);
        $topics3=$repoTopic->findByCategorie(3);

        $nTopic=new Topic();

        $form=$this->createForm(TopicType::class, $nTopic);
        $form->handleRequest($request);

        //Traitement du formulaire de création de topic
        if ($form->isSubmitted() && $form->isValid())
        {
            $nTopic->setIdUser($this->getUser());

            $manager->persist($nTopic);
            $manager->flush();
        }

        return $this->render('forum/forum.html.twig',[
            'categorie1'=>$categorie1,
            'categorie2'=>$categorie2,
            'categorie3'=>$categorie3,
            'topicRecent1'=>$topicRecent1,
            'topicRecent2'=>$topicRecent2,
            'topicRecent3'=>$topicRecent3,
            'topics1'=>$topics1,
            'topics2'=>$topics2,
            'topics3'=>$topics3,
            'formTopic'=>$form->createView()
        ]);
    }

    /**
     * @Route("/topic/{id}", name="topic")
     */
    public function topic(Topic $sujet, TopicRepository $repoTopic, ReponseRepository $repoReponse, Request $request, ObjectManager $manager)
    {   
        $idTopic=$sujet->getIdTopic();

        $topic=$repoTopic->findById($idTopic);

        $nReponse=new Reponse();

        $form=$this->createForm(ReponseType::class, $nReponse);
        $form->handleRequest($request);

        //Traitement du formulaire de création de topic
        if ($form->isSubmitted() && $form->isValid())
        {
            $nReponse->setIdUser($this->getUser())
                    ->setIdTopic($sujet);

            $manager->persist($nReponse);
            $manager->flush();
        }

        //Afficher la section réponse si il y en a sinon la caché
        if ($reponses=$repoReponse->findByTopic($idTopic))
        {
            return $this->render('forum/topic.html.twig',[
                'topic'=>$topic,
                'formReponse'=>$form->createView(),
                'reponses'=>$reponses
            ]);
        }
        else
        {
            return $this->render('forum/topic.html.twig',[
                'topic'=>$topic,
                'formReponse'=>$form->createView()
            ]);
        }
    }
}
