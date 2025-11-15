<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BrandController extends CI_Controller
{
    

    // Danh sách brand
    public function index()
    {
       
        $this->load->view('admin_template/header');
        $this->load->view('admin_template/navbar');
        $this->load->model('BrandModel');
        $data['brand'] = $this->BrandModel->selectBrand();
        $this->load->view('brand/list', $data);
        $this->load->view('admin_template/footer');
    }

    // Thêm brand
    public function create()
    {
       
        $this->load->view('admin_template/header');
        $this->load->view('admin_template/navbar');
        $this->load->view('brand/create');
        $this->load->view('admin_template/footer');
    }

    // Lưu brand mới
    public function store()
    {
        $this->form_validation->set_rules('title', 'Title', 'trim|required', [
            'required' => 'Bạn phải điền %s'
        ]);
        $this->form_validation->set_rules('slug', 'Slug', 'trim|required', [
            'required' => 'Bạn phải điền %s'
        ]);
        $this->form_validation->set_rules('description', 'Description', 'trim|required', [
            'required' => 'Bạn phải điền %s'
        ]);

        if ($this->form_validation->run() == TRUE) {
            $data = [
                'title'       => $this->input->post('title'),
                'description' => $this->input->post('description'),
                'slug'        => $this->input->post('slug'),
                'status'      => $this->input->post('status')
            ];

            if (!empty($_FILES['image']['name'])) {
                $ori_filename = $_FILES['image']['name'];
                $new_name     = time() . "-" . str_replace(' ', '-', $ori_filename);
                $config = [
                    'upload_path'   => './uploads/brand',
                    'allowed_types' => 'gif|jpg|png|jpeg',
                    'file_name'     => $new_name,
                ];
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('image')) {
                    $brand_filename = $this->upload->data('file_name');
                    $data['image']  = $brand_filename;
                }
            }

            $this->load->model('BrandModel');
            $this->BrandModel->insertBrand($data);
            $this->session->set_flashdata('success', 'Thêm Brand thành công');
            redirect(base_url('brand/list'));
        } else {
            $this->create();
        }
    }

    // Sửa brand
    public function edit($id)
    {

        $this->load->view('admin_template/header');
        $this->load->view('admin_template/navbar');
        $this->load->model('BrandModel');
        $data['brand'] = $this->BrandModel->selectBrandById($id);
        $this->load->view('brand/edit', $data);
        $this->load->view('admin_template/footer');
    }

    // Cập nhật brand
    public function update($id)
    {
        $this->form_validation->set_rules('title', 'Title', 'trim|required', [
            'required' => 'Bạn phải điền %s'
        ]);
        $this->form_validation->set_rules('slug', 'Slug', 'trim|required', [
            'required' => 'Bạn phải điền %s'
        ]);
        $this->form_validation->set_rules('description', 'Description', 'trim|required', [
            'required' => 'Bạn phải điền %s'
        ]);

        if ($this->form_validation->run() == TRUE) {
            $data = [
                'title'       => $this->input->post('title'),
                'description' => $this->input->post('description'),
                'slug'        => $this->input->post('slug'),
                'status'      => $this->input->post('status')
            ];

            if (!empty($_FILES['image']['name'])) {
                $ori_filename = $_FILES['image']['name'];
                $new_name     = time() . "-" . str_replace(' ', '-', $ori_filename);
                $config = [
                    'upload_path'   => './uploads/brand',
                    'allowed_types' => 'gif|jpg|png|jpeg',
                    'file_name'     => $new_name,
                ];
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('image')) {
                    $brand_filename = $this->upload->data('file_name');
                    $data['image']  = $brand_filename;
                }
            }

            $this->load->model('BrandModel');
            $this->BrandModel->updateBrand($id, $data);
            $this->session->set_flashdata('success', 'Cập nhật Brand thành công');
            redirect(base_url('brand/list'));
        } else {
            $this->edit($id);
        }
    }

    // Xóa brand
    public function delete($id)
    {
        $this->load->model('BrandModel');
        $this->BrandModel->deleteBrand($id);
        $this->session->set_flashdata('success', 'Xóa Brand thành công');
        redirect(base_url('brand/list'));
    }
}
