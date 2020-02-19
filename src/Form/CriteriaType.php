<?php

namespace App\Form;

use App\Entity\Criteria;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CriteriaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('label', TextType::class, ['required' => false])
            ->add('description', TextType::class, ['required' => false])
            ->add('unit', TextType::class, ['required' => false])
            ->add('criteriaTypes', CollectionType::class, [
                'entry_type' => CriteriaTypeType::class,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Criteria::class,
        ]);
    }
}