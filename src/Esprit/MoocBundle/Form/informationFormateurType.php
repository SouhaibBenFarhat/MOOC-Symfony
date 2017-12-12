<?php

namespace Esprit\MoocBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class informationFormateurType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder
                ->add('specialite', 'entity', array(
                    'class' => 'Esprit\MoocBundle\Entity\Discipline',
                    'query_builder' => function(\Doctrine\ORM\EntityRepository $repository) {
                        return $repository->createQueryBuilder('q');
                    }
                ))
                ->add('googlePlus')
                ->add('siteWeb')
                ->add('sexe', 'entity', array(
                    'class' => 'Esprit\MoocBundle\Entity\Sexe',
                    'query_builder' => function(\Doctrine\ORM\EntityRepository $repository) {
                        return $repository->createQueryBuilder('q');
                    }
                ))
                ->add('aPropos', 'textarea', array('attr' => array('class' => 'ckeditor')))
                ->add('biographie', 'textarea', array('attr' => array('class' => 'ckeditor')))
                ->add('miniBiographie', 'textarea', array('attr' => array('class' => 'ckeditor')))
                ->add('Valider', 'submit')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Esprit\MoocBundle\Entity\informationFormateur'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'esprit_moocbundle_informationformateur';
    }

}
