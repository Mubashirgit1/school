<?php

class Teacher_type_model extends CI_Model
{

    public function get( $id = null )
    {
        $this->db->select( "*" );
        $this->db->from( 'teacher_types' );

        if ( $id !== null ) {
            $this->db->where( 'teacher_type_id', $id );
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

}