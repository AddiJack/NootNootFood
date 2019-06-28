<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Goutte\Client;
use Symfony\Component\BrowserKit\AbstractBrowser;
use Symfony\Component\DomCrawler\Crawler;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Plats;

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
        $crawler->filter('li')->filter('.product')->each(function ($node) use (&$menus){
            
             $menu['name'] = trim($node->filter('h4')->filter('.name')->text());
             if(!empty($node->filter('div')->filter('.description')))
             {
                $menu['description'] = trim($node->filter('div')->filter('.description')->text());
             }
             if(!empty($node->filter('div')->filter('.price')))
             {
                $menu['price'] = trim($node->filter('div')->filter('.price')->text());
             }
            // dump($menu);
            $menus[] = $menu;
        });

            $i=0;
            foreach ($menus as $menu){
                $plats = new Plats();
                $plats->setNom($menu['name']);
                $plats->setDescription($menu['description']);
                $plats->setPrix($menu['price']);
                // $plats->setImage($menus['img']);
                $plats->setTag('sushi');
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($plats);
               
               if($i==10) break;
               $i++;
            }

        $entityManager->flush();
        // dump($menus);

        $client = new Client();
        $crawler = $client->request('GET', 'https://www.just-eat.fr/restaurant-livraison-a-domicile/restaurant/pizza-presto-75004');

        $menus = [];
        $crawler->filter('li')->filter('.product')->each(function ($node) use (&$menus){
            
             $menu['name'] = trim($node->filter('h4')->filter('.name')->text());
             if(!empty($node->filter('div')->filter('.description')))
             {
                $menu['description'] = trim($node->filter('div')->filter('.description')->text());
             }
             if(!empty($node->filter('div')->filter('.price')))
             {
                $menu['price'] = trim($node->filter('div')->filter('.price')->text());
             }
            // dump($menu);
            $menus[] = $menu;
        });

            $i=0;
            foreach ($menus as $menu){
                $plats = new Plats();
                $plats->setNom($menu['name']);
                $plats->setDescription($menu['description']);
                $plats->setPrix($menu['price']);
                // $plats->setImage($menus['img']);
                $plats->setTag('pizza');
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($plats);
               
               if($i==10) break;
               $i++;
            }

        $entityManager->flush();


        $client = new Client();
        $crawler = $client->request('GET', 'https://www.just-eat.fr/restaurant-livraison-a-domicile/restaurant/les-burgers-de-papa-strasbourg');

        $menus = [];
        $crawler->filter('li')->filter('.product')->each(function ($node) use (&$menus){
            
             $menu['name'] = trim($node->filter('h4')->filter('.name')->text());
             if(!empty($node->filter('div')->filter('.description')))
             {
                $menu['description'] = trim($node->filter('div')->filter('.description')->text());
             }
             if(!empty($node->filter('div')->filter('.price')))
             {
                $menu['price'] = trim($node->filter('div')->filter('.price')->text());
             }
            // dump($menu);
            $menus[] = $menu;
        });

            $i=0;
            foreach ($menus as $menu){
                $plats = new Plats();
                $plats->setNom($menu['name']);
                $plats->setDescription($menu['description']);
                $plats->setPrix($menu['price']);
                // $plats->setImage($menus['img']);
                $plats->setTag('burger');
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($plats);
               
               if($i==10) break;
               $i++;
            }

        $entityManager->flush();
        
       

        // $images = $crawler->filter('img')->each(function ($node) {
        //     echo '<img src="' . $node->attr('src') . '" alt="' . $node->attr('itemprop') . '">';
        // });
        //  // image

        // $plat = $crawler->filter('h4')->filter('.name')->each(function ($node){
        //     return $posts[] = $node->text();
        // }); 

         // plat

        // $description = $crawler->filter('div')->filter('.description')->each(function ($node){
        //     return $posts[] = $node->text();
        // }); 

        // description

        // $prix = $crawler->filter('div')->filter('.price')->each(function ($node){
        //     return $posts[] = $node->text();
        // }); 

        // prix



        //  if(!empty($node->filter('img')))
            //  {
            //     $menu['img'] = $node->attr('src')->attr('itemprop')->text();
            //  }
            
            //  if(!empty($node->filter('div')->filter('.cuisines')))
            //  {
            //     $menu['cuisines'] = $node->filter('div')->filter('.cuisines')->filter('a')->text();
            //  }


        $tag = $crawler->filter('div')->filter('.cuisines')->filter('a')->each(function ($node){
            return $posts[] = $node->text();
        }); 

       
        return $this->render('scrap/index.html.twig', [
            'controller_name' => 'ScrapController',
            'client' => $client,
            'clienti' => $tag,
        ]);
    }
   
}
