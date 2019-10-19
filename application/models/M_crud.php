<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_crud extends CI_Model 
{
	protected $table;

	protected $data;

	protected $where;

	public function create($data, $table)
	{
		return $this->db->insert($data, $table);
	}

	public function read($table)
	{
		return $this->db->get($table);
	}

	public function update($where, $data, $table)
	{
		return $this->db->where($where)->update($data, $table);
	}

	public function delete($where, $table)
	{
		return $this->db->where($where)->delete($table);
	}

	public function read_by_id($where, $table)
	{

		return $this->db->where($where)->get($table);
	}

}
