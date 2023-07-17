<?php

namespace App\Form;

use App\Entity\Car;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class CarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Brand')
            ->add('Model')
            ->add('Price')
            ->add('Year')
            ->add('KM')
            ->add('power')
            ->add('commentaire')
            ->add('mainImage', FileType::class,  [
                'mapped' => false,
                'required' => true,
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/bmp',
                            'image/png',],
                        'mimeTypesMessage' => 'Le type du fichier n\'est pas correct',
                    ])
                ],
            ])
            ->add('img2', FileType::class,  [
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/bmp',
                            'image/png',],
                        'mimeTypesMessage' => 'Le type du fichier n\'est pas correct',
                    ])
                ],
            ])
            ->add('img3', FileType::class,  [
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/bmp',
                            'image/png',],
                        'mimeTypesMessage' => 'Le type du fichier n\'est pas correct',
                    ])
                ],
            ])
            ->add('img4', FileType::class,  [
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/bmp',
                            'image/png',],
                        'mimeTypesMessage' => 'Le type du fichier n\'est pas correct',
                    ])
                ],
            ])
            ->add('Climatisation')
            ->add('Centralisation')
            ->add('RegLimVitesse')
            ->add('Auto')
            ->add('ToitOuvrant')
            ->add('energy')
            ->add('Valider', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Car::class,
        ]);
    }
}
