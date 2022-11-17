<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ImportEducationFicheType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Langue', ChoiceType::class, [
                'choices'  => [
                    'Francais' => 'Francais',
                    'Espagnol' => 'Espagnol',
                    'Anglais' => 'Anglais'
                ],
            ]) 
            ->add('millieu', ChoiceType::class, [
                'choices'  => [
                    'urbain' => 'Milieu Urbain',
                    'moderne' => 'Milieu Moderne'
                ],
            ])
            ->add('fichier', FileType::class)
            ->add('importer', SubmitType::class, [
                'attr' => ['onclick' => "if(!confirm('Etes vous sûr de vouloir réaliser cette action ?')) { return false; }"],
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
