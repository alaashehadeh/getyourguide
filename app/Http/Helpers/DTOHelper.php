<?php
/**
 * Created by PhpStorm.
 * User: alaa.shehadeh
 * Date: 5/13/2018
 * Time: 9:22 PM
 */

namespace App\Http\Helpers;


class DTOHelper
{
    public static function outputDTO($data) {
        $output = array();
        foreach ($data as $value) {
            $output[$value['product_id']]["product_id"] = $value['product_id'];
            $output[$value['product_id']]["places_available"] = $value['places_available'];
            $output[$value['product_id']]['activity_start_datetime'][] = $value['activity_start_datetime'];
            $end_date = timeHelper::addMinuteToDate($value['activity_start_datetime'],$value['activity_duration_in_minutes']);
            $output[$value['product_id']]['activity_start_datetime'][] =str_replace(' ','T', $end_date);
        }
        ksort($output);
        return $output;
    }
}