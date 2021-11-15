<?php


namespace App\Controller\Previsions;


use App\Entity\Prevision\RessourceFinanciere;

class ActualiseRessourceController
{
public function __invoke(RessourceFinanciere $data): RessourceFinanciere
    {
    $data->getActualiseRessource()->setEstValide(false);
    $bailleurs=$data->getActualiseRessource()->getBailleurFonds();
    $exercice=$data->getStatutRegistre()->getExerciceRegistre();
   // $statut= $data->getActualiseRessource()->getStatutRegistre();
    $data->setBailleurFonds($bailleurs)
            ->setExerciceRegistre($exercice);
           // ->setStatutRegistre($statut);

    return $data;
    }
}