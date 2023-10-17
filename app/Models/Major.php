<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function fees()
    {
        return $this->hasMany(Fee::class, 'major_id', 'id');
    }
}
