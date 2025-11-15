<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CustomerController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('CustomerModel');
        $this->load->library('session');

        // Kiểm tra quyền admin
        $loggedIn = $this->session->userdata('LoggedInCustomer');
        if (!$loggedIn || ($loggedIn['role'] ?? '') !== 'admin') {
            redirect(base_url('dang-nhap'));
        }
    }

    // Danh sách khách hàng
    public function index() {
        $data['customers'] = $this->CustomerModel->get_all_customers();

        // Load các view đúng với thư mục thực tế
        $this->load->view('admin_template/header');   // header nằm trong admin_template
        $this->load->view('admin_template/navbar');   // navbar nằm trong admin_template
        $this->load->view('customer/list', $data);   // danh sách khách hàng
        $this->load->view('admin_template/footer');   // footer nằm trong admin_template
    }
}
