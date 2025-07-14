<?php

namespace ChunkUpload\Support;

class Response
{
    public static function success(string $message = 'Success', $data = null, int $status = 200)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data'    => $data,
        ], $status);
    }

    public static function error(string $message = 'Error', $data = null, int $status = 400)
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'data'    => $data,
        ], $status);
    }
}
