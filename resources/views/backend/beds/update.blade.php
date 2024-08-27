@extends('layouts.app')
@section('title', 'Beds')

@section('content')
    <div class="container-xxl d-flex">
        <div class="col-md">
            <div class="card">
                <h5 class="card-header">Beds Form</h5>
                <div class="card-body">
                    <form class="browser-default-validation" action="{{ route('beds.update', $beds->id) }}" method="POST">
                        @csrf
                        <div class="form-floating form-floating-outline mb-6" >
                            <select class="form-select cursor-not-allowed" id="hostel" name="hostel_id" disabled>
                                <option value="">Select Hostel</option>
                                @foreach ($hostel as $item)
                                    <option value="{{ $item->id }}"
                                        {{ old('hostel_id', $item->id) === $item->id ? 'selected' : '' }}>
                                        {{ $item->hostel_name }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="basic-default-country">Hostel</label>
                            <small class="text-red-600">
                                @error('hostel_id')
                                    {{ $message }}
                                @enderror
                            </small>
                        </div>
                        <div class="form-floating form-floating-outline mb-6">
                            <select class="form-select cursor-not-allowed" id="room" name="room_id" disabled>
                                <option value="">Select Rooms</option>
                                @foreach ($rooms as $item)
                                    <option value="{{ $item->id }}"
                                        {{ old('room_id', $item->room_id) === $item->id ? 'selected' : '' }}>
                                        {{ $item->room_number }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="basic-default-country">Rooms</label>
                            <small class="text-red-600">
                                @error('room_id')
                                    {{ $message }}
                                @enderror
                            </small>
                        </div>
                        <div class="form-floating form-floating-outline mb-6">
                            <input type="text" class="form-control" id="basic-default-name" placeholder="Bed Number"
                                name="bed_number" value="{{ old('bed_number', $beds->bed_number) }}">
                            <label for="basic-default-name">Bed Number</label>
                            <small class="text-red-600">
                                @error('bed_number')
                                    {{ $message }}
                                @enderror
                            </small>
                        </div>
                        <div class="form-floating form-floating-outline mb-6">
                            <select class="form-select" id="basic-default-country" name="status">
                                <option value="">Select Status</option>
                                <option value="1" {{ old('status', $beds->status) === 1 ? 'selected' : '' }}>Enable
                                </option>
                                <option value="0" {{ old('status', $beds->status) === 0 ? 'selected' : '' }}>Disable
                                </option>
                            </select>
                            <label for="basic-default-country">Status</label>
                            <small class="text-red-600">
                                @error('status')
                                    {{ $message }}
                                @enderror
                            </small>
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
@section('script')
    <script>
       $(document).ready(function () {
        
           let hostelId = $("#hostel").val();
           console.log(hostelId);

           $.ajax({
               type: "post",
               url: "{{ route('beds.rooms') }}",
               data: {
                   hostel_id: hostelId,
                   _token: '{{ csrf_token() }}'
               },
               dataType: "json",
               success: function(response) {
                   $('#room').html('<option value="" selected>Select Rooms</option>');
                   $.each(response, function(key, value) {
                       var option = '<option value="' + value.id + '">' + value.room_number +
                           '</option>';
                       if (value.id == {{ $beds->room_id }}) {
                           option = $(option).prop('selected', true);
                       }
                       $('#room').append(option);
                   });
               }
           });
       });

    </script>
    
@endsection
