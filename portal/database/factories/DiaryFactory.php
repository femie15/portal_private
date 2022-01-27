<?php

namespace Database\Factories;

use App\Models\Diary;
use Illuminate\Database\Eloquent\Factories\Factory;

class DiaryFactory extends Factory
{
    protected $model = Diary::class;

    public function definition()
    {
        if (method_exists($this->model, 'definition')) {
            return app($this->model)->definition($this->faker);
        }

        return [];
    }
}
