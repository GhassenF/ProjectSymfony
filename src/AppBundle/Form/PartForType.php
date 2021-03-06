<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;


use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PartForType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('prenom',TextType::class)
            ->add('nom',textType::class)
            ->add('mail',TextType::class)
            ->add('cin',TextType::class)
            ->add('adresse',TextType::class)
            ->add('numtelephone',TextType::class)
            ->add('save', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary '
                ],
            ]);

    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Participantformation'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_participantformation';
    }


}