@extends('layouts.mail')
@section('title', 'Room Allotment')
@section('content')
    {{-- {{ dd($student) }} --}}
    {{-- @if ($student['is_admission_confirm'] == 1)
        @php($status = 'confirmed')
    @elseif ($student['is_admission_confirm'] == 0)
        @php($status = 'Not Confirmed')
    @else
        @php($status = 'Rejected')
    @endif --}}
    {{-- <p >Hi {{ $admission->first_name . ' ' . $Addmission->last_name }},</p>
    <p>#status: Your Admission Is {{ $status }}</p> --}}
    <p>Hi {{ $admission->first_name.' '.$admission->last_name }},</p>
    <p>Following room has been allotted to you for the current year:</p>
    <p><span class="highlight">Hostel Name:</span>{{ $hostel->hostel_name}}</p>
    <p><span class="highlight">Room No:</span> {{ $room->room_number }}</p>
    <p><span class="highlight">Bed No:</span> {{ $bed->bed_number}}</p>

@endsection
