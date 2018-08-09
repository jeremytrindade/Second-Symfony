<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EventController extends AbstractController
{
    /**
     * @Route("/events", name="event_list")
     */
    public function indexAction()
    {
        return $this->render('event/index.html.twig', [
            'controller_name' => 'eventController',
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
