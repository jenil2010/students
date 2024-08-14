@extends('layouts.app')
@section('title', 'Beds')

@section('content')
    {{-- <div class="container mx-auto px-4 lg:w-4/5 xl:w-3/4"> --}}
        @if (session('status'))
        <div class="alert alert-{{ session('alert-type', 'info') }} alert-dismissible fade show" role="alert">
            <strong>{{ session('status') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="card h-100">
        <div class="card-header flex-column flex-md-row border-bottom">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="card-title m-0 me-2 text-secondary">Beds</h5>
                <a href="{{ route('beds.create') }}" class="btn btn-primary"><i class="mdi mdi-plus me-sm-1"></i><span
                        class="d-none d-sm-inline-block">Beds</span></a>
            </div>
            <hr>
            <div class="card-datatable table-responsive pt-0">
                <table class="datatables-basic table table-bordered" id="warden">
                    <thead>
                        <tr>
                            <th></th>
                            <th>id</th>
                            <th>Hostel Name</th>
                            <th>Room Number</th>    
                            <th>Bed Number</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                   
                </table>
            </div>
        </div>
    @endsection

    @section('script')
        <script>
            /*  $(document).ready(function() {
                                                            $('#warden').DataTable({
                                                                searching: true,
                                                                    processing: true,
                                                                    serverSide: true,
                                                                    scrollX: true,
                                                                    lengthMenu: [10, 25, 50, 100, 1000, 10000],
                                                                    ajax: {
                                                                        url: "{{ route('warden.index') }}",
                                                                    },
                                                                // ajax: '{{ route('warden.data') }}',
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
                                                        }); */

            $(document).ready(function() {

                fill_datatable();

                $("#overlay").show();

                function fill_datatable(name = '', id = '', created_at = '') {
                    var dataTable = $('#warden').DataTable({
                        searching: true,
                        processing: true,
                        serverSide: true,
                        scrollX: true,
                        lengthMenu: [10, 25, 50, 100, 1000, 10000],
                        ajax: {
                            url: "{{ route('beds.data') }}",
                        },
                        columns: [{
                                data: ''
                            },
                            {
                                data: 'id'
                            },
                            {
                                data: 'hostel.hostel_name'
                            },
                            {
                                data: 'rooms.room_number'
                            },
                            {
                                data: 'bed_number'
                            },
                            {
                                data: 'status'
                            },
                            {
                                // Actions
                                targets: -1,
                                title: 'Actions',
                                orderable: false,
                                render: function(data, type, full, meta) {
                                    var editUrl = '{{ route('beds.edit', 'id') }}'.replace('id', full
                                        .id);
                                    console.log(editUrl);
                                    var deleteUrl = '{{ route('beds.delete', 'id') }}'.replace('id',
                                        full.id);
                                    return (
                                        '<div class="d-inline-block">' +
                                        '<a href="javascript:;" class="btn btn-sm btn-text-secondary rounded-pill btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></a>' +
                                        '<div class="dropdown-menu dropdown-menu-end m-0">' +
                                        '<a href="javascript:;" class="dropdown-item">Details</a>' +
                                        '<a href="javascript:;" class="dropdown-item">Archive</a>' +
                                        '<div class="dropdown-divider"></div>' +
                                        `<a href='${deleteUrl}' class="dropdown-item text-danger delete-record">Delete</a>` +
                                        '</div>' +
                                        '</div>' +
                                        `<a href='${editUrl}' class="btn btn-sm btn-text-secondary rounded-pill btn-icon item-edit"><i class="mdi mdi-pencil-outline"></i></a>`
                                    );
                                }
                            }
                        ],
                        columnDefs: [{
                            // For Responsive
                            className: 'control',
                            orderable: false,
                            searchable: false,
                            responsivePriority: 1,
                            targets: 0,
                            render: function(data, type, full, meta) {
                                return '';
                            }
                        }, ],
                        responsive: {
                            details: {
                                display: $.fn.dataTable.Responsive.display.modal({
                                    header: function(row) {
                                        var data = row.data();
                                        return 'Details of ' + data['name'];
                                    }
                                }),
                                type: 'column',
                                renderer: function(api, rowIdx, columns) {
                                    var data = $.map(columns, function(col, i) {
                                        return col.title !==
                                            '' // ? Do not show row in modal popup if title is blank (for check box)
                                            ?
                                            '<tr data-dt-row="' +
                                            col.rowIndex +
                                            '" data-dt-column="' +
                                            col.columnIndex +
                                            '">' +
                                            '<td>' +
                                            col.title +
                                            ':' +
                                            '</td> ' +
                                            '<td>' +
                                            col.data +
                                            '</td>' +
                                            '</tr>' :
                                            '';
                                    }).join('');

                                    return data ? $('<table class="table"/><tbody />').append(data) : false;
                                }
                            }
                        },
                        fnInitComplete: function() {
                            $("#overlay").hide();
                        },
                    });
                }

                setTimeout(function() {
                    $('.alert').fadeOut('fast');
                }, 3000);

            });
        </script>
    @endsection
