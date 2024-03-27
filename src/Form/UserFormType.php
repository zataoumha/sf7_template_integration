<?php

namespace App\Form;

use App\Entity\User;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label'=>'Email',
                'required'=>true
            ])
            ->add('firstName', TextType::class, [
                'required' => true,
                'label'=>'First Name',
                'required'=>true
            ])
            ->add('lastName', TextType::class, [
                'required' => true,
                'label'=>'Last Name',
                'required'=>true
            ])
            ->add('roles', ChoiceType::class, [
                'required' => true,
                'choices'  => [
                    'Administrator' => 'ROLE_ADMIN',
                    'Manager' => 'ROLE_MANAGER',
                ],
                'mapped'=>false,
                //'multiple' => true,
                'expanded' => false,
            ])
            ->add('password', PasswordType::class, [
                'required' => true,
                'label'=>'Password',
            ])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
