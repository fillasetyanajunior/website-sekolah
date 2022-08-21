<?php

use Illuminate\Support\Str;

function number($value)
{
    return number_format($value, 0, ',', '.');
}
function getDomain($url)
{
    $pieces = parse_url($url);
    $domain = isset($pieces['host']) ? $pieces['host'] : '';
    if (preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain, $regs)) {
        return $regs['domain'];
    }
    return false;
}

function googleFont($fonts = null)
{
    if ($fonts) {
        return '
        <link rel="preload" as="style" href="https://fonts.googleapis.com/css?family=' . implode('|', $fonts) . '&display=swap" onload="this.onload=null;this.rel=\'stylesheet\'"/>
        <noscript>
            <link href="https://fonts.googleapis.com/css?family=' . implode('|', $fonts) . '&display=swap" rel="stylesheet"type="text/css"/>
        </noscript>
        ';
    }
    return '';
}

function productImg($dimension, $filename, $noCache = null)
{
    if ($noCache)
        $noCache = '?nocache=' . Str::random(5);

    if (is_file(public_path("storage/products/$dimension/$filename"))) {
        return asset("storage/products/$dimension/$filename$noCache");
    } else {
        return asset('assets/img/tiny.jpg');
    }
}

function country($str)
{
    $regex = "/^0/";  // Regex
    $code = "62"; //HY
    return preg_replace($regex, $code, $str);
}
