<?php


namespace App\Controller\Previsions;


use App\Entity\Prevision\AllocationCredit;

class InscriptionAllocation
{
    public function __invoke(AllocationCredit $data): AllocationCredit
    {
       $credit= $data->getCreditOuvert();
        $bailleur=$data->getCreditOuvert()->getRessourceFinanciere()->getBailleurFonds();
        $data->getAutorisationMarche()->addAssociationBailleur($bailleur);
        $data->getAutorisationMarche()->setAssociationCredit($credit);
        return $data;
    }

}