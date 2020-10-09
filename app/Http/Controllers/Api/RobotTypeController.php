<?php

namespace App\Http\Controllers\Api;

use App\RobotType;
use App\Http\Controllers\Controller;

class RobotTypeController extends Controller
{
    
    public function all()
    {
        $robotTypes = RobotType::all();
        $statusCode = 200;
        $response['status'] = $statusCode;

        if ($robotTypes->count()) {
            $response['data'] = $robotTypes;
        } else {
            $response['message'] = 'Couldn\'t find any robot types.';
        }

        return response()->json($response, $statusCode);
    }
}
