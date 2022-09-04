<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class UserTaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {   
        $status = [
            'onTime',
            'late',
            'active',
            'deadTime'
        ];
        return [
            'recipient_id' => rand(1,3),
            'sender_id' => rand(1,3),
            'task_id' => rand(2,50),
            'deadline' => $this->faker->unixTime(),
            'description' => $this->faker->text(50),
            'status' => $status[rand(0,3)],
        ];
    }
}
