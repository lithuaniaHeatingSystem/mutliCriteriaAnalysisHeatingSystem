<?php

namespace App\Form;

use App\Entity\CriteriaType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CriteriaTypeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            $criteriaType = $event->getData();
            $form = $event->getForm();
            $form->add('isChecked', CheckboxType::class, [
                'mapped' => false,
                'required' => false,
                'data' => $criteriaType->getId() ? true : false,
            ]);
        });

        $builder
            ->add('isPositive', CheckboxType::class, [
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CriteriaType::class,
        ]);
    }
}