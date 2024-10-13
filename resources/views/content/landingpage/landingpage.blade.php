<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ asset('assets/css/mobilequeires.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/style1.css') }}">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <title>Kialog</title>
</head>
<body>
<header>
  <div class="container">
    <nav class="navbar navbar-expand-lg navbar-light custom-navbar">
      <a class="navbar-brand" href="#">
        <img src="{{ asset('assets/svg/kialogtext.svg') }}" alt="Kialog Logo" height="30">
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
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
  <section class="section1">
    <div class="containersec1">
      <article class="content">
        <h1>The Hub For Lifelong Learners</h1>
        <img src="{{ asset('assets/img/landing-page/image_replacerhori.png') }}" class="imagehori" alt="image">
        <img src="{{ asset('assets/img/landing-page/image_replacervertical.png') }}" class="imagevertical" alt="image">
        <div class="textlanding">
          <p class="paraghraph1">Explore, discuss, and evolve your understanding in a community built for education.</p>
          <p class="paraghraph2">From Student For Student.</p>
        </div>
      </article>
    </div>
  </section>
  <section class="section2">
    <div class="containersec2">
      <article>
        <div class="image">
          <img src="{{ asset('assets/img/landing-page/image_replacerhori.png') }}" class="imagehori" alt="image">
        </div>
        <div class="text">
          <h2>About Us</h2>
          <p>We support a platform to empower  students through dynamic forum that fosters collaboration, brilliant ideas, and accelerates growth.</p>
        </div>
      </article>
    </div>
  </section>

  <section class="section3">
    <div class="containersec3">
      <h2>Our Values</h2>
      <img src="{{ asset('assets/svg/values.svg') }}" alt="Value" class="img-fluid">
    </div>
  </section>

  <section class="section4">
    <div class="containersec4">
      <h2>Meet The Team</h2>
      <p>The People Behind Kialog </p>
      <div class = rowloc>
        <div class="person">
          <img src="{{ asset('assets/img/landing-page/annisa.png') }}" alt="Annisa">
          <p><strong>Annisa</strong> Putri Aprilia</p>
        </div>
        <div class="person">
          <img src="{{ asset('assets/img/landing-page/sabrina.png') }}" alt="Sabrina">
          <p>Atikah <strong>Shabrina</strong> Siregar</p>
        </div>
      </div>
      <div class = rowloc>
        <div class="person">
          <img src="{{ asset('assets/img/landing-page/natasya.png') }}" alt="Natasya">
          <p><strong>Natasya</strong> Sabina Br. Ginting</p>
        </div>
        <div class="person">
          <img src="{{ asset('assets/img/landing-page/fathan.png') }}" alt="Alfathan">
          <p><strong>Alfathan</strong> Bagas Kurnia</p>
        </div>
      </div>
    </div>
  </section>
</main>

<footer>
</footer>

<!-- Sign-In Modal -->
<div class="modal fade" id="signinModal" tabindex="-1" aria-labelledby="signinModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="signinModalLabel">Sign In</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('signin') }}" method="POST">
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
            <input type="password" class="form-control" id="signupPassword" name="password" placeholder="Password" required>
          </div>
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
</body>
</html>
