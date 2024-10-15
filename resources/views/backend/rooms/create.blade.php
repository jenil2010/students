@extends('layouts.app')
@section('title', 'Rooms')

@section('content')
    {{-- <div class="container-xxl d-flex"> --}}
        <div class="col-md">
            <div class="card">
                <h5 class="card-header">Rooms Form</h5>
                <div class="card-body">
                    <form class="browser-default-validation" action="{{ route('rooms.store') }}" method="POST">
                        @csrf
                        <div class="form-floating form-floating-outline mb-6">
                            <select class="form-select" id="basic-default-country" required="" name="hostel_id">
                                <option value="">Select Hostel</option>
                                @foreach ($hostel as $item)
                                <option value="{{$item->id}}" {{old('hostel_id') === $item->id ? 'selected' : ''}}>{{$item->hostel_name}}</option>
                                    
                                @endforeach
                            </select>
                            <label for="basic-default-country">Hostel</label>
                            <small class="text-red">@error('hostel_id')
                                {{$message}}
                            @enderror</small>
                        </div>
                        <div class="form-floating form-floating-outline mb-6">
                            <input type="text" class="form-control" id="basic-default-name" placeholder="Room Number"
                            required="" name="room_number" value="{{old('room_number')}}">
                            <label for="basic-default-name">Room Number</label>
                            <small class="text-red">@error('room_number')
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
                                <small class="text-red">@error('room_number')
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