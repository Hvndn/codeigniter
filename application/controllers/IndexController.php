<?php
defined('BASEPATH') or exit('No direct script access allowed');

class IndexController extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('IndexModel');
		$this->load->model('ProductModel'); // Nạp model ProductModel
		$this->load->library('cart');

		// Chuẩn hóa dữ liệu dùng chung
		$this->data = [];
		$this->data['category'] = $this->IndexModel->getCategoryHome() ?? [];
		$this->data['brand'] = $this->IndexModel->getBrandHome() ?? [];
		// $this->data['product'] = $this->IndexModel->getProductHome() ?? [];
	}

	public function index()
	{
		// ✅ Lấy thông tin người dùng từ session
		$customer_session = $this->session->userdata('LoggedInCustomer');
		$this->data['customer_id'] = isset($customer_session['id']) ? $customer_session['id'] : 'null';

		$this->data['product'] = $this->IndexModel->getAllProduct() ?? [];
		$this->load->view('pages/template/header', $this->data);
		$this->load->view('pages/template/slider', $this->data);

		$this->load->view('pages/home', $this->data);
		// ✅ Truyền customer_id vào view chatbot
		$this->load->view('pages/template/chatbot', $this->data);
		$this->load->view('pages/template/footer');
	}

	public function category($slug)
	{
		$category = $this->IndexModel->getCategoryBySlug($slug);
		if (!$category) {
			show_404(); // nếu không tồn tại
		}

		$this->data['category_product'] = $this->IndexModel->getCategoryProduct($category['id']);
		$this->data['title'] = $category['title'];
		$this->load->view('pages/template/header', $this->data);
		$this->load->view('pages/category', $this->data);
		$this->load->view('pages/template/footer');
	}

	public function brand($id)
	{
		$this->data['brand_product'] = $this->IndexModel->getBrandProduct($id) ?? [];
		$title = $this->IndexModel->getBrandTitle($id);
		$this->data['title'] = $title ?? 'Thương hiệu mặc định'; // Tránh lỗi nếu brand không tồn tại

		$this->load->view('pages/template/header', $this->data);
		$this->load->view('pages/brand', $this->data);
		$this->load->view('pages/template/footer');
	}

	public function product($slug)
	{
		// Lấy customer ID (QUAN TRỌNG)
		$customer_session = $this->session->userdata('LoggedInCustomer');
		$this->data['customer_id'] = isset($customer_session['id']) ? $customer_session['id'] : 'null';

		// Lấy sản phẩm theo slug
		$this->data['product_detail'] = $this->IndexModel->getProductDetailBySlug($slug);

		// Sản phẩm gợi ý
		$this->data['random_products'] = $this->ProductModel->get_random_products(6) ?? [];

		// Load view
		$this->load->view('pages/template/header', $this->data);
		$this->load->view('pages/product', $this->data);
		$this->load->view('pages/template/chatbot', $this->data);
		$this->load->view('pages/template/footer');
	}
	public function cart()
	{
		if ($this->session->userdata('LoggedInCustomer')) {
			$this->load->view('pages/template/header', $this->data);
			// $this->load->view('pages/template/slider');
			$this->load->view('pages/cart');
			$this->load->view('pages/template/footer');
		} else {
			// Gửi thông báo
			$this->session->set_flashdata('error', 'Bạn cần đăng nhập để thêm vào giỏ hàng ');
			// Chuyển hướng về trang đăng nhập
			redirect(base_url('dang-nhap'));
		}
	}
	public function checkout()
	{
		if ($this->session->userdata('LoggedInCustomer')) {
			$this->load->view('pages/template/header', $this->data);
			// $this->load->view('pages/template/slider');
			$this->load->view('pages/checkout');
			$this->load->view('pages/template/footer');
		} else {
			// Gửi thông báo
			$this->session->set_flashdata('error', 'Bạn cần đăng nhập để thanh toán');
			// Chuyển hướng về trang đăng nhập
			redirect(base_url('dang-nhap'));
		}
	}

	public function confirm_checkout()
	{
		$this->form_validation->set_rules(
			'sdt',
			'SĐT',
			'trim|required',
			['required' => 'Bạn phải điền %s']
		);
		$this->form_validation->set_rules(
			'diachi',
			'Địa chỉ',
			'trim|required',
			['required' => 'Bạn phải điền %s']
		);
		$this->form_validation->set_rules(
			'ten',
			'Tên',
			'trim|required',
			['required' => 'Bạn phải điền %s']
		);

		if ($this->form_validation->run() == TRUE) {
			// Lấy dữ liệu từ form
			$hinhthucthanhtoan = $this->input->post('hinhthucthanhtoan');
			$phone   = $this->input->post('sdt');
			$address = $this->input->post('diachi');
			$name    = $this->input->post('ten');

			// Lấy thông tin customer từ session
			$customer = $this->session->userdata('LoggedInCustomer');
			$email = $customer['email'];
			$customer_id = $customer['id']; // <-- thêm dòng này

			$data = array(
				'name'   => $name,
				'email'  => $email,
				'method' => $hinhthucthanhtoan,
				'phone'  => $phone,
				'address' => $address,
			);

			$this->load->model('LoginModel');

			$result = $this->LoginModel->NewShipping($data);

			if ($result) {
				$order_code = rand(00, 9999);
				$data_order = array(
					'order_code'  => $order_code,
					'ship_id'     => $result,
					'status'      => 1,
					'customer_id' => $customer_id // <-- gán customer_id vào đây
				);

				$insert_order = $this->LoginModel->insert_order($data_order);

				// Thêm chi tiết sản phẩm
				foreach ($this->cart->contents() as $item) {
					$data_order_detail = array(
						'order_code' => $order_code,
						'product_id' => $item['id'],
						'quantity'   => $item['qty'],
						'image'      => isset($item['options']['image']) ? $item['options']['image'] : 'default.png'


					);
					$insert_order_detail = $this->LoginModel->insert_order_detail($data_order_detail);
				}

				$this->cart->destroy();

				redirect(base_url('thankyou'));
			} else {
				$this->session->set_flashdata('error', 'Đặt hàng thất bại');
				redirect(base_url('checkout'));
			}
		} else {
			$this->checkout();
		}
	}




	public function add_to_cart()
	{
		$slug     = $this->input->post('product_slug');
		$quantity = $this->input->post('quantity');

		// Lấy sản phẩm theo slug
		$pro = $this->IndexModel->getProductDetailBySlug($slug);

		if (!empty($pro)) {

			$name = preg_replace('/[^A-Za-z0-9À-ỹ\s\-\(\)\.,]/u', '', $pro['title']);

			$cart = array(
				'id'      => $pro['slug'],   // dùng slug làm id trong giỏ hàng
				'qty'     => $quantity,
				'price'   => $pro['price'],
				'name'    => $name,
				'options' => array('image' => $pro['image'])
			);

			$this->cart->insert($cart);
		}

		redirect(base_url('gio-hang'), 'refresh');
	}


	public function delete_all_cart()
	{

		$this->cart->destroy();

		redirect(base_url() . 'gio-hang', 'refresh');
	}
	public function delete_item($rowid)
	{
		$this->cart->remove($rowid);
		redirect(base_url() . 'gio-hang', 'refresh');
	}
	public function update_cart_item()
	{
		$rowid = $this->input->post('rowid');
		$quantity = $this->input->post('quantity');
		// $this->cart->update($rowid, array('qty' => $quantity));
		foreach ($this->cart->contents() as $item) {
			if ($item['rowid'] == $rowid) {
				$cart = array(
					'rowid'  => $rowid,
					'qty'     => $quantity,

				);
			}
		}
		$this->cart->update($cart);
		// redirect(base_url() . 'gio-hang', 'refresh');
		redirect($_SERVER['HTTP_REFERER'], 'refresh');
	}
	public function login()
	{

		$this->data['product'] = $this->IndexModel->getAllProduct() ?? [];

		$this->load->view('pages/template/header');
		// $this->load->view('pages/template/slider');
		$this->load->view('pages/login');
		$this->load->view('pages/template/footer');
	}
	public function register()
	{


		$this->load->view('pages/template/header');
		// $this->load->view('pages/template/slider');
		$this->load->view('pages/register');
		$this->load->view('pages/template/footer');
	}


	public function login_customer()
	{
		// Form validation rules
		$this->form_validation->set_rules(
			'email',
			'Email',
			'trim|required|valid_email',
			['required' => 'Bạn phải điền %s', 'valid_email' => 'Định dạng email không hợp lệ']
		);
		$this->form_validation->set_rules(
			'password',
			'Password',
			'trim|required',
			['required' => 'Bạn phải điền %s']
		);

		if ($this->form_validation->run() == TRUE) {
			$email = $this->input->post('email');
			$password = md5($this->input->post('password'));

			$this->load->model('LoginModel');
			$result = $this->LoginModel->checkLoginCustomer($email, $password);

			if (count($result) > 0) {

				$user = $result[0]; // đối tượng user

				// Set session data chung
				$session_array = [
					'id'       => $user->id,
					'username' => $user->name,
					'email'    => $user->email,
					'role'     => $user->role ?? 'customer', // mặc định customer nếu role rỗng
				];

				$this->session->set_userdata('LoggedInCustomer', $session_array);

				// Redirect theo role
				if ($user->role === 'admin') {
					$this->session->set_flashdata('success', 'Đăng Nhập Admin Thành Công');
					redirect(base_url('/dashboard')); // chuyển sang dashboard admin
				} else {
					$this->session->set_flashdata('success', 'Đăng Nhập Thành Công');
					redirect(base_url('IndexController')); // chuyển sang trang khách
				}
			} else {
				// Sai email hoặc mật khẩu
				$this->session->set_flashdata('error', 'Sai email hoặc mật khẩu');
				redirect(base_url('/dang-nhap'));
			}
		} else {
			// Validation failed, show the form again with errors
			$this->login();
		}
	}

	public function checkLoginCustomer()
	{
		if (!$this->session->userdata('LoggedInCustomer')) {
			redirect(base_url('/dang-nhap'));
		}
	}
	public function dang_ky()
	{
		// Form validation rules
		$this->form_validation->set_rules(
			'email',
			'Email',
			'trim|required|valid_email',
			['required' => 'Bạn phải điền %s', 'valid_email' => 'Định dạng email không hợp lệ']
		);
		$this->form_validation->set_rules(
			'password',
			'Mật Khẩu',
			'trim|required',
			['required' => 'Bạn phải điền %s']
		);
		$this->form_validation->set_rules(
			'name',
			'Tên',
			'trim|required',
			['required' => 'Bạn phải điền %s']
		);

		if ($this->form_validation->run() == TRUE) {
			// Lấy dữ liệu từ form
			$email = $this->input->post('email');
			$password = md5($this->input->post('password'));  // Mã hóa bằng MD5
			$name = $this->input->post('name');
			$data  = array(
				'name' => $name,
				'email' => $email,
				'password' => $password,

			);

			$this->load->model('LoginModel');
			// ✅ Kiểm tra trùng email hoặc name
			if ($this->LoginModel->checkCustomerExists($email)) {
				$this->session->set_flashdata('error', 'Email đã tồn tại');
				redirect(base_url('/register'));
				return;
			}

			$result = $this->LoginModel->NewCustomer($data);

			if ($result) {
				$session_array = [
					'username' => $name,
					'email' => $email,
				];
				$this->session->set_userdata('LoggedIn', $session_array);
				$this->session->set_flashdata('success', 'Đăng Ký Thành Công');
				redirect(base_url('/dang-nhap'));
			} else {
				// Thông báo lỗi nếu đăng ký thất bại
				$this->session->set_flashdata('error', 'Đăng ký thất bại. Vui lòng thử lại.');
				redirect(base_url('/register'));
			}
		} else {
			// Hiển thị lỗi nếu form không hợp lệ
			$this->login();
		}
	}

	public function dang_xuat()
	{

		$this->session->unset_userdata('LoggedInCustomer');
		$this->session->set_flashdata('success', 'Đăng Xuất Thành Công');

		redirect(base_url('/dang-nhap'));
	}
	public function thankyou()
	{
		$this->load->view('pages/template/header');
		$this->load->view('pages/thankyou');
		$this->load->view('pages/template/footer');
	}
	public function search()
	{
		$keyword = $this->input->get('keyword', TRUE); // GET + lọc XSS

		$this->load->model('ProductModel');
		$data['products'] = $this->ProductModel->search_products($keyword);

		$this->load->model('CategoryModel');
		$data['category'] = $this->CategoryModel->getAllCategories();

		$this->load->view('pages/template/header', $data);
		$this->load->view('pages/product_search', $data);
		$this->load->view('pages/template/chatbot', $this->data);

		$this->load->view('pages/template/footer', $data);
	}
}
