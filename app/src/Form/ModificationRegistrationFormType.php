<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class ModificationRegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // met en forme la liste de choix des roles utilisée plus loin dans cette méthode
        $choixRoles = [];
        foreach (User::listeRoles() as $role) {
            switch ($role) {
                case 'ROLE_ADMIN':
                    $choixRoles['Administrateur'] = $role;
                    break;
                case 'ROLE_USER':
                    $choixRoles['Adhérent'] = $role;
                    break;
                default:
                    $choixRoles['Adhérent'] = 'ROLE_USER';
            }
        }
        $builder
            ->add('email')
            ->add('prenom')
            ->add('nom')
            ->add('roles', ChoiceType::class, [
                'choices'   => $choixRoles,
                'mapped'    => true,
                'multiple'  => false,
                'required'  => true,
            ])
            ->add('nbrEmpruntPossible', IntegerType::class, [
            ])
            ->add('actif', CheckboxType::class, [
                'required'  => false,

            ])
            ->add('isVerified', CheckboxType::class, [
                'disabled' => true,
<<<<<<< HEAD
                ])
=======
                ])   
>>>>>>> e07df1b42cd2f756d7dd6991eeab3e1c70e30a8b
        ;
        // Permet de convertir la valeur unique sélectionné dans la liste des roles en liste de roles utilisée par l'entité
        $builder->get('roles')->addModelTransformer(new CallbackTransformer(
            function (array $rolesArray) {
                return reset($rolesArray);
            },
            function (string $rolesString) {
                return [$rolesString];
            }
        ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
