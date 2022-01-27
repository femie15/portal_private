<?php

namespace Database\Factories;

use App\Models\Traits;
use Illuminate\Database\Eloquent\Factories\Factory;

class TraitsFactory extends Factory
{
    protected $model = Traits::class;

    public function definition()
    {
        if (method_exists($this->model, 'definition')) {
            return app($this->model)->definition($this->faker);
        }

        return [];
    }
}
