<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AtpRepository")
 */
class Atp
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=999999)
     */
    private $values;

    /**
     * @ORM\Column(type="text")
     */
    private $phases;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValues(): ?string
    {
        return $this->values;
    }

    public function setValues(string $values): self
    {
        $this->values = $values;

        return $this;
    }

    public function getPhases(): ?string
    {
        return $this->phases;
    }

    public function setPhases(string $phases): self
    {
        $this->phases = $phases;

        return $this;
    }
}
