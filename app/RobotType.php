<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RobotType extends Model
{
    protected $fillable = [
        'name', 'created_at', 'updated_at'
    ];

    public function robot()
    {
        return $this->hasMany('App\Robot');
    }
}
