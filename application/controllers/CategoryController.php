<?php

class CategoryController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('CategoryModel'); // Load model chung
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['category'] = $this->CategoryModel->getAllCategoriesWithParent(); // Join parent title
        $this->load->view('admin_template/header');
        $this->load->view('admin_template/navbar');
        $this->load->view('category/list', $data);
        $this->load->view('admin_template/footer');
    }

    public function create()
    {
        // Lấy danh sách nhóm cha
        $data['groups'] = $this->CategoryModel->getParentCategories();

        $this->load->view('admin_template/header');
        $this->load->view('admin_template/navbar');
        $this->load->view('category/create', $data);
        $this->load->view('admin_template/footer');
    }

    public function store()
    {
        $this->form_validation->set_rules('title', 'Title', 'trim|required', ['required' => 'Bạn phải điền %s']);
        $this->form_validation->set_rules('slug', 'Slug', 'trim|required', ['required' => 'Bạn phải điền %s']);
        $this->form_validation->set_rules('description', 'Description', 'trim|required', ['required' => 'Bạn phải điền %s']);

        if ($this->form_validation->run() == TRUE) {
            $data = [
                'title' => $this->input->post('title'),
                'slug' => $this->input->post('slug'),
                'description' => $this->input->post('description'),
                'status' => $this->input->post('status'),
                'parent_id' => $this->input->post('parent_id') ?: NULL
            ];

            if (!empty($_FILES['image']['name'])) {
                $ori_filename = $_FILES['image']['name'];
                $new_name = time() . "-" . str_replace(' ', '-', $ori_filename);
                $config = [
                    'upload_path' => './uploads/category',
                    'allowed_types' => 'gif|jpg|png|jpeg',
                    'file_name' => $new_name,
                ];
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('image')) {
                    $data['image'] = $this->upload->data('file_name');
                }
            }

            $this->CategoryModel->insertCategory($data);
            $this->session->set_flashdata('success', 'Thêm Thành Công');
            redirect(base_url('category/list'));
        } else {
            $this->create(); // Load form lại khi lỗi
        }
    }

    public function edit($id)
    {
        $data['category'] = $this->CategoryModel->selectCategoryById($id);
        $data['groups'] = $this->CategoryModel->getParentCategories();

        $this->load->view('admin_template/header');
        $this->load->view('admin_template/navbar');
        $this->load->view('category/edit', $data);
        $this->load->view('admin_template/footer');
    }

    public function update($id)
    {
        $this->form_validation->set_rules('title', 'Title', 'trim|required', ['required' => 'Bạn phải điền %s']);
        $this->form_validation->set_rules('slug', 'Slug', 'trim|required', ['required' => 'Bạn phải điền %s']);
        $this->form_validation->set_rules('description', 'Description', 'trim|required', ['required' => 'Bạn phải điền %s']);

        if ($this->form_validation->run() == TRUE) {
            $data = [
                'title' => $this->input->post('title'),
                'slug' => $this->input->post('slug'),
                'description' => $this->input->post('description'),
                'status' => $this->input->post('status'),
                'parent_id' => $this->input->post('parent_id') ?: NULL
            ];

            if (!empty($_FILES['image']['name'])) {
                $ori_filename = $_FILES['image']['name'];
                $new_name = time() . "-" . str_replace(' ', '-', $ori_filename);
                $config = [
                    'upload_path' => './uploads/category',
                    'allowed_types' => 'gif|jpg|png|jpeg',
                    'file_name' => $new_name,
                ];
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('image')) {
                    $data['image'] = $this->upload->data('file_name');
                }
            }

            $this->CategoryModel->updateCategory($id, $data);
            $this->session->set_flashdata('success', 'Cập nhật Thành Công');
            redirect(base_url('category/list'));
        } else {
            $this->edit($id);
        }
    }

    public function delete($id)
    {
        $this->CategoryModel->deleteCategory($id);
        $this->session->set_flashdata('success', 'Xóa Thành Công');
        redirect(base_url('category/list'));
    }
	public function show($slug)
{
    $this->load->model('CategoryModel');
    $this->load->model('ProductModel');

    $category = $this->CategoryModel->getCategoryBySlug($slug);

    // Lấy tất cả id con của danh mục cha (nếu có)
    $child_ids = $this->CategoryModel->getChildCategoryIds($category['id']);
    $category_ids = [$category['id']];
    if ($child_ids) {
        $category_ids = array_merge($category_ids, $child_ids);
    }

    $data['category_product'] = $this->ProductModel->getProductsByCategories($category_ids);
    $data['title'] = $category['title'];
    $data['category'] = $this->CategoryModel->getAllCategories(); // để mega menu

    $this->load->view('frontend/header', $data);
    $this->load->view('frontend/category_page', $data);
    $this->load->view('frontend/footer', $data);
}

}
