@extends('layouts.app')
@section('title', 'Hostels')

@section('content')

    <div class="card">
        <div class="card-datatable table-responsive pt-0">
            <table class="datatables-basic table table-bordered">
                <thead>
                    <tr>
                        <th></th>
                        <th></th>
                        <th>id</th>
                        <th>Hostel Name</th>
                        <th>Location</th>
                        <th>Mobile Number</th>
                        <th>Contact Number</th>
                        <th>Warden</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($hostel as $item)
                        
                    <tr>
                        <td></td>
                        <td></td>
                        <td>{{$item->id}}</td>
                        <td>{{$item->hostel_name}}</td>
                        <td>{{$item->location}}</td>
                        <td>{{$item->mobile_number}}</td>
                        <td>{{$item->contact_number}}</td>
                        <td>{{$item->warden_id}}</td>
                        <td>Action</td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#DataTables_Table_0 ').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: '{{ route('course.data') }}',
                columns: [{
                        data: '',
                        name: ''
                    },
                    {
                        data: '',
                        name: ''
                    },
                    {
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'hostel_name',
                        name: 'hostel_name'
                    },
                    {
                        data: 'location',
                        name: 'location'
                    },
                    {
                        data: 'mobile_number',
                        name: 'mobile_number'
                    },
                    {
                        data: 'contact_number',
                        name: 'contact_number'
                    },
                    {
                        data: 'warden_id',
                        name: 'warden_id'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ],
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
            // table.buttons().container().appendTo('#export-buttons');
        });
    </script>
@endsection
