<?php

namespace App\Form;

use App\Entity\Comment;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // ->add('rating', IntegerType::class, [
            //     'required' => false,
            //     'attr' => [
            //         'class' => "inputrating"
            //     ]
            // ])

            ->add('comment', TextareaType::class, [
                'label' => 'Votre commentaire',
                'attr' => [
                    'placeholder' => "Qu'est ce que vous avez aimé dans ce produit"
                ]
            ])


            ->add('rating', HiddenType::class, [
                'attr' => [
                    'name' => "rating",
                    'id' =>"rating",
                    'value' => "0"
                ]

            ])


            ->add('submit', SubmitType::class, [
                'label' => 'Envoyer',
                'attr' => [
                    'class' => 'btn-block btn-info'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Comment::class,
        ]);
    }
}
