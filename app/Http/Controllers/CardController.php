<?php

namespace App\Http\Controllers;

use App\Card;
use App\CardList;
use App\Events\CardCreated;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Validation\UnauthorizedException;

class CardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param CardList $cardList
     */
    public function show(CardList $cardList, Card $card)
    {
        $this->authorize('view', [$card, $cardList]);

        return new Resource(
            $cardList->cards()->findOrFail($card->id)->load('comments')->get()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param CardList $cardList
     */
    public function store(Request $request, CardList $cardList)
    {
        $this->authorize('create', [Card::class, $cardList]);

        return new Resource (tap(new Card(['creator_id' => Auth::user('api')->id]),
            function ($card) use ($request, $cardList) {
                $cardList->cards()->save($card->fill($request->validate([
                    'title' => 'required',
                ])));
                CardCreated::dispatch($card);
            }
        ));
    }
//
//    /**
//     * Update the specified resource in storage.
//     *
//     * @param  \Illuminate\Http\Request $request
//     * @param CardList $list
//     * @param  \App\Card $card
//     * @return \Illuminate\Http\Response
//     */
//    public function update(Request $request, CardList $list, Card $card)
//    {
//        //
//    }
//
//    /**
//     * Remove the specified resource from storage.
//     *
//     * @param CardList $list
//     * @param  \App\Card $card
//     * @return \Illuminate\Http\Response
//     */
//    public function destroy(CardList $list, Card $card)
//    {
//        //
//    }
}
