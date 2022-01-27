<?php

namespace Database\Factories;

use App\Models\Elibrary;
use Illuminate\Database\Eloquent\Factories\Factory;

class ElibraryFactory extends Factory
{
    protected $model = Elibrary::class;

    public function definition()
    {
        if (method_exists($this->model, 'definition')) {
            return app($this->model)->definition($this->faker);
        }

        return [];
    }
}
