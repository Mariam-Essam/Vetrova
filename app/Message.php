<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Message extends Model
{
    protected   $table = "messages";

    protected   $appends = [
        "file"
    ];


    public function request(){
        return $this->belongsTo("App\Request", "request_id");
    }

    public function sender(){
        return $this->belongsTo("App\User", "sender_id");
    }


    public function getFileAttribute(){
        return $this->attributes['file'] ? Storage::url($this->attributes['file']) : null;
    }
}
