@extends('layouts.frontend')

@section('content')
    <div class="row main-content-wrapper">
        <div class="col-lg-8 mx-auto">
            <div class="card shadow rounded-4 my-4">
                <div class="card-body p-4 p-md-5">
                    <div class="text-center mb-5">
                        <h1 class="fw-bold">URL Shortener Chrome Extension</h1>
                        <p class="lead text-muted">Shorten any URL with a single click directly from your browser</p>
                    </div>

                    <div class="mb-5">
                        <div class="card mb-4 border-0 bg-light">
                            <div class="card-body p-4">
                                <div class="row align-items-center">
                                    <div class="col-md-8">
                                        <h3>Version 1.0.1</h3>
                                        <p class="mb-2">Released: 04 April, 2025</p>
                                        <ul class="mb-0">
                                            <li>Faster URL shortening process</li>
                                            <li>Custom short URL support</li>
                                            <li>One-click copy to clipboard</li>
                                        </ul>
                                    </div>
                                    <div class="col-md-4 text-md-end mt-3 mt-md-0">
                                        <a href="{{ asset('uploads/imbd-url-shortener-extension.zip') }}" class="btn brand-btn btn-lg px-4 py-2" download>
                                            <i class="fa-solid fa-arrow-down-to-line"></i> Download Now
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-5">
                        <h2 class="fw-bold mb-4">Installation Guide</h2>
                        <p>Follow these simple steps to install our extension:</p>
                        <ol>
                            <li class="mb-2">Download the extension file by clicking the button above</li>
                            <li class="mb-2">Extract the downloaded <code>.zip</code> file</li>
                            <li class="mb-2">Open Chrome and navigate to <code>chrome://extensions</code></li>
                            <li class="mb-2">Enable "Developer mode" in the top-right corner</li>
                            <li class="mb-2">Drag and drop the extracted folder into the extensions page</li>
                            <li class="mb-2">Click "Add extension" if prompted</li>
                            <li class="mb-2">The URL shortener icon will appear in your browser toolbar</li>
                        </ol>
                    </div>

                    <div class="mb-5">
                        <h2 class="fw-bold mb-4">Video Tutorial</h2>
                        <p>Watch our video tutorial for a quick guide on installation and how to use the URL shortener:</p>
                        <div class="ratio ratio-16x9 mt-3">
                            <iframe src="https://www.youtube.com/embed/frTfeVlB4H4" title="URL Shortener Extension Tutorial" allowfullscreen></iframe>
                        </div>
                    </div>

                    <div class="my-4">
                        <h2 class="fw-bold mb-4">Frequently Asked Questions</h2>
                        <div class="accordion" id="faqAccordion">
                            <div class="accordion-item border-0 mb-3 shadow-sm">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Is this extension free to use?
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        Yes, our URL shortener extension is completely free to use. You can shorten as many
                                        URLs as you like without any limitations.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item border-0 mb-3 shadow-sm">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Do shortened URLs expire?
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        No, URLs shortened with our extension do not expire and will remain active
                                        indefinitely.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item border-0 mb-3 shadow-sm">
                                <h2 class="accordion-header" id="headingThree">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        Is my browsing data being collected?
                                    </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        No, our extension only accesses the current URL when you explicitly click the
                                        shortening button. We do not track your browsing history, collect personal data, or
                                        monitor your online activity. We only store the shortened URLs you create and their
                                        analytics.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item border-0 shadow-sm">
                                <h2 class="accordion-header" id="headingFour">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                        Which browsers are supported?
                                    </button>
                                </h2>
                                <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        Currently, our extension is available for Google Chrome and Edge. We plan to release
                                        versions for Firefox and Safari in the future.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-5">
                        <h2 class="fw-bold mb-4">How It Works</h2>
                        <div class="row text-center">
                            <div class="col-md-4 mb-4 mb-md-0">
                                <div class="p-3">
                                    <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                                        <i class="fa-solid fa-download fa-2x" style="color: var(--rh-primary-color);"></i>
                                    </div>
                                    <h4>1. Install</h4>
                                    <p class="text-muted">Download and add our extension to your browser</p>
                                </div>
                            </div>
                            <div class="col-md-4 mb-4 mb-md-0">
                                <div class="p-3">
                                    <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                                        <i class="fa-solid fa-mouse-pointer fa-2x" style="color: var(--rh-primary-color);"></i>
                                    </div>
                                    <h4>2. Click the Icon</h4>
                                    <p class="text-muted">Click our extension icon while on any webpage</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="p-3">
                                    <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                                        <i class="fa-solid fa-link fa-2x" style="color: var(--rh-primary-color);"></i>
                                    </div>
                                    <h4>3. Share Your Link</h4>
                                    <p class="text-muted">Copy and share your shortened URL anywhere</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .accordion-button:not(.collapsed) {
            background-color: var(--rh-primary-color);
            color: white;
        }

        .accordion-button:focus {
            box-shadow: none;
            border-color: rgba(0, 0, 0, .125);
        }
    </style>
@endpush
