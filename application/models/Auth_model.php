<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth_model extends CI_Model
{
    public $table       = 'user_system';
    public $id          = 'user_system.user_id';

    public function __construct()
    {
        parent::__construct();
    }
    public function update($data, $id)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
        return $this->db->affected_rows();
    }
    
    public function get_by_id()
    {
        $id = $this->session->userdata('user_id');
        $this->db->select('
            user_system.*, roles.id_role, roles.name, roles.description,
            ');
        $this->db->join('roles', 'user_system.id_role = roles.id_role');
        $this->db->from($this->table);
        $this->db->where($this->id, $id);
        $query = $this->db->get();

        return $query->row();
    }

    public function login($email, $password)
    {
        $query = $this->db->get_where('user_system', array('email'=>$email, 'password'=>$password));
        return $query->row_array();
    }

    public function check_account($email)
    {
        //cari email lalu lakukan validasi
        $this->db->where('email', $email);
        $query = $this->db->get($this->table)->row();

        //jika bernilai 1 maka user tidak ditemukan
        if (!$query) {
            return 1;
        }
        //jika bernilai 2 maka user tidak aktif
        if ($query->is_active == 0) {
            return 2;
        }
        //jika bernilai 3 maka password salah
        if (!hash_verified($this->input->post('password'), $query->password)) {
            return 3;
        }

        return $query;
    }

    public function logout($date, $id)
    {
        //$this->db->where('user_system.user_id', $id);
        //$this->db->update('user_system', $date);
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $date);
    }
}
