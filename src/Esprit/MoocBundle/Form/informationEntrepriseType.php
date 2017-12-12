<?php

namespace Esprit\MoocBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class informationEntrepriseType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('specialite')
                ->add('siteWeb')
                ->add('abreviation')
                ->add('gouvernerat')
                ->add('attestation')
                
                ->add('description')
                ->add('codePostale')
                ->add('type')
                ->add('adresse')
                ->add('nationnalite')
                ->add('numTel')
                ->add('matriculeFiscal')
                ->add('raisonInscription')
                ->add('entreprise')
                ->add('Valider', 'submit')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Esprit\MoocBundle\Entity\informationEntreprise'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'esprit_moocbundle_informationentreprise';
    }

}
