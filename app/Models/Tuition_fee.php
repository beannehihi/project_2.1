<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tuition_fee extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_fee',
        'times',
        'fees_id',
    ];

    public function student()
    {
        return $this->hasMany(Student::class, 'tuition_fee_id', 'id');
    }

    public function fees()
    {
        return $this->belongsTo(Fees::class, 'fees_id');
    }
}
