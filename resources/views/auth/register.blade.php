@extends('layouts.frontend')

@section('content')
    <div class="row main-content-wrapper">
        <div class="col-lg-5 mx-auto">
            <div class="card rounded-4 my-4">
                <div class="card-body p-4 p-md-5">
                    <div class="text-center mb-4">
                        <h1 class="h3 fw-bold">Create Your Account</h1>
                        <p class="text-muted">Join us to start shortening your URLs</p>
                    </div>

                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Full Name</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="fa-regular fa-user text-muted"></i>
                                </span>
                                <input type="text" class="form-control border-start-0 @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="mobile" class="form-label">Mobile Number</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="fa-regular fa-mobile text-muted"></i>
                                </span>
                                <input type="tel" class="form-control border-start-0 @error('mobile') is-invalid @enderror" id="mobile" name="mobile" value="{{ old('mobile') }}" required autocomplete="tel">
                                @error('mobile')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="fa-regular fa-envelope text-muted"></i>
                                </span>
                                <input type="email" class="form-control border-start-0 @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="fa-regular fa-lock text-muted"></i>
                                </span>
                                <input type="password" class="form-control border-start-0 @error('password') is-invalid @enderror" id="password" name="password" required autocomplete="new-password">
                                <button class="btn border border-start-0 bg-light password-toggle" type="button">
                                    <i class="fa-regular fa-eye text-muted"></i>
                                </button>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-text">Must be at least 8 characters long.</div>
                        </div>

                        <div class="mb-4">
                            <div class="form-check">
                                <input class="form-check-input @error('terms') is-invalid @enderror" type="checkbox" name="terms" id="terms" required>
                                <label class="form-check-label" for="terms">
                                    I agree to the <a href="{{ route('terms') }}" class="text-decoration-none">Terms of Service</a> and <a href="{{ route('privacy') }}" class="text-decoration-none">Privacy Policy</a>
                                </label>
                                @error('terms')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="d-grid mb-4">
                            <button type="submit" class="btn brand-btn btn-lg">
                                <i class="fa-regular fa-user-plus me-2"></i> Create Account
                            </button>
                        </div>

                        <div class="text-center">
                            <p class="mb-0">Already have an account? <a href="{{ route('login') }}" class="text-decoration-none">Sign in</a></p>
                        </div>
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
            const toggleButtons = document.querySelectorAll('.password-toggle');

            toggleButtons.forEach(button => {
                button.addEventListener('click', function() {
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
            });

            // Form validation
            const form = document.querySelector('form');
            const password = document.getElementById('password');
            const passwordConfirm = document.getElementById('password-confirm');

            form.addEventListener('submit', function(event) {
                if (password.value !== passwordConfirm.value) {
                    event.preventDefault();

                    // Create error message
                    const errorDiv = document.createElement('div');
                    errorDiv.classList.add('invalid-feedback', 'd-block');
                    errorDiv.innerHTML = '<strong>Passwords do not match.</strong>';

                    // Remove any existing error message
                    const existingError = passwordConfirm.parentElement.nextElementSibling;
                    if (existingError && existingError.classList.contains('invalid-feedback')) {
                        existingError.remove();
                    }

                    // Add error message after input group
                    passwordConfirm.parentElement.after(errorDiv);

                    // Add invalid class to both password fields
                    password.classList.add('is-invalid');
                    passwordConfirm.classList.add('is-invalid');
                }
            });
        });
    </script>
@endpush
