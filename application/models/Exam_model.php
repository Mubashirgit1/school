<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Exam_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->current_session = $this->setting_model->getCurrentSession();
    }

    /**
     * This funtion takes id as a parameter and will fetch the record.
     * If id is not provided, then it will fetch all the records form the table.
     * @param int $id
     * @return mixed
     */
    public function get($id = null , $session_id = null) {

        $this->db->select()->from('exams');
        if ($id != null) {
            $this->db->where('id', $id);
        } else {
            $this->db->order_by('id');
        }
        if(!empty($session_id)){
            $this->db->where('session_id',$session_id);
        }
        
        $query = $this->db->get();
        if ($id != null) {
            return $query->row_array();
        } else {
            return $query->result_array();
        }
    }

    public function get_ranking($id = null ) {

        $this->db->select()->from('ranking');
        if ($id != null) {
            $this->db->where('id', $id);
        } else {
            $this->db->order_by('id');
        }
        
        $query = $this->db->get();
        if ($id != null) {
            return $query->row_array();
        } else {
            return $query->result_array();
        }
    }
    public function get_exam_ranking($rank_id = null ,$student_id = null , $exam_id) {
        $this->db->select()->from('tbl_rating');
        $this->db->where('student_id', $student_id);
        $this->db->where('rank_id', $rank_id);
        $this->db->where('exam_id', $exam_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row(); 
        } else {
            $obj = new stdClass();
            $obj->rank_id = null;
            $obj->rating = 0;
            return $obj;
        }
    }
    /**
     * This function will delete the record based on the id
     * @param $id
     */
    public function remove($id) {
        $this->db->where('id', $id);
        $this->db->delete('exams');
    }

    /**
     * This function will take the post data passed from the controller
     * If id is present, then it will do an update
     * else an insert. One function doing both add and edit.
     * @param $data
     */
    public function add($data) {
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('exams', $data); 
        } else {
            $this->db->insert('exams', $data); 
            return $this->db->insert_id();
        }
    }

    function add_exam_schedule($data) {       
        $this->db->where('exam_id', $data['exam_id']);
        $this->db->where('teacher_subject_id', $data['teacher_subject_id']);
        $q = $this->db->get('exam_schedules');
        if ($q->num_rows() > 0) {
            $result = $q->row_array();
            $this->db->where('id', $result['id']);
            $this->db->update('exam_schedules', $data);
        } else {
            $this->db->insert('exam_schedules', $data);
        }
    }

}
