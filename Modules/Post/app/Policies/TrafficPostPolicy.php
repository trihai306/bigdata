<?php

namespace Modules\Post\app\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Post\app\Models\TrafficPost;

class TrafficPostPolicy
{
    use HandlesAuthorization;

    public function allowRestify(User $user = null): bool
    {
        return true;
    }

    public function show(User $user = null, TrafficPost $model): bool
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

    public function update(User $user, TrafficPost $model): bool
    {
        return true;
    }

    public function updateBulk(User $user, TrafficPost $model): bool
    {
        return true;
    }

    public function deleteBulk(User $user, TrafficPost $model): bool
    {
        return true;
    }

    public function delete(User $user, TrafficPost $model): bool
    {
        return true;
    }
}
