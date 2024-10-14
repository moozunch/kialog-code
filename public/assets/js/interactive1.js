document.addEventListener('DOMContentLoaded', function() {
  // Show Sign-In Modal
  document.getElementById('signinbutton').addEventListener('click', function() {
    $('#signinModal').modal('show');
  });

  // Show Sign-Up Modal
  document.getElementById('signupbutton').addEventListener('click', function() {
    $('#signupModal').modal('show');
  });

  var modals = document.querySelectorAll('.modal');

  modals.forEach(function(modal) {
    modal.addEventListener('show.bs.modal', function() {
      document.body.classList.add('no-scroll');
    });

    modal.addEventListener('hidden.bs.modal', function() {
      document.body.classList.remove('no-scroll');
    });
  });
});
