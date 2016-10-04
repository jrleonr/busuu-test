<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Rating;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * 
 */
class CommentController extends Controller
{
    /**
     * Post a rate for a comment
     * @param  Request $request         Post data
     * @param  int  $id                 Comment id
     * @return boolean                  True if result is fine
     *
     * @throws ModelNotFoundException   If comment doesn't exit send a Model Exception
     */
    public function postRate(Request $request, $id)
    {
        $comment = Comment::whereId($id)->firstOrFail();

        $rating = Rating::firstOrNew(['user_id' => $request->input('user_id'), 'comment_id' => $comment->id]);

        //if user never vote for this comment before
        if (is_null($rating->rate)) {
            $comment->score = ($request->input('rate')) ? $comment->score + 1 :  $comment->score - 1;
        }
        //if the rate is dif than before add or remove 2 to the score
        elseif ($rating->rate != $request->input('rate')) {
            $comment->score = ($request->input('rate')) ? $comment->score + 2 : $comment->score - 2;
        }

        $comment->save();

        $rating->rate = $request->input('rate');
        $rating->save();

        return response()->json([
            'rating' => $rating->rate,
            'code' => '200'
        ]);
    }

    /**
     *  Get total score from a commet
     * @param  int $id Id for the comment
     * @return int     Total score for one comment
     */
    public function getTotalScore($id)
    {
        $comment = Comment::whereId($id)->first();

        return response()->json([
            'score' => $comment->score,
            'code' => '200'
        ]);
    }
}
