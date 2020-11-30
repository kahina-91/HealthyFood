<?php

namespace App\Form;

use App\Entity\User;
use App\Form\ApplicationType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class RegistrationType extends ApplicationType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class, $this->getConfiguration("FirstName", "Your first name.."))
            ->add('lastName', TextType::class, $this->getConfiguration("LastName", "Your last name.."))
            ->add('slug', TextType::class, $this->getConfiguration("Slug", "Your Slug.."))
            ->add('email', EmailType::class, $this->getConfiguration("Email", "Your Email.."))
            ->add('picture', UrlType::class, $this->getConfiguration("Picture", "Url of your avatar.."))
            ->add('hash', PasswordType::class, $this->getConfiguration("Password", "Your password.."))
            ->add('passwordConfirm', PasswordType::class, $this->getConfiguration("confirm Password", "Please confirm your password.."))
            ->add('introduction', TextType::class, $this->getConfiguration("Introduction", "Present yourself in a few words.."))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
