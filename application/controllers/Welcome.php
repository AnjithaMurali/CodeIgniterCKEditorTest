<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public $data;

	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url','form'));
		$this->load->library('form_validation');
		$this->load->library('ckeditor');
		$this->load->model('Content_model','content');
		$this->ckeditor->basePath = base_url().'assets/ckeditor/';
		$this->ckeditor->config['toolbar'] = array(
                array( 'Source', '-', 'Bold', 'Italic', 'Underline', '-','Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo','-','NumberedList','BulletedList' )
                                                    );
		$this->ckeditor->config['language'] = 'en';
		$this->ckeditor->config['width'] = '730px';
		$this->ckeditor->config['height'] = '300px';            

		//Add Ckfinder to Ckeditor
		//$this->ckfinder->SetupCKEditor($this->ckeditor,'../../asset/ckfinder/'); 		
	}

	public function index()
	{
		$insertStatus = 'false';
		$this->data['form_data'] = '';
		$this->data['inserted'] = false;
		$this->data['error_msg'] = '';

		if($this->input->post('Save'))
		{

			$arr_validate = array(
               array(
                     'field'   => 'content',
                     'label'   => 'content',
                     'rules'   => 'required'
				)            
           );

		   //$this->form_validation->set_rules($arr_validate); 
		   if ($this->form_validation->run() === TRUE)
		   {
			   	//echo $_POST;
			   	$arr_data = $_POST;
			    $arr_where = array('content' => $arr_data["content"]);
			    echo $arr_where;
			    $this->data['form_data'] = $arr_where;
			   	if($this->content->insert_data($arr_where)){
			   		$insertStatus = 'true';
			   		$this->data['inserted'] = true; 
			   	}
		   }
		   else{
		   		$this->data['error_msg']   = validation_errors();
		   }
		}
		$this->load->view('welcome_message', $this->data);
	}
}
