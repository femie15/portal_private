<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;

class Account extends Model
{
    use HasFactory;

    protected $guarded = [];

    // protected $fillable = [
    //     'account_num', 
    //     'user_id', 
    //     'description', 
    //     'balance',
    // ]; 
}
