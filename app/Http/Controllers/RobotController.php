<?php

namespace App\Http\Controllers;

use App\Robot;

class RobotController extends Controller
{
    public function all()
    {
        $robots = Robot::where('deleted_at', NULL)->orderBy('created_at', 'DESC')->get();

        return view('robots.all')->with('robots', $robots);
    }
}
