@extends('layouts.app')
@section('content')
    <main class="main_content">
        <section class="top-inner-banner">
            <div class="top_banner_slider">

                @foreach ($sliders as $i => $slider)
                    <div class="banner_slide">
                        <div class="banner_slide_img">
                            <figure>
                                <img src="{{ asset(isset($slider->image) ? 'images/' . $slider->image : 'images/computerbanner.jpg') }}"
                                    alt="banner">
                            </figure>
                        </div>
                        <div class="banner_slide_caption">
                            @if (!empty($slider->slide_title))
                                <div class="container relative">
                                    <div class="top-banner-content">
                                        <h4>{{ $slider->slide_title }}</h4>
                                        <p>{!! $slider->slide_content !!}</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
                <!-- slid end -->
            </div>
        </section>
        <section class="sec_padd inquire-now-page">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-12 mobile_hide">
                        <div class="left_sidebar inquire-left-content">
                            {!! $second_sec_content->content ?? ' ' !!}
                            <div class="Support_call">
                                <h5>Call Support</h5>
                                <p>To talk to our Technical Support team, <br>call us on {{ $settings_mobile->svalue }}</p>
                            </div>
                            <div class="email_call">
                                <h5>Email Support</h5>
                                <p>To talk to our Technical Support team via email contact us at <a
                                        href="{{ url($settings_email->svalue) }}">{{ $settings_email->svalue }}</a></p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-8 col-12">
                        <div class="right-side">
                            <div class="top-text">
                                <p>{!! $first_sec_content->content ?? ' ' !!}</p>
                                <br>
                            </div>

                            <div class="inquire-now-form">
                                <form method="POST" action="{{ route('postInquiry') }}" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="row g-3">
                                        <div class="col-md-6">

                                            <input type="text" class="form-control" id="first-name" name="first_name"
                                                placeholder="First Name*" required>
                                        </div>
                                        <div class="col-md-6">

                                            <input type="text" class="form-control" id="last Name" name="last_name"
                                                placeholder="Last Name*" required>
                                        </div>
                                        <div class="col-md-6">

                                            <input type="email" class="form-control" id="email" name="email"
                                                placeholder="Email ID*" required>
                                        </div>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control" id="phone" name="phone" 
                                          placeholder="Phone Number*" maxlength="10" pattern="\d{10}" 
                                          title="Please enter a 10-digit phone number" required>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" id="State" name="state"
                                                placeholder="State*" required>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" id="city" name="city"
                                                placeholder="City*" required>
                                        </div>

                                        <div class="col-md-6">
                                            <input type="text" class="form-control" id="company"
                                                placeholder="Company Name*" name="company" required>
                                        </div>

                                        <div class="col-md-6">
                                            <input type="text" class="form-control" id="CategoryOfInterest"
                                                placeholder="Interested Catergory" name="interested_category">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" id="interestedsubcategory"
                                                placeholder="Interested sub-catergory" name="interested_subcategory">
                                        </div>
                                        <div class="col-md-6">
                                            <!-- <input type="text" class="form-control" id="Product Brand"  placeholder="Product Name"  name="Product Brand"> -->
                                            <select class="form-select form-select-lg" name="product">
                                                <option>Interested Product</option>
                                                @foreach ($products as $key => $value)
                                                    <option value="{{ $value->title }}">{{ $value->title }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        {{-- <div class="col-md-6">
                              <!-- <input type="text" class="form-control" id="Product Brand"  placeholder="Industry Type"  name="Product Brand"> -->
                                <select class="form-select form-select-lg" name="industry">
                                  <option>Interested sub-catergory</option>
                                  @foreach ($industries as $key => $value)
                                    <option value="{{$value->title}}"
                                        @if (!empty($IndustryBlog->industry_id))
                                            {{  ($IndustryBlog->industry_id == $value->id) ? 'selected="selected"' : '' }}
                                        @endif/>{{$value->title}}
                                    </option>
                                  @endforeach
                               </select>
                            </div> --}}
                                        <div class="col-md-12">
                                            <div class="required_sec">
                                                <div class="tacbox">
                                                    <input id="checkbox" type="checkbox" name="checkbox" required>
                                                    <label class="checkbox" for="checkbox">I agree to the<a
                                                            href="{{ route('terms-and-conditions') }}"> Terms of
                                                            Use </a>&<a
                                                            href="{{ route('privacy-policy') }}">  Privacy Policy.</a></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-md-4 col-12 inquire-now-sbt">
                                                    <button type="submit"
                                                        class="btn inquire-now-link round-0">SUBMIT</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </section>
    </main>
@endsection
<script>
    document.getElementById('myForm').addEventListener('submit', function(event) {

        var checkboxChecked = document.getElementById('checkbox').checked;

        if (!checkboxChecked) {
            alert('Please agree to the Terms of Use & Privacy Policy.');
            return false; // Prevent form submission
        }
    });
</script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
      document.getElementById('phone').addEventListener('input', function() {
          let phoneInput = this.value;
          console.log(phoneInput); // Log the current input value

          // Remove any non-digit characters
          phoneInput = phoneInput.replace(/\D/g, '');

          // If no input, clear validity and return
          if (phoneInput.length === 0) {
              this.setCustomValidity(""); // Clear any custom validity message
              this.value = ""; // Allow empty input
              return;
          }

          // Restrict digits below 6
          if (/^[1-5]/.test(phoneInput)) {
              this.setCustomValidity("Phone number cannot start with 1, 2, 3, 4, or 5.");
              this.reportValidity(); // Show validation message
              this.value = ""; // Clear input if invalid
              return;
          }

          // Check if the first digit is less than 6
          if (phoneInput[0] < '6') {
              this.setCustomValidity("Phone number must start with 6 or above.");
              this.reportValidity(); // Show validation message
              this.value = ""; // Clear input if invalid
              return;
          }

          // Count the occurrences of each digit
          const digitCount = {};
          for (let digit of phoneInput) {
              digitCount[digit] = (digitCount[digit] || 0) + 1;
              // If any digit is repeated more than 8 times, remove the last character
              if (digitCount[digit] > 8) {
                  this.setCustomValidity("No digit should repeat more than 8 times.");
                  this.reportValidity(); // Show validation message
                  this.value = phoneInput.substring(0, phoneInput.length - 1); // Remove the last character
                  return;
              }
          }

          // Check if the length is not equal to 10
          if (phoneInput.length > 10) {
              this.setCustomValidity("Please enter a valid 10-digit phone number.");
              this.reportValidity(); // Show validation message
              this.value = phoneInput.substring(0, 10); // Limit input to 10 digits
          } else {
              this.setCustomValidity(""); // Clear the custom validity message
          }

          // Update the input field's value
          this.value = phoneInput.substring(0, 10); // Limit input to 10 digits
      });
  });
</script>







