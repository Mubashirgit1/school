<?php

class Student_advance extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->current_session = $this->setting_model->getCurrentSession();
    }
    public $table_name = "student_advance";

    /**
     * Gets student fee payment
     * @param null $id
     * @param null $student_id
     * @param null $limit
     * @param null $order
     * @param null $year_month i.e. 2010-10-
     * @return bool|array
     */
    public function get($student_id = null, $year_month = null )
    {
        $order = "DESC";
        
        $this->db->select( '*' )
            ->from( $this->table_name );

        $this->db->order_by( 'id', $order );
        
        if ( $student_id !== null ) {
            $this->db->where( 'student_id', $student_id );
        }

        
        if ( $year_month !== null ) {
            $this->db->like( 'created_at', $year_month, 'after' );
        }

        $q = $this->db->get();

        if ( $q->num_rows() > 0 ) {
            $rows = $q->result_array();

            return $rows;
        } else {
            return false;
        }
    }

 
}