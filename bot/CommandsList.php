<?php

foreach(glob(__DIR__ . "/commands/*.php") as $file){
    require_once $file;
}

class CommandsList extends Notification
{

    public function setNotificationChannel(&$message, $channel)
    {
        $this->setNotificationChannel($message, $channel);
    }

}