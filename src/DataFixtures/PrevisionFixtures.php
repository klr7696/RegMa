<?php


namespace App\DataFixtures;

use App\DataFixtures\AppFixtures;
use App\Entity\Nomenclatures\CompteNature;
use App\Entity\Nomenclatures\Nomenclature;
use App\Entity\Prevision\CreditOuvert;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use Faker\Factory;

class PrevisionFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        $faker= Factory::create();
$bonjour= new CompteNature();
    $bonjour->getLibelleCompteNature();
    dd($bonjour);}
}