<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\DomCrawler\Crawler;
use Goutte\Client;
use Symfony\Component\BrowserKit\AbstractBrowser;



class ScrapController extends AbstractController
{
    /**
     * @Route("/", name="scrap")
     */
    public function index()
    {
        $client = new Client();
        $crawler = $client->request('GET', 'https://www.just-eat.fr/restaurant-livraison-a-domicile/restaurant/oky-sushi-75020');
       

        $images = $crawler->filter('img')->each(function ($node) {
            echo '<img src="' . $node->attr('src') . '" alt="' . $node->attr('itemprop') . '">';
        });
        // image

        $plat = $crawler->filter('h4')->filter('.name')->each(function ($node){
            return $posts[] = $node->text();
        }); 

        // plat

        $description = $crawler->filter('div')->filter('.description')->each(function ($node){
            return $posts[] = $node->text();
        }); 

        // description

         $prix = $crawler->filter('div')->filter('.price')->each(function ($node){
            return $posts[] = $node->text();
        }); 

         // prix
        
         $tag = $crawler->filter('div')->filter('.cuisines')->filter('a')->each(function ($node){
            return $posts[] = $node->text();
        }); 

         // tag
       

        
        return $this->render('scrap/index.html.twig', [
            'controller_name' => 'ScrapController',
            'client' => $client,
            'clienti' => $images,
        ]);
    }

   
}
