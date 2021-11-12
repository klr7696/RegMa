<?php


namespace App\Controller;


use App\Entity\Nomenclatures\CompteNature;
use App\Entity\Nomenclatures\Nomenclature;

class EssaiController
    {
        public function __invoke(CompteNature $data): CompteNature
        {
            //$data->getSousCompteNature()->toArray()->
            $test=$data->getSousNatureTrue();
            if( $test === true){
                $data->setLibelleCompteNature("terrible la motivation");
            }
            return $data;

        }

}