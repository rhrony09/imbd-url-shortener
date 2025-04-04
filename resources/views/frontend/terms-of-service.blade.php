@extends('layouts.frontend')

@section('content')
    <div class="row main-content-wrapper">
        <div class="col-lg-10 mx-auto">
            <div class="card rounded-4 my-4">
                <div class="card-body p-4 p-md-5">
                    <div class="text-center mb-4">
                        <h1 class="fw-bold">Terms of Service</h1>
                        <p class="text-muted">Last Updated: April 04, 2025</p>
                    </div>

                    <div class="mb-4">
                        <p>Please read these Terms of Service ("Terms", "Terms of Service") carefully before using the {{ $settings->site_name }} website and Chrome extension (the "Service") operated by {{ $settings->company_name ?? $settings->site_name }} ("us", "we", or "our").</p>

                        <p>Your access to and use of the Service is conditioned on your acceptance of and compliance with these Terms. These Terms apply to all visitors, users, and others who access or use the Service.</p>

                        <p><strong>By accessing or using the Service you agree to be bound by these Terms. If you disagree with any part of the terms, you may not access the Service.</strong></p>
                    </div>

                    <div class="mb-4">
                        <h2 class="h4 fw-bold">1. Accounts</h2>
                        <p>When you create an account with us, you must provide accurate, complete, and current information. Failure to do so constitutes a breach of the Terms, which may result in immediate termination of your account on our Service.</p>

                        <p>You are responsible for safeguarding the password that you use to access the Service and for any activities or actions under your password.</p>

                        <p>You agree not to disclose your password to any third party. You must notify us immediately upon becoming aware of any breach of security or unauthorized use of your account.</p>
                    </div>

                    <div class="mb-4">
                        <h2 class="h4 fw-bold">2. URL Shortening Service</h2>
                        <p>Our Service provides URL shortening functionality through our website and Chrome extension. You agree not to use our Service to shorten URLs that:</p>

                        <ul>
                            <li>Contain malware, viruses, or any code designed to harm computers or networks</li>
                            <li>Link to phishing websites or fraudulent content</li>
                            <li>Infringe on intellectual property rights of others</li>
                            <li>Contain illegal content or violate any applicable laws</li>
                            <li>Contain adult content, pornography, or explicit material</li>
                            <li>Promote violence, discrimination, or hate speech</li>
                            <li>Engage in deceptive practices or misrepresentation</li>
                        </ul>

                        <p>We reserve the right to disable any shortened URL at any time if we determine, in our sole discretion, that the destination URL or use of our Service violates these Terms.</p>
                    </div>

                    <div class="mb-4">
                        <h2 class="h4 fw-bold">3. Intellectual Property</h2>
                        <p>The Service and its original content, features, and functionality are and will remain the exclusive property of {{ $settings->company_name ?? $settings->site_name }} and its licensors. The Service is protected by copyright, trademark, and other laws of both the United States and foreign countries. Our trademarks and trade dress may not be used in connection with any product or service without the prior written consent of
                            {{ $settings->company_name ?? $settings->site_name }}.</p>
                    </div>

                    <div class="mb-4">
                        <h2 class="h4 fw-bold">4. Links To Other Web Sites</h2>
                        <p>Our Service may contain links to third-party web sites or services that are not owned or controlled by {{ $settings->company_name ?? $settings->site_name }}.</p>

                        <p>{{ $settings->company_name ?? $settings->site_name }} has no control over, and assumes no responsibility for, the content, privacy policies, or practices of any third-party web sites or services. You further acknowledge and agree that {{ $settings->company_name ?? $settings->site_name }} shall not be responsible or liable, directly or indirectly, for any damage or loss caused or alleged to be caused by or in connection with use of or reliance on any such content, goods or
                            services available on or through any such web sites or services.</p>

                        <p>We strongly advise you to read the terms and conditions and privacy policies of any third-party web sites or services that you visit.</p>
                    </div>

                    <div class="mb-4">
                        <h2 class="h4 fw-bold">5. Termination</h2>
                        <p>We may terminate or suspend your account immediately, without prior notice or liability, for any reason whatsoever, including without limitation if you breach the Terms.</p>

                        <p>Upon termination, your right to use the Service will immediately cease. If you wish to terminate your account, you may simply discontinue using the Service.</p>

                        <p>All provisions of the Terms which by their nature should survive termination shall survive termination, including, without limitation, ownership provisions, warranty disclaimers, indemnity and limitations of liability.</p>
                    </div>

                    <div class="mb-4">
                        <h2 class="h4 fw-bold">6. Limitation of Liability</h2>
                        <p>In no event shall {{ $settings->company_name ?? $settings->site_name }}, nor its directors, employees, partners, agents, suppliers, or affiliates, be liable for any indirect, incidental, special, consequential or punitive damages, including without limitation, loss of profits, data, use, goodwill, or other intangible losses, resulting from:</p>

                        <ol type="a">
                            <li>Your access to or use of or inability to access or use the Service;</li>
                            <li>Any conduct or content of any third party on the Service;</li>
                            <li>Any content obtained from the Service; and</li>
                            <li>Unauthorized access, use or alteration of your transmissions or content, whether based on warranty, contract, tort (including negligence) or any other legal theory, whether or not we have been informed of the possibility of such damage, and even if a remedy set forth herein is found to have failed of its essential purpose.</li>
                        </ol>
                    </div>

                    <div class="mb-4">
                        <h2 class="h4 fw-bold">7. Disclaimer</h2>
                        <p>Your use of the Service is at your sole risk. The Service is provided on an "AS IS" and "AS AVAILABLE" basis. The Service is provided without warranties of any kind, whether express or implied, including, but not limited to, implied warranties of merchantability, fitness for a particular purpose, non-infringement or course of performance.</p>

                        <p>{{ $settings->company_name ?? $settings->site_name }} its subsidiaries, affiliates, and its licensors do not warrant that:</p>
                        <ol type="a">
                            <li>The Service will function uninterrupted, secure or available at any particular time or location;</li>
                            <li>Any errors or defects will be corrected;</li>
                            <li>The Service is free of viruses or other harmful components; or</li>
                            <li>The results of using the Service will meet your requirements.</li>
                        </ol>
                    </div>

                    <div class="mb-4">
                        <h2 class="h4 fw-bold">8. Governing Law</h2>
                        <p>These Terms shall be governed and construed in accordance with the laws of the United States, without regard to its conflict of law provisions.</p>

                        <p>Our failure to enforce any right or provision of these Terms will not be considered a waiver of those rights. If any provision of these Terms is held to be invalid or unenforceable by a court, the remaining provisions of these Terms will remain in effect. These Terms constitute the entire agreement between us regarding our Service, and supersede and replace any prior agreements we might have between us regarding the Service.</p>
                    </div>

                    <div class="mb-4">
                        <h2 class="h4 fw-bold">9. Changes</h2>
                        <p>We reserve the right, at our sole discretion, to modify or replace these Terms at any time. If a revision is material we will try to provide at least 30 days notice prior to any new terms taking effect. What constitutes a material change will be determined at our sole discretion.</p>

                        <p>By continuing to access or use our Service after those revisions become effective, you agree to be bound by the revised terms. If you do not agree to the new terms, please stop using the Service.</p>
                    </div>

                    <div class="mb-4">
                        <h2 class="h4 fw-bold">10. Contact Us</h2>
                        <p>If you have any questions about these Terms, please contact us at:</p>
                        <ul class="list-unstyled">
                            <li>Email: {{ $settings->email ?? 'cto@imbdagency.com' }}</li>
                            <li>Phone: {{ $settings->phone }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
