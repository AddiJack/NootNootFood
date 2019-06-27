<?php

namespace App\DataFixtures;

use App\Entity\Menu;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;
use Faker\Provider\Image;

class AccueilFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker  =  Faker\Factory::create('fr_FR');
        for ($i = 1; $i <= 5; $i++) {
            $Menu = new Menu();
            $Menu->setTitle($faker->title);
            $Menu->setDescription($faker->text);
            $Menu->setImage($faker->imageUrl(true, 'Faker'));
            $manager->persist($Menu);
        }
        $manager->flush();
    }
}