@extends('layouts.app')
@section('title', 'Course')

@section('content')
    {{-- <div class="container mx-auto px-4 lg:w-4/5 xl:w-3/4"> --}}
    @if (session('status'))
        <div class="alert alert-{{ session('alert-type', 'info') }} alert-dismissible fade show" role="alert">
            <strong>{{ session('status') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    
        <div class="card">
            <div class="card-header flex-column flex-md-row border-bottom">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title m-0 me-2 text-secondary">Course</h5>
                    <a href="{{ route('course.create') }}" class="btn btn-primary"><i class="mdi mdi-plus me-sm-1"></i><span
                            class="d-none d-sm-inline-block">Course</span></a>
                </div>
                <hr>
                <div class="card-datatable table-responsive pt-0">
                    <table class="datatables-basic table table-bordered" id="warden">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Action</th>
                                <th>ID</th>
                                <th>Course Name</th>
                                <th>Duration</th>
                                <th>Semesters</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                    </table>
                </div>
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
                            url: "{{ route('course.data') }}",
                        },
                        columns: [{
                                data: ''
                            },
                            {
                                // Actions
                                targets: -1,
                                title: 'Actions',
                                orderable: false,
                                render: function(data, type, full, meta) {
                                    var editUrl = '{{ route('course.edit', 'id') }}'.replace('id', full
                                        .id);
                                    console.log(editUrl);
                                    var deleteUrl = '{{ route('course.delete', 'id') }}'.replace('id',
                                        full.id);
                                    return (
                                        `<div class="btn-group">`+
                                        `<button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"> Action</button>`+
                                        `<ul class="dropdown-menu">`+
                                            `<li><a class="dropdown-item" href="${editUrl}">Edit</a></li>`+
                                            `<li><a class="dropdown-item" href="${deleteUrl}">Delete</a></li>`+
                                        `</ul>`+
                                        `</div>`
                                    );
                                }
                            },
                            {
                                data: 'id'
                            },
                            {
                                data: 'course_name'
                            },
                            {
                                data: 'duration'
                            },
                            {
                                data: 'semesters'
                            },
                            {
                                data: 'status'
                            },
                            
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
