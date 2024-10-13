@extends('layouts/contentNavbarLayout')

@section('title', 'Topic')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}">
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/dashboards-analytics.js')}}"></script>
@endsection

@section('content')

<div class="card mt-2">
  {{-- <img src="https://via.placeholder.com/500x300" class="card-img-top" alt="Post Image"> --}}
  <div class="card-body">
    <div class="row mb-2 align-items-center">
      <div class="col-1">
        <img src="{{ asset('assets/img/avatars/2.png') }}" alt="Profile Picture" class="rounded-circle" width="50px">
      </div>
      <div class="col">
        <h5 class="card-title">Display Name</h5>
      </div>
    </div>
    <div class="row">
      <h6 class="card-title text-muted">@username</h6>
    </div>
    <p class="card-text">This is a short description or summary of the post content. It gives readers an idea of what the post is about and encourages them to read more.</p>
  </div>
  <div class="card-footer d-flex justify-content-between align-items-center">
    <small class="text-muted">Posted on October 7, 2024</small>
    <div>
      <button class="btn btn-light btn-sm"><i class="mdi mdi-thumb-up-outline"></i> </button>
      <button class="btn btn-light btn-sm"><i class="mdi mdi-comment-outline"></i> </button>
      <button class="btn btn-light btn-sm"><i class="mdi mdi-bookmark"></i> </button>
      <button class="btn btn-light btn-sm"><i class="mdi mdi-share-outline"></i> </button>
    </div>
  </div>
</div>
@endsection
