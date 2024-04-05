<?php

test('new users can register', function () {
    $response = $this->post('/register', [
        'firstname' => 'Test User',
        'lastname' => 'test',
        'birthdate'=>'1995-05-05',
        'phone-number'=>'0608148879',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $this->assertAuthenticated();
    $response->assertNoContent();
});
