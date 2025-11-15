<?php
class LoginModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database(); // Tải cơ sở dữ liệu
    }

    public function checkLogin($email, $password)
    {
        // Thực hiện truy vấn kiểm tra thông tin đăng nhập
        $query = $this->db->where('email', $email)
            ->where('password', $password)
            ->get('user');

        return $query->result(); // Trả về kết quả truy vấn
    }
    public function checkCustomerExists($email)
    {
        $this->db->where('email', $email);
        $query = $this->db->get('customer');

        return $query->num_rows() > 0; // true nếu tồn tại
    }

    public function checkLoginCustomer($email, $password)
    {

        $query = $this->db->where('email', $email)
            ->where('password', $password)
            ->get('customer');

        return $query->result();
    }
    public function NewCustomer($data)
    {
        return  $this->db->insert('customer', $data);
    }
    public function NewShipping($data)
    {
        $this->db->insert('shipping', $data);
        return $ship_id = $this->db->insert_id();
    }
    public function insert_order($data_order)
    {
        return $this->db->insert('order', $data_order);
    }
    public function insert_order_detail($data_order_detail)
    {
        return $this->db->insert('order_detail', $data_order_detail);
    }
    public function getCategoryBySlug($slug)
    {
        $query = $this->db->get_where('category', ['slug' => $slug, 'status' => 1]);
        return $query->row_array(); // trả về mảng thay vì object
    }
    public function getCategoryTitle($id)
    {
        $query = $this->db->get_where('category', ['id' => $id]);
        $category = $query->row_array(); // trả về array thay vì object
        if ($category) {
            return $category['title'];
        } else {
            return 'Danh mục không tồn tại';
        }
    }
}