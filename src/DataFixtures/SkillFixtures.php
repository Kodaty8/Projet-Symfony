<?php

namespace App\DataFixtures;

use App\Entity\Skill;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SkillFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $skill = new Skill();
        $skill->setName('PHP');
        $manager->persist($skill);

        $skill2 = new Skill();
        $skill2->setName('SQL');
        $manager->persist($skill2);

        $skill3 = new Skill();
        $skill3->setName('Javascript');
        $manager->persist($skill3);

        $manager->flush();
    }
}
