<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('email')) {
            redirect('auth');
        }
        $this->load->library('form_validation');
        $this->load->model('m_data');
        $this->load->helper('url');
    }

    /****************************************************HALAMAN DASBOARD***************************************************/
    public function index() //controller halaman dassboard
    {
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array(); //memanggil data tabel user yang sedang login

        $data['title'] = 'Dashboard'; //title halaman dasboard
        $this->load->model('m_data'); //memanggil model di file m_data
        $this->load->helper('url');
        $data['total'] = $this->m_data->jumlahclick(); //total data terdeksi mengantuk di datatabel2

        $this->load->view('admin/dashboard', $data); //ditampikan pada view dashboard dengan data
    }
    /****************************************************HALAMAN DATA TABEL***************************************************/
    public function Tabel2() //halaman tabel
    {
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->load->view('admin/tabel2', $data);
    }
    /****************************************************HALAMAN DATA GRAFIK***************************************************/
    public function grafik1() //halaman grafik
    {
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();



        $this->load->view('admin/grafik1', $data);
    }
    /****************************************************HALAMAN PENGGUNA***************************************************/
    public function Pengguna() //halaman pengguna
    {
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->load->view('admin/pengguna', $data);
    }
    public function tambah_pengguna() //halaman tambah pengguna
    {
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->load->view('admin/tambah_pengguna', $data);
    }
    public function prosestambah() //proses tambah pengguna
    {
        $data = array(
            'name' => $this->input->post('name'),
            'token' => $this->input->post('token'),
            'email' => $this->input->post('email'),
            'image' => 'default.jpg',
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'role_id' => $this->input->post('role_id'),
            'is_active' => 1,
            'date_created' => time()
        );
        $this->db->insert('user', $data);
        redirect('admin/pengguna');
    }
    function hapus($id) //hapus pengguna
    {
        $this->db->where('id', $id);
        $this->db->delete('user');

        redirect('admin/pengguna');
    }
    public function formEdit($id) // halaman edit pengguna data tertera
    {
        $data['user'] = $this->m_data->edit_pengguna($id);
        $this->load->view('admin/edit_pengguna', $data);
    }
    public function ubahdata() //edit pengguna
    {
        $this->m_data->updateData(); //update data tabel user
        redirect('admin/pengguna');
    }
    /****************************************************HALAMAN ABSEN***************************************************/

    public function absen2() //halaman absen
    {
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->load->model('m_data');
        $data['absen'] = $this->m_data->absen();
        $this->load->view('admin/absen2', $data);
    }

    function hapusabsen($id_absen) //hapus absen
    {
        $this->db->where('id_absen', $id_absen); //mengambil data berdasarkan id
        $this->db->delete('absen2'); // delete data

        redirect('admin/absen2'); //kembali kehalaman absen2
    }

    /****************************************************HALAMAN ABOUT***************************************************/
    public function About() //halaman about
    {
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->load->view('admin/about', $data);
    }
    /****************************************************HALAMAN EDIT MOBIL***************************************************/

    public function pengaturan_mobil() //halaman pengaturan mobil
    {
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        //mengambil data dari model dengan function mobil
        $this->load->view('admin/pengaturan_mobil', $data); //menampilkan data pada view pengaturan mobil
    }
    public function tambah_kamera() //halaman tambah kamera
    {
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->load->view('admin/tambah_kamera', $data);
    }
    public function prosestambah_kamera() //proses tambah pengguna
    {
        $data = array(
            'token' => $this->input->post('token'),
            'kamera' => $this->input->post('kamera'),
            'kendaraan' => $this->input->post('kendaraan'),
        );
        $this->db->insert('kendaraan', $data);
        redirect('admin/pengaturan_mobil');
    }

    function hapus_kamera($id_kendaraan) //hapus pengguna
    {
        $this->db->where('id_kendaraan', $id_kendaraan);
        $this->db->delete('kendaraan');

        redirect('admin/pengaturan_mobil');
    }
    public function formEdit_kamera($id_kendaraan) // halaman edit pengguna data tertera
    {
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['kamera'] = $this->m_data->edit_kamera($id_kendaraan);
        $this->load->view('admin/edit_kamera', $data);
    }
    public function ubahdata_kamera() //edit pengguna
    {
        $this->m_data->updateData_kamera(); //update data tabel user
        redirect('admin/pengaturan_mobil');
    }
    /****************************************************HALAMAN EDIT PROFIL***************************************************/
    public function profil()
    {
        $this->load->library('form_validation');
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->load->view('admin/profil', $data);
    }

    public function ubah_profil()
    {
        // $id = $this->uri->segment(3);
        $config['upload_path']         = './assets/img/';  // foler upload 
        $config['allowed_types']        = 'gif|jpg|png'; // jenis file
        // $config['max_size']             = 3000;
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('image')) //sesuai dengan name pada form 
        {
            echo 'anda belum upload';
        } else {
            //tampung data dari form
            $name = $this->input->post('name');
            $email = $this->input->post('email');
            $file = $this->upload->data();
            $image = $file['file_name'];

            $this->m_data->update(
                array(
                    'name' => $name,
                    'email' => $email,
                    'image' => $image
                ),
                array(
                    'id' => $this->input->post('id')
                )
            );
            $this->session->set_flashdata('msg', 'data berhasil di update');
            redirect('admin/index');
        }

        // $data['tampil'] = $this->m_data->get_by_id($id);
        // $this->load->view('admin/dashboard', $data);
    }
    /****************************************************HALAMAN EXPORT EXEL***************************************************/
    public function export_excel()
    {
        $token = $this->input->post('token');

        $this->db->select('*');
        $this->db->from('absen2');
        $this->db->join('datatabel2', 'datatabel2.tgl=absen2.tgl');
        $this->db->join('kendaraan', 'kendaraan.kendaraan=absen2.kendaraan');
        $this->db->join('data_id', 'data_id.token1=kendaraan.token');
        $this->db->where('token1', $token);
        $data = $this->db->get();

        require(APPPATH . 'PHPExcel-1.8/Classes/PHPExcel.php');
        require(APPPATH . 'PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php');

        $objPHPExcel = new PHPExcel();

        $objPHPExcel->getProperties()->setCreator("DETV"); //nama pembuat
        $objPHPExcel->getProperties()->setLastModifiedBy("DETV");
        $objPHPExcel->getProperties()->setTitle("Data Terdeteksi Mengantuk"); //Judul
        $objPHPExcel->getProperties()->setSubject("");
        $objPHPExcel->getProperties()->setDescription("");

        $objPHPExcel->getActiveSheet(0);
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'No');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Nama');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Role');
        $objPHPExcel->getActiveSheet()->setCellValue('D1', 'Kendaraan');
        $objPHPExcel->getActiveSheet()->setCellValue('E1', 'Waktu Terdeteksi');
        $baris = 2;
        $x = 1;

        foreach ($data->result_array() as $u) {
            $objPHPExcel->getActiveSheet()->setCellValue('A' . $baris, $x++);
            $objPHPExcel->getActiveSheet()->setCellValue('B' . $baris, $u['nama']);
            $objPHPExcel->getActiveSheet()->setCellValue('C' . $baris, $u['role']);
            $objPHPExcel->getActiveSheet()->setCellValue('D' . $baris, $u['kendaraan']);
            $objPHPExcel->getActiveSheet()->setCellValue('E' . $baris, $u['waktu']);
            $baris++;
        }
        $Filename = "Data-Terdeteksi-Mengantuk-Sampai-Tanggal." . date('d-m-Y') . '.xlsx';

        $objPHPExcel->getActiveSheet()->setTitle("Data Terdektsi Mengantuk");


        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $Filename . '"');
        header('Cache-Control: Max-age=0');

        $Writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $Writer->save('php://output');

        exit;
    }
    /****************************************************HAPUS DATA OTOMATIS test***************************************************/
    public function autoDeletion()
    {

        $lama = 30; // lama data yang tersimpan di database dan akan otomatis terhapus setelah 5 hari

        // proses untuk melakukan penghapusan data
        $this->load->database();
        $query = $this->db->query("DELETE FROM datatabel2 WHERE DATEDIFF(CURDATE(), tgl) > $lama");
    }
}
