<?php

namespace andres\videoclubBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RecargasType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('descripcion') 
            ->add('monto')
            ->add('numTarjeta')
            ->add('nombreTitular')
            ->add('mesExpiracion')
            ->add('anioExpiracion')
            ->add('codigoSeguridad')
            ->add('save', 'submit', array('label' =>'Realizar Recarga'));
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'andres\videoclubBundle\Entity\Recargas'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'andres_videoclubbundle_recargas';
    }
}
