@extends('layouts.app')
@section('title', 'Settings')
@section('content')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bs-stepper/bs-stepper.css') }}" />
    <div class="col-12">
        {{-- <small class="text-light fw-medium">Vertical</small> --}}
        <div class="bs-stepper vertical wizard-modern wizard-modern-vertical mt-2">
            <div class="bs-stepper-header gap-lg-2">
                <div class="step" data-target="#account-details-modern-vertical">
                    <button type="button" class="step-trigger">
                        <span class="bs-stepper-circle"><i class="mdi mdi-check"></i></span>
                        <span class="bs-stepper-label">
                            <span class="bs-stepper-number">01</span>
                            <span class="d-flex flex-column gap-1 ms-2">
                                <span class="bs-stepper-title">Basic Details</span>
                                {{-- <span class="bs-stepper-subtitle">Setup Account Details</span> --}}
                            </span>
                        </span>
                    </button>
                </div>
                <div class="line"></div>
                <div class="step" data-target="#personal-info-modern-vertical">
                    <button type="button" class="step-trigger">
                        <span class="bs-stepper-circle"><i class="mdi mdi-check"></i></span>
                        <span class="bs-stepper-label">
                            <span class="bs-stepper-number">02</span>
                            <span class="d-flex flex-column gap-1 ms-2">
                                <span class="bs-stepper-title">Family Details</span>
                                {{-- <span class="bs-stepper-subtitle">Add personal info</span> --}}
                            </span>
                        </span>
                    </button>
                </div>
                <div class="line"></div>
                <div class="step" data-target="#social-links-modern-vertical">
                    <button type="button" class="step-trigger">
                        <span class="bs-stepper-circle"><i class="mdi mdi-check"></i></span>
                        <span class="bs-stepper-label">
                            <span class="bs-stepper-number">03</span>
                            <span class="d-flex flex-column gap-1 ms-2">
                                <span class="bs-stepper-title">Educational Details</span>
                                {{-- <span class="bs-stepper-subtitle">Add social links</span> --}}
                            </span>
                        </span>
                    </button>
                </div>
            </div>
            <div class="bs-stepper-content m-5">
                <form action="{{ route('addmission.store') }}" method="POST" id="num" enctype="multipart/form-data" >
                    @csrf
                    <!-- Account Details -->
                    <div id="account-details-modern-vertical" class="content">
                        <div class="content-header mb-3">
                            <h6 class="mb-0">Basic Details</h6>
                            {{-- <small>Enter Your Account Details.</small> --}}
                        </div>
                        <div class="row g-4">
                            <div class="col-sm-4">
                                <div class="form-floating form-floating-outline col-auto">
                                    <select class="form-select select2" id="student_id" name="student_id">
                                        <option value="" selected="">Select Student</option>
                                        @foreach ($student as $item)
                                            <option value="{{ $item->id }}" >
                                                {{ $item->first_name . ' ' . $item->last_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="country_id">Student</label>
                                    <small class="text-red-600">
                                        @error('country')
                                            {{ $message }}
                                        @enderror
                                    </small>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-floating form-floating-outline ">
                                    <input type="text" class="form-control" id="first_name" placeholder="First Name"
                                        name="first_name" value="{{ old('first_name') }}">
                                    <label for="basic-default-first_name">First Name</label>
                                    <small class="text-red-600">
                                        @error('first_name')
                                            {{ $message }}
                                        @enderror
                                    </small>
                                </div>
                            </div>
                            <div class="col-sm-4">

                                <div class="form-floating form-floating-outline ">
                                    <input type="text" class="form-control" id="middle_name" placeholder="First Name"
                                        name="middle_name" value="{{ old('middle_name') }}">
                                    <label for="basic-default-middle_name">Middle Name</label>
                                    <small class="text-red-600">
                                        @error('middle_name')
                                            {{ $message }}
                                        @enderror
                                    </small>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-floating form-floating-outline ">
                                    <input type="text" class="form-control" id="last_name" placeholder="Last Name"
                                        name="last_name" value="{{ old('last_name') }}">
                                    <label for="basic-default-last_name">Last Name</label>
                                    <small class="text-red-600">
                                        @error('last_name')
                                            {{ $message }}
                                        @enderror
                                    </small>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-floating form-floating-outline ">
                                    <input type="number" class="form-control" id="phone" placeholder="Mobile Number"
                                        name="phone" maxlength="10" pattern="\d{10}" value="{{ old('phone') }}">
                                    <label for="basic-default-phone">Mobile Number</label>
                                    <small class="text-red-600">
                                        @error('phone')
                                            {{ $message }}
                                        @enderror
                                    </small>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-floating form-floating-outline ">
                                    <input type="email" id="email" class="form-control" placeholder="Email"
                                        name="email" value="{{ old('email') }}">
                                    <label for="basic-default-email">Email</label>
                                    <small class="text-red-600">
                                        @error('email')
                                            {{ $message }}
                                        @enderror
                                    </small>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-floating form-floating-outline ">
                                    {{-- {{ old('dob') }} --}}
                                    <input type="hidden" class="form-control flatpickr-validation flatpickr-input"
                                        placeholder="YYYY-MM-DD" id="dob" name="dob"><input
                                        class="form-control flatpickr-validation flatpickr-input flatpickr-mobile"
                                        tabindex="1" type="date" placeholder="YYYY-MM-DD" name="dob"
                                        value="{{ old('dob') }}" id="dobs">
                                    <label for="basic-default-dob">DOB</label>
                                    <small class="text-red-600">
                                        @error('dob')
                                            {{ $message }}
                                        @enderror
                                    </small>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-floating form-floating-outline ">
                                    <select class="form-select" id="gender" name="gender">
                                        <option value="">Select Gender</option>
                                        <option value="male" {{ old('gender') === 'male' ? 'selected' : '' }}>Male
                                        </option>
                                        <option value="female" {{ old('gender') === 'female' ? 'selected' : '' }}>Female
                                        </option>
                                    </select>
                                    <label for="basic-default-gender">Gender</label>
                                    <small class="text-red-600">
                                        @error('gender')
                                            {{ $message }}
                                        @enderror
                                    </small>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-floating form-floating-outline ">
                                    <select class="form-select select2" id="country_id" name="country_id">
                                        <option value="" >Select Country</option>
                                        @foreach ($country as $item)
                                            <option value="{{ $item->id }}" >{{ $item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="basic-default-country">Country</label>
                                    <small class="text-red-600">
                                        @error('country_id')
                                            {{ $message }}
                                        @enderror
                                    </small>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-floating form-floating-outline ">
                                    <textarea class="materialize-textarea form-control h-px-75 resize-none" id="address" name="address"
                                        placeholder="Address" rows="3" value="{{ old('address') }}"></textarea>
                                    <label for="basic-default-address">Address</label>
                                    <small class="text-red-600">
                                        @error('address')
                                            {{ $message }}
                                        @enderror
                                    </small>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-floating form-floating-outline ">
                                    <select class="form-select select2" id="village" name="village">
                                        {{-- <option value="" selected="">Select Village</option> --}}
                                        <option value="Ahmedabad" selected=""
                                            {{ old('village') === 'Ahmedabad' ? 'selected' : '' }}>
                                            Ahmedabad
                                        </option>
                                        <option value="Anjar" {{ old('village') === 'Anjar' ? 'selected' : '' }}>
                                            Anjar
                                        </option>
                                        <option value="Asambiya" {{ old('village') === 'Asambiya' ? 'selected' : '' }}>
                                            Asambiya
                                        </option>
                                        <option value="Baladia" {{ old('village') === 'Baladia' ? 'selected' : '' }}>
                                            Baladia
                                        </option>
                                        <option value="Bharapur" {{ old('village') === 'Bharapur' ? 'selected' : '' }}>
                                            Bharapur
                                        </option>
                                        <option value="Bharasar" {{ old('village') === 'Bharasar' ? 'selected' : '' }}>
                                            Bharasar
                                        </option>
                                        <option value="Bhuj" {{ old('village') === 'Bhuj' ? 'selected' : '' }}>
                                            Bhuj
                                        </option>
                                        <option value="Dahisara" {{ old('village') === 'Dahisara' ? 'selected' : '' }}>
                                            Dahisara
                                        </option>
                                        <option value="Don" {{ old('village') === 'Don' ? 'selected' : '' }}>
                                            Don
                                        </option>
                                        <option value="Durgapar" {{ old('village') === 'Durgapar' ? 'selected' : '' }}>
                                            Durgapar
                                        </option>
                                        <option value="Fotdi" {{ old('village') === 'Fotdi' ? 'selected' : '' }}>
                                            Fotdi
                                        </option>
                                        <option value="Godhra" {{ old('village') === 'Godhra' ? 'selected' : '' }}>
                                            Godhra
                                        </option>
                                        <option value="Godpar" {{ old('village') === 'Godpar' ? 'selected' : '' }}>
                                            Godpar
                                        </option>
                                        <option value="Goniyasar" {{ old('village') === 'Goniyasar' ? 'selected' : '' }}>
                                            Goniyasar
                                        </option>
                                        <option value="Haripur" {{ old('village') === 'Haripur' ? 'selected' : '' }}>
                                            Haripur
                                        </option>
                                        <option value="Jakhaniya" {{ old('village') === 'Jakhaniya' ? 'selected' : '' }}>
                                            Jakhaniya
                                        </option>
                                        <option value="Kera" {{ old('village') === 'Kera' ? 'selected' : '' }}>
                                            Kera
                                        </option>
                                        <option value="Koday" {{ old('village') === 'Koday' ? 'selected' : '' }}>
                                            Koday
                                        </option>
                                        <option value="Kodki" {{ old('village') === 'Kodki' ? 'selected' : '' }}>
                                            Kodki
                                        </option>
                                        <option value="Kundanpar" {{ old('village') === 'Kundanpar' ? 'selected' : '' }}>
                                            Kundanpar
                                        </option>
                                        <option value="Madhapar" {{ old('village') === 'Madhapar' ? 'selected' : '' }}>
                                            Madhapar
                                        </option>
                                        <option value="Mandvi" {{ old('village') === 'Mandvi' ? 'selected' : '' }}>
                                            Mandvi
                                        </option>
                                        <option value="Mankuva" {{ old('village') === 'Mankuva' ? 'selected' : '' }}>
                                            Mankuva
                                        </option>
                                        <option value="Maska" {{ old('village') === 'Maska' ? 'selected' : '' }}>
                                            Maska
                                        </option>
                                        <option value="Meghpar" {{ old('village') === 'Meghpar' ? 'selected' : '' }}>
                                            Meghpar
                                        </option>
                                        <option value="Merau" {{ old('village') === 'Merau' ? 'selected' : '' }}>
                                            Merau
                                        </option>
                                        <option value="Mirjapar" {{ old('village') === 'Mirjapar' ? 'selected' : '' }}>
                                            Mirjapar
                                        </option>
                                        <option value="Nagalpur" {{ old('village') === 'Nagalpur' ? 'selected' : '' }}>
                                            Nagalpur
                                        </option>
                                        <option value="Naranpur" {{ old('village') === 'Naranpur' ? 'selected' : '' }}>
                                            Naranpur
                                        </option>
                                        <option value="Rampar" {{ old('village') === 'Rampar' ? 'selected' : '' }}>
                                            Rampar
                                        </option>
                                        <option value="Rayan" {{ old('village') === 'Rayan' ? 'selected' : '' }}>
                                            Rayan
                                        </option>
                                        <option value="Samatra" {{ old('village') === 'Samatra' ? 'selected' : '' }}>
                                            Samatra
                                        </option>
                                        <option value="Sarli" {{ old('village') === 'Sarli' ? 'selected' : '' }}>
                                            Sarli
                                        </option>
                                        <option value="Shirva" {{ old('village') === 'Shirva' ? 'selected' : '' }}>
                                            Shirva
                                        </option>
                                        <option value="Sukhpar - Junavas"
                                            {{ old('village') === 'Sukhpar - Junavas' ? 'selected' : '' }}>
                                            Sukhpar - Junavas
                                        </option>
                                        <option value="Sukhpar - Madanpur"
                                            {{ old('village') === 'Sukhpar - Madanpur' ? 'selected' : '' }}>
                                            Sukhpar - Madanpur
                                        </option>
                                        <option value="Sukhpar - Roha"
                                            {{ old('village') === 'Sukhpar - Roha' ? 'selected' : '' }}>
                                            Sukhpar - Roha
                                        </option>
                                        <option value="Surajpur" {{ old('village') === 'Surajpur' ? 'selected' : '' }}>
                                            Surajpur
                                        </option>
                                        <option value="Vadasar" {{ old('village') === 'Vadasar' ? 'selected' : '' }}>
                                            Vadasar
                                        </option>
                                        <option value="Vekra" {{ old('village') === 'Vekra' ? 'selected' : '' }}>
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
                            </div>
                            <div class="col-sm-4">
                                <div class="form-floating form-floating-outline ">
                                    <input type="number" class="form-control" id="adhaar_number"
                                        placeholder="Aadhaar Number" name="adhaar_number" maxlength="12"
                                        pattern="\d{12}" value="{{ old('adhaar_number') }}">
                                    <label for="basic-default-phone">Aadhaar Number</label>
                                    <small class="text-red-600">
                                        @error('adhaar_number')
                                            {{ $message }}
                                        @enderror
                                    </small>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-floating form-floating-outline ">
                                    <input type="text" class="form-control" id="nationality"
                                        placeholder="Nationality" name="nationality" value="{{ old('nationality') }}">
                                    <label for="basic-default-last_name">Nationality</label>
                                    <small class="text-red-600">
                                        @error('nationality')
                                            {{ $message }}
                                        @enderror
                                    </small>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <label class="switch ">
                                    <input type="checkbox" class="switch-input" name="is_any_illness"
                                        {{ old('is_any_illness') ? 'checked' : '' }} value="1" />
                                    <span class="switch-label mr-2 p-0">Do you have any
                                        physical or
                                        mental illness? </span>

                                    <span class="switch-toggle-slider">
                                        <span class="switch-on"></span>
                                        <span class="switch-off"></span>
                                    </span>
                                </label>
                            </div>
                            <div class="col-sm-4 student_illness_field">
                                <div class="form-floating form-floating-outline ">
                                    <input type="text" class="form-control" id="basic-default-last_name"
                                        placeholder="Illness Description" name="illness_description"
                                        value="{{ old('illness_description') }}">
                                    <label for="basic-default-last_name">Describe your
                                        illness in brief</label>
                                    <small class="text-red-600">
                                        @error('illness_description')
                                            {{ $message }}
                                        @enderror
                                    </small>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <label class="form-check-label">Will you be using a vehicle in Ahmedabad?</label>
                                <div class="col mt-2">
                                    <div class="form-check form-check-inline">
                                        <input name="vehicle" class="form-check-input" type="radio" id="vehicle"
                                            value="1" />
                                        <label class="form-check-label" for="vehicle">Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input name="vehicle" class="form-check-input" type="radio" id="vehicle"
                                            value="0" checked />
                                        <label class="form-check-label" for="vehicle">
                                            No
                                        </label>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="vehicle_details row g-4"> --}}

                            <div class="col-sm-4 vehicle_details">
                                <label class="form-check-label">Do you have a helmet?</label>
                                <div class="col mt-2">
                                    <div class="form-check form-check-inline">
                                        <input name="is_have_helmet" class="form-check-input" type="radio"
                                            value="1" id="helmet" />
                                        <label class="form-check-label" for="is_have_helmet">Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input name="is_have_helmet" class="form-check-input" type="radio"
                                            value="0" id="helmet" />
                                        <label class="form-check-label" for="is_have_helmet">
                                            No
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 vehicle_details">
                                <div class="form-floating form-floating-outline ">
                                    <input type="text" class="form-control" id="nationality"
                                        placeholder="vehicle number" name="vehicle_number"
                                        value="{{ old('vehicle_number') }}">
                                    <label for="basic-default-vehicle_number">Vehicle Number</label>
                                    <small class="text-red-600">
                                        @error('vehicle_number')
                                            {{ $message }}
                                        @enderror
                                    </small>
                                </div>
                            </div>
                            <div class="col-sm-4 vehicle_details">
                                <div class="">
                                    <label for="formFile0" class="custom-file-upload btn btn-primary"
                                        data-target="#formFile0">
                                        Licence Photo
                                    </label>
                                    <span id="fileName0" class="custom-file-label">Upload Photo</span>
                                    <!-- Hidden file input -->
                                    <input type="file" id="formFile0" name="licence_doc_url" hidden />
                                    <small class="text-red-600">
                                        @error('licence_doc_url')
                                            {{ $message }}
                                        @enderror
                                    </small>
                                </div>
                            </div>
                            <div class="col-sm-4 vehicle_details">
                                <div class="">
                                    <label for="formFile1" class="custom-file-upload btn btn-primary"
                                        data-target="#formFile1">
                                        RC Book Front Photo
                                    </label>
                                    <span id="fileName1" class="custom-file-label">Upload Photo</span>
                                    <!-- Hidden file input -->
                                    <input type="file" id="formFile1" name="rcbook_front_doc_url" hidden />
                                    <small class="text-red-600">
                                        @error('rcbook_front_doc_url')
                                            {{ $message }}
                                        @enderror
                                    </small>
                                </div>
                            </div>
                            <div class="col-sm-4 vehicle_details">
                                <div class="">
                                    <label for="formFile2" class="custom-file-upload btn btn-primary"
                                        data-target="#formFile2">
                                        RC Book Back Photo
                                    </label>
                                    <span id="fileName2" class="custom-file-label">Upload Photo</span>
                                    <!-- Hidden file input -->
                                    <input type="file" id="formFile2" name="rcbook_back_doc_url" hidden />
                                    <small class="text-red-600">
                                        @error('rcbook_back_doc_url')
                                            {{ $message }}
                                        @enderror
                                    </small>
                                </div>
                            </div>
                            <div class="col-sm-4 vehicle_details">
                                <div class="">
                                    <label for="formFile3" class="custom-file-upload btn btn-primary"
                                        data-target="#formFile3">
                                        Insurance Photo
                                    </label>
                                    <span id="fileName3" class="custom-file-label">Upload Photo</span>
                                    <!-- Hidden file input -->
                                    <input type="file" id="formFile3" name="insurance_doc_url" hidden />
                                    <small class="text-red-600">
                                        @error('insurance_doc_url')
                                            {{ $message }}
                                        @enderror
                                    </small>
                                </div>
                            </div>

                            <div class="col-12 d-flex justify-content-between">
                                <button type="button" class="btn btn-outline-secondary btn-prev" disabled>
                                    <i class="mdi mdi-arrow-left me-sm-1 me-0"></i>
                                    <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                </button>
                                <button type="button" class="btn btn-primary btn-next">
                                    <span class="align-middle d-sm-inline-block d-none me-sm-1">Next</span>
                                    <i class="mdi mdi-arrow-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- Personal Info -->
                    <div id="personal-info-modern-vertical" class="content">
                        <div class="content-header mb-3">
                            <h6 class="mb-0">Family Details</h6>
                            {{-- <small>Enter Your Personal Info.</small> --}}
                        </div>
                        <div class="row g-4">
                            <div class="col-sm-4">
                                <div class="form-floating form-floating-outline ">
                                    <input type="text" class="form-control" id="father_full_name"
                                        placeholder="Father Name" name="father_full_name"
                                        value="{{ old('father_full_name') }}">
                                    <label for="basic-default-father_full_name">Father Full Name</label>
                                    <small class="text-red-600">
                                        @error('father_full_name')
                                            {{ $message }}
                                        @enderror
                                    </small>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-floating form-floating-outline ">
                                    <input type="number" class="form-control" id="father_phone"
                                        placeholder="Father Contact Number" name="father_phone" maxlength="10"
                                        pattern="\d{10}" value="{{ old('father_phone') }}">
                                    <label for="basic-default-father_phone">Father Contact Number</label>
                                    <small class="text-red-600">
                                        @error('father_phone')
                                            {{ $message }}
                                        @enderror
                                    </small>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-floating form-floating-outline ">
                                    <input type="text" class="form-control" id="father_occupation"
                                        placeholder="Father Occupation" name="father_occupation"
                                        value="{{ old('father_occupation') }}">
                                    <label for="basic-default-father_occupation">Father Occupation</label>
                                    <small class="text-red-600">
                                        @error('father_occupation')
                                            {{ $message }}
                                        @enderror
                                    </small>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-floating form-floating-outline ">
                                    <input type="text" class="form-control" id="mother_full_name"
                                        placeholder="Mother Name" name="mother_full_name"
                                        value="{{ old('mother_full_name') }}">
                                    <label for="basic-default-mother_full_name">Mother Full Name</label>
                                    <small class="text-red-600">
                                        @error('mother_full_name')
                                            {{ $message }}
                                        @enderror
                                    </small>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-floating form-floating-outline ">
                                    <input type="number" class="form-control" id="mother_phone"
                                        placeholder="Mother Contact Number" name="mother_phone" maxlength="10"
                                        pattern="\d{10}" value="{{ old('mother_phone') }}">
                                    <label for="basic-default-mother_phone">Mother Contact Number</label>
                                    <small class="text-red-600">
                                        @error('mother_phone')
                                            {{ $message }}
                                        @enderror
                                    </small>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-floating form-floating-outline ">
                                    <input type="text" class="form-control" id="mother_occupation"
                                        placeholder="Mother Occupation" name="mother_occupation"
                                        value="{{ old('mother_occupation') }}">
                                    <label for="basic-default-mother_occupation">Mother Occupation</label>
                                    <small class="text-red-600">
                                        @error('mother_occupation')
                                            {{ $message }}
                                        @enderror
                                    </small>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-floating form-floating-outline ">
                                    <input type="number" class="form-control" id="annual_income"
                                        placeholder="Annual Income" name="annual_income"
                                        value="{{ old('annual_income') }}">
                                    <label for="basic-default-annual_income">Annual Income</label>
                                    <small class="text-red-600">
                                        @error('annual_income')
                                            {{ $message }}
                                        @enderror
                                    </small>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-floating form-floating-outline ">
                                    <input type="text" class="form-control" id="guardian_name"
                                        placeholder="Guardian Name" name="guardian_name"
                                        value="{{ old('guardian_name') }}">
                                    <label for="basic-default-guardian_name">Guardian Name(Ahmedabad Only)</label>
                                    <small class="text-red-600">
                                        @error('guardian_name')
                                            {{ $message }}
                                        @enderror
                                    </small>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-floating form-floating-outline ">
                                    <input type="text" class="form-control" id="guardian_relation"
                                        placeholder="Guardian Relation" name="guardian_relation"
                                        value="{{ old('guardian_relation') }}">
                                    <label for="basic-default-guardian_relation">Guardian Relation(Ahmedabad Only)</label>
                                    <small class="text-red-600">
                                        @error('guardian_relation')
                                            {{ $message }}
                                        @enderror
                                    </small>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-floating form-floating-outline ">
                                    <input type="number" class="form-control" id="guardian_phone"
                                        placeholder="Guardian Contact Number" name="guardian_phone" maxlength="10"
                                        pattern="\d{10}" value="{{ old('guardian_phone') }}">
                                    <label for="basic-default-guardian_phone">Guardian Contact Number(Ahmedabad
                                        Only)</label>
                                    <small class="text-red-600">
                                        @error('guardian_phone')
                                            {{ $message }}
                                        @enderror
                                    </small>
                                </div>
                            </div>
                            <div class="col-12 d-flex justify-content-between">
                                <button type="button" class="btn btn-outline-secondary btn-prev">
                                    <i class="mdi mdi-arrow-left me-sm-1 me-0"></i>
                                    <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                </button>
                                <button type="button" class="btn btn-primary btn-next">
                                    <span class="align-middle d-sm-inline-block d-none me-sm-1">Next</span>
                                    <i class="mdi mdi-arrow-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- Social Links -->
                    <div id="social-links-modern-vertical" class="content">
                        <div class="content-header mb-3">
                            <h6 class="mb-0">Social Links</h6>
                            <small>Enter Your Social Links.</small>
                        </div>
                        <div class="row g-4">
                            <div class="col-sm-4">
                                <div class="form-floating form-floating-outline ">
                                    <select class="form-select select2" id="course_id" name="course_id">
                                        <option value="" selected="">Select course</option>
                                        @foreach ($course as $id => $item)
                                            <option value="{{ $id }}">{{ $item }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="basic-default-country">course</label>
                                    <small class="text-red-600">
                                        @error('country')
                                            {{ $message }}
                                        @enderror
                                    </small>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-floating form-floating-outline ">
                                    <select class="form-select select2" id="semester" name="semester">
                                        <option value="" selected="">Select semester</option>
                                        @foreach ($sem as $item)
                                            <option value="{{ $item }}">{{ $item }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="basic-default-country">semester</label>
                                    <small class="text-red-600">
                                        @error('semester')
                                            {{ $message }}
                                        @enderror
                                    </small>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-floating form-floating-outline ">
                                    <input type="text" class="form-control" id="institute_name"
                                        placeholder="Institute Name" name="institute_name"
                                        value="{{ old('institute_name') }}">
                                    <label for="basic-default-institute_name">Institute Name</label>
                                    <small class="text-red-600">
                                        @error('institute_name')
                                            {{ $message }}
                                        @enderror
                                    </small>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-floating form-floating-outline ">
                                    <select class="form-select select2" id="year_of_addmission"
                                        name="year_of_addmission">
                                        <option value="" >select Addmission Year</option>
                                        @foreach ($year as $id => $item)
                                            <option value="{{ $item }}">{{ $item }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="basic-default-year_of_addmission">Addmission Year</label>
                                    <small class="text-red-600">
                                        @error('year_of_addmission')
                                            {{ $message }}
                                        @enderror
                                    </small>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-floating form-floating-outline ">
                                    <input class="form-control flatpickr-validation flatpickr-input flatpickr-mobile" type="date" value="{{ old('addmission_date') }}"
                                        name="addmission_date" id="addmission_date" placeholder="YYYY-MM-DD"/>
                                    <label for="html5-date-input">Addmission Date</label>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-floating form-floating-outline ">
                                    <input class="form-control" type="time" name="college_start_time"
                                        id="college_start_time" />
                                    <label for="html5-time-input">College Start Time</label>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-floating form-floating-outline">
                                    <input class="form-control" type="time" name="college_end_time"
                                        id="college_end_time" />
                                    <label for="html5-time-input">College End Time</label>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-floating form-floating-outline ">
                                    <input type="text" class="form-control" id="college_fees_receipt_no"
                                        placeholder="College Fees Receipt No" name="college_fees_receipt_no"
                                        value="{{ old('college_fees_receipt_no') }}">
                                    <label for="basic-default-college_fees_receipt_no">College Fees Receipt No</label>
                                    <small class="text-red-600">
                                        @error('college_fees_receipt_no')
                                            {{ $message }}
                                        @enderror
                                    </small>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-floating form-floating-outline ">
                                    <input class="form-control" type="date"
                                        value="{{ old('college_fees_receipt_date') }}" name="college_fees_receipt_date"
                                        id="college_fees_receipt_date" placeholder="YYYY-MM-DD"/>
                                    <label for="html5-date-input">College Fees Receipt Date</label>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-floating form-floating-outline ">
                                    <input class="form-control" type="date"  value="{{ old('arriving_date') }}"
                                        name="arriving_date" id="arriving_date" placeholder="YYYY-MM-DD"/>
                                    <label for="html5-date-input">Arriving Date</label>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="">
                                    <label for="formFile4" class="custom-file-upload btn btn-primary"
                                        data-target="#formFile4">
                                        Student Photo
                                    </label>
                                    <span id="fileName4" class="custom-file-label">Upload Photo</span>
                                    <!-- Hidden file input -->
                                    <input type="file" id="formFile4" name="student_photo_url" hidden />
                                </div>
                            </div>
                            <div class="col-sm-4 ">
                                <div class="">
                                    <label for="formFile5" class="custom-file-upload btn btn-primary"
                                        data-target="#formFile5">
                                        Parent Photo
                                    </label>
                                    <span id="fileName5" class="custom-file-label">Upload Photo</span>
                                    <!-- Hidden file input -->
                                    <input type="file" id="formFile5" name="parent_photo_url" hidden />
                                </div>
                            </div>
                            <hr>
                            <h3>Photo ID Proof (Aadhar Card or Passport), SSC, HSC & School leaving certificate must
                                required.</h3>
                            <div class="col-12 repeater">
                                <div data-repeater-list="group-a">
                                    <div data-repeater-item>
                                        <div class="row">
                                            <!-- Document Type -->
                                            <div class="mb-0 col-lg-6 col-xl-3 col-12">
                                                <div class="form-floating form-floating-outline">
                                                    <select class="form-select" id="doctype" name="doctype">
                                                        <option value="" selected>Select Documents</option>
                                                        @foreach ($doc as $id => $item)
                                                            <option value="{{ $item }}">{{ $item }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <label for="doctype">Document Type</label>
                                                    <small class="text-red-600">
                                                        @error('doctype')
                                                            {{ $message }}
                                                        @enderror
                                                    </small>
                                                </div>
                                            </div>

                                            <!-- Status -->
                                            <div class="mb-0 col-lg-6 col-xl-2 col-12">
                                                <div class="form-floating form-floating-outline">
                                                    <select class="form-select" id="result_Status" name="result_Status">
                                                        <option value="">Select Status</option>
                                                        <option value="pass">Pass</option>
                                                        <option value="fail">Fail</option>
                                                        <option value="backlogs">Backlogs</option>
                                                        <option value="other">Other</option>
                                                    </select>
                                                    <label for="result_Status">Status</label>
                                                    <small class="text-red-600">
                                                        @error('result_Status')
                                                            {{ $message }}
                                                        @enderror
                                                    </small>
                                                </div>
                                            </div>

                                            <!-- percentile -->
                                            <div class="mb-0 col-lg-6 col-xl-2 col-12">
                                                <div class="form-floating form-floating-outline">
                                                    <input type="text" class="form-control" id="percentile"
                                                        placeholder="percentile" name="percentile"
                                                        value="{{ old('percentile') }}">
                                                    <label for="percentile">Percentile</label>
                                                    <small class="text-red-600">
                                                        @error('percentile')
                                                            {{ $message }}
                                                        @enderror
                                                    </small>
                                                </div>
                                            </div>

                                            <!-- Document Upload -->
                                            <div class="mb-0 col-lg-6 col-xl-3 col-12">
                                                <div class="form-floating form-floating-outline">
                                                    <div class="file-upload-container">
                                                        <label for="formFile-0"
                                                            class="repeater-file-upload custom-file-upload btn btn-primary"
                                                            data-target="#formFile-0">
                                                            Document Photo
                                                        </label>
                                                        <!-- Hidden file input -->
                                                        <input type="file" id="formFile-0" name="doc"
                                                            style="opacity: 0; position: absolute; top: 0; left: 0; width: 100%; height: 100%; cursor: pointer;" />
                                                        <span name="doc" id="fileName-0"
                                                            class="repeater-file-label">Upload Document</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Delete Button -->
                                            <div class="mb-0 col-lg-12 col-xl-2 col-12 d-flex align-items-center">
                                                <button type="button" class="btn btn-outline-danger"
                                                    data-repeater-delete>
                                                    <i class="mdi mdi-close me-1"></i>
                                                    <span class="align-middle">Delete</span>
                                                </button>
                                            </div>
                                        </div>
                                        <hr />
                                    </div>
                                </div>
                                <div class="mb-0">
                                    <button type="button" class="btn btn-primary" data-repeater-create>
                                        <i class="mdi mdi-plus me-1"></i>
                                        <span class="align-middle">Add</span>
                                    </button>
                                </div>
                            </div>
                            <div class="col-12 d-flex justify-content-between">
                                <button type="button" class="btn btn-outline-secondary btn-prev">
                                    <i class="mdi mdi-arrow-left me-sm-1 me-0"></i>
                                    <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                </button>
                                <input type="submit" class="btn btn-primary btn-submit" value="Submit">
                                {{-- <button type="submit" class="btn btn-primary btn-submit">Submit</button> --}}
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script src="{{ asset('assets/vendor/libs/bs-stepper/bs-stepper.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/jquery-repeater/jquery-repeater.js') }}"></script>

    <script src="{{ asset('assets/js/form-wizard-numbered.js') }}"></script>
    <script src="{{ asset('assets/js/form-wizard-validation.js') }}"></script>

    <script>
        $(document).ready(function() {
            $(".select2").select2();
            var stepper = new Stepper(document.querySelector('.bs-stepper'));
            $('#num').parsley();
            $('.btn-next').on('click', function() {

                var form = $('#num').parsley();
                if(form.validate()){

                    stepper.next();
                }
            });
            $('.btn-prev').on('click', function() {
                stepper.previous();
            });

            $('#password2-modern-vertical').on('click', function() {
                var passwordField = $('#password-modern-vertical');
                var icon = $(this).find('i');

                if (passwordField.attr('type') === 'password') {
                    passwordField.attr('type', 'text');
                    icon.removeClass('mdi-eye-off-outline').addClass('mdi-eye-outline');
                } else {
                    passwordField.attr('type', 'password');
                    icon.removeClass('mdi-eye-outline').addClass('mdi-eye-off-outline');
                }
            });


            $(document).on('change', '#student_id', function() {
                var id = $(this).val();
                console.log("id :-", id);

                $.ajax({
                    url: "{{ route('addmission.load') }}", 
                    type: 'GET', 
                    data: {
                        id: id
                    },
                    success: function(response) {
                        // Handle the response from the server
                        console.log("Response from server: ", response);

                        $("#email").val(response.email)
                        $("#phone").val(response.phone)
                        $("#last_name").val(response.last_name)
                        $("#middle_name").val(response.middle_name)
                        $("#first_name").val(response.first_name)
                        $("#dobs").val(response.dob)
                        $("#addmission_date").val(response.addmission_date)
                        $("#gender").val(response.gender)
                        $("#address").val(response.address)
                        $('#country_id').val(response.country_id).trigger('change');
                        $('#village').val(response.village).trigger('change');
                        $("#adhaar_number").val(response.adhaar_number)
                        $("#annual_income").val(response.annual_income)
                        $("#arriving_date").val(response.arriving_date);
                        $("#college_end_time").val(response.college_end_time);
                        $("#college_fees_receipt_date").val(response.college_fees_receipt_date);
                        $("#college_fees_receipt_no").val(response.college_fees_receipt_no);
                        $("#college_start_time").val(response.college_start_time);
                        $('#course_id').val(response.course_id).trigger('change');
                        $("#created_at").val(response.created_at);
                        $("#father_full_name").val(response.father_full_name);
                        $("#father_occupation").val(response.father_occupation);
                        $("#father_phone").val(response.father_phone);
                        $("#guardian_name").val(response.guardian_name);
                        $("#guardian_phone").val(response.guardian_phone);
                        $("#guardian_relation").val(response.guardian_relation);
                        $("#institute_name").val(response.institute_name);
                        $("#is_any_illness").prop('checked', response.is_any_illness == 1);
                        $("#is_have_helmet").prop('checked', response.is_have_helmet == 1);
                        $("#mother_full_name").val(response.mother_full_name);
                        $("#mother_occupation").val(response.mother_occupation);
                        $("#mother_phone").val(response.mother_phone);
                        $("#nationality").val(response.nationality);
                        $("#formFile5").val(response.parent_photo_url);
                        $("#rcbook_back_doc_url").val(response.rcbook_back_doc_url);
                        $("#rcbook_front_doc_url").val(response.rcbook_front_doc_url);
                        $('#semester').val(response.semester).trigger('change');
                        $("#student_id").val(response.student_id);
                        $("#formFile4").val(response.student_photo_url);
                        $("#updated_at").val(response.updated_at);
                        $("#vehicle").val(response.vehicle);
                        $("#vehicle_number").val(response.vehicle_number);
                        $("#village").val(response.village);
                        $('#year_of_addmission').val(response.year_of_addmission).trigger('change');



                    },
                    error: function(xhr, status, error) {
                        // Handle errors
                        console.error("AJAX error: ", status, error);
                    }
                });
            });


            // displayIllnessField
            displayIllnessField();

            $('input[name="is_any_illness"]').on('change', function() {
                displayIllnessField();
            });

            function displayIllnessField() {
                var value = $('input[name="is_any_illness"]:checked').val();
                console.log("displayIllnessField :- ", value);
                if (value == '1') {
                    console.log("if :- ", value);
                    $('.student_illness_field').css('display', 'block');
                } else {
                    console.log("else :- ", value);
                    $('.student_illness_field').css('display', 'none');
                }
            }

            // vehicle_details
            vehicle_details();

            $('input[name="vehicle"]').on('change', function() {
                vehicle_details();
            });

            function vehicle_details() {
                var value = $('input[name="vehicle"]:checked').val();
                console.log(value);
                if (value == '1') {
                    $('.vehicle_details').css('display', 'block');
                    // $('#illness_description').attr('required', false);
                } else {
                    $('.vehicle_details').css('display', 'none');
                    // $('#illness_description').attr('required', false);
                }
            }

            // custom field name
            $('.custom-file-upload').on('click', function() {
                var targetId = $(this).data('target');
                // $(targetId).click();
            });

            // Delegate the change event to dynamically handle file inputs
            $(document).on('change', 'input[type="file"]', function() {
                var fileInputId = this.id;
                var fileNameSpanId = '#fileName' + fileInputId.replace('formFile', '');
                if (this.files.length > 0) {
                    $(fileNameSpanId).text(this.files[0].name);
                } else {
                    $(fileNameSpanId).text('Upload Photo'); // Reset the text if no file is selected
                }
            });

            function fileSelect(id, e) {
                console.log(e.target.files[0].name);
            }


            // repeater
            // Initialize file index
            let fileIndex = 0;



            $('.repeater').repeater({
                show: function() {
                    fileIndex++;
                    console.log('New file index:', fileIndex);


                    // Update file input, label, and span with unique IDs
                    const newFileInput = $(this).find('input[type="file"]');
                    const newLabel = $(this).find('label[for^="formFile"]');
                    const newSpan = $(this).find('span[id^="fileName"]');

                    // Assign unique IDs to file input elements
                    newFileInput.attr('id', 'formFile-' + fileIndex);
                    newLabel.attr('for', 'formFile-' + fileIndex);
                    newSpan.attr('id', 'fileName-' + fileIndex);


                    attachFileChangeListener(newFileInput);

                    // Show the new item
                    $(this).slideDown();
                },
                hide: function(deleteElement) {
                    // Remove the item
                    $(this).slideUp(deleteElement);
                },


            });

            // Function to attach a change event listener to the file input
            function attachFileChangeListener(fileInput) {
                fileInput.on('change', function() {
                    const fileName = $(this).val().split('\\').pop(); // Extract filename
                    const targetSpan = $(this).closest('.file-upload-container').find(
                        'span[id^="fileName"]');
                    targetSpan.text(fileName ||
                        'Upload Document'); // Update the span with the selected filename
                });
            }

            // Function to attach a change event listener to the file input
            function attachFileChangeListener(fileInput) {
                fileInput.on('change', function() {
                    const fileName = $(this).val().split('\\').pop(); // Extract filename
                    const targetSpan = $(this).closest('.file-upload-container').find(
                        'span[id^="fileName"]');
                    targetSpan.text(fileName ||
                        'Upload Document'); // Update the span with the selected filename
                });
            }


            $('input[type="file"]').each(function() {
                attachFileChangeListener($(this));
            });
        });
    </script>
@endsection
