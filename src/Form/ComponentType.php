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
            ->add('label', TextType::class, [
                'required' => false,
                'label' => 'component.form.label',
            ])
            ->add('description', TextType::class, [
                'required' => false,
                'label' => 'component.form.description',
            ])
            ->add('type', EntityType::class, [
                'required' => false,
                'class' => Type::class,
                'label' => 'component.form.type',
                'choice_label' => function ($type) {
                    return 'component.form.'.$type->getLabel();
                },
                'choice_translation_domain' => 'messages',
            ])
            ->add('link', TextType::class, [
                'required' => false,
                'label' => 'component.form.link',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Component::class,
            'validation_groups' => ['first_step'],
        ]);
    }
}