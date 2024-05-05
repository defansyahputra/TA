<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pasien_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function getAllUser()
    {
        $this->db->select("*, users.id as id_user");
        $this->db->from("users");
        $this->db->join('user_profiles', 'users.id = user_profiles.id', 'left');

        return $this->db->get();
    }

    function getDataPasien($id)
    {
        $this->db->where('users.id', $id);
        $this->db->select("*");
        $this->db->from("users");
        $this->db->join('user_profiles', 'users.id = user_profiles.id', 'left');

        $query = $this->db->get();
        $res = $query->result();

        return $res[0];
    }

    function getPasien($id)
    {
        $this->db->where('users.id', $id);
        $this->db->select("*");
        $this->db->from("users");
        $this->db->join('user_profiles', 'users.id = user_profiles.id', 'left');

        $query = $this->db->get();
        $res = $query->result();

        return $res[0];
    }

    function getAllRoles()
    {
        $this->db->from("roles");

        return $this->db->get()->row();
    }

    function getRole()
    {
        $this->db->select('users.*, roles.role');
        $this->db->from('users');
        $this->db->join('user_roles', 'user_roles.user_id = users.id');
        $this->db->join('roles', 'roles.role_id = user_roles.role_id');
        return $this->db->get()->result();
    }

    function updatePasien($data, $condition)
    {
        $this->db->where($condition);
        $this->db->update('tb_rekamedis', $data);
    }

    function updatePasienProfile($custom, $condition)
    {
        $this->db->where($condition);
        $this->db->update('user_profiles', $custom);
    }

    function deleteUser($condition)
    {
        $this->db->where($condition);
        $this->db->delete('users');
    }
    function deleteUserProfiles($condition)
    {
        $this->db->where($condition);
        $this->db->delete('user_profiles');
    }

    public function addRekamMedis($custom, $condition)
    {
        $this->db->insert('tb_rekamedis', $data);
    }

    public function getAllDataRekamMedis()
	{
		$this->db->from("tb_rekamedis");
        $this->db->order_by('id_rekamedis', 'DESC');

		return $this->db->get();
	}
}
