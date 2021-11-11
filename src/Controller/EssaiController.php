<?php


namespace App\Controller;


use App\Entity\Nomenclatures\CompteNature;
use App\Entity\Nomenclatures\Nomenclature;

class EssaiController
    {
        public function __invoke(CompteNature $data): CompteNature
        {
           $essai= $data->getSousCompteNature()->count();

              $ver=  $data->getSousNatureTrue();
            if($ver === $essai || $ver === 0 ){
               $data->setLibelleCompteNature("t'es vraiment bête toi");

            }
            return $data;
        }

}