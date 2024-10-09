@extends('layouts/contentNavbarLayout')

@section('title', 'Dashboard - Analytics')

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
<div class="above d-flex justify-content-between">
  <div class="option d-flex mb-2">
    <button class="btn btn-outline-primary btn-sm">For You</button>
    <button class="btn btn-outline-secondary btn-sm ms-2">Mutual</button>
  </div>
  <div class="create-post">
    <button type="button" class="btn btn-primary btn-m" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">NEW POST</button>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Share Your Thoughts</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form>
              <div class="mb-3">
                <label for="message-text" class="col-form-label">Message:</label>
                <textarea class="form-control" id="message-text" placeholder="What's going on!"></textarea>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Post</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="card mt-2">
  {{-- <img src="https://via.placeholder.com/500x300" class="card-img-top" alt="Post Image"> --}}
  <div class="card-body">
    <div class="row mb-2 align-items-center">
      <div class="col-1">
        <img src="{{ asset('assets/img/avatars/1.png') }}" alt="Profile Picture" class="rounded-circle" width="50px">
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
      <button class="btn btn-light btn-sm"><i class="mdi mdi-bookmark-outline"></i> </button>
      <button class="btn btn-light btn-sm"><i class="mdi mdi-share-outline"></i> </button>
    </div>
  </div>
</div>

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
      <button class="btn btn-light btn-sm"><i class="mdi mdi-bookmark-outline"></i> </button>
      <button class="btn btn-light btn-sm"><i class="mdi mdi-share-outline"></i> </button>
    </div>
  </div>
</div>

<div class="card mt-2">
  {{-- <img src="https://via.placeholder.com/500x300" class="card-img-top" alt="Post Image"> --}}
  <div class="card-body">
    <div class="row mb-2 align-items-center">
      <div class="col-1">
        <img src="{{ asset('assets/img/avatars/5.png') }}" alt="Profile Picture" class="rounded-circle" width="50px">
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
      <button class="btn btn-light btn-sm"><i class="mdi mdi-bookmark-outline"></i> </button>
      <button class="btn btn-light btn-sm"><i class="mdi mdi-share-outline"></i> </button>
    </div>
  </div>
</div>
<div class="card mt-2">
  {{-- <img src="https://via.placeholder.com/500x300" class="card-img-top" alt="Post Image"> --}}
  <div class="card-body">
    <div class="row mb-2 align-items-center">
      <div class="col-1">
        <img src="{{ asset('assets/img/avatars/3.png') }}" alt="Profile Picture" class="rounded-circle" width="50px">
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
      <button class="btn btn-light btn-sm"><i class="mdi mdi-bookmark-outline"></i> </button>
      <button class="btn btn-light btn-sm"><i class="mdi mdi-share-outline"></i> </button>
    </div>
  </div>
</div>

@endsection
