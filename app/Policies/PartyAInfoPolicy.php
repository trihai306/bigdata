<?php

namespace App\Policies;

use App\Models\PartyAInfo;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PartyAInfoPolicy
{
    use HandlesAuthorization;

    public function allowRestify(User $user = null): bool
    {
        return true;
    }

    public function show(User $user = null, PartyAInfo $model): bool
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

    public function update(User $user, PartyAInfo $model): bool
    {
        return false;
    }

    public function updateBulk(User $user, PartyAInfo $model): bool
    {
        return false;
    }

    public function deleteBulk(User $user, PartyAInfo $model): bool
    {
        return false;
    }

    public function delete(User $user, PartyAInfo $model): bool
    {
        return false;
    }
}
