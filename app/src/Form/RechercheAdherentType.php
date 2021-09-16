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
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class RechercheAdherentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // Met en forme la liste de choix des roles utilisée plus loin dans cette méthode
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
            
            ->add('prenom', TextType::class, [
                'required' => false,
            ])
            ->add('nom', TextType::class, [
                'required' => false,
            ])
            ->add('email', EmailType::class, [
                'required' => false,
            ])
            // ->add('nbrEmpruntPossible', IntegerType::class, [
            //     'required' => false,
            // ])

            // ->add('roles', ChoiceType::class, [
            //     'choices' => $choixRoles,
            //     'placeholder' => "",     
            //     'mapped' => true,
            //     'multiple' => false,
            //     'required' => false,
            // ])
            // ->add('isVerified', ChoiceType::class, [
            //     'required'      => false,
            //     'placeholder'     => 'Non',
            //     'choices'       => [
            //         'Oui' => true,
            //         'Non' => false,
            //     ]
            // ])
            // ->add('actif', ChoiceType::class, [
            //     'required'      => false,
            //     'choices'       => [
            //         'Tous' => null, 
            //         'Oui' => true,
            //         'Non' => false,
                    
            //     ]
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
