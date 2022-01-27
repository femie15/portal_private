<?php

namespace App\Models;

use Faker\Generator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;

class Noticeboard extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function migration(Blueprint $table)
    {
        $table->id();
        $table->string('notice_title');
        $table->string('notice');
        $table->string('created_timestamp')->nullable();
        $table->timestamp('created_at')->nullable();
        $table->timestamp('updated_at')->nullable();
    }

    public function definition(Generator $faker)
    {
        return [
            'notice_title' => $faker->word,
            'notice' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
            'created_timestamp' => strtotime("08/31/2021"),
            'created_at' => $faker->dateTimeBetween(now()->subMonth()),
        ];
    }
}
