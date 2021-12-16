<?php

namespace App\DataFixtures;

use App\Entity\Articles;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Contact;
class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        for ($i =1; $i<=5; $i++)
        {
            $contact= new Contact();
            $contact->setNom("Nom $i")
                    ->setPrenom("Prenom $i")
                    ->setEmail("abc$i@gmail.com")
                    ->setSujet("Sujet $i")
                    ->setMessage("message $i")
                    ->setNewsletter("Newsletter $i");
            $article= new Articles();
            $article->setNom("article $i")
                    ->setSlug("Slug $i")
                    ->setContenu("contenu $i");

            $manager->persist($contact);
            $manager->persist($article);

        }
        $manager->flush();
    }
}
