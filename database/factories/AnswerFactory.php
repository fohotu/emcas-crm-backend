<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AnswerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $status=[
            'onTime',
            'late',
            'active',
            'deadTime'
        ];
        return [
            'title' => $this->faker->text(rand(80,120)),
            'description' =>  $this->faker->text(rand(150,200)),
            'viewed' => rand(2,50),
            'status' => $status[rand(0,3)],
            'user_task_id' => $this->faker->numberBetween(1,200),
        ];
    }
}
