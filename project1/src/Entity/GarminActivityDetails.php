<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ActivityDetailsRepository")
 */
class GarminActivityDetails extends AbstractEntity
{

    /**
     * @ORM\Id()
     * @ORM\Column(type="bigint", nullable=false)
     */
    private $activityId;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $activityUUID;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $activityName;

    /**
     * @ORM\Column(type="bigint", nullable=true)
     */
    private $userProfileId;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isMultiSportParent;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $activityTypeId;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $activityTypeKey;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isOriginal;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $userDIsplayName;

    /**
     * @ORM\Column(type="bigint", nullable=true)
     */
    private $associatedWorkoutId;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $elevationCorrected;

    

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $startLatitude;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $startLongitude;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $distance;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $duration;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $movingDuration;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $elapsedDuration;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $elevationGain;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $elevationLoss;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $maxElevation;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $minElevation;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $averageSpeed;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $averageMovingSpeed;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $maxSpeed;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $calories;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $averageHR;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $maxHR;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $averageRunCadence;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $maxRunCadence;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $averageTemperature;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $maxTemperature;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $minTemperature;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $groundContactTime;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $groundContactBalanceLeft;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $strideLength;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $verticalOscillation;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $trainingEffect;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $verticalRatio;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $lactateThresholdSpeed;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $endLatitude;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $endLongitude;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $startTimeLocal;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $startTimeGMT;

    public function getActivityId()
    {
        return $this->activityId;
    }

    public function setActivityId($activityId): self
    {
        $this->activityId = $activityId;

        return $this;
    }

    public function getActivityUUID(): ?string
    {
        return $this->activityUUID;
    }

    public function setActivityUUID(?string $activityUUID): self
    {
        $this->activityUUID = $activityUUID;

        return $this;
    }

    public function getActivityName(): ?string
    {
        return $this->activityName;
    }

    public function setActivityName(?string $activityName): self
    {
        $this->activityName = $activityName;

        return $this;
    }

    public function getUserProfileId(): ?int
    {
        return $this->userProfileId;
    }

    public function setUserProfileId(?int $userProfileId): self
    {
        $this->userProfileId = $userProfileId;

        return $this;
    }

    public function getIsMultiSportParent(): ?bool
    {
        return $this->isMultiSportParent;
    }

