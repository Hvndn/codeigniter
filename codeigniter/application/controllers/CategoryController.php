<?php


class CategoryController extends CI_Controller
{
	
	public function index()
	{
		
		$this->load->view('admin_template/header');
		$this->load->view('admin_template/navbar');
		$this->load->model('CategoryModel');
		$data['category'] = $this->CategoryModel->selectCategory();
		$this->load->view('category/list', $data);
		$this->load->view('admin_template/footer');
	}

	public function create()
	{
	
		$this->load->view('admin_template/header');
		$this->load->view('admin_template/navbar');
		$this->load->view('category/create');
		$this->load->view('admin_template/footer');
	}

	public function store()
	{
		$this->form_validation->set_rules('title', 'Title', 'trim|required',
			['required' => 'Bạn phải điền %s']);

		$this->form_validation->set_rules('slug', 'Slug', 'trim|required',
			['required' => 'Bạn phải điền %s']);
		$this->form_validation->set_rules('description', 'Description', 'trim|required',
			['required' => 'Bạn phải điền %s']);

		if ($this->form_validation->run() == TRUE) {
			$data = [
				'title' => $this->input->post('title'),
				'description' => $this->input->post('description'),
				'slug' => $this->input->post('slug'),
				'status' => $this->input->post('status')
			];

			if (!empty($_FILES['image']['name'])) {
				$ori_filename = $_FILES['image']['name'];
				$new_name = time() . "" . str_replace('', '-', $ori_filename);
				$config = [
					'upload_path' => './uploads/category',
					'allowed_types' => 'gif|jpg|png|jpeg',
					'file_name' => $new_name,
				];
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('image')) {
					$category_filename = $this->upload->data('file_name');
					$data['image'] = $category_filename;  // Chỉ thêm vào khi có ảnh
				}
			}

			$this->load->model('CategoryModel');
			$this->CategoryModel->insertCategory($data);
			$this->session->set_flashdata('success', 'Thêm Thành Công');
			redirect(base_url('category/list'));
		} else {
			$this->create();
		}
	}

	public function edit($id)
	{
		
		$this->load->view('admin_template/header');
		$this->load->view('admin_template/navbar');
		$this->load->model('CategoryModel');
		$data['category'] = $this->CategoryModel->selectCategoryById($id);
		$this->load->view('category/edit', $data);
		$this->load->view('admin_template/footer');
	}

	public function update($id)
	{
		$this->form_validation->set_rules('title', 'Title', 'trim|required',
			['required' => 'Bạn phải điền %s']);

		$this->form_validation->set_rules('slug', 'Slug', 'trim|required',
			['required' => 'Bạn phải điền %s']);
		$this->form_validation->set_rules('description', 'Description', 'trim|required',
			['required' => 'Bạn phải điền %s']);

		if ($this->form_validation->run() == TRUE) {
			$data = [
				'title' => $this->input->post('title'),
				'description' => $this->input->post('description'),
				'slug' => $this->input->post('slug'),
				'status' => $this->input->post('status')
			];

			if (!empty($_FILES['image']['name'])) {
				$ori_filename = $_FILES['image']['name'];
				$new_name = time() . "" . str_replace('', '-', $ori_filename);
				$config = [
					'upload_path' => './uploads/category',
					'allowed_types' => 'gif|jpg|png|jpeg',
					'file_name' => $new_name,
				];
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('image')) {
					$category_filename = $this->upload->data('file_name');
					$data['image'] = $category_filename;  // Chỉ thêm vào khi có ảnh
				}
			}

			$this->load->model('CategoryModel');
			$this->CategoryModel->updateCategory($id, $data);
			$this->session->set_flashdata('success', 'Cập nhật Thành Công');
			redirect(base_url('category/list'));
		} else {
			$this->edit($id);
		}
	}

	public function delete($id)
	{
		$this->load->model('CategoryModel');
		$this->CategoryModel->deleteCategory($id);  // Loại bỏ $data không cần thiết
		$this->session->set_flashdata('success', 'Xóa Thành Công');
		redirect(base_url('category/list'));
	}
}
