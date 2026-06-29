<?php

class Student_fee_voucher_fee_types_model extends CI_Model
{
    public $table_name = "student_fee_voucher_fee_types";

    public function get( $id = null, $student_fee_voucher_id = null )
    {
        $this->db
            ->select( '*' )
            ->from( $this->table_name );

        if ( $id !== null ) {
            $this->db->where( 'id', $id );
        }

        if ( $student_fee_voucher_id !== null ) {
            $this->db->where( 'student_fee_voucher_id', $student_fee_voucher_id );
        }

        $q = $this->db->get();

        if ( $id !== null ) {
            return $q->row_array();
        } else {
            return $q->result_array();
        }
    }
	public function get2( $id = null, $student_fee_voucher_id = null, $other_fee_types )
    {
        $this->db
            ->select( '*' )
            ->from( $this->table_name );

        if ( $id !== null ) {
            $this->db->where( 'id', $id );
        }

        if ( $student_fee_voucher_id !== null ) {
            $this->db->where( 'student_fee_voucher_id', $student_fee_voucher_id );
        }
		if ($other_fee_types !== null ) {
            $this->db->where( 'name', $other_fee_types );
        }

        $q = $this->db->get();

        if ( $id !== null ) {
            return $q->row_array();
        } else {
            return $q->result_array();
        }
    }

    public function get_sum_unpaid(  $student_fee_voucher_id = null )
    {
        $this->db
            ->select( 'amount' )
            ->from( $this->table_name );

        if ( $student_fee_voucher_id !== null ) {
            $this->db->where( 'student_fee_voucher_id', $student_fee_voucher_id );
        }

        $q = $this->db->get();
        $other = $q->result_array();
        $unpaid = 0;
        foreach( $other as $oth){
            $unpaid += $oth['amount'];
        }

        return $unpaid;

    }


	  public function get_unpaid_fee_types(  $vrno, $id=null)
    {
        $this->db
            ->select( '*' )
            ->from( $this->table_name );

        if ( $vrno !== null ) {
            $this->db->where( 'student_fee_voucher_id', $vrno );
        }
		  
		  
		  $name ='Due fee';
		  $name1 ='Tuition fee';
		  
		   $this->db->where( 'name !=', $name ); 
		   $this->db->where( 'name !=', $name1 );

        $q = $this->db->get();

        if ( $id !== null ) {
            return $q->row_array();
        } else {
            return $q->result_array();
        }
    }
}

