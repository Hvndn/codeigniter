<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatbot - CodeIgniter</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .chat-container {
            width: 400px;
            height: 600px;
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .chat-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
            text-align: center;
        }

        .chat-header h1 {
            font-size: 24px;
            margin-bottom: 5px;
        }

        .chat-header p {
            opacity: 0.9;
            font-size: 14px;
        }

        .chat-messages {
            flex: 1;
            padding: 20px;
            overflow-y: auto;
            background: #f8f9fa;
        }

        .message {
            margin-bottom: 15px;
            display: flex;
            align-items: flex-end;
        }

        .message.user {
            justify-content: flex-end;
        }

        .message.bot {
            justify-content: flex-start;
        }

        .message-content {
            max-width: 70%;
            padding: 12px 16px;
            border-radius: 18px;
            font-size: 14px;
            line-height: 1.4;
        }

        .message.user .message-content {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-bottom-right-radius: 5px;
        }

        .message.bot .message-content {
            background: white;
            color: #333;
            border: 1px solid #e1e5e9;
            border-bottom-left-radius: 5px;
        }

        .chat-input {
            padding: 20px;
            background: white;
            border-top: 1px solid #e1e5e9;
        }

        .input-group {
            display: flex;
            gap: 10px;
        }

        .chat-input input {
            flex: 1;
            padding: 12px 16px;
            border: 1px solid #e1e5e9;
            border-radius: 25px;
            outline: none;
            font-size: 14px;
        }

        .chat-input input:focus {
            border-color: #667eea;
        }

        .send-btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 25px;
            cursor: pointer;
            font-size: 14px;
            transition: transform 0.2s;
        }

        .send-btn:hover {
            transform: scale(1.05);
        }

        .send-btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        .typing-indicator {
            display: none;
            padding: 10px 16px;
            color: #666;
            font-style: italic;
            font-size: 14px;
        }

        .typing-indicator.show {
            display: block;
        }
    </style>
</head>
<body>
    <div class="chat-container">
        <div class="chat-header">
            <h1>🤖 Chatbot AI</h1>
            <p>Hỏi gì cũng được, tôi sẽ trả lời!</p>
        </div>
        
        <div class="chat-messages" id="chatMessages">
            <div class="message bot">
                <div class="message-content">
                    Xin chào! Tôi là chatbot AI. Bạn có thể hỏi tôi bất cứ điều gì. Tôi sẽ cố gắng trả lời một cách hữu ích nhất có thể.
                </div>
            </div>
        </div>
        
        <div class="typing-indicator" id="typingIndicator">
            Bot đang nhập...
        </div>
        
        <div class="chat-input">
            <div class="input-group">
                <input type="text" id="messageInput" placeholder="Nhập tin nhắn của bạn..." maxlength="500">
                <button class="send-btn" id="sendBtn" onclick="sendMessage()">Gửi</button>
            </div>
        </div>
    </div>

    <script>
        const messageInput = document.getElementById('messageInput');
        const chatMessages = document.getElementById('chatMessages');
        const sendBtn = document.getElementById('sendBtn');
        const typingIndicator = document.getElementById('typingIndicator');

        // Gửi tin nhắn khi nhấn Enter
        messageInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                sendMessage();
            }
        });

        // Hàm gửi tin nhắn
        function sendMessage() {
    const message = messageInput.value.trim();
    if (!message) return;

    // Thêm tin nhắn của user vào chat
    addMessage(message, 'user');
    messageInput.value = '';

    // Disable nút gửi và hiện typing indicator
    sendBtn.disabled = true;
    showTypingIndicator();

    // Lấy customer_id từ PHP (giả sử bạn có session hoặc biến)
    const customerId = <?php echo isset($_SESSION['customer_id']) ? $_SESSION['customer_id'] : 'null'; ?>; // Thay bằng cách lấy ID thực tế

    if (!customerId) {
        hideTypingIndicator();
        addMessage('Vui lòng đăng nhập để sử dụng chatbot.', 'bot');
        sendBtn.disabled = false;
        return;
    }

    // Gọi API chatbot với customer_id
    fetch('<?php echo base_url("index.php/chat/api_chat"); ?>', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ 
            customer_id: customerId,
            message: message 
        })
    })
    .then(response => response.json())
    .then(data => {
        hideTypingIndicator();
        addMessage(data.response || 'Xin lỗi, tôi không thể trả lời câu hỏi này.', 'bot');
    })
    .catch(error => {
        hideTypingIndicator();
        addMessage('Xin lỗi, đã xảy ra lỗi kết nối. Vui lòng thử lại.', 'bot');
        console.error('Error:', error);
    })
    .finally(() => {
        sendBtn.disabled = false;
    });
}


        // Thêm tin nhắn vào chat
        function addMessage(text, sender) {
            const messageDiv = document.createElement('div');
            messageDiv.className = `message ${sender}`;
            
            const contentDiv = document.createElement('div');
            contentDiv.className = 'message-content';
            contentDiv.textContent = text;
            
            messageDiv.appendChild(contentDiv);
            chatMessages.appendChild(messageDiv);
            
            // Scroll xuống cuối
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }

        // Hiện typing indicator
        function showTypingIndicator() {
            typingIndicator.classList.add('show');
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }

        // Ẩn typing indicator
        function hideTypingIndicator() {
            typingIndicator.classList.remove('show');
        }

        // Focus vào input khi load trang
        messageInput.focus();
    </script>
</body>
</html>
