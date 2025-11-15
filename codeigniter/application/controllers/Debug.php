<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Debug extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Chỉ cho phép truy cập trong development
        if (ENVIRONMENT !== 'development') {
            show_404();
        }
    }

    /**
     * Debug kết nối chatbot
     */
    public function chatbot() {
        echo "<h1>🔍 Debug Chatbot Connection</h1>";
        echo "<hr>";
        
        // Test Django API trực tiếp
        echo "<h2>Test Django API</h2>";
        $this->test_django_api();
        
        echo "<br><hr><br>";
        
        // Test CodeIgniter API
        echo "<h2>Test CodeIgniter API</h2>";
        $this->test_codeigniter_api();
    }

    private function test_django_api() {
        $django_url = 'http://localhost:8888/api';
        $test_message = "Xin chào, bạn có khỏe không?";
        
        $data = array('msg' => $test_message);
        $json_data = json_encode($data);
        
        echo "<strong>Request:</strong><br>";
        echo "URL: " . $django_url . "<br>";
        echo "Data: " . htmlspecialchars($json_data) . "<br><br>";
        
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
        
        $start_time = microtime(true);
        $response = curl_exec($ch);
        $end_time = microtime(true);
        
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curl_error = curl_error($ch);
        $response_time = round(($end_time - $start_time) * 1000, 2);
        
        curl_close($ch);
        
        echo "<strong>Response:</strong><br>";
        echo "HTTP Code: " . $http_code . "<br>";
        echo "Response Time: " . $response_time . "ms<br>";
        
        if ($curl_error) {
            echo "CURL Error: " . $curl_error . "<br>";
        }
        
        echo "Raw Response: " . htmlspecialchars($response) . "<br>";
        
        if ($http_code == 200 && $response) {
            $result = json_decode($response, true);
            if ($result && isset($result['res'])) {
                echo "<strong>Parsed Response:</strong> " . htmlspecialchars($result['res']) . "<br>";
                echo "✅ Django API hoạt động tốt!<br>";
            } else {
                echo "⚠️ Response format không đúng<br>";
            }
        } else {
            echo "❌ Django API không kết nối được<br>";
        }
    }

    private function test_codeigniter_api() {
        echo "<strong>Test CodeIgniter Chat Controller</strong><br>";
        
        // Load Chat controller
        $this->load->library('unit_test');
        
        // Test method call_chatbot_api
        $chat_controller = new Chat();
        $reflection = new ReflectionClass($chat_controller);
        $method = $reflection->getMethod('call_chatbot_api');
        $method->setAccessible(true);
        
        $test_message = "Xin chào, test kết nối";
        $result = $method->invoke($chat_controller, $test_message);
        
        echo "Test Message: " . htmlspecialchars($test_message) . "<br>";
        echo "Result: " . htmlspecialchars($result) . "<br>";
        
        if (strpos($result, 'Xin lỗi') === false) {
            echo "✅ CodeIgniter API hoạt động tốt!<br>";
        } else {
            echo "⚠️ CodeIgniter API có vấn đề<br>";
        }
    }

    /**
     * Test đơn giản - chỉ kiểm tra server status
     */
    public function status() {
        $status = array();
        
        // Check Django
        $django_url = 'http://localhost:8888/api';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $django_url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(array('msg' => 'test')));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        
        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        $status['django'] = array(
            'status' => $http_code == 200 ? 'online' : 'offline',
            'code' => $http_code
        );
        
        // Check Apache
        $status['apache'] = array(
            'status' => 'online',
            'code' => 200
        );
        
        header('Content-Type: application/json');
        echo json_encode($status);
    }
}
