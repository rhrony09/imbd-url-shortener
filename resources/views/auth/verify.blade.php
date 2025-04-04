@extends('layouts.frontend')

@section('content')
    <div class="row main-content-wrapper">
        <div class="col-lg-5 mx-auto">
            <div class="card rounded-4 my-4">
                <div class="card-body p-4 p-md-5">
                    <div class="text-center mb-4">
                        <h1 class="h3 fw-bold">Verify Your Email Address</h1>
                        <p class="text-muted">We need to verify your email before you can continue</p>
                    </div>

                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            A fresh verification link has been sent to your email address.
                        </div>
                    @endif

                    <div class="text-center mb-4">
                        <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                            <i class="fa-regular fa-envelope-open-text fa-2x" style="color: var(--rh-primary-color);"></i>
                        </div>

                        <p>
                            Before proceeding, please check your email for a verification link.
                            If you did not receive the email, click the button below to request another.
                        </p>
                    </div>

                    <form method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <div class="d-grid mb-4">
                            <button type="submit" class="btn brand-btn btn-lg">
                                <i class="fa-regular fa-paper-plane me-2"></i> Resend Verification Email
                            </button>
                        </div>
                    </form>

                    <div class="text-center">
                        <p class="mb-0">
                            <a href="{{ route('logout') }}" class="text-decoration-none" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fa-regular fa-arrow-right-from-bracket me-1"></i> Logout
                            </a>
                        </p>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
