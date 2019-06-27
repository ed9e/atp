<?php


namespace App\Mapper\Type\Response;


class EntityFieldIndicator
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
    protected $convertFunctions;

    /**
     * @param array $convertFunctions
     * @return EntityFieldIndicator
     */
    public function setConvertFunctions(array $convertFunctions)
    {
        foreach ($convertFunctions as $convertFunction) {
            $this->convertFunctions[$convertFunction] = $convertFunction;
        }

        return $this;
    }

    public function __construct(string $doctrineType, string $name, bool $nullable = true, string $description = null)
    {
        $this->setType($doctrineType);
        $this->setName($name);
        $this->setNullable($nullable);
        $this->setDescription($description);

    }

    /**
     * @return mixed
     */
    public function getConvertFunctions()
    {
        return $this->convertFunctions;
    }

    /**
     * @param mixed $convertFunction
     * @return EntityFieldIndicator
     */
    public function setConvertFunction($convertFunction)
    {
        $this->convertFunctions[$convertFunction] = $convertFunction;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return (array)$this->description;
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