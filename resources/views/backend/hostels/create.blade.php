@extends('layouts.app')
@section('title', 'Warden')

@section('content')
    <div class="container-xxl d-flex">
        <div class="col-md">
            <div class="card">
                <h5 class="card-header">Hostel Form</h5>
                <div class="card-body">
                    <form class="browser-default-validation" action="{{ route('hostel.store') }}" method="POST">
                        @csrf
                        <div class="form-floating form-floating-outline mb-6">
                            <input type="text" class="form-control" id="basic-default-name" placeholder="Hostel Name"
                            required="" name="hostel_name" value="{{old('hostel_name')}}">
                            <label for="basic-default-name">Hostel Name</label>
                            <small class="text-red">@error('hostel_name')
                                {{$message}}
                            @enderror</small>
                        </div>
                        <div class="form-floating form-floating-outline mb-6">
                            <textarea class="materialize-textarea form-control h-px-75 resize-none" id="basic-default-bio" name="location"
                                placeholder="Address" rows="3" required=""  value="{{old('location')}}"></textarea>
                            <label for="basic-default-bio">Location</label>
                            <small class="text-red">@error('location')
                                {{$message}}
                            @enderror</small>
                        </div>
                        <div class="form-floating form-floating-outline mb-6">
                            <input type="number" class="form-control" id="basic-default-name" placeholder="Contact Number"
                            required="" name="contact_number" maxlength="10" pattern="\d{10}"  value="{{old('contact_number')}}">
                            <label for="basic-default-name">Contact Number</label>
                            <small class="text-red">@error('contact_number')
                                {{$message}}
                            @enderror</small>
                        </div>
                        <div class="form-floating form-floating-outline mb-6">
                            <input type="number" class="form-control" id="basic-default-name" placeholder="Mobile Number"
                                required="" name="mobile_number" maxlength="10" pattern="\d{10}"  value="{{old('mobile_number')}}">
                                <label for="basic-default-name">Mobile Number</label>
                                <small class="text-red">@error('mobile_number')
                                    {{$message}}
                                @enderror</small>
                            </div>
                            <div class="form-floating form-floating-outline mb-6">
                                <select class="form-select" id="basic-default-country" required="" name="status">
                                    <option value="">Select Status</option>
                                    <option value="1" {{old('status') === 1? 'selected' : ''}}>Enable</option>
                                    <option value="0" {{old('status') === 0? 'selected' : ''}}>Disable</option>
                                </select>
                                <label for="basic-default-country">Status</label>
                                <small class="text-red">@error('status')
                                    {{$message}}
                                @enderror</small>
                            </div>
                            <div class="form-floating form-floating-outline mb-6">
                                <select class="form-select" id="basic-default-country" required="" name="warden_id">
                                    <option value="">Select Warden</option>
                                    @foreach ($warden as $item)
                                    <option value="{{$item->id}}" {{old('warden_id') === $item->id ? 'selected' : ''}}>{{$item->first_name.''.$item->last_name}}</option>   
                                    @endforeach
                                </select>
                                <label for="basic-default-country">Warden</label>
                                <small class="text-red">@error('warden_id')
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