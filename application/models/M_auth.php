<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_auth extends CI_Model 
{
	protected $table;

	public function __construct()
	{
		parent::__construct();
		
		$this->table = 'users';
    }
    
    public function read_by_where($data) 
    {
        return $this->db->get_where($this->table, $data);
    }
}
