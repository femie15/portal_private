<?php

namespace Database\Factories;

use App\Models\Subjecttrait;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubjecttraitFactory extends Factory
{
    protected $model = Subjecttrait::class;

    public function definition()
    {
        if (method_exists($this->model, 'definition')) {
            return app($this->model)->definition($this->faker);
        }

        return [];
    }
}
