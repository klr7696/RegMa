<?php


namespace App\Controller\Previsions;


use App\Entity\Prevision\CreditOuvert;

class InscriptionCredit
    {
        public function __invoke(CreditOuvert $data):CreditOuvert
        {
            $hier= $data->getCompteNature()->getHierachieCompteNature();

            if($hier === "Chapitre")
                {
                    $data->getCompteNature()->chapitreTrue();

                }else if($hier === "Article"){
                $data->getCompteNature()->chapitreTrue();
                $data->getCompteNature()->articleTrue();

            } else if($hier === "Paragraphe"){
                $data->getCompteNature()->chapitreTrue();
                $data->getCompteNature()->articleTrue();
                $data->getCompteNature()->getCompteNature()->articleTrue();
            }

            return $data;
        }
    }