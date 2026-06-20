<?php

class Student_fee_voucher_model extends CI_Model
{


    public function __construct()
    {
        parent::__construct();
        $this->current_session = $this->setting_model->getCurrentSession();
    }
     public $table_name = "student_fee_voucher";

     public function get( $id = null, $student_id = null )
     {
        $this->db
            ->select( '*' )
            ->from( $this->table_name );

        if ( $id !== null ) {
            $this->db->where( 'id', $id );
        }
		
        $this->db->where( 'delete_v', 0 );
        if ( $student_id !== null ) {
            $this->db->where( 'student_id', $student_id );
        }

        $q = $this->db->get();

        $rows = $q->result_array();

        for ( $i = 0; $i < count( $rows ); $i++ ) {
            $rows[$i]['voucher_fee_types'] = $this->student_fee_voucher_fee_types_model->get( null, $rows[$i]['id'] );
        }
        if ( $id !== null ) {
            return ( !empty( $rows[0] ) ? $rows[0] : null );
        } else {
            return $rows;
        }
    }
	
	 public function get_reg_tuition( $id = null, $student_id = null )
     {
        $this->db
            ->select( '*' )
            ->from( $this->table_name );

        if ( $id !== null ) {
            $this->db->where( 'id', $id );
        }
		$this->db->where( 'student_fee_voucher.expire_date >=', date('Y-m-d', now()) );

        if ( $student_id !== null ) {
            $this->db->where( 'student_id', $student_id );
        }

        $q = $this->db->get();

        $rows = $q->result_array();

        for ( $i = 0; $i < count( $rows ); $i++ ) {
            $rows[$i]['voucher_fee_types'] = $this->student_fee_voucher_fee_types_model->get( null, $rows[$i]['id'] );
        }
        if ( $id !== null ) {
            return ( !empty( $rows[0] ) ? $rows[0] : null );
        } else {
            return $rows;
        }
    }

    public function get_unpaid( $student_id ,$id, $class_id=null, $section_id=null  )
    {
		$this->db->select( 'student_fee_voucher.*' )
            ->from( 'student_fee_voucher' );

        if ( !empty( $class_id ) || !empty( $section_id ) ) {
          $this->db->join( 'student_session', 'student_session.student_id = student_fee_voucher.student_id', 'inner' )
                ->join( 'sch_settings', 'sch_settings.session_id = student_session.session_id', 'inner' );
        }
		if ( !empty( $class_id ) ) {
            $this->db->where( 'student_session.class_id', $class_id );
        }
        if ( !empty( $section_id ) ) {
            $this->db->where( 'student_session.section_id', $section_id );
        }
		    
        $monthName = date('F', mktime(0, 0, 0, $date, 10));
        $month = '["'.$monthName.'"]';
        $month1 = date('m');
        $year =  date('Y');
        $days1 =cal_days_in_month( CAL_GREGORIAN, $month1, $year );
        $date_to  = "{$month1}/{$days1}/{$year}" ;
        $date_from  = "$month1/01/{$year}";
            $this->db->where( "student_fee_voucher.expire_date >=", date('Y-m-d', now())  );
        if ( $id !== null ) {
            $this->db->where( 'id', $id );
        }
        if ( $student_id !== null ) {
            $this->db->where( 'student_id', $student_id );
        }
		
            $this->db->where( 'paid', 0 );
            $this->db->where( 'other', 0 );
            $this->db->where( 'delete_v', 0 );
      
	    $q = $this->db->get();
        $rows = $q->result_array();
        for ( $i = 0; $i < count( $rows ); $i++ ) {
            $rows[$i]['voucher_fee_types'] = $this->student_fee_voucher_fee_types_model->get( null, $rows[$i]['id'] );
        }
        if ( $id !== null ) {
            return ( !empty( $rows[0] ) ? $rows[0] : null );
        } else {
            return $rows;
        }
    }

