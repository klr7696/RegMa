<?php

namespace App\DataFixtures;

use App\Entity\Nomenclatures\CompteFonction;
use App\Entity\Nomenclatures\CompteNature;
use App\Entity\Nomenclatures\Nomenclature;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for ($n=0; $n<10; $n++)
        {
           $nomenclature = new Nomenclature();
           $nomenclature->setAnneeApplication(random_int(2010,2030))
                        ->setDecretAdoption($faker->firstName)
                        ->setDateAdoption($faker->dateTimeBetween('-6 months'))
                        ->setDecretApplication($faker->firstName)
                        ->setDateApplication($faker->dateTimeBetween('-6 months'))
                        ->setReferenceVisa($faker->firstName)
                        ->setDateVisa($faker->dateTimeBetween('-6 months'))
                        ->setStructureVisa($faker->firstName)
                        ->setDescriptionNomenclature($faker->sentence)
                        ->setCreationAt(new \DateTimeImmutable('2021-09-20T12:00:00'));
           $manager->persist($nomenclature);

           for($c=0; $c< random_int(1,10); $c++){
               $compteFonction = new CompteFonction();
               $compteFonction->setNumeroCompteFonction(random_int(30,100))
                                ->setLibelleCompteFonction($faker->sentence)
                                ->setHierachieCompteFonction('CHAPITRE')
                                ->setDescriptionCompteFonction($faker->sentence)
                                ->setCreationAt(new \DateTimeImmutable('2021-09-20T12:00:00'))
                                ->setNomenclature($nomenclature);
               $manager->persist($compteFonction);

               for($s=0; $s< random_int(1,10); $s++){
                   $sousCompteArticle = new CompteFonction();
                   $sousCompteArticle->setNumeroCompteFonction(random_int(100,1000))
                                       ->setLibelleCompteFonction($faker->sentence)
                                       ->setHierachieCompteFonction('ARTICLE')
                                       ->setDescriptionCompteFonction($faker->sentence)
                                       ->setCreationAt(new \DateTimeImmutable('2021-09-20T12:00:00'))
                                       ->setNomenclature($nomenclature)
                                        ->setCompteFonction($compteFonction);

                   $manager->persist($sousCompteArticle);
                   for  ($p = 0; $p < random_int(1,10); $p++)
                   {
                       $sousCompteParagraphe = new CompteFonction();
                       $sousCompteParagraphe->setNumeroCompteFonction(random_int(1000,2000))
                                               ->setLibelleCompteFonction($faker->sentence)
                                               ->setHierachieCompteFonction('PARAGRAPHE')
                                               ->setDescriptionCompteFonction($faker->sentence)
                                               ->setCreationAt(new \DateTimeImmutable('2021-09-20T12:00:00'))
                                               ->setNomenclature($nomenclature)
                                               ->setCompteFonction($sousCompteArticle);

                           $manager->persist($sousCompteParagraphe);
                   }

               }
           }

            for($c=0; $c< random_int(1,10); $c++)
            {
                $compteNature = new CompteNature();
                $compteNature->setNumeroCompteNature(random_int(120,200))
                                    ->setLibelleCompteNature($faker->sentence)
                                    ->setHierachieCompteNature('CHAPITRE')
                                    ->setSectionCompteNature($faker->randomElement(['FONCTIONEMENT', 'INVESTISSEMENT']))
                                    ->setDescriptionCompteNature($faker->sentence)
                                    ->setCreationAt(new \DateTimeImmutable('2021-09-20T12:00:00'))
                                    ->setNomenclature($nomenclature);
                $manager->persist($compteNature);

                for($s=0; $s< random_int(1,10); $s++){
                    $sousArticle = new CompteNature();
                    $sousArticle->setNumeroCompteNature(random_int(300,1000))
                                    ->setLibelleCompteNature($faker->sentence)
                                    ->setHierachieCompteNature('ARTICLE')
                                    ->setSectionCompteNature($faker->randomElement(['FONCTIONEMENT', 'INVESTISSEMENT']))
                                    ->setDescriptionCompteNature($faker->sentence)
                                    ->setCreationAt(new \DateTimeImmutable('2021-09-20T12:00:00'))
                                    ->setNomenclature($nomenclature)
                                    ->setCompteNature($compteNature);

                    $manager->persist($sousArticle);
                    for  ($p = 0; $p < random_int(1,10); $p++)
                    {
                        $sousParagraphe = new CompteNature();
                        $sousParagraphe->setNumeroCompteNature(random_int(1000,2000))
                                        ->setLibelleCompteNature($faker->sentence)
                                        ->setHierachieCompteNature('ARTICLE')
                                        ->setSectionCompteNature($faker->randomElement(['FONCTIONEMENT', 'INVESTISSEMENT']))
                                        ->setDescriptionCompteNature($faker->sentence)
                                        ->setCreationAt(new \DateTimeImmutable('2021-09-20T12:00:00'))
                                        ->setNomenclature($nomenclature)
                                        ->setCompteNature($sousArticle);

                        $manager->persist($sousParagraphe);
                    }

                }
            }
        }

        $manager->flush();
    }
}
