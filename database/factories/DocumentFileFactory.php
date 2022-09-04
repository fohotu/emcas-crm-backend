<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DocumentFileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {


        $documentType=[
            'task',
            'answer',
            'work'
        ];

        return [
            'document_id' => $this->faker->numberBetween(1,10),
            'document_type' =>  $documentType[2],
            'file_id' =>  $this->faker->numberBetween(1,300),
        ];
    }
}
