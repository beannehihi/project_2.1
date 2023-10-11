<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'schoolYear_id'
    ];

    public function schoolYear()
    {
        return $this->belongsTo(SchoolYear::class, 'schoolYear_id');
    }
}