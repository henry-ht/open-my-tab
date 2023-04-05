<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rent>
 */
class RentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = ['pending', 'active', 'complete', 'cancelled'];
        $start_date = now()->addHours(random_int(1,6));
        $end_date = $start_date->clone()->addDay(random_int(1,6));
        return [
            'status' => $status[random_int(0,3)],
            'user_id' => User::get()->random()->id,
            'start_date' => $start_date,
            'end_date' => $end_date,
        ];
    }
}
