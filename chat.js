document.addEventListener("DOMContentLoaded", () => {
    const chatBox = document.getElementById("chat-box");
    const chatForm = document.getElementById("chat-form");
    const messageInput = document.getElementById("message");

    // Fetch messages and insert HTML directly
    const fetchMessages = () => {
        fetch("fetch_messages.php")
        .then(res => res.text())
        .then(html => {
            chatBox.innerHTML = html;
            chatBox.scrollTop = chatBox.scrollHeight; // scroll to bottom
        });
    };

    // Initial fetch
    fetchMessages();

    // Fetch messages every 2 seconds
    setInterval(fetchMessages, 2000);

    // Send message
    chatForm.addEventListener("submit", e => {
        e.preventDefault();
        const msg = messageInput.value.trim();
        if(msg.length === 0) return;

        fetch("send_message.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: `message=${encodeURIComponent(msg)}`
        })
        .then(() => {
            messageInput.value = "";
            fetchMessages();
        });
    });
});
