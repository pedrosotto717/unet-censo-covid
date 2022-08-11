<?php

use Illuminate\Support\Str;

/**
 * Response Http.
 *
 * @param  string|array  $errors
 * @return int $statusCode
 */
function json_errors($errors, $statusCode = 400)
{
    return response()->json([
        'errors' => [
            'status' => $statusCode,
            'data' => is_array($errors) ? $errors : ['error' => $errors]
        ]
    ], $statusCode);
}

function json_success($data, $statusCode = 200)
{
    return response()->json($data, $statusCode);
}

// clear string from special characters
function clear_string($str)
{
    $str = Str::of($str)->replaceMatches('/[\$\#\<\>]/i', ' ');
    return addslashes($str);
}

// strip slashes from array
function removeSlashes($arr = [])
{
    $input = $arr;
    array_walk_recursive($input, function (&$input) {
        if (is_string($input))
            $input = stripslashes($input);
    });

    return  $input;
}
