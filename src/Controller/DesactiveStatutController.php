<?php


namespace App\Controller;





use App\Entity\Prevision\StatutRegistre;


class DesactiveStatutController
{


    public function __invoke(StatutRegistre $data)
    {
       $statut = $data->getStatutRegistre();
           if ($statut !== null)
           {
               $statut->setEstEnCours(false)
                        ->setEstActualisable(false);
               $data->setStatutRegistre($statut);
           }

        $data->setEstEnCours(false)
             ->setEstActualisable(true);

        return $data;
    }
}