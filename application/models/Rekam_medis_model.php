<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Rekam_medis_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function getRekamMedis()
    {
      $user_id = $this->session->userdata('user_id');

      $this->db->from('rekamedis_view');
      $this->db->where('id_pasien', $user_id);
      $query = $this->db->get(); 

      return $query->result();
    }
}
