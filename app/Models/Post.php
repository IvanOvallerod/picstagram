<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'image',
        'user_id',
        'created_by',
        'updated_by',
    ];

    public function user(){
        // return $this->belongsTo(User::class);
        return $this->belongsTo(User::class)->select(['name', 'username']);
    }

    public function comments(){
        return $this->hasMany(Comments::class);
    }

    public function likes(){
        return $this->hasMany(Like::class);
    }

    public function checkLike(User $user){
        return $this->likes->contains('user_id', $user->id);
    }
}
