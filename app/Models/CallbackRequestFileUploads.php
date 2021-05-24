<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CallbackRequestFileUploads extends Model
{
    protected $fillable = [ 'file_upload_id', 'filename' ];

    public function item()
    {
        return $this -> belongsTo('App\Models\CallbackRequest');
    }
}
