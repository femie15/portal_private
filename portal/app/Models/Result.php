<?php

namespace App\Models;

use Faker\Generator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;

class Result extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function migration(Blueprint $table)
    {
        $table->id();
        // $table->string('name');
        $table->integer('student_id')->nullable();
        $table->integer('subject_id')->nullable();
        $table->string('term')->nullable();
        $table->string('session')->nullable();
        $table->integer('class_id')->nullable();
        $table->integer('section_id')->nullable();
        $table->string('ca1')->nullable();
        $table->string('ca2')->nullable();
        $table->string('text1')->nullable();
        $table->string('text2')->nullable();
        $table->string('exam')->nullable();
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
    public function subject()
    {
        return $this->hasMany(Subject::class, 'id', 'subject_id');
    }

    public function user(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'users', 'id', 'student_id');
    }


    public function seen($term='',$ses='',$sub='',$clid='',$section=''){
        $sum=0;
        $titles=$this->Where('session', $ses)   
        ->Where('term', $term)
        ->Where('subject_id', $sub)
        ->Where('class_id', $clid)
        ->Where('section_id', $section)
        ->get(); 
            if (count($titles)>0) {
                foreach ($titles as $key => $value) {
                    $sum+=$value->ca1+$value->ca2+$value->text1+$value->text2+$value->exam;
                }
                $avg=$sum/count($titles);
// dd($avg);
        }else{
            $avg=0;
        }

        return number_format($avg,2);
    }
}
