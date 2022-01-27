<?php

namespace App\Models;

use Faker\Generator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;

class Message extends Model
{
    use HasFactory; 

    protected $guarded = [];
    protected $fillable = [

        'sender' ,
        'receiver' ,
        'message'
    ];

    public function migration(Blueprint $table)
    {
        $table->id();
        $table->string('name');
        $table->bigInteger('sender');
        $table->bigInteger('receiver');
        $table->longText('message');
        $table->timestamp('created_at')->nullable();
        $table->timestamp('updated_at')->nullable();
    }

    public function definition(Generator $faker)
    {
        return [
            'name' => $faker->word,
            'message' => $faker->word,
            'created_at' => $faker->dateTimeBetween(now()->subMonth()),
        ];
    }
    
}
