<?php

namespace App\Form;

use App\Entity\CollectionCategory;
use App\Entity\ItemsCollection;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ItemsCollectionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('Category', EntityType::class, [
                    'class' => CollectionCategory::class,
                    'choice_label' => 'name',
                ]
            )
            ->add('string_property_name_1')
            ->add('string_property_name_2')
            ->add('string_property_name_3')
            ->add('text_property_name_1')
            ->add('text_property_name_2')
            ->add('text_property_name_3')
            ->add('numericPropertyName1')
            ->add('numericPropertyName2')
            ->add('numericPropertyName3')
            ->add('datePropertyName1')
            ->add('datePropertyName2')
            ->add('datePropertyName3')
            ->add('boolPropertyName1')
            ->add('boolPropertyName2')
            ->add('boolPropertyName3')
            ->add('description')
            ->add('save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ItemsCollection::class,
        ]);
    }
}
