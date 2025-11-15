<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<style>
/* ====== NÚT CHAT ====== */
#chat-toggle-btn {
    position: fixed;
    bottom: 20px;
    right: 20px;
    background-color: #FE980F;
    color: white;
    width: 60px;
    height: 60px;
    border-radius: 50%;
    border: none;
    font-size: 24px;
    cursor: pointer;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    z-index: 9998;
    display: flex;
    justify-content: center;
    align-items: center;
}

/* ====== KHUNG CHAT ====== */
#chat-widget {
    position: fixed;
    bottom: 90px;
    right: 20px;
    width: 350px;
    max-width: 90vw;
    height: 500px;
    border: 1px solid #ddd;
    border-radius: 10px;
    background: white;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    display: none;
    flex-direction: column;
    z-index: 9999;
}

.chat-header {
    background: #FE980F;
    color: white;
    padding: 15px;
    font-weight: bold;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
}

.chat-box {
    flex-grow: 1;
    padding: 15px;
    overflow-y: auto;
    background: #f9f9f9;
}

/* ====== MESSAGE ====== */
.message {
    margin-bottom: 15px;
    display: flex;
    flex-direction: column;
}

.user-message {
    align-items: flex-end;
}

.bot-message {
    align-items: flex-start;
}

.message p {
    max-width: 85%;
    padding: 10px 15px;
    border-radius: 18px;
    margin: 0;
    line-height: 1.4;
}

.user-message p {
    background: #FE980F;
    color: white;
}

.bot-message p {
    background: #e9e9eb;
    color: #333;
}

/* INPUT */
.input-box {
    padding: 10px;
    border-top: 1px solid #ddd;
    display: flex;
    background: white;
}

#chat-input {
    flex-grow: 1;
    border-radius: 20px;
    padding: 10px 15px;
    border: 1px solid #ccc;
}

#send-btn {
    background: none;
    border: none;
    color: #FE980F;
    font-size: 22px;
    cursor: pointer;
}

/* LINK SẢN PHẨM */
.product-link-btn {
    background: white;
    color: #FE980F;
    border: 1px solid #FE980F;
    border-radius: 14px;
    padding: 6px 10px;
    text-decoration: none;
    margin-top: 6px;
    display: inline-block;
}

.product-link-btn:hover {
    background: #FE980F;
    color: white;
}

.typing-dot {
    animation: blink 1s infinite;
    font-size: 20px;
}

.typing-dot:nth-child(2) {
    animation-delay: 0.2s;
}

.typing-dot:nth-child(3) {
    animation-delay: 0.4s;
}

@keyframes blink {
    0% {
        opacity: 0.2;
    }

    50% {
        opacity: 1;
    }

    100% {
        opacity: 0.2;
    }
}
</style>

<button id="chat-toggle-btn">💬</button>

<div id="chat-widget">
    <div class="chat-header">
        ChatBot Hỗ trợ
        <span id="chat-close-btn" style="
        float:right;
        cursor:pointer;
        font-size:18px;
        font-weight:bold;
        color:white;
    ">✖</span>
    </div>

    <div class="chat-box" id="chat-box"></div>

    <div class="input-box">
        <input type="text" id="chat-input" placeholder="Nhập tin nhắn...">
        <button id="send-btn">➤</button>
    </div>
</div>

<input type="hidden" id="chat-customer-id" value="<?php echo $customer_id ?? 'null'; ?>">

<script>
const API_URL = "<?php echo rtrim(config_item('chatbot_url'), '/'); ?>/api/chat/";
const saveUrl = "<?php echo base_url('index.php/chat/save_history'); ?>";

const chatWidget = document.getElementById("chat-widget");
const toggleBtn = document.getElementById("chat-toggle-btn");
const chatBox = document.getElementById("chat-box");
const chatInput = document.getElementById("chat-input");
const sendBtn = document.getElementById("send-btn");

