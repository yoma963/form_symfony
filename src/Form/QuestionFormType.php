<?php

namespace App\Form;

use App\Entity\Question;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuestionFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', null, array(
                'label' => 'Neved'
            ))
            ->add('email', EmailType::class, array(
                'label' => 'E-mail címed',
            ))
            ->add('message', TextareaType::class, array(
                'label' => 'Üzenet szövege',
            ))
            ->add('Submit', SubmitType::class, array(
                'label' => 'Küldés',
                'attr' => array('class' => 'btn btn-primary text-white mt-3')
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Question::class,
        ]);
    }
}
