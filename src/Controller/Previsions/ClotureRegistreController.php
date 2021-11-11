<?php


namespace App\Controller\Previsions;



use App\Entity\Prevision\StatutRegistre;

class ClotureRegistreController
{
    public function __invoke(StatutRegistre $data)
    {
        $reg = $data->getExerciceRegistre()->setEstOuvert(false);
        $data->getExerciceRegistre()->getNomenclature()->initialiseNatureAffecter();
        $data->setEstEnCours(false)
            ->setEstActualisable(false)
            ->setExerciceRegistre($reg);

        return $data;
    }
}