@extends('layouts.app')
@section('title', 'Warden')

@section('content')
    <div class="container-xxl d-flex">
        <div class="col-md">
            <div class="card">
                <h5 class="card-header">Hostel Form</h5>
                <div class="card-body">
                    <form class="browser-default-validation" action="{{ route('beds.store') }}" method="POST">
                        @csrf
                        <div class="form-floating form-floating-outline mb-6">
                            <select class="form-select" id="basic-default-country" required="" name="hostel_id">
                                <option value="">Select Hostel</option>
                                @foreach ($hostel as $item)
                                <option value="{{$item->id}}" {{old('hostel_id') === $item->id ? 'selected' : ''}}>{{$item->hostel_name}}</option>
                                    
                                @endforeach
                            </select>
                            <label for="basic-default-country">Hostel</label>
                        </div>
                        <div class="form-floating form-floating-outline mb-6">
                            <select class="form-select" id="basic-default-country" required="" name="room_id">
                                <option value="">Select Rooms</option>
                                @if ($rooms) 
                                @foreach ($rooms as $item)
                                <option value="{{$item->id}}" {{old('room_id') === $item->id ? 'selected' : ''}}>{{$item->room_number}}</option>
                                @endforeach
                                @endif
                            </select>
                            <label for="basic-default-country">Rooms</label>
                        </div>
                        <div class="form-floating form-floating-outline mb-6">
                            <input type="text" class="form-control" id="basic-default-name" placeholder="Bed Number"
                            required="" name="bed_number" value="{{old('bed_number')}}">
                            <label for="basic-default-name">Bed Number</label>
                        </div>
                            <div class="form-floating form-floating-outline mb-6">
                                <select class="form-select" id="basic-default-country" required="" name="status">
                                    <option value="">Select Status</option>
                                    <option value="1" {{old('status') === 1? 'selected' : ''}}>Enable</option>
                                    <option value="0" {{old('status') === 0? 'selected' : ''}}>Disable</option>
                                </select>
                                <label for="basic-default-country">Status</label>
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