<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Karser\Recaptcha3Bundle\Form\Recaptcha3Type;
use Karser\Recaptcha3Bundle\Validator\Constraints\Recaptcha3;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, [
                'label' => 'Prénom',
                'attr' => ['class' => 'input__field cf-validate form-control'], // for input
                'label_attr' => ['class' => 'mb-0 form-label'], // for labe
                'required' => true,
                'constraints' => [
                    new Assert\Length([
                        'min' => 2, 
                        'minMessage' => 'Le prénom doit comporter au moins 2 caractères',
                    ]),
                ],
            ])

            ->add('lastname', TextType::class, [
                'label' => 'Nom',
                'attr' => ['class' => 'input__field cf-validate'], // for input
                'label_attr' => ['class' => 'mb-0'],
                'required' => true,
                'constraints' => [
                    new Assert\Length([
                        'min' => 2, 
                        'minMessage' => 'Le nom doit comporter au moins 2 caractères',
                    ]),
                ],
            ])
            ->add('phoneNumber', TelType::class, [
                'label' => 'Téléphone',
                'attr' => ['class' => 'input__field cf-validate'], // for input
                'label_attr' => ['class' => 'mb-0'], // for labe
                'required' => false,
                /* constraints exactly ne fonctionnait pas ici, il est déplacé dans l entité */
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'attr' => ['class' => 'input__field cf-validate'], // for input
                'label_attr' => ['class' => 'mb-0'],
                'required' => true, // for labe
                'constraints' => [
                    new Assert\Email([
                        'message' => 'Veuillez entrer un email valide', 
                    ]),
                ]
            ])
            ->add('company', TextType::class, [
                'label' => 'Société',
                'attr' => ['class' => 'input__field cf-validate'], // for input
                'label_attr' => ['class' => 'mb-0'], // for labe
                'required' => false,
            ])
            ->add('subject', TextType::class, [
                'label' => 'Sujet',
                'attr' => ['class' => 'input__field cf-validate'], // for input
                'label_attr' => ['class' => 'mb-0'], // for labe
                'required' => true,
                'constraints' => [
                    new Assert\Length([
                        'min' => 5, 
                        'max' => 99, 
                        'minMessage' => 'Le sujet doit comporter au moins 5 caractères',
                        'maxMessage' => 'Le sujet doit comporter moins de 100 caractères',
                    ]),
                ],
            ])
            ->add('content', TextareaType::class, [
                'label' => 'Message',
                'attr' => ['class' => 'input__field cf-validate',  'rows'=> 5], // for input
                'label_attr' => ['class' => 'mb-0'], // for labe
                'required' => true,
                'constraints' => [
                    new Assert\Length([
                        'min' => 10, 
                        'max' => 500, 
                        'minMessage' => 'Le message doit faire entre 10 et 500 caractères',
                        'maxMessage' => 'Le message doit faire entre 10 et 500 caractères',
                    ]),
                ],
            ])
            ->add('captcha', Recaptcha3Type::class, [
                'constraints' => new Recaptcha3(['message' => 'Il y a un problème avec le captcha qui sécurise ce formulaire. Veuillez rééssayer en CLIQUANT SUR LE LIEN menu contact. Attention : actualiser la page n\'enlèverra pas cette erreur !!! Si toutefois cela ne fonctionnait toujours pas, veuillez nous contacter par téléphone et nous communiquer ce code d\'erreur : {{ errorCodes }}']),
                'action_name' => 'contact',

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
