<?php

namespace App\Form;

use App\Entity\ElementDonneeValeur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ElementDonneValeurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('value')
            ->add('datedata')
            ->add('sexe')
            ->add('elementdonnee')
            ->add('provences')
            ->add('Modifier', SubmitType::class, [
                'attr' => ['onclick' => "if(!confirm('Etes vous sûr de vouloir réaliser cette action ?')) { return false; }"],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ElementDonneeValeur::class,
        ]);
    }
}
