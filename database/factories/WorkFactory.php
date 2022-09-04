<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class WorkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->text(rand(20,50)),
            'description' => $this->faker->text(40),
            'term' => $this->faker->unixTime(),
            'category_id' =>$this->faker->numberBetween(1,2),
            'created_by' => $this->faker->numberBetween(1,3),
        ];
    }
}
