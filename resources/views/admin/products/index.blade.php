@extends('admin.layouts.app')
@section('styles')
    <style type="text/css">
        .image-holder {
            width: 80px;
        }

        .product_img {
            width: 100%;
            height: 80px;
            object-fit: cover;
        }

        /* Center align content in action buttons column */
        .dataTables_wrapper .dataTables_scrollBody .table td:nth-child(5) {
            text-align: center;
        }

        /* Adjust spacing between action buttons */
        .dataTables_wrapper .dataTables_scrollBody .table td:nth-child(5) .btn {
            margin-bottom: 5px;
            /* Example spacing adjustment */
        }

        .dataTables_wrapper .dataTables_paginate {
            float: right;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            margin: 0 2px;
        }

        table.dataTable tbody td.details-control {
            cursor: pointer;
            text-align: center;
            white-space: nowrap;
        }
    </style>
@endsection
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<!-- DataTables Responsive CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
@section('content')
    <div class="pagetitle">
        <h1>Products</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active">Products</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section ">
        <div class="row">
            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">
                    <!-- Recent Sales -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                @include('admin.shared.displaymsg')
                                <div class="d-flex justify-content-between mt-4">
                                    <h5 class="card-title ">Products</h5>
                                    <div>
                                        <a href="{{ route('product.create') }}" class="btn btn-primary"><i
                                                class="bi bi-plus"></i> Add product</a>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table id="dataTable" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Title</th>
                                                <th>Series</th>
                                                <th>Featured Image</th>
                                                <th>Actions</th> <!-- Plus button or actions column -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Table body rows will be populated dynamically -->
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div><!-- End Recent Sales -->
                </div>
            </div><!-- End Left side columns -->
        </div>
        <form method="POST" action="" id="Deletefrom">
            @method('DELETE')
            @csrf
        </form>
        <div class="modal fade" id="deletecat" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Are you sure ?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete product ?
                        <p>if you delete this product, all related data will be deleted.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                        <button type="button" class="btn btn-danger" id="yesdelete">Yes</button>
                    </div>
                </div>
            </div>
        </div><!-- End Vertically centered Modal-->
    </section>
@endsection
@section('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <!-- DataTables Responsive JS -->
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>

    <script>
        /*================================
                                                                datatable active
                                                                ==================================*/
        if ($('#dataTable').length) {
            var table = $('#dataTable').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                pageLength: 10,
                order: [
                    [0, "desc"]
                ],
                "bLengthChange": false,
                "bFilter": true,
                "ajax": {
                    url: "{{ route('index') }}",
                    error: function(xhr, error, thrown) {
                        console.log('DataTables AJAX Error:', error);
                        console.log(xhr);
                    }
                },
                "columns": [{
                        "data": 'id'
                    },
                    {
                        "data": 'title'
                    }, // title
                    {
                        "data": 'series'
                    }, // series
                    {
                        "data": 'featured_image',
                        "render": function(data) {
                            return '<img src="' + data + '" class="product_img">';
                        }
                    }, // featured_image
                    {
                        "data": null,
                        "orderable": false,
                        "searchable": false,
                        "className": "text-center",
                        "render": function(data, type, row) {
                            return '<div class="btn-group">' +
                                '<a title="edit" style="margin-right: 5px;" href="' + row.edit_url +
                                '" class="btn btn-primary btn-sm" data-product_id="' + row.product_id +
                                '" ><i class="bi bi-pencil"></i></a>' +
                                '<button title="delete" type="button" class="btn btn-danger btn-sm delete" data-product_id="' +
                                row.product_id + '"><i class="bi bi-trash"></i></button>' +
                                '</div>';
                        }
                    } // action buttons column
                ],
                "dom": '<"top"f>rt<"bottom"ip><"clear">',
                "pagingType": "full_numbers",
                "language": {
                    "paginate": {
                        "first": "First",
                        "previous": "Prev",
                        "next": "Next",
                        "last": "Last",
                    }
                }
            });
        }




        $(document).on('change', '#challenge_type', function() {
            var type = $(this).val();
            table.context[0].ajax.data.challenge_type = type;
            table.draw();
        });

        $(document).on('click', '.delete', function() {
            var product_id = $(this).data('product_id');
            console.log(product_id);
            var result = confirm("Are you sure you want to delete?");
            if (result) {
                // Perform your delete operation here, e.g., via AJAX
                $.ajax({
                    url: 'products/delete/' + product_id, // Replace with your actual delete route
                    type: 'DELETE',
                    success: function(response) {
                        // Handle success response
                        console.log('Product deleted successfully');
                        // Optionally, update your DataTable
                        table.ajax.reload(); // Reloads data in DataTable
                    },
                    error: function(xhr) {
                        // Handle error response
                        console.error('Error deleting product');
                    }
                });
            }
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
@endsection
