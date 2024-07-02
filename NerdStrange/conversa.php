<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Room</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>
<body>
    <div class="chat-container">
        <div class="header">
            <h2><i class="fas fa-comments"></i> Chat Room</h2>
        </div>
        <div class="user-info">
            <input type="text" id="username" placeholder="Enter your username" required>
        </div>
        <div class="main-content">
            <div class="users-list" id="users-list">
                <h3>Active Users</h3>
                <!-- List of active users will appear here -->
            </div>
            <div class="chat-box" id="chat-box">
                <!-- Messages will appear here -->
            </div>
            <div class="private-chat-box" id="private-chat-box" style="display: none;">
                <!-- Private messages will appear here -->
            </div>
        </div>
        <form id="chat-form">
            <input type="text" id="message" placeholder="Type a message" required>
            <select id="message-type">
                <option value="public">Public</option>
                <option value="private">Private</option>
            </select>
            <button type="submit"><i class="fas fa-paper-plane"></i> Send</button>
        </form>
        <div class="footer">
            <p>Chat Room © 2024</p>
        </div>
    </div>
    <script>
        let currentRecipient = null;

        document.getElementById('chat-form').addEventListener('submit', function(e) {
            e.preventDefault();
            const username = document.getElementById('username').value;
            const message = document.getElementById('message').value;
            const messageType = document.getElementById('message-type').value;

            if (!username) {
                alert('Please enter a username.');
                return;
            }

            if (messageType === 'private' && !currentRecipient) {
                alert('Please select a user to send a private message.');
                return;
            }

            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'chat.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (this.status === 200) {
                    document.getElementById('message').value = '';
                    loadMessages();
                }
            };
            const data = messageType === 'private'
                ? `username=${username}&message=${message}&recipient=${currentRecipient}`
                : `username=${username}&message=${message}`;
            xhr.send(data);
        });

        function loadMessages() {
            const xhr = new XMLHttpRequest();
            xhr.open('GET', 'chat.php', true);
            xhr.onload = function() {
                if (this.status === 200) {
                    document.getElementById('chat-box').innerHTML = this.responseText;
                }
            };
            xhr.send();
        }

        function loadUsers() {
            const xhr = new XMLHttpRequest();
            xhr.open('GET', 'users.php', true);
            xhr.onload = function() {
                if (this.status === 200) {
                    document.getElementById('users-list').innerHTML = this.responseText;
                    attachUserClickHandlers();
                }
            };
            xhr.send();
        }

        function attachUserClickHandlers() {
            const users = document.querySelectorAll('#users-list div');
            users.forEach(user => {
                user.addEventListener('click', function() {
                    currentRecipient = this.dataset.username;
                    document.getElementById('private-chat-box').style.display = 'block';
                    loadPrivateMessages();
                });
            });
        }

        function loadPrivateMessages() {
            const xhr = new XMLHttpRequest();
            xhr.open('GET', `private_chat.php?recipient=${currentRecipient}`, true);
            xhr.onload = function() {
                if (this.status === 200) {
                    document.getElementById('private-chat-box').innerHTML = this.responseText;
                }
            };
            xhr.send();
        }

        setInterval(loadMessages, 1000);
        setInterval(loadUsers, 5000);
    </script>
</body>
</html>
