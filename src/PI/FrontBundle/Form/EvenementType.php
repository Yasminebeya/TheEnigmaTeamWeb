<?php

namespace PI\FrontBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class EvenementType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('categorie', ChoiceType::class, array(
            'choices'=>array(""=>"",'Professionel'=>'professionnel','Loisirs'=>'Loisirs')
        ),array('attr' => array('style' => 'width: 125%')))
            ->add('nom',TextType::class,array('attr' => array('style' => 'width: 125%')))
            ->add('lat',TextType::class,array('attr' => array('style' => 'width: 125%')))
            ->add('lon',TextType::class,array('attr' => array('style' => 'width: 125%')))
            ->add('nbrelimite',TextType::class,array('attr' => array('style' => 'width: 125%')))
            ->add('description',TextType::class,array('attr' => array('style' => 'width: 125%')))
            ->add('datedebut',DateType::class)
            ->add('datefin',DateType::class)
            ->add('modifier',SubmitType::class)
      ;

    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PI\FrontBundle\Entity\Evenement'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'pi_frontbundle_evenement';
    }


}
