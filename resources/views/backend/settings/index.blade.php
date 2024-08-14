@extends('layouts.app')
@section('title', 'Settings')

@section('content')

    <div class="container-xxl d-flex">
        <div class="col-md">
            <div class="card">
                @if (session('status'))
                    <div class="alert alert-{{ session('alert-type', 'info') }} alert-dismissible fade show" role="alert">
                        <strong>{{ session('status') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <h5 class="card-header">Settings</h5>
                <div class="card-body">
                    <form class="browser-default-validation" action="{{ route('setting.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="setting[0][key]" value="new_admission_date">
                        <input type="hidden" name="setting[1][key]" value="old_admission_date">
                        <input type="hidden" name="setting[2][key]" value="new_admission_label">
                        <input type="hidden" name="setting[3][key]" value="old_admission_label">
                        <input type="hidden" name="setting[4][key]" value="start_attendance">
                        <input type="hidden" name="setting[5][key]" value="end_attendance">
                        <div class="grid grid-cols-2 gap-4">

                            <div class="form-floating form-floating-outline mb-6 col-auto">
                                <input type="text" class="form-control" id="basic-default-name" placeholder="Hostel Name"
                                    required="" value="{{ $oldData ?? '' }}" name="setting[3][value]">
                                <label for="basic-default-name">Old Admission Label</label>
                                <small class="text-red">
                                    @error('hostel_name')
                                        {{ $message }}
                                    @enderror
                                </small>
                            </div>
                            <div class="form-floating form-floating-outline mb-6 col-auto">
                                <input type="text" class="form-control" id="basic-default-name" placeholder="Hostel Name"
                                    required="" value="{{ $newData ?? '' }}" name="setting[2][value]">
                                <label for="basic-default-name">New Admission Label</label>
                                <small class="text-red">
                                    @error('hostel_name')
                                        {{ $message }}
                                    @enderror
                                </small>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4">

                            <div class="form-floating form-floating-outline mb-4 ">
                                <input class="form-control" type="date" value="{{ $newDate ?? '' }}"
                                    name="setting[0][value]" id="html5-date-input" />
                                <label for="html5-date-input">New Admission Date</label>
                            </div>
                            <div class="form-floating form-floating-outline mb-4 ">
                                <input class="form-control" type="date" value="{{ $oldDate ?? '' }}"
                                    name="setting[1][value]" id="html5-date-input" />
                                <label for="html5-date-input">Old Admission Date</label>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4">

                            <div class="form-floating form-floating-outline mb-4">
                                <input class="form-control" type="time" value="{{ $startTime ?? '' }}"
                                    name="setting[4][value]" id="html5-time-input" />
                                <label for="html5-time-input">Start Time</label>
                            </div>
                            <div class="form-floating form-floating-outline mb-4">
                                <input class="form-control" type="time" value="{{ $endTime ?? '' }}"
                                    name="setting[5][value]" id="html5-time-input" />
                                <label for="html5-time-input">End Time</label>
                            </div>
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
