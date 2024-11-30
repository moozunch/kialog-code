// Buka modal saat gambar profil diklik
document.getElementById("profileImage").addEventListener("click", function () {
    const profileModal = document.getElementById("profileImageModal");
    profileModal.style.display = "flex"; // Tampilkan modal
});

// Tutup modal saat area buram di-klik
document.getElementById("profileImageModal").addEventListener("click", function (e) {
    if (e.target === this) {
        this.style.display = "none"; // Sembunyikan modal
    }
});

// Modal profile stats Section
// Follow button
const followButtons = document.querySelectorAll(".modal-button-followed");

followButtons.forEach((button) => {
    button.addEventListener("click", function () {
        if (this.classList.contains("followed")) {
            this.classList.remove("followed");
            this.textContent = "Follow";  // Tampilkan 'Follow' ketika kelas 'followed' dihapus
        } else {
            this.classList.add("followed");
            this.textContent = "Followed";  // Tampilkan 'Followed' ketika kelas 'followed' ditambahkan
        }
    });
});

// Post Section
// Comment Section
// Toggle Comment Section
function toggleCommentContainer(button) {
    let commentContainer = button.closest(".card-post").querySelector(".comment-container");
    
    // Ubah display dari none ke flex, atau sebaliknya
    commentContainer.style.display = commentContainer.style.display === "none" || commentContainer.style.display === "" 
        ? "flex" 
        : "none";
}



// document.querySelectorAll('.btn-comment').forEach(button => {
//     button.addEventListener('click', function () {
//         const target = document.querySelector(this.getAttribute('data-bs-target'));
//         target.classList.toggle('show');
//     });
// });
// // Add and Delete Comment
// document.querySelectorAll('.comment-form').forEach(form => {
//     form.addEventListener('submit', function (e) {
//         e.preventDefault();
        
//         const formData = new FormData(this);
//         const actionUrl = this.getAttribute('action');

//         fetch(actionUrl, {
//             method: 'POST',
//             body: formData,
//             headers: {
//                 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
//             }
//         })
//         .then(response => response.json())
//         .then(data => {
//             // Update komentar tanpa reload
//             if (data.success) {
//                 const commentsContainer = this.nextElementSibling;
//                 commentsContainer.innerHTML += data.commentHtml;
//                 this.reset();
//             }
//         })
//         .catch(error => console.error('Error:', error));
//     });
// });
