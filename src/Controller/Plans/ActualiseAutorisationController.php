<?php


namespace App\Controller\Plans;


use App\Entity\Plans\AutorisationMarche;

class ActualiseAutorisationController
{
public function __invoke(AutorisationMarche $data):AutorisationMarche
{
    $data->getActualisationAutorisation()->setEstValide(false);
    return $data;
}

}