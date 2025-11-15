<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ChatHistoryController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Chat_model');
        $this->load->model('CustomerModel');
    }

    // 🟦 Hiển thị danh sách user đã chat
    public function index()
    {
        $data['users'] = $this->Chat_model->get_users_chatted();

        $this->load->view('admin_template/header');
        $this->load->view('admin_template/navbar');
        $this->load->view('chatbot/user_list', $data);
        $this->load->view('admin_template/footer');
    }

    // 🟩 Hiển thị lịch sử chat của 1 user
    public function view($customer_id)
    {
        $data['customer'] = $this->CustomerModel->get_customer_by_id($customer_id);
        $data['chats'] = $this->Chat_model->get_chat_history($customer_id, 200);

        $this->load->view('admin_template/header');
        $this->load->view('admin_template/navbar');
        $this->load->view('chatbot/chat_detail', $data);
        $this->load->view('admin_template/footer');
    }
}
