<?php

namespace App\EventSubscriber;

use App\Entity\Article;
use Doctrine\ORM\Events;
use Doctrine\ORM\Event\PreRemoveEventArgs;
use Symfony\Component\Filesystem\Filesystem;
use Doctrine\Bundle\DoctrineBundle\EventSubscriber\EventSubscriberInterface;

class DeleteImageSubscriber implements EventSubscriberInterface
{
    public function __construct(private Filesystem $filesystem)
    {
    }

    public function getSubscribedEvents()
    {
        return [
            Events::preRemove,
        ];
    }

    public function preRemove(PreRemoveEventArgs $preRemove)
    {
        $entity = $preRemove->getObject();

        if (!($entity instanceof Article)) {
            return;
        }

        $this->filesystem->remove('uploads/images/' . $entity->getMainImage());
    }
}