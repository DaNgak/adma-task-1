<?php 

namespace App\Services\User;

use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\Collection;

class UserService 
{
    protected $userRepository;

    function __construct(UserRepositoryInterface $userRepository) {
        $this->userRepository = $userRepository;
    }
    
    function getAllDataUser() : Collection {
        return $this->userRepository->getAllDataUser();
    }
}
