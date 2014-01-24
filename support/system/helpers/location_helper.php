<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/**
 *
 * Returns day_start timestamp
 *
 * @access  public
 * @param float
 * @return  integer timestamp
 */
if ( ! function_exists('day_start_time')) {
    function count_distance($starting_lat, $starting_lng, $ending_lat, $ending_lng) {
        $EARTH_RADIUS = 6378.137;
        $radLat1 = rad($starting_lat);
        //echo $radLat1;
        $radLat2 = rad($ending_lat);
        $a = $radLat1 - $radLat2;
        $b = rad($starting_lng) - rad($ending_lng);
        $s = 2 * asin(sqrt(pow(sin($a/2),2) +
        cos($radLat1)*cos($radLat2)*pow(sin($b/2),2)));
        $s = $s *$EARTH_RADIUS;
        $s = round($s * 10000) / 10000;
        return $s;
    }
}

if ( ! function_exists('rad')) {
    function rad($d) {
        return $d * 3.1415926535898 / 180.0;
    }
}

if ( ! function_exists('split_latlng')) {
    function split_latlng($latlng) {
        return explode(',', $latlng);
    }
}