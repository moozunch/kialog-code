@extends('layouts/contentNavbarLayout')

@section('title', 'Topic')

@section('vendor-style')
  <link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/css/displayposts.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/button.css') }}">
@endsection

@section('vendor-script')
  <script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
@endsection

@section('page-script')
  <script src="{{asset('assets/js/dashboards-analytics.js')}}"></script>
@endsection

@section('content')

@foreach($bookmarks as $bookmark)
<div class="card mt-2">
  <div class="card-body">
    <div class="row mb-2 align-items-center">
      <div class="col-auto">
        <a href="{{ route('profile.showOther', ['username' => $bookmark->post->user->username]) }}">
          <img src="{{ $bookmark->post->user->profile_image ?? asset('assets/img/avatars/1.png') }}" alt="Profile Picture" class="rounded-circle" width="50px" height="50px" id="profileImage">
        </a>
      </div>
      <div class="col">
        <h5 class="card-title">{{ $bookmark->post->user->name }}</h5>
        <h6 class="card-title text-muted">{{ $bookmark->post->user->username }}</h6>
      </div>
      <div class="col-auto ml-auto delete-button">
        <a class="btn" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="mdi mdi-dots-horizontal"></i>
        </a>
        <ul class="dropdown-menu dropdown-menu-end">
          @if(auth()->id() === $bookmark->post->user_id)
          <li>
            <form action="{{ route('posts.destroy', $bookmark->post->id) }}" method="POST" style="display: inline;">
              @csrf
              @method('DELETE')
              <button type="submit" class="dropdown-item text-danger">
                <i class="mdi mdi-trash-can-outline me-2"></i> Delete
              </button>
            </form>
          </li>
          @else
          <li>
            <a class="dropdown-item text-warning" href="#" data-bs-toggle="modal" data-bs-target="#reportModal" data-post-id="{{ $bookmark->post->id }}">
              <i class="mdi mdi-account-alert-outline me-2"></i> Report
            </a>
          </li>
          <li>
            <form action="{{ route('blocks.store') }}" method="POST" style="display: inline;">
                @csrf
                <input type="hidden" name="blocked_user_id" value="{{ $bookmark->post->user->id }}">
                <button type="submit" class="dropdown-item text-danger">
                    <i class="mdi mdi-block-helper me-2"></i> Block
                </button>
            </form>
          </li>
        @endif
        </ul>
      </div>
    </div>
    <p class="card-text">{{ $bookmark->post->message }}</p>
  </div>

  @if($bookmark->post->images)
    @php
      $images = json_decode($post->images);
      $imageCount = count($images);
    @endphp
    <div class="d-flex justify-content-center">
      <div class="post-images {{ $imageCount == 2 ? 'grid-2' : ($imageCount > 2 ? 'grid-4' : '') }}">
        @foreach($images as $image)
          @if($loop->index < 4)
            <img src="{{ $image }}" class="mb-2" alt="Post Image {{ $loop->index + 1 }}" style="max-height: 200px; object-fit: cover;">
          @endif
        @endforeach
      </div>
    </div>
  @endif

  <div class="card-footer d-flex justify-content-between align-items-center flex-nowrap">
    <small class="text-muted">Posted on {{ $bookmark->post->created_at->format('F j, Y') }}</small>
    <div class="d-flex justify-content-end flex-nowrap">
      <form action="{{ route('posts.like', $bookmark->post->id) }}" method="POST" style="display: inline;">
        @csrf
        <button type="submit" class="btn btn-like btn-no-bg btn-light btn-sm mx-1">
          @if($bookmark->post->userLikes->contains('user_id', auth()->id()))
            <i class="mdi mdi-cards-heart text-danger"></i>
          @else
            <i class="mdi mdi-cards-heart-outline"></i>
          @endif
          {{ $bookmark->post->userLikes->count() }}
        </button>
      </form>
      <button class="btn btn-comment btn-no-bg btn-light btn-sm mx-1"><i class="mdi mdi-chat-outline"></i> {{ $bookmark->post->comments }}</button>
      <form action="{{ route('bookmarks.store', $bookmark->post->id) }}" method="POST" style="display: inline;">
        @csrf
        <button type="submit" class="btn btn-bookmark btn-no-bg btn-light btn-sm mx-1">
          @if($bookmark->post->bookmarks->contains('user_id', auth()->id()))
            <i class="mdi mdi-bookmark text-primary"></i>
          @else
            <i class="mdi mdi-bookmark-outline"></i>
          @endif
        </button>
      </form>
      <button class="btn btn-no-bg btn-share btn-light btn-sm mx-1"><i class="mdi mdi-share-outline"></i></button>
    </div>
  </div>
