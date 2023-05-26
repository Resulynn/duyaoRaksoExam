@if (Session::has('error'))
  <div class="justify-content-center w-100 d-flex mt-3">
    <div class="alert alert-danger alert-dismissible fade text-center show w-50" role="alert">
        <i class="bi bi-exclamation-circle-fill text-danger"></i>
        <strong>Alert!</strong> {{Session::get('error')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  </div>
@endif

@if (Session::has('success'))
  <div class="justify-content-center w-100 d-flex mt-3">
    <div class="alert alert-success alert-dismissible fade text-center show w-50" role="alert">
        <i class="bi bi-exclamation-circle-fill text-success"></i>
        <strong class=>Perfect.</strong> {{Session::get('success')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  </div>
@endif