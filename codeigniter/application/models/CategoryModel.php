<?php
class CategoryModel extends CI_Model {


	public function insertCategory($data) {
		return $this->db->insert('category',$data);
	}
	public function selectCategory() {
		$query = $this->db->get('category');
		return $query->result();
	}
	public function selectCategoryByID($id) {
		$query = $this->db->get_where('category',['id'=>$id]);
		return $query->row();
	}
	public function updateCategory($id,$data){
		return $this->db->update('category',$data,['id'=>$id]);
	}
	public function deleteCategory($id){
		return $this->db->delete('category',['id'=>$id]);

	}

}
?>
