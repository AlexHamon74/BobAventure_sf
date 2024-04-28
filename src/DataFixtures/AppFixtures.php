<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    private const CATEGORIES = ['Voyage au maroc', 'Voyage en France', 'Assemblée générale'];

    public function load(ObjectManager $manager): void
    {
        $generator = Factory::create();
        
        $categories= [];
        foreach(self::CATEGORIES as $categoryName){
        $category = new Category();
            $category->setName($categoryName)
                ->setDescription($generator->realTextBetween(1000,1200));
        $manager->persist($category);
        $categories[] = $category;
        }

        for ($i=0; $i<10; $i++){
            $article = new Article();
            $article->setTitle($generator->realText(25))
                ->setContent($generator->realTextBetween(1800,2000))
                ->setCategory($generator->randomElement($categories));

            $manager->persist($article);
        }

        $manager->flush();
    }
}
