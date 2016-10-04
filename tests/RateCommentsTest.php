<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;



class RateCommentsTest extends TestCase
{
    /**
     * @test
     * Dislikes a comment
     *
     * @return void
     */
    public function it_dislikes_a_comment()
    {
        $rate = 0;
        $user_id = 1;

        $comment = new App\Comment(['text' => 'Comment', 'user_id' => $user_id, 'score' => 5]);
        $comment->save();

        $rating = new App\Rating(['user_id' => $user_id, 'comment_id' => $comment->id, 'rate' => $rate]);
        $rating->save();
                

        $this->json('POST', "api/comment/{$comment->id}/rate", ['user_id' => $user_id, 'rate' => $rate])
         ->seeJson([
             'rating' => $rate,
             'score' => $comment->score - 1,
             'code' => '200'
         ]);
    }

     /**
     * @test
     * Likes a comment
     *
     * @return void
     */
    public function it_likes_a_comment()
    {
        $rate = 1;
        $user_id = 1;

        $comment = new App\Comment(['text' => 'Comment', 'user_id' => $user_id, 'score' => 5]);
        $comment->score = $comment->score + $rate;
        $comment->save();

        $rating = new App\Rating(['user_id' => $user_id, 'comment_id' => $comment->id, 'rate' => $rate]);
        $rating->save();
                

        $this->json('POST', "api/comment/{$comment->id}/rate", ['user_id' => $user_id, 'rate' => $rate])
         ->seeJson([
             'rating' => $rate,
             'score' => $comment->score + 1,
             'code' => '200'
         ]);
    } 
}
