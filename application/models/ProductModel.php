<?php
class ProductModel extends CI_Model
{


	public function insertProduct($data)
	{
		return $this->db->insert('product', $data);
	}
	public function selectProduct()
	{
		$query = $this->db->select('category.title as tendanhmuc,product.*,brand.title as tenthuonghieu')
			->from('category')
			->join('product', 'category.id = product.category_id')
			->join('brand', 'product.brand_id = brand.id')
			->get();
		return $query->result();
	}
	public function selectProductByID($id)
	{
		$query = $this->db->get_where('product', ['id' => $id]);
		return $query->row();
	}
	public function updateProduct($id, $data)
	{
		return $this->db->update('product', $data, ['id' => $id]);
	}
	public function deleteProduct($id)
	{
		return $this->db->delete('product', ['id' => $id]);
	}
	public function get_random_products($limit = 6)
	{
		$this->db->order_by('RAND()'); // Sắp xếp ngẫu nhiên
		$this->db->limit($limit); // Giới hạn số lượng sản phẩm
		$query = $this->db->get('product'); // Giả sử bảng tên là 'products'
		return $query->result();
	}
	public function find_by_club_slug($club_slug)
	{
		return $this->db->select('id, title, price, club_slug')
			->from('product')
			->where('club_slug', $club_slug)
			->where('status', 1)
			->order_by('price', 'ASC')
			->limit(1)
			->get()
			->row_array();
	}
	public function search_products($keyword)
	{
		$this->db->like('title', $keyword);
		$this->db->or_like('description', $keyword);
		$query = $this->db->get('product'); // bảng product
		return $query->result_array();
	}


	public function getProductsByCategories($category_ids = [])
	{
		if (empty($category_ids)) return [];
		$this->db->where_in('category_id', $category_ids);
		$query = $this->db->get('product');
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






	// Nếu bạn đã có CRUD thì có thể thêm các hàm khác như create, update, delete
}