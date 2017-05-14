<?php


namespace PI\FrontBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MailType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder
        ->add('nom',TextType::class,array('attr' => array('style' => 'width: 100%')))
            ->add('prenom',TextType::class,array('attr' => array('style' => 'width: 100%')))
            ->add('email',EmailType::class,array('attr' => array('style' => 'width: 100%')))
            ->add('text',TextareaType::class);

    }

    public function getName() {

        return 'Mail';
    }

}
