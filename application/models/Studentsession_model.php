<?php

if ( !defined( 'BASEPATH' ) )
    exit( 'No direct script access allowed' );

class Studentsession_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->current_session = $this->setting_model->getCurrentSession();
    }

    public function getSession($class_id,$student_id)
    {
        $query = $this->db->select( '*' )->from( 'student_session' )
        ->where( 'class_id', $class_id )
        ->where( 'student_id', $student_id )
        ->get();
        $results = $query->row_array();
        return $results;
    }

    public function searchStudents( $class_id = null, $section_id = null, $key = null, $date_from = null, $date_to = null, $current_session = null, $student_session_id = null )
    {
        $this->db->select( 'student_session.id,student_session.student_id,classes.class,sections.section, students.father_phone, students.gender,
            students.firstname,students.lastname,students.admission_no,students.updated_at AS struckoff_date,students.roll_no,students.dob,students.guardian_name, students.discount, students.fee_arrears, students.admission_date, classes.fee AS class_fee, ( CAST(classes.fee AS SIGNED)  - students.discount) AS fee_after_discount, students.fee_starting_date' )
            ->from( 'student_session' );
        $this->db->join( 'classes', 'student_session.class_id = classes.id' );
        $this->db->join( 'sections', 'sections.id = student_session.section_id' );
        $this->db->join( 'students', 'students.id = student_session.student_id' );



        if ( $current_session !== null ) {
          $this->db->where( 'student_session.session_id', $current_session );
        }

        if ( $class_id !== null ) {
            $this->db->where( 'student_session.class_id', $class_id );
            // $this->db->where( 'students.updated_at >=', date('Y-m-d',strtotime('first day of +1 month')));
            // $this->db->or_where( 'students.updated_at', '0000-00-00 00:00:00' );
            $next_month = date("Y-m-d",strtotime("first day of this month"));
            $this->db->where("(students.updated_at >= '$next_month' OR students.updated_at  = '0000-00-00 00:00:00')");
        }

        if ( $section_id !== null ) {
            $this->db->where( 'student_session.section_id', $section_id );
        }

        if ( $date_from !== null ) {
            $this->db->where( 'student_session.created_at >=', date( 'Y-m-d', strtotime( $date_from ) ) );
        }

        if ( $date_to !== null ) {
            $this->db->where( 'student_session.created_at <=', date( 'Y-m-d', strtotime( $date_to ) ) );
        }

        if ( $student_session_id !== null ) {
            $this->db->where( 'student_session.id', $student_session_id );
        }
        
        // $this->db->where( 'students.struck_off' , 0 );
        //  $this->db->like( 'students.updated_at', '0000-00-00 00:00:00' );
        //  $this->db->or_where( 'students.updated_at', date('Y-m-d',strtotime('0000')));

        $this->db->order_by( 'student_session.id' );
        $query = $this->db->get();
        // var_dump($this->db->last_query());echo "<br>";
        // exit;
        if ( $student_session_id !== null ) {
            return $query->row_array();
        } else {
            return $query->result_array();
        }
    }

    public function searchStudentsBySession( $student_session_id = null )
    {
        $this->db->select( 'students.admission_no,students.roll_no,student_session.session_id, student_session.class_id, student_session.section_id,student_session.id,student_session.student_id,classes.class,sections.section,
            students.firstname,students.lastname,students.admission_no,students.roll_no,students.dob,students.guardian_name,students.father_name' )->from( 'student_session' );
        $this->db->join( 'classes', 'student_session.class_id = classes.id' );
        $this->db->join( 'sections', 'sections.id = student_session.section_id' );
        $this->db->join( 'students', 'students.id = student_session.student_id' );
        $this->db->where( 'student_session.id', $student_session_id );
        $this->db->order_by( 'id' );
        $query = $this->db->get();
        return $query->row_array();
    }

    public function getStudentClass( $id )
    {
        $this->db->select( 'students.admission_no,students.roll_no,student_session.session_id, student_session.class_id, student_session.section_id,student_session.id,student_session.student_id,classes.class,sections.section,
            students.firstname,students.lastname,students.admission_no,students.roll_no,students.dob,students.guardian_name,
            ' )->from( 'student_session' );
        $this->db->join( 'classes', 'student_session.class_id = classes.id' );
        $this->db->join( 'sections', 'sections.id = student_session.section_id' );
        $this->db->join( 'students', 'students.id = student_session.student_id' );
        $this->db->where( 'student_id', $id );
        $this->db->where( 'session_id', $this->current_session );
        $this->db->order_by( 'id' );
        $query = $this->db->get();
        return $query->row_array();
    }

    public function getStudentByStudentId( $id )
    {
        $this->db->select()->from( 'student_session' );
        $this->db->where( 'student_id', $id );
        $this->db->where( 'session_id', $this->current_session );
        $this->db->order_by( 'id' );
        $query = $this->db->get();
        return $query->row_array();
    }

    public function getTotalStudentBySession()
    {
        $query = "SELECT count(*) as `total_student` FROM `student_session` INNER JOIN students on students.id=student_session.student_id where student_session.session_id=" . $this->db->escape( $this->current_session );
        $query = $this->db->query( $query );
        return $query->row();
    }

}
