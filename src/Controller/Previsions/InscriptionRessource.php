<?php


namespace App\Controller\Previsions;


use App\Entity\Prevision\RessourceFinanciere;

class InscriptionRessource
        {
        public function __invoke(RessourceFinanciere $data)
        {
            $exercice= $data->getStatutRegistre()->getExerciceRegistre();
            $data->setExerciceRegistre($exercice);
            return $data;
        }
}