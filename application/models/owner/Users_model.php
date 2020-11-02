<?php
class Users_model extends CI_Model
{

	public function getRows($params = array()){

		$this->db->select('*');
		$this->db->from('user_system a');
		$this->db->join('roles b','a.id_role=b.id_role');
		if(!empty($params['search']['keywords'])){
			$this->db->like('a.fullname',$params['search']['keywords']);
		}
		//sort data by ascending or desceding order
		if(!empty($params['search']['sortBy'])){
			$this->db->order_by('a.fullname',$params['search']['sortBy']);
		}else{
			$this->db->order_by('a.fullname','DESC');
		}
		//set start and limit
		if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
			$this->db->limit($params['limit'],$params['start']);
		}elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
			$this->db->limit($params['limit']);
		}
		//get records
		$query = $this->db->get();
		//return fetched data
		return ($query->num_rows() > 0)?$query->result_array():FALSE;
	}

	public function getRoles()
	{
		$this->db->select('*');
		$this->db->from('roles');
		return $this->db->get();
	}

	public function insertuser()
	{
		$datauser['fullname']      = $this->input->post('ifullname');
		$datauser['email']         = $this->input->post('iemail');
		$datauser['username']      = $this->input->post('iusername');
		$datauser['password']      = get_hash($this->input->post('ipassword'));
		$datauser['address']       = $this->input->post('iaddress');
		$datauser['no_telp']       = $this->input->post('itelp');
		$datauser['is_active']     = "1";
		$datauser['created_date']  = $this->input->post('icreated_date');
		$datauser['id_role']       = $this->input->post('selposition');
		$this->db->insert('user_system', $datauser);  
	}

	public function getDetailUser($user_id)
	{
		$this->db->select('*');
		$this->db->from('user_system a');
		$this->db->join('roles b','a.id_role=b.id_role');
		$this->db->where('a.user_id',$user_id);
		return $this->db->get();

	}

	public function saveupdateuser()
	{
		$userID                    = $this->input->post('iuser_id');
		$datauser['fullname']      = $this->input->post('ifullname');
		$datauser['email']         = $this->input->post('iemail');
		$datauser['username']      = $this->input->post('iusername');
		//$datauser['password']      = get_hash($this->input->post('ipassword'));
		$datauser['address']       = $this->input->post('iaddress');
		$datauser['no_telp']       = $this->input->post('itelp');
		$datauser['is_active']     = $this->input->post('istatus');
		$datauser['created_date']  = $this->input->post('icreated_date');
		$datauser['id_role']       = $this->input->post('selposition');
		return $this->db->update('user_system', $datauser, array('user_id' => $userID));  
	}

	public function deluser($user_id)
	{
		return $this->db->delete('user_system', array("user_id" => $user_id));
	}
}

