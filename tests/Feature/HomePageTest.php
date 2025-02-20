<?php

test('homepage redirects to /admin/login', function () {
    $response = $this->get('/');

    $response->assertStatus(302)
        ->assertRedirect('/admin/login');
});
