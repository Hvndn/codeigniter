<?php
defined('BASEPATH') or exit('No direct script access allowed');

class OrderModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_orders_with_details($customer_id)
    {
        // 1. Lấy danh sách đơn hàng + thông tin shipping
        $this->db->select('o.id, o.order_code, o.status, o.created_at,
                           s.name, s.phone, s.address, s.email, s.method');
        $this->db->from('`order` o');
        $this->db->join('shipping s', 'o.ship_id = s.id', 'left');
        $this->db->where('o.customer_id', $customer_id);
        $this->db->order_by('o.created_at', 'ASC');
        $this->db->order_by('o.id', 'ASC');
        $orders = $this->db->get()->result_array();

        if (empty($orders)) {
            return [];
        }

        // 2. Lấy chi tiết sản phẩm, thêm cột image
        $order_codes = array_column($orders, 'order_code');

        $this->db->select('od.order_code, od.product_id, od.quantity, od.image, p.title, p.price');
        $this->db->from('order_detail od');
        $this->db->join('product p', 'od.product_id = p.id', 'left');
        $this->db->where_in('od.order_code', $order_codes);
        $order_details = $this->db->get()->result_array();

        // 3. Gắn chi tiết sản phẩm vào từng đơn hàng
        $details_map = [];
        foreach ($order_details as $item) {
            $details_map[$item['order_code']][] = $item;
        }

        foreach ($orders as &$order) {
            $order['items'] = $details_map[$order['order_code']] ?? [];
        }

        return $orders;
    }
}