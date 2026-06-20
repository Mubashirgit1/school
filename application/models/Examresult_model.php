<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Examresult_model extends CI_Model {

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
    public function get($id = null) {
        $this->db->select()->from('exam_results');
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
	
	public function get2($id = null) {
        $this->db->select()->from('exam_results');
        if ($id != null) {
            $this->db->where('id', $id);
        } else {
            $this->db->order_by('id');
        }
        $query = $this->db->get();
        if ($id != null) {
            return $query->row_array(); 
        } else {
            return $query->row_array(); 
        }
    }

    /**
     * This function will delete the record based on the id
     * @param $id
     */
    public function remove($id) {
        $this->db->where('id', $id);
        $this->db->delete('exam_results');
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
            $this->db->update('exam_results', $data); 
        } else {
            $this->db->insert('exam_results', $data); 
            return $this->db->insert_id();
        }
    }

    function add_exam_result($data) {
		
        $this->db->where('exam_schedule_id', $data['exam_schedule_id']);
        $this->db->where('student_id', $data['student_id']);
        $q = $this->db->get('exam_results');
        $result = $q->row();
		
        if ($q->num_rows() > 0) {
            $this->db->where('id', $result->id);
			$this->db->where('total', $result->total);
			
            $this->db->update('exam_results', $data);
        } else 
		{
            $this->db->insert('exam_results', $data);
        }
		
    }

    public function get_exam_result($exam_schedule_id = null, $student_id = null) {
        $this->db->select()->from('exam_results');
        $this->db->where('exam_schedule_id', $exam_schedule_id);
        $this->db->where('student_id', $student_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row(); 
        } else {
            $obj = new stdClass();
            $obj->attendence = 'pre';
            $obj->get_marks = "0.00";
            return $obj;
        }
    }

    public function get_result($exam_schedule_id = null, $student_id = null) {
        $this->db->select()->from('exam_results');
        $this->db->where('exam_schedule_id', $exam_schedule_id);
        $this->db->where('student_id', $student_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
        }
    }
	
	  public function get_result_exam($exam_schedule_id = null) {
        $this->db->select()->from('exam_results');
        $this->db->where('exam_schedule_id', $exam_schedule_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
        }
    }
	
	
	  public function get_result2($student_id,$schedule_id) {
   
	 $this->db->select('*'); 
	 $this->db->where('total !=', 'NULL');
	 $this->db->where('exam_schedule_id IN (10,11)');
	 $this->db->order_by("total", "desc");
     $query = $this->db->get('exam_results');
	if ($query->num_rows() > 0) {
            return $query->result_array(); 
        } else {
			
        }
		
    }
	
	


    public function checkexamresultpreparebyexam($exam_id, $class_id, $section_id) {
        $query = $this->db->query("SELECT count(*) `counter` FROM `exam_results`,exam_schedules,student_session WHERE exam_results.exam_schedule_id=exam_schedules.id and student_session.student_id=exam_results.student_id and student_session.class_id=" . $this->db->escape($class_id) . " and student_session.section_id=" . $this->db->escape($section_id) . " and exam_schedules.session_id=" . $this->db->escape($this->current_session) . " and exam_schedules.exam_id=" . $this->db->escape($exam_id));
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
        return $query->result_array();
    }

}
