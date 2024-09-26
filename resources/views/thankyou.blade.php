@extends('layouts.app')
@section('content')
<style type="text/css">
.thank-you-content {
    text-align: center;
    max-width: 900px;
    margin: auto;
}

.thank-you-page.content.section_paddding {
    padding: 90px 0;
}
.thank-you-content svg#checkmark {
    background: #24b663;
    font-size: 50px;
    border-radius: 50%;
    padding: 11px;
    color: #fff;
}
.thank-you-content h1.thank-you_title {
    font-size: 65px;
}
.thank-you-content p.main-content__body {
    font-size: 18px;
    margin-top: 40px;
    color: #5c5555;
}
@media screen and (max-width:767px) {
    .thank-you-content h1.thank-you_title {
        font-size: 38px;
    }
}
    </style>
    <main class="main_content">
        <div class="thank-you-page content section_paddding">
            <div class="container">
                <div class="thank-you-content">
                <h1 class="thank-you_title" >THANK YOU!</h1>
                <i class="fa fa-check thanks-content_checkmark" id="checkmark"></i>
                <p class="main-content__body"></p>
            </div>
            </div>
        </div>
    </main>
@endsection