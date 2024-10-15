@extends('layouts.app')
@section('title', 'complain')

@section('content')
@php
    if (Auth::user()->role_id !== 3){
        $user = 'disabled';
    } else {
        $user = '';
    }
@endphp
    
        <div class="col-md">
            <div class="card">
                <h5 class="card-header">complain Form</h5>
                <div class="card-body">
                    <form class="browser-default-validation" action="{{ route('complain.update',$complain->id) }}" method="POST">
                        @csrf
                        
                        <div class="form-floating form-floating-outline mb-6">
                            <select class="form-select" id="basic-default-country" name="type" {{$user}}>
                                <option value="">Choose Type</option>
                                <option value="Technical" {{old('type',$complain->type) === "Technical"? 'selected' : ''}}>Technical</option>
                                <option value="System" {{old('type',$complain->type) === "System"? 'selected' : ''}}>System</option>
                                <option value="Management" {{old('type',$complain->type) === "Management"? 'selected' : ''}}>Management</option>
                            </select>
                            <label for="basic-default-country">Complain Type</label>
                            <small class="text-red">@error('type')
                                {{$message}}
                            @enderror</small>
                        </div>
                        <div class="form-floating form-floating-outline mb-6" >
                            <textarea class="materialize-textarea form-control h-px-75 resize-none" id="basic-default-bio" name="message"
                                placeholder="message" rows="3"  {{$user}}>{{old('message',$complain->message)}}</textarea>
                            <label for="basic-default-bio">message</label>
                            <small class="text-red">@error('message')
                                {{$message}}
                            @enderror</small>
                        </div>
                        
                        {{-- {{dd(Auth::user()->role_id)}} --}}
                        @if (Auth::user()->role_id === 1 || Auth::user()->role_id === 2)    
                        <div class="form-floating form-floating-outline mb-6">
                            <select class="form-select" id="basic-default-country" name="status">
                                <option value="">Select Status</option>
                                <option value="Pending" {{old('status',$complain->status) === 'Pending'? 'selected' : ''}} selected>Pending</option>
                                <option value="Open" {{old('status',$complain->status) === 'Open'? 'selected' : ''}}>Open</option>
                                <option value="In Progress" {{old('status',$complain->status) === 'In Progress'? 'selected' : ''}}>In Progress</option>
                                <option value="Completed" {{old('status',$complain->status) === 'Completed'? 'selected' : ''}}>Completed</option>
                            </select>
                            <label for="basic-default-country">Status</label>
                            <small class="text-red">@error('status')
                                {{$message}}
                                @enderror</small>
                            </div>
                            <div class="form-floating form-floating-outline mb-6">
                                <textarea class="materialize-textarea form-control h-px-75 resize-none" id="basic-default-bio" name="admin_comments"
                                    placeholder="message" rows="3"  >{{old('admin_comments',$complain->admin_comments)}}</textarea>
                                <label for="basic-default-bio">Admin comments</label>
                                <small class="text-red">@error('admin_comments')
                                    {{$message}}
                                @enderror</small>
                            </div>
                        @endif
                            
                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary waves-effect waves-light">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    
@endsection