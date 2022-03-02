<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_data extends CI_Model
{
    /***************************************MODEL HALAMAN PENGGUNA**************************************************** */
    function pengguna()
    {
        return $this->db->get('user')->result_array(); //mengambil data tabel user
    }
    public function edit_pengguna($id)
    {
        return $this->db->get_where('user', ['id' => $id])->row_array(); //mengambil data tabel user berdasarkan id
    }
    public function updateData()
    {
        $data = [
            "name" => $this->input->post('name', true),
            "email" => $this->input->post('email', true),
            "password" => $this->input->post('password', true),
            "role_id" => $this->input->post('role_id', true)
        ];
        $this->db->where('id', $this->input->post('id')); //update data berdasarkan id
        $this->db->update('user', $data); //update data ke tabel user berdasarkan id
    }
    /***************************************MODEL HALAMAN DASBOARD**************************************************** */
    public function jumlahclick()
    {
        $tanggal = date('Y-m-d');
        $this->db->select_sum('nilai'); //mengambil variabel nilai sebagai penjumlahaan
        $this->db->where('tgl', $tanggal);
        $query = $this->db->get('datatabel2'); //mengambil data tabel2
        if ($query->num_rows() > 0) {
            return $query->row()->nilai; //query terhadap nilai
        } else {
            return 0;
        }
    }
    /***************************************MODEL HALAMAN KEHADIRAN**************************************************** */
    function absen()
    {
        return $this->db->get('absen2')->result_array(); //mengambil data dari tabel absen 1
    }
    public function edit_kamera($id_kendaraan) //edit kamera
    {
        return $this->db->get_where('kendaraan', ['id_kendaraan' => $id_kendaraan])->row_array(); //mengambil data berdasarkan tabel kendaraan id
    }
    public function updateData_kamera() //update kendaraan
    {
        $data = [
            "kamera" => $this->input->post('kamera', true), //input data kamera series
            "kendaraan" => $this->input->post('kendaraan', true), //input data kendaraan 
        ];
        $this->db->where('id_kendaraan', $this->input->post('id_kendaraan')); //input data berdasarkan id
        $this->db->update('kendaraan', $data); //update ke tabel kendaraan
    }
    public function updateData_profil() //update kendaraan
    {
        $data = [
            "name" => $this->input->post('name', true), //input data kamera series
            "email" => $this->input->post('email', true), //input data kendaraan 
            "image" => $this->input->post('image', true)
        ];
        $this->db->where('email', $this->input->post('email')); //input data berdasarkan id
        $this->db->update('user', $data); //update ke tabel kendaraan
    }
    /***************************************MODEL HALAMAN EDIT kehadira**************************************************** */
    public function kehadiran()
    {
        return $this->db->get('kendaraan')->result_array(); //mengambil data dari tabel absen 1
    }
    /***************************************MODEL HALAMAN Upload data**************************************************** */
    function save($datasensor)
    {
        $this->db->insert('datatabel2', $datasensor);
        return TRUE;
    }

    function saveGambar($kamera)
    {
        $this->db->insert('datatabel2', $kamera);
        return TRUE;
    }

    function ambildata()
    {
        $this->db->select('*');
        $this->db->from('datatabel2');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }
    /***************************************MODEL HALAMAN Edit Profil**************************************************** */
    public function tampil()
    {
        return $this->db->get('user')->result();
    }
    public function insert($data)
    {
        $this->db->insert('user', $data);
    }
    public function update($data, $where)
    {
        // $this->db->where($id);
        $this->db->update('user', $data, $where);
    }
    public function get_by_id($id)
    {
        return $this->db->get_where('user', array('id' => $id))->row();
    }
}
