@extends('admin.layouts.app')
@section('content')
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section dashboard">
        <div class="row">
            <section class="section dashboard">
                <div class="container-fluid row">
                    <!-- Left side columns -->
                    <div class="col-lg-12">
                        <div class="row" id="data_counts">
                            <div class="col-xxl-6 col-xl-6 col-md-6 col-sm-12">
                                <div class="card info-card sales-card">
                                    <div class="card-body">
                                        <h5 class="card-title">Total Products</h5>
                                        <div class="d-flex align-items-center">
                                            <div
                                                class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="bi bi-card-list"></i></div>
                                            <div class="ps-3">
                                                <h6>{{$product_count}}</h6><span class="text-success small pt-1 fw-bold"> </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-6 col-xl-6 col-md-6 col-sm-12">
                                <div class="card info-card sales-card">
                                    <div class="card-body">
                                        <h5 class="card-title">Total Enquries</h5>
                                        <div class="d-flex align-items-center">
                                            <div
                                                class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="bi bi-card-text"></i></div>
                                            <div class="ps-3">
                                                <h6>{{$enquiry}}</h6><span class="text-success small pt-1 fw-bold"> </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" id="share_of_voice">
                        </div>
                    </div><!-- End Left side columns -->
                    {{-- <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Example Card</h5>
                                <p>This is an examle page with no contrnt. You can use it as a starter for your custom
                                    pages.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Example Card</h5>
                                <p>This is an examle page with no contrnt. You can use it as a starter for your custom
                                    pages.</p>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </section>
        </div>
    </section>
@endsection
