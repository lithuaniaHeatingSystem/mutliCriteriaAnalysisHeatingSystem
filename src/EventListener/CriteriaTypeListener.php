<?php

namespace App\EventListener;

use App\Entity\Component;
use App\Entity\ComponentCriteria;
use App\Entity\CriteriaType;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class CriteriaTypeListener
{
    /**
     * Add all component criteria according to the new criteria type
     *
     * @param LifecycleEventArgs $args
     */
    public function postPersist(LifecycleEventArgs $args)
    {
        /** @var CriteriaType $entity */
        $entity = $args->getObject();

        if (!$entity instanceof CriteriaType) {
            return;
        }

        $entityManager = $args->getObjectManager();
        $components = $entityManager->getRepository(Component::class)->findBy(['type' => $entity->getType()]);
        foreach ($components as $component) {
            $component->addComponentCriteria((new ComponentCriteria())->setCriteria($entity->getCriteria())->setValue(1));
            $entityManager->persist($component);
        }

        $entityManager->flush();
    }

    /**
     * Remove all component criteria according to the delete criteria type
     *
     * @param LifecycleEventArgs $args
     */
    public function preRemove(LifecycleEventArgs $args)
    {
        /** @var CriteriaType $entity */
        $entity = $args->getObject();

        if (!$entity instanceof CriteriaType) {
            return;
        }
        $entityManager = $args->getObjectManager();

        $components = $entityManager->getRepository(Component::class)->findBy(['type' => $entity->getType()]);
        foreach ($components as $component) {
            foreach ($component->getComponentCriterias() as $componentCriteria) {
                if ($componentCriteria->getCriteria() === $entity->getCriteria()) {
                    $component->removeComponentCriteria($componentCriteria);
                }
            }
            $entityManager->persist($component);
        }
        $entityManager->flush();
    }
}