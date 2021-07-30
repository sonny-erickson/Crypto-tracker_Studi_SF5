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
            ->add('crypto', EntityType::class,[
                'class' => Crypto::class,
                "label" => false,
                'multiple' => false,
                "required"  => true,
                "attr" => [
                    "class" => "form-control",
                    "placeholder" => "Sélectionner une crypto"
                ]
            ])
            ->add('price', NumberType::class,
                ['label' => false,
                    'html5' => true,
                    'attr' => [
                        'step' => 0.0001,
                        'min' => 0.0001,
                        "placeholder" => "Buy price",
                        "class" => "form-control"
                    ]
                ])
            ->add('quantity', NumberType::class,
                ['label' => false,
                    'html5' => true,
                    'attr' => [
                        'step' => 0.00001,
                        'min' => 0.00001,
                        "placeholder" => "Quantity",
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
