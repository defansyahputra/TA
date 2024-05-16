<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pasien_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function getAllPasien()
    {
    $this->db->select("*, users.id as id_user");
		$this->db->from("users");
		$this->db->join('user_profiles', 'users.id = user_profiles.id');

		return $this->db->get();
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

    function getAllKlinik()
    {
      $this->db->from('tb_klinik');
      $query = $this->db->get();

      return $query->result();
    }

    function getAllKategori()
    {
      $this->db->from('tb_kategori_tindakan');
      $query = $this->db->get();

      return $query->result();
    }

    function getAllTindakan()
    {
      $this->db->from('tb_tindakan');
      $query = $this->db->get();

      return $query->result();
    }
}
