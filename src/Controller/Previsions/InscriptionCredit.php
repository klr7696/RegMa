<?php


namespace App\Controller\Previsions;


use App\Entity\Prevision\CreditOuvert;

class InscriptionCredit
    {
        public function __invoke(CreditOuvert $data):CreditOuvert
        {
               $pos = $data->getCompteNature()->getSousNatureTrue();
           if( $pos === true){
                $data->getCompteNature()->setCreditAffect(true);

            }
            return $data;
        }
    }