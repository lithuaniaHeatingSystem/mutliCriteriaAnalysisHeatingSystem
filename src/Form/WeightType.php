<?php

namespace App\Form;

use App\Entity\CriteriaType;
use App\Model\WeightModel;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WeightType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('weight', IntegerType::class, [
                'required' => false,
            ])
            ->add('criteriaType', EntityType::class, [
                'class' => CriteriaType::class,
                'required' => false,
                'multiple' => false,
                'disabled' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
                'data_class' => WeightModel::class,
            ]
        );
    }
}