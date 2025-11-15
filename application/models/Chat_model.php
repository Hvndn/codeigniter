<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Chat_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Lưu một tin nhắn vào database
     * @param array $data Dữ liệu bao gồm customer_id, user_message, bot_response
     */
    public function save_message($data)
    {
        // Chỉ lấy các trường cần thiết để đảm bảo an toàn
        $insert_data = array(
            'customer_id' => $data['customer_id'],
            'user_message' => $data['user_message'],
            'bot_response' => $data['bot_response']
        );

        $this->db->insert('history_chat', $insert_data);
        return $this->db->insert_id(); // Trả về ID của bản ghi vừa chèn
    }

    /**
     * Lấy lịch sử chat của một customer
     * @param int $customer_id
     * @param int $limit Số lượng bản ghi tối đa (mặc định 50)
     * @return array
     */
    public function get_chat_history($customer_id, $limit = 50)
    {
        $this->db->select('hc.*, c.name as customer_name');
        $this->db->from('history_chat hc');
        $this->db->join('customer c', 'hc.customer_id = c.id', 'left');
        $this->db->where('hc.customer_id', $customer_id);
        $this->db->order_by('hc.created_at', 'DESC');
        $this->db->limit($limit);
        return $this->db->get()->result_array();
    }

    /**
     * Lấy tất cả lịch sử chat (dùng cho admin)
     * @param int $limit
     * @return array
     */
    public function get_all_chat_history($limit = 100)
    {
        $this->db->select('hc.*, c.name as customer_name, c.email');
        $this->db->from('history_chat hc');
        $this->db->join('customer c', 'hc.customer_id = c.id', 'left');
        $this->db->order_by('hc.created_at', 'DESC');
        $this->db->limit($limit);
        return $this->db->get()->result_array();
    }

    /**
     * Xóa lịch sử chat của một customer
     * @param int $customer_id
     * @return bool
     */
    public function delete_chat_history($customer_id)
    {
        $this->db->where('customer_id', $customer_id);
        return $this->db->delete('history_chat');
    }
    public function get_all_history()
    {
        return $this->db->select('history_chat.*, customer.name, customer.email')
            ->from('history_chat')
            ->join('customer', 'customer.id = history_chat.customer_id', 'left')
            ->order_by('history_chat.created_at', 'DESC')
            ->get()
            ->result_array();
    }
    public function get_users_chatted()
    {
        return $this->db->select('customer.id, customer.name, customer.email')
            ->from('customer')
            ->join('history_chat', 'customer.id = history_chat.customer_id')
            ->group_by('customer.id')
            ->order_by('customer.id', 'DESC')
            ->get()
            ->result_array();
    }
}
