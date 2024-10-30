@extends('layouts/contentNavbarLayout')

@section('vendor-style')
  <link rel="stylesheet" href="{{ asset('assets/css/profile.css') }}" />
@endsection

@section('profile-script')
  <script src="{{asset('assets/js/profile.js')}}"></script>
@endsection

@section('title', 'Profile')

@section('content')

<div class="container mt-4">
  <div class="card p-4 shadow">
    <header>
      <div class="profile-header d-flex justify-content-between align-items-center">
        <!-- Foto Profil dan Info -->
        <div class="profile-identitas d-flex align-items-center flex-wrap">
          <img id="profileImage" src="https://tse1.mm.bing.net/th?id=OIP.GHGGLYe7gDfZUzF_tElxiQHaHa&pid=Api&P=0&h=180" alt="Foto Profil" class="rounded-circle profile-picture me-3" />
          <div class="profile-info">
            <h1>Display Name</h1>
            <h2>Username</h2>
          </div>
        </div>

        <!-- Profile Stats Section -->
        <div class="d-flex align-items-center flex-wrap">
          <div class="profile-stats">
            <div class="stat-container">
              <h6 class="post-count">0</h6>
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

        <!-- Tombol Ikuti -->
        <button class="btn btn-follow" id="follow-button">Follow</button>
      </div>
      <!-- Bio -->
      <p class="bio text-muted mt-2">Bio</p>
    </header>

    <hr />

    <!-- Post Section -->
    <section class="postSection">
      <div class="post-container">
        <!-- Post 1 -->
        <div class="post card p-3">
          <div class="content-container">
            <img src="https://via.placeholder.com/300" alt="Gambar" class="content-image" />
            <p class="content-text">Konten teks deskriptif atau pesan.</p>
          </div>
          <div class="d-flex justify-content-between align-items-center mt-3">
            <div class="interactive-button">
              <!-- Add interactive buttons here (like, comment, etc.) -->
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>

<!-- Modal for Followers -->
<div class="modal fade" id="followersModal" tabindex="-1" aria-labelledby="followersModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header p-3 shadow">
        <h5 class="modal-title" id="followersModalLabel">Followers</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- User 1 -->
        <div class="data-user d-flex align-items-center mb-3">
          <img src="https://tse1.mm.bing.net/th?id=OIP.GHGGLYe7gDfZUzF_tElxiQHaHa&pid=Api&P=0&h=180" class="rounded-circle me-3" alt="Follower 1" />
          <div class="modal-profile-info">
            <h6>Display Name 1</h6>
            <p>@username1</p>
          </div>
          <button id="modal-follow-id" class="modal-button-follow btn ms-auto">Ikuti</button>
        </div>
        <!-- User 2 -->
        <div class="data-user d-flex align-items-center mb-3">
          <img src="https://tse1.mm.bing.net/th?id=OIP.GHGGLYe7gDfZUzF_tElxiQHaHa&pid=Api&P=0&h=180" class="rounded-circle me-3" alt="Follower 1" />
          <div class="modal-profile-info">
            <h6>Display Name 2</h6>
            <p>@username2</p>
          </div>
          <button id="modal-follow-id" class="modal-button-follow btn ms-auto">Ikuti</button>
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
        <h5 class="modal-title" id="followingModalLabel">Mengikuti</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- User 1 -->
        <div class="data-user d-flex align-items-center mb-3">
          <img src="https://tse1.mm.bing.net/th?id=OIP.GHGGLYe7gDfZUzF_tElxiQHaHa&pid=Api&P=0&h=180" class="rounded-circle me-3" alt="Following 1" />
          <div class="modal-profile-info">
            <h6>Display Name 1</h6>
            <p>@username1</p>
          </div>
          <button id="modal-follow-id" class="modal-button-follow btn ms-auto">Ikuti</button>
        </div>
        <!-- User 2 -->
        <div class="data-user d-flex align-items-center mb-3">
          <img src="https://tse1.mm.bing.net/th?id=OIP.GHGGLYe7gDfZUzF_tElxiQHaHa&pid=Api&P=0&h=180" class="rounded-circle me-3" alt="Following 2" />
          <div class="modal-profile-info">
            <h6>Display Name 2</h6>
            <p>@username2</p>
          </div>
          <button id="modal-follow-id" class="modal-button-follow btn ms-auto">Ikuti</button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@endsection
