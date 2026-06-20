<?php

class Student_fee_payments_other extends CI_Model
{
    public $table_name = "student_fee_payments_others";

    public function get( $id = null, $student_fee_payment_id = null, $order = 'DESC' )
    {
        $this->db->select( '*' )
            ->from( $this->table_name );

        if ( $id !== null ) {
            $this->db->where( 'id', $id );
        } else {
            $this->db->order_by( 'id', $order );
        }

        if ( $student_fee_payment_id !== null ) {
            $this->db->where( 'student_fee_payment_id', $student_fee_payment_id );
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

    public function sum_by_month( $date = null )
    {
        $this->db->select( 'SUM(student_fee_payments_others.amount) AS sm' )
            ->from( 'student_fee_payments' )
            ->join( 'student_fee_payments_others', 'student_fee_payments_others.student_fee_payment_id = student_fee_payments.id', 'inner' );

        if ( $date !== null ) {
            $this->db->like( 'student_fee_payments.payment_date', date( 'Y-m-', strtotime( $date ) ), 'after' );
        }

        $q = $this->db->get();

        $sm = $q->row_array();
        $sm = intval( $sm['sm'] );

        return $sm;
    }

    public function sum_by_month2( $date = null, $student_id = null )
    {
        $this->db->select( 'SUM(student_fee_payments_others.amount) AS sm' )
            ->from( 'student_fee_payments' )
            ->join( 'student_fee_payments_others', 'student_fee_payments_others.student_fee_payment_id = student_fee_payments.id', 'inner' );

        if ( $date !== null ) {
            $this->db->like( 'student_fee_payments.payment_date', date( 'Y-m-', strtotime( $date ) ), 'after' );
        }

        $this->db->where('student_id', $student_id );

        $q = $this->db->get();

        $sm = $q->row_array();
        $sm = intval( $sm['sm'] );

        return $sm;
    }

    public function other_fee_sum( $student_fee_payments_id = null )
    {
        $this->db->select_sum( 'amount', 'sm' )
            ->from( 'student_fee_payments_others' );
        if ( $student_fee_payments_id !== null && !empty( $student_fee_payments_id ) ) {
            if ( is_array( $student_fee_payments_id ) ) {
                $this->db->where_in( 'student_fee_payment_id', $student_fee_payments_id );
            } else {
                $this->db->where( 'student_fee_payment_id', $student_fee_payments_id );
            }
        }

        $q = $this->db->get();

        $sum = $q->row_array();

        return intval( $sum['sm'] );
    }

    public function student_other_fee_records( $student_id = null, $fee_name = null, $date_from = null, $date_to = null, $search_type = null )
    {
        $this->db->select( "`student_fee_payments`.`student_id`, `student_fee_payments`.`tuition_fee`, `student_fee_payments`.`due_fee`, `student_fee_payments`.`total_paid_fee`, `student_fee_payments`.`voucher_id`, `student_fee_payments`.`payment_date`, `student_fee_payments_others`.`student_fee_payment_id`, `student_fee_payments_others`.`fee_name`, `student_fee_payments_others`.`amount`" )
            ->from( 'student_fee_payments_others' )
            ->join( 'student_fee_payments', '`student_fee_payments`.`id` = `student_fee_payments_others`.`student_fee_payment_id`', 'inner' )
		    ->order_by( '`student_fee_payments`.`payment_date`', 'desc' );

        if ( $student_id !== null ) {
            $this->db->where( '`student_fee_payments`.`student_id`', $student_id );
        }

        if ( $date_from !== null ) {
            $this->db->where( '`student_fee_payments`.`payment_date` >=', $date_from );
        }
       
        
        if ( $date_to !== null ) {
            $this->db->where( '`student_fee_payments`.`payment_date` <=', $date_to );
        }
 
        if ( $fee_name !== null ) {
            $this->db->where( '`student_fee_payments_others`.`fee_name`', $fee_name );

            if ( $search_type !== null && $search_type == "paid" ) {
                $this->db->where( "`student_fee_payments_others`.`amount` >", 0 );
            }
        }

        $q = $this->db->get();
        // var_dump($this->db->last_query());
        // exit;
        return $q->result_array();
    }
    
    
    public function student_other_fee_records_test( $student_id = null, $fee_name = null, $date_from = null, $date_to = null, $search_type = null ,$month = null )
    {
        // $this->db->select( "`student_fee_payments`.`student_id`, `student_fee_payments`.`tuition_fee`, `student_fee_payments`.`due_fee`,`student_fee_payments`.`fine`, `student_fee_payments`.`total_paid_fee`, `student_fee_payments`.`voucher_id`, `student_fee_payments`.`payment_date`" )
        // ->from( 'student_fee_payments' )
        // ->join( 'student_fee_voucher', '`student_fee_payments`.`voucher_id` = `student_fee_voucher`.`id`', 'inner' )    
        //     ->order_by( '`student_fee_payments`.`payment_date`', 'desc' );


            $this->db->select( "`student_fee_payments`.`student_id`, `student_fee_payments`.`tuition_fee`, `student_fee_payments`.`due_fee`, `student_fee_payments`.`total_paid_fee`, `student_fee_payments`.`voucher_id`, `student_fee_payments`.`payment_date`, `student_fee_payments_others`.`student_fee_payment_id`, `student_fee_payments_others`.`fee_name`, `student_fee_payments_others`.`amount`" )
            ->from( 'student_fee_payments_others' )
            ->join( 'student_fee_payments', '`student_fee_payments`.`id` = `student_fee_payments_others`.`student_fee_payment_id`', 'inner' )
		    ->order_by( '`student_fee_payments`.`payment_date`', 'desc' );
             $this->db->where( '`student_fee_payments_others`.`amount` >', 0 ); 
           // $this->db->or_where('student_fee_payments.fine >', 0);

        if ( $student_id !== null ) {
            $this->db->where( '`student_fee_payments`.`student_id`', $student_id );
        }

         
        if ( !empty($month) ) {
            $this->db->where( 'MONTH(`student_fee_payments`.`payment_date`)',$month );
        }else{
            if ( $date_from !== null ) {
                $this->db->where( '`student_fee_payments`.`payment_date` >=', $date_from );
            }    
            if ( $date_to !== null ) {
                $this->db->where( '`student_fee_payments`.`payment_date` <=', $date_to );
            }
        }
       
        

        $q = $this->db->get();
        // var_dump($this->db->last_query());
        // exit;
        return $q->result_array();
    }

    public function student_other_fee_payment_class( $student_id = null,$class_id,$section_id, $fee_name = null, $date_from = null, $date_to = null, $search_type = null ,$month = null )
    {
        // $this->db->select( "`student_fee_payments`.`student_id`, `student_fee_payments`.`tuition_fee`, `student_fee_payments`.`due_fee`,`student_fee_payments`.`fine`, `student_fee_payments`.`total_paid_fee`, `student_fee_payments`.`voucher_id`, `student_fee_payments`.`payment_date`" )
        // ->from( 'student_fee_payments' )
        // ->join( 'student_fee_voucher', '`student_fee_payments`.`voucher_id` = `student_fee_voucher`.`id`', 'inner' )    
        //     ->order_by( '`student_fee_payments`.`payment_date`', 'desc' );


            $this->db->select( "`student_fee_payments`.`student_id`, `student_fee_payments`.`tuition_fee`, `student_fee_payments`.`due_fee`, `student_fee_payments`.`total_paid_fee`, `student_fee_payments`.`voucher_id`, `student_fee_payments`.`payment_date`, `student_fee_payments_others`.`student_fee_payment_id`, `student_fee_payments_others`.`fee_name`, `student_fee_payments_others`.`amount`" )
            ->from( 'student_fee_payments_others' )
            ->join( 'student_fee_payments', '`student_fee_payments`.`id` = `student_fee_payments_others`.`student_fee_payment_id`', 'inner' )

		    ->order_by( '`student_fee_payments`.`payment_date`', 'desc' );
             $this->db->where( '`student_fee_payments_others`.`amount` >', 0 ); 
           // $this->db->or_where('student_fee_payments.fine >', 0);
            if ( !empty( $class_id ) || !empty( $section_id ) ) {
                $this->db->join( 'student_session', 'student_session.student_id = student_fee_payments.student_id', 'inner' )
                ->join( 'sch_settings', 'sch_settings.session_id = student_session.session_id', 'inner' );
            }

            if ( !empty( $class_id ) ) {
                $this->db->where( 'student_session.class_id', $class_id );
            }
    
            if ( !empty( $section_id ) ) {
                $this->db->where( 'student_session.section_id', $section_id );
            }
            
        if ( $student_id !== null ) {
            $this->db->where( '`student_fee_payments`.`student_id`', $student_id );
        }

         
        if ( !empty($month) ) {
            $this->db->where( 'MONTH(`student_fee_payments`.`payment_date`)',$month );
        }else{
            if ( $date_from !== null ) {
                $this->db->where( '`student_fee_payments`.`payment_date` >=', $date_from );
            }    
            if ( $date_to !== null ) {
                $this->db->where( '`student_fee_payments`.`payment_date` <=', $date_to );
            }
        }
       
        

        $q = $this->db->get();
        // var_dump($this->db->last_query());
        // exit;
        return $q->result_array();
    }


	  public function student_other_fee_records2( $student_id = null, $fee_name = null, $date_from = null, $date_to = null, $search_type = null )
    {
        $this->db->select( "`student_fee_payments`.`student_id`, `student_fee_payments`.`tuition_fee`, `student_fee_payments`.`due_fee`, `student_fee_payments`.`total_paid_fee`, `student_fee_payments`.`payment_date`, `student_fee_payments_others`.`student_fee_payment_id`, `student_fee_payments_others`.`fee_name`, `student_fee_payments_others`.`amount`" )
            ->from( 'student_fee_payments_others' )
            ->join( 'student_fee_payments', '`student_fee_payments`.`id` = `student_fee_payments_others`.`student_fee_payment_id`', 'inner' )
		    ->order_by( '`student_fee_payments`.`payment_date`', 'desc' );

        if ( $student_id !== null ) {
            $this->db->where( '`student_fee_payments`.`student_id`', $student_id );
        }

        if ( $date_from !== null ) {
            $this->db->where( '`student_fee_payments`.`payment_date` >=', $date_from );
        }
		if ( $other !== null ) {
            $this->db->where( '`student_fee_payments`.`other` >=', $other );
        }

        if ( $date_to !== null ) {
            $this->db->where( '`student_fee_payments`.`payment_date` <=', $date_to );
        }
 
        if ( $fee_name !== null ) {
            $this->db->where( '`student_fee_payments_others`.`fee_name`', $fee_name );

            if ( $search_type !== null && $search_type == "paid" ) {
                $this->db->where( "`student_fee_payments_others`.`amount` >", 0 );
            }
        }

        $q = $this->db->get();
        // var_dump($this->db->last_query());
        // exit;
        return $q->result_array();
    }


    public function get_by_feename( $fee_name = null, $student_fee_payment_id = null, $order = 'DESC' )
    {
        $this->db->select( 'amount' )
            ->from( $this->table_name );

        if ( $fee_name !== null ) {
            $this->db->where( 'fee_name', $fee_name );
        } else {
            $this->db->order_by( 'id', $order );
        }

        if ( $student_fee_payment_id !== null ) {
            $this->db->where( 'student_fee_payment_id', $student_fee_payment_id );
        }

        $q = $this->db->get();
        if ( $q->num_rows() > 0 ) {
        
            $q = $q->row_array();
            return $q['amount'];
			
		
        } else {
            return false;
        }
    }
}