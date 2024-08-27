@extends('layouts.app')
@section('title','Course')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/flatpickr/flatpickr.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/tagify/tagify.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/@form-validation/umd/styles/index.min.css')}}" />
@section('content')



<div class="container-xxl d-flex h-100">
<div class="col-md">
    <div class="card">
      <h5 class="card-header">Course</h5>
      <div class="card-body">
        <form novalidate="" action="{{ route('course.store') }}" method="POST">
          @csrf
          <div class="form-floating form-floating-outline mb-7">
            <input type="text" class="form-control" id="bs-validation-courseName" name="course_name" required="" value="{{old('course_name')}}">
            <label for="bs-validation-courseName">Course Name</label>
            <small class="text-red-600">@error('course_name')
              {{$message}}
          @enderror</small>
          </div>
          {{-- <div class="form-floating form-floating-outline mb-6">
            <input type="text" class="form-control" id="basic-default-name" placeholder="Course Name"
                 name="course_name" value="{{old('course_name')}}">
            <label for="basic-default-name">Course Name</label>
            <small class="text-red-600">@error('first_name')
                {{$message}}
            @enderror</small>
        </div> --}}
          <div class="form-floating form-floating-outline mb-7">
            <input type="text" id="bs-validation-email" class="form-control" name="duration" required="" value="{{old('duration')}}">
            <label for="bs-validation-email">Duration</label>
            <small class="text-red-600">@error('duration')
              {{$message}}
          @enderror</small>
          </div>
 
          <div class="form-floating form-floating-outline mb-7">
            <select class="form-select" id="bs-validation-country" name="status" required="" >
              <option value="">Select Status</option>
              <option value="1"  {{ old('status') === '1' ? 'selected' : '' }}>Enable</option>
              <option value="0"  {{ old('status') === '0' ? 'selected' : '' }}>Disable</option>
            </select>
            <label class="form-label" for="bs-validation-country">Status</label>
            <small class="text-red-600">@error('status')
              {{$message}}
          @enderror</small>
          </div>
          <div class="form-floating form-floating-outline mb-7">
            <select class="form-select" id="bs-validation-country" name="semesters" required="">
              <option value="">Select Semester</option>
              <option value="1" {{ old('semesters') === '1' ? 'selected' : '' }}>Sem-1</option>
              <option value="2" {{ old('semesters') === '2' ? 'selected' : '' }}>Sem-2</option>
              <option value="3" {{ old('semesters') === '3' ? 'selected' : '' }}>Sem-3</option>
              <option value="4" {{ old('semesters') === '4' ? 'selected' : '' }}>Sem-4</option>
              <option value="5" {{ old('semesters') === '5' ? 'selected' : '' }}>Sem-5</option>
              <option value="6" {{ old('semesters') === '6' ? 'selected' : '' }}>Sem-6</option>
              <option value="7" {{ old('semesters') === '7' ? 'selected' : '' }}>Sem-7</option>
              <option value="8" {{ old('semesters') === '8' ? 'selected' : '' }}>Sem-8</option>
              <option value="9" {{ old('semesters') === '9' ? 'selected' : '' }}>Sem-9</option>
              <option value="10"{{ old('semesters') === '10' ? 'selected' : '' }}>Sem-10</option>
            </select>
            <label class="form-label" for="bs-validation-country">Semester</label>
            <small class="text-red-600">@error('semesters')
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
  

 <!-- Page JS -->
 <script src="{{asset('assets/vendor/libs/select2/select2.js')}}"></script>
  <script src="{{asset('assets/vendor/libs/bootstrap-select/bootstrap-select.js')}}"></script>
  <script src="{{asset('assets/vendor/libs/moment/moment.js')}}"></script>
  <script src="{{asset('assets/vendor/libs/flatpickr/flatpickr.js')}}"></script>
  <script src="{{asset('assets/vendor/libs/tagify/tagify.js')}}"></script>
  <script src="{{asset('assets/js/form-validation.js')}}"></script>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.querySelector('.needs-validation');
        
        form.addEventListener('submit', function (event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        });
  
        form.addEventListener('reset', function () {
            form.classList.remove('was-validated');
        });
    });
  </script>
@endsection