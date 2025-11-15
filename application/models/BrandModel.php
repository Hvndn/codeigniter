<?php
class BrandModel extends CI_Model {


	public function insertBrand($data) {
		return $this->db->insert('brand',$data);
	}
	public function selectBrand() {
		$query = $this->db->get('brand');
		return $query->result();
	}
	public function selectBrandByID($id) {
		$query = $this->db->get_where('brand',['id'=>$id]);
		return $query->row();
	}
	public function updateBrand($id,$data){
		return $this->db->update('brand',$data,['id'=>$id]);
	}
	public function deleteBrand($id){
		return $this->db->delete('brand',['id'=>$id]);

	}

}
?>