/* ====== SCROLL CHUẨN XUỐNG CUỐI ====== */
function scrollToBottom() {
    setTimeout(() => {
        chatBox.scrollTop = chatBox.scrollHeight;
    }, 30);
}

/* ====== MỞ / ĐÓNG CHAT ====== */
toggleBtn.addEventListener("click", () => {
    const isHidden = chatWidget.style.display === "none" || chatWidget.style.display === "";
    chatWidget.style.display = isHidden ? "flex" : "none";
    if (isHidden) setTimeout(scrollToBottom, 100);
});

/* ====== SEND MESSAGE ====== */
async function sendMessage() {
    const msg = chatInput.value.trim();
    if (!msg) return;

    appendUser(msg, true);
    chatInput.value = "";

    const customerId = parseInt(document.getElementById("chat-customer-id").value) || null;

    showBotTyping(); // ✔ bot bắt đầu gõ

    const res = await fetch(API_URL, {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            message: msg,
            customer_id: customerId
        })
    });

    const data = await res.json();
    const bot = data.response ?? {
        text: "Bot không phản hồi",
        type: "text"
    };



    // ❗ CHỈ trả lời sau 3 giây
    setTimeout(async () => {
        hideBotTyping(); // ✔ ẩn dấu ...
        appendBot(bot, true); // ✔ bot trả lời sau delay

        if (customerId) {
            await fetch(saveUrl, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    customer_id: customerId,
                    user_message: msg,
                    bot_response: bot.text
                })
            });
        }
    }, 3000);
}

function showBotTyping() {
    if (document.getElementById("typing-indicator")) return;

    const div = document.createElement("div");
    div.id = "typing-indicator";
    div.className = "message bot-message";

    div.innerHTML = `
        <p class="typing">
            <span class="typing-dot">.</span>
            <span class="typing-dot">.</span>
            <span class="typing-dot">.</span>
        </p>
    `;

    chatBox.appendChild(div);
    scrollToBottom();
}

function hideBotTyping() {
    const typingDiv = document.getElementById("typing-indicator");
    if (typingDiv) typingDiv.remove();
}


/* ====== APPEND USER MSG ====== */
function appendUser(text, save) {
    if (save) saveLocal({
        sender: "user",
        text
    });

    const div = document.createElement("div");
    div.className = "message user-message";
    div.innerHTML = `<p>${text}</p>`;
    chatBox.appendChild(div);

    scrollToBottom();
}

/* ====== APPEND BOT MSG ====== */
function appendBot(resp, save) {
    if (save) saveLocal({
        sender: "bot",
        text: resp.text,
        link: resp.link || null,
        type: resp.type || "text"
    });

    const div = document.createElement("div");
    div.className = "message bot-message";

    let html = `<p>${resp.text}</p>`;
    if (resp.type === "product" && resp.link) {
        html += `<a class="product-link-btn" href="${resp.link}">👉 Xem chi tiết sản phẩm</a>`;
    }

    div.innerHTML = html;
    chatBox.appendChild(div);

    scrollToBottom();
}

/* ====== LOCAL STORAGE ====== */
function saveLocal(obj) {
    let chat = JSON.parse(localStorage.getItem("chat_history") || "[]");
    chat.push(obj);
    localStorage.setItem("chat_history", JSON.stringify(chat));
}

function loadLocal() {
    chatBox.innerHTML = ""; // tránh trùng message

    let chat = JSON.parse(localStorage.getItem("chat_history") || "[]");

    chat.forEach(msg => {
        if (msg.sender === "user") appendUser(msg.text, false);
        else appendBot(msg, false);
    });

    scrollToBottom();
}

/* ====== KHỞI TẠO ====== */
window.addEventListener("load", loadLocal);
sendBtn.addEventListener("click", sendMessage);

chatInput.addEventListener("keypress", e => {
    if (e.key === "Enter") sendMessage();
});
// NÚT ĐÓNG CHAT (X)
const closeBtn = document.getElementById("chat-close-btn");

closeBtn.addEventListener("click", () => {
    chatWidget.style.display = "none";
});
</script>