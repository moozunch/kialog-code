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
          <div class="d-flex justify-content-between align-items-center">
              <h1>{{ $topic->title }}</h1>
              @if($topic->users->contains(auth()->id()))
              <form action="{{ route('topics.quit', $topic->id) }}" method="POST" style="display: inline;">
                  @csrf
                  @method('DELETE')
                  <button type="submit" style="border: none; background: none; padding: 0;" title="Quit">
                      <i class="mdi mdi-exit-to-app" style="font-size: 24px"></i>
                  </button>
              </form>
              @endif
          </div>
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
                        <button type="button" class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#deleteConfirmationModal" data-post-id="{{ $post->id }}">
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
              <button class="btn btn-no-bg btn-share btn-light btn-sm mx-1"  data-bs-toggle="modal" data-bs-target="#comingSoonModal"><i class="mdi mdi-share-outline"></i></button>
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
                <h5 class="card-title">Recommendation</h5>
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
</div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteConfirmationModalLabel">Confirm Deletion</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this post?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-danger" id="confirmDeleteButton">Yes, Delete</button>
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
        <form method="POST" action="https://formspree.io/f/xrbgoanp">
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

<!-- Coming Soon Modal -->
<div class="modal fade" id="comingSoonModal" tabindex="-1" aria-labelledby="comingSoonModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="comingSoonModalLabel">Coming Soon</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        This feature is coming soon. Stay tuned!
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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

<script>
  document.addEventListener('DOMContentLoaded', function () {
    var deleteConfirmationModal = document.getElementById('deleteConfirmationModal');
    var confirmDeleteButton = document.getElementById('confirmDeleteButton');
    var formToSubmit;

    deleteConfirmationModal.addEventListener('show.bs.modal', function (event) {
      var button = event.relatedTarget; // Button that triggered the modal
      var postId = button.getAttribute('data-post-id'); // Extract info from data-* attributes
      formToSubmit = button.closest('form'); // Get the form to submit
    });

    confirmDeleteButton.addEventListener('click', function () {
      if (formToSubmit) {
        formToSubmit.submit();
      }
    });
  });
</script>
@endsection
