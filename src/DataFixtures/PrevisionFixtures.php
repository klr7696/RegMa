<?php


namespace App\DataFixtures;


use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class PrevisionFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        $faker= Factory::create();
    }
}