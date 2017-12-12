<?php

namespace Esprit\MoocBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class QuizzCoursType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public $idUser;
    public $idCours;

    public function __construct(\Esprit\MoocBundle\Entity\Utilisateur $id_user, $id_cours) {
        $this->idUser = $id_user;
        $this->idCours = $id_cours;
    }

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $id = $this->idUser;
        $cours = $this->idCours;
        $builder
                ->add('titreQuizzCours')
                ->add('duree')
                ->add('idCoursQuizzCours', 'entity', array(
                    'class' => 'Esprit\MoocBundle\Entity\Cours',
                    'query_builder' => function(\Doctrine\ORM\EntityRepository $repository) use ($id, $cours ) {
                        return $repository->createQueryBuilder('q')
                                ->where('q.idFormateurCours = :formateur AND q.idQuizzCours is NULL AND q.idCours =:cours')
                                ->setParameter('formateur', $id)
                                ->setParameter('cours', $cours);
                    }
                ))
                ->add('descriptionQuizzCours', 'textarea')
                ->add('suivant', 'submit');
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Esprit\MoocBundle\Entity\QuizzCours'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'esprit_moocbundle_quizzcours';
    }

}