    public function get_unpaid_ajax( $student_id,$other )
    {
        $this->db->select( 'student_fee_voucher.*' )
            ->from( 'student_fee_voucher' );

        $this->db->where( 'other', $other );
        $this->db->where( 'paid', 0 );
        $this->db->where( 'delete_v', 0);

        if($other == 0){
        $this->db->where( "student_fee_voucher.expire_date >=", date('Y-m-d', now())  );
        }

        if ( $student_id !== null ) {
            $this->db->where( 'student_id', $student_id );
        }

        $q = $this->db->get();
        if($other == 0){
        $rows = $q->result();
        }else{
            $rows = $q->result_array();
            for ( $i = 0; $i < count( $rows ); $i++ ) {
                $rows[$i]['voucher_fee_types'] = $this->student_fee_voucher_fee_types_model->get( null, $rows[$i]['id'] );
            }
        }
            return $rows;
    }

    public function delete_voucher($id )
    {
        $date = date('Y-m-d H:i:s');
        $data = array(
            'delete_v   ' => 1,
            'updated_at' => $date,
        );
                   $this->db->where( 'id', $id );
        $update =  $this->db->update( 'student_fee_voucher', $data );
        if($update){
            return true;
        }else{
            return false;
        }
    
    }
    public function check_unpaid_current_month( $student_id,$month,$advance_fee )
     {
        $this->db->select( 'student_fee_voucher.*' )
            ->from( 'student_fee_voucher' );
        //    if($advance_fee == 1){
        //        $monthName = date('F', now());
        //        $month = '["'.$monthName.'"]';
        //        $this->db->where( 'month_names !=', $month );
        //    }
        // if($month != null && $advance_fee == 0){		 
        //     $this->db->where( 'month_names', $month );
        // }

        $this->db->where( "student_fee_voucher.expire_date >=", date('Y-m-d', now()));
        $this->db->where( 'paid', 0 );
        $this->db->where( 'other', 0 );
        $this->db->where( 'delete_v', 0 );

        if ( $student_id !== null ) {
            $this->db->where( 'student_id', $student_id );
        }


        $q = $this->db->get();
        $rows = $q->row();
        return $rows;
    }


