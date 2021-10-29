<?php


namespace App\Controller;


use App\Entity\Prevision\StatutRegistre;

class DesactiveStatutController
{
    public function __invoke(StatutRegistre $data):StatutRegistre
    {
        if($data->getId()>=1){
            $data->setEstEnCours(false)
                ->setEstActualisable(true);
        }

        return $data;
    }
}