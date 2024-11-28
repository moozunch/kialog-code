@extends('layouts/contentNavbarLayout')

@section('title', 'Account settings - Account')

@section('page-script')
  <script src="{{ asset('assets/js/pages-account-settings-account.js') }}"></script>
@endsection

@section('vendor-style')
  <link rel="stylesheet" href="{{ asset('assets/css/button.css') }}">
@endsection
@section('content')
  <h4 class="py-3 mb-4">
    <span class="text-muted fw-light">Account Settings /</span> Account
  </h4>

  <div class="row">
    <div class="col-md-12">
      <ul class="nav nav-pills flex-column flex-md-row mb-4 gap-2 gap-lg-0">
        <li class="nav-item"><a class="nav-link active" href="javascript:void(0);"><i class="mdi mdi-account-outline mdi-20px me-1"></i> Account</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ url('pages/account-settings-notifications') }}"><i class="mdi mdi-bell-outline mdi-20px me-1"></i> Notifications</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ url('pages/account-settings-blocked-accounts') }}"><i class="mdi mdi-account-cancel-outline mdi-20px me-1"></i> Blocked Accounts</a></li>
        <li class="nav-item"><a class="nav-link" href="{{url('/pages/settings-community')}}"><i class="mdi mdi-account-group-outline mdi-20px me-1"></i> Community</a></li>
      </ul>

      <div class="card mb-4">
        <h4 class="card-header">Profile Details</h4>

        <!-- Account -->
        <div class="card-body pt-2 mt-1">
          <form id="formAccountSettings" method="POST" action="{{ route('account-settings.update') }}" enctype="multipart/form-data">
            @csrf

            <div class="d-flex align-items-start align-items-sm-center gap-4 mb-4">
              <img src="{{ Auth::user()->profile_image ? Auth::user()->profile_image : asset('assets/img/avatars/1.png') }}" style="object-fit: cover; object-position: center" alt="user-avatar" class="d-block w-px-120 h-px-120 rounded" id="uploadedAvatar" />
              <div class="button-wrapper">
                <label for="profile_image" class="btn btn-primary me-2 mb-3" tabindex="0">
                  <span class="d-none d-sm-block">Upload new photo</span>
                  <i class="mdi mdi-tray-arrow-up d-block d-sm-none"></i>
                  <input type="file" id="profile_image" name="profile_image" class="account-file-input" hidden accept="image/png, image/jpeg" />
                </label>
                <button type="button" class="btn btn-outline-danger account-image-reset mb-3">
                  <i class="mdi mdi-reload d-block d-sm-none"></i>
                  <span class="d-none d-sm-block">Reset</span>
                </button>
                <div class="text-muted small">Allowed JPG, GIF, or PNG. Max size of 800K</div>
              </div>
            </div>

            <div class="row mt-2 gy-4">
              <div class="col-md-6">
                <div class="form-floating form-floating-outline">
                  <input class="form-control" type="text" id="username" name="username" autofocus value="{{ Auth::user()->username }}" />
                  <label for="username">Username</label>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-floating form-floating-outline">
                  <input class="form-control" type="text" name="name" id="name" value="{{ Auth::user()->name }}" placeholder="set display name"/>
                  <label for="name">Display Name</label>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-floating form-floating-outline">
                  <input class="form-control" type="text" id="email" name="email" value="{{ Auth::user()->email }}" placeholder="email@domain.com" />
                  <label for="email">E-mail</label>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-floating form-floating-outline">
                  <input type="text" class="form-control" id="institution" name="institution" placeholder="Institution" value="{{ Auth::user()->institution }}" />
                  <label for="institution">Institution</label>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-floating form-floating-outline">
                  <input class="form-control" type="text" id="bio" name="bio" placeholder="add a little information" value="{{ Auth::user()->bio }}" />
                  <label for="bio">Description</label>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-floating form-floating-outline">
                  <select id="country" class="select2 form-select" name="country">
                    <option value="{{ Auth::user()->country }}">Select</option>
                    <option value="Australia">Australia</option>
                    <option value="Bangladesh">Bangladesh</option>
                    <option value="Belarus">Belarus</option>
                    <option value="Brazil">Brazil</option>
                    <option value="Canada">Canada</option>
                    <option value="China">China</option>
                    <option value="France">France</option>
                    <option value="Germany">Germany</option>
                    <option value="India">India</option>
                    <option value="Indonesia">Indonesia</option>
                    <option value="Italy">Italy</option>
                    <option value="Japan">Japan</option>
                    <option value="Korea">Korea, Republic of</option>
                    <option value="Mexico">Mexico</option>
                    <option value="Philippines">Philippines</option>
                    <option value="Russia">Russian Federation</option>
                    <option value="South Africa">South Africa</option>
                    <option value="Thailand">Thailand</option>
                    <option value="Turkey">Turkey</option>
                    <option value="Ukraine">Ukraine</option>
                    <option value="United Arab Emirates">United Arab Emirates</option>
                    <option value="United Kingdom">United Kingdom</option>
                    <option value="United States">United States</option>
                  </select>
                  <label for="country">Country</label>
                </div>
              </div>
            </div>

            <div class="mt-4">
              <button type="submit" class="btn btn-primary me-2">Save changes</button>
              <button type="reset" class="btn btn-outline-secondary">Reset</button>
            </div>
          </form>
        </div>
        <!-- /Account -->
      </div>

      <div class="card">
        <h5 class="card-header fw-normal">Delete Account</h5>
        <div class="card-body">
          <div class="mb-3 col-12 mb-0">
            <div class="alert alert-warning">
              <h6 class="alert-heading mb-1">Are you sure you want to delete your account?</h6>
              <p class="mb-0">Once you delete your account, there is no going back. Please be certain.</p>
            </div>
          </div>
          <form id="formAccountDeactivation" method="POST" action="{{ route('account.delete') }}">
            @csrf
            @method('DELETE')
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">Deactivate Account</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Confirmation Modal -->
  <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Account Deletion</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Are you sure you want to delete your account? This action cannot be undone.
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-danger" onclick="document.getElementById('formAccountDeactivation').submit();">Delete Account</button>
        </div>
      </div>
    </div>
  </div>
@endsection
