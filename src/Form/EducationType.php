<?php

namespace App\Form;

use App\Entity\Education;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EducationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Nbrefe')
            ->add('Nbreh')
            ->add('Source')
            ->add('annee')
            ->add('niveau')
            ->add('indicateur')
            ->add('province')
            ->add('Modifier', SubmitType::class, [
                'attr' => ['onclick' => "if(!confirm('Etes vous sûr de vouloir réaliser cette action ?')) { return false; }"],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Education::class,
        ]);
    }
}
