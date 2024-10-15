@extends('layouts.mail')
@section('title', 'Admission Status')
@section('content')
    {{-- {{ dd($student) }} --}}
    @if ($student['is_admission_confirm'] == 1)
        @php($status = 'confirmed')
    @elseif ($student['is_admission_confirm'] == 0)
        @php($status = 'Not Confirmed')
    @else
        @php($status = 'Rejected')
    @endif
    <p >Hi {{ $Addmission->first_name . ' ' . $Addmission->last_name }},</p>
    <p>#status: Your Admission Is {{ $status }}</p>

@endsection
