@extends('layouts.dashboard')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="h4 m-0">All Shortened URLs</div>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped align-middle datatable-no-ordering">
                <thead>
                    <tr>
                        <th>Original URL</th>
                        <th>Short URL</th>
                        <th>Slug</th>
                        <th>Clicks</th>
                        <th>Created</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($urls as $url)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="url-favicon me-2">
                                        <img src="https://www.google.com/s2/favicons?domain={{ parse_url($url->original_url, PHP_URL_HOST) }}"
                                            alt="favicon" width="16" height="16">
                                    </div>
                                    <div class="text-truncate" style="max-width: 250px;" title="{{ $url->original_url }}">
                                        <a href="{{ $url->original_url }}" target="_blank" class="text-decoration-none">
                                            {{ $url->original_url }}
                                        </a>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control" value="{{ route('redirect', $url->slug) }}"
                                        id="url-{{ $url->id }}" readonly>
                                    <button class="btn brand-btn copy-btn" type="button"
                                        data-clipboard-target="#url-{{ $url->id }}"><i
                                            class="bi bi-clipboard"></i></button>
                                </div>
                            </td>
                            <td><code>{{ $url->slug }}</code></td>
                            <td>
                                <span class="badge bg-primary rounded-pill">{{ $url->clicks }}</span>
                            </td>
                            <td>{{ $url->created_at->format('M d, Y') }}</td>
                            <td>
                                <a href="{{ route('redirect', $url->slug) }}" target="_blank"
                                    class="btn btn-sm btn-outline-secondary" title="Open URL"><i
                                        class="bi bi-box-arrow-up-right"></i></a>
                                <button type="button" class="btn btn-sm btn-outline-secondary view-details"
                                    data-url-id="{{ $url->id }}" title="View Details"><i
                                        class="bi bi-bar-chart-line"></i></button>
                                <form action="{{ route('urls.delete', $url->id) }}" method="POST"
                                    class="d-inline delete-url-form" id="delete-form-{{ $url->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete URL"><i
                                            class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- URL Details Modal -->
    <div class="modal fade" id="urlDetailsModal" tabindex="-1" aria-labelledby="urlDetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="urlDetailsModalLabel">URL Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="url-details-loading" class="text-center py-5">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <p class="mt-2 text-muted">Loading URL details...</p>
                    </div>
                    <div id="url-details-content" class="d-none">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <h6 class="fw-bold">Original URL</h6>
                                    <div class="d-flex align-items-center mt-2">
                                        <div class="url-favicon me-2">
                                            <img src="" alt="favicon" width="16" height="16"
                                                id="detail-favicon">
                                        </div>
                                        <a href="#" target="_blank" id="detail-original-url" class="text-break"></a>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <h6 class="fw-bold">Short URL</h6>
                                    <div class="input-group mt-2">
                                        <input type="text" class="form-control" id="detail-short-url" readonly>
                                        <button class="btn brand-btn copy-btn" type="button"
                                            data-clipboard-target="#detail-short-url">
                                            <i class="fa-regular fa-clipboard"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-6">
                                        <h6 class="fw-bold">Slug</h6>
                                        <code id="detail-slug" class="fs-6"></code>
                                    </div>
                                    <div class="col-6">
                                        <h6 class="fw-bold">Created</h6>
                                        <span id="detail-created-at"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h6 class="fw-bold mb-3">Analytics</h6>
                                        <div class="d-flex justify-content-center align-items-center mb-3">
                                            <div class="text-center">
                                                <div class="display-4 fw-bold text-primary" id="detail-clicks">0</div>
                                                <div class="text-muted">Total Clicks</div>
                                            </div>
                                        </div>
                                        <div id="clicks-chart-container">
                                            <canvas id="clicks-chart"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <a href="#" class="btn brand-btn" id="visit-url-btn" target="_blank">Visit URL</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteConfirmModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteConfirmModalLabel">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this shortened URL? This action cannot be undone.</p>
                    <p class="mb-0"><strong>URL:</strong> <span id="delete-url-display" class="text-break"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirm-delete-btn">Delete URL</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('style')
    <style>
        .feature-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 4rem;
            height: 4rem;
            border-radius: 0.75rem;
            color: #fff;
        }

        .text-gradient {
            background: linear-gradient(90deg, #ea1d22, #ff634d);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .brand-btn {
            background-color: #ea1d22 !important;
            border-color: #ea1d22 !important;
            color: white !important;
        }

        .brand-btn:hover,
        .brand-btn:focus {
            background-color: #c0171b !important;
            border-color: #c0171b !important;
        }

        .steps {
            padding: 20px 0;
        }

        .step-item {
            display: flex;
            margin-bottom: 30px;
            align-items: center;
        }

        .step-number {
            background-color: #ea1d22;
            color: white;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin-right: 15px;
            flex-shrink: 0;
        }

        .step-content {
            flex-grow: 1;
        }

        .step-content h4 {
            margin-bottom: 5px;
            font-size: 18px;
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

        #clicks-chart-container {
            height: 200px;
        }
    </style>
@endpush

@push('script')
    <script src="{{ asset('assets/vendor/clipboard.js/clipboard.min.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Clipboard initialization
            var clipboard = new ClipboardJS('.copy-btn');

            clipboard.on('success', function(e) {
                var button = e.trigger;
                var originalHTML = button.innerHTML;

                button.innerHTML = `
                <i class="fa-solid fa-check"></i>
            `;

                setTimeout(function() {
                    button.innerHTML = originalHTML;
                }, 2000);

                e.clearSelection();
            });

            // URL Details Modal
            const urlDetailsModal = new bootstrap.Modal(document.getElementById('urlDetailsModal'));
            const deleteConfirmModal = new bootstrap.Modal(document.getElementById('deleteConfirmModal'));
            let clicksChart = null;

            // View details button click
            document.querySelectorAll('.view-details').forEach(button => {
                button.addEventListener('click', function() {
                    const urlId = this.getAttribute('data-url-id');
                    showUrlDetails(urlId);
                });
            });

            // Delete URL confirmation
            document.querySelectorAll('.delete-url-form').forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();

                    const urlRow = this.closest('tr');
                    const urlDisplay = urlRow.querySelector('a').textContent.trim();

                    document.getElementById('delete-url-display').textContent = urlDisplay;
                    document.getElementById('confirm-delete-btn').setAttribute('data-form-id', this
                        .id);

                    deleteConfirmModal.show();
                });
            });

            // Confirm delete button
            document.getElementById('confirm-delete-btn').addEventListener('click', function() {
                const formId = this.getAttribute('data-form-id');
                const form = document.getElementById(formId);
                if (form) {
                    form.submit();
                }
                deleteConfirmModal.hide();
            });

            // Show URL details
            function showUrlDetails(urlId) {
                document.getElementById('url-details-loading').classList.remove('d-none');
                document.getElementById('url-details-content').classList.add('d-none');

                urlDetailsModal.show();

                // Fetch URL details from the server
                fetch(`/urls/${urlId}/details`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            updateUrlDetailsModal(data.url, data.clicksData);
                        } else {
                            // Handle error
                            console.error('Error loading URL details:', data.error);
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching URL details:', error);
                    })
                    .finally(() => {
                        document.getElementById('url-details-loading').classList.add('d-none');
                        document.getElementById('url-details-content').classList.remove('d-none');
                    });
            }

            // Update URL details modal content
            function updateUrlDetailsModal(url, clicksData) {
                // Update URL details
                document.getElementById('detail-favicon').src =
                    `https://www.google.com/s2/favicons?domain=${new URL(url.original_url).hostname}`;
                document.getElementById('detail-original-url').href = url.original_url;
                document.getElementById('detail-original-url').textContent = url.original_url;

                const shortUrl = `${window.location.protocol}//${window.location.host}/${url.slug}`;
                document.getElementById('detail-short-url').value = shortUrl;
                document.getElementById('detail-slug').textContent = url.slug;
                document.getElementById('detail-created-at').textContent = new Date(url.created_at)
                    .toLocaleDateString();
                document.getElementById('detail-clicks').textContent = url.clicks;

                document.getElementById('visit-url-btn').href = shortUrl;

                // Update clicks chart
                updateClicksChart(clicksData);
            }

            // Update clicks chart
            function updateClicksChart(clicksData) {
                const ctx = document.getElementById('clicks-chart').getContext('2d');

                // Destroy existing chart if it exists
                if (clicksChart) {
                    clicksChart.destroy();
                }

                // Create new chart
                clicksChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: clicksData.labels,
                        datasets: [{
                            label: 'Clicks',
                            data: clicksData.data,
                            backgroundColor: 'rgba(234, 29, 34, 0.2)',
                            borderColor: 'rgba(234, 29, 34, 1)',
                            borderWidth: 2,
                            tension: 0.4,
                            pointBackgroundColor: 'rgba(234, 29, 34, 1)'
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    precision: 0
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                display: false
                            }
                        }
                    }
                });
            }
        });
    </script>
@endpush
