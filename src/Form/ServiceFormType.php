<?php

namespace App\Form;

use App\Entity\Service;
use DateTimeImmutable;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Event\PostSubmitEvent;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class ServiceFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label'=>'Title'
            ])
            ->add('slug', TextType::class, [
                'required'=>false
            ])
            ->add('description', TextareaType::class)
            ->add('Quote', TextareaType::class)
            ->add('image', FileType::class, [
                'mapped' => false,
                'required' => true,
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                            'image/gif',
                            'image/bmp',
                            'image/webp',
                            ],
                        'mimeTypesMessage' => 'Please upload a valid image document',
                    ])
                ],
            ])
            ->addEventListener(FormEvents::POST_SUBMIT, $this->attachTimesTamp(...))
            ->addEventListener(FormEvents::POST_SUBMIT, $this->archiveService(...))
        ;
    }

    public function attachTimesTamp(PostSubmitEvent $event):void
    {
        $data = $event->getData();
        if(!($data instanceof Service)){
            return;
        }

        $data->getUpdatedAt(new DateTimeImmutable());

        if(!$data->getId()){
            $data->setCreatedAt(new DateTimeImmutable());
        }
    }

    public function archiveService(PostSubmitEvent $event){
        $data = $event->getData();
        if(!$data->getId()){
            $data->setIsArchived(false);
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Service::class,
        ]);
    }
}
