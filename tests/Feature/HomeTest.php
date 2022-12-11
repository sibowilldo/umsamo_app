<?php

it('redirects to login route when user is not logged in', function () {
    $response = $this->get('/');

    $response->assertStatus(302);
    $response->assertRedirectToRoute('login');
});

