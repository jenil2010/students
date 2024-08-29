@extends('layouts.app')
@section('title', 'Settings')
@section('content')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bs-stepper/bs-stepper.css') }}" />
    <div class="col-12">
        <small class="text-light fw-medium">Vertical</small>
        <div class="bs-stepper vertical wizard-modern wizard-modern-vertical mt-2">
            <div class="bs-stepper-header gap-lg-2">
                <div class="step" data-target="#account-details-modern-vertical">
                    <button type="button" class="step-trigger">
                        <span class="bs-stepper-circle"><i class="mdi mdi-check"></i></span>
                        <span class="bs-stepper-label">
                            <span class="bs-stepper-number">01</span>
                            <span class="d-flex flex-column gap-1 ms-2">
                                <span class="bs-stepper-title">Account Details</span>
                                <span class="bs-stepper-subtitle">Setup Account Details</span>
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
                                <span class="bs-stepper-title">Personal Info</span>
                                <span class="bs-stepper-subtitle">Add personal info</span>
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
                                <span class="bs-stepper-title">Social Links</span>
                                <span class="bs-stepper-subtitle">Add social links</span>
                            </span>
                        </span>
                    </button>
                </div>
            </div>
            <div class="bs-stepper-content">
                <form onSubmit="return false" id="num">
                    <!-- Account Details -->
                    <div id="account-details-modern-vertical" class="content">
                        <div class="content-header mb-3">
                            <h6 class="mb-0">Account Details</h6>
                            <small>Enter Your Account Details.</small>
                        </div>
                        <div class="row g-4">
                            <div class="col-sm-6">
                                <div class="form-floating form-floating-outline col-auto">
                                    <select class="form-select select2" id="student_id" name="student_id">
                                        <option value="" selected="">Select Student</option>
                                        @foreach ($student as $item)
                                            <option value="{{ $item->id }}">
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
                            <div class="col-sm-6">

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
                            <div class="col-sm-6">

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
                            <div class="col-sm-6">

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
                            <div class="col-sm-6">

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
                            <div class="col-sm-6">
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
                            <div class="col-sm-6">
                                <div class="form-floating form-floating-outline mb-6">
                                    <input type="hidden" class="form-control flatpickr-validation flatpickr-input"
                                        placeholder="YYYY-MM-DD" id="dob" name="dob"><input
                                        class="form-control flatpickr-validation flatpickr-input flatpickr-mobile"
                                        tabindex="1" type="date" placeholder="YYYY-MM-DD" name="dob"
                                        value="{{ old('dob') }}">
                                    <label for="basic-default-dob">DOB</label>
                                    <small class="text-red-600">
                                        @error('dob')
                                            {{ $message }}
                                        @enderror
                                    </small>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-floating form-floating-outline mb-6">
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
                            <div class="col-sm-6">
                                <div class="form-floating form-floating-outline mb-6">
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
                            <div class="col-sm-6">
                                <div class="form-floating form-floating-outline mb-6">
                                    <select class="form-select select2" id="country" name="country_id">
                                        <option value="" selected="">Select Country</option>
                                        @foreach ($country as $item)
                                            <option value="{{ $item->id }}" selected="">{{ $item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="basic-default-country">Country</label>
                                    <small class="text-red-600">
                                        @error('country')
                                            {{ $message }}
                                        @enderror
                                    </small>
                                </div>
                            </div>
                            <div class="col-12 d-flex justify-content-between">
                                <button class="btn btn-outline-secondary btn-prev" disabled>
                                    <i class="mdi mdi-arrow-left me-sm-1 me-0"></i>
                                    <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                </button>
                                <button class="btn btn-primary btn-next">
                                    <span class="align-middle d-sm-inline-block d-none me-sm-1">Next</span>
                                    <i class="mdi mdi-arrow-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- Personal Info -->
                    <div id="personal-info-modern-vertical" class="content">
                        <div class="content-header mb-3">
                            <h6 class="mb-0">Personal Info</h6>
                            <small>Enter Your Personal Info.</small>
                        </div>
                        <div class="row g-4">
                            <div class="col-sm-6">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="first-name-modern-vertical" class="form-control"
                                        placeholder="John" required />
                                    <label for="first-name-modern-vertical">First Name</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="last-name-modern-vertical" class="form-control"
                                        placeholder="Doe" required />
                                    <label for="last-name-modern-vertical">Last Name</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-floating form-floating-outline">
                                    <select class="select2" id="country-modern-vertical">
                                        <option label=" "></option>
                                        <option>UK</option>
                                        <option>USA</option>
                                        <option>Spain</option>
                                        <option>France</option>
                                        <option>Italy</option>
                                        <option>Australia</option>
                                    </select>
                                    <label for="country-modern-vertical">Country</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-floating form-floating-outline">
                                    <select class="selectpicker w-auto" id="language-modern-vertical"
                                        data-style="btn-transparent" data-icon-base="mdi"
                                        data-tick-icon="mdi-check text-white" multiple>
                                        <option>English</option>
                                        <option>French</option>
                                        <option>Spanish</option>
                                    </select>
                                    <label for="language-modern-vertical">Language</label>
                                </div>
                            </div>
                            <div class="col-12 d-flex justify-content-between">
                                <button class="btn btn-outline-secondary btn-prev">
                                    <i class="mdi mdi-arrow-left me-sm-1 me-0"></i>
                                    <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                </button>
                                <button class="btn btn-primary btn-next">
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
                            <div class="col-sm-6">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="twitter-modern-vertical" class="form-control"
                                        placeholder="https://twitter.com/abc" required />
                                    <label for="twitter-modern-vertical">Twitter</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="facebook-modern-vertical" class="form-control"
                                        placeholder="https://facebook.com/abc" required />
                                    <label for="facebook-modern-vertical">Facebook</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="google-modern-vertical" class="form-control"
                                        placeholder="https://plus.google.com/abc" required />
                                    <label for="google-modern-vertical">Google+</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="linkedin-modern-vertical" class="form-control"
                                        placeholder="https://linkedin.com/abc" required />
                                    <label for="linkedin-modern-vertical">LinkedIn</label>
                                </div>
                            </div>
                            <div class="col-12 d-flex justify-content-between">
                                <button class="btn btn-outline-secondary btn-prev">
                                    <i class="mdi mdi-arrow-left me-sm-1 me-0"></i>
                                    <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                </button>
                                <button class="btn btn-primary btn-submit">Submit</button>
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

    <script src="{{ asset('assets/js/form-wizard-numbered.js') }}"></script>
    <script src="{{ asset('assets/js/form-wizard-validation.js') }}"></script>
    <script>
        $(document).ready(function() {
            var stepper = new Stepper(document.querySelector('.bs-stepper'));
            $('#num').parsley();
            $('.btn-next').on('click', function() {

                var form = $('#num').parsley(); // Initialize Parsley on the form

                // Check if the current step is valid
                // if (form.validate()) {
                    stepper.next(); // Proceed to the next step if valid
                // }
            });
            $('.btn-prev').on('click', function() {
                stepper.previous();
            });

            $('#password2-modern-vertical').on('click', function() {
                var passwordField = $('#password-modern-vertical');
                var icon = $(this).find('i');

                // Toggle password visibility
                if (passwordField.attr('type') === 'password') {
                    passwordField.attr('type', 'text');
                    icon.removeClass('mdi-eye-off-outline').addClass('mdi-eye-outline');
                } else {
                    passwordField.attr('type', 'password');
                    icon.removeClass('mdi-eye-outline').addClass('mdi-eye-off-outline');
                }
            });


            $(document).on('change', '#student_id', function() {
                var student_id = $(this).val();

                $.ajax({
                    url: "{{ route('addmission.load') }}", // Make sure this route is correct
                    type: 'GET', // Use 'POST' if you are sending data that modifies the server's state
                    data: {
                        student_id: student_id
                    },
                    success: function(response) {
                        // Handle the response from the server
                        console.log("Response from server: ", response);

                        $("#email").val(response.email)
                        $("#phone").val(response.phone)
                        $("#last_name").val(response.last_name)
                        $("#middle_name").val(response.middle_name)
                        $("#first_name").val(response.first_name)
                        $("#dob").val(response.dob)
                        $("#gender").val(response.gender)
                        $("#address").val(response.address)
                        $("#country").val(response.country_id)


                    },
                    error: function(xhr, status, error) {
                        // Handle errors
                        console.error("AJAX error: ", status, error);
                    }
                });
            });

        });
    </script>
@endsection
