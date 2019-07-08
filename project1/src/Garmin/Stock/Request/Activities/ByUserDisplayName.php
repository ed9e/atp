<?php


namespace App\Garmin\Stock\Request\Activities;


class ByUserDisplayName extends AbstractActivities
{
    protected $userDisplayName = '';
    protected $uri = 'https://connect.garmin.com/modern/proxy/activitylist-service/activities/{userDisplayName}?limit={limit}&start={start}';

    /**
     * @return string
     */
    public function getUserDisplayName(): string
    {
        return $this->userDisplayName;
    }

    /**
     * @param string $user_display_name
     * @return ByUserDisplayName
     */
    public function setUserDisplayName(string $user_display_name): ByUserDisplayName
    {
        $this->userDisplayName = $user_display_name;
        return $this;
    }

    public function toArray()
    {
        return json_decode($this->content, true)['activityList'];
    }

}