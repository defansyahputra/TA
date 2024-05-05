<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Kategori_produk_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	public function getAllKategori()
	{
		$this->db->from("tb_kategori_produk");

		return $this->db->get();
	}

    public function getKategori($id_kategori_produk)
    {
        $this->db->where('id_kategori_produk', $id_kategori_produk);
        $this->db->select('*');
        $this->db->from('tb_kategori_produk');

        $query = $this->db->get();
        $res = $query->result();
        return $res[0];
    }

    public function addKategori($data)
    {
        $this->db->insert('tb_kategori_produk', $data);
    }

	public function updateKategori($data, $condition)
	{
		$this->db->where($condition);
		$this->db->update('tb_kategori_produk', $data);
	}

	public function deleteKategori($condition)
	{
		$this->db->where($condition);
		$this->db->delete('tb_kategori_produk');
	}
}
