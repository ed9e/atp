<?php /** @noinspection PhpUnusedAliasInspection */

namespace App\Entity;

use DateTimeInterface;

/**
 * @ORM\Entity(readOnly=true)
 * @ORM\Entity(repositoryClass="App\Repository\WeeklyRepository")
 */
class WeeklyActivity
{

    /**
     * @ORM\Column(type="integer")
     */
    private $timeMinuteSum;

    /**
     * @ORM\Id()
     * @ORM\Column(type="string")
     */
    private $weekly;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ownerFullName;


    public function getTimeMinuteSum(): ?int
    {
        return $this->timeMinuteSum;
    }

    public function setTimeMinuteSum(int $timeMinuteSum): self
    {
        $this->timeMinuteSum = $timeMinuteSum;

        return $this;
    }

    public function getWeekly(): ?DateTimeInterface
    {
        return $this->weekly;
    }

    public function setWeekly(DateTimeInterface $weekly): self
    {
        $this->weekly = $weekly;

        return $this;
    }

    public function getOwnerFullName(): ?string
    {
        return $this->ownerFullName;
    }

    public function setOwnerFullName(string $ownerFullName): self
    {
        $this->ownerFullName = $ownerFullName;

        return $this;
    }
}
