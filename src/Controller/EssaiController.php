<?php


namespace App\Controller;


use App\Entity\Nomenclatures\Nomenclature;
use App\Entity\Prevision\CreditOuvert;
use App\Entity\Prevision\RessourceFinanciere;

class EssaiController
{
    public function __invoke(CreditOuvert $data): CreditOuvert
    {


        //return $data;

          // $data->getAssiociationCompteNature()->current();
         //  return $data;
    }

}