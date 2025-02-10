<?php

it('loads the admin panel login page successfully', function () {
    $response = $this->get('/admin/login');

    $response->assertStatus(200);
});

it('displays the correct login page content', function () {
    $this->get('/admin/login')
        ->assertStatus(200)
        ->assertSee('Sign in');
});
