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

    public function classes()
    {
        return $this->hasMany(Classes::class, 'schoolYear_id', 'id');
    }

    public function fees()
    {
        return $this->hasMany(Fee::class, 'schoolYear_id', 'id');
    }
}
