<?php

namespace App\Form;

use App\Entity\Evenement;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
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
                "html5" => false
            ))
            ->add('theme')
            ->add('nbInvite')
            ->add('occasion')
            ->add('lieux');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Evenement::class,
        ]);
    }
}
