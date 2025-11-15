<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CustomerModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get_all_customers()
    {
        return $this->db->select('id, name, email, role, created_at')
            ->from('customer')
            ->where('role !=', 'admin')  // <-- ẩn admin
            ->order_by('id', 'ASC')
            ->get()
            ->result_array();
    }

    // Lấy 1 khách hàng theo id
    public function get_customer_by_id($id)
    {
        return $this->db->select('id, name, email, role, created_at')
            ->from('customer')
            ->where('id', $id)
            ->get()
            ->row_array(); // row_array để trả về 1 mảng đơn
    }

    // Lấy thông tin customer kèm lịch sử chat
    public function get_customer_with_chat_history($id, $limit = 20)
    {
        $customer = $this->get_customer_by_id($id);
        if (!$customer) return null;

        $this->load->model('Chat_model');
        $customer['chat_history'] = $this->Chat_model->get_chat_history($id, $limit);
        return $customer;
    }
}
