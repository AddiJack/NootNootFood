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

        $menus = [];
        $crawler->filter('li')->filter('.product')->each(function ($node){
            
             $menu['name'] = trim($node->filter('h4')->filter('.name')->text());
             if(!empty($node->filter('div')->filter('.description')))
             {
                $menu['description'] = trim($node->filter('div')->filter('.description')->text());
             }
             if(!empty($node->filter('div')->filter('.price')))
             {
                $menu['price'] = trim($node->filter('div')->filter('.price')->text());
             }
            //  if(!empty($node->filter('div')->filter('.cuisines')))
            //  {
            //     $menu['cuisines'] = $node->filter('div')->filter('.cuisines')->filter('a')->text();
            //  }
            dump($menu);
            $menus[] = $menu;
        }); 
        dump($menus);

        // $images = $crawler->filter('img')->each(function ($node) {
        //     echo '<img src="' . $node->attr('src') . '" alt="' . $node->attr('itemprop') . '">';
        // });
        // // image

        // $plat = $crawler->filter('h4')->filter('.name')->each(function ($node){
        //     return $posts[] = $node->text();
        // }); 

        // // plat

        // $description = $crawler->filter('div')->filter('.description')->each(function ($node){
        //     return $posts[] = $node->text();
        // }); 

        // // description

        // $prix = $crawler->filter('div')->filter('.price')->each(function ($node){
        //     return $posts[] = $node->text();
        // }); 

        //  // prix
        
        $tag = $crawler->filter('div')->filter('.cuisines')->filter('a')->each(function ($node){
            return $posts[] = $node->text();
        }); 

        // // tag
       
        return $this->render('scrap/index.html.twig', [
            'controller_name' => 'ScrapController',
            'client' => $client,
            'clienti' => $tag,
        ]);
    }
   
}
