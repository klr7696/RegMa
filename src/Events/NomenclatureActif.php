<?php


namespace App\Events;


use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\Nomenclatures\Nomenclature;
use App\Repository\Nomenclatures\NomenclatureRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;


class NomenclatureActif implements EventSubscriberInterface
{
/*private $precedent;
public function __construct(NomenclatureRepository  $precedent)
{
    $this->precedent = $precedent;
}*/

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW =>['actifNomenclature', EventPriorities::PRE_WRITE ]

        ];
    }
    public function actifNomenclature(ViewEvent $event) {
        $result= $event->getControllerResult();
        $method= $event->getRequest()->getMethod();

        if($result instanceof Nomenclature && $method ==="PATCH")
        {


            $result->setEstActif(false);
        }

    }
}