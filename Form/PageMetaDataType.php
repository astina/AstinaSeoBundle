<?php

namespace Astina\Bundle\SeoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PageMetaDataType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
//            ->add('hostname')
            ->add('title')
            ->add('description')
            ->add('keywords')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Astina\Bundle\SeoBundle\Entity\PageMetaData'
        ));
    }

    public function getName()
    {
        return 'astina_bundle_seobundle_pagemetadatatype';
    }
}
