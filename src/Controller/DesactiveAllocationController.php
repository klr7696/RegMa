<?php


namespace App\Controller;


use App\Entity\Prevision\AllocationCredit;

class DesactiveAllocationController
{
    public function __invoke(AllocationCredit $data): AllocationCredit
    {
        $data->setEstValide(false);
        return $data;
    }
}