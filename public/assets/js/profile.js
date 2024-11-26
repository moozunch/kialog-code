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
