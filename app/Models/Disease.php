<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Disease extends Model
{
    use HasFactory;

    // protected $cast = [
    //     'is_underage' => 'boolean',
    //     'fever' => 'boolean',
    //     'cough' => 'boolean',
    //     'headache' => 'boolean',
    //     'vomiting' => 'boolean',
    //     'muscle_ache' => 'boolean',
    //     'skin_rashes' => 'boolean'
    // ];

    // relationships User
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
