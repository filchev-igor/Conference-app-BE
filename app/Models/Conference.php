<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conference extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'date',
        'time',
        'location',
        'speakers',
        'agendas',
        'participants_ids'
    ];

    protected $casts = [
        'location' => 'array',  // Cast location as array
        'speakers' => 'array',  // Cast speakers to array
        'agendas' => 'array',   // Cast agendas to array
        'participants_ids' => 'array',
    ];
}
