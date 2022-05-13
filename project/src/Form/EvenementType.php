<?php

namespace App\Form;

use App\Entity\Evenement;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EvenementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date', DateType::class, array(
                "widget" => 'single_text',
                "format" => 'dd-MM-yyyy',
                "data" => new \DateTime(),
                "html5" => false,
            ))
            ->add('theme', TextType::class, array(
                'row_attr' => array(
                    'class' => 'required'
                )
            ))
            ->add('nbInvite', NumberType::class, array(
                'row_attr' => array(
                    'class' => 'required'
                )
            ))
            ->add('occasion', TextType::class, array(
                'row_attr' => array(
                    'class' => 'required'
                )
            ))
            ->add('lieux', TextType::class, array(
                'row_attr' => array(
                    'class' => 'required'
                )
            ))
            ->add('password', PasswordType::class, array(
                'row_attr' => array(
                    'class' => 'required'
                )
            ));
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Evenement::class,
        ]);
    }
}
