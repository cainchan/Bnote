<?php
class Notebookmodel extends CI_Model {

    public function __construct(){
        $this->load->database();
        $this->tableName = 'notebooks';
    }
    public function getAll($criteria=''){
    	if (!empty($criteria['orderby'])){
    		$this->db->order_by($criteria['orderby']);
    		unset($criteria['orderby']);
    	}
    	if (!empty($criteria['limit'])){
    		$limit = $criteria['limit'];
    		$offset = $criteria['offset'];
    		unset($criteria['limit']);
    		unset($criteria['offset']);
    		if (!empty($criteria)){
    			$this->db->where($criteria);
    		}
    		return $this->db->get($this->tableName,$offset,$limit)->result_array();
    	}
		if (!empty($criteria)){
			$this->db->where($criteria);
		}
		return $this->db->get($this->tableName)->result_array();
	}
	public function getTotal($criteria){
		if (!empty($criteria)){
			$this->db->where($criteria);
			return $this->db->count_all_results($this->tableName);
		}
		return $this->db->count_all($this->tableName);
	}
	public function getOne($criteria){
		if (is_numeric($criteria)){
			$criteria = ['id' => $criteria];
		}
		return $this->db->get_where($this->tableName, $criteria)->first_row('array');
	}
	public function add($data){
        return $this->db->insert($this->tableName,$data);
    }
    public function edit($id,$data){
        $criteria = ['id' => $id];
        $data['updated_at'] = DATE('Y-m-d H:i:s');
        return $this->db->update($this->tableName,$data,$criteria);
    }
    public function delete($id){
        $criteria = ['id' => $id];
        return $this->db->delete($this->tableName,$criteria);
    }
}