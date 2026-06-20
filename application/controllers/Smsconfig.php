<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class smsconfig extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('file');
        $this->lang->load('message', 'english');
    }

    function index() {
        $this->session->set_userdata('top_menu', 'System Settings');
        $this->session->set_userdata('sub_menu', 'smsconfig/index');
        $data['title'] = 'SMS Config List';
        $sms_result = $this->smsconfig_model->get();
        $data['statuslist'] = $this->customlib->getStatus();
        $data['smslist'] = $sms_result;
        $this->load->view('layout/header', $data);
        $this->load->view('smsconfig/smsList', $data);
        $this->load->view('layout/footer', $data);
    }


    public function clickatell() {

        $this->form_validation->set_error_delimiters('', '');

        $this->form_validation->set_rules('clickatell_user', 'Username', 'required');
        $this->form_validation->set_rules('clickatell_password', 'Password', 'required');
        $this->form_validation->set_rules('clickatell_api_id', 'Api ID', 'required');



        if ($this->form_validation->run()) {

         $data=array(
            'type'=>'clickatell',
            'username'=>$this->input->post('clickatell_user'),
            'password'=>$this->input->post('clickatell_password'),
            'api_id'=>$this->input->post('clickatell_api_id'),
            'is_active'=>$this->input->post('clickatell_status'),
            );
         $this->smsconfig_model->add($data);
         echo json_encode(array('st'=>0, 'msg' =>"success"));

     } else {

        $data = array(
            'clickatell_user' => form_error('clickatell_user'),
            'clickatell_password' => form_error('clickatell_password'),
            'clickatell_api_id' => form_error('clickatell_api_id')
            );

        echo json_encode(array('st'=>1, 'msg' =>$data));
    }

}



public function twilio() {

    $this->form_validation->set_error_delimiters('', '');

    $this->form_validation->set_rules('twilio_account_sid', 'Account ID', 'required');
    $this->form_validation->set_rules('twilio_auth_token', 'Auth Token', 'required');
    $this->form_validation->set_rules('twilio_sender_phone_number', 'Phone Number', 'required');

    if ($this->form_validation->run()) {

     $data=array(
        'type'=>'twilio',
        'api_id'=>$this->input->post('twilio_account_sid'),
        'password'=>$this->input->post('twilio_auth_token'),
        'contact'=>$this->input->post('twilio_sender_phone_number'),
        'is_active'=>$this->input->post('twilio_status')
        );
     $this->smsconfig_model->add($data);
     echo json_encode(array('st'=>0, 'msg' =>"success"));

 } else {

    $data = array(
        'twilio_account_sid' => form_error('twilio_account_sid'),
        'twilio_auth_token' => form_error('twilio_auth_token'),
        'twilio_sender_phone_number' => form_error('twilio_sender_phone_number')
        );

    echo json_encode(array('st'=>1, 'msg' =>$data));
}

}


public function custom() {

    $this->form_validation->set_error_delimiters('', '');

    $this->form_validation->set_rules('name', 'Name', 'required');
    $this->form_validation->set_rules('username', 'Username', 'required');
    $this->form_validation->set_rules('password', 'Password', 'required');
    $this->form_validation->set_rules('url', 'URL', 'required');

    if ($this->form_validation->run()) {

     $data=array(
        'type'=>'custom',
        'name'=>$this->input->post('name'),
        'username'=>$this->input->post('username'),
        'password'=>$this->input->post('password'),
        'url'=>$this->input->post('url'),
        'is_active'=>$this->input->post('custom_status')
        );
     $this->smsconfig_model->add($data);
     echo json_encode(array('st'=>0, 'msg' =>"success"));

 } else {

    $data = array(
        'name' => form_error('name'),
        'username' => form_error('username'),
        'password' => form_error('password'),
        'url' => form_error('url')

        );

    echo json_encode(array('st'=>1, 'msg' =>$data));
}

}






}

?>