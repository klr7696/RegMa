<?php


namespace App\Controller;


use App\Entity\Nomenclatures\CompteNature;
use App\Entity\Nomenclatures\Nomenclature;
use App\Entity\Prevision\ExerciceRegistre;

class TestController
    {


    public function __invoke(Nomenclature $data):Nomenclature
            {

              $data->setNature();
              return $data;
               // $this->__invoke();
             // $test= $data->getAssiociationCompteNature()->getIterator();
             /* while ($test->valid())
              {
                  dd($nature->);
                  $test->next();
              }*/



            }

  }