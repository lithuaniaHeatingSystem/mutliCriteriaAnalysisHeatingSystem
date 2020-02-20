<?php

namespace App\EventListener;

use App\Entity\Component;
use App\Entity\ComponentCriteria;
use App\Entity\CriteriaType;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class ComponentListener
{
    /**
     * Add all component criteria according to the new component type
     *
     * @param LifecycleEventArgs $args
     */
    public function postPersist(LifecycleEventArgs $args)
    {
        /** @var CriteriaType $entity */
        $entity = $args->getObject();

        if (!$entity instanceof Component) {
            return;
        }
        $entityManager = $args->getObjectManager();
        $criteriaTypes = $entityManager->getRepository(CriteriaType::class)->findBy(['type' => $entity->getType()]);
        foreach ($criteriaTypes as $criteriaType) {
            if (!$entity->getCriterias()->contains($criteriaType->getCriteria())) {
                $entity->addComponentCriteria((new ComponentCriteria())->setCriteria($criteriaType->getCriteria())->setValue(1));
            }
            $entityManager->persist($entity);
        }
        $entityManager->flush();
    }
}