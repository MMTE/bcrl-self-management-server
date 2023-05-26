<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function handleResponse($result, $msg, $code = 200)
    {
        $res = [
            'success' => true,
            'data' => $result,
            'message' => $msg,
        ];
        return response()->json($res, $code);
    }

    public function handleError($errorMsg, $code = 404)
    {
        $res = [
            'success' => false,
            'message' => $errorMsg,
        ];
        return response()->json($res, $code);
    }
}
