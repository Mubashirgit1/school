<?php

class Staff_departments_model extends CI_Model
{
    public $table_name = "staff_departments";

    public function get($id = null){
        $this->db->select('*')
            ->from($this->table_name);

        if($id !== null){
            $this->db->where('id', $id);
        } else {
            $this->db->order_by('name', 'asc');
        }

        $q = $this->db->get();

        if($q->num_rows() > 0){
            if($id !== null){
                return $q->row_array();
            } else {
                return $q->result_array();
            }
        } else {
            return false;
        }
    }
}