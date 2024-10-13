@extends('layouts/contentNavbarLayout')

@section('title', 'Home')

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
              <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                  <label for="message-text" class="col-form-label">Message:</label>
                  <textarea class="form-control" id="message-text" name="message" placeholder="What's going on!"></textarea>
                </div>
                <div class="mb-3">
                  <label for="post-image" class="col-form-label">Upload Image:</label>
                  <input type="file" class="form-control" id="post-image" name="image">
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Post</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  @foreach($posts as $post)
    <div class="card mt-2">
      @if($post->image)
        <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top" alt="Post Image">
      @endif
      <div class="card-body">
        <div class="row mb-2 align-items-center">
          <div class="col-1">
            <img src="{{ asset($post->user->profile_image) }}" alt="Profile Picture" class="rounded-circle" width="50px">
          </div>
          <div class="col">
            <h5 class="card-title">{{ $post->user->name }}</h5>
          </div>
        </div>
        <div class="row">
          <h6 class="card-title text-muted">{{ $post->user->username }}</h6>
        </div>
        <p class="card-text">{{ $post->message }}</p>
      </div>
      <div class="card-footer d-flex justify-content-between align-items-center">
        <small class="text-muted">Posted on {{ $post->created_at->format('F j, Y') }}</small>
        <div>
          <button class="btn btn-light btn-sm"><i class="mdi mdi-thumb-up-outline"></i> {{ $post->likes }}</button>
          <button class="btn btn-light btn-sm"><i class="mdi mdi-comment-outline"></i> {{ $post->comments }}</button>
          <form action="{{ route('bookmarks.store', $post->id) }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" class="btn btn-light btn-sm">
                @if($post->bookmarks && !$post->bookmarks->isEmpty())
               <i class="mdi mdi-bookmark"></i> <!-- Bookmarked icon -->
                @else
                    <i class="mdi mdi-bookmark-outline"></i> <!-- Not bookmarked icon -->
                @endif
            </button>
         </form>
          <button class="btn btn-light btn-sm"><i class="mdi mdi-share-outline"></i></button>
        </div>
      </div>
    </div>
  @endforeach

@endsection
