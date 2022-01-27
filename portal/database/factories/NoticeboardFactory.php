<?php

namespace Database\Factories;

use App\Models\Noticeboard;
use Illuminate\Database\Eloquent\Factories\Factory;

class NoticeboardFactory extends Factory
{
    protected $model = Noticeboard::class;

    public function definition()
    {
        if (method_exists($this->model, 'definition')) {
            return app($this->model)->definition($this->faker);
        }

        return [];
    }
}
