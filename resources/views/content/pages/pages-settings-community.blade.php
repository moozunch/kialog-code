@extends('layouts/contentNavbarLayout')

@section('title', 'Joined Communities')

@section('content')
<h4 class="py-3 mb-4">
  <span class="text-muted fw-light">Account Settings / </span> Communities
</h4>

<div class="row">
  <div class="col-md-12">
    <ul class="nav nav-pills flex-column flex-md-row mb-4 gap-2 gap-lg-0">
      <li class="nav-item"><a class="nav-link" href="{{url('pages/account-settings-account')}}"><i class="mdi mdi-account-outline mdi-20px me-1"></i> Account</a></li>
      <li class="nav-item"><a class="nav-link" href="{{url('pages/account-settings-notifications')}}"><i class="mdi mdi-bell-outline mdi-20px me-1"></i> Notifications</a></li>
      <li class="nav-item"><a class="nav-link" href="{{url('pages/account-settings-blocked-accounts')}}"><i class="mdi mdi-account-cancel-outline mdi-20px me-1"></i> Blocked Accounts</a></li>
      <li class="nav-item"><a class="nav-link active" href="javascript:void(0);"><i class="mdi mdi-account-group-outline mdi-20px me-1"></i> Community</a></li>
    </ul>
    <div class="card">
      <div class="card-header">
        <h5 class="mb-2">Joined Communities</h5>
        <p class="mb-0 text-body">Display communities you have joined</p>
      </div>
      <div class="card-body">
        <div class="list-group">
          @foreach($topics as $topic)
          <div class="list-group-item d-flex justify-content-between align-items-center">
              <div>
                  <span>{{ $topic->title }}</span>
              </div>
              <a href="{{ route('topics.show', $topic->id) }}" class="btn btn-primary">View</a>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
