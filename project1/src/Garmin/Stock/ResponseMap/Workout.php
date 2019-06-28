<?php


namespace App\Garmin\Stock\ResponseMap;

use App\Mapper\Type\Response\MapReverser;

class Workout extends MapReverser
{
    public function __construct()
    {
        $this->responseMap = [
            'workoutScheduleId' => 247789217,
            'workout' =>
                array(
                    'workoutId' => 144317599,
                    'ownerId' => 9358035,
                    'workoutName' => 'W01D7-Long Run',
                    'description' => ' • Run in Z2, easy conversational pace, 75 minutes.
 • Cool down, 5 to 10 minutes.
 • Stretch.',
                    'updatedDate' => '2019-05-20T10:58:09.0',
                    'createdDate' => '2019-05-20T10:58:09.0',
                    'sportType' =>
                        array(
                            'sportTypeId' => 1,
                            'sportTypeKey' => 'running',
                            'displayOrder' => 1,
                        ),
                    'trainingPlanId' => 33762833,
                    'author' => NULL,
                    'sharedWithUsers' => NULL,
                    'estimatedDurationInSecs' => NULL,
                    'estimatedDistanceInMeters' => NULL,
                    'workoutSegments' =>
                        array(
                            0 =>
                                array(
                                    'segmentOrder' => 1,
                                    'sportType' =>
                                        array(
                                            'sportTypeId' => 1,
                                            'sportTypeKey' => 'running',
                                            'displayOrder' => 1,
                                        ),
                                    'workoutSteps' =>
                                        array(
                                            0 =>
                                                array(
                                                    'type' => 'ExecutableStepDTO',
                                                    'stepId' => 868319166,
                                                    'stepOrder' => 1,
                                                    'stepType' =>
                                                        array(
                                                            'stepTypeId' => 3,
                                                            'stepTypeKey' => 'interval',
                                                            'displayOrder' => 3,
                                                        ),
                                                    'childStepId' => 0,
                                                    'description' => NULL,
                                                    'endCondition' =>
                                                        array(
                                                            'conditionTypeId' => 2,
                                                            'conditionTypeKey' => 'time',
                                                            'displayOrder' => 2,
                                                            'displayable' => true,
                                                        ),
                                                    'endConditionValue' => 4500.0,
                                                    'preferredEndConditionUnit' => NULL,
                                                    'endConditionCompare' => NULL,
                                                    'targetType' =>
                                                        array(
                                                            'workoutTargetTypeId' => 4,
                                                            'workoutTargetTypeKey' => 'heart.rate.zone',
                                                            'displayOrder' => 4,
                                                        ),
                                                    'targetValueOne' => 111.0,
                                                    'targetValueTwo' => 129.0,
                                                    'targetValueUnit' => NULL,
                                                    'zoneNumber' => 2,
                                                    'endConditionZone' => NULL,
                                                    'strokeType' =>
                                                        array(
                                                            'strokeTypeId' => NULL,
                                                            'strokeTypeKey' => NULL,
                                                            'displayOrder' => NULL,
                                                        ),
                                                    'equipmentType' =>
                                                        array(
                                                            'equipmentTypeId' => NULL,
                                                            'equipmentTypeKey' => NULL,
                                                            'displayOrder' => NULL,
                                                        ),
                                                    'category' => NULL,
                                                    'exerciseName' => NULL,
                                                    'workoutProvider' => NULL,
                                                    'providerExerciseSourceId' => NULL,
                                                    'weightValue' => NULL,
                                                    'weightUnit' => NULL,
                                                ),
                                            1 =>
                                                array(
                                                    'type' => 'ExecutableStepDTO',
                                                    'stepId' => 868319167,
                                                    'stepOrder' => 2,
                                                    'stepType' =>
                                                        array(
                                                            'stepTypeId' => 2,
                                                            'stepTypeKey' => 'cooldown',
                                                            'displayOrder' => 2,
                                                        ),
                                                    'childStepId' => 0,
                                                    'description' => NULL,
                                                    'endCondition' =>
                                                        array(
                                                            'conditionTypeId' => 1,
                                                            'conditionTypeKey' => 'lap.button',
                                                            'displayOrder' => 1,
                                                            'displayable' => true,
                                                        ),
                                                    'endConditionValue' => NULL,
                                                    'preferredEndConditionUnit' => NULL,
                                                    'endConditionCompare' => NULL,
                                                    'targetType' =>
                                                        array(
                                                            'workoutTargetTypeId' => 1,
                                                            'workoutTargetTypeKey' => 'no.target',
                                                            'displayOrder' => 1,
                                                        ),
                                                    'targetValueOne' => NULL,
                                                    'targetValueTwo' => NULL,
                                                    'targetValueUnit' => NULL,
                                                    'zoneNumber' => NULL,
                                                    'endConditionZone' => NULL,
                                                    'strokeType' =>
                                                        array(
                                                            'strokeTypeId' => NULL,
                                                            'strokeTypeKey' => NULL,
                                                            'displayOrder' => NULL,
                                                        ),
                                                    'equipmentType' =>
                                                        array(
                                                            'equipmentTypeId' => NULL,
                                                            'equipmentTypeKey' => NULL,
                                                            'displayOrder' => NULL,
                                                        ),
                                                    'category' => NULL,
                                                    'exerciseName' => NULL,
                                                    'workoutProvider' => NULL,
                                                    'providerExerciseSourceId' => NULL,
                                                    'weightValue' => NULL,
                                                    'weightUnit' => NULL,
                                                ),
                                        ),
                                ),
                        ),
                    'poolLength' => NULL,
                    'poolLengthUnit' => NULL,
                    'locale' => NULL,
                    'workoutProvider' => NULL,
                    'workoutSourceId' => NULL,
                    'uploadTimestamp' => NULL,
                    'atpPlanId' => NULL,
                    'consumer' => NULL,
                    'consumerName' => NULL,
                    'consumerImageURL' => NULL,
                    'consumerWebsiteURL' => NULL,
                    'workoutNameI18nKey' => NULL,
                    'descriptionI18nKey' => NULL,
                    'shared' => false,
                ),
            'calendarDate' => '2019-06-07',
            'createdDate' => '2019-05-20',
            'ownerId' => 9358035,
            'newName' => NULL,
            'consumer' => NULL,
            'atpPlanTypeId' => NULL,
            'nameChanged' => false,
            'protected' => false,
        ];

        parent::__construct();
    }
}