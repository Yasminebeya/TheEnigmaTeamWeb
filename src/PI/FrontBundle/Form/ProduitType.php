<?php

namespace PI\FrontBundle\Form;

use blackknight467\StarRatingBundle\Form\RatingType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProduitType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('typeproduit',TextType::class)
            ->add('Libelle',TextType::class)
            ->add('prix',IntegerType::class)
            ->add('description',TextType::class)
            ->add('quantite',IntegerType::class)
            ->add('file')
         ->add('rating', RatingType::class, [
             'label' => 'Rating'
         ]);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PI\FrontBundle\Entity\Produit'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'pi_frontbundle_produit';
    }


}
