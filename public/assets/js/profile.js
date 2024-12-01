// Profil Section
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

// Profil Section - Follow Button
document.getElementById("follow-button").addEventListener("click", function () {
    const followButton = this;
    const followersCount = document.querySelector(".followers-count");
    let followers = parseInt(followersCount.textContent);

    if (followButton.classList.toggle("active")) {
        followButton.textContent = "FOLLOWED";
        followers++;
    } else {
        followButton.textContent = "FOLLOW";
        followers--;
    }

    followersCount.textContent = followers;
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
