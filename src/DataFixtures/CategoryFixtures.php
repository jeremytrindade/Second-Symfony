<?php

namespace App\DataFixtures;

use App\Entity\Event;
use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create('fr_FR');
        
        // Créer 3 catégoris fakées
        for($i = 1; $i <= 3; $i++) {
            $category = new Category();
            $category->setName($faker->word())
                     ->setCreateDate($faker->dateTimeBetween('-6 months'));
            
            $manager->persist($category);

            // Créer entre 4 et 6 Event
            for($j = 1; $j <=mt_rand(4,6); $j++){
                $event = new Event();
                $event->setName($faker->sentence($nbWords = 2, $variableNbWords = true))
                        ->setCategory($category)
                        ->setDetails($faker->sentence($nbWords = 6, $variableNbWords = true))
                        ->setDay($faker->dateTimeBetween('-3 months'))
                        ->setCity($faker->city())
                        ->setZipcode($faker->postcode())
                        ->setCreateDate($faker->dateTimeBetween('-6 months'))
                        ->setStreetAddress($faker->streetAddress());
    
                $manager->persist($event);
            }
        }
    $manager->flush();
    }
}
