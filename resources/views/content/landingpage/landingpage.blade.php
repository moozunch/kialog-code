<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ asset('assets/css/mobilequeires.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/style1.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/headerblur.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/animation.css') }}">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Cedarville+Cursive&display=swap" rel="stylesheet">
  <script src="https://js.pusher.com/beams/1.0/push-notifications-cdn.js"></script>
  <title>Kialog</title>
</head>
<body>

<header>
  <div class="container">
    <nav class="navbar navbar-expand-lg navbar-light custom-navbar">
      <a class="navbar-brand" href="#">
        <img src="{{ asset('assets/svg/kialogtext.svg') }}" alt="Kialog Logo">
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#about">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#" id="signupbutton3">Discussion</a>
          </li>
        </ul>
        <div class="form-inline">
          <button class="btn btnijo" id="signinbutton">Sign-In</button>
          <button class="btn" id="signupbutton">Sign-Up</button>
        </div>
      </div>
    </nav>
  </div>
</header>

<main>
  {{--First Section--}}

  <div class="container py-5 transform-bottom">
    <div class="row align-items-center">
      <!-- Text Section -->
      <div class="col-lg-6 mb-4 mb-lg-0">
        <h1 class="display-5 fw-bold text-dark" style="font-weight: 600">
          Explore, discuss, and evolve your understanding in a community built for education.
        </h1>
        <p class="text-secondary mt-3">
          A place where knowledge meets collaboration. Share, learn, and grow together. <span style="color: #1b3e15">From Student For Student</span>
        </p>
        <div class="d-flex mt-4">
          <button id="signupbutton2" class="btn px-4 py-2" style="margin-right: 10px; border-radius: 12px; background-color: #2a6320; color: #fff; ">Get Started</button>
          {{--          <a href="#" class="btn btn-outline-secondary px-4 py-2" style="border-radius: 12px" >How it works</a>--}}
        </div>
      </div>

      <!-- Image Section -->
      <div class="col-lg-6 text-center">
        <div class="position-relative d-inline-block">
          <div class=" position-absolute top-0 start-0 w-100 h-100 rounded-3" style="z-index: -1; opacity: 0.1; "></div>
          <img src="{{ asset('assets/svg/illust.svg') }}" alt="illustration" class="img-fluid rounded">
        </div>
      </div>
    </div>
  </div>

  {{-- Second Section --}}
{{-- background-color: #2c6822;--}}
  <div class="container my-5 transform-bottom " id="about">
   <h2 style="font-weight: 600" class="text-center">Our Value</h2>
   <p class="text-muted text-center">The Value We Believe And Provide</p>
    <div class="row text-center align-items-center py-4" style="border-radius: 12px;">
      <!-- First Feature: Free Live Support -->
      <div class="col-md-4">
        <div class="d-flex flex-column align-items-center">
          <img src="{{ asset('assets/img/landing-page/collaborative.png') }}" alt="Collaborative" class="mb-3" style="width: 120px;">
          <h5 style="color: #2e2e2e">Collaborative</h5>
          <p style="color: #2e2e2e; max-width: 240px">We believe learning is stronger when done together.</p>
        </div>
      </div>

      <!-- Second Feature: Increased Security -->
      <div class="col-md-4 transform-bottom">
        <div class="d-flex flex-column align-items-center" style="border-left: 2px solid #2e2e2e; padding-left: 15px;">
          <img src="{{ asset('assets/img/landing-page/supportive.png') }}" alt="Supportive" class="mb-3" style="width: 120px;">
          <h5 style="color: #2e2e2e">Supportive</h5>
          <p style="color: #2e2e2e; max-width: 200px">Building a safe place and safe space for student.</p>
        </div>
      </div>

      <!-- Third Feature: Intuitive Interface -->
      <div class="col-md-4 transform-bottom">
        <div class="d-flex flex-column align-items-center" style="border-left: 2px solid #2e2e2e; padding-left: 15px;">
          <img src="{{ asset('assets/img/landing-page/innovative.png') }}" alt="Innovative" class="mb-3" style="width: 120px;">
          <h5 style="color: #2e2e2e">Innovative</h5>
          <p style="color: #2e2e2e; max-width: 200px">Continuously improving to provide the best tools for student success.</p>
        </div>
      </div>
    </div>
  </div>

  {{--Behind The Scene--}}
  <div class="container my-5 transform-bottom">
    <div class="text-center mb-5">
      <h2 style="font-weight: 600">Meet The Team</h2>
      <p class="text-muted">The People Behind Kialog</p>
    </div>

    <div class="row text-center justify-content-center">
      <!-- Row 1 -->
      <div class="col-md-6 mb-4 transform-bottom">
        <div class="d-flex flex-column align-items-center">
          <img src="{{ asset('assets/img/landing-page/annisa.png') }}" alt="Annisa Putri Aprilia" class="rounded-circle" style="width: 300px; height: 300px; object-fit: cover;">
          <h6 class="mt-3"><strong>Annisa</strong> Putri Aprilia</h6>
        </div>
      </div>
      <div class="col-md-6 mb-4 transform-bottom">
        <div class="d-flex flex-column align-items-center">
          <img src="{{ asset('assets/img/landing-page/sabrina.png') }}" alt="Atikah Shabrina Siregar" class="rounded-circle" style="width: 300px; height: 300px; object-fit: cover;">
          <h6 class="mt-3">Atikah <strong>Shabrina</strong> Siregar</h6>
        </div>
      </div>

      <!-- Row 2 -->
      <div class="col-md-6 mb-4 transform-bottom">
        <div class="d-flex flex-column align-items-center">
          <img src="{{ asset('assets/img/landing-page/natasya.png') }}" alt="Natasya Sabina Br. Ginting" class="rounded-circle" style="width: 300px; height: 300px; object-fit: cover;">
          <h6 class="mt-3"><strong>Natasya</strong> Sabina Br. Ginting</h6>
        </div>
      </div>
      <div class="col-md-6 mb-4 transform-bottom">
        <div class="d-flex flex-column align-items-center">
          <img src="{{ asset('assets/img/landing-page/fathan.png') }}" alt="Alfathan Bagas Kurnia" class="rounded-circle" style="width: 300px; height: 300px; object-fit: cover;">
          <h6 class="mt-3"><strong>Alfathan</strong> Bagas Kurnia</h6>
        </div>
      </div>
    </div>
  </div>

</main>

@include('layouts.sections.footer.footer')

<!-- Sign-In Modal -->
<div class="modal fade" id="signinModal" tabindex="-1" aria-labelledby="signinModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered-absolute">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="signinModalLabel">Sign In</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="signinError" class="alert alert-danger" style="display: none;"></div>
        <div id="signinMessage" class="alert alert-warning" style="display: none;"><p class="text-muted" ></p></div>
        <form id="signinForm">
          @csrf
          <div class="form-group">
            <label for="signinUsername">Username</label>
            <input type="text" class="form-control" id="signinUsername" name="username" placeholder="Enter username" required>
          </div>
          <div class="form-group">
            <label for="signinPassword">Password</label>
            <input type="password" class="form-control" id="signinPassword" name="password" placeholder="Password" required>
          </div>
          <button type="submit" class="btn btn-primary">Sign In</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Show Modal on Query -->
@if(request()->query('showLogin') === 'true')
<script>
  document.addEventListener('DOMContentLoaded', function() {
    $('#signinModal').modal('show');
  });
</script>
@endif

<script>
  document.getElementById('signupbutton2').addEventListener('click', function() {
    $('#signupModal').modal('show');
  });

  document.getElementById('signinbutton4').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent the default link behavior
    var signinMessage = document.getElementById('signinMessage');
    signinMessage.textContent = 'You need to sign in to proceed';
    signinMessage.style.display = 'block';
    $('#signinModal').modal('show');
  });

  document.getElementById('signupbutton3').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent the default link behavior
    var signinMessage = document.getElementById('signinMessage');
    signinMessage.textContent = 'You need to sign in to proceed';
    signinMessage.style.display = 'block';
    $('#signinModal').modal('show');
  });
