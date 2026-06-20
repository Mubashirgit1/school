<?php

class Staff_attendance_model extends CI_Model
{

    public $table_name = "staff_attendance";

    public function __construct()
    {
        parent::__construct();

        //$this->mark_all_absent();
    }

    public function get( $id = null, $staff_id = null, $date = null )
    {
        $this->db->select( '*' )
            ->from( 'staff_attendance' );

        if ( $id !== null ) {
            $this->db->where( 'id', $id );
        } else {
            $this->db->order_by( 'id', 'ASC' );
        }

        if ( $staff_id !== null ) {
            $this->db->where( 'staff_id', $staff_id );
        }

        if ( $date !== null ) {
            $this->db->where( 'attendance_date', date( 'Y-m-d', strtotime( $date ) ) );
        }

        $q = $this->db->get();

        if ( $q->num_rows() > 0 ) {

            if ( $id !== null || ( $staff_id !== null && $date !== null ) ) {
                return $q->row_array();
            } else {
                return $q->result_array();
            }

        } else {
            return false;
        }
    }

    public function add( $staff_id, $attendance_name, $attendance_date = null, $attendance_time = null )
    {
        $attendance_date = date( 'Y-m-d', ( $attendance_date !== null ? strtotime( $attendance_date ) : now() ) );
        $attendance_time = date( 'H:i:s', ( $attendance_time !== null ? strtotime( $attendance_time ) : now() ) );

        $attendance_search = $this->get( null, $staff_id, $attendance_date );

        if ( $attendance_search === false ) {
            $this->db->insert( $this->table_name, [
                'staff_id' => $staff_id,
                'attendance' => $attendance_name,
                'attendance_date' => date( 'Y-m-d', strtotime( $attendance_date ) ),
                'attendance_time' => date( 'H:i:s', strtotime( $attendance_time ) )
            ] );
        } else {
            $this->db->update( $this->table_name, [
                'attendance' => $attendance_name,
                'attendance_date' => date( 'Y-m-d', strtotime( $attendance_date ) ),
                'attendance_time' => date( 'H:i:s', strtotime( $attendance_time ) )
            ], [
                'id' => $attendance_search['id']
            ] );
        }
    }
	
	
	 public function add2( $staff_id, $attendance_name, $attendance_date = null, $attendance_time = null )
    {
        $attendance_date = date( 'Y-m-d', ( $attendance_date !== null ? strtotime( $attendance_date ) : now() ) );
        $attendance_time = date( 'H:i:s', ( $attendance_time !== null ? strtotime( $attendance_time ) : now() ) );

        
            $this->db->insert( $this->table_name, [
                'staff_id' => $staff_id,
                'attendance' => $attendance_name,
                'attendance_date' => date( 'Y-m-d', strtotime( $attendance_date ) ),
                'attendance_time' => date( 'H:i:s', strtotime( $attendance_time ) )
            ] );
               
    }

    public function mark_all_absent()
    {
        $current_time = new DateTime( date( 'Y-m-d H:i:s', now() ) );

        $restrict_attendance_after = $this->custom_option_model->get( 'restrict_attendance_after' );
        $restrict_attendance_after = $restrict_attendance_after['value'];

        // if current time is greater than the restriction time for the attendance
        if ( intval( $current_time->format( 'G' ) ) > intval( date( 'G', strtotime( $restrict_attendance_after ) ) ) ) {
            // get all the staff members
            $staff_members = $this->staff_model->get();

            if ( $staff_members !== false ) {
                $absent_staff_names = [];

                foreach ( $staff_members as $staff_member ) {
                    $staff_attendance = $this->get( null, $staff_member['id'], $current_time->format( 'Y-m-d' ) );

                    // if attendance is not already marked
                    if ( $staff_attendance === false ) {
                        $this->add( $staff_member['id'], 'absent', $current_time->format( 'Y-m-d' ), $current_time->format( 'H:i:s' ) );

                        $absent_staff_names[] = "{$staff_member['name']} ({$staff_member['staff_department_details']['name']})";
                    }
                }

                if ( !empty( $absent_staff_names ) ) {
                    $admin_phone = $this->custom_option_model->get( 'admin_phone' );
                //    $this->sms_library->send_sms( $admin_phone['value'], $this->sms_messages->teacher_staff_absent_message( $absent_staff_names, 'staff members' ) );
                }
            }
        }
    }
	
	public function sum_staff_attendance_by_date2( $date = null )
    {
		
        $this->db->select( '*' )
            ->from( 'staff_attendance' );
            
        if ( $date !== null ) {
            $this->db->where( 'staff_attendance.attendance_date', date( 'Y-m-d', strtotime( $date ) ) );
        }

        $q = $this->db->get();

        return $q->result_array();
		
    }

}