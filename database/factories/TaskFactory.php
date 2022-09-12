<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
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
            'work_id'=>$this->faker->numberBetween(1,10),
            'title'=>$this->faker->text(rand(80,120)),
            'description'=>$this->faker->text(40),
            'created_by' => $this->faker->numberBetween(1,5),
            'status'=>$status[rand(0,3)],
        ];
    }
}
