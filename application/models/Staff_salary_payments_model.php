<?php

class Staff_salary_payments_model extends CI_Model
{

    public $table_name = "staff_salary_payments";

    public function get( $id = null, $staff_id = null, $date_from = null, $date_to = null )
    {

        $this->db->select( '*' )
            ->from( 'staff_salary_payments' );
        
        if ( $id !== null ) {
            $this->db->where( 'id', $id );
        } else {
            $this->db->order_by( 'id', 'ASC' );
        }

        if ( $staff_id !== null ) {
            $this->db->where( 'staff_id', $staff_id );
        }

        if ( $date_from !== null ) {
            $date_from = date( 'Y-m-d', strtotime( $date_from ) );
            $this->db->where( 'payment_date >=', $date_from );
        }
        if ( $date_to !== null ) {
            $date_to = date( "Y-m-d", strtotime( $date_to ) );
            $this->db->where( 'payment_date <=', $date_to );
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

    public function sum_paid_by_month( $date = null )
    {
        $this->db->select_sum( 'paid_salary', 'paid_salary_sum' )
            ->from( $this->table_name );

        if ( $date !== null ) {
            $this->db->like( 'payment_date', date( 'Y-m-', strtotime( $date ) ), 'after' );
        }

        $q = $this->db->get();
        $sm = $q->row_array();

        return floatval( $sm['paid_salary_sum'] );
    }
	
    public function get_incentive( $staff_id = null, $payment_date= null, $incentive_id =null, $max= null,$paid =null )
    {
		 $this->db->select( '*' )
            ->from( 'incentive_deduction' );

        if ( $staff_id !== null ) {
            $this->db->where( 'teacher_id', $staff_id );
        }
		if (  $payment_date !== null ) {
            $this->db->where( 'date <=', $payment_date );
        }

        if (  $incentive_id !== null ) {
            $this->db->where( 'incentive_id', $incentive_id );
        }

      if (  $incentive_id !== null ) {
            $this->db->where( 'id', $incentive_id );
        }
		
		if (  $paid !== null ) {
           $this->db->where( 'paid', $paid);
        }

        $this->db->where( 'teacher_staff', 0);
        $this->db->limit( 20); 
        $q = $this->db->get();
        if ( $q->num_rows() > 0 ) {
            
                return $q->result_array();
           
        } else {
            return false;
        }

    }
    
    	
	public function get_incentives($id = null, $teacher_id = null, $order = 'ASC', $limit = null, $date_from = null, $date_to = null,$paid=null,$incentive_id =null )
    {

         $this->db->select( '*' )
            ->from( 'incentive_deduction' );

        if ( $teacher_id !== null ) {
            $this->db->where( 'teacher_id', $teacher_id );
        }
  
		if ( $date_from !== null ) {
            $date_from = date( 'Y-m-d', strtotime( $date_from ) );
            $this->db->where( "date >=", $date_from );
        }

        if ( $date_to !== null ) {
            $date_to = date( 'Y-m-d', strtotime( $date_to ) );
            $this->db->where( 'date <=', $date_to );
        }

        if (  $id !== null ) {
            $this->db->where( 'id', $id );
        }
        
        if (  $incentive_id !== null ) {
            $this->db->where( 'incentive_id', $incentive_id );
        }
        
		if (  $paid !== null ) {
           $this->db->where( 'paid', $paid);
        }

        $this->db->limit(20);
        $q = $this->db->get();

        if ( $q->num_rows() > 0 ) {
                return $q->result_array();
        } else {
            return false;
        }

    }




	 public function get_by_staff(  $id = null, $order = 'ASC', $limit = null )
    {
		
		
		
        $this->db->select( '*' )
            ->from( $this->table_name );

        if ( $id === null ) {
            $this->db->order_by( 'id', $order );
        } else {
            $this->db->where( 'id', $id );
        }

        if ( $id !== null ) {
            $this->db->where( 'id', $id );
        }

        if ( $limit !== null ) {
            $this->db->limit( $limit );
        }

       
 

        $q = $this->db->get();

        if ( $q->num_rows() > 0 ) {
            if ( $id === null && $limit != 1 ) {
                return $q->row_array();
            } else {
                return $q->row_array();
            }
        } else {
            return false;
        }

    }
	public function staff_salary_update( $data, $salary_payment_id )
    {
      
	  
	  
	
        $this->db->where( 'staff_salary_payments.id', $salary_payment_id );
    
		$this->db->update( $this->table_name, $data );
		
	
	
	 }
	
	
	public function staff_salary_records2( $staff_id = null, $salary_payment_id = null, $date_from = null, $date_to = null )
    {

        $this->db->select( "staff.*, staff_salary_payments.id, staff_salary_payments.due_salary AS staff_salary_payment_due_salary, staff_salary_payments.paid_salary AS staff_salary_payment_paid_salary, staff_salary_payments.payment_date" )
            ->from( 'staff' )
            ->join( 'staff_salary_payments', 'staff_salary_payments.staff_id = staff.id', 'left' )
            ->order_by( 'staff.name', 'ASC' );

        if ( $staff_id !== null ) {
            $this->db->where( 'staff.id', $staff_id );
        }

        if ( $salary_payment_id !== null ) {
            $this->db->where( 'staff_salary_payments.id', $salary_payment_id );
        }

        if ( $date_from !== null ) {
            $date_from = date( 'Y-m-d', strtotime( $date_from ) );
            $this->db->where( 'staff_salary_payments.payment_date >=', $date_from );
        }

        if ( $date_to !== null ) {
            $date_to = date( 'Y-m-d', strtotime( $date_to ) );
            $this->db->where( 'staff_salary_payments.payment_date <=', $date_to );
        }

        $q = $this->db->get();

        if ( $q->num_rows() > 0 ) {

            if ( $salary_payment_id !== null ) {
                return $q->row_array();
            } else {
                return $q->row_array();
            }

        } else {
            return false;
        }

    }
	
	

}