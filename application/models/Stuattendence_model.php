<?php

if ( !defined( 'BASEPATH' ) )
    exit( 'No direct script access allowed' );

class Stuattendence_model extends CI_Model
{

    public $table_name = "student_attendences";

    public function __construct()
    {
        parent::__construct();
        $this->current_session = $this->setting_model->getCurrentSession();
        $this->current_date = $this->setting_model->getDateYmd();
    }

    /**
     * This funtion takes id as a parameter and will fetch the record.
     * If id is not provided, then it will fetch all the records form the table.
     * @param int $id
     * @return mixed
     */
    public function get( $id = null )
    {
        $this->db->select()->from( 'student_attendences' );
        if ( $id != null ) {
            $this->db->where( 'id', $id );
        } else {
            $this->db->order_by( 'id' );
        }
        $query = $this->db->get();
        if ( $id != null ) {
            return $query->row_array();
        } else {
            return $query->result_array();
        }
    }

    /**
     * Adds or updates attendance
     * @param $id
     */
    public function add( $data )
    {
        if ( isset( $data['id'] ) ) {
            $this->db->where( 'id', $data['id'] );
            $this->db->update( 'student_attendences', $data );
        } else {
            $this->db->insert( 'student_attendences', $data );
        }
    }

    public function searchAttendenceClassSection( $class_id, $section_id, $date )
    {

        $sql = "select student_sessions.attendence_id,students.firstname,student_sessions.date,students.roll_no,students.struck_off,students.admission_no ,students.id AS student_id,students.admission_no,students.lastname,student_sessions.attendence_type_id,student_sessions.id as student_session_id, attendence_type.type as `att_type`,attendence_type.key_value as `key` from students ,(SELECT student_session.id,student_session.student_id ,IFNULL(student_attendences.date, 'xxx') as date,IFNULL(student_attendences.id, 0) as attendence_id,student_attendences.attendence_type_id FROM `student_session` LEFT JOIN student_attendences ON student_attendences.student_session_id=student_session.id  and student_attendences.date=" . $this->db->escape( $date ) . " where  student_session.session_id=" . $this->db->escape( $this->current_session ) . " and student_session.class_id=" . $this->db->escape( $class_id ) . " and student_session.section_id=" . $this->db->escape( $section_id ) . ") as student_sessions LEFT JOIN attendence_type ON attendence_type.id=student_sessions.attendence_type_id where student_sessions.student_id=students.id";

        $this->db->where( 'id', $data['id'] );
        $query = $this->db->query( $sql );
        return $query->result_array();
    }
	
    public function searchAttendencestudent($student_id,  $date )
    {

        $sql = "select student_sessions.attendence_id,students.firstname,student_sessions.date,students.roll_no,students.id AS student_id,students.admission_no,students.lastname,student_sessions.attendence_type_id,student_sessions.id as student_session_id, attendence_type.type as `att_type`,attendence_type.key_value as `key` from students ,(SELECT student_session.id,student_session.student_id ,IFNULL(student_attendences.date, 'xxx') as date,IFNULL(student_attendences.id, 0) as attendence_id,student_attendences.attendence_type_id FROM `student_session` LEFT JOIN student_attendences ON student_attendences.student_session_id=student_session.id  and student_attendences.date=" . $this->db->escape( $date ) . " where  student_session.session_id=" . $this->db->escape( $this->current_session ) .   " and student_session.student_id=" . $this->db->escape( $student_id ) . ") as student_sessions LEFT JOIN attendence_type ON attendence_type.id=student_sessions.attendence_type_id where student_sessions.student_id=students.id";


        $query = $this->db->query( $sql );
        return $query->result_array();
    }
	
	public function searchAttendencestudent2($student_id,  $date )
    {

        $sql = "select student_sessions.attendence_id,students.firstname,student_sessions.date,students.roll_no,students.id AS student_id,students.admission_no,students.lastname,student_sessions.attendence_type_id,student_sessions.id as student_session_id, attendence_type.type as `att_type`,attendence_type.key_value as `key` from students ,(SELECT student_session.id,student_session.student_id ,IFNULL(student_attendences.date, 'xxx') as date,IFNULL(student_attendences.id, 0) as attendence_id,student_attendences.attendence_type_id FROM `student_session` LEFT JOIN student_attendences ON student_attendences.student_session_id=student_session.id  and student_attendences.date=" . $this->db->escape( $date ) . " where  student_session.session_id=" . $this->db->escape( $this->current_session ) .   " and student_session.student_id=" . $this->db->escape( $student_id ) . ") as student_sessions LEFT JOIN attendence_type ON attendence_type.id=student_sessions.attendence_type_id where student_sessions.student_id=students.id";


        $query = $this->db->query( $sql );
        return $query->row_array();
    }

