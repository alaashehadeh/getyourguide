<?php
/**
 * Created by PhpStorm.
 * User: alaa.shehadeh
 * Date: 5/13/2018
 * Time: 9:13 PM
 */

namespace App\Http\Services;

use DateTime;


class validatorService
{
    public function isValidTimeStamp($timestamp)
    {
        //check if T exist and remove it
        $number = substr_count($timestamp, 'T');
        if ($number == 1) {
            $pos = strpos($timestamp, 'T');
            if ($pos == 10) {
                $timestamp = str_replace('T', ' ', $timestamp);
                $format = 'Y-m-d H:i';
                $d = DateTime::createFromFormat($format, $timestamp);
                if ($d && $d->format($format) == $timestamp)
                    return true;
                else
                    return false;
            }
        } else
            return false;
    }
    public function checkTimeOrder($startDateTime,$endDateTime) {
        $start = date('YmdHi',strtotime($startDateTime));
        $end = date('YmdHi',strtotime($endDateTime));
        if($start > $end)
            return false;
        else
            return true;
    }
    public function checkInteger($number) {
        if (ctype_digit($number)) {
            return false;
        } else {
            if($number > 0 & $number > 30)
                return false;
            else
                return true;
        }
    }
}