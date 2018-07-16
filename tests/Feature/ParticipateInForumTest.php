<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ParticipateInForumTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function unauthenticated_user_may_no_add_replies()
    {
        $this->expectException('Illuminate\Auth\AuthenticationException');

        $this->post('threads/1/replies',[]);
    }

    /** @test */
    function an_authenticated_user_may_participate_in_forum_threads()
    {
        // Given we have a authenticated user
        //以及登录用户
        $this->be($user = factory('App\Models\User')->create());
        //$user = factory('App\User')->create(); // 未登录用户
        // And an existing thread
        $thread = factory('App\Models\Thread')->create();

        // When the user adds a reply to the thread
        $reply = factory('App\Models\Reply')->make();
        $this->post($thread->path().'/replies',$reply->toArray());

        // Then their reply should be visible on the page
        $this->get($thread->path())
            ->assertSee($reply->body);
    }
}