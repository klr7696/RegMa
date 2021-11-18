<?php


namespace App\Events;


use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\Profil;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class HashEvent implements EventSubscriberInterface
{
    private $hash;
    public function __construct(UserPasswordHasherInterface $hash)
    {
        $this->hash= $hash;

    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW =>['hashPassword', EventPriorities::PRE_WRITE ]

        ];
    }
    public function hashPassword(ViewEvent $event)
    {
        $result = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        if ($result instanceof Profil && $method === "POST") {
            $hashes = $this->hash->hashPassword($result, $result->getPassword());
            $result->setPassword($hashes);
        }
    }
}