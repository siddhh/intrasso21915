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

class RegistrationFormType extends AbstractType
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
            ->add('plainPassword', PasswordType::class, [
                // au lieu d'être placé directement sur l'objet
                // ceci est lu et encodé dans le contrôleur
                'mapped' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez sasir un mot de passe',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // longueur maximale autorisée par Symfony pour des raisons de sécurité 
                        'max' => 4096,
                    ]),
                ],
            ])   
        ;
        // Permet de convertir la valeur unique sélectionné dans la liste des roles en liste de roles utilisée par l'entité
        // $builder->get('roles')->addModelTransformer(new CallbackTransformer(
        //     function (array $rolesArray) {
        //         return reset($rolesArray);
        //     },
        //     function (string $rolesString) {
        //         return [$rolesString];
        //     }
        // ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
