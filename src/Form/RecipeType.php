<?php

namespace App\Form;

use App\Entity\CourseType;
use App\Entity\Recipe;
use App\Entity\Source;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RecipeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('extrainto')
            ->add('adjustements')
            ->add('courseType',EntityType::class,[
                // looks for choices from this entity
                'class' => CourseType::class,
                'label'=> 'Type de plat',
                // uses the CourseType.name property as the visible option string
                'choice_label' => 'name',
                // used to render a select box, check boxes or radios
                // 'multiple' => true,
                // 'expanded' => true,
            ])
            ->add('source', EntityType::class, [
                'class' => Source::class,
                'label'=> 'Source',
                'choice_label' => 'name',
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Recipe::class,
        ]);
    }
}