    public function setIsMultiSportParent(?bool $isMultiSportParent): self
    {
        $this->isMultiSportParent = $isMultiSportParent;

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

    public function getActivityTypeKey(): ?string
    {
        return $this->activityTypeKey;
    }

    public function setActivityTypeKey(?string $activityTypeKey): self
    {
        $this->activityTypeKey = $activityTypeKey;

        return $this;
    }

    public function getIsOriginal(): ?bool
    {
        return $this->isOriginal;
    }

    public function setIsOriginal(?bool $isOriginal): self
    {
        $this->isOriginal = $isOriginal;

        return $this;
    }

    public function getUserDIsplayName(): ?string
    {
        return $this->userDIsplayName;
    }

    public function setUserDIsplayName(?string $userDIsplayName): self
    {
        $this->userDIsplayName = $userDIsplayName;

        return $this;
    }

    public function getAssociatedWorkoutId(): ?int
    {
        return $this->associatedWorkoutId;
    }

    public function setAssociatedWorkoutId(?int $associatedWorkoutId): self
    {
        $this->associatedWorkoutId = $associatedWorkoutId;

        return $this;
    }

    public function getElevationCorrected(): ?bool
    {
        return $this->elevationCorrected;
    }

    public function setElevationCorrected(?bool $elevationCorrected): self
    {
        $this->elevationCorrected = $elevationCorrected;

        return $this;
    }

    public function getStartTimeLocal(): ?\DateTimeInterface
    {
        return $this->startTimeLocal;
    }

    public function setStartTimeLocal(?\DateTimeInterface $startTimeLocal): self
    {
        $this->startTimeLocal = $startTimeLocal;

        return $this;
    }

    public function getStartTimeGMT(): ?\DateTimeInterface
    {
        return $this->startTimeGMT;
    }

    public function setStartTimeGMT(?\DateTimeInterface $startTimeGMT): self
    {
        $this->startTimeGMT = $startTimeGMT;

        return $this;
    }

    public function getStartLatitude(): ?float
    {
        return $this->startLatitude;
    }

    public function setStartLatitude(?float $startLatitude): self
    {
        $this->startLatitude = $startLatitude;

        return $this;
    }

    public function getStartLongitude(): ?float
    {
        return $this->startLongitude;
    }

    public function setStartLongitude(?float $startLongitude): self
    {
        $this->startLongitude = $startLongitude;

        return $this;
    }

    public function getDistance(): ?float
    {
        return $this->distance;
    }

    public function setDistance(?float $distance): self
    {
        $this->distance = $distance;

        return $this;
    }

    public function getDuration(): ?float
    {
        return $this->duration;
    }

    public function setDuration(?float $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getMovingDuration(): ?float
    {
        return $this->movingDuration;
    }

    public function setMovingDuration(?float $movingDuration): self
    {
        $this->movingDuration = $movingDuration;

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

    public function getElevationGain(): ?float
    {
        return $this->elevationGain;
    }

    public function setElevationGain(?float $elevationGain): self
    {
        $this->elevationGain = $elevationGain;

        return $this;
    }

    public function getElevationLoss(): ?float
    {
        return $this->elevationLoss;
    }

    public function setElevationLoss(?float $elevationLoss): self
    {
        $this->elevationLoss = $elevationLoss;

        return $this;
    }

    public function getMaxElevation(): ?float
    {
        return $this->maxElevation;
    }

    public function setMaxElevation(?float $maxElevation): self
    {
        $this->maxElevation = $maxElevation;

        return $this;
    }

    public function getMinElevation(): ?float
    {
        return $this->minElevation;
    }

    public function setMinElevation(?float $minElevation): self
    {
        $this->minElevation = $minElevation;

        return $this;
    }

    public function getAverageSpeed(): ?float
    {
        return $this->averageSpeed;
    }

    public function setAverageSpeed(?float $averageSpeed): self
    {
        $this->averageSpeed = $averageSpeed;

        return $this;
    }

    public function getAverageMovingSpeed(): ?float
    {
        return $this->averageMovingSpeed;
    }

    public function setAverageMovingSpeed(?float $averageMovingSpeed): self
    {
        $this->averageMovingSpeed = $averageMovingSpeed;

        return $this;
    }

    public function getMaxSpeed(): ?float
    {
        return $this->maxSpeed;
    }

    public function setMaxSpeed(?float $maxSpeed): self
    {
        $this->maxSpeed = $maxSpeed;

        return $this;
    }

    public function getCalories(): ?float
    {
        return $this->calories;
    }

    public function setCalories(?float $calories): self
    {
        $this->calories = $calories;

        return $this;
    }

    public function getAverageHR(): ?float
    {
        return $this->averageHR;
    }

    public function setAverageHR(?float $averageHR): self
    {
        $this->averageHR = $averageHR;

        return $this;
    }

    public function getMaxHR(): ?float
    {
        return $this->maxHR;
    }

    public function setMaxHR(?float $maxHR): self
    {
        $this->maxHR = $maxHR;

        return $this;
    }

    public function getAverageRunCadence(): ?float
    {
        return $this->averageRunCadence;
    }

    public function setAverageRunCadence(?float $averageRunCadence): self
    {
        $this->averageRunCadence = $averageRunCadence;

        return $this;
    }

    public function getMaxRunCadence(): ?float
    {
        return $this->maxRunCadence;
    }

    public function setMaxRunCadence(?float $maxRunCadence): self
    {
        $this->maxRunCadence = $maxRunCadence;

        return $this;
    }

    public function getAverageTemperature(): ?float
    {
        return $this->averageTemperature;
    }

    public function setAverageTemperature(?float $averageTemperature): self
    {
        $this->averageTemperature = $averageTemperature;

        return $this;
    }

    public function getMaxTemperature(): ?float
    {
        return $this->maxTemperature;
    }

    public function setMaxTemperature(?float $maxTemperature): self
    {
        $this->maxTemperature = $maxTemperature;

        return $this;
    }

    public function getMinTemperature(): ?float
    {
        return $this->minTemperature;
    }

    public function setMinTemperature(?float $minTemperature): self
    {
        $this->minTemperature = $minTemperature;

        return $this;
    }

    public function getGroundContactTime(): ?float
    {
        return $this->groundContactTime;
    }

    public function setGroundContactTime(?float $groundContactTime): self
    {
        $this->groundContactTime = $groundContactTime;

        return $this;
    }

    public function getGroundContactBalanceLeft(): ?float
    {
        return $this->groundContactBalanceLeft;
    }

    public function setGroundContactBalanceLeft(?float $groundContactBalanceLeft): self
    {
        $this->groundContactBalanceLeft = $groundContactBalanceLeft;

        return $this;
    }

    public function getStrideLength(): ?float
    {
        return $this->strideLength;
    }

    public function setStrideLength(?float $strideLength): self
    {
        $this->strideLength = $strideLength;

        return $this;
    }

    public function getVerticalOscillation(): ?float
    {
        return $this->verticalOscillation;
    }

    public function setVerticalOscillation(?float $verticalOscillation): self
    {
        $this->verticalOscillation = $verticalOscillation;

        return $this;
    }

    public function getTrainingEffect(): ?float
    {
        return $this->trainingEffect;
    }

    public function setTrainingEffect(?float $trainingEffect): self
    {
        $this->trainingEffect = $trainingEffect;

        return $this;
    }

    public function getVerticalRatio(): ?float
    {
        return $this->verticalRatio;
    }

    public function setVerticalRatio(?float $verticalRatio): self
    {
        $this->verticalRatio = $verticalRatio;

        return $this;
    }

    public function getLactateThresholdSpeed(): ?float
    {
        return $this->lactateThresholdSpeed;
    }

    public function setLactateThresholdSpeed(?float $lactateThresholdSpeed): self
    {
        $this->lactateThresholdSpeed = $lactateThresholdSpeed;

        return $this;
    }

    public function getEndLatitude(): ?float
    {
        return $this->endLatitude;
    }

    public function setEndLatitude(?float $endLatitude): self
    {
        $this->endLatitude = $endLatitude;

        return $this;
    }

    public function getEndLongitude(): ?float
    {
        return $this->endLongitude;
    }

    public function setEndLongitude(?float $endLongitude): self
    {
        $this->endLongitude = $endLongitude;

        return $this;
    }
}
