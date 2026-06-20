<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Homework_model extends CI_Model {

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
    public function get($id = null,$teacher_id=null,$class_id=null,$section_id=null,$date=null) {
        $this->db->select('homework.*,classes.class,subjects.name as subject,sections.section as section_name,teachers.name as teacher')->from('homework');
        $this->db->join('classes', 'homework.class_id = classes.id', 'left outer');
        $this->db->join('subjects', 'homework.subject_id = subjects.id', 'left outer');
        $this->db->join('sections', 'homework.section_id = sections.id', 'left outer');
        $this->db->join('teachers', 'homework.teacher_id = teachers.id', 'left outer');
                
        if ($id != null) {
            $this->db->where('homework.id', $id);
        }
        if ($teacher_id != null) {
            $this->db->where('homework.teacher_id', $teacher_id);
        }
        if ($class_id != null) {
            $this->db->where('homework.class_id', $class_id);
        }
        if ($section_id != null) {
            $this->db->where('homework.section_id', $section_id);
        }
        if ($date != null) {
            $this->db->where('homework.date = ',   date("Y-m-d",strtotime($date)));
        }
        $this->db->order_by('homework.id', "desc");
//        $this->db->limit(10);
        $query = $this->db->get();
        if ($id != null) {
            return $query->row_array(); 
        } else {
            return $query->result_array(); 
        }
    }


    public function getListBySubject($class_id = null , $section_id = null) {
        $this->db->select('homework.*,subjects.name as subject')->from('homework');
        $this->db->join('classes', 'homework.class_id = classes.id', 'left outer');
        $this->db->join('sections', 'homework.section_id = sections.id', 'left outer');
        $this->db->join('subjects', 'homework.subject_id = subjects.id', 'left outer');
        if ($class_id != null) {
            $this->db->where('homework.class_id', $class_id);
        }
        if ($section_id != null) {
            $this->db->where('homework.section_id', $section_id);
        }
        $this->db->order_by('homework.subject_id');
        $this->db->group_by('homework.subject_id');
        $query = $this->db->get();
        return $query->result_array(); 
    }
    
     public function getListByDate($class_id = null , $section_id = null, $subject_id = null,$date=null ) {
        $this->db->select('homework.*,classes.class,subjects.name as subject,sections.section as section,teachers.name as teacher')->from('homework');
        $this->db->join('classes', 'homework.class_id = classes.id', 'left outer');
        $this->db->join('sections', 'homework.section_id = sections.id', 'left outer');
        $this->db->join('subjects', 'homework.subject_id = subjects.id', 'left outer');
        $this->db->join('teachers', 'homework.teacher_id = teachers.id', 'left outer');
        
        if ($class_id != null) {
            $this->db->where('homework.class_id', $class_id);
        }
        if ($section_id != null) {
            $this->db->where('homework.section_id', $section_id);
        }
        if ($subject_id != null) {
            $this->db->where('homework.subject_id', $subject_id);
        }
        if ($date != null) {
            $this->db->where('homework.date', $date);
        }
        $this->db->order_by('homework.date');
      
        $query = $this->db->get();
        return $query->result_array(); 
    }


    

    public function getListByCategory($category) {
        $this->db->select('homework.*,classes.class')->from('homework');
        $this->db->join('classes', 'homework.class_id = classes.id', 'left outer');
        $this->db->where('homework.type', $category);
        $this->db->order_by('homework.id');
        $query = $this->db->get();
        return $query->result_array(); 
    }

    public function getListByCategoryforUser($class_id, $category) {
        $query = "SELECT * FROM `homework` WHERE (class_id =$class_id and type='$category') or (is_public='yes' and type='$category')";
        $query = $this->db->query($query);
        return $query->result_array();
    }

    /**
     * This function will delete the record based on the id
     * @param $id
     */
    public function remove($id) {
        $this->db->where('id', $id);
        $this->db->delete('homework');
    }

    public function search_by_content_type($text) {
        $this->db->select()->from('homework');
        $this->db->or_like('homework.content_type', $text);
        $query = $this->db->get();
        return $query->result_array(); 
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
            $this->db->update('homework', $data); 
        } else {
            $this->db->insert('homework', $data); 
            return $this->db->insert_id();
        }
    }

}
