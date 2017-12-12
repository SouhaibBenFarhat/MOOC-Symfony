<?php

namespace Esprit\MoocBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class QuizzChapitreType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titreQuizzEntrainement')
            ->add('idChapitreQuizzEntrainement')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Esprit\MoocBundle\Entity\QuizzChapitre'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'esprit_moocbundle_quizzchapitre';
    }
}
