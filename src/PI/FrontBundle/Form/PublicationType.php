<?php

namespace PI\FrontBundle\Form;

use PI\FrontBundle\Entity\Publication;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PublicationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('text',TextareaType::class,array('label' => 'Ajouter votre statut','required' => false))
            ->add('file',FileType::class,array('label' => 'Telecharger une image','data_class' => null,'required' => false));
            //, FileType::class, array('label' => 'Telecharger une image'))//

    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PI\FrontBundle\Entity\Publication'
        ));
       $resolver->setDefaults(array(
            'data_class' => Publication::class,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'pi_frontbundle_publication';
    }


}
