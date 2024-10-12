document.addEventListener('DOMContentLoaded', function() {
  // Show Sign-In Modal
  document.getElementById('signinbutton').addEventListener('click', function() {
      $('#signinModal').modal('show');
  });

  // Show Sign-Up Modal
  document.getElementById('signupbutton').addEventListener('click', function() {
      $('#signupModal').modal('show');
  });


});
