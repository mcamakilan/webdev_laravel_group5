<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'student_number',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get created_at formatted explicitly in local Philippine Time
     */
    public function getFormattedTimeAttribute()
    {
        return $this->created_at->setTimezone('Asia/Manila')->format('F d, Y — h:i A');
    }
}