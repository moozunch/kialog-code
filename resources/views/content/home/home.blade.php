@extends('layouts/contentNavbarLayout')

@section('title', 'Home')

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
<div class="container-fluid">
  <div class="row">
    <!-- Main Content Area -->
    <div class="col-lg-8 col-md-8 col-sm-12">
      <div class="above d-flex justify-content-between">
        <div class="option d-flex mb-2">
          <button class="btn btn-style btn-outline-primary btn-sm">For You</button>
          <button class="btn btn-style btn-outline-secondary btn-sm ms-2">Mutual</button>
        </div>
        <div class="create-post">
          {{-- <button type="button" class="btn btn-style btn-primary btn-m" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">NEW POST</button> --}}
          <!-- Modal -->
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

  <!-- Display Posts -->

  @foreach($posts as $post)
    <div class="card mt-2">
      <div class="card-body">
        <div class="row mb-2 align-items-center">
          <div class="col-1">
            <a href="{{ route('profile.show', ['id' => $post->user->id]) }}">
              <img src="{{ $post->user->profile_image ? $post->user->profile_image : asset('assets/img/avatars/1.png') }}"
                   alt="Profile Picture of {{ $post->user->name }}" class="rounded-circle profile-image" width="50px">
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
              <li>
                <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display: inline;">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="dropdown-item text-danger">
                    <i class="mdi mdi-trash-can-outline me-2"></i> Delete
                  </button>
                </form>
              </li>
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
                  @if($post->userLikes && !$post->userLikes->isEmpty())
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
                  @if($post->bookmarks && !$post->bookmarks->isEmpty())
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

    <!-- Sidebar Kanan -->
    <aside class="col-lg-4 col-md-4 d-none d-md-block">
      {{-- Card for Trending --}}
      <div class=" sticky-top mb-3" style="top: 20px; z-index: 1050;">
        <div class="card mb-2">
          <div class="card-body">
            <h5 class="card-title">Trending</h5>
            <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    #Compscie '23
                    <button class="btn btn-primary btn-sm" onclick="joinCommunity('#Compscie23')">Join</button>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    #TI '23
                    <button class="btn btn-primary btn-sm" onclick="joinCommunity('#TI23')">Join</button>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    #KOM C '23
                    <button class="btn btn-primary btn-sm" onclick="joinCommunity('#KOMC23')">Join</button>
                </li>
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

      {{-- Container for Create Post Card --}}
      {{-- <div class="create-post-container" style="position: sticky; top: 200px; z-index: 1049;">
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
      </div> --}}
  </aside>

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
  </div>
</div>
@endsection
