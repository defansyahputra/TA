<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pengaturan_klinik_model extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}

	public function getAllKlinik()
	{
		$this->db->from("tb_klinik");
		return $this->db->get();
	}

	public function getKlinik($id_klinik)
	{
		$this->db->where('id_klinik', $id_klinik);
		$this->db->select("*");
		$this->db->from("tb_klinik");
		$query = $this->db->get();
		$res = $query->result();
		return $res[0];
	}

	public function addKlinik ($data)
	{
		$this->db->insert('tb_klinik', $data);
	}

    function deleteKlinik($condition)
	{
		$this->db->where($condition);
		$this->db->delete('tb_klinik');
	}

	public function EditKlinik($data, $condition)
	{
		$this->db->where($condition);
		$this->db->update('tb_klinik', $data);
	}
}
