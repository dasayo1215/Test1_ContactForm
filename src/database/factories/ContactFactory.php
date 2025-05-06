<?php

namespace Database\Factories;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    protected $model = Contact::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */

    public function definition()
    {
        $faker = $this->faker->locale('ja_JP');
        return [
            'category_id' => $this->faker->numberBetween(1,5),
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'gender' => $this->faker->numberBetween(1,3),
            'email' => $this->faker->unique()->safeEmail,
            'tel' => preg_replace('/-/', '', $this->faker->phoneNumber),
            'address' => $this->faker->prefecture . $this->faker->city . $this->faker->streetAddress,
            'building' => $this->faker->boolean(30) ? $this->faker->secondaryAddress : null,
            'detail' => $this->faker->realText(100)
        ];
    }
}
