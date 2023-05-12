<?php

namespace Tests\Feature\Auth;
use App\Models\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;

use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use WithFaker;

    /**
     * Test the user registration process.
     *
     * @return void
     */
    public function testUserRegistration()
    {
        $userData = [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail,
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'address' => $this->faker->streetAddress,
            'city' => $this->faker->city,
            'country' => $this->faker->country,
        ];

        $response = $this->post(route('register'), $userData);

        $response->assertRedirect('/'); // Check if user is redirected to the correct page

        $this->assertDatabaseHas('users', [
            'email' => $userData['email'],
        ]);

        $user = User::where('email', $userData['email'])->first();
        $this->assertTrue(Hash::check($userData['password'], $user->password));
    }

    /**
     * Test the validation for user registration.
     *
     * @return void
     */
    public function testUserRegistrationValidation()
    {
        $response = $this->post(route('register'), []);

        $response->assertSessionHasErrors(['first_name', 'last_name', 'email', 'password']);
    }

}
