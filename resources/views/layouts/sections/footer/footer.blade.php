<!-- Footer-->
<footer class="content-footer footer py-4 d-flex align-items-center" style="background-color: #bcccb1; height: 120px">
  <div class="{{ (!empty($containerNav) ? $containerNav : 'container-fluid') }}">
    <div class="container" >
      <div class="d-flex justify-content-between align-items-center">
        <div class="footer-nav">
          <a href="#" class="text-dark px-3">ABOUT US</a>
          <a href="#" class="text-dark px-3">DISCUSSION</a>
          <a href="#" class="text-dark px-3">CONTACTS</a>
        </div>
        <div class="footer-logo">
          <img src="{{ asset('assets/svg/logo.svg') }}" alt="Logo" style="height: 24px;">
        </div>
        <div class="footer-copy">
          <small class="text-muted">© 2024 kialog. All rights reserved</small>
        </div>
      </div>
    </div>
  </div>
</footer>
<!--/ Footer-->
