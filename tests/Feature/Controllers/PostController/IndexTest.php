<?php

use Inertia\Testing\AssertableInertia;
use function Pest\Laravel\get;

it('should return a correct component', function () {
    get(route('posts.index'))
        ->assertInertia(fn(AssertableInertia $inertia) => $inertia
            ->component('posts/Index', true)
        );
});

it('passes posts to the view', function () {
    get(route('posts.index'))
        ->assertInertia(fn(AssertableInertia $inertia) => $inertia
            ->has('posts')
        );
});
