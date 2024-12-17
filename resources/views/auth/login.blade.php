@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6 col-xl-4 mt-5" style="top: 200px">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-header text-center" style="background-image: linear-gradient(to right, #dbe4ff, #f6f9ff);">
                    <h4 class="text-dark font-weight-bold mb-0">LOGIN</h4>
                    <h4 class="text-dark">SISTEM ADMINISTRASI LLDIKTI VII</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="username" class="mb-1"></label>
                            <input placeholder="Username" id="username" type="username" class="form-control py-4 @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                            @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="password" class="mb-1"></label>
                            <div class="input-group">
                                <input placeholder="Password"id="password" type="password" class="form-control py-4 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-outline-secondary" id="togglePassword">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                            <button type="submit" class="btn btn-primary">{{ __('Login') }}</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center" style="background-image: linear-gradient(to right, #dbe4ff, #f6f9ff);">
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



