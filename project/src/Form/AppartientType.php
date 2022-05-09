<?php

namespace App\Form;

use App\Entity\Appartient;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AppartientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('importance', ChoiceType::class, [
                'choices' => [
                    'Obligatoire' => 'Obligatoire',
                    'Recommandée' => "Recommandée",
                    'Si possible' => 'Si possible',
                ],
            ])
            ->add('idList')
            ->add('idMusique')
            ->add('save', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Appartient::class,
        ]);
    }
}
