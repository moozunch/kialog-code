@extends('layouts/contentNavbarLayout')

@section('title', $topic->title)

@section('vendor-style')
<link rel="stylesheet" href="{{ asset('assets/css/displayposts.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/button.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="row">
        <!-- Main Content Area -->
        <div class="col-lg-8 col-md-8 col-sm-12">
            <h1>{{ $topic->title }}</h1>
            <p>{{ $topic->description }}</p>

            <h2>Topic Posts</h2>
            @foreach($topic->posts as $post)
            <div class="card mt-2">
              <div class="card-body">
                <div class="row mb-2 align-items-center">
                  <div class="col-auto">
                    <a href="{{ route('profile.showOther', ['username' => $post->user->username]) }}">
                      <img src="{{ $post->user->profile_image ?? asset('assets/img/avatars/1.png') }}" alt="Profile Picture" class="rounded-circle" width="50px" height="50px" id="profileImage">
                    </a>
                  </div>
                  <div class="col">
                    <h5 class="card-title">{{ $post->user->name }}</h5>
                    <h6 class="card-title text-muted">{{ $post->user->username }}</h6>
                  </div>
                  <div class="col-auto ml-auto delete-button">
                    <a class="btn" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="mdi mdi-dots-horizontal"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                      @if(auth()->id() === $post->user_id)
                      <li>
                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display: inline;">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="dropdown-item text-danger">
                            <i class="mdi mdi-trash-can-outline me-2"></i> Delete
                          </button>
                        </form>
                      </li>
                      @else
                      <li>
                        <a class="dropdown-item text-warning" href="#" data-bs-toggle="modal" data-bs-target="#reportModal" data-post-id="{{ $post->id }}">
                          <i class="mdi mdi-account-alert-outline me-2"></i> Report
                        </a>
                      </li>
                      <li>
                        <form action="{{ route('blocks.store') }}" method="POST" style="display: inline;">
                          @csrf
                          <input type="hidden" name="blocked_user_id" value="{{ $post->user->id }}">
                          <button type="submit" class="dropdown-item text-danger">
                            <i class="mdi mdi-block-helper me-2"></i> Block
                          </button>
                        </form>
                      </li>
                    @endif
                    </ul>
                  </div>
                </div>
                <p class="card-text">{{ $post->message }}</p>
              </div>

              @if($post->images)
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
                <small class="text-muted">Posted on {{ $post->created_at->format('F j, Y') }}</small>
                <div class="d-flex justify-content-end flex-nowrap">
                  <form action="{{ route('posts.like', $post->id) }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-like btn-no-bg btn-light btn-sm mx-1">
                      @if($post->userLikes->contains('user_id', auth()->id()))
                        <i class="mdi mdi-cards-heart text-danger"></i>
                      @else
                        <i class="mdi mdi-cards-heart-outline"></i>
                      @endif
                      {{ $post->userLikes->count() }}
                    </button>
                  </form>
                  <button class="btn btn-comment btn-no-bg btn-light btn-sm mx-1"><i class="mdi mdi-chat-outline"></i> {{ $post->comments }}</button>
                  <form action="{{ route('bookmarks.store', $post->id) }}" method="POST" style="display: inline;">
                    @csrf
                    <input type="hidden" name="topic_id" value="{{ $topic->id }}">
                    <button type="submit" class="btn btn-bookmark btn-no-bg btn-light btn-sm mx-1">
                        @if($post->bookmarks->contains('user_id', auth()->id()))
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
        </div>

        <!-- Sidebar for Create Post -->
        <div class="col-lg-4 col-md-4 d-none d-md-block">
            <div class="card mb-3">
                <div class="card-body">
                    <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="topic_id" value="{{ $topic->id }}">
                        <div class="mb-3">
                            <label for="message" class="form-label">What's on your mind?</label>
                            <textarea class="form-control" id="message" name="message" rows="3" placeholder="Write something..."></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="post-images" class="form-label">Upload Image (optional)</label>
                            <input type="file" class="form-control" id="post-images" name="images[]" multiple accept="image/png, image/jpeg">
                            <div id="image-preview" class="d-flex flex-wrap mt-2"></div> <!-- Preview container -->
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Post</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('post-images').addEventListener('change', function(event) {
        const previewContainer = document.getElementById('image-preview');
        previewContainer.innerHTML = ''; // Clear previous previews
        const files = event.target.files;
        for (const file of files) {
            const img = document.createElement('img');
            img.src = URL.createObjectURL(file);
            img.classList.add('img-thumbnail', 'm-2');
            img.style.maxHeight = '150px';
            previewContainer.appendChild(img);
        }
    });
</script>
@endsection
