<?php


namespace App\Mapper\Type\Response;


use App\Mapper\Type\Response\Indicator\IndicatorAbstract;
use App\Mapper\Type\Response\Indicator\IndicatorInterface;

class EntityFieldIndicator extends IndicatorAbstract implements IndicatorInterface
{
    protected $type;
    protected $name;
    protected $nullable;

    /**
     * @return mixed
     */
    public function getNullable()
    {
        return $this->nullable;
    }

    /**
     * @param mixed $nullable
     * @return EntityFieldIndicator
     */
    public function setNullable($nullable)
    {
        $this->nullable = $nullable;
        return $this;
    }
    protected $description;
    protected $convertFunction;

    public function __construct(string $doctrineType, string $name, bool $nullable=true, string $description = null, string $convertFunction = null)
    {
        $this->setType($doctrineType);
        $this->setName($name);
        $this->setNullable($nullable);
        $this->setDescription($description);
        $this->setConvertFunction($convertFunction);
    }

    public function createMap($path): MapInterface
    {
        return new EntityFieldMap($this, new ValuePath($path));
    }

    /**
     * @return mixed
     */
    public function getConvertFunction()
    {
        return $this->convertFunction;
    }

    /**
     * @param mixed $convertFunction
     * @return EntityFieldIndicator
     */
    public function setConvertFunction($convertFunction)
    {
        $this->convertFunction = $convertFunction;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return (array) $this->description;
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
}