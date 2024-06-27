<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Reservasi_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function getAllKlinik()
    {
        $this->db->from('tb_klinik');
        $query = $this->db->get(); 

        return $query->result();
    }

    function addAppointment($data)
    {
        $this->db->insert('tb_reservasi', $data);
    }

    function getAllReservasi()
    {
        $user_id = $this->session->userdata('user_id');

        $this->db->from('view_reservasi');
        $this->db->where('id_pasien', $user_id);
        $query = $this->db->get(); 

        return $query->result();
    }

    public function getKetCibadak()
    {
        $id_klinik = 1;

        $whereCondition = array(
            'klinik_id' => $id_klinik
        );

        $query = $this->db->select('jadwal')
                    ->where($whereCondition)
                    ->get('tb_jadwal');
        
        return $query->row()->jadwal;
    }
    public function getKetLembang()
    {
        $id_klinik = 2;

        $whereCondition = array(
            'klinik_id' => $id_klinik
        );

        $query = $this->db->select('jadwal')
                    ->where($whereCondition)
                    ->get('tb_jadwal');
        
        return $query->row()->jadwal;
    }
    public function getKetBojongsoang()
    {
        $id_klinik = 3;

        $whereCondition = array(
            'klinik_id' => $id_klinik
        );

        $query = $this->db->select('jadwal')
                    ->where($whereCondition)
                    ->get('tb_jadwal');
        
        return $query->row()->jadwal;
    }
}
