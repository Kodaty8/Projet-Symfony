<?php

namespace App\DataFixtures;

use App\Entity\Company;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CompanyFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $company = new Company();
        $company->setName('Orange');
        $company->setDescription('Orange Company');
        $company->setMail('orange@group.com');
        $company->setPhoto('https://cdn.pixabay.com/photo/2015/01/08/18/30/entrepreneur-593378_1280.jpg');
        // $company->addOffer($offer_2);
        // $company->addOffer($this->getReference('offer_1'));
        $manager->persist($company);

        $company2 = new Company();
        $company2->setName('Samsung');
        $company2->setDescription('Samsung Company');
        $company2->setMail('samsung@group.com');
        $company2->setPhoto('https://cdn.pixabay.com/photo/2020/03/27/18/30/warsaw-4974528_1280.jpg');
        // $company2->addOffer($this->getReference('offer_2'));

        $manager->persist($company2);


        $manager->flush();
    }
}
