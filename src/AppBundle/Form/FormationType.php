<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;


use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FormationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('titre',TextType::class,[
            'attr' => [
                'placeholder' => 'titre',
                'class'       => 'form-control'
            ]
        ])

            ->add('description', TextareaType::class)
            ->add('etablissement')
            ->add('dateDebut')
            ->add('dateFin')
            ->add('prix')

            ->add('save', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary '
                ],
            ]);

    }/**
 * {@inheritdoc}
 */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Formation'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_formation';
    }


}