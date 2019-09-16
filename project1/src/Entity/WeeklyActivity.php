<?php /** @noinspection PhpUnusedAliasInspection */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use DateTimeInterface;

/**
 * @ORM\Entity(readOnly=true)
 * @ORM\Entity(repositoryClass="App\Repository\WeeklyRepository")
 */
class WeeklyActivity
{
    /**
     * @return mixed
     */
    public function getDistanceSum()
    {
        return $this->distanceSum;
    }

    /**
     * @param $distanceSum
     * @return WeeklyActivity
     */
    public function setDistanceSum($distanceSum): WeeklyActivity
    {
        $this->distanceSum = $distanceSum;
        return $this;
    }

    /**
     * @ORM\Column(type="integer")
     */
    private $timeMinuteSum;

    /**
     * @ORM\Column(type="integer")
     */
    private $distanceSum;



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
