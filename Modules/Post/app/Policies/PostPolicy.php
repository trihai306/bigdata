<?php

namespace Modules\Post\app\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Post\app\Models\Post;

class PostPolicy
{
    use HandlesAuthorization;

    public function allowRestify(User $user = null): bool
    {
        return true;
    }

    public function show(User $user = null, Post $model): bool
    {
        return true;
    }

    public function store(User $user): bool
    {
        return true;
    }

    public function storeBulk(User $user): bool
    {
        return false;
    }

    public function update(User $user, Post $model): bool
    {
        if ($user->id == $model->user_id){
            return true;
        }
        return false;
    }

    public function updateBulk(User $user, Post $model): bool
    {
        return false;
    }

    public function deleteBulk(User $user, Post $model): bool
    {
        return false;
    }

    public function delete(User $user, Post $model): bool
    {
        if ($user->id == $model->user_id){
            return true;
        }
        return false;
    }
}
