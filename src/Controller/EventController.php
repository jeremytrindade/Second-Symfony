<?php

namespace App\Controller;

use App\Entity\Event;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
     */
    public function createAction()
    {
        return $this->render('event/create.html.twig', [
            'controller_name' => 'eventController',
        ]);
    }

    /**
     * @Route("/event/edit/{id}", name="event_edit")
     */
    public function editAction(Request $request)
    {
        return $this->render('event/edit.html.twig', [
            'controller_name' => 'eventController',
        ]);
    }

    /**
     * @Route("/event/delete/{id}", name="event_delete")
     */
    public function deleteAction(Request $request)
    {
    }
}
