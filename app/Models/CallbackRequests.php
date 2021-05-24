<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CallbackRequests extends Model
{
    protected $fillable = [ 'full_name', 'phone_number' ];
}
