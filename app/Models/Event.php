<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'name',
        'num_people',
        'contact',
        'note',
        'start',
        'end',
        'approved',
    ];
}
