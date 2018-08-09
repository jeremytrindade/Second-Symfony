<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for(i=1; i<=5; i++){
            $category = new Category();
            $category->setName("Category nº$i")
                     ->setCreateDate(new \DateTime());
            
        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
