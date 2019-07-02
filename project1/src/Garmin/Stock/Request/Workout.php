<?php


namespace App\Garmin\Stock\Request;

use App\Garmin\Stock\Request\Traits\PrepareUri;

class Workout extends Base
{
    use PrepareUri;

    protected $workoutId = '247789217';
    protected $uri = 'https://connect.garmin.com/modern/proxy/workout-service/schedule/{workoutId}';

    /**
     * @return string
     */
    public function getWorkoutId(): string
    {
        return $this->workoutId;
    }

    /**
     * @param string $workout_id
     * @return Workout
     */
    public function setWorkoutId(string $workout_id): Workout
    {
        $this->workoutId = $workout_id;
        return $this;
    }



    public function response(): \App\Garmin\Stock\Response\Base
    {
        return new \App\Garmin\Stock\Response\Workout($this);
    }

}