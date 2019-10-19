<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_user extends CI_Model
{
    protected $table = 'm_users';
    protected $column_order = array(null, 'username', 'no_tlp', null,null);
    protected $column_search = array('id', 'username');
    protected $order = array('id' => 'asc');
    
    private function _get_datatables_query()
    {
        $this->db->from($this->table);
        $i = 0;
        
        if (isset($_POST['search'])) {
            foreach ($this->column_search as $item) {
                if ($_POST['search']['value']) {
                    if ($i===0) {
                        $this->db->group_start();
                        $this->db->like($item, $_POST['search']['value']);
                    } else {
                        $this->db->or_like($item, $_POST['search']['value']);
                    }
                    if (count($this->column_search) - 1 == $i) {
                        $this->db->group_end();
                    }
                }
                $i++;
            }
        }
        
        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } elseif (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
    
    public function get_datatables()
    {
        $this->_get_datatables_query();
        if (isset($_POST['length'])) {
            if ($_POST['length'] != -1) {
                $this->db->limit($_POST['length'], $_POST['start']);
            }
        }
        $query = $this->db->get();
        return $query->result();
    }
    
    public function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
    
    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
    
    public function get_by_id($id)
    {
        $this->db->from($this->table);
        $this->db->where('id', $id);
        return $this->db->get();
    }
    
    public function save($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
    
    public function update($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }
    
    public function delete_by_id($id)
    {
        $this->db->where('id', $id);
        $this->db->delete($this->table);
    }
}
