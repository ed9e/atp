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
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="bigint")
     */
    private $activityId;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $activityUUID;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $activityName;

    /**
     * @ORM\Column(type="bigint")
     */
    private $userProfileId;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isMultiSportParent;

    /**
     * @ORM\Column(type="integer")
     */
    private $activityTypeId;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $activityTypeKey;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isOriginal;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $userDIsplayName;

    /**
     * @ORM\Column(type="bigint", nullable=true)
     */
    private $associatedWorkoutId;

    /**
     * @ORM\Column(type="boolean")
     */
    private $elevationCorrected;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getActivityId(): ?int
    {
        return $this->activityId;
    }

    public function setActivityId(int $activityId): self
    {
        $this->activityId = $activityId;

        return $this;
    }

    public function getActivityUUID(): ?string
    {
        return $this->activityUUID;
    }

    public function setActivityUUID(string $activityUUID): self
    {
        $this->activityUUID = $activityUUID;

        return $this;
    }

    public function getActivityName(): ?string
    {
        return $this->activityName;
    }

    public function setActivityName(string $activityName): self
    {
        $this->activityName = $activityName;

        return $this;
    }

    public function getUserProfileId(): ?int
    {
        return $this->userProfileId;
    }

    public function setUserProfileId(int $userProfileId): self
    {
        $this->userProfileId = $userProfileId;

        return $this;
    }

    public function getIsMultiSportParent(): ?bool
    {
        return $this->isMultiSportParent;
    }

    public function setIsMultiSportParent(bool $isMultiSportParent): self
    {
        $this->isMultiSportParent = $isMultiSportParent;

        return $this;
    }

    public function getActivityTypeId(): ?int
    {
        return $this->activityTypeId;
    }

    public function setActivityTypeId(int $activityTypeId): self
    {
        $this->activityTypeId = $activityTypeId;

        return $this;
    }

    public function getActivityTypeKey(): ?string
    {
        return $this->activityTypeKey;
    }

    public function setActivityTypeKey(string $activityTypeKey): self
    {
        $this->activityTypeKey = $activityTypeKey;

        return $this;
    }

    public function getIsOriginal(): ?bool
    {
        return $this->isOriginal;
    }

    public function setIsOriginal(bool $isOriginal): self
    {
        $this->isOriginal = $isOriginal;

        return $this;
    }

    public function getUserDIsplayName(): ?string
    {
        return $this->userDIsplayName;
    }

    public function setUserDIsplayName(string $userDIsplayName): self
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

    public function setElevationCorrected(bool $elevationCorrected): self
    {
        $this->elevationCorrected = $elevationCorrected;

        return $this;
    }
}
