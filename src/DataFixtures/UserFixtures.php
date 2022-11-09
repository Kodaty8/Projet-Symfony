<?php

namespace App\DataFixtures;

use App\Entity\Skill;
use App\Entity\User;
use App\Repository\SkillRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setName('John');
        $user->setMail('john@example.com');
        $user->addSkill(SkillFixtures::class, 'Database and SQL');
        $user->addApplication('Developer JavaScript');
        $user->setPhoto('https://cdn.pixabay.com/photo/2017/05/13/09/04/question-mark-2309040_1280.jpg');
        $user->setDescription('Motivation');

        $manager->persist($user);
        $manager->flush();
    }
}