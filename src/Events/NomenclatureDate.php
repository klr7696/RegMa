<?php


namespace App\Events;


use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\Nomenclatures\Nomenclature;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class NomenclatureDate implements EventSubscriberInterface
{

    public static function getSubscribedEvents()
    {
        return[
            KernelEvents::VIEW =>['dateFormatage', EventPriorities::PRE_SERIALIZE]
           ];
    }
    public function dateformatage(ViewEvent $event){
        $result= $event->getControllerResult();
        $method= $event->getRequest()->getMethod();

        if($result instanceof Nomenclature && $method ==="GET")
        {
            $date= $result->getDateAdoption();

        }
    }
}