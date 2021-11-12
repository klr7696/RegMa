<?php


namespace App\Controller\Previsions;


use App\Entity\Prevision\CreditOuvert;

class InscriptionCredit
    {
        public function __invoke(CreditOuvert $data):CreditOuvert
        {
             $per =$data->getCompteNature()->essaiTest();
               $pos = $data->getCompteNature()->getSousNatureTrue();
          if( $pos === true){
                $data->getCompteNature()->setCreditAffect(true);
                if($per === true){
                    $data->getCompteNature()->getCompteNature()->setCreditAffect(true);
                }

              //$data->getCompteNature()->getCompteNature()->getCompteNature()->setCreditAffect(true);


           }
            return $data;
        }
    }