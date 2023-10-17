<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'img',
        'name',
        'date_of_birth',
        'phone',
        'email',
        'email_verified_at',
        'location',
        'gender',
        'role',
        'status',
        'user_id',
        'class_id',
        'major_id',
        'tuition_fee_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function studentClass()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }

    public function major()
    {
        return $this->belongsTo(Major::class, 'major_id');
    }

    public function tuitionFee()
    {
        return $this->belongsTo(TuitionFee::class, 'tuition_fee_id');
    }
}
