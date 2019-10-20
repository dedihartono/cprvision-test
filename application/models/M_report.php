<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_report extends CI_Model
{
    protected $table = 't_submission';
    protected $column_order = array(null, 'created_at','m_product.name', 'quantity','users.pin');
    protected $column_search = array('m_product.name','users.pin');
    protected $order = array('t_submission.id' => 'desc');
    
    private function _get_datatables_query()
    {
        if ($this->input->post('from_date')) {
            $this->db->where('created_at >=', $this->input->post('from_date'));
        }
        if ($this->input->post('to_date')) {
            $this->db->where('created_at <=', $this->input->post('to_date'));
        }
        $this->db->from($this->table);
        $this->db->join('m_product', $this->table.'.product_id = m_product.id', 'left');
        $this->db->join('users', $this->table.'.user_id = users.id', 'left');
        
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
}
