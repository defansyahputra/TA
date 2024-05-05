<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class User_web_list_model extends CI_Model
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

    function getUser($id)
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

	function updateUser($data, $condition)
	{
		$this->db->where($condition);
		$this->db->update('users', $data);
	}

	function updateUserProfile($custom, $condition)
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
}
