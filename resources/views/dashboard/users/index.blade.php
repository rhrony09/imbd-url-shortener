@extends('layouts.dashboard')

@section('top-btn')
    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addUser"><i class="fa fa-plus"></i> Add User</button>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="h4 m-0">Admins</div>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped align-middle datatable">
                <thead>
                    <tr>
                        <th width="30px">S/N</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Role</th>
                        <th>URLs</th>
                        @if (auth()->user()->role_id == 1)
                            <th>Action</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($admins as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <div class="user-details">
                                    <img src="{{ $user->profile_picture }}" alt="{{ $user->name }}">
                                    <div class="user-info">
                                        <p>{{ $user->name }}</p>
                                        <p>Username: {{ $user->username ? $user->username : 'N/A' }}</p>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->mobile }}</td>
                            <td>{{ $user->role->name }}</td>
                            <td><span class="badge bg-primary">{{ $user->urls_count }}</span></td>
                            @if (auth()->user()->role_id == 1)
                                <td>
                                    <a href="{{ route('dashboard.users.show', $user->id) }}" class="btn btn-primary btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="View User"><i class="fa fa-eye"></i></a>
                                    @if (auth()->user()->id != $user->id)
                                        <button class="btn btn-danger btn-sm user-delete" data-id="{{ $user->id }}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete User"><i class="fa fa-trash"></i></button>
                                    @endif
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <div class="h4 m-0">Users</div>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped align-middle datatable">
                <thead>
                    <tr>
                        <th width="30px">S/N</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Role</th>
                        <th>URLs</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <div class="user-details">
                                    <img src="{{ $user->profile_picture }}" alt="{{ $user->name }}">
                                    <div class="user-info">
                                        <p>{{ $user->name }}</p>
                                        <p>Username: {{ $user->username ? $user->username : 'N/A' }}</p>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->mobile }}</td>
                            <td>{{ $user->role->name }}</td>
                            <td><span class="badge bg-primary">{{ $user->urls_count }}</span></td>
                            <td>
                                <a href="{{ route('dashboard.users.show', $user->id) }}" class="btn btn-primary btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="View User"><i class="fa fa-eye"></i></a>
                                <button class="btn btn-danger btn-sm user-delete" data-id="{{ $user->id }}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete User"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @include('dashboard.users.modal.user-add')
@endsection

@push('script')
    <script>
        $('#add-user').submit(function(e) {
            e.preventDefault();
            $.ajax({
                method: 'POST',
                url: "{{ route('dashboard.users.add') }}",
                data: $(this).serialize(),
                success: function(response) {
                    if (response.success) {
                        $('#addUser').modal('hide');
                        location.reload();
                    } else {

                    }
                },
                error: function(response) {
                    let errors = response.responseJSON.errors;
                    let errorsHtml = '<div class="alert alert-danger alert-dismissible fade show"><ul class="m-0">';

                    $.each(errors, function(key, value) {
                        errorsHtml += '<li>' + value + '</li>';
                    });
                    errorsHtml += '</ul><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';

                    $('#form-errors').html(errorsHtml);
                }
            });
        });

        $('#password-show').click(function() {
            if ($('#password').attr('type') == 'password') {
                $('#password').attr('type', 'text');
                $('#password-show i').removeClass('fa-eye').addClass('fa-eye-slash');
            } else {
                $('#password').attr('type', 'password');
                $('#password-show i').removeClass('fa-eye-slash').addClass('fa-eye');
            }
        });

        $('.user-delete').click(function() {
            let url = "{{ route('dashboard.users.delete', ':id') }}";
            url = url.replace(':id', $(this).data('id'));
            delete_warning(url);
        });
    </script>
@endpush
