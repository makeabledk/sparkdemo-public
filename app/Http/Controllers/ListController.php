<?php

namespace App\Http\Controllers;

use App\CardList;
use App\Events\ListCreated;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Support\Facades\Auth;

class ListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Resource::collection(
            Auth::user('api')->currentTeam()->lists()->with('cards.comments')->get()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        return new Resource(tap(new CardList, function ($list) use ($request) {
            $list->fill($request->validate(['name' => 'required']));
            $list->team_id = Auth::user('api')->currentTeam()->id;
            $list->save();
            $list->load('cards');

            ListCreated::dispatch($list);
        }));
    }
//
//    /**
//     * Update the specified resource in storage.
//     *
//     * @param  \Illuminate\Http\Request  $request
//     * @param  \App\CardList  $cardList
//     * @return \Illuminate\Http\Response
//     */
//    public function update(Request $request, CardList $cardList)
//    {
//        //
//    }
//
//    /**
//     * Remove the specified resource from storage.
//     *
//     * @param  \App\CardList  $cardList
//     * @return \Illuminate\Http\Response
//     */
//    public function destroy(CardList $cardList)
//    {
//        //
//    }
}
