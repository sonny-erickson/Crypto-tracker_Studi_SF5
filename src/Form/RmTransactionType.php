<?php

namespace App\Form;

use App\Entity\Crypto;
use App\Entity\Transaction;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Validator\Constraints\Negative;
use Symfony\Component\Validator\Constraints\NotBlank;

class RmTransactionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('transaction', EntityType::class,[
                "placeholder" => "Sélectionner une transaction",
                'class' => Transaction::class,
                "label" => false,
                'multiple' => false,
                'choice_label' => 'crypto',
                "required"  => true,
            ])
//            ->add('quantity', NumberType::class, [
//                'constraints' => [
//                    new NotBlank(),
//                    new Negative()
//                ],
//                'required' => true,
//                'label' => false,
//                'help' => 'Veuillez entrer une valeur négative',
//                'attr' => [
//                    'placeholder' => 'Quantité'
//                ]
//            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
        ]);
    }
}
