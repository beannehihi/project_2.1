<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Fees extends Model
{
    use HasFactory;


    protected $fillable = [
        'month',
        'total_fee',
        'schoolYear_id',
        'major_id',
    ];


    public function tuition_fee()
    {
        return $this->hasMany(Tuition_fee::class, 'fee_id');
    }

    public function schoolYear()
    {
        return $this->belongsTo(SchoolYear::class, 'schoolYear_id', 'id');
    }

    public function major()
    {
        return $this->belongsTo(Major::class, 'major_id', 'id');
    }


    public function students()
    {
        return $this->hasMany(Student::class, 'fee_id', 'id');
    }
}
