<?php

use Omalizadeh\ApiResponse\Helpers\ApiResponse;

if (!function_exists('apiResponse')) {
    function apiResponse(): ApiResponse
    {
        return new ApiResponse();
    }
}
