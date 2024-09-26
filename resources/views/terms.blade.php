@extends('layouts.app')
@section('content')
<main class="main_content">
    <section class="sec_padd product_display_solution">
        <div class="container">
            <div class="head_cmn text-center ">
            <h2 class="head_2">{{$first_sec_content->title}}</h2>
              
            </div>
              <div class="sec_p text-left terms_content">
                    <span>{!! $first_sec_content->content !!}</span>
                </div>
        </div>
    </section>
</main>
@endsection