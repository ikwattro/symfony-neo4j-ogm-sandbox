<?php

namespace AppBundle\Entity;

use GraphAware\Neo4j\OGM\Annotations as OGM;

/**
 *
 * @OGM\Node(label="Family")
 */
class Family
{
    /**
     * @var int
     *
     * @OGM\GraphId()
     */
    protected $id;

    /**
     * @var string
     *
     * @OGM\Property()
     */
    protected $code;

    /**
     * @var string
     *
     * @OGM\Property()
     */
    protected $label;

    public function __construct($code, $label)
    {
        $this->code = $code;
        $this->label = $label;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }
}