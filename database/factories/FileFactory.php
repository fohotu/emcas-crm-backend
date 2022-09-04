<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $ext=$this->faker->fileExtension();
        $link=$this->faker->uuid().'.'.$ext;
        return [
            'title' => $this->faker->word(),
            'link' =>  $link,
            'type' =>  $ext,
        ];
    }
}
