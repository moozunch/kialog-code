@extends('layouts.contentNavbarLayout')

@section('vendor-style')
  <link rel="stylesheet" href="{{ asset('assets/css/profile.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/displayposts.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/button.css') }}">
@endsection

@section('profile-script')
  <script src="{{ asset('assets/js/profile.js') }}"></script>
@endsection

@section('title', 'Profile')

@section('content')

  <div class="container mt-4">
    <div class="card p-4 shadow">
      <header>
        <div class="profile-header d-flex align-items-center flex-wrap">
          <!-- Foto Profil dan Info -->
          <div class="profile-identitas d-flex align-items-center flex-wrap">
            <img id="profileImage" src="{{ $user->profile_image ? $user->profile_image : asset('assets/img/avatars/1.png') }}" alt="Profile Picture" class="profile-picture">
            <div class="profile-info">
              <h1>{{ $user->name }}</h1>
              <h2>{{ $user->username }}</h2>
            </div>
          </div>

           <!-- Modal untuk Foto Profil -->
           <div class="custom-modal-overlay" id="profileImageModal">
              <div class="custom-modal-content">
                  <img id="Modal-Profile-Image" src="{{ $user->profile_image ? $user->profile_image : asset('assets/img/avatars/1.png') }}" alt="Profile Picture" class="profile-large-image" />
              </div>
           </div>

          <!-- Profile Stats Section -->
          <div class="profile-stats d-flex">
            <div class="stat-container">
              <h6 class="post-count">{{ $posts->count() }}</h6>
              <p>Post</p>
            </div>
            <div class="stat-container" data-bs-toggle="modal" data-bs-target="#followersModal">
              <h6 class="followers-count">0</h6>
              <p>Followers</p>
            </div>
            <div class="stat-container" data-bs-toggle="modal" data-bs-target="#followingModal">
              <h6 class="following-count">0</h6>
              <p>Following</p>
            </div>
          </div>
        </div>

        <!-- Bio -->
        <p class="bio text-muted mt-2">{{ $user->bio }}</p>

        <!-- Chat Button -->
        @if(Route::currentRouteName() == 'profile.showOther')
          <div class="d-flex justify-content-end">
            <a href="{{ route('chat', ['user_id' => $user->id]) }}" class="btn btn-primary">Chat</a>
          </div>
        @endif
      </header>



      <hr />

      <!-- Post Section -->
      @foreach($posts as $post)
        <div class="card-post shadow-lg ">
          <div class="body-post card-body">
            <div class="row-post d-flex align-items-center">
              <div class="post-profile-picture item-row">
                <a href="{{ route('profile.show', ['user_id' => $post->user->id]) }}">
                  <img src="{{ $post->user->profile_image ? $post->user->profile_image : asset('assets/img/avatars/1.png') }}" alt="Profile Picture" class="rounded-circle" width="50px" height="50px">
                </a>
              </div>
              <div class="post-profile-info item-row">
                <h5 class="card-title">{{ $post->user->name }}</h5>
                <h6 class="card-title text-muted">{{ $post->user->username }}</h6>
              </div>
              <div class="tombol-delete item-row delete-button">
                <a class="btn" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" >
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

          <div class="card-footer d-flex justify-content-between align-items-center flex-wrap">
            <small class="text-muted">Posted on {{ $post->created_at->format('F j, Y') }}</small>
            <div class="interactive-button d-flex justify-content-end flex-nowrap">
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
  </div>

  <!-- Modal for Followers -->
  <div class="modal fade" id="followersModal" tabindex="-1" aria-labelledby="followersModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content d-flex">
        <div class="modal-header d-flex p-3 shadow">
          <h5 class="modal-title" id="followersModalLabel">Followers</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body d-flex">
          <!-- User 1 -->
          <div class="data-user d-flex align-items-center shadow">
            <img src="https://tse1.mm.bing.net/th?id=OIP.GHGGLYe7gDfZUzF_tElxiQHaHa&pid=Api&P=0&h=180" class="rounded-circle me-3" alt="Follower 1" />
            <div class="modal-profile-info">
              <h3>Display Name 1</h3>
              <h4>@username1</h4>
            </div>
              <button id="modal-followers-id" class="modal-button-delete btn ms-auto" onclick="toggleFollow()">Hapus</button>
            </div>
          <!-- User 2 -->
          <div class="data-user d-flex align-items-center mt-3">
            <img src="https://tse1.mm.bing.net/th?id=OIP.GHGGLYe7gDfZUzF_tElxiQHaHa&pid=Api&P=0&h=180" class="rounded-circle me-3" alt="Follower 1" />
            <div class="modal-profile-info">
              <h3>Display Name 1</h3>
              <h4>@username1</h4>
            </div>
            <button id="modal-follow-id" class="modal-button-follow btn ms-auto">Follow</button>
          </div>

        </div>
      </div>
    </div>
  </div>

  <!-- Modal for Following -->
  <div class="modal fade" id="followingModal" tabindex="-1" aria-labelledby="followingModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header p-3 shadow">
          <h5 class="modal-title" id="followingModalLabel">Following</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- User 1 -->
          <div class="data-user d-flex align-items-center mt-3">
            <img src="https://tse1.mm.bing.net/th?id=OIP.GHGGLYe7gDfZUzF_tElxiQHaHa&pid=Api&P=0&h=180" class="rounded-circle me-3" alt="Following 1" />
            <div class="modal-profile-info">
              <h3>Display Name 1</h3>
              <h4>@username1</h>
            </div>
            <button id="modal-followed-id" class="modal-button-followed btn ms-auto">Unfollow</button>
          </div>
          <!-- User 2 -->
          <div class="data-user d-flex align-items-center mt-3">
            <img src="https://tse1.mm.bing.net/th?id=OIP.GHGGLYe7gDfZUzF_tElxiQHaHa&pid=Api&P=0&h=180" class="rounded-circle me-3" alt="Following 1" />
            <div class="modal-profile-info">
              <h3>Display Name 1</h3>
              <h4>@username1</h>
            </div>
            <button id="modal-follow-id" class="modal-button-follow btn ms-auto">Followed</button>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
