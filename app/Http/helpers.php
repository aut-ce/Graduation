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

