<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Syllabus_model extends CI_Model {

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
    public function get($id = null,$teacher_id=null,$class_id=null,$section_id=null,$date=null,$subject_id = null) {
        $this->db->select('syllabus.*,classes.class,subjects.name as subject,sections.section as section_name,teachers.name as teacher')->from('syllabus');
        $this->db->join('classes', 'syllabus.class_id = classes.id', 'left outer');
        $this->db->join('subjects', 'syllabus.subject_id = subjects.id', 'left outer');
        $this->db->join('sections', 'syllabus.section_id = sections.id', 'left outer');
        $this->db->join('teachers', 'syllabus.teacher_id = teachers.id', 'left outer');
                
        if ($id != null) {
            $this->db->where('syllabus.id', $id);
        }
        if ($teacher_id != null) {
            $this->db->where('syllabus.teacher_id', $teacher_id);
        }
        if ($class_id != null) {
            $this->db->where('syllabus.class_id', $class_id);
        }
        if ($section_id != null) {
            $this->db->where('syllabus.section_id', $section_id);
        }
        if ($subject_id != null) {
            $this->db->where('syllabus.subject_id', $subject_id);
        }
        if ($date != null) {
            $this->db->where('syllabus.date = ',   date("Y-m-d",strtotime($date)));
        }
        $this->db->order_by('syllabus.id', "desc");
//        $this->db->limit(10);
        $query = $this->db->get();
        if ($id != null) {
            return $query->row_array(); 
        } else {
            return $query->result_array(); 
        }
    }

    public function getListByDate($class_id = null , $section_id = null, $subject_id = null) {
        $this->db->select('syllabus.*,classes.class,subjects.name as subject,sections.section as section_name,teachers.name as teacher')->from('syllabus');
        $this->db->join('classes', 'syllabus.class_id = classes.id', 'left outer');
        $this->db->join('sections', 'syllabus.section_id = sections.id', 'left outer');
        $this->db->join('subjects', 'syllabus.subject_id = subjects.id', 'left outer');
        $this->db->join('teachers', 'syllabus.teacher_id = teachers.id', 'left outer');

        if ($class_id != null) {
            $this->db->where('syllabus.class_id', $class_id);
        }
        if ($section_id != null) {
            $this->db->where('syllabus.section_id', $section_id);
        }
        if ($subject_id != null) {
            $this->db->where('syllabus.subject_id', $subject_id);
        }
        $this->db->order_by('syllabus.date');
        // $this->db->group_by('syllabus.date');
        $query = $this->db->get();
        return $query->result_array(); 
    }

    public function getListBySubject($class_id = null , $section_id = null) {
        $this->db->select('syllabus.*,,subjects.name as subject')->from('syllabus');
        $this->db->join('classes', 'syllabus.class_id = classes.id', 'left outer');
        $this->db->join('sections', 'syllabus.section_id = sections.id', 'left outer');
        $this->db->join('subjects', 'syllabus.subject_id = subjects.id', 'left outer');
        if ($class_id != null) {
            $this->db->where('syllabus.class_id', $class_id);
        }
        if ($section_id != null) {
            $this->db->where('syllabus.section_id', $section_id);
        }
        $this->db->order_by('syllabus.subject_id');
        $this->db->group_by('syllabus.subject_id');
        $query = $this->db->get();
        return $query->result_array(); 
    }

    public function getListByCategory($category) {
        $this->db->select('syllabus.*,classes.class')->from('syllabus');
        $this->db->join('classes', 'syllabus.class_id = classes.id', 'left outer');
        $this->db->where('syllabus.type', $category);
        $this->db->order_by('syllabus.id');
        $query = $this->db->get();
        return $query->result_array(); 
    }

    public function getListByCategoryforUser($class_id, $category) {
        $query = "SELECT * FROM `syllabus` WHERE (class_id =$class_id and type='$category') or (is_public='yes' and type='$category')";
        $query = $this->db->query($query);
        return $query->result_array();
    }

    /**
     * This function will delete the record based on the id
     * @param $id
     */
    public function remove($id) {

        $this->db->where('id', $id);
        $this->db->delete('syllabus');
    }

    public function search_by_content_type($text) {
        $this->db->select()->from('syllabus');
        $this->db->or_like('syllabus.content_type', $text);
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
            $this->db->update('syllabus', $data); 
        } else {
            $this->db->insert('syllabus', $data); 
            return $this->db->insert_id();
        }
    }

}
