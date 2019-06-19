<?php


namespace App\Garmin\Stock\Response;

use App\Mapper\Type\Response\EntityFieldIndicator as EFI;
use App\Mapper\Type\Response\Mapper;

class ActivityDetailsResponseMapper extends Mapper
{
    public function __construct()
    {
        $this->response = [

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
                    'startTimeLocal' => '2019-06-06T05:49:02.0',
                    'startTimeGMT' => '2019-06-06T03:49:02.0',
                    'startLatitude' => 50.53851225413382,
                    'startLongitude' => 22.08672364242375,
                    'distance' => 8560.76,
                    'duration' => 2681.656,
                    'movingDuration' => 2670.0,
                    'elapsedDuration' => 2891.998,
                    'elevationGain' => 6.0,
                    'elevationLoss' => 7.0,
                    'maxElevation' => 166.8,
                    'minElevation' => 157.4,
                    'averageSpeed' => 3.191999912261963,
                    'averageMovingSpeed' => 3.2062770657771535,
                    'maxSpeed' => 4.291999816894531,
                    'calories' => 524.0,
                    'averageHR' => 157.0,
                    'maxHR' => 176.0,
                    'averageRunCadence' => 147.859375,
                    'maxRunCadence' => 163.0,
                    'averageTemperature' => 19.722595078299776,
                    'maxTemperature' => 26.0,
                    'minTemperature' => 18.0,
                    'groundContactTime' => 265.8999938964844,
                    'groundContactBalanceLeft' => 49.599998474121094,
                    'strideLength' => 117.8300048828125,
                    'verticalOscillation' => 11.8,
                    'trainingEffect' => 3.799999952316284,
                    'verticalRatio' => 10.109999656677246,
                    'lactateThresholdSpeed' => 3.444000005722046,
                    'endLatitude' => 50.537350941449404,
                    'endLongitude' => 22.085536010563374,
                    'maxVerticalSpeed' => 0.4000091552734375,
                    'minActivityLapDuration' => 90.0,
                ],
            'locationName' => 'Stalowa Wola',
        ];
        parent::__construct();
    }
}