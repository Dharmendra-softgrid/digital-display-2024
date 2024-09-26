@extends('admin.layouts.app')

@section('content')
    <style>
        .table-responsive {
            width: 100%;
            overflow-x: auto;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            padding: 8px 12px;
            border: 1px solid #ddd;
        }
    </style>
    <div class="pagetitle">
        <h1>Contacts</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active">Contacts</li>
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

                                    <h5 class="card-title ">Contacts</h5>
                                    <div>
                                        <a href="{{ route('contact.export') }}" class="btn btn-primary"><i
                                                class="bi bi-save"></i> Export</a>
                                    </div>

                                </div>


                                <div class="container mt-5">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Email</th>
                                                    <th scope="col">Phone</th>
                                                    <th scope="col">City</th>
                                                    <th scope="col">Company</th>
                                                    <th scope="col">Interested Category</th>
                                                    <th scope="col">Interested Sub-Category</th>
                                                    <th scope="col">Product</th>
                                                    <th scope="col">Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                @if ($contacts->isNotEmpty())
                                                <?php $count = 1;?>
                                                    @foreach ($contacts as $i => $contact)
                                                        <tr>
                                                            <td>{{$count}}</td>
                                                            <td>{{ $contact->first_name . ' ' . $contact->last_name }}</td>
                                                            <td>{{ $contact->email }}</td>
                                                            <td>{{ $contact->phone }}</td>
                                                            <td>{{ $contact->city }}</td>
                                                            <td>{{ $contact->company }}</td>
                                                            <td>{{ $contact->interested_category }}</td>
                                                            <td>{{ $contact->interested_subcategory }}</td>
                                                            <td>{{ $contact->product }}</td>
                                                            <td>{{ date('d M Y H:i:s', strtotime($contact->created_at)) }}
                                                            </td>
                                                        </tr>
                                                        <?php $count ++;?>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td colspan="4" class="text-center">No record found</td>
                                                    </tr>
                                                @endif

                                            </tbody>
                                        </table>
                                        {{ $contacts->links() }}
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div><!-- End Recent Sales -->



                </div>
            </div><!-- End Left side columns -->



        </div>

    </section>
@endsection
@section('scripts')
@endsection
