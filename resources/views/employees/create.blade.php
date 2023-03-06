<x-app-layout>
    @section('plugins_css')

    @endsection

    <x-content-header>
        <div class="col-sm-6">
            <h1 class="m-0">Employees</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('employees.index') }}">Employees</a></li>
                <li class="breadcrumb-item active">{{ $employee->id ? 'Update' : 'Create' }}</li>
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
                            <h3 class="card-title"> {{ $employee->id ? 'Update' : 'Create' }} Employees</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ $employee->id ? route('employees.update', $employee->id) : route('employees.store') }}" enctype="multipart/form-data" method="POST">
                            @csrf
                            @if($employee->id)
                            @method('PUT')
                            @endif
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Company</label>
                                    <select name="company_id" class="form-control select2 {{ $errors->has('company_id') ? 'is-invalid' : ''}}" style="width: 100%;">
                                        <option value="">Choose</option>
                                        @foreach($companies as $comp)
                                        <option value="{{ $comp->id }}" {{ old('company_id', $employee->company?$employee->company->id: '') == $comp->id ? 'selected' : '' }}>{{ $comp->name }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('company_id'))
                                    <div class="error invalid-feedback">{{ $errors->first('company_id') }}</div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="name">First Name</label>
                                    <input type="text" class="form-control {{ $errors->has('first_name') ? 'is-invalid' : ''}}" value="{{ old('first_name', $employee->first_name) }}" name="first_name" id="name" placeholder="Enter first name">
                                    @if($errors->has('first_name'))
                                    <div class="error invalid-feedback">{{ $errors->first('first_name') }}</div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="last_name">Last name</label>
                                    <input type="text" name="last_name" value="{{ old('last_name', $employee->last_name) }}" class="form-control {{ $errors->has('last_name') ? 'is-invalid' : ''}}" id="last_name" placeholder="Enter last">
                                    @if($errors->has('last_name'))
                                    <div class="error invalid-feedback">{{ $errors->first('last_name') }}</div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" id="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : ''}}" value="{{ old('email', $employee->email) }}" placeholder="Enter Email">
                                    @if($errors->has('email'))
                                    <div class="error invalid-feedback">{{ $errors->first('email') }}</div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="phone" name="phone" id="phone" class="form-control {{ $errors->has('phone') ? 'is-invalid' : ''}}" value="{{ old('phone', $employee->phone) }}" placeholder="Enter phone">
                                    @if($errors->has('phone'))
                                    <div class="error invalid-feedback">{{ $errors->first('phone') }}</div>
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

    @endsection
    @section('custom_script')
    <script>

    </script>
    @endsection
</x-app-layout>
