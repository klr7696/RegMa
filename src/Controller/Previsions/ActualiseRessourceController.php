<?php


namespace App\Controller\Previsions;


use App\Entity\Prevision\RessourceFinanciere;

class ActualiseRessourceController
{
public function __invoke(RessourceFinanciere $data): RessourceFinanciere
    {
    $data->getActualiseRessource()->setEstValide(false);
    return $data;
    }
}