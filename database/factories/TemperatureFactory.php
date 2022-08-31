<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Temperature>
 */
class TemperatureFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'cur_date' => $this->faker->date('Ymd'),
            'cur_temp' => $this->faker->numberBetween(20, 30),
            'icon' => $this->faker->randomElement(['i10', 'i2','i5','i7']),
        ];
    }
}
