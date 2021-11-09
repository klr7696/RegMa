<?php


namespace App\Controller\Previsions;


use App\Entity\Prevision\CreditOuvert;

class ActualiseOuvertController
{
    public function __invoke(CreditOuvert $data): CreditOuvert
    {
        $data->getActualiseCredit()->setEstValide(false);
        return $data;
    }
}