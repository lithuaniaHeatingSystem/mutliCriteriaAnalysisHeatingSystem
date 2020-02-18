<?php

namespace App\Form;

use App\Entity\Component;
use App\Entity\Type;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ComponentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('label', TextType::class, ['required' => false])
            ->add('description', TextType::class, ['required' => false])
            ->add('link', TextType::class, ['required' => false])
            ->add('componentCriterias', )
            ->add('type', EntityType::class, array(
                'class' => Type::class,
                'choice_label' => 'label',
                'multiple' => false,
                'required' => false
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Component::class,
        ]);
    }
}