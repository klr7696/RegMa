<?php


namespace App\Controller\Previsions;


use App\Entity\Plans\AutorisationMarche;

class InscriptionAutorisaton
{
    public function  __invoke(AutorisationMarche $data)
    {
        $hier= $data->getCompteNature()->getHierachieCompteNature();

        if($hier === "Chapitre")
        {
            $data->getCompteNature()->chapitreAuto();

        }else if($hier === "Article"){
            $data->getCompteNature()->chapitreAuto();
            $data->getCompteNature()->articleAuto();

        } else if($hier === "Paragraphe"){
            $data->getCompteNature()->chapitreAuto();
            $data->getCompteNature()->articleAuto();
            $data->getCompteNature()->getCompteNature()->articleAuto();
        }

        return $data;
    }

}