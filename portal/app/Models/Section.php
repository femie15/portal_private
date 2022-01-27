<?php

namespace App\Models;

use Faker\Generator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;

class Section extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function migration(Blueprint $table)
    {
        $table->id();
        $table->string('name');
        $table->string('nick_name')->nullable();
        $table->integer('class_id')->nullable();
        // $table->foreign('class_id')->references('id')->on('classeds')->ondelete('set null');
        $table->integer('school_id')->nullable();
        // $table->foreign('school_id')->references('id')->on('schools')->ondelete('set null');
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

    public function user(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'users', 'section_id', 'id');
    }
    
}
