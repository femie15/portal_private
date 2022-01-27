<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;
    protected $fillable = [
        'phrase_id', 
        'phrase', 
        'english', 
        'spanish', 
        'arabic',
        'french',
        'greek',
    ];
}
