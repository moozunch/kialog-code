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
// Comment Sextion
// Add Comment
// Add Comment
function addComment(button) {
    const commentContainer = button.closest(".comment-container");
    const textarea = commentContainer.querySelector("textarea");
    const commentList = commentContainer.querySelector(".comments-list");

    if (textarea.value.trim() !== "") {
        const commentHTML = `
            <div class="comment shadow-sm">
                <div class="profile-info">
                    <img src="https://via.placeholder.com/40" alt="User Profile">
                    <h1>Username</h1>
                </div>
                <div class="content">
                    <p>${textarea.value}</p>
                </div>
                <button class="btn btn-sm btn-danger" onclick="deleteComment(this.closest('.comment'))">Hapus</button>
            </div>
        `;
        commentList.insertAdjacentHTML("beforeend", commentHTML);
        textarea.value = "";
    }
}
