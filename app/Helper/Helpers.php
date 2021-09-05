<?php

if (!function_exists('changeIDRtoNumeric')) {
    function changeIDRtoNumeric($value)
    {
        return preg_replace('/\D/', '', $value);
    }
}
