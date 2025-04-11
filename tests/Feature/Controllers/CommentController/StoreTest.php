<?php

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;

it('can store a comment', function () {
    $user = User::factory()->create();
    $post = Post::factory()->create();

    actingAs($user)->post(route('posts.comments.store', $post), [
        'body' => 'This is a comment',
    ]);

    assertDatabaseHas(Comment::class, [
        'post_id' => $post->id,
        'user_id' => $user->id,
        'body' => 'This is a comment',
    ]);
});

it('redirects to the post show page', function () {
    $post = Post::factory()->create();

    actingAs(User::factory()->create())->post(route('posts.comments.store', $post), [
        'body' => 'This is a comment',
    ])->assertRedirect(route('posts.show', $post));
});

it('requires a valid body', function () {
    $post = Post::factory()->create();

    actingAs(User::factory()->create())->post(route('posts.comments.store', $post), [
        'body' => null,
    ])->assertInvalid('body');
});

it('requires a string body', function ($value) {
    $post = Post::factory()->create();

    actingAs(User::factory()->create())->post(route('posts.comments.store', $post), [
        'body' => $value,
    ])->assertInvalid('body');
})->with([
    null,
    2,
    7.8,
    true,
    str_repeat('a', 2501),
]);
