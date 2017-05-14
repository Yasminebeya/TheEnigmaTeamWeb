<?php

namespace PI\FrontBundle\Form;

use PI\FrontBundle\Entity\Publication;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use EWZ\Bundle\RecaptchaBundle\Form\Type\EWZRecaptchaType;
use EWZ\Bundle\RecaptchaBundle\Validator\Constraints\IsTrue as RecaptchaTrue;


use EWZ\Bundle\RecaptchaBundle\Validator\Constraints as Recaptcha;



class CaptchaType extends AbstractType
{

    /**
     * {@inheritdoc}
     */

    /**
     * @Recaptcha\IsTrue
     */
    public $recaptcha;

    /**
     * @return mixed
     */
    public function getRecaptcha()
    {
        return $this->recaptcha;
    }

    /**
     * @param mixed $recaptcha
     */
    public function setRecaptcha($recaptcha)
    {
        $this->recaptcha = $recaptcha;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // ...
        $builder->add('recaptcha', EWZRecaptchaType::class, array(
            'attr'        => array(
                'options' => array(
                    'theme' => 'light',
                    'type'  => 'image',
                    'size'  => 'normal'
                )
            ),
            'mapped'      => false,
            'constraints' => array(
                new RecaptchaTrue()
            )
        ));


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
        $collectionConstraint = new Collection(array(
            'recaptcha' => new Recaptcha(),
        ));

        return array(
            'data_class' => 'Acme\MyBundle\Entity\User',
            'validation_constraint' => $collectionConstraint,
        );

    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'pi_frontbundle_publication';

    }


}
