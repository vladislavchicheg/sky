<?php

/**
 * Created by PhpStorm.
 * User: TheSafins
 * Date: 07.07.2016
 * Time: 23:15
 */
class request
{
    public static function post($url, $data = array(), $headers = false)
    {
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        if ($headers) {
            if (is_array($headers)) {
                curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            }
        } else {
            curl_setopt($curl, CURLOPT_HEADER, 0);
        }
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }

    public static function get($url, $data = array(), $headers = false)
    {
        $curl = curl_init($url . '?' . http_build_query($data));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        if ($headers) {
            if (is_array($headers)) {
                curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            }
        } else {
            curl_setopt($curl, CURLOPT_HEADER, 0);
        }
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }
}

class req extends request
{

}
