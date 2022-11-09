<?php

namespace App\DataFixtures;

use App\Entity\Offer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class OfferFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $offer = new Offer();
        $offer->setName('Ingénieur Devsecops F/H');
        $offer->setDescription('Au sein de la Fabrique du CyberSOC, vous rejoindrez une équipe DevSecOps en charge de la conception...');
        $manager->persist($offer);

        $offer2 = new Offer();
        $offer2->setName('Software Developer - Automation R&D');
        $offer2->setDescription('Responsable de la création applications Web basées sur C- JavaScript- Java- React et base de données SQL. Développement API RESTful et une architecture basée sur des microservices');
        $manager->persist($offer2);

        $manager->flush();

        $this->addReference('offer_1', $offer);
        $this->addReference('offer_2', $offer2);
    }
}
