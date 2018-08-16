<?php

namespace App\Controller;

use App\Entity\Event;
use App\Form\EventType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bundle\FrameworkBundle\Tests\Fixtures\Validation;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Tests\Fixtures\Validation\Article;

class EventController extends AbstractController
{
    /**
     * @Route("/events", name="home")
     */
    public function indexAction()
    {
        $repo = $this->getDoctrine()->getRepository(Event::class);

        $events = $repo->findAll();

        return $this->render('event/index.html.twig', [
            'controller_name' => 'eventController',
            'events' => $events
        ]);
    }

    /**
     * @Route("/event/create", name="event_create")
     * @Route("/event/{id}/edit/", name="event_edit")
     */
    public function form(Event $event = null, Request $request, ObjectManager $manager)
    {
        if (!$event){
            $event = new Event();
        }

        $form = $this->createForm(EventType::class, $event);

        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            if(!$event->getId()){
                $event->SetCreateDate(new \DateTime());
            }

            $manager->persist($event);
            $manager->flush();

            return $this->redirectToRoute('home');
            
        }
        
        return $this->render('event/create.html.twig', [
            'formEvent' => $form->createView(),
            'editMode' => $event->getId() !== null,
        ]);
    }
        /**
         * @Route("/event/{id}/delete/", name="event_delete")
         */
        public function deleteAction(Event $event)
    {
        if (!$event) {
            throw $this->createNotFoundException('No event found');
        }

        $em = $this->getDoctrine()->getEntityManager();
        $em->remove($event);
        $em->flush();

        return $this->redirectToRoute('home');
    }
}
