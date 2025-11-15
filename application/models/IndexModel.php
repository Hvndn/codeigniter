<?php
class IndexModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();

        $this->load->database();
    }

    public function getCategoryHome()
    {

        $query = $this->db->get_where('category', ['status' => 1]);
        return $query->result_array();
    }

    public function getBrandHome()
    {

        $query = $this->db->get_where('brand', ['status' => 1]);
        return $query->result_array();
    }

    public function getAllProduct()
    {

        $query = $this->db->get('product');
        return $query->result_array();
    }
    public function getCategoryProduct($id)
    {
        $query = $this->db->select('category.title as tendanhmuc,product.*,brand.title as tenthuonghieu')
            ->from('category')
            ->join('product', 'category.id = product.category_id')
            ->join('brand', 'product.brand_id = brand.id')
            ->where('product.category_id ', $id)
            ->get();
        return $query->result_array();
    }
    public function getBrandProduct($id)
    {
        $query = $this->db->select('category.title as tendanhmuc,product.*,brand.title as tenthuonghieu')
            ->from('category')
            ->join('product', 'category.id = product.category_id')
            ->join('brand', 'product.brand_id = brand.id')
            ->where('product.brand_id ', $id)
            ->get();
        return $query->result_array();
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

    public function getBrandTitle($id)
    {
        $query = $this->db->get_where('brand', ['id' => $id], 1);
        $brand = $query->row_array();
        if ($brand) {
            return $brand['title'];
        }
        return 'Thương hiệu không tồn tại';
    }

    public function getProductDetailBySlug($slug)
    {
        $query = $this->db->select('category.title as tendanhmuc, product.*, brand.title as tenthuonghieu')
            ->from('product')
            ->join('category', 'category.id = product.category_id', 'left')
            ->join('brand', 'brand.id = product.brand_id', 'left')
            ->where('product.slug', $slug)
            ->get();
        return $query->row_array();
    }

    public function getCategoryBySlug($slug)
    {
        $query = $this->db->get_where('category', ['slug' => $slug, 'status' => 1]);
        return $query->row_array(); // trả về mảng thay vì object
    }
    public function searchProducts($keyword)
    {
        $this->db->like('title', $keyword);
        $this->db->or_like('description', $keyword);
        $query = $this->db->get('products'); // bảng products
        return $query->result_array();
    }
}
