@extends('admin.layouts.app')

@section('content')

<div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Change Password</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

  <section class="section profile">
      <div class="row">
        

        <div class="col-xl-12">

          <div class="card">
            <div class="card-body pt-3">

           @include('admin.shared.displaymsg')

              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered" role="tablist">

                <li class="nav-item" role="presentation">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-change-password" aria-selected="true" role="tab">Change Password</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

                

                <div class="tab-pane fade pt-3 active show" id="profile-change-password" role="tabpanel">
                  <!-- Change Password Form -->
                   <form name="frmchangepassword" id="frmchangepassword" action="{{ route('password.change.submit') }}" method="post">
                        {{ csrf_field() }}
                        <div class="row mb-3">
                          <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password*</label>
                          <div class="col-md-8 col-lg-9">
                            <input type="password" name="current_password" id="current_password" value="" class="form-control" placeholder="Current Password" maxlength="255">
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password*</label>
                          <div class="col-md-8 col-lg-9">
                            <input type="password" name="new_password" id="new_password" value="" class="form-control" placeholder="New Password" maxlength="255">
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Confirm Password*</label>
                          <div class="col-md-8 col-lg-9">
                            <input type="password" name="confirm_password" id="confirm_password" value="" class="form-control" placeholder="Confirm Password" maxlength="255">
                          </div>
                        </div>
                        <div class="text-center">
                          <button type="submit" class="btn btn-primary">Change Password</button>
                        </div>
                    </form><!-- End Change Password Form -->

                </div>

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>

@endsection
