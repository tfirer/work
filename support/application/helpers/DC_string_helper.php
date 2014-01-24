<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('valid_email'))
{
    function valid_email($str) {
        return ( ! preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str)) ? FALSE : TRUE;
    }
}

if ( ! function_exists('valid_gender'))
{
    function valid_gender($str) {
        $str = strtolower($str);
        return ( ! preg_match("/^(male|female)$/", $str) ? FALSE : TRUE);
    }
}

if ( ! function_exists('valid_weight'))
    {
    function valid_weight($str) {
        $str = strtolower($str);
        return ( ! preg_match("/^(.*)#(kg|lb)$/", $str)) ? FALSE : TRUE;
    }
}

if ( ! function_exists('valid_height'))
{
    function valid_height($str) {
        $str = strtolower($str);
        return ( ! preg_match("/^(.*)#(cm|ft)$/", $str)) ? FALSE : TRUE;
    }
}

if ( ! function_exists('valid_birthday'))
{
    function valid_birthday($str) {
        return TRUE;
        //return ( ! preg_match("/^(\d*)$/", $str)) ?  FALSE : TRUE;
    }
}

if ( ! function_exists('valid_timestamp'))
{
    function valid_timestamp($str) {
        return ( ! preg_match("/^(\d*)$/", $str)) ?  FALSE : TRUE;
    }
}

if ( ! function_exists('fetch_content_from_url'))
{
    function fetch_content_from_url($url) {
        return json_decode(file_get_contents($url, null, null), true);
    }
}

if ( ! function_exists('filter_conutry_from_ip'))
{
    function filter_conutry_from_ip($ip) {
        $result = null;
        $response = json_decode(file_get_contents("http://ipinfo.io/{$ip}"), true);
        if (isset($response['country'])) {
            $result = $response['country'];
        }
        return $result;
    }
}
