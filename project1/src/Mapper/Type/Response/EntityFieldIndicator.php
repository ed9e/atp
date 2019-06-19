<?php


namespace App\Mapper\Type\Response;


class EntityFieldIndicator
{
    protected $type;
    protected $name;
    protected $description;

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     * @return EntityFieldIndicator
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     * @return EntityFieldIndicator
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return EntityFieldIndicator
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
    public function __construct($type, $name, $description = null)
    {
        $this->setType($type);
        $this->setName($name);
        $this->setDescription($description);
    }
}