<?php if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['m_auth']);

        $this->table = 'm_users';
    }
    
    public function index()
    {
        $this->load->view('auth/v_login');
    }
    
    public function cek_login()
    {
        $data = array(
            'username' => $this->input->post('username', true),
            'password' => md5($this->input->post('password', true))
		);
		
        $check = $this->m_auth->cek_user($data);
        if ($check->num_rows() == 1) {
            foreach ($check->result() as $sess) {
                $sess_data['id'] 	= $sess->id;
                $sess_data['username'] 	= $sess->username;
                $sess_data['pengguna'] 	= $sess->pengguna;
                $sess_data['hak_akses'] = $sess->hak_akses;
                $sess_data['no_tlp'] 	= $sess->no_tlp;
                
                $this->session->set_userdata($sess_data);
            }
            if ($this->session->userdata('hak_akses') == '1') {
                $msg="<script>alert('Login Sebagai $sess->username')</script>";
                $this->session->set_flashdata("pesan", $msg);
                redirect('dashboard');
            } elseif ($this->session->userdata('hak_akses') == '2') {
                $msg="<script>alert('Login Sebagai $sess->username')</script>";
                $this->session->set_flashdata("pesan", $msg);
                redirect('dashboard');
            } else {
                $msg="<script>alert('Anda tidak mempunyai hak akses')</script>";
                $this->session->set_flashdata("pesan", $msg);
                redirect('/');
            }
        } else {
            $msg="<script>alert('Maaf! Username dan Password anda Salah')</script>";
            $this->session->set_flashdata("pesan", $msg);
            redirect('/');
        }
    }
    
    public function logout()
    {
        $this->session->sess_destroy();
        redirect("/");
    }
}
