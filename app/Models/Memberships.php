<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Memberships extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'price'
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'membership_id');
    }
    public function videos()
    {
        return $this->hasMany(Video::class);
    }
}
