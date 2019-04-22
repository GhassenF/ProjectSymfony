<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title')
            ->add('description')
            ->add('localisation')
            ->add('etablissement')
            ->add('prix')
            // ->add('date')
            ->add('category',ChoiceType::class,
                ['choices' => [
                    '' => [
                        'Evénement '=>'Evénement',
                        'Conférence '=>'Conférence',
                        'Compétition '=>'Compétition'
                    ],
                ],
                ])
            //   'choices_as_values'=>true,'multiple'=>false,'expanded'=>true
            // ))
            ->add('imagepath',FileType::class,array('label'=>'','data_class'=>null) );

    }/**
 * {@inheritdoc}
 */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Event'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_event';
    }


}
