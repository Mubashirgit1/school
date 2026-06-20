<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Paymentsetting_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * This funtion takes id as a parameter and will fetch the record.
     * If id is not provided, then it will fetch all the records form the table.
     * @param int $id
     * @return mixed
     */
    public function get() {
        $this->db->select()->from('payment_settings');
        $query = $this->db->get();
        return $query->row();
    }

    public function add($data) {
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('payment_settings', $data);
        } else {
            $this->db->insert('payment_settings', $data);
        }
    }

}
