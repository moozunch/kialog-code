<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@500;600;700&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="stylesheets/mobilequeries.css" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="style.css" />
        <title>Profil -</title>
    </head>
    <body>
        <!-- Nav Bar Section -->
        <section class="sectionNav">
            <div class="container">
                <nav class="navbar navbar-expand-lg navbar-light custom-navbar">
                    <a class="navbar-brand" href="#">
                        <img src="svg/kialogtext.svg" alt="Kialog Logo" height="30" />
                    </a>
<!-- Navbar Toggler -->
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
</button>

<!-- Navbar links -->
<div class="collapse navbar-collapse" id="navbarNav">
  <ul class="navbar-nav">
      <li class="nav-item">
          <a class="nav-link" href="#">About</a>
      </li>
      <li class="nav-item">
          <a class="nav-link" href="#">Edu Space</a>
      </li>
      <li class="nav-item">
          <a class="nav-link" href="#">Discussion</a>
      </li>
      <li class="nav-item-profil">
          <a class="nav-link" href="#">Profil</a>
      </li>
  </ul>
</div>
 <!-- Ikon Foto Profil di luar navbar-collapse -->
 <div class="profile-icon">
  <a class="nav-link" href="#">
      <img src="https://tse1.mm.bing.net/th?id=OIP.GHGGLYe7gDfZUzF_tElxiQHaHa&pid=Api&P=0&h=180" alt="Profile" class="profile-pic" />
  </a>
</div>
</nav>
</div>
</section>

<!-- Profile Section -->
<div class="container mt-4">
<div class="card p-4 shadow">
<header>
<div class="profile-header d-flex justify-content-between align-items-center">
  <!-- Foto Profil dan Info -->
  <div class="profile-identitas d-flex align-items-center flex-wrap">
      <img id="profileImage" src="https://tse1.mm.bing.net/th?id=OIP.GHGGLYe7gDfZUzF_tElxiQHaHa&pid=Api&P=0&h=180" alt="Foto Profil" class="rounded-circle profile-picture me-3" />
      <div class="profile-info">
        <h1>Username</h1>
        <h2>Display Name</h2>
    </div>
</div>

<!-- Modal untuk Foto Profil -->
<div class="custom-modal-overlay" id="profileImageModal">
    <div class="custom-modal-content">
        <img src="https://tse1.mm.bing.net/th?id=OIP.GHGGLYe7gDfZUzF_tElxiQHaHa&pid=Api&P=0&h=180" alt="Foto Profil Besar" class="profile-large-image" />
    </div>
</div>

<!-- Profile Stats Section -->
<div class="d-flex align-items-center flex-wrap">
    <div class="profile-stats">
        <!-- Kiriman Section -->
        <div class="stat-container">
            <h6 class="post-count">0</h6>
            <p>Kiriman</p>
        </div>

  <!-- Pengikut Section -->
  <div class="stat-container" data-bs-toggle="modal" data-bs-target="#followersModal">
    <h6 class="followers-count">0</h6>
    <p>Pengikut</p>
</div>

<!-- Mengikuti Section -->
<div class="stat-container" data-bs-toggle="modal" data-bs-target="#followingModal">
    <h6 class="following-count">0</h6>
    <p>Mengikuti</p>
</div>
</div>
</div>

<!-- Tombol Ikuti -->
<button class="btn btn-follow" id="follow-button">Ikuti</button>
</div>
     <!-- Modal for Followers -->
     <div class="modal fade" id="followersModal" tabindex="-1" aria-labelledby="followersModalLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header fixed-container p-3 shadow">
                  <h5 class="modal-title" id="followersModalLabel">Pengikut</h5>

                  <!-- Tombol Close Button -->
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                      <i class="bi bi-arrow-right"></i>
                  </button>
              </div>

              <!-- User 1 -->
              <div class="modal-body">
                  <div class="data-user d-flex align-items-center mb-3">
                      <img src="https://tse1.mm.bing.net/th?id=OIP.GHGGLYe7gDfZUzF_tElxiQHaHa&pid=Api&P=0&h=180" class="rounded-circle me-3" alt="Follower 1" />
                      <div class="modal-profile-info">
                        <h6>Display Name 1</h6>
                        <p>@username1</p>
                    </div>

                    <!-- Tombol Ikuti -->
                    <button id="modal-follow-id" class="modal-button-follow btn ms-auto">Ikuti</button>
                </div>
            </div>

            <!-- User 2 -->
            <div class="modal-body">
                <div class="data-user d-flex align-items-center mb-3">
                    <img src="https://tse1.mm.bing.net/th?id=OIP.GHGGLYe7gDfZUzF_tElxiQHaHa&pid=Api&P=0&h=180" class="rounded-circle me-3" alt="Follower 1" />

                    <div class="modal-profile-info">
                        <h6>Display Name 1</h6>
                        <p>@username1</p>
                    </div>
           <!-- Tombol Ikuti -->
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
      <div class="modal-header fixed-container p-3 shadow">
          <h5 class="modal-title" id="FollowingModalLabel">Mengikuti</h5>

          <!-- Tombol Close Button -->
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
              <i class="bi bi-arrow-right"></i>
          </button>
      </div>

  <!-- User 1 -->
  <div class="modal-body">
    <div class="data-user d-flex align-items-center mb-3">
        <img src="https://tse1.mm.bing.net/th?id=OIP.GHGGLYe7gDfZUzF_tElxiQHaHa&pid=Api&P=0&h=180" class="rounded-circle me-3" alt="Following 1" />

        <div class="modal-profile-info">
            <h6>Display Name 1</h6>
            <p>@username1</p>
        </div>

        <!-- Tombol Ikuti -->
        <button id="modal-follow-id" class="modal-button-follow btn ms-auto">Ikuti</button>
    </div>
