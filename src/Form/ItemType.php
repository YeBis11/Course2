<?php

namespace App\Form;

use App\Entity\DateField;
use App\Entity\Item;
use App\Entity\TextField;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ItemType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('name')
            ->add('stringFields', CollectionType::class, [
                'entry_type' => StringFieldType::class,
                'entry_options' => ['label' => false],
                'label' => false,
                'required' => false,
            ])
            ->add('textFields', CollectionType::class, [
                'entry_type' => TextFieldType::class,
                'entry_options' => ['label' => false],
                'label' => false,
                'required' => false,
                ])
            ->add('dateFields', CollectionType::class, [
                'entry_type' => DateFieldType::class,
                'entry_options' => ['label' => false],
                'label' => false,
                'required' => false,
            ])
            ->add('numericFields', CollectionType::class, [
                'entry_type' => NumericFieldType::class,
                'entry_options' => ['label' => false],
                'label' => false,
                'required' => false,
            ])
            ->add('boolFields', CollectionType::class, [
                'entry_type' => BoolFieldType::class,
                'entry_options' => ['label' => false],
                'label' => false,
                'required' => false,
            ])
            ->add('submit', SubmitType::class);


    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Item::class,
        ]);
    }
}