    public function searchAttendenceClassSectionPrepare( $class_id, $section_id, $date )
    {
        $query = $this->db->query( "select student_sessions.attendence_id,students.firstname,students.admission_no,student_sessions.date,students.roll_no,students.lastname,student_sessions.attendence_type_id,student_sessions.id as student_session_id from students ,(SELECT student_session.id,student_session.student_id ,IFNULL(student_attendences.date, 'xxx') as date,IFNULL(student_attendences.id, 0) as attendence_id,student_attendences.attendence_type_id FROM `student_session` RIGHT JOIN student_attendences ON student_attendences.student_session_id=student_session.id  and student_attendences.date=" . $this->db->escape( $date ) . " where  student_session.session_id=" . $this->db->escape( $this->current_session ) . " and student_session.class_id=" . $this->db->escape( $class_id ) . " and student_session.section_id=" . $this->db->escape( $section_id ) . ") as student_sessions where student_sessions.student_id=students.id" );
        return $query->result_array();
    }

    public function calculate_attendance_by_date( $date = null )
    {

        $this->db->select( 'attendence_type.type AS name, COUNT(student_attendences.id) AS cnt' )
            ->from( 'attendence_type' )
            ->join( 'student_attendences', 'student_attendences.attendence_type_id = attendence_type.id', 'left' )
            ->where( "attendence_type.type !=", "Holiday" )
            ->group_by( 'attendence_type.id' );

        if ( $date !== null ) {
            $this->db->where( 'student_attendences.date', date( 'Y-m-d', strtotime( $date ) ) );
        }

        $q = $this->db->get();

        return $q->result_array();
    }

    public function search_attendance( $student_session_id = null, $date = null )
    {
		
        $this->db
            ->select( '*' )
            ->from( $this->table_name );

        if ( $student_session_id !== null ) {
            $this->db->where( 'student_session_id', $student_session_id );
        }

        if ( $date !== null ) {
            $this->db->where( 'date', date( 'Y-m-d', strtotime( $date ) ) );
        }

        $q = $this->db->get();

        if ( $date !== null ) {
            return $q->row_array();
        } else {
            return $q->result_array();
        }
    }
    public function search_attendance_leave( $date = null )
    {
		
        $this->db
            ->select( '*' )
            ->from( $this->table_name );

        if ( $date !== null ) {
            $this->db->where( 'date', date( 'Y-m-d', strtotime( $date ) ) );
        }
        $this->db->where( 'attendence_type_id', 3  );
       
        $q = $this->db->get();
        return $q->result_array();
    }
    
	public function get_holiday( $id= null )
    {
        $this->db->select( '*' )
            ->from( 'holiday' );
    
	
	 if ( $id !== null ) {
            $this->db->where( 'id', $id );
        }
	
           $query = $this->db->get();
        if ( $id != null ) {
            return $query->row_array();
        } else {
            return $query->result_array();
        } 
      
	  
    }
	

    public function mark_attendance( $student_session_id, $attendence_type_id, $date = null )
    {
        $date = ( $date !== null ? date( 'Y-m-d', strtotime( $date ) ) : date( 'Y-m-d', now() ) );

        $search_attendance = $this->search_attendance( $student_session_id, $date );

        // if student attendance exists
        if ( !empty( $search_attendance ) ) {
            $this->db->update( $this->table_name, [
                'attendence_type_id' => $attendence_type_id
            ], [
                'id' => $search_attendance['id']
            ] );
        } else { // student attendance doesn't exists
            $this->db->insert( $this->table_name, [
                'student_session_id' => $student_session_id,
                'date' => $date,
                'attendence_type_id' => $attendence_type_id,
                'is_active' => 'yes',
                'created_at' => $date,
                'updated_at' => $date
            ] );
        }
    }


  public function mark_all_absent()
      {
	    $current_time =  date( 'm/d/Y', now());

        $date1 = date( 'Y-m-d', $this->customlib->datetostrtotime( $current_time  ) );
		
		$current_time1 = new DateTime( date( 'Y-m-d H:i:s', now() ) );

        $restrict_attendance_after = $this->custom_option_model->get( 'restrict_attendance_after' );
        $restrict_attendance_after = $restrict_attendance_after['value'];

        $this->load->model( ['teacher_model', 'teacher_attendence_type_model'] );
        $this->load->model( ['student_model', 'teacher_attendence_type_model'] );

        // if current time is greater than the restriction time for the attendance
        if ( intval( $current_time1->format( 'G' ) ) > intval( date( 'G', strtotime( $restrict_attendance_after ) ) ) ) {

        // if current time is greater than the restriction time for the attendance
			  if ( date( 'D', $this->customlib->dateyyyymmddTodateformat( $date1 ) ) == "Sun" ) {
			  
               $students = $this->student_model->get_atten(  );
               
	        // get all the teachers
    
              foreach ( $students as $student ) {
				
	      $search_attendance = $this->search_attendance($student['student_session_id'], $current_time );
			  
          if ( $search_attendance === null ) {
	
	      $this->add( [
                'student_session_id' => $student['student_session_id'],
                'attendence_type_id' => 5,
                'date'               => date( 'Y-m-d', $this->customlib->datetostrtotime( $current_time ) )
            ] );

          }
                
            }

        }
		}
		
    }


}
