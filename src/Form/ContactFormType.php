<?php

namespace App\Form;

use App\Entity\Message;
use DateTimeImmutable;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\Event\PostSubmitEvent;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('senderFname', TextType::class, [
            'label' => 'Vorname',
            'attr' => [
                'placeholder' => '*Vorname',
                'data-error' => 'Firstname is required.',
                'class' => 'form-control custom-form'
            ]
        ])
        ->add('senderLname', TextType::class, [
            'label' => 'Nachname',
            'attr' => [
                'placeholder' => '*Nachname',
                'required' => true,
                'data-error' => 'Lastname is required.',
                'class' => 'form-control custom-form'
            ]
        ])
        ->add('senderEmail', EmailType::class, [
            'label' => 'E-Mail ',
            'attr' => [
                'placeholder' => '*E-Mail ',
                'required' => true,
                'data-error' => 'Valid email is required.',
                'class' => 'form-control custom-form'
            ]
        ])
        ->add('content', TextareaType::class, [
            'label' => 'Ihr Anliegen',
            'attr' => [
                'placeholder' => '*Ihr Anliegen',
                'rows' => 6,
                'required' => true,
                'data-error' => 'Please,leave us a message.',
                'class' => 'form-control custom-form message-form',
                
            ]
        ])
        ->add('subject', TextType::class, [
            'label' => '*Betreff',
            'attr' => [
            'required' => true ,
            'placeholder' => '*Stadt',
            'data-error' => 'Subject is required.',
            'class' => 'form-control custom-form'
            ]
        ])
        
        ->add('city', TextType::class, [
            'label' => 'Stadt',
            'attr' => [
                'placeholder' => '*Stadt',
                'required' => true,
                'data-error' => 'City is required.',
                'class' => 'form-control custom-form'
            ]
        ])
        ->add('phoneNumber', TextType::class, [
            'label' => 'Telefonnummer',
            'attr' => [
                'placeholder' => '*Telefonnummer',
                'required' => true,
                'data-error' => 'Phone number is required.',
                'class' => 'form-control custom-form'
            ]
        ])
        ->add('company', TextType::class, [
            'label' => 'Unternehmen',
            'attr' => [
            'required' => false,
            'placeholder' => '*Unternehmen',
            'class' => 'form-control custom-form'
            ]
        ])
        ->addEventListener(FormEvents::POST_SUBMIT, $this->attachTimesTamp(...))
        ;
    }
        
    


    public function attachTimesTamp(PostSubmitEvent $event):void
    {
        $data = $event->getData();
        if(!($data instanceof Message)){
            return;
        }
        $data->setCreatedAt(new DateTimeImmutable());
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Message::class,
        ]);
    }
}
