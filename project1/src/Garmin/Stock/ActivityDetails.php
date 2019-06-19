<?php


namespace App\Garmin\Stock;

class ActivityDetails extends Base
{
    protected $activity_id = '3720067292'; //Example id
    protected $uri = 'https://connect.garmin.com/modern/proxy/activity-service/activity/{id}';

    public function setActivityId($id)
    {
        $this->activity_id = $id;
    }

    protected function prepareUri()
    {
        parent::prepareUri();
        if (!$this->activity_id) {
            throw new \Exception('Activity ID not set');
        }
        $this->uri = str_replace('{id}', $this->activity_id, $this->uri);
    }

    public function get()
    {
        return $this->toArray();
    }
}