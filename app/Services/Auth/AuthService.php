<?php
namespace App\Services\Auth;

use App\Commons\Enums\RoleEnum;
use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\Carbon;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;

class AuthService {
    private $time;
    private $userModel;
    protected $userRepository;
    
    function __construct(UserRepositoryInterface $userRepository, User $userModel)
    {
        $this->time = Carbon::now();
        $this->userModel = $userModel;
        $this->userRepository = $userRepository;
    }
    // Sanctum Token
    // $token =  $user->createToken('token', ['*'], [
    //     'expires_at' => $this->time->addDay(), 
    // ])->plainTextToken;
    
    // $user->api_token = $token;

    function login(array $data) : User
    {
        if(auth()->attempt($data)){
            $user = auth()->user(); 
            return $user;
        }

        throw ValidationException::withMessages([
            'email' => ['Credential salah'],
        ])->status(401);
    }

    function register(array $data) : User
    {
        $user = $this->userRepository->createDataUser($data);
        $user->assignRole(RoleEnum::REPORTER);
        return $user;
    }

    function logout() : bool
    {
        return auth()->logout() ? true : false;
    }
}

?>
