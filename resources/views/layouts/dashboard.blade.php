<!doctype html>
<html lang="en" class="semi-dark">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset("uploads/logos/$settings->favicon") }}" type="image/png" />
    <style>
        :root {
            --rh-primary-color: {{ $settings->site_primary_color }};
            --rh-accent-color: {{ $settings->site_accent_color }};
        }
    </style>
    <!--plugins-->
    <link href="{{ asset('assets/backend/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/backend/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/backend/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />
    <!-- Bootstrap CSS -->
    <link href="{{ asset('assets/backend/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/backend/css/bootstrap-extended.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/backend/css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/backend/css/icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons-1-11-1.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/font-awsome-6.2.1-pro/css/all.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bs5-datatable/datatable.css') }}" rel="stylesheet" />

    <!-- loader-->
    <link href="{{ asset('assets/backend/css/pace.min.css') }}" rel="stylesheet" />

    <!--Theme Styles-->
    <link href="{{ asset('assets/backend/css/dark-theme.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/backend/css/semi-dark.css') }}" rel="stylesheet" />

    <!--Custom Styles-->
    <link href="{{ asset('assets/backend/css/custom-style.css') }}" rel="stylesheet" />

    @stack('style')
    <title>{{ $settings->site_name }}</title>
</head>

<body>

    <!--start wrapper-->
    <div class="wrapper">

        <!--start top header-->
        @include('sections.dashboard.header')
        <!--end top header-->

        <!--start sidebar -->
        @include('sections.dashboard.sidebar')
        <!--end sidebar -->

        <!--start content-->
        <main class="page-content">

            <!--breadcrumb-->
            @include('sections.dashboard.breadcrumbs')
            <!--end breadcrumb-->

            @yield('content')
        </main>
        <!--end page main-->

        <!--start footer-->
        @include('sections.dashboard.footer')

        <div class="modal fade" id="rhModal" tabindex="-1" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">...</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <i class="fa-duotone fa-spinner fa-spin fa-2x"></i>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </div>
        <!--end footer-->
    </div>
    <!--end wrapper-->

    <!-- Bootstrap bundle JS -->
    <script src="{{ asset('assets/backend/js/bootstrap.bundle.min.js') }}"></script>
    <!--plugins-->
    <script src="{{ asset('assets/backend/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/simplebar/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/metismenu/js/metisMenu.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/backend/js/pace.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/chartjs/js/Chart.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/sweetalert2@11/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bs5-datatable/datatables.js') }}"></script>
    <!--app-->
    <script src="{{ asset('assets/backend/js/app.js') }}"></script>
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        @if (session('success'))
            Toast.fire({
                icon: 'success',
                title: '{{ session('success') }}'
            })
        @endif

        @if (session('error'))
            Toast.fire({
                icon: 'error',
                title: '{{ session('error') }}'
            })
        @endif

        @if (session('warning'))
            Toast.fire({
                icon: 'warning',
                title: '{{ session('warning') }}'
            })
        @endif

        function delete_warning(url) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            });
        }

        function warning(url) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, do it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            });
        }

        $(document).ready(function() {

            new DataTable('.datatable', {
                "pageLength": 25
            });

            new DataTable('.datatable-no-ordering', {
                "pageLength": 25,
                "ordering": false
            });

            new DataTable('.datatable-scroll', {
                scrollX: true
            });
        });
    </script>
    @stack('script')

</body>

</html>
