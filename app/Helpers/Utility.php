<?php

namespace App\Helpers;

class Utility
{
    public static function convertEnglishNumbersToPersian($number)
    {
        $persian = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹');
        $num = range(0, 9);
        return str_replace($num, $persian, $number);
    }

    public static function convertPersianNumbersToEnglish($number)
    {
        $persian = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹');
        $num = range(0, 9);
        return str_replace($persian, $num, $number);
    }

    // this function exists because difference in start of weeks
    public static function getCarbonConstantInCustomStandard($weekDayNumber)
    {
        return $weekDayNumber + 1 != 7 ? $weekDayNumber + 1 : 0;
    }

}
