@extends('layouts.frontend')

@section('content')
<div class="row main-content-wrapper">
    <div class="col-lg-10 col-md-12">
        <div class="card shadow rounded-4 my-3">
            <div class="card-body p-lg-5 p-3">
                <div class="text-center">
                    <h1 class="display-5 fw-bold">Share Links, <span class="text-gradient">Simplified</span></h1>
                    <p class="lead text-muted">Create short, memorable links in seconds — no account required.</p>
                </div>

                <!-- Success Message -->
                @if (session('success'))
                    <div class="alert alert-success shadow-sm rounded-4 fade-in">
                        <div class="row">
                            <div class="col-12">
                                <h5 class="alert-heading"><i class="fa-solid fa-circle-check"></i> URL Shortened Successfully!</h5>
                                @if (session('url'))
                                    <div class="mt-3">
                                        <p class="mb-1"><strong>Original URL:</strong></p>
                                        <div class="limited-text mb-3 text-muted">
                                            {{ session('url')->original_url }}</div>
                                        <p class="mb-1"><strong>Your Short URL:</strong></p>
                                        <div class="input-group mb-2">
                                            <input type="text" class="form-control" id="shortUrlResult"
                                                value="{{ route('redirect', session('url')->slug) }}" readonly>
                                            <button class="btn brand-btn copy-btn" type="button"
                                                data-clipboard-target="#shortUrlResult">
                                                <i class="fa-regular fa-clipboard"></i>
                                                Copy
                                            </button>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Error Message -->
                @if (session('error'))
                    <div class="alert alert-danger shadow-sm rounded-4">
                        <div>
                            <h5 class="alert-heading"><i class="fa-solid fa-circle-info"></i> Error</h5>
                            <p class="mb-0">{{ session('error') }}</p>
                        </div>
                    </div>
                @endif

                <!-- URL Shortener Form -->
                <form method="POST" action="{{ route('urls.store') }}" class="url-shortener-form">
                    @csrf
                    <div class="mb-4">
                        <label for="original_url" class="form-label fw-bold">URL to shorten</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light">
                                <i class="fa-solid fa-link text-muted"></i>
                            </span>
                            <input type="url"
                                class="form-control form-control @error('original_url') is-invalid @enderror"
                                id="original_url" name="original_url"
                                placeholder="https://paste-your-long-url-here.com"
                                value="{{ old('original_url') }}" required autofocus>
                        </div>
                        @error('original_url')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="custom_slug" class="form-label fw-bold d-flex justify-content-between">
                            <span>Custom slug (optional)</span>
                            <span class="text-muted fw-normal fs-6">{{ request()->getHost() }}/</span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-light">
                                <i class="fa-solid fa-tag text-muted"></i>
                            </span>
                            <input type="text"
                                class="form-control @error('custom_slug') is-invalid @enderror" id="custom_slug"
                                name="custom_slug" placeholder="my-custom-link"
                                value="{{ old('custom_slug') }}">
                        </div>
                        <div class="form-text">Leave empty for an automatically generated short link</div>
                        @error('custom_slug')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid mt-4">
                        <button type="submit" class="btn brand-btn btn-lg">
                            <i class="fa-solid fa-bolt-lightning me-2"></i>Shorten URL
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .text-gradient {
        background: linear-gradient(90deg, var(--rh-primary-color), var(--rh-accent-color));
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    /* Animation */
    .fade-in {
        animation: fadeIn 0.5s;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .copy-btn {
        transition: all 0.2s ease;
    }
    
    /* Make form inputs more modern */
    .form-control {
        border-radius: 0.5rem;
        padding: 0.75rem 1rem;
        border: 1px solid #dee2e6;
        transition: all 0.3s ease;
    }
    
    .form-control:focus {
        border-color: var(--rh-primary-color);
        box-shadow: 0 0 0 0.25rem {{ $settings->site_primary_color }}40;
    }
    
    .input-group-text {
        border-radius: 0.5rem 0 0 0.5rem;
        border: 1px solid #dee2e6;
        border-right: none;
    }
    
    .input-group .form-control {
        border-radius: 0 0.5rem 0.5rem 0;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var clipboard = new ClipboardJS('.copy-btn');

        clipboard.on('success', function(e) {
            var button = e.trigger;
            var originalText = button.innerHTML;

            button.innerHTML = `
            <i class="fa-solid fa-check"></i>
            Copied!
        `;

            setTimeout(function() {
                button.innerHTML = originalText;
            }, 2000);

            e.clearSelection();
        });
    });
</script>
@endpush