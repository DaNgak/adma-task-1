<?php

namespace App\Repositories\User;

use App\Models\User;
use Illuminate\Support\Collection;

interface UserRepositoryInterface
{
    function getAllDataUser() : Collection ;

    function createDataUser(array $data) : User ;
}
