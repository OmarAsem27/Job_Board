<?php

it('returns a successful responseeee', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});
