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
        
        $crawler = $client->request('GET', 'https://deliveroo.fr/fr/menu/paris/9eme-opera/okinawa?day=today&time=ASAP');
        $crawler->filter('h1')->each(function ($node) {
            echo $node->text() . '<br>';
        });

        // $crawler = $client->request('GET', 'https://deliveroo.fr/fr/menu/paris/9eme-opera/okinawa?day=today&time=ASAP');
        // $crawler->filter('div')->filter('h1')->each(function ($node) {
        //     echo $node->text() . '<br>';
        // });


        return $this->render('scrap/index.html.twig', [
            'controller_name' => 'ScrapController',
            'client' => $client,
        ]);
    }
}
