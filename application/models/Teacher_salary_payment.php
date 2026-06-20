<?php

class Teacher_salary_payment extends CI_Model
{

    public $table_name = "teacher_salary_payments";

    public function insert( $insert )
    {
       
        $this->db->insert( $this->table_name, $insert );
		
		 $insert_id = $this->db->insert_id();

        return  $insert_id;
   
    }
	
	
	 public function teacher_salary_update( $data, $salary_payment_id )
    {
    
        $this->db->where( 'teacher_salary_payments.teacher_salary_payment_id', $salary_payment_id );
    
		$this->db->update( $this->table_name, $data );
	
	
	 }
	

    public function get( $id = null, $teacher_id = null, $order = 'ASC', $limit = null, $date_from = null, $date_to = null )
    {
        $this->db->select( '*' )
            ->from( $this->table_name );


        if ( $id === null ) {
            $this->db->order_by( 'teacher_salary_payment_id', $order );

        } else {
            $this->db->where( 'teacher_salary_payment_id', $id );
        }       

        if ( $teacher_id !== null ) {
            $this->db->where( 'teacher_id', $teacher_id );
        }
            $this->db->where( 'paid', 1 );
            
	    if ( $limit !== null ) {
            $this->db->limit( $limit );
        }

        if ( $date_from !== null ) {
            $date_from = date( 'Y-m-d', strtotime( $date_from ) );
            $this->db->where( "teacher_salary_payment_date >=", $date_from );
        }

        if ( $date_to !== null ) {
            $date_to = date( 'Y-m-d', strtotime( $date_to ) );
            $this->db->where( 'teacher_salary_payment_date <=', $date_to );
        }

        $q = $this->db->get();

        if ( $q->num_rows() > 0 ) {
            if ( $id === null && $limit != 1 ) {
                return $q->result_array();
            } else {
                return $q->row_array();
            }
        } else {
            return false;
        }

    }
    public function get_due( $id = null, $teacher_id = null, $order = 'ASC', $limit = null, $date_from = null, $date_to = null )
    {
        $this->db->select( '*' )
            ->from( $this->table_name );

        if ( $id === null ) {
            $this->db->order_by( 'teacher_salary_payment_id', $order );
        } else {
            $this->db->where( 'teacher_salary_payment_id', $id );
        }

        if ( $teacher_id !== null ) {
            $this->db->where( 'teacher_id', $teacher_id );
        }

        $this->db->where( 'paid', 0 );
	   
	    if ( $limit !== null ) {
            $this->db->limit( $limit );
        }

        if ( $date_from !== null ) {
            $date_from = date( 'Y-m-d', strtotime( $date_from ) );
            $this->db->where( "teacher_salary_payment_date >=", $date_from );
        }

        if ( $date_to !== null ) {
            $date_to = date( 'Y-m-d', strtotime( $date_to ) );
            $this->db->where( 'teacher_salary_payment_date <=', $date_to );
        }

        $q = $this->db->get();

        if ( $q->num_rows() > 0 ) {
            if ( $id === null && $limit != 1 ) {
                return $q->result_array();
            } else {
                return $q->row_array();
            }
        } else {
            return false;
        }

    }
	
	public function get2( $id = null, $teacher_id = null, $order = 'ASC', $limit = null, $date_from = null, $date_to = null )
    {
        $this->db->select( '*' )
            ->from( $this->table_name );
         $this->db->where( 'paid', 1 );
        if ( $id === null ) {
            $this->db->order_by( 'teacher_salary_payment_id', $order );
        } else {
            $this->db->where( 'teacher_salary_payment_id', $id );
        }

        if ( $teacher_id !== null ) {
            $this->db->where( 'teacher_id', $teacher_id );
        }

        if ( $limit !== null ) {
            $this->db->limit( $limit );
        }

        if ( $date_from !== null ) {
            $date_from = date( 'Y-m-d', strtotime( $date_from ) );
            $this->db->where( "teacher_salary_payment_date >=", $date_from );
        }

        if ( $date_to !== null ) {
            $date_to = date( 'Y-m-d', strtotime( $date_to ) );
            $this->db->where( 'teacher_salary_payment_date <=', $date_to );
        }

        $q = $this->db->get();

        if ( $q->num_rows() > 0 ) {
            if ( $id === null && $limit != 1 ) {
                return $q->result_array();
            } else {
                return $q->row_array();
            }
        } else {
            return false;
        }

    }

