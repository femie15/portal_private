<?php

namespace Database\Factories;

use App\Models\Classed;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClassedFactory extends Factory
{
    protected $model = Classed::class;

    public function definition()
    {
        if (method_exists($this->model, 'definition')) {
            return app($this->model)->definition($this->faker);
        }

        return [];
    }
}
