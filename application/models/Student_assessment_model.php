<?php

class Student_assessment_model extends CI_Model
{
    public $table_name = "student_assessments";

    public function get( $id = null, $start_date = null, $end_date = null )
    {
        $this->db->select( '*' )
            ->from( $this->table_name );

        if ( $id !== null ) {
            $this->db->where( 'id', $id );
        }

        if ( $start_date !== null ) {
            $start_date = date( 'Y-m-d', strtotime( $start_date ) );
            $this->db->where( 'assessment_date >=', $start_date );
        }

        if ( $end_date !== null ) {
            $end_date = date( 'Y-m-d', strtotime( $end_date ) );
            $this->db->where( 'assessment_date <=', $end_date );
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