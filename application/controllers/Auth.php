<?php if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        
        $this->load->model(['m_auth']);

        $this->table = 'users';
    }
    
    public function index()
    {
        $this->load->view('auth/v_login');
    }
    
    public function login()
    {
        $data = array(
            'pin' => $this->input->post('pin', true)
        );
        
		$check = $this->m_auth->read_by_where($data);
		
        if ($check->num_rows() == 1) {
            foreach ($check->result() as $sess) {
                $sess_data['id'] 	= $sess->id;
                $sess_data['pin'] 	= $sess->pin;
                $this->session->set_userdata($sess_data);
            }
            $msg="<script>alert('Login as $sess->pin')</script>";
            $this->session->set_flashdata("msg", $msg);
            redirect('product');
        } else {
            $msg="<script>alert('Sorry! Your PIN is wrong!')</script>";
            $this->session->set_flashdata("msg", $msg);
            redirect('/');
        }
    }
    
    public function logout()
    {
        $this->session->sess_destroy();
        redirect("/");
    }
}
