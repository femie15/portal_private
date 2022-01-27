<?php

namespace App\Models;

use Faker\Generator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;

class Affective extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function migration(Blueprint $table)
    {
        $table->id();
        $table->string('name');
        $table->timestamp('created_at')->nullable();
        $table->timestamp('updated_at')->nullable();
    }

    public function definition(Generator $faker)
    {
        return [
            'name' => $faker->word,
            'created_at' => $faker->dateTimeBetween(now()->subMonth()),
        ];
    }

        /**
     * Get all of the comments for the Result
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subjecttrait()
    {
        return $this->hasMany(Subjecttrait::class, 'id', 'subject_id');
    }

    public function user(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'users', 'id', 'student_id');
    }
}
