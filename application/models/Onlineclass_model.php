<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Onlineclass_model extends CI_Model {

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
    public function get($id = null,$teacher_id=null,$class_id=null,$section_id=null,$date= null, $subject_id=null) {
        $this->db->select('onlineclass.*,classes.class,subjects.name as subject,sections.section as section_name,teachers.name as teacher')->from('onlineclass');
        $this->db->join('classes', 'onlineclass.class_id = classes.id', 'left outer');
        $this->db->join('subjects', 'onlineclass.subject_id = subjects.id', 'left outer');
        $this->db->join('sections', 'onlineclass.section_id = sections.id', 'left outer');
        $this->db->join('teachers', 'onlineclass.teacher_id = teachers.id', 'left outer');
                
        if ($id != null) {
            $this->db->where('onlineclass.id', $id);
        }
        if ($teacher_id != null) {
            $this->db->where('onlineclass.teacher_id', $teacher_id);
        }
        if ($class_id != null) {
            $this->db->where('onlineclass.class_id', $class_id);
        }
        if ($section_id != null) {
            $this->db->where('onlineclass.section_id', $section_id);
        }
        if ($subject_id != null) {
            $this->db->where('onlineclass.subject_id', $subject_id);
        }
        if ($date != null) {
            $this->db->where('onlineclass.date',  $date);
        }
        $this->db->order_by('onlineclass.id', "desc");
//        $this->db->limit(10);
        $query = $this->db->get();
        
        if ($id != null) {
            return $query->row_array(); 
        } else {
            return $query->result_array(); 
        }
    }
    
    
    public function getAllSubjects($date,$class_id,$section_id){
        $this->db->select("subjects.*");
        $this->db->where("onlineclass.class_id", $class_id);
        $this->db->where("onlineclass.section_id", $section_id);
        $this->db->where("onlineclass.date", $date);
        $this->db->join("onlineclass", "onlineclass.subject_id=subjects.id", "left");
        $this->db->group_by("subjects.id");
        $q = $this->db->get("subjects");
        return $q->result_array();
    }

    public function getListByCategory($category) {
        $this->db->select('onlineclass.*,classes.class')->from('onlineclass');
        $this->db->join('classes', 'onlineclass.class_id = classes.id', 'left outer');
        $this->db->where('onlineclass.type', $category);
        $this->db->order_by('onlineclass.id');  
        $query = $this->db->get();
        return $query->result_array(); 
    }

    public function getListByCategoryforUser($class_id, $category) {
        $query = "SELECT * FROM `onlineclass` WHERE (class_id =$class_id and type='$category') or (is_public='yes' and type='$category')";
        $query = $this->db->query($query);
        return $query->result_array();
    }

    /**
     * This function will delete the record based on the id
     * @param $id
     */
    public function remove($id) {
        $this->db->where('id', $id);
        $this->db->delete('onlineclass');
    }

    public function search_by_content_type($text) {
        $this->db->select()->from('onlineclass');
        $this->db->or_like('onlineclass.content_type', $text);
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
            $this->db->update('onlineclass', $data); 
        } else {
            $this->db->insert('onlineclass', $data); 
            return $this->db->insert_id();
        }
    }

}
