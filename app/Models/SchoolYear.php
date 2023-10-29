<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolYear extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];


    public function fees()
    {
        return $this->hasMany(Fees::class, 'schoolYear_id', 'id');
    }

    public function students()
    {
        return $this->hasMany(Student::class, 'schoolYear_id', 'id');
    }
}
