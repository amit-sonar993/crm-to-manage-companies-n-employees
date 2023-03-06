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
              <li class="breadcrumb-item"><a href="#">Companies</a></li>
              <li class="breadcrumb-item active">Create</li>
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
                            <h3 class="card-title">Quick Example</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('companies.store') }}" enctype="multipart/form-data" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Enter name">
                                    @if($errors->has('name'))
                                        <div class="error">{{ $errors->first('name') }}</div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="email">Email address</label>
                                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                                    @if($errors->has('email'))
                                        <div class="error">{{ $errors->first('email') }}</div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="logo">Logo</label>
                                    <input type="file" name="logo" class="dropify" id="logo">
                                    @if($errors->has('logo'))
                                        <div class="error">{{ $errors->first('logo') }}</div>
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
