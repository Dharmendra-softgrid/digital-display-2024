 @if (count($errors) > 0)
    <div class="list-group">
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger alert-dismissible fade show mt-4" role="alert"> <i class="bi bi-exclamation-octagon me-1"></i> 
            {{ $error }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
    @endforeach
  </div>
@endif

 @if (Session::has('success'))
    <div class="alert alert-success alert-dismissible fade show mt-4" role="alert"> <i class="bi bi-check-circle me-1"></i> 
        {{ Session::get('success') }} 
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (Session::has('error'))
    <div class="alert alert-danger alert-dismissible fade show mt-4" role="alert"> <i class="bi bi-exclamation-octagon me-1"></i> 
        {{ Session::get('error') }} 
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif