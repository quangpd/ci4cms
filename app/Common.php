<?php

/**
 * The goal of this file is to allow developers a location
 * where they can overwrite core procedural functions and
 * replace them with their own. This file is loaded during
 * the bootstrap process and is called during the framework's
 * execution.
 *
 * This can be looked at as a `master helper` file that is
 * loaded early on, and may also contain additional functions
 * that you'd like to use throughout your entire application
 *
 * @see: https://codeigniter.com/user_guide/extending/common.html
 */

function url_title($string, $by = '-', $lowercase = true)
{
    if (!$string) {
        return;
    }
    $string = replace_sign($string);
    if ($lowercase === TRUE) {
        $string = strtolower($string);
    }

    $string = preg_replace('/[^a-z0-9' . $by . ']+/i', $by, $string);
    $string = trim($string, $by);

    return $string;
}


function replace_sign($string)
{
    if (!$string) {
        return;
    }

    $string = htmlspecialchars_decode($string);

    $string = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $string);
    $string = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $string);

    $string = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $string);
    $string = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $string);

    $string = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $string);
    $string = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $string);

    $string = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $string);
    $string = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $string);

    $string = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $string);
    $string = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $string);

    $string = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $string);
    $string = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $string);

    $string = preg_replace("/(đ)/", 'd', $string);
    $string = preg_replace("/(Đ)/", 'D', $string);
    $string = trim($string);

    return strtoupper($string);
}
