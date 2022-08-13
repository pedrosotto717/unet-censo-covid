<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Disease extends Model
{
    use HasFactory;

    protected $fillable = [
        'disease_type',
        'additional_symptoms',
        'attended_in_hospital',
        'fever',
        'skin_rashes',
        'cough',
        'muscle_ache',
        'headache',
        'vomiting'
    ];

    protected $casts = [
        'attended_in_hospital' => 'boolean',
        'fever' => 'boolean',
        'skin_rashes' => 'boolean',
        'cough' => 'boolean',
        'muscle_ache' => 'boolean',
        'headache' => 'boolean',
        'vomiting' => 'boolean'
    ];

    // relationships User
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public static function getTypes()
    {
        return [
            'covid-19',
            'covid-con-variacion',
            'viruela-del-mono'
        ];
    }
}
