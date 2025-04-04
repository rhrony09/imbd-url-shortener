@extends('layouts.frontend')

@section('content')
    <div class="row main-content-wrapper">
        <div class="col-lg-10 mx-auto">
            <div class="card rounded-4 my-4">
                <div class="card-body p-4 p-md-5">
                    <div class="text-center mb-4">
                        <h1 class="fw-bold">Privacy Policy</h1>
                        <p class="text-muted">Last Updated: April 04, 2025</p>
                    </div>

                    <div class="mb-4">
                        <p>{{ $settings->company_name ?? $settings->site_name }} ("us", "we", or "our") operates the {{ $settings->site_name }} website and Chrome extension (the "Service"). This page informs you of our policies regarding the collection, use, and disclosure of Personal Information when you use our Service.</p>

                        <p>We will not use or share your information with anyone except as described in this Privacy Policy. We use your Personal Information for providing and improving the Service. By using the Service, you agree to the collection and use of information in accordance with this policy.</p>
                    </div>

                    <div class="mb-4">
                        <h2 class="h4 fw-bold">1. Information Collection and Use</h2>
                        <p>While using our Service, we may ask you to provide us with certain personally identifiable information that can be used to contact or identify you. Personally identifiable information may include, but is not limited to, your email address, name, and phone number ("Personal Information").</p>
                    </div>

                    <div class="mb-4">
                        <h2 class="h4 fw-bold">2. URL Shortening and Analytics</h2>
                        <p>Our Service provides URL shortening functionality. When you shorten a URL, we collect:</p>

                        <ul>
                            <li>The original URL you are shortening</li>
                            <li>The date and time when the URL was shortened</li>
                            <li>Your IP address (stored in anonymized form)</li>
                        </ul>

                        <p>When someone clicks on a shortened URL, we collect:</p>

                        <ul>
                            <li>The date and time of the click</li>
                            <li>General geographic location based on IP address (country/city level only, IP addresses are not stored)</li>
                            <li>Browser type and operating system</li>
                            <li>Referrer URL (where the click came from, when available)</li>
                        </ul>

                        <p>This information is used to provide click analytics to the creator of the shortened URL and to maintain the security and performance of our Service.</p>
                    </div>

                    <div class="mb-4">
                        <h2 class="h4 fw-bold">3. Chrome Extension Permissions</h2>
                        <p>Our Chrome extension requires certain permissions to function properly:</p>

                        <ul>
                            <li><strong>Access to current tab URL</strong>: This is required to shorten the URL of the page you are currently viewing.</li>
                            <li><strong>Clipboard access</strong>: This allows the extension to copy shortened URLs to your clipboard for easy sharing.</li>
                            <li><strong>Storage</strong>: To save your preferences and settings within the extension.</li>
                        </ul>

                        <p>Our extension does not:</p>

                        <ul>
                            <li>Read or track your browsing history</li>
                            <li>Access your personal data on websites</li>
                            <li>Monitor your browsing activity across different sites</li>
                        </ul>

                        <p>The extension only accesses and shortens a URL when you explicitly click on the extension icon or use the context menu option.</p>
                    </div>

                    <div class="mb-4">
                        <h2 class="h4 fw-bold">4. Log Data</h2>
                        <p>We collect information that your browser sends whenever you visit our Service or when you access the Service through our Chrome extension ("Log Data"). This Log Data may include information such as your computer's Internet Protocol ("IP") address, browser type, browser version, the pages of our Service that you visit, the time and date of your visit, the time spent on those pages and other statistics.</p>
                    </div>

                    <div class="mb-4">
                        <h2 class="h4 fw-bold">5. Cookies</h2>
                        <p>Cookies are files with a small amount of data, which may include an anonymous unique identifier. Cookies are sent to your browser from a web site and stored on your computer's hard drive.</p>

                        <p>We use "cookies" to collect information. You can instruct your browser to refuse all cookies or to indicate when a cookie is being sent. However, if you do not accept cookies, you may not be able to use some portions of our Service.</p>

                        <p>We use the following types of cookies:</p>

                        <ul>
                            <li><strong>Essential cookies</strong>: Required for basic functionality of the Service, like logging in and maintaining sessions.</li>
                            <li><strong>Preference cookies</strong>: Remember your settings and preferences.</li>
                            <li><strong>Analytics cookies</strong>: Help us understand how you use our Service.</li>
                        </ul>
                    </div>

                    <div class="mb-4">
                        <h2 class="h4 fw-bold">6. Service Providers</h2>
                        <p>We may employ third-party companies and individuals to facilitate our Service, to provide the Service on our behalf, to perform Service-related services or to assist us in analyzing how our Service is used.</p>

                        <p>These third parties have access to your Personal Information only to perform these tasks on our behalf and are obligated not to disclose or use it for any other purpose.</p>
                    </div>

                    <div class="mb-4">
                        <h2 class="h4 fw-bold">7. Security</h2>
                        <p>The security of your Personal Information is important to us, but remember that no method of transmission over the Internet, or method of electronic storage is 100% secure. While we strive to use commercially acceptable means to protect your Personal Information, we cannot guarantee its absolute security.</p>
                    </div>

                    <div class="mb-4">
                        <h2 class="h4 fw-bold">8. Links to Other Sites</h2>
                        <p>Our Service may contain links to other sites that are not operated by us. If you click on a third-party link, you will be directed to that third party's site. We strongly advise you to review the Privacy Policy of every site you visit.</p>

                        <p>We have no control over, and assume no responsibility for the content, privacy policies or practices of any third-party sites or services.</p>
                    </div>

                    <div class="mb-4">
                        <h2 class="h4 fw-bold">9. Children's Privacy</h2>
                        <p>Our Service does not address anyone under the age of 13 ("Children"). We do not knowingly collect personally identifiable information from children under 13. If you are a parent or guardian and you are aware that your Children has provided us with Personal Information, please contact us. If we discover that a Children under 13 has provided us with Personal Information, we will delete such information from our servers immediately.</p>
                    </div>

                    <div class="mb-4">
                        <h2 class="h4 fw-bold">10. Compliance With Laws</h2>
                        <p>We will disclose your Personal Information where required to do so by law or subpoena or if we believe that such action is necessary to comply with the law and the reasonable requests of law enforcement or to protect the security or integrity of our Service.</p>
                    </div>

                    <div class="mb-4">
                        <h2 class="h4 fw-bold">11. Data Retention</h2>
                        <p>We will retain your Personal Information only for as long as is necessary for the purposes set out in this Privacy Policy. We will retain and use your Personal Information to the extent necessary to comply with our legal obligations, resolve disputes, and enforce our policies.</p>

                        <p>We retain URL shortening usage data for a period of {{ $settings->data_retention_period ?? '36 months' }} after which it is automatically anonymized or deleted.</p>
                    </div>

                    <div class="mb-4">
                        <h2 class="h4 fw-bold">12. Your Data Protection Rights</h2>
                        <p>Depending on your location, you may have the following data protection rights:</p>

                        <ul>
                            <li>The right to access, update or delete the information we have on you.</li>
                            <li>The right of rectification - the right to have your information corrected if it is inaccurate or incomplete.</li>
                            <li>The right to object - the right to object to our processing of your Personal Information.</li>
                            <li>The right of restriction - the right to request that we restrict the processing of your personal information.</li>
                            <li>The right to data portability - the right to be provided with a copy of the information we have on you in a structured, machine-readable and commonly used format.</li>
                            <li>The right to withdraw consent - the right to withdraw your consent at any time where we relied on your consent to process your personal information.</li>
                        </ul>

                        <p>Please note that we may ask you to verify your identity before responding to such requests. You have the right to complain to a Data Protection Authority about our collection and use of your Personal Information.</p>
                    </div>

                    <div class="mb-4">
                        <h2 class="h4 fw-bold">13. Changes to This Privacy Policy</h2>
                        <p>We may update our Privacy Policy from time to time. We will notify you of any changes by posting the new Privacy Policy on this page and updating the "Last Updated" date at the top of this page.</p>

                        <p>You are advised to review this Privacy Policy periodically for any changes. Changes to this Privacy Policy are effective when they are posted on this page.</p>
                    </div>

                    <div class="mb-4">
                        <h2 class="h4 fw-bold">14. Contact Us</h2>
                        <p>If you have any questions about this Privacy Policy, please contact us at:</p>
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
