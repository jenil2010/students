@extends('layouts.app')
@section('title', 'Create Course')
@section('content')
    <div class="container mx-auto px-4 lg:w-4/5 xl:w-3/4">
        <div class="card">
            <div class="card-datatable table-responsive pt-0">
                <table class="table datatables-basic table-bordered">
                    <thead>
                        <tr>
                            <th></th>
                            <th>ID</th>
                            <th>Course Name</th>
                            <th>Status</th>
                            <th>Semesters</th>
                            <th>Duration</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($course as $item)
                            <tr>
                                <td></td>
                                <td>{{$item->id}}</td>
                                <td>{{$item->course_name}}</td>
                                <td>{{$item->status}}</td>
                                <td>{{$item->semesters}}</td>
                                <td>{{$item->duration}}</td>
                                <td><a href="{{ route('course.edit',$item->id) }}" class="btn btn-primary btn-sm object-right">Edit</a>
                                    <a href="{{ route('course.delete',$item->id) }}" class="btn btn-danger btn-sm object-right">delete</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> --}}

    {{-- <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script> --}}
    <script src="{{asset('assets/vendor/libs/jquery/jquery.js')}}"></script>
 

    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('#DataTables_Table_0').DataTable({
                responsive: true,
                processing: true,
                serverSide: false,
                // ajax: '{{ route('course.data') }}',
                // columns: [
                //     { data: 'id', name: 'id' },
                //     { data: 'course_name', name: 'course_name' },
                //     { data: 'status', name: 'status', orderable: false, searchable: false },
                //     { data: 'semesters', name: 'semesters' },
                //     { 
                //         data: 'action',
                //         name: 'action',
                //         orderable: false,
                //         searchable: false
                //     }
                // ],
                // dom: 'Bfrtip',
                // buttons: [
                //     {
                //         extend: 'collection',
                //         text: 'Export',
                //         buttons: [
                //             'copy', 'csv', 'excel', 'pdf', 'print'
                //         ]
                //     }
                // ]
            });

            // Append buttons to the custom container
            // table.buttons().container().appendTo('.dt-buttons');
        });
    </script>
@endsection
