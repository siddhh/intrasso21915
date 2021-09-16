<?php

namespace App\Form;

use App\Entity\Nature;
use App\Entity\Genre;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;

class RechercheNatureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('label')
            ->add('genres', EntityType::class, [
                'class' => Genre::class,
                'choice_label' => 'label',
                'multiple' => true,
                'expanded' => false,
                //'label' => 'Equipe :',
                //'placeholder' => 'Saisir...',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('g')
                    ;
                }
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Nature::class,
        ]);
    }
}
