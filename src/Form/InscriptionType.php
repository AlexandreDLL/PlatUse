<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class InscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomUser')
            ->add('prenomUser')
            ->add('pseudoUser')
            ->add('password', PasswordType::class)
            ->add('password_confirm', PasswordType::class)
            ->add('emailUser', EmailType::class)
            ->add('dateNaissance', BirthdayType::class, [
                'placeholder'=>[
                    'day'=>'Jour', 'month'=>'Mois', 'year'=>'Année'
                ],
                'format'=>'dd-MM-yyyy'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
