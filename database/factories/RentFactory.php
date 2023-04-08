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

        $card = $this->faker->creditCardDetails();
        return [
            'order_state' => $status[random_int(0,3)],
            'user_id' => User::get()->random()->id,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'reference' => $this->faker->numerify('pay-test-####'),
            'payment_method' => '{"payer_email":"'.$this->faker->email().'","payer_name":"'.$card['name'].'","card_number":"4037997623271984","card_date":"2030\/12","card_code":"321","card_name":"VISA"}'
        ];
    }
}
