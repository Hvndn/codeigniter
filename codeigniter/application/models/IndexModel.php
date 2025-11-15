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
        $this->db->select('category.*');
        $this->db->from('category');
        $this->db->limit(1);
        $this->db->where('category.id', $id);
        $query = $this->db->get();
        $result = $query->row();
        return $title = $result->title;
    }
    public function getBrandTitle($id)
    {
        $this->db->select('brand.*');
        $this->db->from('brand');
        $this->db->limit(1);
        $this->db->where('brand.id', $id);
        $query = $this->db->get();
        $result = $query->row();
        return $title = $result->title;
    }
    public function getProductDetail($id)
    {

        $query = $this->db->select('category.title as tendanhmuc,product.*,brand.title as tenthuonghieu')
            ->from('category')
            ->join('product', 'category.id = product.category_id')
            ->join('brand', 'product.brand_id = brand.id')
            ->where('product.id ', $id)
            ->get();
        return $query->result_array();
    }
}
