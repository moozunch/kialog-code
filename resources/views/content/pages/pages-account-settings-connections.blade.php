@extends('layouts/contentNavbarLayout')

@section('title', 'Blocked Account')

@section('content')
<h4 class="py-3 mb-4">
  <span class="text-muted fw-light">Account Settings / </span> Blocked Accounts
</h4>

<div class="row">
  <div class="col-md-12">
    <ul class="nav nav-pills flex-column flex-md-row mb-4 gap-2 gap-lg-0">
      <li class="nav-item"><a class="nav-link" href="{{url('pages/account-settings-account')}}"><i class="mdi mdi-account-outline mdi-20px me-1"></i> Account</a></li>
      <li class="nav-item"><a class="nav-link" href="{{url('pages/account-settings-notifications')}}"><i class="mdi mdi-bell-outline mdi-20px me-1"></i> Notifications</a></li>
      <li class="nav-item"><a class="nav-link active" href="javascript:void(0);"><i class="mdi mdi-account-cancel-outline mdi-20px me-1"></i> Blocked Accounts</a></li>
      <li class="nav-item"><a class="nav-link" href="{{url('/pages/settings-community')}}"><i class="mdi mdi-account-group-outline mdi-20px me-1"></i> Community</a></li>
    </ul>
    <div class="card">
      <div class="card-header">
        <h5 class="mb-2">Blocked Accounts</h5>
        <p class="mb-0 text-body">Display accounts from your blocked list on your account</p>
      </div>
      <div class="card-body">
        <div class="list-group">
          @foreach($blockedUsers as $block)
          <div class="list-group-item d-flex justify-content-between align-items-center">
              <div>
                  <img src="{{ $block->blockedUser->profile_image ?? asset('assets/img/avatars/1.png') }}" alt="Profile Picture" class="rounded-circle" width="50px" height="50px">
                  <span>{{ $block->blockedUser->name }}</span>
              </div>
              <form action="{{ route('blocks.unblock') }}" method="POST">
                  @csrf
                  <input type="hidden" name="blocked_user_id" value="{{ $block->blocked_user_id }}">
                  <button type="submit" class="btn btn-danger">Unblock</button>
              </form>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
