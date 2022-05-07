<?php

namespace App\Http\Library;

use stdClass;

class Response
{
    public static function withData($status, $message, $data)
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ]);
    }

    public static function withoutData($status, $message)
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => new stdClass()
        ]);
    }
}
