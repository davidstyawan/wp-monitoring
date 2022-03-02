<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Supir extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('email')) {
            redirect('auth');
        }
    }
    public function index()
    {
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->load->model('m_data'); //memanggil model di file m_data
        $this->load->helper('url');
        $data['total'] = $this->m_data->jumlahclick(); //total data terdeksi mengantuk di datatabel2

        $this->load->view('supir/dashboard', $data);
    }
    public function absen2()
    {
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->load->model('m_data');
        $this->load->helper('url');
        $data['kamera'] = $this->m_data->kehadiran();
        $this->load->view('supir/absen2', $data);
    }
    public function cam2()
    {
        $data = array(
            'nama' => $this->input->post('nama'),
            'tgl' => $this->input->post('tgl'),
            'tgl1' => $this->input->post('tgl1'),
            'role' => 'Supir',
            'kendaraan' => $this->input->post('kendaraan'),
            'masuk' => $this->input->post('masuk')

        );
        $this->db->insert('absen2', $data);
        redirect('supir/index');
    }
}
