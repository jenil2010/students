@extends('layouts.app')
@section('title', 'Students')

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
                <h5 class="card-title m-0 me-2 text-secondary">Students</h5>
                <a href="{{ route('students.create') }}" class="btn btn-primary"><i class="mdi mdi-plus me-sm-1"></i><span
                        class="d-none d-sm-inline-block">Students</span></a>
            </div>
            <div class="row grid grid-cols-2 gap-4">
                <div class="form-floating form-floating-outline mb-6 col-auto">
                    <select class="form-select" id="gender" name="gender">
                        <option value="">Select Gender</option>
                        <option value="male" {{ old('gender') === 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ old('gender') === 'female' ? 'selected' : '' }}>Female</option>
                    </select>
                    <label for="gender">Gender</label>
                    <small class="text-red-600">
                        @error('gender')
                            {{ $message }}
                        @enderror
                    </small>
                </div>
                <div class="form-floating form-floating-outline mb-6 col-auto">
                    <select class="form-select select2" id="country_id" name="country_id">
                        <option value="" selected="">Select Country</option>
                        @foreach ($country as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                    <label for="country_id">Country</label>
                    <small class="text-red-600">
                        @error('country')
                            {{ $message }}
                        @enderror
                    </small>
                </div>
            </div>
            <hr>
            <div class="card-datatable table-responsive pt-0">
                <table class="datatables-basic table table-bordered" id="warden">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Action</th>
                            <th>id</th>
                            <th>First Name</th>
                            <th>Middle Name</th>
                            <th>last Name</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>DOB</th>
                            <th>Contact</th>
                        </tr>
                    </thead>

                </table>
            </div>
        </div>
    @endsection

    @section('script')
        <script>
            $(document).ready(function() {
                var genderId = null;
                var countryId = null;

                $(document).on('change', '#gender', function() {
                    genderId = $(this).val();
                    $('#warden').DataTable().ajax.reload();
                });

                $(document).on('change', '#country_id', function() {
                    countryId = $(this).val();
                    $('#warden').DataTable().ajax.reload();
                });

                $("#overlay").show();

                function fill_datatable() {
                    var dataTable = $('#warden').DataTable({
                        searching: true,
                        processing: true,
                        serverSide: true,
                        scrollX: true,
                        lengthMenu: [10, 25, 50, 100, 1000, 10000],
                        ajax: {
                            url: "{{ route('students.data') }}",
                            data: function(d) {
                                d.gender_id = genderId;
                                console.log("Selected Gender ID: ", d.gender_id);
                                d.country_id = countryId;
                                console.log("Selected Country ID: ", d.country_id);
                                console.log("get  :- ", d);
                            },
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
                                    var editUrl = '{{ route('students.edit', 'id') }}'.replace('id',
                                        full
                                        .id);
                                    console.log(editUrl);
                                    var deleteUrl = '{{ route('students.delete', 'id') }}'.replace(
                                        'id',
                                        full.id);
                                    return (
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
                                data: 'first_name'
                            },
                            {
                                data: 'middle_name'
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

                // fill_datatable(gender, country_id);
                fill_datatable();


            });
        </script>
    @endsection
