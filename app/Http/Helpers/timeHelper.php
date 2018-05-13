<?php
/**
 * Created by PhpStorm.
 * User: alaa.shehadeh
 * Date: 5/13/2018
 * Time: 9:24 PM
 */

namespace App\Http\Helpers;


class timeHelper
{
    public static function addMinuteToDate($datetime,$minutes) {
        $hours =  (int) $minutes/60;
        $minutes = $minutes%60;
        return date('Y-m-d H:i',strtotime('+'.$hours.' hour +'.$minutes.' minutes',strtotime($datetime)));
    }
    public static function dateTimeTimestamp($datetime) {
        $datetime = new \DateTime($datetime);
        return $datetime->getTimestamp();
    }
}