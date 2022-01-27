<?php

namespace Database\Factories;

use App\Models\Affective;
use Illuminate\Database\Eloquent\Factories\Factory;

class AffectiveFactory extends Factory
{
    protected $model = Affective::class;

    public function definition()
    {
        if (method_exists($this->model, 'definition')) {
            return app($this->model)->definition($this->faker);
        }

        return [];
    }
}
