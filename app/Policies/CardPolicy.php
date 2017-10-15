<?php

namespace App\Policies;

use App\CardList;
use App\User;
use App\Card;
use Illuminate\Auth\Access\HandlesAuthorization;

class CardPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create cards.
     *
     * @param  \App\User $user
     * @param Card $card
     * @param CardList $cardList
     * @return mixed
     */
    public function view(User $user, Card $card, CardList $cardList)
    {
        return $user->can('view', $cardList);
    }

    /**
     * Determine whether the user can create cards.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user, CardList $cardList)
    {
        return $user->can('view', $cardList);
    }

    /**
     * Determine whether the user can update the card.
     *
     * @param  \App\User  $user
     * @param  \App\Card  $card
     * @return mixed
     */
    public function update(User $user, Card $card)
    {
        //
    }

    /**
     * Determine whether the user can delete the card.
     *
     * @param  \App\User  $user
     * @param  \App\Card  $card
     * @return mixed
     */
    public function delete(User $user, Card $card)
    {
        //
    }
}
