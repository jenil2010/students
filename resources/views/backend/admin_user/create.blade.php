@extends('layouts.app')
@section('title', 'Settings')

@section('content')

   
        <div class="col-md">
            <div class="card">
                @if (session('status'))
                    <div class="alert alert-{{ session('alert-type', 'info') }} alert-dismissible fade show" role="alert">
                        <strong>{{ session('status') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <h5 class="card-header">Admin</h5>
                <div class="card-body">
                    <form class="browser-default-validation" action="{{ route('admin.store') }}" method="POST">
                        @csrf
                        <div class="form-floating form-floating-outline mb-6">
                            <input type="text" class="form-control" id="basic-default-first_name" placeholder="Name"
                                name="name" value="{{ old('name') }}">
                            <label for="basic-default-first_name">Name</label>
                            <small class="text-red-600">
                                @error('name')
                                    {{ $message }}
                                @enderror
                            </small>
                        </div>
                        <div class="form-floating form-floating-outline mb-6">
                            <input type="email" id="basic-default-email" class="form-control" placeholder="Email"
                                name="email" value="{{ old('email') }}">
                            <label for="basic-default-email">Email</label>
                            <small class="text-red-600">
                                @error('email')
                                    {{ $message }}
                                @enderror
                            </small>
                        </div>
                        <div class="mb-4 form-password-toggle">
                            <div class="input-group input-group-merge">
                                <div class="form-floating form-floating-outline">
                                    <input type="password" id="basic-default-password" class="form-control"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                        aria-describedby="basic-default-password3" name="password"
                                        value="{{ old('password') }}" />
                                    <label for="basic-default-password">Password</label>
                                </div>
                                <span class="input-group-text cursor-pointer" id="basic-default-password3"><i
                                        class="mdi mdi-eye-off-outline"></i></span>
                            </div>
                        </div>
                        <input type="hidden" name="role_id" value="{{ $role->id }}">
                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary waves-effect waves-light">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    
@endsection
