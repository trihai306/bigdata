<?php

namespace Modules\Field\app\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Field\app\Models\Field;

class FieldPolicy
{
    use HandlesAuthorization;

    public function allowRestify(User $user = null): bool
    {
        return true;
    }

    public function show(User $user = null, Field $model): bool
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

    public function update(User $user, Field $model): bool
    {
        return false;
    }

    public function updateBulk(User $user, Field $model): bool
    {
        return false;
    }

    public function deleteBulk(User $user, Field $model): bool
    {
        return false;
    }

    public function delete(User $user, Field $model): bool
    {
        return false;
    }
}
