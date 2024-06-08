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
}
