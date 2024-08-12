@extends('layouts.app')
@section('title', 'Create Course')

@section('content')
    <div class="container-xxl d-flex">
        <div class="col-md">
            <div class="card">
                <h5 class="card-header">Browser Default</h5>
                <div class="card-body">
                    <form class="browser-default-validation" action="{{ route('warden.update',$id) }}" method="POST">
                        @csrf
                        <div class="form-floating form-floating-outline mb-6">
                            <input type="text" class="form-control" id="basic-default-name" placeholder="First Name"
                                required="" name="first_name" value="{{old('first_name',$warden->first_name)}}">
                            <label for="basic-default-name">First Name</label>
                            <small class="text-red">@error('first_name')
                                {{$message}}
                            @enderror</small>
                        </div>
                        <div class="form-floating form-floating-outline mb-6">
                            <input type="text" class="form-control" id="basic-default-name" placeholder="Last Name"
                                required="" name="last_name"  value="{{old('last_name',$warden->last_name)}}">
                            <label for="basic-default-name">Last Name</label>
                            <small class="text-red">@error('last_name')
                                {{$message}}
                            @enderror</small>
                        </div>
                        <div class="form-floating form-floating-outline mb-6">
                            <input type="number" class="form-control" id="basic-default-name" placeholder="Mobile Number"
                                required="" name="phone" maxlength="10" pattern="\d{10}"  value="{{old('phone',$warden->phone)}}">
                            <label for="basic-default-name">Mobile Number</label>
                            <small class="text-red">@error('phone')
                                {{$message}}
                            @enderror</small>
                        </div>
                        <div class="form-floating form-floating-outline mb-6">
                            <input type="email" id="basic-default-email" class="form-control" placeholder="Email"
                                required="" name="email" value="{{old('email',$warden->email)}}">
                            <label for="basic-default-email">Email</label>
                            <small class="text-red">@error('email')
                                {{$message}}
                            @enderror</small>
                        </div>
                        <div class="form-floating form-floating-outline mb-6">
                            <input type="hidden" class="form-control flatpickr-validation flatpickr-input"
                                placeholder="YYYY-MM-DD" id="basic-default-dob" required="" name="dob"><input
                                class="form-control flatpickr-validation flatpickr-input flatpickr-mobile" tabindex="1"
                                type="date" required="" placeholder="YYYY-MM-DD" name="dob"  value="{{old('dob',$warden->dob)}}">
                            <label for="basic-default-dob">DOB</label>
                            <small class="text-red">@error('dob')
                                {{$message}}
                            @enderror</small>
                        </div>
                        <div class="form-floating form-floating-outline mb-6">
                            <select class="form-select" id="basic-default-country" required="" name="gender">
                                <option value="">Select Gender</option>
                                <option value="male" {{old('gender',$warden->gender) === 'male'? 'selected' : ''}}>Male</option>
                                <option value="female"  {{old('gender',$warden->gender) === 'female'? 'selected' : ''}}>Female</option>
                            </select>
                            <label for="basic-default-country">Gender</label>
                            <small class="text-red">@error('gender')
                                {{$message}}
                            @enderror</small>
                        </div>
                        <div class="form-floating form-floating-outline mb-6">
                            <textarea class="materialize-textarea form-control h-px-75 resize-none" id="basic-default-bio" name="address"
                                placeholder="Address" rows="3" required=""  value="{{old('address',$warden->address)}}"></textarea>
                            <label for="basic-default-bio">Address</label>
                            <small class="text-red">@error('address')
                                {{$message}}
                            @enderror</small>
                        </div>
                        <div class="form-floating form-floating-outline mb-6">
                            <input type="text" class="form-control" id="basic-default-name" placeholder="Experience"
                                required="" name="experience" value="{{old('experience',$warden->experience)}}">
                            <label for="basic-default-name">Experience</label>
                            <small class="text-red">@error('experience')
                                {{$message}}
                            @enderror</small>
                        </div>
                        <div class="form-floating form-floating-outline mb-6">
                            <input type="text" class="form-control" id="basic-default-name" placeholder="Qualifications"
                                required="" name="qualification"  value="{{old('qualification',$warden->qualification)}}">
                            <label for="basic-default-name">Qualifications</label>
                            <small class="text-red">@error('qualification')
                                {{$message}}
                            @enderror</small>
                        </div>
                        <div class="form-floating form-floating-outline mb-6">
                            <select class="form-select" id="basic-default-country" required="" name="status">
                                <option value="">Select Status</option>
                                <option value="1" {{old('status',$warden->status) === 1? 'selected' : ''}}>Enable</option>
                                <option value="0" {{old('status',$warden->status) === 0? 'selected' : ''}}>Disable</option>
                            </select>
                            <label for="basic-default-country">Status</label>
                            <small class="text-red">@error('status')
                                {{$message}}
                            @enderror</small>
                        </div>
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
