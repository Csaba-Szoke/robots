<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Robot extends Model
{
    protected $fillable = [
        'type_id', 'name', 'status', 'year', 'deleted_at', 'created_at', 'updated_at'
    ];

    public function type()
    {
        return $this->belongsTo('App\RobotType');
    }
}
