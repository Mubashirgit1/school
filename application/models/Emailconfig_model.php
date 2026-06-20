<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Emailconfig_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get($id = null) {
        $this->db->select()->from('email_config');
        if ($id != null) {
            $this->db->where('id', $id);
        } else {
            $this->db->order_by('id');
        }
        $query = $this->db->get();
        if ($id != null) {
            return $query->row_array();
        } else {
            return $query->result();
        }
    }

    public function get_emailbytype($email_type) {
        $this->db->select()->from('email_config');
        $this->db->where('email_type', $email_type);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function update_emailconfig($email_type) {
		$data = array(
			'smtp_username' => $this->input->post('smtp_username'),			
			'smtp_password' => $this->input->post('smtp_password')				
		);	
				
		$this->db->where('email_type', $email_type);
		$this->db->update('email_config', $data); 
    }

    public function getActiveEmail() {
        $this->db->select()->from('email_config');
        $this->db->where('is_active', 'enabled');
        $query = $this->db->get();
        return $query->row();
    }

}
