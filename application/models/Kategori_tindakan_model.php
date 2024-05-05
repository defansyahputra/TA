<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Kategori_tindakan_model extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}

	public function getAllKategori()
	{
		$this->db->from("tb_kategori_tindakan");
		return $this->db->get();
	}

	public function getKategori($id_kategori_tindakan)
	{
		$this->db->where('id_kategori_tindakan', $id_kategori_tindakan);
		$this->db->select("*");
		$this->db->from("tb_kategori_tindakan");
		$query = $this->db->get();
		$res = $query->result();
		return $res[0];
	}

	public function addKategori($data)
	{
		$this->db->insert('tb_kategori_tindakan', $data);
	}

    function deleteKategori($condition)
	{
		$this->db->where($condition);
		$this->db->delete('tb_kategori_tindakan');
	}

	public function EditKategori($data, $condition)
	{
		$this->db->where($condition);
		$this->db->update('tb_kategori_tindakan', $data);
	}
}
