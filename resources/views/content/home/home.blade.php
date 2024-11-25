@extends('layouts/contentNavbarLayout')

@section('title', 'Home')

@section('vendor-style')
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/displayposts.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/button.css') }}">
  {{-- <link rel="stylesheet" href="{{ asset('assets/css/home.css') }}"> --}}
@endsection

@section('vendor-script')
  <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/pusher-js@7.0.3/dist/web/pusher.min.js"></script>
@endsection

@section('page-script')
  <script src="{{ asset('assets/js/dashboards-analytics.js') }}"></script>
@endsection

@section('content')
  <script src="https://js.pusher.com/beams/1.0/push-notifications-cdn.js"></script>

<div class="container-fluid">
  <div class="row">
    <!-- Main Content Area -->
    <div class="col-lg-8 col-md-8 col-sm-12">
      <div class="above d-flex justify-content-between align-items-center mb-2">
        <div class="option d-flex">
          <button class="btn btn-style btn-outline-primary btn-sm">For You</button>
          <button class="btn btn-style btn-outline-secondary btn-sm ms-2">Mutual</button>
        </div>
        <div class="create-post-button d-block d-md-none">
          <button type="button" class="btn btn-style btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">
            <i class="mdi mdi-plus"></i>
          </button>
        </div>
      </div>

      <!-- Display Posts -->
      @foreach($posts as $post)
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

    <!-- Sidebar for Trending Topics and Create Post -->
    <div class="col-lg-4 col-md-4 d-none d-md-block">
      <div class="sticky-top mb-3" style="top: 20px; z-index: 1050;">
        <div class="card mb-2">
          <div class="card-body">
            <h5 class="card-title">Trending</h5>
            <ul class="list-group">
              @foreach($trendingTopics as $topic)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                  {{ $topic->title }}
                  <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#joinConfirmationModal" data-topic-id="{{ $topic->id }}">JOIN</button>
                </li>
              @endforeach
            </ul>
          </div>
        </div>
        <div class="create-post-container" style="position: sticky; top: 200px; z-index: 1049;">
          <div class="card mb-3">
            <div class="card-body">
              <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                @csrf
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
  </div>
</div>

{{-- join confirmation modal --}}
<div class="modal fade" id="joinConfirmationModal" tabindex="-1" aria-labelledby="joinConfirmationModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header border-bottom text-center p-3">
        <h5 class="modal-title fw-medium" id="joinConfirmationModalLabel">Join Community</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body border-bottom p-3">
        Are you sure you want to join this community?
      </div>
      <div class="modal-footer text-center p-3">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <form action="{{ route('topics.join', $topic->id) }}" method="POST">
          @csrf
          <button type="button" class="btn btn-primary" id="confirmJoinButton">Yes, Join</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal for Creating a Post -->
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
            <label for="post-images" class="col-form-label">Upload Images:</label>
            <input type="file" class="form-control" id="post-images" name="images[]" multiple accept="image/png, image/jpeg">
            <div id="image-preview" class="d-flex flex-wrap mt-2"></div> <!-- Preview container -->
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
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Post</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

{{-- Modal for report post --}}
<div class="modal fade" id="reportModal" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="reportModalLabel">Report Post</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ route('posts.report') }}">
          @csrf
          <input type="hidden" name="post_id" id="report-post-id">
          <div class="mb-3">
            <label for="report-reason" class="col-form-label">Reason:</label>
            <textarea class="form-control" id="report-reason" name="reason" placeholder="Describe the reason for reporting this post"></textarea>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Submit Report</button>
          </div>
        </form>
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

  document.addEventListener('DOMContentLoaded', function () {
    var joinConfirmationModal = document.getElementById('joinConfirmationModal');
    var confirmJoinButton = document.getElementById('confirmJoinButton');
    var topicId;

    joinConfirmationModal.addEventListener('show.bs.modal', function (event) {
      var button = event.relatedTarget; // Button that triggered the modal
      topicId = button.getAttribute('data-topic-id'); // Extract info from data-* attributes
    });

    confirmJoinButton.addEventListener('click', function () {
      var form = document.createElement('form');
      form.method = 'POST';
      form.action = '/topics/' + topicId + '/join';
      var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
      var csrfInput = document.createElement('input');
      csrfInput.type = 'hidden';
      csrfInput.name = '_token';
      csrfInput.value = csrfToken;
      form.appendChild(csrfInput);
      document.body.appendChild(form);
      form.submit();
    });

    var reportModal = document.getElementById('reportModal');
    reportModal.addEventListener('show.bs.modal', function (event) {
      var button = event.relatedTarget;
      var postId = button.getAttribute('data-post-id');
      var modal = this;
      modal.querySelector('#report-post-id').value = postId;
    });
  });
</script>

{{--search--}}
<script>
  document.getElementById('search-bar').addEventListener('input', function(event) {
    const query = event.target.value;

    if (query.length > 2) {
      fetch(`/search-posts?query=${query}`)
        .then(response => response.json())
        .then(posts => {
          const postsContainer = document.querySelector('.col-lg-8');
          postsContainer.innerHTML = '';

          posts.forEach(post => {
            const postHtml = `
              <div class="card mt-2">
                <div class="card-body">
                  <div class="row mb-2 align-items-center">
                    <div class="col-auto">
                      <a href="/profile/${post.user.username}">
                        <img src="${post.user.profile_image || '/assets/img/avatars/1.png'}" alt="Profile Picture" class="rounded-circle" width="50px" height="50px">
                      </a>
                    </div>
                    <div class="col">
                      <h5 class="card-title">${post.user.name}</h5>
                      <h6 class="card-title text-muted">${post.user.username}</h6>
                    </div>
                  </div>
                  <p class="card-text">${post.message}</p>
                </div>
              </div>
            `;
            postsContainer.innerHTML += postHtml;
          });
        })
        .catch(error => console.error('Error fetching search results:', error));
    } else if (query.length === 0) {
      fetch('/all-posts')
        .then(response => response.json())
        .then(posts => {
          const postsContainer = document.querySelector('.col-lg-8');
          postsContainer.innerHTML = '';

          posts.forEach(post => {
            const postHtml = `
              <div class="card mt-2">
                <div class="card-body">
                  <div class="row mb-2 align-items-center">
                    <div class="col-auto">
                      <a href="/profile/${post.user.username}">
                        <img src="${post.user.profile_image || '/assets/img/avatars/1.png'}" alt="Profile Picture" class="rounded-circle" width="50px" height="50px">
                      </a>
                    </div>
                    <div class="col">
                      <h5 class="card-title">${post.user.name}</h5>
                      <h6 class="card-title text-muted">${post.user.username}</h6>
                    </div>
                  </div>
                  <p class="card-text">${post.message}</p>
                </div>
              </div>
            `;
            postsContainer.innerHTML += postHtml;
          });
        })
        .catch(error => console.error('Error fetching posts:', error));
    }
  });
</script>
@endsection