</div>
@endforeach

{{-- Modal for report post --}}
<div class="modal fade" id="reportModal" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="reportModalLabel">Report Post</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="https://formspree.io/f/mvgoweoq">
          <!-- Hidden Field for Post ID -->
          <input type="hidden" name="post_id" id="report-post-id">

          <!-- Textarea for Reason -->
          <div class="mb-3">
            <label for="report-reason" class="col-form-label">Reason:</label>
            <textarea class="form-control" id="report-reason" name="reason" placeholder="Describe the reason for reporting this post" required></textarea>
          </div>

          <!-- Footer Buttons -->
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Submit Report</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

  {{-- @foreach($bookmarks as $bookmark)
    <div class="card mt-2">
      <div class="card-body">
        <div class="row mb-2 align-items-center">
          <div class="col-1">
            <a href="{{ route('profile.showOther', ['username' => $bookmark->post->user->username]) }}">
              <img src="{{ $bookmark->post->user->profile_image ?? asset('assets/img/avatars/1.png') }}" alt="Profile Picture" class="rounded-circle" width="50px" height="50px" id="profileImage">
            </a>
          </div>
          <div class="col">
            <h5 class="card-title">{{ $bookmark->post->user->name }}</h5>
            <h6 class="card-title text-muted">{{ $bookmark->post->user->username }}</h6>
          </div>
        </div>
        <p class="card-text">{{ $bookmark->post->message }}</p>
      </div>

      @if($bookmark->post->images)
        @php
          $images = json_decode($bookmark->post->images);
          $imageCount = count($images);
        @endphp

        <div class="d-flex justify-content-center">
          <div class="post-images {{ $imageCount == 2 ? 'grid-2' : ($imageCount > 2 ? 'grid-4' : '') }}">
            @foreach($images as $image)
              @if($loop->index < 4)
                <img src="{{ $image }}" class="mb-2" alt="Post Image {{ $loop->index + 1 }}" style="max-height: 200px; object-fit: cover;">
              @endif
            @endforeach
          </div>
        </div>
      @endif

      <div class="card-footer d-flex justify-content-between align-items-center">
        <small class="text-muted">Posted on {{ $bookmark->post->created_at->format('F j, Y') }}</small>
        <div>
          <form action="{{ route('posts.like', $bookmark->post->id) }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" class="btn btn-like btn-no-bg btn-light btn-sm">
              @if($bookmark->post->userLikes->contains('user_id', auth()->id()))
                <i class="mdi mdi-cards-heart text-danger"></i>
              @else
                <i class="mdi mdi-cards-heart-outline"></i>
              @endif
              {{ $bookmark->post->userLikes->count() }}
            </button>
          </form>
          <button class="btn btn-comment btn-no-bg btn-light btn-sm"><i class="mdi mdi-chat-outline"></i> {{ $bookmark->post->comments }}</button>
          <form action="{{ route('bookmarks.store', $bookmark->post->id) }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" class="btn btn-bookmark btn-no-bg btn-light btn-sm">
              @if($bookmark->post->bookmarks->contains('user_id', auth()->id()))
                <i class="mdi mdi-bookmark text-primary"></i>
              @else
                <i class="mdi mdi-bookmark-outline"></i>
              @endif
            </button>
          </form>
          <button class="btn btn-no-bg btn-share btn-light btn-sm"><i class="mdi mdi-share-outline"></i></button>
        </div>
      </div>
    </div>
  @endforeach --}}
@endsection
