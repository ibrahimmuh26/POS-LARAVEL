@if (session()->has('success'))
    <div class="alert text-white bg-success" role="alert">
        <div class="iq-alert-text">{{ session('success') }}</div>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <i class="ri-close-line"></i>
        </button>
    </div>
@endif

<div class="card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">Profile</h4>
    </div>
</div>
<div class="card-body">

    <div class=" row align-items-center">
        <div class="form-group col-md-12">
            <label for="fname">Full Name</label>
            <input type="text" class="form-control bg-white" id="fname" value="{{ auth()->user()->name }}"
                readonly>
        </div>
        <div class="form-group col-md-6">
            <label for="uname">Username</label>
            <input type="text" class="form-control bg-white" id="uname" value="{{ auth()->user()->username }}"
                readonly>
        </div>
        <div class="form-group col-md-6">
            <label for="email">Email</label>
            <input type="text" class="form-control bg-white" id="email" value="{{ auth()->user()->email }}"
                readonly>
        </div>
    </div>
</div>