</div>
 <!-- User 2 -->
 <div class="modal-body">
  <div class="data-user d-flex align-items-center mb-3">
      <img src="https://tse1.mm.bing.net/th?id=OIP.GHGGLYe7gDfZUzF_tElxiQHaHa&pid=Api&P=0&h=180" class="rounded-circle me-3" alt="Follower 1" />

      <div class="modal-profile-info">
          <h6>Display Name 1</h6>
          <p>@username1</p>
      </div>

      <!-- Tombol Ikuti -->
      <button id="modal-follow-id" class="modal-button-follow btn ms-auto">Ikuti</button>
  </div>
</div>
</div>
</div>
</div>
   <!-- Container Bio -->
   <p class="bio text-muted">Bio</p>
  </header>

  <hr />

  <!-- Post Section -->
  <section class="postSection">
      <div class="post-container">
          <!-- Post 1 -->
          <div class="post card p-3">
              <!-- Kontainer Konten -->
              <div class="content-container">
                  <img src="https://via.placeholder.com/300" alt="Gambar" class="content-image" />
                  <p class="content-text">Konten teks deskriptif atau pesan.</p>
              </div>

              <div class="d-flex justify-content-between align-items-center mt-3">
                  <div class="interactive-button">
     <!-- Like Button -->
     <button class="btn btn-sm btn-outline-secondary like-btn" onclick="toggleLike(this)">
      <i class="bi bi-hand-thumbs-up"></i>
  </button>
  <span class="like-count">0</span>

  <!-- Dislike Button -->
  <button class="btn btn-sm btn-outline-secondary dislike-btn" onclick="toggleDislike(this)">
      <i class="bi bi-hand-thumbs-down"></i>
  </button>
  <span class="dislike-count">0</span>

  <!-- Comment Button -->
  <button class="btn btn-sm btn-outline-secondary comment-btn" onclick="toggleCommentContainer(this)">
      <i class="bi bi-chat"></i>
  </button>
  <span class="comment-count">0</span>

   <!-- Bookmark Button -->
   <button class="btn btn-sm btn-outline-secondary bookmark-btn" onclick="toggleBookmark(this)">
    <i class="bi bi-bookmark"></i>
</button>
</div>
</div>

<!-- Comment Section -->
<div class="comment-container" style="display: none; width: 100%; margin-top: 10px">
<div class="profile-info">
<img src="https://via.placeholder.com/40" class="rounded-circle me-2" alt="User Profile" />
<h1>Username</h1>
</div>
<div class="comment-input d-flex align-items-start">
<textarea class="form-control" rows="2" placeholder="Tambahkan komentar..."></textarea>
<button class="btn btn-primary ms-2" onclick="addComment(this)">Kirim</button>
</div>
<div class="comments-list mt-3"></div>
</div>
</div>

<!-- Post 2 -->
<div class="post card p-3">
    <!-- Kontainer Konten -->
    <div class="content-container">
        <img src="https://via.placeholder.com/300" alt="Gambar" class="content-image" />
        <p class="content-text">Konten teks deskriptif atau pesan.</p>
    </div>

    <div class="d-flex justify-content-between align-items-center mt-3">
        <div class="interactive-button">
            <!-- Like Button -->
            <button class="btn btn-sm btn-outline-secondary like-btn" onclick="toggleLike(this)">
                <i class="bi bi-hand-thumbs-up"></i>
            </button>
            <span class="like-count">0</span>
 <!-- Dislike Button -->
 <button class="btn btn-sm btn-outline-secondary dislike-btn" onclick="toggleDislike(this)">
  <i class="bi bi-hand-thumbs-down"></i>
</button>
<span class="dislike-count">0</span>

<!-- Comment Button -->
<button class="btn btn-sm btn-outline-secondary comment-btn" onclick="toggleCommentContainer(this)">
  <i class="bi bi-chat"></i>
</button>
<span class="comment-count">0</span>
    <!-- Bookmark Button -->
    <button class="btn btn-sm btn-outline-secondary bookmark-btn" onclick="toggleBookmark(this)">
      <i class="bi bi-bookmark"></i>
  </button>
</div>
</div>

<!-- Comment Section -->
<div class="comment-container">
<div class="comment-input">
  <textarea class="form-control" rows="2" placeholder="Tambahkan komentar..."></textarea>
  <button class="btn custom-btn ms-2" onclick="addComment(this)">Kirim</button>
</div>
<div class="comments-list mt-3"></div>
</div>
</div>
</div>
</section>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- Bootstrap JS (required for modal) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="script.js"></script>
</body>
</html>
