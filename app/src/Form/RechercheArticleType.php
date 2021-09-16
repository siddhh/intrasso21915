<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Langage;
use App\Entity\Auteur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class RechercheArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre', TextType::class, [
                'required' => false,
            ])
            ->add('estEmprunte', ChoiceType::class, [
                'choices'           => [
                    'Non'   => 0,
                    'Oui'   => 1,
                ],
                'empty_data' => 0
            ])
            
            ->add('auteurs', EntityType::class, [
                'class' => Auteur::class,
                'placeholder' => '',
                'choice_label' => 'nomComplet',
                'multiple' => false,
                'translation_domain' => 'Default',
                'expanded' => false,
                'required' => false,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('a')
                        ;
                }
            ])
            ->add('langages', EntityType::class, [
                'class' => Langage::class,
                'choice_label' => 'label',
                'multiple' => false,
                'expanded' => false,
                'required' => false,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('l')
                        ;
                }
            ])
            // ->add('proprietaire')
            // ->add('emprunteur')
            // ->add('categorie')
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
