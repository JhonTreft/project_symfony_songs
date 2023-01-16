<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Twig\Environment;
use function Symfony\Component\String\u;


class MiusiController extends  AbstractController{

  #[Route('/',name:'root')]
  public function homepage(Environment $twig):Response  {

    $miusic = [
      'Arcangel'=>'No Te Vayas',
      'Esteban Rojas' => 'Cali Cartel',
      'Lael' => 'Desamor',
      'Pirlo'=>'Sople',
    ];


 
    $html = $twig->render('miusic/homepage.html.twig',
      [
        'title'=> 'Treft',
        'plays'=> $miusic,
      ]);

    return new Response($html);
  }

  #[Route('list/{gn}',name:'detail')]
  public function ListDetail(HttpClientInterface $httpclient, string $gn = null):Response {

    $genero = $gn ? u(str_replace('-',"",$gn))->title(true) : null;

    $response = $httpclient->request('GET', 'https://raw.githubusercontent.com/SymfonyCasts/vinyl-mixes/main/mixes.json');
    $mixes = $response->toArray();

       return $this->render("miusic/browse.html.twig",[
      'genero' => $genero,
      'mixes'=>$mixes
    ]);
    
  }


}






