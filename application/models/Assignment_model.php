<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @property CI_DB_mysqli_driver|CI_DB_mysqli_utility db
 */
class Assignment_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->current_session = $this->setting_model->getCurrentSession();
    }

    /**
     * This funtion takes id as a parameter and will fetch the record.
     * If id is not provided, then it will fetch all the records form the table.
     * @param int $id
     * @return mixed
     */
    public function get($id = null, $teacher_id = null, $class_id = null, $section_id = null, $date = null)
    {
        $this->db->select('assignment.*,classes.class,subjects.name as subject,sections.section as section_name,teachers.name as teacher')->from('assignment');
        $this->db->join('classes', 'assignment.class_id = classes.id', 'left outer');
        $this->db->join('subjects', 'assignment.subject_id = subjects.id', 'left outer');
        $this->db->join('sections', 'assignment.section_id = sections.id', 'left outer');
        $this->db->join('teachers', 'assignment.teacher_id = teachers.id', 'left outer');

        if ($id != null) {
            $this->db->where('assignment.id', $id);
        }
        if ($teacher_id != null) {
            $this->db->where('assignment.teacher_id', $teacher_id);
        }
        if ($class_id != null) {
            $this->db->where('assignment.class_id', $class_id);
        }
        if ($section_id != null) {
            $this->db->where('assignment.section_id', $section_id);
        }
        if ($date != null) {
            $this->db->where('assignment.date = ', date("Y-m-d", strtotime($date)));
        }
        $this->db->order_by('assignment.id', "desc");
//        $this->db->limit(10);
        $query = $this->db->get();

        if ($id != null) {
            return $query->row_array();
        } else {
            return $query->result_array();
        }
    }

    public function get_std_replies_of_assignment($id)
    {
        $this->db->where("assignment_id", $id);
        $q  = $this->db->get("student_assignment");
        return $q->result_array();
    }

    public function get_std_reply($id = null, $teacher_id = null, $class_id = null, $section_id = null, $date = null, $assignment_id = null, $student_id = null)
    {
        $this->db->select('student_assignment.*,classes.class,subjects.name as subject,sections.section as section_name,teachers.name as teacher')->from('student_assignment');
        $this->db->select("assignment.date as due_date, students.firstname as std_fname, students.lastname as std_lname, students.roll_no as std_roll_no");
        $this->db->select("students.admission_no");
        $this->db->join('classes', 'student_assignment.class_id = classes.id', 'left outer');
        $this->db->join('subjects', 'student_assignment.subject_id = subjects.id', 'left outer');
        $this->db->join('sections', 'student_assignment.section_id = sections.id', 'left outer');
        $this->db->join('teachers', 'student_assignment.teacher_id = teachers.id', 'left outer');
        $this->db->join('students', 'student_assignment.student_id = students.id', 'left outer');
        $this->db->join('assignment', 'student_assignment.assignment_id = assignment.id', 'left outer');

        if ($id) {
            $this->db->where('student_assignment.id', $id);
        }
        if ($teacher_id) {
            $this->db->where('student_assignment.teacher_id', $teacher_id);
        }
        if ($class_id) {
            $this->db->where('student_assignment.class_id', $class_id);
        }
        if ($section_id) {
            $this->db->where('student_assignment.section_id', $section_id);
        }
        if ($assignment_id) {
            $this->db->where('student_assignment.assignment_id', $assignment_id);
        }
        if ($student_id) {
            $this->db->where('student_assignment.student_id', $student_id);
        }
        if ($date) {
            $this->db->where('student_assignment.date = ', date("Y-m-d", strtotime($date)));
        }
        $this->db->order_by('student_assignment.id', "desc");
        $this->db->limit(10);
        $query = $this->db->get();
        if ($id != null) {
            return $query->row_array();
        } else {
            return $query->result_array();
        }
    }


    public function getListByCategory($category)
    {
        $this->db->select('assignment.*,classes.class')->from('assignment');
        $this->db->join('classes', 'assignment.class_id = classes.id', 'left outer');
        $this->db->where('assignment.type', $category);
        $this->db->order_by('assignment.id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getListByCategoryforUser($class_id, $category)
    {
        $query = "SELECT * FROM `assignment` WHERE (class_id =$class_id and type='$category') or (is_public='yes' and type='$category')";
        $query = $this->db->query($query);
        return $query->result_array();
    }

    public function getListBySubject($class_id = null, $section_id = null)
    {
        $this->db->select('assignment.*,subjects.name as subject')->from('assignment');
        $this->db->join('classes', 'assignment.class_id = classes.id', 'left outer');
        $this->db->join('sections', 'assignment.section_id = sections.id', 'left outer');
        $this->db->join('subjects', 'assignment.subject_id = subjects.id', 'left outer');
        if ($class_id != null) {
            $this->db->where('assignment.class_id', $class_id);
        }
        if ($section_id != null) {
            $this->db->where('assignment.section_id', $section_id);
        }
        $this->db->order_by('assignment.subject_id');
        $this->db->group_by('assignment.subject_id');
        $query = $this->db->get();
        return $query->result_array();
    }


    public function getListByDate($class_id = null, $section_id = null, $subject_id = null, $date = null, $student_id = null)
    {
        $this->db->select('assignment.*,classes.class,subjects.name as subject,sections.section as section,teachers.name as teacher')->from('assignment');
//        $this->db->select("student_assignment.file as std_uploaded_file, student_assignment.reply_file, student_assignment.date as std_uploaded_date, student_assignment.marks as obtained_marks");

        $this->db->join('classes', 'assignment.class_id = classes.id', 'left outer');
        $this->db->join('sections', 'assignment.section_id = sections.id', 'left outer');
        $this->db->join('subjects', 'assignment.subject_id = subjects.id', 'left outer');
        $this->db->join('teachers', 'assignment.teacher_id = teachers.id', 'left outer');
//        $this->db->join('student_assignment', 'assignment.id = student_assignment.assignment_id', 'left outer');

        if ($class_id != null) {
            $this->db->where('assignment.class_id', $class_id);
        }
        if ($section_id != null) {
            $this->db->where('assignment.section_id', $section_id);
        }
        if ($subject_id != null) {
            $this->db->where('assignment.subject_id', $subject_id);
        }
        if ($date != null) {
            $this->db->where('assignment.date', $date);
        }
        if ($student_id != null) {
//            $this->db->where("(student_assignment.student_id='$student_id' OR student_assignment.file IS NULL)");
        }
//        $this->db->group_by("assignment.id");
        $this->db->order_by('assignment.date');

        $query = $this->db->get();
        $data  = array();
        foreach ($query->result() as $row) {

            $this->db->where("student_assignment.assignment_id", $row->id);
            $this->db->where("student_assignment.student_id", $student_id);
            $std_assignment = $this->db->get('student_assignment');

            $row->by_student = $std_assignment->row();

            $data[] = $row;
        }
        return $data;
//        return $query->result_array();
    }

    /**
     * This function will delete the record based on the id
     * @param $id
     */
    public function remove($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('assignment');
    }
    public function remove_std_assignments_where_in_id($ids)
    {
        $this->db->where_in('id', $ids);
        $this->db->delete('student_assignment');
    }

    public function search_by_content_type($text)
    {
        $this->db->select()->from('assignment');
        $this->db->or_like('assignment.content_type', $text);
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * This function will take the post data passed from the controller
     * If id is present, then it will do an update
     * else an insert. One function doing both add and edit.
     * @param $data
     */
    public function add($data)
    {
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('assignment', $data);
        } else {
            $this->db->insert('assignment', $data);
            return $this->db->insert_id();
        }
    }


    public function add_std_reply($data)
    {
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('student_assignment', $data);
        } else {
            $this->db->insert('student_assignment', $data);
            return $this->db->insert_id();
        }
    }

}
