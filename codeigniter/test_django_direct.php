<?php
/**
 * Test Django API trực tiếp với dữ liệu đúng
 */
echo "<h1>🤖 Test Django API (Direct)</h1>";
echo "<hr>";

$django_url = 'http://localhost:8888/api';
$test_message = "Xin chào";

// Chuẩn bị dữ liệu đúng format
$data = array('msg' => $test_message);
$json_data = json_encode($data);

echo "<h2>Request Details:</h2>";
echo "URL: " . $django_url . "<br>";
echo "Data: " . htmlspecialchars($json_data) . "<br>";
echo "Method: POST<br><br>";

// Test với cURL
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

echo "<h2>Response Details:</h2>";

$start_time = microtime(true);
$response = curl_exec($ch);
$end_time = microtime(true);

$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$curl_error = curl_error($ch);
$response_time = round(($end_time - $start_time) * 1000, 2);

curl_close($ch);

echo "HTTP Code: " . $http_code . "<br>";
echo "Response Time: " . $response_time . "ms<br>";

if ($curl_error) {
    echo "CURL Error: " . $curl_error . "<br>";
}

echo "Raw Response: " . htmlspecialchars($response) . "<br>";

if ($http_code == 200 && $response) {
    $result = json_decode($response, true);
    if ($result && isset($result['res'])) {
        echo "<h3>✅ Success!</h3>";
        echo "Bot Response: " . htmlspecialchars($result['res']) . "<br>";
        echo "Question: " . htmlspecialchars($result['ques']) . "<br>";
        echo "Time: " . htmlspecialchars($result['time']) . "<br>";
    } else {
        echo "<h3>⚠️ Response format issue</h3>";
        echo "Expected: {\"res\": \"...\"}<br>";
        echo "Got: " . htmlspecialchars($response) . "<br>";
    }
} else {
    echo "<h3>❌ Connection Failed</h3>";
    echo "Check if Django server is running on port 8888<br>";
}

echo "<hr>";
echo "<p><small>Test time: " . date('Y-m-d H:i:s') . "</small></p>";
?>
