<?php

namespace AppBundle\Form;

use Doctrine\Common\Persistence\ObjectManager;
use GraphAware\Neo4j\OGM\EntityManager;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GraphEntityType extends AbstractType
{
    protected $manager;

    protected $idReader;

    public function __construct(EntityManager $entityManager)
    {
        $this->manager = $entityManager;
    }

    public function getParent()
    {
        return ChoiceType::class;
    }



    public function configureOptions(OptionsResolver $resolver)
    {
        $choiceLoader = function(Options $options) {
            $entityLoader = new OGMChoiceLoader($this->manager, $options['class']);

            return $entityLoader;
        };

        $choiceValue = function(Options $options) {
            $class = $options['class'];
            $cm = $this->manager->getClassMetadataFor($class);

            return array($cm, 'getIdValue');
        };

        $resolver->setDefaults(array(
            'em' => null,
            'query_builder' => null,
            'choices' => null,
            'choice_label' => array(__CLASS__, 'createChoiceLabel'),
            'choice_loader' => $choiceLoader,
            'choice_value' => $choiceValue,
        ));

        $resolver->setRequired(array('class'));
        $resolver->setAllowedTypes('em', array('null', 'string', ObjectManager::class));
    }






}