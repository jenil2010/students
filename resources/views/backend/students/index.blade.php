@extends('layouts.app')
@section('title', 'Warden')

@section('content')
    {{-- <div class="container mx-auto px-4 lg:w-4/5 xl:w-3/4"> --}}
    @if (session('status'))
        <div class="alert alert-{{ session('alert-type', 'info') }} alert-dismissible fade show" role="alert">
            <strong>{{ session('status') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="card h-100">
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
        <div class="card-header flex-column flex-md-row border-bottom">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="card-title m-0 me-2 text-secondary">Warden</h5>
                <a href="{{ route('students.create') }}" class="btn btn-primary"><i class="mdi mdi-plus me-sm-1"></i><span
                        class="d-none d-sm-inline-block">Warden</span></a>
            </div>
            <hr>
            <div class="card-datatable table-responsive pt-0">
                <table class="datatables-basic table table-bordered" id="warden">
                    <thead>
                        <tr>
                            <th></th>
                            <th>id</th>
                            <th>First Name</th>
                            <th>Middle Name</th>
                            <th>last Name</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>DOB</th>
                            <th>Contact</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                </table>
            </div>
        </div>
    @endsection

    @section('script')
        <script>
            $(document).ready(function() {

                // $('#gender, #country_id').change(function() {
                //     var gender = $('#gender :selected').val();
                //     var country_id = $('#country_id :selected').val();
                //     console.log("gemger :- ", gender);

                //     fill_datatable(gender, country_id);
                // });

                $(document).on('change', '#gender', function() {
                    fill_datatable();
                });
                $(document).on('change', '#country_id', function() {
                    fill_datatable();
                });

                $("#overlay").show();

                function fill_datatable() {
                    var baseUrl =
                        "{{ route('students.data', ['gender' => 'PLACEHOLDER', 'country_id' => 'PLACEHOLDER']) }}";
                    var gender = $('#gender :selected').val();
                    var country_id = $('#country_id :selected').val();

                    var url = baseUrl
                        .replace('PLACEHOLDER', encodeURIComponent(gender))
                        .replace('PLACEHOLDER', encodeURIComponent(country_id));

                    console.log("URL :- ", url);
                    var dataTable = $('#warden').DataTable({
                        searching: true,
                        processing: true,
                        serverSide: true,
                        scrollX: true,
                        lengthMenu: [10, 25, 50, 100, 1000, 10000],
                        ajax: {
                            url: url,
                            dataType: 'json',
                            success: function(response) {
                                console.log("Response Data: ", response);
                            },
                            error: function(xhr) {
                                console.error("AJAX Error: ", xhr);
                            }
                        },
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

                // fill_datatable(gender, country_id);
                fill_datatable();


            });
        </script>
    @endsection
