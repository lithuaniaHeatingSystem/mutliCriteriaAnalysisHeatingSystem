<?php

namespace App\Form;

use App\Entity\ComponentCriteria;
use App\Entity\Criteria;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ComponentCriteriaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('criteria', EntityType::class, ['class' => Criteria::class, 'required' => false, 'multiple' => false])
            ->add('value', IntegerType::class, ['required' => false]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ComponentCriteria::class,
        ]);
    }
}