<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tuition_fee extends Model
{
    use HasFactory;

    protected $fillable = [
        'times',
        'fee',
        'fees_id',
        'student_id',
    ];



    public function fees()
    {
        return $this->belongsTo(Fees::class, 'fee_id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}
