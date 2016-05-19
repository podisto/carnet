<?php

namespace App\CarnetBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', array(
                'attr' => array('class' => 'form-control'),
                'required' => true
            ))
            ->add('address', 'text', array(
                'attr' => array('class' => 'form-control'),
                'required' => true
            ))
            ->add('email', 'email', array(
                'attr' => array('class' => 'form-control'),
                'required' => true
            ))
            ->add('phone', 'text', array(
                'attr' => array('class' => 'form-control'),
                'required' => true
            ))
            ->add('website', 'text', array(
                'attr' => array('class' => 'form-control'),
                'required' => true
            ))
//            ->add('save', 'submit', array(
//                'attr' => array('class' => 'btn bnt-primary')
//            ))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\CarnetBundle\Entity\Contact'
        ));
    }
}
