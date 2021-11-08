<?php


namespace App\Controller;


use App\Entity\Plans\AutorisationMarche;

class DesactiveAutorisationController
{
public function __invoke(AutorisationMarche $data):AutorisationMarche
{
    $data->setEstValide(false);
    return $data;
}

}