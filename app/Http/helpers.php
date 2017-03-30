<?php
/**
 * Created by PhpStorm.
 * User: sajjad
 * Date: 3/30/17
 * Time: 03:42
 */

function cdn_url(){
    return env('CDN_URL','http://cdn.grad.scr12.ir');
}

function cdn_path(){
    return env('CDN_PATH', base_path() . '../grad_cdn');
}

function persianNumbers($matches)
{
    $farsi_array = array("۰", "۱", "۲", "۳", "۴", "۵", "۶", "۷", "۸", "۹");
    $english_array = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9");

    return str_replace($english_array, $farsi_array, $matches);
}

function dateFormat($date)
{
    if (gettype($date) == 'integer')
        $date = \Carbon\Carbon::createFromTimestamp($date);
    else
        $date = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date);
    if (\Carbon\Carbon::now()->subMonth(2)->timestamp > $date->timestamp)
        $res = persianNumbers(jdate($date)->format('j M y'));
    else
        $res = persianNumbers(jdate($date)->ago());

    $months_indirect = ['فرو','ارد','خرد','تیر','مرد','شهر','مهر','آبا','آذر','دی','بهم','اسف'];
    $months = ['فروردین','اردیبهشت','خرداد','تیر','مرداد','شهریور','مهر','آبان','آذر','دی','بهمن','اسفند'];

    return str_replace($months_indirect, $months, $res);
}

