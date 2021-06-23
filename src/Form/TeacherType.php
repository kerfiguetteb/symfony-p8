<?php

namespace App\Form;
use App\Entity\SchoolYear;
use App\Entity\Teacher;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TeacherType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname')
            ->add('lastname')
            ->add('phone')
            ->add('schoolYears', EntityType::class, [
                'class' => SchoolYear::class,
                // La fonction anonyme doit renvoyer une chaîne de caractères
                // qui contient le texte qui sera utilisé dans le menu déroulant. 
                'choice_label' => function(SchoolYear $schoolYear) {
                    return "{$schoolYear->getName()}";
                },
                'multiple' => true,
                'expanded' => true,
            ])
            // ->add('tags')
            // ->add('user')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Teacher::class,
        ]);
    }
}
