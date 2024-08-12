@extends('layouts.app')
@section('title','Create Course')
@section('content')

<div class="container-xxl d-flex h-100">

<div class="col-md">
    <div class="card">
      <h5 class="card-header">Add Course</h5>
      <div class="card-body">
        <form class="needs-validation was-validated" novalidate="" action="{{ route('course.update',$id) }}" method="POST">
          @csrf
          <div class="form-floating form-floating-outline mb-6">
            <input type="text" class="form-control" id="bs-validation-courseName" name="course_name" required value="{{ old('course_name',$course->course_name) }}">
            <label for="bs-validation-courseName">Course Name</label>
            <div class="valid-feedback"> Looks good! </div>
            <div class="invalid-feedback"> Please enter Course name. </div>
          </div>
          <div class="form-floating form-floating-outline mb-6">
            <input type="text" id="bs-validation-duration" class="form-control" name="duration" value="{{ old('duration',$course->duration) }}" required>
            <label for="bs-validation-duration">Duration</label>
            <div class="valid-feedback"> Looks good! </div>
            <div class="invalid-feedback"> Please enter Duration </div>
          </div>
 
          <div class="form-floating form-floating-outline mb-6">
            <select class="form-select" id="bs-validation-status" name="status" required>
              <option value="">Select Status</option>
              <option value="1" {{ old('status',$course->status) === 1 ? 'selected' : '' }}>Enable</option>
              <option value="0" {{ old('status',$course->status) === 0 ? 'selected' : '' }}>Disable</option>
            </select>
            <label class="form-label" for="bs-validation-status">Status</label>
            <div class="valid-feedback"> Looks good! </div>
            <div class="invalid-feedback"> Please select your Status </div>
          </div>
          <div class="form-floating form-floating-outline mb-6">
            <select class="form-select" id="bs-validation-semesters" name="semesters" required>
              <option value="">Select Semester</option>
              <option value="1"  {{ old('semesters',$course->semesters) === '1' ? 'selected' : '' }}>Sem-1</option>
              <option value="2"  {{ old('semesters',$course->semesters) === '2' ? 'selected' : '' }}>Sem-2</option>
              <option value="3"  {{ old('semesters',$course->semesters) === '3' ? 'selected' : '' }}>Sem-3</option>
              <option value="4"  {{ old('semesters',$course->semesters) === '4' ? 'selected' : '' }}>Sem-4</option>
              <option value="5"  {{ old('semesters',$course->semesters) === '5' ? 'selected' : '' }}>Sem-5</option>
              <option value="6"  {{ old('semesters',$course->semesters) === '6' ? 'selected' : '' }}>Sem-6</option>
              <option value="7"  {{ old('semesters',$course->semesters) === '7' ? 'selected' : '' }}>Sem-7</option>
              <option value="8"  {{ old('semesters',$course->semesters) === '8' ? 'selected' : '' }}>Sem-8</option>
              <option value="9"  {{ old('semesters',$course->semesters) === '9' ? 'selected' : '' }}>Sem-9</option>
              <option value="10" {{ old('semesters',$course->semesters) === '10' ? 'selected' : '' }}>Sem-10</option>
            </select>
            <label class="form-label" for="bs-validation-semesters">Semester</label>
            <div class="valid-feedback"> Looks good! </div>
            <div class="invalid-feedback"> Please select your Semester </div>
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