    public function get_unpaid_sibling( $student_id ,$id )
    {
        $this->db->select( 'student_fee_voucher.id' )
            ->from( 'student_fee_voucher' );
        if ( !empty( $class_id ) || !empty( $section_id ) ) {
            $this->db->join( 'student_session', 'student_session.student_id = student_fee_voucher.student_id', 'inner' )
                ->join( 'sch_settings', 'sch_settings.session_id = student_session.session_id', 'inner' );
        }

        $monthName = date('F', mktime(0, 0, 0, $date, 10));
        $month = '["'.$monthName.'"]';
        $month1 = date('m');
        $year =  date('Y');
        $days1 =cal_days_in_month( CAL_GREGORIAN, $month1, $year );
        $date_to  = "{$month1}/{$days1}/{$year}" ;
        $date_from  = "$month1/01/{$year}";
        $this->db->where( "student_fee_voucher.expire_date >=", date('Y-m-d', now())  );
        if ( $id !== null ) {
            $this->db->where( 'id', $id );
        }
        if ( $student_id !== null ) {
            $this->db->where( 'student_id', $student_id );
        }
            $this->db->where( 'paid', 0 );
            $this->db->where( 'other', 0 );
        $q = $this->db->get();
        $rows = $q->row_array();

        return $rows['id'];

    }
	 public function get_unpaid2( $student_id ,$id, $class_id=null, $section_id=null, $month=null )
     {
	$this->db->select( 'classes.fee,students.id,students.fee_arrears,students.late_payment_fee,students.admission_no,students.discount,students.admission_date,students.roll_no,students.firstname,students.lastname,students.father_cnic,students.father_name,students.father_phone,classes.class,sections.section,student_fee_voucher.*,               
              students.discount' )
            ->from( 'students' );
		$this->db->join( 'student_session', 'student_session.student_id = students.id' );
        $this->db->join( 'classes', 'student_session.class_id = classes.id' );
        $this->db->join( 'sections', 'sections.id = student_session.section_id' );
		$this->db->join( 'student_fee_voucher', 'student_session.student_id = student_fee_voucher.student_id' );
        $this->db->order_by("students.id", "desc");
        $this->db->where( 'student_session.session_id', $this->current_session );
        $this->db->where( 'students.struck_off', 0 );
        $this->db->where( 'paid', 0);
        $this->db->where( 'other', 0);
        $this->db->where( 'delete_v', 0);
        $this->db->where( "student_fee_voucher.expire_date >=", date('Y-m-d', now()) );


        if ( !empty( $class_id ) ) {
            $this->db->where( 'student_session.class_id', $class_id );
        }

        if ( !empty( $section_id ) ) {
            $this->db->where( 'student_session.section_id', $section_id );
        }
            
         if(!empty($month)){
            $year = date('y');
            $month=    sprintf("%02d",$month);
            $month   =  date('F', strtotime('01-'.$month.'-'.$year));
            $this->db->like( 'student_fee_voucher.month_names', $month );
         }   


        if ( $id !== null ) {
            $this->db->where( 'id', $id );
        }

        if ( $student_id !== null ) {
            $this->db->where( 'student_id', $student_id );
        }
		 
	    $q = $this->db->get();
        $rows = $q->result_array();
        for ( $i = 0; $i < count( $rows ); $i++ ) {
            $rows[$i]['voucher_fee_types'] = $this->student_fee_voucher_fee_types_model->get( null, $rows[$i]['id'] );
        }
        if ( $id !== null ) {
            return ( !empty( $rows[0] ) ? $rows[0] : null );
        } else {
            return $rows;
        }
    }

    public function get_unpaid_other45( )
    {
       $this->db
           ->select( 'student_fee_voucher.id' )
           ->from( 'student_fee_voucher');
           $this->db->join( 'students', 'students.id = student_fee_voucher.student_id', 'inner' );
           $this->db->where( 'students.struck_off', 0 );
           $this->db->where( 'paid', 0 );
           $this->db->where( 'other', 1 );
           $this->db->where( 'delete_v', 0 );
       $q = $this->db->get();
       $rows = $q->result_array();
       $other = 0;
        for ( $i = 0; $i < count( $rows ); $i++ ) {
           $other += $this->student_fee_voucher_fee_types_model->get_sum_unpaid($rows[$i]['id']);
        }  
        return $other;
   }

     public function get_unpaid_other( $student_id ,$id )
     {
        $this->db
            ->select( '*' )
            ->from( $this->table_name );
             $unpaid= 0;
             $other = 1;
             $this->db->where( 'delete_v', 0 );
			$monthName = date('F', mktime(0, 0, 0, $date, 10));
			$month = '["'.$monthName.'"]';
        if ( $id !== null ) {
            $this->db->where( 'id', $id );
        }

        if ( $student_id !== null ) {
            $this->db->where( 'student_id', $student_id );
        }
		  if ( $unpaid !== null ) {
            $this->db->where( 'paid', $unpaid );
        }
		  if ( $unpaid !== null ) {
            $this->db->where( 'other', $other );
        }
        $q = $this->db->get();
        $rows = $q->result_array();
        for ( $i = 0; $i < count( $rows ); $i++ ) {
            $rows[$i]['voucher_fee_types'] = $this->student_fee_voucher_fee_types_model->get( null, $rows[$i]['id'] );
        }
        if ( $id !== null ) {
            return ( !empty( $rows[0] ) ? $rows[0] : null );
        } else {
            return $rows;
        }
    }

    public function get_unpaid_other_monthly( $student_id =null ,$id =null,$class_id =null, $section_id =null,$other_fee_types =null,$month=null  )
    {
     
      $this->db->select( 'sum(total_fee) as total_fee' )
           ->from( 'student_fee_voucher' );
           $this->db->join( 'students', 'students.id = student_fee_voucher.student_id', 'inner' );
           $this->db->join( 'student_session', 'student_session.student_id = students.id', 'inner' )
          ->join(  'sch_settings', 'sch_settings.session_id = student_session.session_id', 'inner' );
       
       $this->db->where( 'student_session.session_id', $this->current_session );
           
       if ( !empty( $class_id ) ) {
           $this->db->where( 'student_session.class_id', $class_id );
       }

       if ( !empty( $section_id ) ) {
           $this->db->where( 'student_session.section_id', $section_id );
       }
      
           if(!empty($month)){
               
               $year = date('y');
               $month=    sprintf("%02d",$month);
               
               if($month == 00){
                   $month = null;  
               }else{
                   $month   =  date('F', strtotime('01-'.$month.'-'.$year));
               }
              
               $this->db->like( 'student_fee_voucher.month_names', $month );
           }
   
           $this->db->where( 'students.struck_off', 0 );
           $this->db->where( 'student_fee_voucher.paid', 0 );
           $this->db->where( 'student_fee_voucher.other', 1);
           $this->db->where( 'delete_v', 0 );
       if ( $id !== null ) {
           $this->db->where( 'student_fee_voucher.id', $id );
       }
       
       if ( $student_id !== null ) {
           $this->db->where( 'students.id', $student_id );
       }
       $q = $this->db->get();
       $rows = $q->result();
       return empty($rows[0]->total_fee) ? 0 : floatval($rows[0]->total_fee) ;       
    }
	 public function get_unpaid_other2( $student_id ,$id,$class_id, $section_id,$other_fee_types,$month=null  )
     {
      
	   $this->db->select( 'student_fee_voucher.*' )
            ->from( 'student_fee_voucher' );
            $this->db->join( 'students', 'students.id = student_fee_voucher.student_id', 'inner' );
            $this->db->join( 'student_session', 'student_session.student_id = students.id', 'inner' )
           ->join(  'sch_settings', 'sch_settings.session_id = student_session.session_id', 'inner' );
        
        $this->db->where( 'student_session.session_id', $this->current_session );
        	
		if ( !empty( $class_id ) ) {
            $this->db->where( 'student_session.class_id', $class_id );
        }

        if ( !empty( $section_id ) ) {
            $this->db->where( 'student_session.section_id', $section_id );
        }
       
            if(!empty($month)){
                
                $year = date('y');
                $month=    sprintf("%02d",$month);
                
                if($month == 00){
                    $month = null;  
                }else{
                    $month   =  date('F', strtotime('01-'.$month.'-'.$year));
                }
               
                $this->db->like( 'student_fee_voucher.month_names', $month );
            }
    
            $this->db->where( 'students.struck_off', 0 );
            $this->db->where( 'student_fee_voucher.paid', 0 );
            $this->db->where( 'student_fee_voucher.other', 1);
            $this->db->where( 'delete_v', 0 );
        if ( $id !== null ) {
            $this->db->where( 'student_fee_voucher.id', $id );
        }
        
        if ( $student_id !== null ) {
            $this->db->where( 'students.id', $student_id );
        }
        $q = $this->db->get();
        $rows = $q->result_array();
       
        for ( $i = 0; $i < count( $rows ); $i++ ) {
			 $rows[$i]['voucher_fee_types'] = $this->student_fee_voucher_fee_types_model->get2( null, $rows[$i]['id'],$other_fee_types );
         }
         
		
		 if ( $id !== null ) {
            return ( !empty( $rows[0] ) ? $rows[0] : null );
        } else {
            return $rows;
        }
    }
    public function get_unpaid_others_total_fee( $student_id =null  )
    {
        $this->db->select( 'SUM(total_fee) as total_other' )
        ->from( 'student_fee_voucher' ) 
        ->where( 'student_fee_voucher.paid', 0 ) 
        ->where( 'student_fee_voucher.other', 1) 
        ->where( 'student_fee_voucher.delete_v', 0 );
         
        if ( $student_id !== null ) {
            $this->db->where( 'student_fee_voucher.student_id', $student_id );
        }

        $q = $this->db->get();
        $rows = $q->row();
        return $rows;
    }
    public function get_unpaid_other_struck_off( $student_id ,$id,$class_id, $section_id,$other_fee_types,$current_session= null   )
    {
     
      $this->db->select( 'student_fee_voucher.*' )
           ->from( 'student_fee_voucher' );
           $this->db->join( 'students', 'students.id = student_fee_voucher.student_id', 'inner' );
           $this->db->join( 'student_session', 'student_session.student_id = students.id', 'inner' );
         // ->join(  'sch_settings', 'sch_settings.session_id = student_session.session_id', 'inner' );
       
       
        if($current_session != null){
            $this->db->where( 'student_session.session_id', $current_session );
        }else{
            $this->db->where( 'student_session.session_id', $this->current_session );
        }
        if ( !empty( $class_id ) ) {
            $this->db->where( 'student_session.class_id', $class_id );
        }

        if ( !empty( $section_id ) ) {
            $this->db->where( 'student_session.section_id', $section_id );
        }
          
           $monthName = date('F', mktime(0, 0, 0, $date, 10));
           $month = '["'.$monthName.'"]';
           
          
           $this->db->where( 'student_fee_voucher.paid', 0 );
           $this->db->where( 'student_fee_voucher.other', 1);
   
           
       if ( $id !== null ) {
           $this->db->where( 'student_fee_voucher.id', $id );
       }

       if ( $student_id !== null ) {
           $this->db->where( 'students.id', $student_id );
       }
           

       $q = $this->db->get();

       $rows = $q->result_array();
   //     echo "<pre>";
   //     print_r($rows);
   //     echo "</pre>";

   //    exit;
       for ( $i = 0; $i < count( $rows ); $i++ ) {
           
            $rows[$i]['voucher_fee_types'] = $this->student_fee_voucher_fee_types_model->get2( null, $rows[$i]['id'],$other_fee_types );
   
   
        }
       
        if ( $id !== null ) {
           return ( !empty( $rows[0] ) ? $rows[0] : null );
       } else {
           return $rows;
       }
   }
    public function get_unpaid_other_struck( $student_id ,$id,$class_id, $section_id,$other_fee_types  )
    {
        
      $this->db->select( 'SUM(student_fee_voucher.total_fee) as other_fee' )
           ->from( 'student_fee_voucher' );

       if ( !empty( $class_id ) || !empty( $section_id ) ) {
           $this->db->join( 'student_session', 'student_session.student_id = student_fee_voucher.student_id', 'inner' )
               ->join( 'sch_settings', 'sch_settings.session_id = student_session.session_id', 'inner' );
       }
       
       if ( !empty( $class_id ) ) {
           $this->db->where( 'student_session.class_id', $class_id );
       }

       if ( !empty( $section_id ) ) {
           $this->db->where( 'student_session.section_id', $section_id );
       }
           $unpaid= 0;
           $other = 1;
          
            
       if ( $id !== null ) {
           $this->db->where( 'id', $id );
       }

       if ( $student_id !== null ) {
           $this->db->where( 'student_id', $student_id );
       }
         if ( $unpaid !== null ) {
           $this->db->where( 'paid', $unpaid );
       }
         if ( $unpaid !== null ) {
           $this->db->where( 'other', $other );
       }

       $q = $this->db->get();

       $rows = $q->row()->other_fee;
    
        if ( $id !== null ) {
           return ( !empty( $rows[0] ) ? $rows[0] : null );
       } else {
           return $rows;
       }
   }

  	 public function get_paid( $student_id ,$id,$date )
     {
        $this->db
            ->select( '*' )
            ->from( $this->table_name );
             $paid= 1;
			 $monthName = date('F', mktime(0, 0, 0, $date, 10));
			$month = '["'.$monthName.'"]';
        if ( $id !== null ) {
            $this->db->where( 'id', $id );
        }

        if ( $student_id !== null ) {
            $this->db->where( 'student_id', $student_id );
        }
		  if ( $unpaid !== null ) {
            $this->db->where( 'paid', $paid );
        }
		  if ( $month !== null ) {
            $this->db->where( 'month_names', $month );
        }
        $q = $this->db->get();
        $rows = $q->result_array();
        for ( $i = 0; $i < count( $rows ); $i++ ) {
            $rows[$i]['voucher_fee_types'] = $this->student_fee_voucher_fee_types_model->get( null, $rows[$i]['id'] );
        }
        if ( $id !== null ) {
            return ( !empty( $rows[0] ) ? $rows[0] : null );
        } else {
            return $rows;
        }
    }
}
