<?php


namespace App\Controller;


use App\Entity\Nomenclatures\CompteNature;
use App\Entity\Nomenclatures\Nomenclature;
use App\Entity\Prevision\ExerciceRegistre;

class TestController
    {


    public function __invoke(Nomenclature $data):Nomenclature
            {

              $data->initialiseNatureAffecter();
              return $data;

            }

  }