<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Category;
use App\Entity\Contact;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private const CATEGORIES = ['Voyage au maroc', 'Voyage en France', 'Assemblée générale'];

    public function __construct(private UserPasswordHasherInterface $hasher)
    {
        
    }

    public function load(ObjectManager $manager): void
    {
        $generator = Factory::create();
        
        // Catégories 
        $categories= [];
        foreach(self::CATEGORIES as $categoryName){
        $category = new Category();
            $category->setName($categoryName)
                ->setDescription($generator->realTextBetween(300,400));
        $manager->persist($category);
        $categories[] = $category;
        }

        // Articles
        for ($i=0; $i<4; $i++){
            $article = new Article();
            $article->setTitle($generator->realText(25))
                ->setContent($generator->realTextBetween(1800,2000))
                ->setCategory($generator->randomElement($categories));

            $manager->persist($article);
        }

        // User avec le rôle par défaut
        $regularUser = new User();
        $regularUser->setEmail("bob@test.com")
            ->setRoles(['ROLE_USER'])
            ->setPassword($this->hasher->hashPassword($regularUser, 'test'))
            ->setFirstname("Bob")
            ->setName("Test")
            ->setBirthdate($generator->dateTimeBetween('-22 years'));

        $manager->persist($regularUser);

        // User avec le rôle admin
        $adminUser = new User();
        $adminUser->setEmail('admin@admin.com')
            ->setRoles(['ROLE_ADMIN'])
            ->setPassword($this->hasher->hashPassword($adminUser, 'admin'))
            ->setFirstname('admin')
            ->setName('admin')
            ->setBirthdate($generator->dateTimeBetween('-22 years'));

        $manager->persist($adminUser);

        // Demande de contact
        $contact = new Contact();
        $contact->setName($generator->name())
            ->setFirstname($generator->firstName())
            ->setEmail($generator->email())
            ->setSubject($generator->realText(15))
            ->setMessage($generator->realTextBetween(200,400))
            ->setPhoneNumber("0607080997");

        $manager->persist($contact);

        $manager->flush();
    }
}
