<?php


namespace App\Controller;


use App\Entity\Prevision\CreditOuvert;

class DesactiveOuvertController
{
    public function __invoke(CreditOuvert $data): CreditOuvert
    {
        $data->setEstValide(false);
        return $data;
    }
}