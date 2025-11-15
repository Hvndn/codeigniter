<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Chat extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Chat_model');
        $this->load->model('CustomerModel');
    }

    // Endpoint để lưu lịch sử chat
    public function save_history()
    {
        header('Content-Type: application/json; charset=utf-8');
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: POST');
        header('Access-Control-Allow-Headers: Content-Type');

        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            exit(0);
        }

        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        log_message('debug', 'Save History Data: ' . print_r($data, true));

        $customer_id = isset($data['customer_id']) ? (int)$data['customer_id'] : null;
        $user_message = isset($data['user_message']) ? $data['user_message'] : '';
        $bot_response = isset($data['bot_response']) ? $data['bot_response'] : '';

        if (!$customer_id || !$user_message || !$bot_response) {
            log_message('error', 'Thiếu dữ liệu: customer_id=' . $customer_id . ', user_message=' . $user_message . ', bot_response=' . $bot_response);
            echo json_encode(['error' => 'Thiếu dữ liệu']);
            return;
        }

        // Kiểm tra customer tồn tại
        $customer = $this->CustomerModel->get_customer_by_id($customer_id);
        if (!$customer) {
            log_message('error', 'Customer không tồn tại: ' . $customer_id);
            echo json_encode(['error' => 'Customer không tồn tại']);
            return;
        }

        // Lưu vào DB
        $save_data = [
            'customer_id' => $customer_id,
            'user_message' => $user_message,
            'bot_response' => $bot_response
        ];

        $insert_id = $this->Chat_model->save_message($save_data);
        if ($insert_id) {
            log_message('debug', 'Lưu thành công ID: ' . $insert_id);
            echo json_encode(['success' => true, 'id' => $insert_id]);
        } else {
            log_message('error', 'Lỗi lưu DB: ' . print_r($save_data, true));
            echo json_encode(['error' => 'Lỗi lưu DB']);
        }
    }
}
