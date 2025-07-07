<?php

if (!function_exists('sanitiseBoolean')) {
    function sanitiseBoolean($value): bool
    {
        return filter_var($value, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE) ?? false;
    }
}
