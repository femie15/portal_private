<?php

namespace App\Models;

use Faker\Generator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\SoftDeletes;

class Classed extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $guarded = [];

    public function migration(Blueprint $table)
    {
        $table->id();
        $table->string('name');
        $table->timestamp('created_at')->nullable();
        $table->timestamp('updated_at')->nullable();
        $table->timestamp('deleted_at')->nullable();
    }

    public function definition(Generator $faker)
    {
        return [
            'name' => $faker->word,
            'created_at' => $faker->dateTimeBetween(now()->subMonth()),
        ];
    }

    // public function school(): BelongsToMany
    // {
    //     return $this->belongsToMany(School::class);
    // }

    public function user(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'users', 'class_id', 'id');
    }

}
