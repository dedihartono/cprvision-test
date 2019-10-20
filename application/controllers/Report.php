<?php if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Report extends CI_Controller
{
    protected $layout;

    public function __construct()
    {
        parent::__construct();
        
        $this->load->model(['m_report']);
        
        $this->layout = 'layouts/app';
    }
    
    public function index()
    {
        $data['content'] = 'report/v_report';
        $this->load->view($this->layout, $data);
    }
    
    public function ajax_list()
    {
        $lists = $this->m_report->get_datatables();
        
        $data = array();
        
        $no = isset($_POST['start']) ? $_POST['start'] : 0;
        
        foreach ($lists as $list) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $list->created_at;
            $row[] = $list->name;
            $row[] = $list->quantity;
            $row[] = $list->pin;
            $data[] = $row;
        }
        $output = array(
                        "draw" => isset($_POST['draw']) ? $_POST['draw'] : '',
                        "recordsTotal" => $this->m_report->count_all(),
                        "recordsFiltered" => $this->m_report->count_filtered(),
                        "data" => $data,
                    );
        echo json_encode($output);
    }
}
