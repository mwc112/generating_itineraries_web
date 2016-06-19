<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    protected $casts = [
        'waypoints' => 'string',
				'times_to_stay' => 'string',
				'route' => 'string',
    ];
}
