<?php

namespace App\Policies;

use App\User;
use App\CardList;
use Illuminate\Auth\Access\HandlesAuthorization;

class ListPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the cardList.
     *
     * @param  \App\User  $user
     * @param  \App\CardList  $cardList
     * @return mixed
     */
    public function view(User $user, CardList $cardList)
    {
        return $user->currentTeam()->id === $cardList->team_id;
    }

    /**
     * Determine whether the user can create cardLists.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the cardList.
     *
     * @param  \App\User  $user
     * @param  \App\CardList  $cardList
     * @return mixed
     */
    public function update(User $user, CardList $cardList)
    {
        //
    }

    /**
     * Determine whether the user can delete the cardList.
     *
     * @param  \App\User  $user
     * @param  \App\CardList  $cardList
     * @return mixed
     */
    public function delete(User $user, CardList $cardList)
    {
        //
    }
}
