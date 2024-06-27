<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Appointment_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function getAllAppointment()
    {
        $this->db->from('view_reservasi');
        $this->db->where('status', 0);
        $query = $this->db->get(); 

        return $query->result();
    }

    function deleteAppointment($condition)
	{
		$this->db->where($condition);
		$this->db->delete('tb_reservasi');
	}

    function updateAppointment($id_reservasi, $data)
    {
        $this->db->where('id_reservasi', $id_reservasi);
        return $this->db->update('tb_reservasi', $data);
    }

    function getAllKlinik()
    {
      $this->db->from('tb_klinik');
      $query = $this->db->get();

      return $query->result();
    }

    public function getAllJadwal()
    {
        $this->db->select('tb_jadwal.*, tb_klinik.klinik');
        $this->db->from('tb_jadwal');
        $this->db->join('tb_klinik', 'tb_jadwal.klinik_id = tb_klinik.id_klinik');
        $query = $this->db->get(); 

        return $query->result();
    }

    public function addJadwal($data)
	{
		$this->db->insert('tb_jadwal', $data);
	}

    public function getJadwal($id_jadwal)
    {
        $this->db->where('id_jadwal', $id_jadwal);
		$this->db->select("*");
		$this->db->from("tb_jadwal");
		$query = $this->db->get();
		$res = $query->result();
		return $res[0];
    }

    function updateJadwal($data, $condition)
	{
		$this->db->where($condition);
		$this->db->update('tb_jadwal', $data);
	}

    function deleteJadwal($condition)
	{
		$this->db->where($condition);
		$this->db->delete('tb_jadwal');
	}
}
