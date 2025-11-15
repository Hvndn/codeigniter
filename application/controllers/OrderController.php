<?php
class OrderController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('OrderModel');
        $this->load->model('CategoryModel');
        $this->load->model('CustomerModel'); // cần để lấy thông tin khách
        $this->load->library('session');
    }

    // Trang đơn hàng của khách đã đăng nhập
    public function index() {
        if (!$this->session->userdata('LoggedInCustomer')) {
            redirect('dang-nhap');
        }

        $customer = $this->session->userdata('LoggedInCustomer');
        $customer_id = $customer['id'] ?? 0;

        $data['category'] = $this->CategoryModel->getAllCategories();
        $data['orders'] = $this->OrderModel->get_orders_with_details($customer_id);

        $this->load->view('pages/template/header', $data);
        $this->load->view('pages/order', $data);
        $this->load->view('pages/template/footer');
    }

    // Danh sách tất cả khách hàng (admin)
    public function admin_index() {
        $loggedIn = $this->session->userdata('LoggedInCustomer');
        if (!$loggedIn || ($loggedIn['role'] ?? '') !== 'admin') {
            redirect(base_url('dang-nhap'));
        }

        $data['customers'] = $this->CustomerModel->get_all_customers();

        $this->load->view('admin_template/header');
        $this->load->view('customer/list', $data);
        $this->load->view('admin_template/footer');
    }

    // Xem đơn hàng của 1 khách (admin)
    public function admin_view($customer_id) {
        $loggedIn = $this->session->userdata('LoggedInCustomer');
        if (!$loggedIn || ($loggedIn['role'] ?? '') !== 'admin') {
            redirect(base_url('dang-nhap'));
        }

        $data['orders'] = $this->OrderModel->get_orders_with_details($customer_id);
        $data['customer'] = $this->CustomerModel->get_customer_by_id($customer_id);

        $this->load->view('admin_template/header');
                $this->load->view('admin_template/navbar');   // navbar nằm trong admin_template

        $this->load->view('order/admin_orders', $data);
        $this->load->view('admin_template/footer');
    }
}

