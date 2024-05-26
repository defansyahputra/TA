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
        $query = $this->db->get(); 

        return $query->result();
    }

    function deleteAppointment($condition)
	{
		$this->db->where($condition);
		$this->db->delete('tb_reservasi');
	}
}
