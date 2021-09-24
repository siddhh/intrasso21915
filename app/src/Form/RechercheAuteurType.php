<?php

namespace App\Form;

use App\Entity\Auteur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ArrayType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class RechercheAuteurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('vuePredefinie', ChoiceType::class, [
<<<<<<< HEAD
                'required'    => false,
=======
                'required'    => false, 
>>>>>>> e07df1b42cd2f756d7dd6991eeab3e1c70e30a8b
                'choices'     => [
                    '1 - Auteurs non-Supprimés'               => "1",
                    '2 - Auteurs supprimés'                   => "2",
                    '3 - Auteurs supprimés  et non-supprimés' => "3",
<<<<<<< HEAD

=======
                    
>>>>>>> e07df1b42cd2f756d7dd6991eeab3e1c70e30a8b
                ],
            ])
        ;
    }
}
