<?php
use Faker\Factory as Faker;
test('new users can register', function () {
    $faker = Faker::create();
    $password = $faker->password;
    $response = $this->post('/register', [
        'role' => 1,
        'firstname' => $faker->firstName,
        'lastname' => $faker->lastName,
        'birthdate'=>$faker->date,
        'phone_number'=>$faker->phoneNumber,
        'email' => $faker->email,
        'password' => $password,
        'password_confirmation' => $password
    ]);

    $this->assertAuthenticated();
    $response->assertNoContent();
});
