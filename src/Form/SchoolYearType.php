<?php
// 21-06-2021
namespace App\Form;

use App\Entity\SchoolYear;
use App\Entity\Teacher;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class SchoolYearType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('startDate')
            ->add('endDate')
            ->add('teachers',EntityType::class,[
                'class' => Teacher::class,
// La fonction anonyme renvoie un string qui contient le texte qui sera utilisé dans le menu déroulant.
                'choice_label' => function(Teacher $teacher){
// On renvoit l'attribut name, on aurait aussi pu combiner name et id ou encore un autre attribut.
                    return "{$teacher->getFirstname()} {$teacher->getLastname()}";
                },
                'multiple' => true,
                // 'expanded' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SchoolYear::class,
        ]);
    }
}
