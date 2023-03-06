<x-app-layout>
    @section('plugins_css')
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('assets/admin-lte/plugins/sweetalert2/sweetalert2.min.css') }}">
    @endsection

    <x-content-header>
        <div class="col-sm-6">
            <h1 class="m-0">Companies</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Companies</li>
            </ol>
        </div><!-- /.col -->
    </x-content-header>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row mb-3">
                <div class="col-12">
                    <a href="{{ route('companies.create') }}" class="btn btn-primary float-right">
                        create
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Logo</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($companies as $index => $company)
                            <tr>
                                <td>{{ $index+1 }}</td>
                                <td>{{ $company->name }}</td>
                                <td>
                                    {{ $company->email }}
                                </td>
                                <td>
                                    <img src="{{asset($company->logo) }}" width="100" width="100">
                                </td>

                                <td class="project-actions text-right">
                                    <a class="btn btn-info btn-sm" href="{{ route('companies.edit', $company->id) }}">
                                        <i class="fas fa-pencil-alt">
                                        </i>
                                        Edit
                                    </a>
                                    <a class="btn btn-danger btn-sm delete-btn" href="{{ route('companies.destroy', $company->id) }}">
                                        <i class="fas fa-trash">
                                        </i>
                                        Delete
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="4">
                                    {{ $companies->links() }}
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
