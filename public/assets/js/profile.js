// Profil Section
// Profil Section - Follow Button
document.getElementById("follow-button").addEventListener("click", function () {
  const followButton = this;
  const followersCount = document.querySelector(".followers-count");
  let followers = parseInt(followersCount.textContent);

  if (followButton.classList.toggle("active")) {
      followButton.textContent = "Mengikuti";
      followers++;
  } else {
      followButton.textContent = "Ikuti";
      followers--;
  }

  followersCount.textContent = followers;
});

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

// Profil Stats Modal
// Follow Button
// Profil Stats Modal - Banyak User
const followButtons = document.querySelectorAll(".modal-button-follow");

followButtons.forEach((button) => {
  button.addEventListener("click", function () {
      if (this.classList.toggle("mengikuti")) {
          this.textContent = "Mengikuti";
      } else {
          this.textContent = "Ikuti";
      }
  });
});

// Like Button
function toggleLike(btn) {
  let icon = btn.querySelector("i");
  let likeCount = btn.nextElementSibling;
  let dislikeBtn = btn.parentElement.querySelector(".dislike-btn i");

  if (icon.classList.toggle("active")) {
      likeCount.textContent = parseInt(likeCount.textContent) + 1;
      if (dislikeBtn.classList.contains("active")) {
          dislikeBtn.classList.remove("active");
          btn.parentElement.querySelector(".dislike-count").textContent--;
      }
  } else {
      likeCount.textContent = parseInt(likeCount.textContent) - 1;
  }
}

// Dislike Button
function toggleDislike(btn) {
  let icon = btn.querySelector("i");
  let dislikeCount = btn.nextElementSibling;
  let likeBtn = btn.parentElement.querySelector(".like-btn i");

  if (icon.classList.toggle("active")) {
      dislikeCount.textContent = parseInt(dislikeCount.textContent) + 1;
      if (likeBtn.classList.contains("active")) {
          likeBtn.classList.remove("active");
          btn.parentElement.querySelector(".like-count").textContent--;
      }
  } else {
      dislikeCount.textContent = parseInt(dislikeCount.textContent) - 1;
  }
}

// Toggle Comment Section
function toggleCommentContainer(btn) {
  let commentContainer = btn.closest(".d-flex").nextElementSibling;
  commentContainer.style.display = commentContainer.style.display === "none" ? "block" : "none";
}

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

// Delete Comment
function deleteComment(button) {
  const comment = button.closest(".comment");
  const commentContainer = button.closest(".comment-container");
  const commentCount = commentContainer.previousElementSibling.querySelector(".comment-count");

  comment.remove(); // Hapus komentar
  commentCount.textContent = parseInt(commentCount.textContent) - 1; // Update jumlah komentar
}


