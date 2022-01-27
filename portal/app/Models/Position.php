<?php

namespace App\Models;

use Faker\Generator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;

class Position extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function migration(Blueprint $table)
    {
        $table->id();
        // $table->string('name');
        $table->integer('student_id')->nullable();
        $table->integer('class_id')->nullable();
        $table->integer('section_id')->nullable();
        $table->string('term_id')->nullable();
        $table->string('session')->nullable();
        $table->float('term_avg')->nullable();
        $table->integer('term_position')->nullable();
    }

    public function definition(Generator $faker)
    {
        return [
            'name' => $faker->word,
            'created_at' => $faker->dateTimeBetween(now()->subMonth()),
        ];
    }


    public function user(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'users', 'id', 'student_id');
    }

}
