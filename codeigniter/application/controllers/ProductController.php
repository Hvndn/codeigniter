<?php
class ProductController extends CI_Controller
{
    

    public function index()
    {
       
        $this->load->view('admin_template/header');
        $this->load->view('admin_template/navbar');
        $this->load->model('ProductModel');
        $data['product'] = $this->ProductModel->selectProduct();
        $this->load->view('product/list', $data);
        $this->load->view('admin_template/footer');
    }

    public function create()
    {
 
        $this->load->view('admin_template/header');
        $this->load->view('admin_template/navbar');
        $this->load->model('CategoryModel');
        $data['category'] = $this->CategoryModel->selectCategory();
        $this->load->model('BrandModel');
        $data['brand'] = $this->BrandModel->selectBrand();
        $this->load->view('product/create', $data);
        $this->load->view('admin_template/footer');
    }

    public function store()
    {
        $this->form_validation->set_rules(
            'title',
            'Title',
            'trim|required',
            ['required' => 'Bạn phải điền %s']
        );
        $this->form_validation->set_rules(
            'price',
            'Price',
            'trim|required',
            ['required' => 'Bạn phải điền %s']
        );


        $this->form_validation->set_rules(
            'slug',
            'Slug',
            'trim|required',
            ['required' => 'Bạn phải điền %s']
        );
        $this->form_validation->set_rules(
            'quantity',
            'Quantity',
            'trim|required',
            ['required' => 'Bạn phải điền %s']
        );
        $this->form_validation->set_rules(
            'description',
            'Description',
            'trim|required',
            ['required' => 'Bạn phải điền %s']
        );

        if ($this->form_validation->run() == TRUE) {
            $data = [
                'title' => $this->input->post('title'),
                'price' => $this->input->post('price'),
                'description' => $this->input->post('description'),
                'slug' => $this->input->post('slug'),
                'quantity' => $this->input->post('quantity'),
                'status' => $this->input->post('status'),
                'category_id' => $this->input->post('category_id'),
                'brand_id' => $this->input->post('brand_id'),
            ];

            if (!empty($_FILES['image']['name'])) {
                $ori_filename = $_FILES['image']['name'];
                $new_name = time() . "-" . str_replace(' ', '-', $ori_filename); // Thay khoảng trắng bằng gạch ngang
                $config = [
                    'upload_path' => './uploads/product',
                    'allowed_types' => 'gif|jpg|png|jpeg',
                    'file_name' => $new_name,
                ];
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('image')) {
                    $product_filename = $this->upload->data('file_name');
                    $data['image'] = $product_filename; // Chỉ thêm vào khi có ảnh
                }
            }

            $this->load->model('ProductModel');
            $this->ProductModel->insertProduct($data);
            $this->session->set_flashdata('success', 'Thêm Thành Công');
            redirect(base_url('product/list'));
        } else {
            $this->create();
        }
    }

    public function edit($id)
    {
      
        $this->load->view('admin_template/header');
        $this->load->view('admin_template/navbar');
        $this->load->model('CategoryModel');
        $data['category'] = $this->CategoryModel->selectCategory();
        $this->load->model('BrandModel');
        $data['brand'] = $this->BrandModel->selectBrand();
        $this->load->model('ProductModel');
        $data['product'] = $this->ProductModel->selectProductByID($id);
        $this->load->view('product/edit', $data);
        $this->load->view('admin_template/footer');
    }
    public function update($id)
    {
        // Tải model ProductModel
        $this->load->model('ProductModel');
        $this->form_validation->set_rules(
            'price',
            'Price',
            'trim|required',
            ['required' => 'Bạn phải điền %s']
        );
        $this->form_validation->set_rules('title', 'Title', 'trim|required', ['required' => 'Bạn phải điền %s']);
        $this->form_validation->set_rules('slug', 'Slug', 'trim|required', ['required' => 'Bạn phải điền %s']);
        $this->form_validation->set_rules('description', 'Description', 'trim|required', ['required' => 'Bạn phải điền %s']);
        $this->form_validation->set_rules('quantity', 'Quantity', 'trim|required', ['required' => 'Bạn phải điền %s']);

        if ($this->form_validation->run() == TRUE) {
            $data = [
                'title' => $this->input->post('title'),
                'price' => $this->input->post('price'),
                'description' => $this->input->post('description'),
                'slug' => $this->input->post('slug'),
                'quantity' => $this->input->post('quantity'),
                'status' => $this->input->post('status'),
                'category_id' => $this->input->post('category_id'),
                'brand_id' => $this->input->post('brand_id')
            ];

            if (!empty($_FILES['image']['name'])) {
                $ori_filename = $_FILES['image']['name'];
                $new_name = time() . "-" . str_replace(' ', '-', $ori_filename);
                $config = [
                    'upload_path' => './uploads/product',
                    'allowed_types' => 'gif|jpg|png|jpeg',
                    'file_name' => $new_name,
                ];
                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $product_filename = $this->upload->data('file_name');
                    $data['image'] = $product_filename; // Thêm ảnh vào nếu upload thành công
                } else {
                    $error = array('error' => $this->upload->display_errors());
                    $this->load->view('admin_template/header');
                    $this->load->view('admin_template/navbar');
                    $this->load->view('product/edit', array_merge($data, $error));
                    $this->load->view('admin_template/footer');
                    return; // Thoát ra nếu có lỗi
                }
            }

            $this->ProductModel->updateProduct($id, $data);
            $this->session->set_flashdata('success', 'Cập nhật Thành Công');
            redirect(base_url('product/list'));
        } else {
            $this->edit($id);
        }
    }


    public function delete($id)
    {
        $this->load->model('ProductModel');
        $this->ProductModel->deleteProduct($id);
        $this->session->set_flashdata('success', 'Xóa Thành Công');
        redirect(base_url('product/list'));
    }
    public function recommended_items() {
        $data['random_products'] = $this->Product_model->get_random_products(6); // Lấy 6 sản phẩm ngẫu nhiên
        $this->load->view('recommended_items_view', $data); // Gửi dữ liệu đến view
    }
}
