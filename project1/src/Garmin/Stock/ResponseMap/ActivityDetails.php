<?php


namespace App\Garmin\Stock\ResponseMap;

use App\Mapper\Type\Response\EntityFieldIndicator as EFI;
use App\Mapper\Type\Response\MapReverser;

class ActivityDetails extends MapReverser
{
    public function __construct()
    {
        $this->responseMap = [

            'activityId' => new EFI('string', 'activityId'),
            'activityUUID' =>
                [
                    'uuid' => new EFI('string', 'activityUUID', '0e45ee7f-6971-43a3-8d39-d46c7379f52b'),
                ],
            'activityName' => new EFI('string', 'activityName'),
            'userProfileId' => new EFI('bigint', 'userProfileId', '9358035'),
            'isMultiSportParent' => new EFI('boolean', 'isMultiSportParent'),
            'activityTypeDTO' =>
                [
                    'typeId' => new EFI('integer', 'activityTypeId', '1'),
                    'typeKey' => new EFI('string', 'activityTypeKey', 'running'),
                    'parentTypeId' => 17,
                    'sortOrder' => 3,
                ],
            'eventTypeDTO' =>
                [
                    'typeId' => 9,
                    'typeKey' => 'uncategorized',
                    'sortOrder' => 10,
                ],
            'accessControlRuleDTO' =>
                [
                    'typeId' => 4,
                    'typeKey' => 'groups',
                ],
            'timeZoneUnitDTO' =>
                [
                    'unitId' => 124,
                    'unitKey' => 'Europe/Paris',
                    'factor' => 0.0,
                    'timeZone' => 'Europe/Paris',
                ],
            'metadataDTO' =>
                [
                    'isOriginal' => new EFI('boolean', 'isOriginal'),
                    'deviceApplicationInstallationId' => 867612,
                    'agentApplicationInstallationId' => NULL,
                    'agentString' => NULL,
                    'fileFormat' =>
                        [
                            'formatId' => 7,
                            'formatKey' => 'fit',
                        ],
                    'associatedCourseId' => NULL,
                    'lastUpdateDate' => '2019-06-06T04:50:32.0',
                    'uploadedDate' => '2019-06-06T04:50:32.0',
                    'videoUrl' => NULL,
                    'hasPolyline' => true,
                    'hasChartData' => true,
                    'hasHrTimeInZones' => true,
                    'hasPowerTimeInZones' => false,
                    'userInfoDto' =>
                        [
                            'userProfilePk' => 9358035,
                            'displayname' => new EFI('string', 'userDIsplayName', 'lbrzozowski'),
                            'fullname' => 'Łukasz Brzozowski',
                            'profileImageUrlLarge' => NULL,
                            'profileImageUrlMedium' => 'https://s3.amazonaws.com/garmin-connect-prod/profile_images/ed9baa89-2b2d-4616-a8d2-b27f3f4d231d-9358035.png',
                            'profileImageUrlSmall' => 'https://s3.amazonaws.com/garmin-connect-prod/profile_images/68a227d2-7e93-4655-a981-73ec25518050-9358035.png',
                            'userPro' => false,
                        ],
                    'chartAvailability' =>
                        [
                            'showAirTemperature' => true,
                            'showDistance' => true,
                            'showDuration' => true,
                            'showElevation' => true,
                            'showGroundContactTime' => true,
                            'showGroundContactBalance' => true,
                            'showHeartRate' => true,
                            'showMovingDuration' => true,
                            'showMovingSpeed' => true,
                            'showRunCadence' => true,
                            'showSpeed' => true,
                            'showTimestamp' => true,
                            'showVerticalOscillation' => true,
                            'showStrideLength' => true,
                        ],
                    'childIds' =>
                        [],
                    'childActivityTypes' =>
                        [],
                    'sensors' =>
                        [
                            0 =>
                                [
                                    'sku' => '006-B2050-00',
                                    'sourceType' => 'LOCAL',
                                    'softwareVersion' => 9.4,
                                ],
                            1 =>
                                [
                                    'sku' => '006-B2050-00',
                                    'sourceType' => 'LOCAL',
                                    'localDeviceType' => 'BAROMETER',
                                    'softwareVersion' => 9.4,
                                ],
                            2 =>
                                [
                                    'sku' => '006-B1620-00',
                                    'sourceType' => 'LOCAL',
                                    'localDeviceType' => 'GPS',
                                    'softwareVersion' => 3.3,
                                ],
                            3 =>
                                [
                                    'manufacturer' => 'GARMIN',
                                    'serialNumber' => 5148360,
                                    'sku' => '006-B1752-00',
                                    'sourceType' => 'ANTPLUS',
                                    'antplusDeviceType' => 'HEART_RATE',
                                    'softwareVersion' => 66.0,
                                    'batteryStatus' => 'OK',
                                ],
                            4 =>
                                [
                                    'manufacturer' => 'GARMIN',
                                    'serialNumber' => 5148360,
                                    'sku' => '006-B1752-00',
                                    'sourceType' => 'ANTPLUS',
                                    'antplusDeviceType' => 'RUN',
                                    'softwareVersion' => 66.0,
                                    'batteryStatus' => 'OK',
                                ],
                            5 =>
                                [
                                    'sourceType' => 'LOCAL',
                                    'localDeviceType' => 'ACCELEROMETER',
                                    'softwareVersion' => 0.0,
                                ],
                            6 =>
                                [
                                    'sourceType' => 'LOCAL',
                                    'localDeviceType' => 'ACCELEROMETER',
                                ],
                            7 =>
                                [
                                    'sourceType' => 'LOCAL',
                                    'localDeviceType' => 'ACCELEROMETER',
                                    'softwareVersion' => 273.04,
                                ],
                        ],
                    'activityImages' =>
                        [],
                    'manufacturer' => 'GARMIN',
                    'diveNumber' => NULL,
                    'lapCount' => 10,
                    'associatedWorkoutId' => new EFI('bigint', 'associatedWorkoutId', 144317601),
                    'isAtpActivity' => NULL,
                    'deviceMetaDataDTO' =>
                        [
                            'deviceId' => '3907467059',
                            'deviceTypePk' => 21600,
                            'deviceVersionPk' => 867612,
                        ],
                    'elevationCorrected' => new EFI('boolean', 'elevationCorrected'),
                    'autoCalcCalories' => false,
                    'favorite' => false,
                    'personalRecord' => false,
                    'manualActivity' => false,
                    'gcj02' => false,
                ],
            'summaryDTO' =>
                [
                    'startTimeLocal' => new EFI('timestamp', 'startTimeLocal'),
                    'startTimeGMT' => new EFI('timestamp', 'startTimeGMT'),
                    'startLatitude' => new EFI('numeric', 'startLatitude'),
                    'startLongitude' => new EFI('numeric', 'startLongitude'),
                    'distance' => new EFI('numeric', 'distance', '8560.76'),
                    'duration' => new EFI('numeric', 'duration', '2681.656'),
                    'movingDuration' => new EFI('numeric', 'movingDuration', '2670.0'),
                    'elapsedDuration' => new EFI('numeric', 'elapsedDuration', '2891.998'),
                    'elevationGain' => new EFI('numeric', 'elevationGain', '2670.0'),
                    'elevationLoss' => new EFI('numeric', 'elevationLoss', '2670.0'),
                    'maxElevation' => new EFI('numeric', 'maxElevation', '2670.0'),
                    'minElevation' => new EFI('numeric', 'minElevation', '2670.0'),
                    'averageSpeed' => new EFI('numeric', 'averageSpeed', '2670.0'),
                    'averageMovingSpeed' => new EFI('numeric', 'averageMovingSpeed', '2670.0'),
                    'maxSpeed' => new EFI('numeric', 'maxSpeed', '2670.0'),
                    'calories' => new EFI('numeric', 'calories', '2670.0'),
                    'averageHR' => new EFI('numeric', 'averageHR', '2670.0'),
                    'maxHR' => new EFI('numeric', 'maxHR', '2670.0'),
                    'averageRunCadence' => new EFI('numeric', 'averageRunCadence', '2670.0'),
                    'maxRunCadence' => new EFI('numeric', 'maxRunCadence', '2670.0'),
                    'averageTemperature' => new EFI('numeric', 'averageTemperature', '2670.0'),
                    'maxTemperature' => new EFI('numeric', 'maxTemperature', '2670.0'),
                    'minTemperature' => new EFI('numeric', 'minTemperature', '2670.0'),
                    'groundContactTime' => new EFI('numeric', 'groundContactTime', '2670.0'),
                    'groundContactBalanceLeft' => new EFI('numeric', 'groundContactBalanceLeft', '2670.0'),
                    'strideLength' => new EFI('numeric', 'strideLength', '2670.0'),
                    'verticalOscillation' => new EFI('numeric', 'verticalOscillation', '2670.0'),
                    'trainingEffect' => new EFI('numeric', 'trainingEffect', '2670.0'),
                    'verticalRatio' => new EFI('numeric', 'verticalRatio', '2670.0'),
                    'lactateThresholdSpeed' => new EFI('numeric', 'lactateThresholdSpeed', '2670.0'),
                    'endLatitude' => new EFI('numeric', 'endLatitude'),
                    'endLongitude' => new EFI('numeric', 'endLongitude'),
                    'maxVerticalSpeed' => 0.4000091552734375,
                    'minActivityLapDuration' => 90.0,
                ],
            'locationName' => 'Stalowa Wola',
        ];
        parent::__construct();
    }
}