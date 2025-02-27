<?php

namespace App\Form;

use App\Entity\Books;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class BooksType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('saga')
            ->add('number')
            ->add('authorsText', TextType::class, [
                'label' => 'Authors (comma separated)',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Enter authors separated by commas',
                ],
            ])
            ->add('genresText', TextType::class, [
                'label' => 'Genres (comma separated)',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Enter genres separated by commas',
                ],
            ])
            ->add('month_of_purchase', DateType::class, [
                'widget' => 'single_text',
                'required' => false,
                'label' => 'Month of Purchase',
            ])
            ->add('number_of_page');

        if ($options['update']) {
            $builder
                ->add('readingStatus', ChoiceType::class, [
                    'choices' => [
                        'To Read' => 'to_read',
                        'Reading' => 'reading',
                        'Finished' => 'finished',
                        'Abandoned' => 'abandoned',
                    ],
                    'label' => 'Reading Status'
                ])
                ->add('rating', IntegerType::class, [
                    'required' => false,
                    'label' => 'Rating',
                ]);
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Books::class,
            'update' => false,
        ]);
    }
}
