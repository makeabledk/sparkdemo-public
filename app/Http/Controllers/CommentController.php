<?php

namespace App\Http\Controllers;

use App\Card;
use App\CardList;
use App\Comment;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\Resource;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param CardList $cardList
     * @param Card $card
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, CardList $cardList, Card $card)
    {
        $this->authorize('create', [Comment::class, $card, $cardList]);

        return new Resource(
            tap(new Comment(['creator_id' => Auth::user('api')->id]),
                function ($comment) use ($request, $card) {
                    $card->comments()->save($comment->fill($request->validate([
                        'body' => 'required',
                    ])));
                }
            )
        );
    }

//    /**
//     * Update the specified resource in storage.
//     *
//     * @param  \Illuminate\Http\Request  $request
//     * @param  \App\Comment  $comment
//     * @return \Illuminate\Http\Response
//     */
//    public function update(Request $request, Comment $comment)
//    {
//        //
//    }
//
//    /**
//     * Remove the specified resource from storage.
//     *
//     * @param  \App\Comment  $comment
//     * @return \Illuminate\Http\Response
//     */
//    public function destroy(Comment $comment)
//    {
//        //
//    }
}
