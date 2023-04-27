<?php

namespace App\Controller\Kurigram;

use App\Entity\Event;
use App\Repository\EventRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class EventController extends AbstractController
{
    #[Route('/event', name: 'app_event')]
    public function listEvents(?int $page, EntityManagerInterface $entityManager, SessionInterface $session): Response
    {
        $event = $entityManager->getRepository(Event::class);
        $curDate = new \DateTime('now');
        return $this->render('event/index.html.twig', [
            'data' => $event->findAll(),
            'page' => $this->getLastPage($page, $session),
            'curDate' => $curDate
        ]);
    }

    //Insert Events 
    #[Route('/insertEvent', name: 'insert_event')]
    public function insert(Request $request, EventRepository $repository) : Response {
        if (count($request->request->all())) {
            $repository->insert($request);
        }
        return $this->render('/event/insertEvent.html.twig');
    }

    private function getLastPage($page, $session): int
    {
      if ($page != null) {
        $session->set("page",$page);
        return $page;
      } elseif (!$session->has("page") || !is_numeric($session->get("page"))) {
        $session->set("page",1);
        return 1;
      }
      return $session->get("page");
    }
}
