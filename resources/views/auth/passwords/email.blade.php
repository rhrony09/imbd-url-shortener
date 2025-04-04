@extends('layouts.frontend')

@section('content')
    <div class="row main-content-wrapper">
        <div class="col-lg-5 mx-auto">
            <div class="card rounded-4 my-4">
                <div class="card-body p-4 p-md-5">
                    <div class="text-center mb-4">
                        <h1 class="h3 fw-bold">Reset Password</h1>
                        <p class="text-muted">Enter your email to receive a password reset link</p>
                    </div>

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="email" class="form-label">Email Address</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="fa-regular fa-envelope text-muted"></i>
                                </span>
                                <input type="email" class="form-control border-start-0 @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="d-grid mb-4">
                            <button type="submit" class="btn brand-btn btn-lg">
                                <i class="fa-regular fa-paper-plane me-2"></i> Send Reset Link
                            </button>
                        </div>

                        <div class="text-center">
                            <p class="mb-0">Remember your password? <a href="{{ route('login') }}" class="text-decoration-none">Back to login</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
