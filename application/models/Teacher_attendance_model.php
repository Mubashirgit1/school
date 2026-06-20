<?php

class Teacher_attendance_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();

        //$this->mark_all_absent();
    }

    public function search_attendance( $teacher_id, $date ){

        $date = date( 'Y-m-d', strtotime( $date ) );
        $this->db->select( "*" )->from( 'teacher_attendance' )->where( array(
            'teacher_id' => $teacher_id,
            'attendance_date' => $date
        ) );


        $q = $this->db->get();

        if ( $q->num_rows() > 0 ) {
            return $q->row_array();
        } else {
            return false;
        }

    }

    /**
     * @param $insert_data ['teacher_id', 'teacher_attendence_type_id', 'attendance_date', 'attendance_time']
     */
    public function insert( $insert_data )
    {

        $search = $this->search_attendance( $insert_data['teacher_id'], $insert_data['attendance_date'] );

        // NO record already available in the database
        if ( $search === false ) {
            $this->db->insert( 'teacher_attendance', $insert_data );
        } else { // records available

            $this->db->update( 'teacher_attendance', $insert_data, array(
                'teacher_attendance_id' => $search['teacher_attendance_id']
            ) );

        }

    }
	
	public function insert2( $insert_data )
    {

       

        // NO record already available in the database
       
            $this->db->insert( 'teacher_attendance', $insert_data );
    

    }

    public function total_attended_lectures_in_month( $teacher_id, $date )
    {
        $this->db->select( 'SUM(`teacher_attendance`.`attended_lectures`) as sm' )
            ->from( 'teacher_attendance' )
            ->join( 'teacher_attendence_types', 'teacher_attendence_types.teacher_attendence_type_id = teacher_attendance.teacher_attendence_type_id', 'inner' )
            ->where( array(
                'teacher_attendance.attendance_lecture_based' => 1,
                'teacher_attendence_types.teacher_attendence_type_name' => 'present',
                'teacher_attendance.teacher_id' => $teacher_id
            ) )
            ->like( 'teacher_attendance.attendance_date', date( 'Y-m-', strtotime( $date ) ), 'after' );

        $q = $this->db->get();

        $sm = $q->row_array();
        $sm = intval( $sm['sm'] );

        return $sm;

    }

    public function sum_teacher_attendance_by_date( $date = null )
    {
        $this->db->select( 'teacher_attendence_types.teacher_attendence_type_name AS name, COUNT(teacher_attendance.teacher_attendance_id) AS cnt' )
            ->from( 'teacher_attendance' )
            ->join( 'teacher_attendence_types', 'teacher_attendence_types.teacher_attendence_type_id = teacher_attendance.teacher_attendence_type_id', 'inner' )
            ->group_by( 'teacher_attendence_types.teacher_attendence_type_id' )
            ->order_by( 'teacher_attendence_types.teacher_attendence_type_name', 'ASC' );

        if ( $date !== null ) {
            $this->db->where( 'teacher_attendance.attendance_date', date( 'Y-m-d', strtotime( $date ) ) );
        }

        $q = $this->db->get();

        return $q->result_array();
    }
	
	
	public function sum_teacher_attendance_by_date2( $date = null )
    {
        $this->db->select( 'teacher_attendence_types.teacher_attendence_type_name AS name, COUNT(teacher_attendance.teacher_attendance_id) AS cnt' )
            ->from( 'teacher_attendance' )
            ->join( 'teacher_attendence_types', 'teacher_attendence_types.teacher_attendence_type_id = teacher_attendance.teacher_attendence_type_id', 'inner' )
            ->group_by( 'teacher_attendence_types.teacher_attendence_type_id' );
       

        if ( $date !== null ) {
            $this->db->where( 'teacher_attendance.attendance_date', date( 'Y-m-d', strtotime( $date ) ) );
        }

        $q = $this->db->get();

        return $q->result_array();
    }

    public function mark_all_absent()
    {
        $current_time = new DateTime( date( 'Y-m-d H:i:s', now() ) );

        $restrict_attendance_after = $this->custom_option_model->get( 'restrict_attendance_after' );
        $restrict_attendance_after = $restrict_attendance_after['value'];

        $this->load->model( ['teacher_model', 'teacher_attendence_type_model'] );

        // if current time is greater than the restriction time for the attendance
        if ( intval( $current_time->format( 'G' ) ) > intval( date( 'G', strtotime( $restrict_attendance_after ) ) ) ) {
            // get all the teachers
            $teachers = $this->teacher_model->get();

            $absent_teacher_names = [];

            foreach ( $teachers as $teacher ) {
                $teacher_attendance = $this->search_attendance( $teacher['id'], $current_time->format( 'Y-m-d' ) );

                // if attendance is not already marked
                if ( $teacher_attendance === false ) {
                    // get absent attendance type
                    $absent_attendance_type = $this->teacher_attendence_type_model->search( 'absent' );

                    $this->insert( [
                        'teacher_id' => $teacher['id'],
                        'teacher_attendence_type_id' => $absent_attendance_type['teacher_attendence_type_id'],
                        'attendance_date' => $current_time->format( 'Y-m-d' ),
                        'attendance_time' => $current_time->format( 'H:i:s' )
                    ] );

                    $absent_teacher_names[] = $teacher['name'];

                }
            }

            if ( !empty( $absent_teacher_names ) ) {
                $admin_phone = $this->custom_option_model->get( 'admin_phone' );
            ///    $this->sms_library->send_sms( $admin_phone['value'], $this->sms_messages->teacher_staff_absent_message( $absent_teacher_names, 'teachers' ) );
            }
        }
    }

}