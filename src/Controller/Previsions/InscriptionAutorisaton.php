<?php


namespace App\Controller\Previsions;


use App\Entity\Plans\AutorisationMarche;

class InscriptionAutorisaton
{
    public function  __invoke(AutorisationMarche $data)
    {
        $pos = $data->getCompteNature()->getAutoTrue();
        /*if( $pos === true){
            $data->getCompteNature()->setAutoAffect(true);
        }
        return $data;*/
    }

}