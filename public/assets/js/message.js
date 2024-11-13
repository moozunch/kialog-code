document.getElementById('sendButton').addEventListener('click', function() {
    const message = document.getElementById('messageInput').value;
    if (message.trim() !== "") {
        console.log("Pesan dikirim: " + message);
        document.getElementById('messageInput').value = '';
    }
});