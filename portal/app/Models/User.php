<?php

namespace App\Models;

use Bastinald\Ux\Traits\HasHashes;
use Faker\Generator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasFactory, HasHashes, Notifiable;

    public const SEX =['male','female'];
    public const RELIGION =['Christianity','Islam'];

    protected $guarded = [];
    protected $hashes = ['password'];
    protected $hidden = ['password', 'remember_token'];

    public function migration(Blueprint $table)
    {
        $table->id();
        $table->string('name')->index();
        $table->string('email')->unique();
        $table->string('password');

        $table->string('sex')->nullable();
        $table->string('birthday')->nullable();
        $table->string('religion')->nullable();
        $table->string('house')->nullable();
        $table->string('address')->nullable();
        $table->string('phone')->nullable();
        $table->Integer('parent_id')->nullable();
        $table->Integer('school_id')->nullable();
        $table->Integer('class_id')->nullable();
        $table->Integer('section_id')->nullable();
        $table->string('roll')->nullable();
        $table->string('role')->nullable();
        $table->string('state')->nullable();
        $table->string('delet')->nullable();

        $table->rememberToken()->nullable();
        $table->string('timezone')->nullable();
        $table->timestamp('created_at')->nullable()->index();
        $table->timestamp('updated_at')->nullable();
    }

    public function definition(Generator $faker)
    {
        return [
            'name' => $faker->firstName,
            'email' => $faker->unique()->safeEmail,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',

            'sex' => $faker->randomElement(User::SEX),
            'birthday' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'religion' => $faker->randomElement(User::RELIGION),
            'address' => $faker->address,
            'phone' => $faker->phoneNumber,
            'parent_id' => $faker->numberBetween($min = 10, $max = 19),
            'school_id' => $faker->numberBetween($min = 20, $max = 25),
            'class_id' => $faker->numberBetween($min = 1, $max = 6),
            'section_id' => $faker->numberBetween($min = 1, $max = 4),
            'roll' => $faker->numberBetween($min = 1000, $max = 9000),
            'role' => $faker->randomElement(['student','teacher','parent','school']),
            'state' => $faker->randomElement(['Abia','Oyo','Ondo','Lagos']),

            'remember_token' => Str::random(10),
            'timezone' => $faker->timezone,
            'created_at' => $faker->dateTimeBetween(now()->subMonth()),
        ];
    }

    public function result()
    {
        return $this->hasMany(Result::class, 'student_id', 'id');
    }
    public function section()
    {
        return $this->hasMany(Section::class, 'id', 'section_id');
    }
    public function classed()
    {
        return $this->hasMany(Classed::class, 'id', 'class_id');
    }

    public function attendance(): BelongsToMany
    {
        return $this->belongsToMany(Attendance::class, 'attendances', 'name', 'id');
    }

    // public function attendance()
    // {
    //     return $this->hasMany(Attendance::class, 'name', 'id');
    // }
}
