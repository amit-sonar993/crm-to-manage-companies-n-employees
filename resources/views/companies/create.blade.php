<x-app-layout>
    @section('plugins_css')
    <link href="{{ asset('assets/js/plugins/dropify-master/dist/css/dropify.css') }}" rel="stylesheet" />
    @endsection

    <x-content-header>
        <div class="col-sm-6">
            <h1 class="m-0">Companies</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('companies.index') }}">Companies</a></li>
                <li class="breadcrumb-item active">{{ $company->id ? 'Update' : 'Create' }}</li>
            </ol>
        </div><!-- /.col -->
    </x-content-header>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Company {{ $company->id ? 'Update' : 'Create' }}</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ $company->id ? route('companies.update', $company->id) : route('companies.store') }}" enctype="multipart/form-data" method="POST">
                            @csrf
                            @if($company->id)
                            @method('PUT')
                            @endif
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : ''}}" value="{{ old('name', $company->name) }}" name="name" id="name" placeholder="Enter name">
                                    @if($errors->has('name'))
                                    <div class="error invalid-feedback">{{ $errors->first('name') }}</div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="email">Email address</label>
                                    <input type="email" name="email" value="{{ old('email', $company->email) }}" class="form-control {{ $errors->has('email') ? 'is-invalid' : ''}}" id="exampleInputEmail1" placeholder="Enter email">
                                    @if($errors->has('email'))
                                    <div class="error invalid-feedback">{{ $errors->first('email') }}</div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="logo">Logo</label>
                                    <div class="{{ $errors->has('logo') ? 'is-invalid' : ''}}">
                                        <input type="file" name="logo" class="dropify" id="logo" data-default-file="{{ asset($company->logo) }}">
                                    </div>
                                    @if($errors->has('logo'))
                                    <div class="error invalid-feedback">{{ $errors->first('logo') }}</div>
                                    @endif
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary float-right">Submit</button>
                            </div>
                        </form>
                    </div><!-- /.card -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    @section('plugins_script')
    <script src="{{ asset('assets/js/plugins/dropify-master/dist/js/dropify.js') }}"></script>
    @endsection
    @section('custom_script')
    <script>
        $('.dropify').dropify();
    </script>
    @endsection
</x-app-layout>
