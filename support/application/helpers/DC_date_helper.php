<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/**
 *
 * Returns day_start timestamp
 *
 * @access  public
 * @param integer
 * @return  integer timestamp
 */
if ( ! function_exists('day_start_time')) {
    function day_start_time($now) {
        $year = intval(gmdate("Y", $now));
        $month = intval(gmdate("m", $now));
        $day = intval(gmdate("d", $now));

        return mktime(0, 0, 0, $month, $day, $year);
    }
}

/**
 *
 * Returns day_end timestamp
 *
 * @access  public
 * @param integer
 * @return  integer timestamp
 */
if ( ! function_exists('day_end_time')) {
    function day_end_time($now) {
        $year = intval(gmdate("Y", $now));
        $month = intval(gmdate("m", $now));
        $day = intval(gmdate("d", $now));

        return mktime(24, 60, 60, $month, $day, $year);
    }
}

/**
 *
 * Returns $num days ago's day_start timestamp
 *
 * @access  public
 * @param integer $num how many days ago
 * @param integer $now user's now time
 * @return  integer timestamp
 */
if ( ! function_exists('previous_day')) {
    function previous_day($num, $now) {
        $year = intval(gmdate("Y", $now));
        $month = intval(gmdate("m", $now));
        $day = intval(gmdate("d", $now));

        if ( $day <= $num ) {
            if ( 1 == $month ) {
                $month = 12;
                $year -= 1;
            } else {
                $month -= 1;
            }
            $day = $day - $num + days_in_month($month, $year);
        } else {
            $day -= $num;
        }

        return mktime(0, 0, 0, $month, $day, $year);
    }
}

/**
 *
 * Returns $num days forward's day_start timestamp
 *
 * @access  public
 * @param integer $num how many days ago
 * @param integer $now user's now time
 * @return  integer timestamp
 */
if ( ! function_exists('forward_day')) {
    function forward_day($num, $now) {
        $year = intval(gmdate("Y", $now));
        $month = intval(gmdate("m", $now));
        $day = intval(gmdate("d", $now));

        $days_in_month = days_in_month($month, $year);
        if ( $day + $num > $days_in_month) {
            if ( 12 == $month ) {
                $month = 1;
                $year += 1;
            } else {
                $month += 1;
            }
            $day = $days_in_month + $num - $day ;
        } else {
            $day += $num;
        }

        return mktime(0, 0, 0, $month, $day, $year);
    }
}

/**
 *
 * Returns days' day_start timestamp in $previous week
 *
 * @access  public
 * @param integer $now user's now time
 * @return  array
 */
if ( ! function_exists('previous_week')) {
    function previous_week($now) {
        $week_num = intval(gmdate('w', $now));
        // week start from sunday index 0
        for ($i = 0; $i <= $week_num; $i++) {
            $weeks[] = previous_day($week_num - $i, $now);
        }
        //for ($i = $week_num + 1; $i < 6; $i++) {
        //    $weeks[] = $now + 100000;
        //}
        //$weeks[0] = previous_day(1, $now);
        //$weeks[1] = previous_day(2, $now);
        //$weeks[2] = previous_day(3, $now);
        //$weeks[3] = previous_day(4, $now);
        //$weeks[4] = previous_day(5, $now);
        //$weeks[5] = previous_day(6, $now);
        //$weeks[6] = previous_day(7, $now);

        return $weeks;
    }
}


/**
 *
 * Returns all days's day_start timestamp in $num ago month
 *
 * @access  public
 * @param string $month(jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec)
 * @param integer $now user's now time
 * @return  array
 */
if ( ! function_exists('previous_month')) {
    function previous_month($now) {
        $months = array();
        $year = intval(gmdate("Y", $now));
        $month = intval(gmdate("m", $now));
        $day = intval(gmdate("d", $now));
        $days_in_month = days_in_month($month, $year);
        for ($i = 1 ; $i <= $day; $i++) {
            $months[] = previous_day($day - $i, $now);
        }
        //for ($i = $day + 1; $i <= 31; $i++) {
        //    $months[] = $now + 100000;
        //}

        return $months;
    }
}

/**
 * Return special date's timestamp
 * @access public
 * @param string like 'yyyy-mm-dd h:m:s'
 * @return string timestamp
**/
if ( ! function_exists('special_timestamp')) {
    function special_timestamp($date_string) {
        $ymd_hms = explode(" ", $date_string);
        $ymd = explode("-", $ymd_hms[0]);
        $hms = explode(":", $ymd_hms[1]);
        return mktime($hms[0], $hms[1], $hms[2], $ymd[1], $ymd[2], $ymd[0]);
    }
}
