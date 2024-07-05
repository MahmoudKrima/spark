<?php

use Illuminate\Support\Facades\Storage;

if (!function_exists('displayImage')) {
    function displayImage($object)
    {
        if (Storage::exists('public/' . $object)) {
            return asset('storage/' . $object);
        }
        return asset($object);
    }
}
