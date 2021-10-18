<?php

namespace App\DataFixtures;

use App\Entity\Ad;
use Faker\Factory;
use Cocur\Slugify\Slugify;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        $slugify = new Slugify();

        for($i=1; $i <=30; $i++){
            $ad = new Ad();
            $title = $faker ->sentence();
            $slug = $slugify->slugify($title);
            $coverImage = $faker -> imageUrl(1000,350);
            $introduction = $faker -> paragraph(2);
            //attention le faker paragraphs avec s retourne un tableau
            $content = '<p>'.join('</p><p>',$faker->paragraphs(5)).'</p>';
            $ad->setTitle($title)
            ->setSlug($slug)
            ->setCoverImage($coverImage)
            ->setIntroduction($content)
            ->setContent($content)
            ->setPrice(rand(4,100))
            ->setRooms(rand(1,5));
        
        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
