<?php


namespace App\Controller;


use App\Entity\Prevision\RessourceFinanciere;

class DesactiveRessourceController
{
public function __invoke(RessourceFinanciere $data): RessourceFinanciere
    {
    $data->setEstValide(false);
    return $data;
    }
}