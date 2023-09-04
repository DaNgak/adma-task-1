<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\Auth\AuthService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        // $this->activity = $activity;
        $this->authService = $authService;
    }

    function loginView() : View {
        return view('pages.auth.login');
    }

    function login(LoginRequest $request) : RedirectResponse {
        try {
            $this->authService->login($request->validated());
            Alert::success('Login berhasil', 'Masuk kedalam sistem');
            return redirect()->route('dashboard');
        } catch (ValidationException $e) {
            return back()->withErrors(['email' => $e->validator->getMessageBag()->first()]);
        }
    }

    function registerView() : View {
        return view('pages.auth.register');
    }

    function register(RegisterRequest $request) : RedirectResponse {
        $this->authService->register($request->validated());
        Alert::success('Register berhasil', 'Silahkan login kedalam sistem');
        return redirect()->route('login');
    }

    function logout() : RedirectResponse {
        $result = $this->authService->logout();

        if ($result) {
            return redirect()->route('login');
        }

        return back();
    }
}
