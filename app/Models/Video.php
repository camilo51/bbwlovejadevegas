<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image',
        'video',
        'information',
        'views',
        'membership_id'
    ];
    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function likes(){
        return $this->hasMany(Like::class);
    }
    public function checkLike(User $user)
    {
        return $this->likes->contains('user_id', $user->id);
    }
    public function categories(){
        return $this->belongsToMany(Categorie::class);
    }
    public function memberships()
    {
        return $this->belongsTo(Memberships::class);
    }
}
