<?php


namespace App\Controller;


use App\Entity\Prevision\ExerciceRegistre;

class OuvrirRegistreController
{
public function __invoke(ExerciceRegistre $data): ExerciceRegistre
{
   $data->setEstEnCours(true);
   return $data;
}
}