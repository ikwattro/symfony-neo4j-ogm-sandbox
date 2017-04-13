<?php

namespace AppBundle\Form;

use GraphAware\Neo4j\OGM\EntityManager;
use Symfony\Component\Form\ChoiceList\ArrayChoiceList;
use Symfony\Component\Form\ChoiceList\Loader\ChoiceLoaderInterface;

class OGMChoiceLoader implements ChoiceLoaderInterface
{
    /**
     * @var EntityManager
     */
    private $manager;

    /**
     * @var string
     */
    private $class;

    /**
     * @var \GraphAware\Neo4j\OGM\Metadata\NodeEntityMetadata
     */
    private $cm;

    public function __construct(EntityManager $manager, $class)
    {
        $this->manager = $manager;
        $this->class = $class;
        $this->cm = $this->manager->getClassMetadataFor($class);
    }

    /**
     * @param null $value
     * @return ArrayChoiceList
     */
    public function loadChoiceList($value = null)
    {
        $objects = $this->manager->getRepository($this->class)->findAll();

        return new ArrayChoiceList($objects, $value);
    }

    /**
     * @param array $values
     * @param null|mixed $value
     * @return array
     */
    public function loadChoicesForValues(array $values, $value = null)
    {
        return $this->loadChoiceList($value)->getChoicesForValues($values);
    }

    /**
     * @param array $choices
     * @param null|mixed $value
     * @return array
     */
    public function loadValuesForChoices(array $choices, $value = null)
    {
        if (empty($choices)) {
            return [];
        }

        $values = [];
        foreach ($choices as $i => $o) {
            if ($o instanceof $this->class) {
                $values[$i] = $this->cm->getIdValue($o);
            }
        }

        return $values;
    }

}