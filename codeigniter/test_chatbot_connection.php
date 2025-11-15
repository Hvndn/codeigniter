<?php
/**
 * Script test kết nối chatbot
 * Chạy file này để kiểm tra kết nối giữa CodeIgniter và Django chatbot
 */

echo "<h1>🤖 Test Kết Nối Chatbot</h1>";
echo "<hr>";

// Test 1: Kiểm tra Django server có chạy không
echo "<h2>1. Kiểm tra Django Server</h2>";
$django_url = 'http://localhost:8888/api';
$test_message = "Xin chào";

$data = array('msg' => $test_message);
$json_data = json_encode($data);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $django_url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Content-Length: ' . strlen($json_data)
));
curl_setopt($ch, CURLOPT_TIMEOUT, 10);

$response = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$curl_error = curl_error($ch);
curl_close($ch);

if ($http_code == 200 && $response) {
    echo "✅ <strong>Django Server: HOẠT ĐỘNG</strong><br>";
    echo "📡 Response Code: " . $http_code . "<br>";
    
    $result = json_decode($response, true);
    if ($result && isset($result['res'])) {
        echo "🤖 Chatbot Response: " . htmlspecialchars($result['res']) . "<br>";
    } else {
        echo "⚠️ Response format không đúng: " . htmlspecialchars($response) . "<br>";
    }
} else {
    echo "❌ <strong>Django Server: KHÔNG KẾT NỐI ĐƯỢC</strong><br>";
    echo "📡 Response Code: " . $http_code . "<br>";
    if ($curl_error) {
        echo "🔍 Error: " . $curl_error . "<br>";
    }
    echo "💡 Hãy kiểm tra Django server có chạy trên port 8888 không<br>";
}

echo "<br>";

// Test 2: Kiểm tra CodeIgniter API
echo "<h2>2. Kiểm tra CodeIgniter API</h2>";
$codeigniter_url = 'http://localhost:8000/index.php/chat/api_chat';

$ch2 = curl_init();
curl_setopt($ch2, CURLOPT_URL, $codeigniter_url);
curl_setopt($ch2, CURLOPT_POST, true);
curl_setopt($ch2, CURLOPT_POSTFIELDS, json_encode(array('message' => $test_message)));
curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch2, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json'
));
curl_setopt($ch2, CURLOPT_TIMEOUT, 15);

$response2 = curl_exec($ch2);
$http_code2 = curl_getinfo($ch2, CURLINFO_HTTP_CODE);
$curl_error2 = curl_error($ch2);
curl_close($ch2);

if ($http_code2 == 200 && $response2) {
    echo "✅ <strong>CodeIgniter API: HOẠT ĐỘNG</strong><br>";
    echo "📡 Response Code: " . $http_code2 . "<br>";
    
    $result2 = json_decode($response2, true);
    if ($result2 && isset($result2['response'])) {
        echo "🤖 Final Response: " . htmlspecialchars($result2['response']) . "<br>";
    } else {
        echo "⚠️ Response format không đúng: " . htmlspecialchars($response2) . "<br>";
    }
} else {
    echo "❌ <strong>CodeIgniter API: KHÔNG KẾT NỐI ĐƯỢC</strong><br>";
    echo "📡 Response Code: " . $http_code2 . "<br>";
    if ($curl_error2) {
        echo "🔍 Error: " . $curl_error2 . "<br>";
    }
    echo "💡 Hãy kiểm tra XAMPP Apache có chạy không<br>";
}

echo "<br>";

// Test 3: Tổng kết
echo "<h2>3. Tổng Kết</h2>";
if ($http_code == 200 && $http_code2 == 200) {
    echo "🎉 <strong>KẾT NỐI THÀNH CÔNG!</strong><br>";
    echo "✅ Django Chatbot: Hoạt động<br>";
    echo "✅ CodeIgniter API: Hoạt động<br>";
    echo "✅ Tích hợp: Thành công<br>";
    echo "<br>";
    echo "🚀 <a href='http://localhost/codeigniter/chat' target='_blank'>Mở giao diện chat</a><br>";
} else {
    echo "⚠️ <strong>CẦN KIỂM TRA LẠI</strong><br>";
    echo "❌ Có vấn đề với kết nối<br>";
    echo "<br>";
    echo "🔧 <strong>Hướng dẫn khắc phục:</strong><br>";
    echo "1. Khởi động Django: <code>cd C:\\xampp1\\htdocs\\Tensorflow-Chatbot && .\\venv\\Scripts\\Activate.ps1 && python manage.py runserver 8888</code><br>";
    echo "2. Khởi động XAMPP: Start Apache<br>";
    echo "3. Chạy lại test này<br>";
}

echo "<hr>";
echo "<p><small>Test được tạo lúc: " . date('Y-m-d H:i:s') . "</small></p>";
?>
