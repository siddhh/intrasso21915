<?php

namespace App\Form;

use App\Entity\Genre;
use App\Entity\Nature;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class GenreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('label', TextType::class, [
                'required' => true,
            ])
            // ->add('natures', EntityType::class, [
            //     'class' => Nature::class,
            //     'choice_label' => 'label',
            //     'multiple' => true,
            //     'expanded' => false,
            //     'required' => true,
            //     //'label' => 'Equipe :',
            //     //'placeholder' => 'Saisir...',
            //     'query_builder' => function (EntityRepository $er) {
            //         return $er->createQueryBuilder('n')
            //         ;
            //     }
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Genre::class,
        ]);
    }
}
