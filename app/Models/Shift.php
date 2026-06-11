<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shift extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'start_time', 'end_time'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_shift')->withTimestamps();
    }
}
