<?php


namespace App\Controller\Previsions;


use App\Entity\Prevision\StatutRegistre;

class ChangeStatutController
        {
    public function __invoke(StatutRegistre $data)
    {
        $statut = $data->getStatutRegistre();
        $exercice= $data->getStatutRegistre()->getExerciceRegistre();
        if ($statut !== null)
        {
            $statut->setEstEnCours(false)
                ->setEstActualisable(true);

            $statutclos = $statut->getStatutRegistre();
            if ($statutclos !== null )
            {
                $statutclos->setEstEnCours(false)
                    ->setEstActualisable(false);
            }
            $data->setStatutRegistre($statut);
            $data->setExerciceRegistre($exercice);
        }

        return $data;
    }

        }