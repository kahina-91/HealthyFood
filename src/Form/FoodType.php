<?php

namespace App\Form;

use App\Entity\Food;
use App\Form\ApplicationType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Url;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class FoodType extends ApplicationType
{
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, $this->getConfiguration("Name", "Add the name of food"))
            ->add('category', TextType::class, $this->getConfiguration("Category", "Add the category of the food"))
            ->add('vitaminsAndMinerals', TextType::class, $this->getConfiguration("Vitamins and minerals", "List vitamins and minerals in this food"))
            ->add('calories', IntegerType::class, $this->getConfiguration("Calories", "indicate how many calories this food contains"))
            ->add('introduction', TextareaType::class, $this->getConfiguration("Description", "give a definition or a description for this food"))
            ->add('coverImage', UrlType::class, $this->getConfiguration("URL of image", "give the address of an image that really makes you want"))
            ->add('benefits', TextareaType::class, $this->getConfiguration("Benefits", "Write some benefits of the food"))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Food::class,
        ]);
    }
}
