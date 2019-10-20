<?php if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Product extends CI_Controller
{
    protected $layout;

    public function __construct()
    {
        parent::__construct();
        
        $this->layout = 'layouts/app';
    }
    
    public function index()
    {
        $data['content'] = 'product/v_product';
        $this->load->view($this->layout, $data);
    }
}
