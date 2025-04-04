@extends('layouts.frontend')

@section('content')
    <div class="row main-content-wrapper">
        <div class="col-lg-5 mx-auto">
            <div class="card rounded-4 my-4">
                <div class="card-body p-4 p-md-5">
                    <div class="text-center mb-4">
                        <h1 class="h3 fw-bold">Confirm Password</h1>
                        <p class="text-muted">Please confirm your password before continuing</p>
                    </div>

                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="fa-regular fa-lock text-muted"></i>
                                </span>
                                <input type="password" class="form-control border-start-0 @error('password') is-invalid @enderror" id="password" name="password" required autocomplete="current-password">
                                <button class="btn border border-start-0 bg-light password-toggle" type="button">
                                    <i class="fa-regular fa-eye text-muted"></i>
                                </button>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="d-grid mb-3">
                            <button type="submit" class="btn brand-btn btn-lg">
                                <i class="fa-regular fa-check-circle me-2"></i> Confirm Password
                            </button>
                        </div>

                        @if (Route::has('password.request'))
                            <div class="text-center">
                                <a href="{{ route('password.request') }}" class="text-decoration-none">
                                    Forgot Your Password?
                                </a>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .password-toggle:focus {
            box-shadow: none;
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Password visibility toggle
            const toggleButton = document.querySelector('.password-toggle');

            if (toggleButton) {
                toggleButton.addEventListener('click', function() {
                    const input = this.previousElementSibling;
                    const icon = this.querySelector('i');

                    if (input.type === 'password') {
                        input.type = 'text';
                        icon.classList.remove('fa-eye');
                        icon.classList.add('fa-eye-slash');
                    } else {
                        input.type = 'password';
                        icon.classList.remove('fa-eye-slash');
                        icon.classList.add('fa-eye');
                    }
                });
            }
        });
    </script>
@endpush
