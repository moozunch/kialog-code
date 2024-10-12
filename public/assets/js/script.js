// const menu = document.getElementById('menu-checkbox');
// const sidebar = document.getElementsByClassName('sidebar')[0];

// // Add event listener for checkbox change
// checkbox.addEventListener('change', function() {
//     if (checkbox.checked) {
//         sidebar.classList.add('hide');
//     } else {
//         sidebar.classList.remove('hide');
//     }
// });

document.addEventListener("DOMContentLoaded", function() {
  const checkbox = document.getElementById('menu-checkbox');
  const sidebar = document.getElementsByClassName('sidebar')[0];

  // Add event listener for checkbox change
  checkbox.addEventListener('change', function() {
      if (checkbox.checked) {
          sidebar.classList.add('hide');
      } else {
          sidebar.classList.remove('hide');
      }
  });
});
