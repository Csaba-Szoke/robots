<?php

namespace App\Http\Controllers\Api;

use App\Robot;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class RobotController extends Controller
{
    public function all()
    {
        $robots = Robot::all();
        $statusCode = 200;
        $response['status'] = $statusCode;

        if ($robots->count()) {
            $response['data'] = $robots;
        } else {
            $response['message'] = 'Couldn\'t find any robots.';
        }

        return response()->json($response, $statusCode);
    }

    public function searchByName($name)
    {
        $robots = Robot::where('name', 'LIKE', '%' . $name . '%')->get();
        $statusCode = 200;
        $response['status'] = $statusCode;

        if ($robots->count()) {
            $response = [
                'data' => $robots,
            ];
        } else {
            $response = [
                'message' => 'Couldn\'t find any robots with: ' . $name,
            ];
        }

        return response()->json($response, $statusCode);
    }

    public function filterByTypeOrStatus($search)
    {
        $robots = Robot::whereHas('type', function ($query) use ($search) {
            $query->where('name', 'LIKE', '%' . $search . '%');
        })->orWhere('status', 'LIKE', '%' . $search . '%')->get();
        $statusCode = 200;
        $response['status'] = $statusCode;

        if ($robots->count()) {
            $response = [
                'data' => $robots,
            ];
        } else {
            $response = [
                'message' => 'Couldn\'t find any robots with: ' . $search,
            ];
        }

        return response()->json($response, $statusCode);
    }

    public function getRobot($id)
    {
        $robots = Robot::find($id);

        if ($robots) {
            $statusCode = 200;
            $response = [
                'data' => $robots,
            ];
        } else {
            $statusCode = 404;
            $response = [
                'message' => 'Couldn\'t find any robots with id: ' . $id,
            ];
        }

        $response['status'] = $statusCode;

        return response()->json($response, $statusCode);
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'type_id' => 'required|numeric',
            'name' => 'required|unique:robots',
            'status' => 'required',
            'year' => 'required|numeric|digits:4'
        ]);

        $robot = Robot::create($request->all());

        $statusCode = 201;
        $response = [
            'status' => $statusCode,
            'data' => $robot,
        ];

        return response()->json($response, $statusCode);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'type_id' => 'required|numeric',
            'name' => 'required|unique:robots,name,' . $id,
            'status' => 'required',
            'year' => 'required|numeric|digits:4'
        ]);

        $robot = Robot::find($id);

        if ($robot) {
            $robot->update($request->all());
            $statusCode = 200;
            $response = [
                'data' => $robot,
            ];
        } else {
            $statusCode = 404;
            $response = [
                'message' => 'Couldn\'t find any robots with id: ' . $id,
            ];
        }

        $response['status'] = $statusCode;

        return response()->json($response, $statusCode);
    }

    public function delete($id)
    {
        $robot = Robot::find($id);

        if ($robot) {
            $robot->delete();
            $statusCode = 200;
            $response = [
                'data' => $robot,
            ];
        } else {
            $statusCode = 404;
            $response = [
                'message' => 'Couldn\'t find any robots with id: ' . $id,
            ];
        }

        $response['status'] = $statusCode;

        return response()->json($response, $statusCode);
    }
}
