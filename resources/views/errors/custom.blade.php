@extends('admin.layouts.app')
@section('bg-class','bg-transparent')

@section('content')
  <div class="content-wrapper fullwidth" id="success-page">
    <section class="find-section fullwidth">
      <div class="inner-wrapper container1200">
        <div class="success-content">
          <h2 class="success-title contentFont">@lang('messages.page-error')</h2>
          <a href="{{ route('web.home') }}" class="goto-home-link">
            <button type="button" class="titleFont fixit-button">@lang('messages.home')</button>
          </a>
        </div>
      </div>
    </section>
  </div>
@endsection

