<?php


namespace App\Controller\Previsions;


use App\Entity\Prevision\ExerciceRegistre;
use App\Entity\Prevision\StatutRegistre;

class OuvrirRegistreController
{
    public function __invoke(ExerciceRegistre $data): ExerciceRegistre
    {
       $defaut= new StatutRegistre();
       $defaut->setStatut('Primitif');
        $data->addAssociationStatut($defaut);
        return $data;
    }

}