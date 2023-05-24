<?php

namespace App\EventListener;

use Doctrine\Common\EventSubscriber;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Entity\Admin;

class AdminListener implements EventSubscriber
{
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        if ($entity instanceof Admin) {
            $encodedPassword = $this->passwordHasher->hashPassword($entity, $entity->getPassword());
            $entity->setPassword($encodedPassword);
            $entity->setRoles(['ROLE_ADMIN']);
        }
    }

    public function preUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        if ($entity instanceof Admin && $entity->getPassword() !== null) {
            $encodedPassword = $this->passwordHasher->hashPassword($entity, $entity->getPassword());
            $entity->setPassword($encodedPassword);
        }
    }

    public function getSubscribedEvents()
    {
        return [
            Events::prePersist,
            Events::preUpdate,
        ];
    }
}
