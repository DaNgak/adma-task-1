<?php

namespace App\Repositories\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class UserRepository implements UserRepositoryInterface
{
    protected Builder $query;

    function __construct(User $user)
    {
        $this->query = $user->query();
    }

    function getAllDataUser() : Collection {
        return $this->query->get();
    }

    function createDataUser(array $data): User
    {
        return $this->query->create($data);
    }
}
