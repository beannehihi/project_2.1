<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_code',
        'name',
        'date_of_birth',
        'phone',
        'email',
        'email_verified_at',
        'password',
        'location',
        'scholarship',
        'gender',
        'role',
        'user_id',
        'fee_id',

    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function major()
    {
        return $this->belongsTo(Major::class, 'major_id');
    }

    public function tuitionFees()
    {
        return $this->hasMany(Tuition_fee::class, 'student_id', 'id');
    }

    public function fees()
    {
        return $this->belongsTo(Fees::class, 'fee_id', 'id');
    }
}
