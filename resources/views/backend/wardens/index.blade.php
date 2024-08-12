@extends('layouts.app')
@section('title', 'Warden')

@section('content')
    <div class="container mx-auto px-4 lg:w-4/5 xl:w-3/4">
        <div class="card">
            <div class="card-datatable table-responsive pt-0">
                <table class="datatables-basic table table-bordered" id="warden">
                    <thead>
                        <tr>
                            <th></th>
                            <th>id</th>
                            <th>First Name</th>
                            <th>last Name</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>DOB</th>
                            <th>Contact</th>
                            <th>Gender</th>
                            <th>Status</th>
                            <th>Experience</th>
                            <th>Qualification</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    {{-- <tbody>
                        @foreach ($warden as $item)
                
            <tr>

                
                <td>{{$item->id}}</td>
                <td>{{$item->first_name}}</td>
                <td>{{$item->last_name}}</td>
                <td>{{$item->email}}</td>
                <td>{{$item->address}}</td>
                <td>{{$item->dob}}</td>
                <td>{{$item->phone}}</td>
                <td>{{$item->gender}}</td>
                <td>{{$item->status}}</td>
                <td>{{$item->experience}}</td>
                <td>{{$item->qualification}}</td>
                <td><a href="{{ route('warden.edit',$item->id) }}" class="btn btn-primary btn-sm object-right">Edit</a>
                                    <a href="{{ route('warden.delete',$item->id) }}" class="btn btn-danger btn-sm object-right">delete</a></td>
            </tr>
            @endforeach
                    </tbody> --}}
                </table>
            </div>
        </div>
    </div>
    <script src="{{asset('assets/vendor/libs/jquery/jquery.js')}}"></script>

    <script>
        $(document).ready(function() {
            $('.table').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: '{{ route('warden.data') }}',
                columns: [{
                        data: ''
                    },
                    {
                        data: 'id'
                    },
                    {
                        data: 'first_name'
                    },
                    {
                        data: 'last_name'
                    },
                    {
                        data: 'email'
                    },
                    {
                        data: 'address'
                    },
                    {
                        data: 'dob'
                    },
                    {
                        data: 'phone'
                    },
                    {
                        data: 'gender'
                    },
                    {
                        data: 'status'
                    },
                    {
                        data: 'experience'
                    },
                    {
                        data: 'qualification'
                    },
                    {
                        data: null,
                        render: function(data, type, full, meta) {
                            var editUrl = '{{ route('warden.edit', ':id') }}'.replace(':id', full
                                .id);
                            var deleteUrl = '{{ route('warden.delete', ':id') }}'.replace(':id',
                                full
                                .id);
                        }

                        `<a href="${editUrl}" class="btn btn-primary btn-sm pr-2">Edit</a>`,
                        `<a href="${deleteUrl}" class="btn btn-danger btn-sm">Delete</a>`
                    }
                ],
                dom: 'Bfrtip',
                buttons: [{
                    extend: 'collection',
                    text: 'Export',
                    buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
                }]
            });
        });
    </script>
    // {{-- <script src="{{asset('assets/js/tables-datatables-basic.js')}}"></script> --}}

@endsection
