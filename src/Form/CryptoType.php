<?php

namespace App\Form;

use App\Entity\Crypto;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class CryptoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('name', TextType::class,[
                "label" => false,
                "required"  => true,
                "attr" => [
                    "class" => "form-control",
                    "placeholder" => "Nom de la crypto"
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Crypto::class,
        ]);
    }
}
