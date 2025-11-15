<?php
class CategoryModel extends CI_Model
{
	// Thêm danh mục
	public function insertCategory($data)
	{
		return $this->db->insert('category', $data);
	}

	// Lấy tất cả danh mục (OBJECT – giống ProductModel)
	public function selectCategory()
	{
		$query = $this->db->get('category');
		return $query->result(); // object
	}

	// Lấy danh mục theo ID (OBJECT)
	public function selectCategoryByID($id)
	{
		$query = $this->db->get_where('category', ['id' => $id]);
		return $query->row(); // object
	}

	// Cập nhật danh mục
	public function updateCategory($id, $data)
	{
		return $this->db->update('category', $data, ['id' => $id]);
	}

	// Xóa danh mục
	public function deleteCategory($id)
	{
		return $this->db->delete('category', ['id' => $id]);
	}

	// Lấy tất cả category (dùng cho header - ARRAY)
	public function getAllCategories()
	{
		$query = $this->db->get('category');
		return $query->result_array();
	}

	// Lấy category cha (ARRAY)
	public function getParentCategories()
	{
		return $this->db->get_where('category', ['parent_id' => NULL])->result_array();
	}

	// Lấy danh mục + tên danh mục cha (ARRAY – dùng JOIN)
	public function getAllCategoriesWithParent()
	{
		$this->db->select('c.*, p.title AS parent_title');
		$this->db->from('category c');
		$this->db->join('category p', 'c.parent_id = p.id', 'left');
		$query = $this->db->get();
		return $query->result_array();
	}

	// Lấy ID tất cả danh mục con của parent
	public function getChildCategoryIds($parent_id)
	{
		$this->db->select('id');
		$this->db->where('parent_id', $parent_id);
		$query = $this->db->get('category');
		return array_column($query->result_array(), 'id');
	}

	// Lấy tên danh mục bằng ID (trả về string)
	public function getCategoryTitle($id)
	{
		$query = $this->db->get_where('category', ['id' => $id]);
		$row = $query->row(); // object

		return $row ? $row->title : 'Danh mục không tồn tại';
	}
}
