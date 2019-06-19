<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GarminCalendarRepository")
 */
class GarminCalendar
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $garmin_id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $trainingPlanId;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $itemType;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $activityTypeId;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $date;

    /**
     * @ORM\Column(type="bigint", nullable=true)
     */
    private $duration;

    /**
     * @ORM\Column(type="bigint", nullable=true)
     */
    private $distance;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $calories;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $weight;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $courseId;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $courseName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $startTimestampLocal;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $elapsedDuration;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $lapCount;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $workoutId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGarminId(): ?int
    {
        return $this->garmin_id;
    }

    public function setGarminId(int $garmin_id): self
    {
        $this->garmin_id = $garmin_id;

        return $this;
    }

    public function getTrainingPlanId(): ?int
    {
        return $this->trainingPlanId;
    }

    public function setTrainingPlanId(?int $trainingPlanId): self
    {
        $this->trainingPlanId = $trainingPlanId;

        return $this;
    }

    public function getItemType(): ?string
    {
        return $this->itemType;
    }

    public function setItemType(string $itemType): self
    {
        $this->itemType = $itemType;

        return $this;
    }

    public function getActivityTypeId(): ?int
    {
        return $this->activityTypeId;
    }

    public function setActivityTypeId(?int $activityTypeId): self
    {
        $this->activityTypeId = $activityTypeId;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDate(): ?string
    {
        return $this->date;
    }

    public function setDate(string $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(?int $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getDistance(): ?int
    {
        return $this->distance;
    }

    public function setDistance(?int $distance): self
    {
        $this->distance = $distance;

        return $this;
    }

    public function getCalories(): ?int
    {
        return $this->calories;
    }

    public function setCalories(?int $calories): self
    {
        $this->calories = $calories;

        return $this;
    }

    public function getWeight(): ?int
    {
        return $this->weight;
    }

    public function setWeight(?int $weight): self
    {
        $this->weight = $weight;

        return $this;
    }

    public function getCourseId(): ?int
    {
        return $this->courseId;
    }

    public function setCourseId(?int $courseId): self
    {
        $this->courseId = $courseId;

        return $this;
    }

    public function getCourseName(): ?string
    {
        return $this->courseName;
    }

    public function setCourseName(?string $courseName): self
    {
        $this->courseName = $courseName;

        return $this;
    }

    public function getStartTimestampLocal(): ?string
    {
        return $this->startTimestampLocal;
    }

    public function setStartTimestampLocal(?string $startTimestampLocal): self
    {
        $this->startTimestampLocal = $startTimestampLocal;

        return $this;
    }

    public function getElapsedDuration(): ?float
    {
        return $this->elapsedDuration;
    }

    public function setElapsedDuration(?float $elapsedDuration): self
    {
        $this->elapsedDuration = $elapsedDuration;

        return $this;
    }

    public function getLapCount(): ?int
    {
        return $this->lapCount;
    }

    public function setLapCount(?int $lapCount): self
    {
        $this->lapCount = $lapCount;

        return $this;
    }

    public function getWorkoutId(): ?int
    {
        return $this->workoutId;
    }

    public function setWorkoutId(?int $workoutId): self
    {
        $this->workoutId = $workoutId;

        return $this;
    }
}
