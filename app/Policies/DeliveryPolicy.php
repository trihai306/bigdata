<?php

namespace App\Policies;

use App\Models\Delivery;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DeliveryPolicy
{
    use HandlesAuthorization;

    public function allowRestify(User $user = null): bool
    {
        return true;
    }

    public function show(User $user = null, Delivery $model): bool
    {
        return true;
    }

    public function store(User $user): bool
    {
        return true;
    }

    public function storeBulk(User $user): bool
    {
        return true;
    }

    public function update(User $user, Delivery $model): bool
    {
        return true;
    }

    public function updateBulk(User $user, Delivery $model): bool
    {
        return true;
    }

    public function deleteBulk(User $user, Delivery $model): bool
    {
        return true;
    }

    public function delete(User $user, Delivery $model): bool
    {
        return true;
    }
}
