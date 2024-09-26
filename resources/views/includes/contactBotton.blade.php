<button type="button" class="left_btn btn_common" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Contact Us
      </button>
@if(Route::current()->getName() != 'contact-us')
      <!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Contact Sales</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form id="contactform" class="requires-validation" novalidate>
                @csrf
                 
                <p>Are you looking for more information related to a Panasonic professional product or solution? We have an expert team ready to help. Please fill in the form and a Panasonic Sales representative will contact you shortly.</p>
                <div class="row">
                  <div class="col-md-6 mb-lg-3 mb-2">
                     <input class="form-control" type="text" name="fname" placeholder="First Name*" required>
                  </div>
                  <div class="col-md-6 mb-lg-3 mb-2">
                     <input class="form-control" type="text" name="lname" placeholder="Last Name*" required>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6 mb-lg-3 mb-2">
                     <input class="form-control" type="email" name="email" placeholder="Email*" required>
                  </div>
                  <div class="col-md-6 mb-lg-3 mb-2">
                     <input class="form-control phoneNumber" type="text" name="phone" placeholder="Phone*"  required>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6 mb-lg-3 mb-2">
                    <input class="form-control" type="text" name="city" placeholder="City*" required>
                  </div>
                  <div class="col-md-6 mb-lg-3 mb-2">
                    <select class="form-select" name="category" required>
                      <option value="" selected="selected">Product/Category of Interest</option>
                       @php $categories = App\ProductCategory::orderBy('title')->get() @endphp
                        @if($categories->isNotEmpty())
                           @foreach($categories as $category)
                              <option value="{{$category->id}}">{{$category->title}}</option>
                           @endforeach
                        @endif
                      
                    </select>
                  </div>
                </div>
                <div class="row mb-2">
                  <div class="col-md-6 mb-lg-3 mb-2">
                                <input class="form-control quantity" type="number" min="1" name="quantity" placeholder="Quantity*"  required> 
                           </div>
                   <div class="col-md-6 mb-lg-3 ">
                        <select class="form-select" name="industry" required>
                          <option value="" selected="selected">Industry Type</option>
                           @php $industries = App\Industries::orderBy('title')->get() @endphp
                        @if($industries->isNotEmpty())
                           @foreach($industries as $industry)
                           <option value="{{$industry->id}}">{{$industry->title}}</option>
                           @endforeach
                        @endif
                         </select> 
                   </div>
                 </div>
                 <div class="row">
                   <div class="col-md-12 mb-lg-3 mb-2">
                    <textarea class="form-control" name="comment" rows="3" placeholder="Comment" required></textarea>
                   </div>
                 </div>
                <div class="form-button mt-3 mb-3">
                    <button id="submit" type="submit" class="btn_common">Submit <img src="{{asset('/')}}images/arrow.svg"></button>
                </div>
                <div id="contactmsg"></div>
            </form>
            </div>
          </div>
        </div>
      </div>
@endif