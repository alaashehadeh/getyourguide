<?php
/**
 * Created by PhpStorm.
 * User: alaa.shehadeh
 * Date: 5/13/2018
 * Time: 9:19 PM
 */

namespace App\Http\Connector;


class mockConnector
{
    const url = 'http://www.mocky.io/v2/58ff37f2110000070cf5ff16';
    public function getEndPointContent()
    {
        $data = file_get_contents(self::url);
        $data = json_decode($data, TRUE);
        return $data['product_availabilities'];
    }
}