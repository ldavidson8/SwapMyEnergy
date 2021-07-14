<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupportRequests extends Model
{
    protected $fillable = [ 'full_name', 'email_address', 'phone_number', 'support_issue' ];
}
