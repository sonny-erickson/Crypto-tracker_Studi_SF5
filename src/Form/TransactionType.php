<?php

namespace App\Form;

use App\Entity\Crypto;
use App\Entity\Transaction;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;




class TransactionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('n', EntityType::class,[
                'class' => Crypto::class,
                "label" => false,
                'multiple' => false,
                "required"  => true,
                "attr" => [
                    "class" => "form-control",
                    "placeholder" => "Sélectionner une crypto"

                ]
            ])
            ->add('quantity', NumberType::class,
                ['label' => false,
                    'html5' => true,
                    'attr' => [
                        'step' => 0.000001,
                        'min' => 0.000001,
                        "placeholder" => "Quantité",
                        "class" => "form-control"
                    ]
                ])
            ->add('price', NumberType::class,
                ['label' => false,
                    'html5' => true,
                    'attr' => [
                        'step' => 0.01,
                        'min' => 0.01,
                        "placeholder" => "Prix d'achat",
                        "class" => "form-control"
                    ]
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Transaction::class,
        ]);
    }
}
