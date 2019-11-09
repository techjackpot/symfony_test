<?php

namespace App\EventListener;

use App\Client\GoogleGeocoderClient;
use App\Entity\Location;
use Doctrine\Common\EventSubscriber;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;

class LocationSubscriber implements EventSubscriber
{
    /**
     * @var GoogleGeocoderClient
     */
    private $client;

    public function __construct(GoogleGeocoderClient $client)
    {
        $this->client = $client;
    }

    public function getSubscribedEvents()
    {
        return [
            Events::prePersist,
            Events::preUpdate,
        ];
    }

    public function preUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();
        $changeSet = $args->getEntityManager()->getUnitOfWork()->getEntityChangeSet($entity);

        if ($entity instanceof Location && isset($changeSet['address'])) {
            $point = $this->client->getPointFromAddress($entity->getAddress());
            $entity->setPoint($point);
        }
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        if ($entity instanceof Location) {
            $point = $this->client->getPointFromAddress($entity->getAddress());
            $entity->setPoint($point);
        }
    }
}