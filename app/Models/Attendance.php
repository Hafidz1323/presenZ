<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attendance extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'shift_id',
        'check_in_time',
        'check_out_time',
        'check_in_photo',
        'check_out_photo',
        'check_in_lat',
        'check_in_long',
        'check_in_address',
        'check_out_lat',
        'check_out_long',
        'check_out_address',
        'check_in_ip',
        'check_out_ip',
        'check_in_device',
        'check_out_device',
        'status',
        'notes'
    ];

    protected $casts = [
        'check_in_time' => 'datetime',
        'check_out_time' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function shift()
    {
        return $this->belongsTo(Shift::class);
    }

    public function logs()
    {
        return $this->hasMany(AttendanceLog::class);
    }
}
