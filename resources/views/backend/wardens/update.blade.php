@extends('layouts.app')
@section('title', 'Create Course')

@section('content')
    {{-- <div class="container-xxl d-flex"> --}}
        <div class="col-md">
            <div class="card">
                <h5 class="card-header">Browser Default</h5>
                <div class="card-body">
                    <form action="{{ route('warden.update', $warden->id) }}" method="POST">
                        @csrf
                        <div class="form-floating form-floating-outline mb-6">
                            <input type="text" class="form-control" id="basic-default-name" placeholder="First Name"
                                name="first_name" value="{{ old('first_name',$warden->first_name) }}">
                            <label for="basic-default-name">First Name</label>
                            <small class="text-red-600">
                                @error('first_name')
                                    {{ $message }}
                                @enderror
                            </small>
                        </div>
                        <div class="form-floating form-floating-outline mb-6">
                            <input type="text" class="form-control" id="basic-default-name" placeholder="Last Name"
                                name="last_name" value="{{ old('last_name',$warden->last_name) }}">
                            <label for="basic-default-name">Last Name</label>
                            <small class="text-red-600">
                                @error('last_name')
                                    {{ $message }}
                                @enderror
                            </small>
                        </div>
                        <div class="form-floating form-floating-outline mb-6">
                            <input type="number" class="form-control" id="basic-default-name" placeholder="Mobile Number"
                                name="phone" maxlength="10" pattern="\d{10}" value="{{ old('phone',$warden->phone) }}">
                            <label for="basic-default-name">Mobile Number</label>
                            <small class="text-red-600">
                                @error('phone')
                                    {{ $message }}
                                @enderror
                            </small>
                        </div>
                        <div class="form-floating form-floating-outline mb-6">
                            <input type="email" id="basic-default-email" class="form-control" placeholder="Email"
                                name="email" value="{{ old('email',$warden->email) }}">
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
                                    <input type="password" id="bs-validation-password" class="form-control"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                        name="password" value="{{ old('password') }}"/>
                                    <label for="bs-validation-password">Password</label>
                                </div>
                                <span class="input-group-text rounded-end cursor-pointer" id="basic-default-password4"><i
                                        class="mdi mdi-eye-off-outline"></i></span>
                            </div>
                        </div>
                        <div class="form-floating form-floating-outline mb-6">
                            <input type="hidden" class="form-control flatpickr-validation flatpickr-input"
                                placeholder="YYYY-MM-DD" id="basic-default-dob" name="dob"><input
                                class="form-control flatpickr-validation flatpickr-input flatpickr-mobile" tabindex="1"
                                type="date" placeholder="YYYY-MM-DD" name="dob" value="{{ old('dob',$warden->dob) }}">
                            <label for="basic-default-dob">DOB</label>
                            <small class="text-red-600">
                                @error('dob')
                                    {{ $message }}
                                @enderror
                            </small>
                        </div>
                        <div class="form-floating form-floating-outline mb-6">
                            <select class="form-select" id="basic-default-country" name="gender">
                                <option value="">Select Gender</option>
                                <option value="male" {{ old('gender',$warden->gender) === 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ old('gender',$warden->gender) === 'female' ? 'selected' : '' }}>Female</option>
                            </select>
                            <label for="basic-default-country">Gender</label>
                            <small class="text-red-600">
                                @error('gender')
                                    {{ $message }}
                                @enderror
                            </small>
                        </div>
                        <div class="form-floating form-floating-outline mb-6">
                            <textarea class="materialize-textarea form-control h-px-75 resize-none" id="basic-default-bio" name="address"
                                placeholder="Address" rows="3" >{{ old('address',$warden->address) }}</textarea>
                            <label for="basic-default-bio">Address</label>
                            <small class="text-red-600">
                                @error('address')
                                    {{ $message }}
                                @enderror
                            </small>
                        </div>
                        <div class="form-floating form-floating-outline mb-6">
                            <input type="text" class="form-control" id="basic-default-name" placeholder="Experience"
                                name="experience" value="{{ old('experience',$warden->experience) }}">
                            <label for="basic-default-name">Experience</label>
                            <small class="text-red-600">
                                @error('experience')
                                    {{ $message }}
                                @enderror
                            </small>
                        </div>
                        <div class="form-floating form-floating-outline mb-6">
                            <input type="text" class="form-control" id="basic-default-name"
                                placeholder="Qualifications" name="qualification" value="{{ old('qualification',$warden->qualification) }}">
                            <label for="basic-default-name">Qualifications</label>
                            <small class="text-red-600">
                                @error('qualification')
                                    {{ $message }}
                                @enderror
                            </small>
                        </div>
                        {{-- {{dd($warden->status)}} --}}
                        <div class="form-floating form-floating-outline mb-6">
                            <select class="form-select" id="basic-default-country" name="status">
                                <option value="">Select Status</option>
                                <option value="1" {{ old('status',$warden->status) === 1 ? 'selected' : '' }}>Enable</option>
                                <option value="0" {{ old('status',$warden->status) === 0 ? 'selected' : '' }}>Disable</option>
                            </select>
                            <label for="basic-default-country">Status</label>
                            <small class="text-red-600">
                                @error('status')
                                    {{ $message }}
                                @enderror
                            </small>
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
    </div>
@endsection
