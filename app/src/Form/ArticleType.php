<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Langage;
use App\Entity\Auteur;
use App\Entity\Nature;
use App\Entity\Genre;
use App\Entity\User;
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
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
<<<<<<< HEAD
                'image',
                FileType::class,
                [
                    'required' => false,
                    'data_class' => null
                ]
            )
=======
                'image', FileType::class, [
                    'required' => false,
                    'data_class' => null
                ])
>>>>>>> e07df1b42cd2f756d7dd6991eeab3e1c70e30a8b

            ->add('natures', EntityType::class, [
                'class' => Nature::class,
                'placeholder' => '',
                'choice_label' => 'label',
                'multiple' => true,
                'expanded' => false,
                'required' => false,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('n')
                    ->addSelect('g')
                    ->join('n.genres', 'g')
                    ->orderBy('UPPER(n.label)', 'ASC')
                    ;
                }
            ])
<<<<<<< HEAD
            ->add(
                'genresBis',
                EntityType::class,
                [
=======
            ->add('genresBis',
                EntityType::class, [
>>>>>>> e07df1b42cd2f756d7dd6991eeab3e1c70e30a8b
                'class' => Genre::class,
                'placeholder' => '',
                'choice_label' => 'label',
                'multiple' => true,
                'expanded' => false,
                'required' => false,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('g')
<<<<<<< HEAD
                    ->orderBy('UPPER(g.label)', 'ASC');
                    ;
                }
            ]
            )
=======
                    ->orderBy('UPPER(g.label)', 'ASC');                    ;
                }
            ])
>>>>>>> e07df1b42cd2f756d7dd6991eeab3e1c70e30a8b
            ->add('titre', TextType::class, [
                'required' => true,
            ])
            ->add('commentaire', TextareaType::class, [
                'required' => false,
            ])
            ->add('auteurs', EntityType::class, [
                'class' => Auteur::class,
                'placeholder' => '',
                'choice_label' => 'nomCompletCourt',
                'multiple' => true,
                'expanded' => false,
                'required' => true,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('a')
                    ->orderBy('UPPER(a.nom)', 'ASC')
                    ;
                }
            ])
            ->add('langages', EntityType::class, [
                'class' => Langage::class,
                'choice_label' => 'label',
                'multiple' => true,
                'expanded' => false,
                'required' => false,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('l')
                        ;
                }
            ])
            ->add('proprietaire', EntityType::class, [
                'class' => User::class,
                'placeholder' => '',
                'choice_label' => 'nomCompletCourt',
                'multiple' => false,
                'translation_domain' => 'Default',
                'expanded' => false,
                'required' => true,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ;
                }
            ])
            ->add('emprunteur', TextType::class, [
                'disabled' => true,
            ])
            ->add('dateRestitution', DateType::class, [
                'label' => 'Date limite de réponse',
                'format' => 'dd/MM/yyyy',
                'widget' => 'single_text',
                'required' => false,
                'disabled' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
