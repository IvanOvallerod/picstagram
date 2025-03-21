<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    protected $fillable = [
        'user_id',
        'post_id',
        'comment',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
