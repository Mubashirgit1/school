<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class emailconfig extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('file');
        $this->lang->load('message', 'english');
    }

    function index() {
        $this->session->set_userdata('top_menu', 'System Settings');
        $this->session->set_userdata('sub_menu', 'emailconfig/index');
        $data['title'] = 'Email Config List';
        $data['emaillist'] = $this->emailconfig_model->get_emailbytype('SMTP');
        $this->load->view('layout/header', $data);
        $this->load->view('emailconfig/emailList', $data);
        $this->load->view('layout/footer', $data);
    }

    public function update() {
		$this->form_validation->set_rules('smtp_username', 'SMTP Username', 'required');
		$this->form_validation->set_rules('smtp_password', 'SMTP Password', 'required');				
	
		if ($this->form_validation->run() === FALSE)
		{
			$data['title'] = 'Email Config List';
			$data['emaillist'] = $this->emailconfig_model->get_emailbytype('SMTP');
			$this->load->view('layout/header', $data);
			$this->load->view('emailconfig/emailList', $data);
			$this->load->view('layout/footer', $data);
		}
		else
		{
			$data['title'] = 'Email Config List';
			$this->emailconfig_model->update_emailconfig('SMTP');
			$data['emaillist'] = $this->emailconfig_model->get_emailbytype('SMTP');
			$this->session->set_flashdata('msg', '<div class="alert alert-success">Record Updated Successfully</div>');
			redirect('emailconfig');
		}

    }

}

?>