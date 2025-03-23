<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResponseController extends Controller
{
    public function response($message = null, $data = null, bool $status)
    {
        return response()->json([
            'message' => $message,
            'data' => $data,
            'status' => $status
        ]);
    }
}
