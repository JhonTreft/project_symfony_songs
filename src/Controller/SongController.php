<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class SongController extends AbstractController{
  
  #[Route('/api/songs/{id<\d+>}',methods:["GET"], name:'get_songs')]
  public function getSong(int $id, LoggerInterface $logger): Response
  {
    $song = [
      'id'=> $id,
      'name'=>'Lael Desamor',
      'url'=>'miusic.mp3'
    ];

    $logger->info("Debug in service is active");

    return new JsonResponse($song);
  }
}
