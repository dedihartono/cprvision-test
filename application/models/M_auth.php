<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_auth extends CI_Model 
{
	protected $table;

	public function __construct()
	{
		parent::__construct();
		
		$this->table = 'm_users';
    }
    
    public function cek_user($data) 
    {
        return $this->db->get_where($this->table, $data);
    }
}