</script>

<!-- Form Submission Script -->
<script>
  document.getElementById('signinForm').addEventListener('submit', function(event) {
    event.preventDefault();

    const form = event.target;
    const formData = new FormData(form);
    const errorDiv = document.getElementById('signinError');

    fetch('{{ route('signin') }}', {
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': formData.get('_token'),
        'Accept': 'application/json',
      },
      body: formData,
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        window.location.href = data.redirect;
      } else {
        errorDiv.textContent = data.message;
        errorDiv.style.display = 'block';
      }
    })
    .catch(error => {
      console.error('Error:', error);
      errorDiv.textContent = 'An unexpected error occurred. Please try again.';
      errorDiv.style.display = 'block';
    });
  });
</script>




<!-- Sign-Up Modal -->
<div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="signupModalLabel">Sign Up</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('signup') }}" method="POST">
          @csrf
          <div class="form-group">
            <label for="signupEmail">Email address</label>
            <input type="email" class="form-control" id="signupEmail" name="email" placeholder="Enter email" required>
          </div>
          <div class="form-group">
            <label for="signupUsername">Username</label>
            <input type="text" class="form-control" id="signupUsername" name="username" placeholder="Enter username" required>
          </div>
          <div class="form-group">
            <label for="signupPassword">Password</label>
            <input type="password" class="form-control" id="signupPassword" name="password" required placeholder="Password" oninput="validatePassword()">
            <small id="passwordWarning" class="text-danger" style="display: none;">Password must be at least 6 characters long.</small>
          </div>
          <script>
            function validatePassword() {
              const passwordField = document.getElementById('signupPassword');
              const warningMessage = document.getElementById('passwordWarning');

              if (passwordField.value.length < 6) {
                warningMessage.style.display = 'block';
              } else {
                warningMessage.style.display = 'none';
              }
            }
          </script>
          <button type="submit" class="btn btn-primary">Sign Up</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="{{ asset('assets/js/interactive1.js') }}"></script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const observer = new IntersectionObserver((entries, observer) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('show');
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.1 });

    document.querySelectorAll('.transform-bottom').forEach(item => {
      observer.observe(item);
    });
  });
</script>



</body>
</html>
