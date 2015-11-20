<?php

namespace andres\videoclubBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PeliculasType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titulo')
            ->add('genero')
            ->add('descripcion','text')
            ->add('precio')
            ->add('anio')

            ->add('save', 'submit', array('label' =>'Guardar  Pelicula'));
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'andres\videoclubBundle\Entity\Peliculas'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'andres_videoclubbundle_peliculas';
    }
}
