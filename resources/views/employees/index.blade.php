<x-app-layout>
    @section('plugins_css')
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('assets/admin-lte/plugins/sweetalert2/sweetalert2.min.css') }}">
    @endsection

    <x-content-header>
        <div class="col-sm-6">
            <h1 class="m-0">Employees</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Employees</li>
            </ol>
        </div><!-- /.col -->
    </x-content-header>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row mb-3">
                <div class="col-12">
                    <a href="{{ route('employees.create') }}" class="btn btn-primary float-right">
                        create
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Company</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($employees as $index => $employee)
                            <tr>
                                <td>{{ $index+1 }}</td>
                                <td>{{ $employee->first_name }}</td>
                                <td>
                                    {{ $employee->last_name }}
                                </td>
                                <td>
                                    {{$employee->email}}
                                </td>

                                <td>
                                    {{ $employee->company->name}}
                                </td>

                                <td class="project-actions text-right">
                                    <a class="btn btn-info btn-sm" href="{{ route('employees.edit', $employee->id) }}">
                                        <i class="fas fa-pencil-alt">
                                        </i>
                                        Edit
                                    </a>
                                    <a class="btn btn-danger btn-sm delete-btn" href="{{ route('employees.destroy', $employee->id) }}">
                                        <i class="fas fa-trash">
                                        </i>
                                        Delete
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="6">
                                    {{ $employees->links() }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    @section('plugins_script')
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('assets/admin-lte/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    @endsection
    @section('custom_script')
    <script>
        $(document).on('click', '.delete-btn', function(event) {
            event.preventDefault()
            let Url = event.target.href

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
                    $.ajax({
                        url: Url,
                        type: 'DELETE',
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            // Do something with the result
                            if (response.success) {
                                Swal.fire('Deleted!', '', 'success').then(() => {
                                    window.location.reload(true);
                                })
                            }
                        },
                        error: function(error) {
                            Swal.fire('Oops!', '', 'error').then(() => {
                                window.location.reload(true);
                            })
                        }
                    });
                }
            })
        })
    </script>
    @endsection
</x-app-layout>
