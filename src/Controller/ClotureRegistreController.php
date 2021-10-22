<?php


namespace App\Controller;


use App\Entity\Prevision\ExerciceRegistre;

class ClotureRegistreController
{
public function __invoke(ExerciceRegistre $data):ExerciceRegistre
{
    $data->setEstEnCours(false);
    return $data;
}
}