<?php

/*
|--------------------------------------------------------------------------
| Custom Helpers
|--------------------------------------------------------------------------
*/

if (!function_exists('filterTokenValue')) {
    /**
     * Filter the given string before using it for database queries.
     *
     * @param  string  $hours
     * @return array
     */
    function filterTokenValue(string $token)
    {
        return preg_replace('/[^a-z0-9]/i', '', $token);
    }
}
