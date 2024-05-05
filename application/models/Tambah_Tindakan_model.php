<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tambah_tindakan_model extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}

	public function getAllTindakan()
	{
		$this->db->from("tb_tindakan");
		return $this->db->get();
	}

	public function getTindakan($id_tindakan)
	{
		$this->db->where('id_tindakan', $id_tindakan);
		$this->db->select("*");
		$this->db->from("tb_tindakan");
		$query = $this->db->get();
		$res = $query->result();
		return $res[0];
	}

	public function addTindakan($data)
	{
		$this->db->insert('tb_tindakan', $data);
	}

    function deleteTindakan($condition)
	{
		$this->db->where($condition);
		$this->db->delete('tb_tindakan');
	}

	public function EditTindakan($data, $condition)
	{
		$this->db->where($condition);
		$this->db->update('tb_tindakan', $data);
	}

	function getAllKategoriTindakan()
	{
		$this->db->from('tb_kategori_tindakan');
		$query = $this->db->get();

		return $query->result();
	}

	public function getAllKategoriTindakanUpdate() {
        $this->db->select('tb_kategori_tindakan.*, tb_tindakan.tindakan, tb_tindakan.harga');
        $this->db->from('tb_kategori_tindakan');
        $this->db->join('tb_tindakan', 'tb_kategori_tindakan.id_kategori_tindakan = tb_tindakan.id_kategori_tindakan');
        $query = $this->db->get();
        return $query->result();
    }
} 

