<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run() === false) {

            $data['title'] = 'Login';

            $this->load->view('templates/auth_header', $data);

            $this->load->view('auth/login');

            $this->load->view('templates/auth_footer');
        } else {
            //validasi sukses
            $this->_login();
        }
    }
    private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();
        if ($user) {
            //usernya ada
            if ($user['is_active'] == 1) {
                //cek password

                if (password_verify($password, $user['password'])) {

                    $data = [
                        'email' => $user['email'],
                        'role_id' => $user['role_id']
                    ];

                    $this->session->set_userdata($data);
                    if ($user['role_id'] == 'admin') {
                        redirect('admin');
                    } else if ($user['role_id'] == 'mandor') {
                        redirect('mandor');
                    } else if ($user['role_id'] == 'supir') {
                        redirect('supir');
                    } else {
                        redirect('auth');
                    }
                } else {
                    $this->session->set_flashdata('massage', '<div class="alert alert-danger" role="alert">Wrong password</div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('massage', '<div class="alert alert-danger" role="alert"> This Email has not been activated</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('massage', '<div class="alert alert-danger" role="alert"> Email not register </div>');
            redirect('auth');
        }
    }

    public function registration()

    {
        $this->form_validation->set_rules('name', 'Name', 'required|trim');

        $this->form_validation->set_rules(
            'email',
            'Email',
            'required|trim|valid_email|is_unique[user.email]',
            [
                'is_unique' => 'This email has already register!'
            ]
        );

        $this->form_validation->set_rules(
            'password1',
            'Password',
            'required|trim|min_length[3]|matches[password2]',
            [
                'matches' => 'password dont match!',
                'min_length' => 'password too short!'
            ]
        );

        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Detv Registration';
            $this->load->view('templates/auth_header', $data);

            $this->load->view('auth/registration');

            $this->load->view('templates/auth_footer');
        } else {
            $email = $this->input->post('email', 'true');
            $acak = $token = base64_encode(random_bytes(32));
            $data = [
                'name' => $this->input->post('name', 'true'),
                'email' => htmlspecialchars($email),
                'image' => 'default.jpg',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => 'admin',
                // user aktif
                'is_active' => 0,
                'token' => $acak,
                'date_created' => time()

            ];

            $token = base64_encode(random_bytes(32));
            $user_token = [
                'email' => $email,
                'token' => $token,
                'date_created' => time()

            ];
            $data_id = [
                'email' => htmlspecialchars($email),
                'token1' => $acak
            ];



            $this->db->insert('user', $data);
            $this->db->insert('user_token', $user_token);
            $this->db->insert('data_id', $data_id);
            $this->_sendEmail($token, 'verify');


            $this->session->set_flashdata('massage', '<div class="alert alert-success" role="alert"> Succes has been created account. Silahkan Aktivasi akun </div>');
            redirect('auth');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');

        $this->session->set_flashdata('massage', '<div class="alert alert-success" role="alert"> You have been logged Out! </div>');
        redirect('auth');
    }

    /****************************************************HALAMAN Upload data***************************************************/
    public function uploadData()
    {
        $this->load->model('m_data');
        if (isset($_GET['gambar']) and isset($_GET['kamera'])) {
            echo "oke";
            $gambar = $this->input->get('gambar');
            $kamera = $this->input->get('kamera');
            $nilai = 1;

            $kamera = array(
                'gambar' => $gambar,
                'nilai' => $nilai,
                'kamera' => $kamera

            );

            $this->m_data->saveGambar($kamera);
        } else {
            echo "salah";
        }
    }
    private function _sendEmail($token, $type)
    {
        $config = [
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => '@email.com',
            'smtp_pass' => 'password',
            'smtp_port' => 465,
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n"
        ];
        $this->email->initialize($config);
        $this->email->from('detv.elektro@gmail.com', 'DETV');
        $this->email->to($this->input->post('email'));

        if ($type == 'verify') {
            $this->email->subject('Verifikasi Akun');
            $this->email->message('Klik link untuk verifikasi akun : <a href="' . base_url() . 'auth/verify?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Aktivasi</a>');
        } else if ($type == 'forgot') {
            $this->email->subject('Reset Password');
            $this->email->message('Klik link untuk reset password : <a href="' . base_url() . 'auth/resetpassword?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Reset Password</a>');
        }


        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }
    public function verify()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('user', ['email'])->row_array();
        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token'])->row_array();
            if ($user_token) {
                if (time() - $user_token['date_created'] < (60 * 60 * 24)) {

                    $this->db->set('is_active', 1);
                    $this->db->where('email', $email);
                    $this->db->update('user');

                    $this->db->delete('user_token', ['email => $email']);

                    $this->session->set_flashdata('massage', '<div class="alert alert-success" role="alert">' . $email . ' Akun telah teraktivasi! Silahkan Login</div>');
                    redirect('auth');
                } else {
                    $this->db->delete('user', ['email => $email']);
                    $this->db->delete('user_token', ['email => $email']);
                }
            } else {
                $this->session->set_flashdata('massage', '<div class="alert alert-danger" role="alert">Activasi Gagal! Token salah </div>');
                redirect('auth');
            }
        } else {

            $this->session->set_flashdata('massage', '<div class="alert alert-danger" role="alert">Activasi Gagal! Email salah </div>');
            redirect('auth');
        }
    }

    public function resetpassword()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();
        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();
            if ($user_token) {

                $this->session->set_userdata('reset_email', $email);
                $this->changePassword();
            } else {
                $this->session->set_flashdata('massage', '<div class="alert alert-danger" role="alert">Reset password gagal! Token salah </div>');
                redirect('auth');
            }
        } else {

            $this->session->set_flashdata('massage', '<div class="alert alert-danger" role="alert">Reset password gagal! Email salah </div>');
            redirect('auth');
        }
    }

    public function forgot_password()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Forgot Password';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/forgot_password');
            $this->load->view('templates/auth_footer');
        } else {
            $email = $this->input->post('email');
            $user = $this->db->get_where('user', ['email' => $email, 'is_active' => 1])->row_array();
            if ($user) {
                $token = base64_encode(random_bytes(32));
                $user_token = [
                    'email' => $email,
                    'token' => $token,
                    'date_created' => time()

                ];
                $this->db->insert('user_token', $user_token);
                $this->_sendEmail($token, 'forgot');
                $this->session->set_flashdata('massage', '<div class="alert alert-success" role="alert"> Cek email untuk reset password</div>');
                redirect('auth/forgot_password');
            } else {
                $this->session->set_flashdata('massage', '<div class="alert alert-danger" role="alert"> Email belum terdaftar! </div>');
                redirect('auth/forgot_password');
            }
        }
    }

    public function changePassword()
    {
        $this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[8]|matches[password2]');

        $this->form_validation->set_rules('password2', 'Repeat password', 'trim|required|min_length[8]|matches[password1]');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Ganti Password';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/change_password');
            $this->load->view('templates/auth_footer');
        } else {
            $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
            $email = $this->session->userdata('reset_email');

            $this->db->set('password', $password);
            $this->db->where('email', $email);
            $this->db->update('user');

            $this->session->unset_userdata('reset_email');
            $this->session->set_flashdata('massage', '<div class="alert alert-success" role="alert"> Password berhasil diubah </div>');
            redirect('auth');
        }
    }
}