    public function get_incentive( $teacher_id = null, $payment_date= null, $incentive_id =null, $max= null,$paid )
    {
		
        
		 $this->db->select( '*' )
            ->from( 'incentive_deduction' );

        if ( $teacher_id !== null ) {
            $this->db->where( 'teacher_id', $teacher_id );
        }
		if (  $payment_date !== null ) {
            $this->db->where( 'date <=', $payment_date );
        }

      if (  $incentive_id !== null ) {
            $this->db->where( 'id', $incentive_id );
        }
		
		if (  $paid !== null ) {
           $this->db->where( 'paid', $paid);
        }

        $this->db->where( 'teacher_staff', 1);
        $this->db->limit( 20); 
        $q = $this->db->get();
        if ( $q->num_rows() > 0 ) {
               return $q->result_array();
        } else {
            return false;
        }

    }
	
	
	public function get_incentives($id = null, $teacher_id = null, $order = 'ASC', $limit = null, $date_from = null, $date_to = null,$paid=null,$incentive_id = null )
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

    public function get_by_teacher(  $teacher_id = null, $order = 'ASC', $limit = null )
    {
        $this->db->select( '*' )
            ->from( $this->table_name );

        if ( $id === null ) {
            $this->db->order_by( 'teacher_salary_payment_id', $order );
        } else {
            $this->db->where( 'teacher_salary_payment_id', $id );
        }

        if ( $teacher_id !== null ) {
            $this->db->where( 'teacher_id', $teacher_id );
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

    public function teacher_salary_records( $teacher_id = null, $salary_payment_id = null, $date_from = null, $date_to = null )
    {

        $this->db->select( "teachers.*, teacher_salary_payments.teacher_salary_payment_id, teacher_salary_payments.due_salary AS teacher_salary_payment_due_salary, teacher_salary_payments.paid_salary AS teacher_salary_payment_paid_salary, teacher_salary_payments.teacher_salary_payment_date,teacher_salary_payments.admin_id" )
            ->from( 'teachers' )
            ->join( 'teacher_salary_payments', 'teacher_salary_payments.teacher_id = teachers.id', 'left' )
            ->order_by( 'teachers.name', 'ASC' );

        if ( $teacher_id !== null ) {
            $this->db->where( 'teachers.id', $teacher_id );
        }

        if ( $salary_payment_id !== null ) {
            $this->db->where( 'teacher_salary_payments.teacher_salary_payment_id', $salary_payment_id );
        }

        if ( $date_from !== null ) {
            $date_from = date( 'Y-m-d', strtotime( $date_from ) );
            $this->db->where( 'teacher_salary_payments.teacher_salary_payment_date >=', $date_from );
        }

        if ( $date_to !== null ) {
            $date_to = date( 'Y-m-d', strtotime( $date_to ) );
            $this->db->where( 'teacher_salary_payments.teacher_salary_payment_date <=', $date_to );
        }

        $q = $this->db->get();

        if ( $q->num_rows() > 0 ) {

            if ( $salary_payment_id !== null ) {
                return $q->row_array();
            } else {
                return $q->result_array();
            }

        } else {
            return false;
        }

    }
	
	
	public function teacher_salary_records2( $teacher_id = null, $salary_payment_id = null, $date_from = null, $date_to = null )
    {

        $this->db->select( "teachers.*, teacher_salary_payments.teacher_salary_payment_id, teacher_salary_payments.due_salary AS teacher_salary_payment_due_salary, teacher_salary_payments.paid_salary AS teacher_salary_payment_paid_salary, teacher_salary_payments.teacher_salary_payment_date" )
            ->from( 'teachers' )
            ->join( 'teacher_salary_payments', 'teacher_salary_payments.teacher_id = teachers.id', 'left' )
            ->order_by( 'teachers.name', 'ASC' );

        if ( $teacher_id !== null ) {
            $this->db->where( 'teachers.id', $teacher_id );
        }

        if ( $salary_payment_id !== null ) {
            $this->db->where( 'teacher_salary_payments.teacher_salary_payment_id', $salary_payment_id );
        }

        if ( $date_from !== null ) {
            $date_from = date( 'Y-m-d', strtotime( $date_from ) );
            $this->db->where( 'teacher_salary_payments.teacher_salary_payment_date >=', $date_from );
        }

        if ( $date_to !== null ) {
            $date_to = date( 'Y-m-d', strtotime( $date_to ) );
            $this->db->where( 'teacher_salary_payments.teacher_salary_payment_date <=', $date_to );
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

	
	

    public function sum_paid_by_month( $date )
    {
        $this->db->select_sum( 'paid_salary', 'sm' )
            ->from( $this->table_name )
            ->like( 'teacher_salary_payment_date', date( 'Y-m-', strtotime( $date ) ) );

        $q = $this->db->get();

        $sm = $q->row_array();
        $sm = intval( $sm['sm'] );

        return $sm;
    }

}