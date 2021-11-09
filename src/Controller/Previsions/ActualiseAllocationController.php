<?php


namespace App\Controller\Previsions;


use App\Entity\Prevision\AllocationCredit;

class ActualiseAllocationController
{
    public function __invoke(AllocationCredit $data): AllocationCredit
    {
        $data->getActualiseAllocation()->setEstValide(false);
        return $data;
    }
}