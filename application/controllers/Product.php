<?php if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Product extends CI_Controller
{
	protected $layout;

	protected $table;
	
	protected $user_id;

	protected $date;

    public function __construct()
    {
		parent::__construct();
		
		$this->load->model(['m_crud']);

		$this->table = 'm_product';
        
		$this->layout = 'layouts/app';
		$this->user_id = $this->session->userdata('id');
		$this->date = date('Y-m-d H:i:s');
    }
    
    public function index()
    {
		$data['product'] = $this->m_crud->read($this->table)->result();
		$data['content'] = 'product/v_product';

        $this->load->view($this->layout, $data);
	}

	public function save()
	{
		$data = [];

		$id = $this->input->post('id');
		$quantity = $this->input->post('quantity');
		
		foreach ($id as $key => $value) {
			$data[$key]['product_id'] = $value;
			$data[$key]['user_id'] = $this->user_id;
			$data[$key]['created_at'] = $this->date;
			$data[$key]['quantity'] = $quantity[$key];
		}

		$this->db->insert_batch('t_submission', $data);

		echo json_encode(['status'=>'success', 'message'=>'Submit Sucess!']);
	}

}
