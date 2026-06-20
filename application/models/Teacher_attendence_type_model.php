<?php

class Teacher_attendence_type_model extends CI_Model
{

    public function get( $id = null )
    {
        $this->db->select( "*" )->from( 'teacher_attendence_types' );

        if ( $id !== null ) {
            $this->db->where( 'teacher_attendence_type_id', $id );
        }

        $q = $this->db->get();

        if ( $q->num_rows() > 0 ) {
            if ( $id !== null ) {
                return $q->row_array();
            } else {
                return $q->result_array();
            }
        } else {
            return false;
        }
    }

    public function search( $attendence_type_name )
    {
        $this->db->select( "*" )->from( 'teacher_attendence_types' )->like( 'teacher_attendence_type_name', $attendence_type_name );
        $q = $this->db->get();

        if ( $q->num_rows() > 0 ) {
            return $q->row_array();
        } else {
            return false;
        }
    }

}