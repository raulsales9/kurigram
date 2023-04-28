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

#[Route('/twig')]
class EventController extends AbstractController
{
    
  #[Route('/listEvent/{page?}', name: 'app_Events')]
  public function listEvents(?int $page, EntityManagerInterface $entityManager, SessionInterface $session): Response
  {
      $event = $entityManager->getRepository(Event::class);
      $curDate = new \DateTime('now');
      return $this->render('/kurigram/Events/AdminEvents.html.twig', [
          'data' => $event->findAll(),
          "page" => $this->getLastPage($page, $session),
          'curDate' => $curDate
      ]);
  }

  #[Route('/detailEvent/{id}', name: 'detail_events')]
  public function detail(EntityManagerInterface $entityManager, $id) : Response {
    $event = $entityManager->getRepository(Event::class)->find($id);
    $curDate = new \DateTime('now');
    return $this->render('/kurigram/Events/detailEvent.html.twig', [
      'task' => $event,
      'cantPeople' => count($event->getIdUser()),
      'people' => $event->getIdUser(),
      'curDate' => $curDate
  ]);
  }
  #[Route('/tmp/{img}', name: 'image')]
  public function showImg($img) : Response{
    return $this->render('/image.html.twig', [
      'img' => $img,
    ]);
  }

  #[Route('/updateEvent/{id}', name: 'update_events')]
  public function detailEvent(int $id, EntityManagerInterface $doctrine, Request $request, EventRepository $repository) : Response {
      $data = $doctrine->getRepository(Event::class)->find($id);

      if (count($request->request->all())){
          $repository->update($data, $request);
      }

      return $this->render('/kurigram/Events/UpdateEvents.html.twig', [
          'task' => $data
      ]);
  }

  #[Route('/insertEvent', name: 'insert_event')]
  public function insert(Request $request, EventRepository $repository) : Response {

    if (count($request->request->all())){

      $repository->insert($request);
    }
    return $this->render('/kurigram/Events/insertEvents.html.twig', []);
  }

  #[Route('/deleteEvent/{id}', name: 'delete_event')]
  public function delete($id, EventRepository $repository, EntityManagerInterface $doctrine) : Response {
    $Event = $doctrine->getRepository(Event::class)->find($id);
    $repository->remove($Event, true);
    return $this->redirectToRoute('app_Events');
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
