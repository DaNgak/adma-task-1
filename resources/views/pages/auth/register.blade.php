@extends('layouts.auth') 

@section('title', "Register") 

@section('content')
    <section class="section">
        <div class="container mt-5">
            <div class="row">
                <div
                    class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2"
                >
                    <div class="login-brand">
                        <img
                            src="{{ asset('assets/img/stisla-fill.svg') }}"
                            alt="logo"
                            width="100"
                            class="shadow-light rounded-circle"
                        />
                    </div>
                    @if ($errors->any())
                        {{-- @dd($errors) --}}
                        {{-- <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach 
                            </ul>
                        </div> --}}
                    @endif
                    <div class="card card-primary">
                        <div class="card-header"><h4>Register</h4></div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('register.store') }}">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="name">Name</label>
                                        <input
                                            id="name"
                                            type="text"
                                            class="form-control"
                                            name="name"
                                            value="{{ old('name') }}"
                                            autofocus
                                        />
                                        @error('name')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="phone_number">Phone Number</label>
                                        <input
                                            id="phone_number"
                                            type="text"
                                            class="form-control"
                                            name="phone_number"
                                            value="{{ old('phone_number') }}"
                                        />
                                        @error('phone_number')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input
                                        id="username"
                                        type="text"
                                        class="form-control"
                                        name="username"
                                        value="{{ old('username') }}"
                                    />
                                    @error('username')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input
                                        id="email"
                                        type="email"
                                        class="form-control"
                                        name="email"
                                        value="{{ old('email') }}"
                                    />
                                    @error('email')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="password" class="d-block"
                                            >Password</label
                                        >
                                        <input
                                            id="password"
                                            type="password"
                                            class="form-control pwstrength"
                                            name="password"
                                        />
                                        @error('password')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="password_confirmation" class="d-block"
                                            >Password Confirmation</label
                                        >
                                        <input
                                            id="password_confirmation"
                                            type="password"
                                            class="form-control"
                                            name="password_confirmation"
                                        />
                                        @error('password_confirmation')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input
                                            type="checkbox"
                                            name="agree"
                                            class="custom-control-input"
                                            id="agree"
                                            required
                                        />
                                        <label
                                            class="custom-control-label"
                                            for="agree"
                                            >I agree with the terms and
                                            conditions</label
                                        >
                                    </div>
                                </div> --}}

                                <div class="form-group">
                                    <button
                                        type="submit"
                                        class="btn btn-primary btn-lg btn-block"
                                    >
                                        Register
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="simple-footer">Copyright &copy; Stisla 2018</div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js')
    <script src="{{ asset('assets/js/page/auth-register.js') }}"></script>
@endpush
