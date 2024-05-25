<?php

namespace App\Policies;

use App\Models\PartyBInfo;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PartyBInfoPolicy
{
    use HandlesAuthorization;

    public function allowRestify(User $user = null): bool
    {
        return true;
    }

    public function show(User $user = null, PartyBInfo $model): bool
    {
        return true;
    }

    public function store(User $user): bool
    {
        return false;
    }

    public function storeBulk(User $user): bool
    {
        return false;
    }

    public function update(User $user, PartyBInfo $model): bool
    {
        return false;
    }

    public function updateBulk(User $user, PartyBInfo $model): bool
    {
        return false;
    }

    public function deleteBulk(User $user, PartyBInfo $model): bool
    {
        return false;
    }

    public function delete(User $user, PartyBInfo $model): bool
    {
        return false;
    }
}
