@extends('layouts.app')
@section('title', 'Students')

@section('content')

    <div class="col-xxl">
        <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Students</h5> <small class="text-muted float-end"></small>
            </div>
            <div class="card-body">
                {{-- {{dd($role->id)}} --}}
                <form action="{{ route('students.update',$student->id) }}" method="POST">
                    @csrf
                    <div class="form-floating form-floating-outline mb-6">
                        <input type="text" class="form-control" id="basic-default-first_name" placeholder="First Name"
                            name="first_name" value="{{ old('first_name',$student->first_name) }}">
                        <label for="basic-default-first_name">First Name</label>
                        <small class="text-red-600">
                            @error('first_name')
                                {{ $message }}
                            @enderror
                        </small>
                    </div>
                    <div class="form-floating form-floating-outline mb-6">
                        <input type="text" class="form-control" id="basic-default-middle_name" placeholder="First Name"
                            name="middle_name" value="{{ old('middle_name',$student->middle_name) }}">
                        <label for="basic-default-middle_name">Middle Name</label>
                        <small class="text-red-600">
                            @error('middle_name')
                                {{ $message }}
                            @enderror
                        </small>
                    </div>
                    <div class="form-floating form-floating-outline mb-6">
                        <input type="text" class="form-control" id="basic-default-last_name" placeholder="Last Name"
                            name="last_name" value="{{ old('last_name',$student->last_name) }}">
                        <label for="basic-default-last_name">Last Name</label>
                        <small class="text-red-600">
                            @error('last_name')
                                {{ $message }}
                            @enderror
                        </small>
                    </div>
                    <div class="form-floating form-floating-outline mb-6">
                        <input type="number" class="form-control" id="basic-default-phone" placeholder="Mobile Number"
                            name="phone" maxlength="10" pattern="\d{10}" value="{{ old('phone',$student->phone) }}">
                        <label for="basic-default-phone">Mobile Number</label>
                        <small class="text-red-600">
                            @error('phone')
                                {{ $message }}
                            @enderror
                        </small>
                    </div>
                    <div class="form-floating form-floating-outline mb-6">
                        <input type="email" id="basic-default-email" class="form-control" placeholder="Email"
                            name="email" value="{{ old('email',$student->email) }}">
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
                    <div class="form-floating form-floating-outline mb-6">
                        <input type="hidden" class="form-control flatpickr-validation flatpickr-input"
                            placeholder="YYYY-MM-DD" id="basic-default-dob" name="dob"><input
                            class="form-control flatpickr-validation flatpickr-input flatpickr-mobile" tabindex="1"
                            type="date" placeholder="YYYY-MM-DD" name="dob" value="{{ old('dob',$student->dob) }}">
                        <label for="basic-default-dob">DOB</label>
                        <small class="text-red-600">
                            @error('dob')
                                {{ $message }}
                            @enderror
                        </small>
                    </div>
                    <div class="form-floating form-floating-outline mb-6">
                        <select class="form-select" id="basic-default-gender" name="gender">
                            <option value="">Select Gender</option>
                            <option value="male" {{ old('gender',$student->gender) === 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ old('gender',$student->gender) === 'female' ? 'selected' : '' }}>Female</option>
                        </select>
                        <label for="basic-default-gender">Gender</label>
                        <small class="text-red-600">
                            @error('gender')
                                {{ $message }}
                            @enderror
                        </small>
                    </div>
                    <div class="form-floating form-floating-outline mb-6">
                        <textarea class="materialize-textarea form-control h-px-75 resize-none" id="basic-default-address" name="address"
                            placeholder="Address" rows="3" value="">{{ old('address',$student->address) }}</textarea>
                        <label for="basic-default-address">Address</label>
                        <small class="text-red-600">
                            @error('address')
                                {{ $message }}
                            @enderror
                        </small>
                    </div>
                    <div class="form-floating form-floating-outline mb-6">
                        <select class="form-select select2" id="basic-default-country" name="country_id">
                            <option value="{{ old('country_id',$student->country_id) }}" selected="">Select Country</option>
                            @foreach ($country as $item)
                                <option value="{{ $item->id }}" selected="">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        <label for="basic-default-country">Country</label>
                        <small class="text-red-600">
                            @error('country')
                                {{ $message }}
                            @enderror
                        </small>
                    </div>
                    <div class="form-floating form-floating-outline mb-6">
                        <select class="form-select select2" id="basic-default-gender" name="village">
                            <option value="" selected="">Select Village</option>
                            <option value="Anjar" {{ old('village',$student->village) === 'Anjar' ? 'selected' : '' }}>
                                Anjar
                            </option>
                            <option value="Asambiya" {{ old('village',$student->village) === 'Asambiya' ? 'selected' : '' }}>
                                Asambiya
                            </option>
                            <option value="Baladia" {{ old('village',$student->village) === 'Baladia' ? 'selected' : '' }}>
                                Baladia
                            </option>
                            <option value="Bharapur" {{ old('village',$student->village) === 'Bharapur' ? 'selected' : '' }}>
                                Bharapur
                            </option>
                            <option value="Bharasar" {{ old('village',$student->village) === 'Bharasar' ? 'selected' : '' }}>
                                Bharasar
                            </option>
                            <option value="Bhuj" {{ old('village',$student->village) === 'Bhuj' ? 'selected' : '' }}>
                                Bhuj
                            </option>
                            <option value="Dahisara" {{ old('village',$student->village) === 'Dahisara' ? 'selected' : '' }}>
                                Dahisara
                            </option>
                            <option value="Don" {{ old('village',$student->village) === 'Don' ? 'selected' : '' }}>
                                Don
                            </option>
                            <option value="Durgapar" {{ old('village',$student->village) === 'Durgapar' ? 'selected' : '' }}>
                                Durgapar
                            </option>
                            <option value="Fotdi" {{ old('village',$student->village) === 'Fotdi' ? 'selected' : '' }}>
                                Fotdi
                            </option>
                            <option value="Godhra" {{ old('village',$student->village) === 'Godhra' ? 'selected' : '' }}>
                                Godhra
                            </option>
                            <option value="Godpar" {{ old('village',$student->village) === 'Godpar' ? 'selected' : '' }}>
                                Godpar
                            </option>
                            <option value="Goniyasar" {{ old('village',$student->village) === 'Goniyasar' ? 'selected' : '' }}>
                                Goniyasar
                            </option>
                            <option value="Haripur" {{ old('village',$student->village) === 'Haripur' ? 'selected' : '' }}>
                                Haripur
                            </option>
                            <option value="Jakhaniya" {{ old('village',$student->village) === 'Jakhaniya' ? 'selected' : '' }}>
                                Jakhaniya
                            </option>
                            <option value="Kera" {{ old('village',$student->village) === 'Kera' ? 'selected' : '' }}>
                                Kera
                            </option>
                            <option value="Koday" {{ old('village',$student->village) === 'Koday' ? 'selected' : '' }}>
                                Koday
                            </option>
                            <option value="Kodki" {{ old('village',$student->village) === 'Kodki' ? 'selected' : '' }}>
                                Kodki
                            </option>
                            <option value="Kundanpar" {{ old('village',$student->village) === 'Kundanpar' ? 'selected' : '' }}>
                                Kundanpar
                            </option>
                            <option value="Madhapar" {{ old('village',$student->village) === 'Madhapar' ? 'selected' : '' }}>
                                Madhapar
                            </option>
                            <option value="Mandvi" {{ old('village',$student->village) === 'Mandvi' ? 'selected' : '' }}>
                                Mandvi
                            </option>
                            <option value="Mankuva" {{ old('village',$student->village) === 'Mankuva' ? 'selected' : '' }}>
                                Mankuva
                            </option>
                            <option value="Maska" {{ old('village',$student->village) === 'Maska' ? 'selected' : '' }}>
                                Maska
                            </option>
                            <option value="Meghpar" {{ old('village',$student->village) === 'Meghpar' ? 'selected' : '' }}>
                                Meghpar
                            </option>
                            <option value="Merau" {{ old('village',$student->village) === 'Merau' ? 'selected' : '' }}>
                                Merau
                            </option>
                            <option value="Mirjapar" {{ old('village',$student->village) === 'Mirjapar' ? 'selected' : '' }}>
                                Mirjapar
                            </option>
                            <option value="Nagalpur" {{ old('village',$student->village) === 'Nagalpur' ? 'selected' : '' }}>
                                Nagalpur
                            </option>
                            <option value="Naranpur" {{ old('village',$student->village) === 'Naranpur' ? 'selected' : '' }}>
                                Naranpur
                            </option>
                            <option value="Rampar" {{ old('village',$student->village) === 'Rampar' ? 'selected' : '' }}>
                                Rampar
                            </option>
                            <option value="Rayan" {{ old('village',$student->village) === 'Rayan' ? 'selected' : '' }}>
                                Rayan
                            </option>
                            <option value="Samatra" {{ old('village',$student->village) === 'Samatra' ? 'selected' : '' }}>
                                Samatra
                            </option>
                            <option value="Sarli" {{ old('village',$student->village) === 'Sarli' ? 'selected' : '' }}>
                                Sarli
                            </option>
                            <option value="Shirva" {{ old('village',$student->village) === 'Shirva' ? 'selected' : '' }}>
                                Shirva
                            </option>
                            <option value="Sukhpar - Junavas"
                                {{ old('village',$student->village) === 'Sukhpar - Junavas' ? 'selected' : '' }}>
                                Sukhpar - Junavas
                            </option>
                            <option value="Sukhpar - Madanpur"
                                {{ old('village',$student->village) === 'Sukhpar - Madanpur' ? 'selected' : '' }}>
                                Sukhpar - Madanpur
                            </option>
                            <option value="Sukhpar - Roha" {{ old('village',$student->village) === 'Sukhpar - Roha' ? 'selected' : '' }}>
                                Sukhpar - Roha
                            </option>
                            <option value="Surajpur" {{ old('village',$student->village) === 'Surajpur' ? 'selected' : '' }}>
                                Surajpur
                            </option>
                            <option value="Vadasar" {{ old('village',$student->village) === 'Vadasar' ? 'selected' : '' }}>
                                Vadasar
                            </option>
                            <option value="Vekra" {{ old('village',$student->village) === 'Vekra' ? 'selected' : '' }}>
                                Vekra
                            </option>
                        </select>
                        <label for="basic-default-gender">Village</label>
                        <small class="text-red-600">
                            @error('village')
                                {{ $message }}
                            @enderror
                        </small>
                    </div>
                    <div class="form-floating form-floating-outline mb-6">
                        <select class="form-select" id="basic-default-country" name="status">
                            <option value="">Select Status</option>
                            <option value="1" {{ old('status',$student->status) === 1 ? 'selected' : '' }}>Enable</option>
                            <option value="0" {{ old('status',$student->status) === 0 ? 'selected' : '' }}>Disable</option>
                        </select>
                        <label for="basic-default-country">Status</label>
                        <small class="text-red-600">
                            @error('status')
                                {{ $message }}
                            @enderror
                        </small>
                    </div>
                    <div class="mb-3">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="basic-default-checkbox"
                                name="is_any_illness" value="1" {{ old('is_any_illness', false) ? 'checked' : '' }}/>
                            <label class="form-check-label" for="basic-default-checkbox">Do you have any physical or
                                mental illness?</label>
                        </div>
                    </div>
                    <div class="form-floating form-floating-outline mb-6 student_illness_field">
                        <input type="text" class="form-control" id="basic-default-last_name"
                            placeholder="Illness Description" name="illness_description"
                            value="{{ old('illness_description',$student->illness_description) }}">
                        <label for="basic-default-last_name">Describe your
                            illness in brief</label>
                        <small class="text-red-600">
                            @error('illness_description')
                                {{ $message }}
                            @enderror
                        </small>
                    </div>
                    <input type="hidden" name="role_id" value="{{ $role->id }}">
                    <div class="row">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">create</button>
                        </div>
                    </div>
            </div>
            </form>
        </div>
    </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $(".select2").select2();
        });
    </script>
    <script>
        $(document).ready(function() {
            displayIllnessField();

            $('input[name="is_any_illness"]').on('change', function() {
                displayIllnessField();
            });

            function displayIllnessField() {
                var value = $('input[name="is_any_illness"]:checked').val();
                console.log(value);
                if (value == '1') {
                    $('.student_illness_field').show();
                    $('#illness_description').attr('required', false);
                } else {
                    $('.student_illness_field').hide();
                    $('#illness_description').attr('required', false);
                }
            }
        });
    </script>
@endsection
