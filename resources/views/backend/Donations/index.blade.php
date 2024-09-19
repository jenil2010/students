@extends('layouts.app')
@section('title', 'Addmission')

@section('content')
    {{-- <div class="container mx-auto px-4 lg:w-4/5 xl:w-3/4"> --}}
    @if (session('status'))
        <div class="alert alert-{{ session('alert-type', 'info') }} alert-dismissible fade show" role="alert">
            <strong>{{ session('status') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- fees --}}
    <div class="modal fade" id="modalfees" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalCenterTitle">Send Remarks</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('addmission.fees') }}" method="post">
                        @csrf
                        <input type="hidden" name="addmission_id" id="fees_addmission_id" value="">
                        <div class="row">
                            <div class="col mb-4 mt-2">
                                <div class="form-floating form-floating-outline col-auto">
                                    <select class="form-select select2" id="student_id" name="student_id">
                                        <option value="" selected="">Select Student</option>
                                        @foreach ($student as $item)
                                            <option value="{{ $item->id }}" >
                                                {{ $item->first_name . ' ' . $item->last_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="country_id">Student</label>
                                    <small class="text-red-600">
                                        @error('country')
                                            {{ $message }}
                                        @enderror
                                    </small>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-4 mt-2">
                                <div class="form-floating form-floating-outline ">
                                    <input type="text" class="form-control" id="fees_amount"
                                        placeholder="Fees Amount" name="fees_amount" value="{{ old('fees_amount') }}">
                                    <label for="basic-default-fees_amount">Fees Amount</label>
                                    <small class="text-red-600">
                                        @error('fees_amount')
                                            {{ $message }}
                                        @enderror
                                    </small>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-4 mt-2">
                                <div class="form-floating form-floating-outline">
                                    <select class="form-select select2" id="payment_type" name="payment_type"
                                        tabindex="-1">
                                        <option value="" selected>Select Payment Type</option>
                                        <option value="Cash">Cash</option>
                                        <option value="Card">Card</option>
                                        <option value="Cheque">Cheque</option>
                                        <option value="E-wallet">E-wallet</option>
                                    </select>
                                    <label for="payment_type">Payment Type</label>
                                    <small class="text-red-600">
                                        @error('payment_type')
                                            {{ $message }}
                                        @enderror
                                    </small>
                                </div>
                            </div>
                        </div>
                        <div class="row bank-name">
                            <div class="col mb-4 mt-2">
                                <div class="form-floating form-floating-outline ">
                                    <input type="text" class="form-control" id="bank_name" placeholder="Bank Name"
                                        name="bank_name" value="{{ old('bank_name') }}">
                                    <label for="basic-default-bank_name">Bank Name</label>
                                    <small class="text-red-600">
                                        @error('bank_name')
                                            {{ $message }}
                                        @enderror
                                    </small>
                                </div>
                            </div>
                        </div>
                        <div class="row cheque-number">
                            <div class="col mb-4 mt-2">
                                <div class="form-floating form-floating-outline ">
                                    <input type="text" class="form-control" id="cheque_number"
                                        placeholder="Cheque Number" name="cheque_number"
                                        value="{{ old('cheque_number') }}">
                                    <label for="basic-default-cheque_number">Cheque Number</label>
                                    <small class="text-red-600">
                                        @error('cheque_number')
                                            {{ $message }}
                                        @enderror
                                    </small>
                                </div>
                            </div>
                        </div>
                        <div class="row transaction-number">
                            <div class="col mb-4 mt-2">
                                <div class="form-floating form-floating-outline ">
                                    <input type="text" class="form-control" id="transaction_number"
                                        placeholder="Transaction Number" name="transaction_number"
                                        value="{{ old('transaction_number') }}">
                                    <label for="basic-default-transaction_number">Transaction Number</label>
                                    <small class="text-red-600">
                                        @error('transaction_number')
                                            {{ $message }}
                                        @enderror
                                    </small>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="status" value="1">
                        <div class="row">
                            <div class="col mb-4 mt-2">
                                <div class="form-floating form-floating-outline">
                                    <select class="form-select select2" id="donation_type" name="donation_type"
                                        tabindex="-1">
                                        <option value="Vidhyadan">Vidhyadan</option>
                                        <option value="Secure Fund">Security Deposite</option>
                                    </select>
                                    <label for="donation_type">Donation Type</label>
                                    <small class="text-red-600">
                                        @error('donation_type')
                                            {{ $message }}
                                        @enderror
                                    </small>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-4 mt-2">
                                <div class="form-floating form-floating-outline">
                                    <select class="form-select select2" id="payment_method" name="payment_method"
                                        tabindex="-1">
                                        <option value="Monthly">Monthly</option>
                                        <option value="Quarterly">Quarterly</option>
                                        <option value="Half Yearly">Half Yearly</option>
                                        <option value="Yearly">Yearly</option>
                                    </select>
                                    <label for="payment_method">Terms</label>
                                    <small class="text-red-600">
                                        @error('payment_method')
                                            {{ $message }}
                                        @enderror
                                    </small>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-4 mt-2">
                                <div class="form-floating form-floating-outline ">
                                    <input type="text" class="form-control" id="remark" placeholder="Remarks"
                                        name="remark" value="{{ old('remark') }}">
                                    <label for="basic-default-remark">Remarks</label>
                                    <small class="text-red-600">
                                        @error('remark')
                                            {{ $message }}
                                        @enderror
                                    </small>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                Close
                            </button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="card h-100">
        <div class="card-header flex-column flex-md-row border-bottom">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="card-title m-0 me-2 text-secondary">Addmission</h5>
                <a href="{{ route('addmission.create') }}" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalfees" type="button"><i
                        class="mdi mdi-plus me-sm-1"></i><span class="d-none d-sm-inline-block">Addmission</span></a>
            </div>
            <hr>
            <div class="card-datatable table-responsive pt-0">
                <table class="datatables-basic table table-bordered" id="warden">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Id</th>
                            <th>Student Name</th>
                            <th>Gender</th>
                            <th>Payment Type</th>
                            <th>Payment Term</th>
                            <th>Amount</th>
                            <th>Paid At</th>
                            <th>Admission Year</th>
                            <th>Transaction Number</th>
                            <th>Donation Type</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                </table>
            </div>
        </div>
    @endsection

    @section('script')
        <script src="{{ asset('assets/js/ui-modals.js') }}"></script>
        <script>
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
                            url: "{{ route('donation.data') }}",
                        },
                        columns: [{
                                data: ''
                            },
                            {
                                data: 'id'
                            },
                            {
                                data: 'student_name'
                            },
                            {
                                data: 'addmission.gender'
                            },
                            {
                                data: 'payment_type'
                            },
                            {
                                data: 'payment_method'
                            },
                            {
                                data: 'fees_amount'
                            },
                            {
                                data: 'paid_at'
                            },
                            {
                                data: 'financial_year'
                            },
                            {
                                data: 'transaction_number'
                            },
                            {
                                data: 'donation_type'
                            },
                            {
                                // Actions
                                targets: -1,
                                title: 'Actions',
                                orderable: false,
                                render: function(data, type, full, meta) {
                                    var editUrl = '{{ route('addmission.edit', 'id') }}'.replace('id',
                                        full
                                        .id);
                                    var idd = full.student_id;
                                    console.log("idd :- ", idd);
                                    $('#addmission_id').val(idd);
                                    var deleteUrl = '{{ route('addmission.delete', 'id') }}'.replace(
                                        'id',
                                        full.id);
                                    return (
                                        `<button type="button" class="btn btn-primary edit-btn" data-bs-toggle="modal" data-bs-target="#modalCenter" data-student="${full.student_id}">` +
                                        `<i class="ri-calendar-line"></i>` +
                                        `</button>` +
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
            $(document).on('click', '.edit-btn', function() {
                var studentId = $(this).data('student');
                var admissionId = $(this).data('addmission');
                console.log("id:", studentId);
                console.log("add_id:", admissionId);

                // Set the input values
                $('#student_id').val(studentId);
                $('#addmission_id').val(studentId);
                $('#add_id').val(admissionId);
                $('#fees_addmission_id').val(studentId);
                // Open the modal
                $('#modalupdate').modal('show');
            });
        </script>


        <script>
            $(document).ready(function() {
                $(".transaction-number").hide();
                $(".bank-name").hide();
                $(".cheque-number").hide();

                function updateFieldsBasedOnSelection() {
                    var selected = $('#payment_type').val();
                    console.log("payment_type :- ", selected);


                    // Show fields based on the selected value
                    if (selected == 'Cheque') {
                        $(".bank-name").show();
                        $(".cheque-number").show();
                        $(".transaction-number").hide();
                    }
                    if (selected == 'Card' || selected == 'E-wallet') {
                        $(".transaction-number").show();
                        $(".bank-name").hide();
                        $(".cheque-number").hide();
                    }
                    if (selected == 'Cash') {
                        $(".transaction-number").hide();
                        $(".bank-name").hide();
                        $(".cheque-number").hide();
                    }
                    if (selected == '') {
                        $(".transaction-number").hide();
                        $(".bank-name").hide();
                        $(".cheque-number").hide();
                    }
                }
                updateFieldsBasedOnSelection();

                // Attach change event handler to update fields when selection changes
                $(document).on('change', '#payment_type', function(e) {
                    updateFieldsBasedOnSelection();
                });
            });
        </script>
        <script>
            function getRooms() {
                let hostelId = $("#hostel").val();
                // let roomId = $("#room").val();
                console.log(hostelId);
                // console.log(roomId);

                $.ajax({
                    type: "post",
                    url: "{{ route('addmission.rooms') }}",
                    data: {
                        hostel_id: hostelId,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: "json",
                    success: function(response) {
                        $('#room').html('<option value="" selected>Select Rooms</option>');
                        $.each(response, function(key, value) {
                            $('#room').append('<option value="' + value.id + '">' +
                                value.room_number + '</option>');
                        });
                    }
                });
            }

            function getBeds() {
                let roomId = $("#room").val();
                console.log(roomId);

                $.ajax({
                    type: "post",
                    url: "{{ route('addmission.beds') }}",
                    data: {
                        room_id: roomId,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: "json",
                    success: function(response) {
                        $('#bed').html('<option value="" selected>Select beds</option>');
                        $.each(response, function(key, value) {
                            $('#bed').append('<option value="' + value.id + '">' +
                                value.bed_number + '</option>');
                        });
                    }
                });
            }
        </script>
    @endsection
