<?php

namespace App\Form;

use App\Entity\Avis;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AvisType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('occasion',TextType::class,array(
                'attr' => array(
                    'placeholder' => 'Occasion'
                )
            ))
            ->add('content',TextareaType::class,array (
                'attr' => array(
                'placeholder' => 'Occasion'
                )
            ))
            ->add('auteur',TextType::class,array (
                'attr' => array(
                    'placeholder' => 'Nom'
                    )
                ))
            ->add('note',NumberType::class,array (
                'attr' => array(
                    'placeholder' => 'Note/5'
                ))
                )
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Avis::class,
        ]);
    }
}
