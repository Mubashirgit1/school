<?php

class Student_fee_payments extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->current_session = $this->setting_model->getCurrentSession();
        $this->load->model( 'student_fee_payments_other' );
    }
    public $table_name = "student_fee_payments";
    
	/**
     * Gets student fee payment
     * @param null $id
     * @param null $student_id
     * @param null $limit
     * @param null $order
     * @param null $year_month i.e. 2010-10-
     * @return bool|array
     */

     public function get( $id = null, $student_id = null, $limit = null, $order = null, $year_month = null )
     {
        if ( $order === null ) {
            $order = "DESC";
        }

        $this->db->select( '*' )
            ->from( $this->table_name );

        if ( $id !== null ) {
            $this->db->where( 'id', $id );
        } else {
            $this->db->order_by( 'id', $order );
        }

        if ( $student_id !== null ) {
            $this->db->where( 'student_id', $student_id );
        }

        if ( $limit !== null ) {
            $this->db->limit( $limit );
        }

        if ( $year_month !== null ) {
            $this->db->like( 'payment_date', $year_month, 'after' );
        }

        $q = $this->db->get();

        if ( $q->num_rows() > 0 ) {
            $rows = $q->result_array();

            for ( $i = 0; $i < count( $rows ); $i++ ) {
                $rows[$i]['other_fee_payments'] = $this->student_fee_payments_other->get( null, $rows[$i]['id'] );
            }

            if ( $id === null ) {
                return $rows;
            } else {
                return $rows[0];
            }
        } else {
            return false;
        }
    }

     public function current_payments($year_month_data)
     {
        $q = $this->db->distinct()
            ->select( 'student_session.*,student_fee_payments.id as payment_id,student_fee_payments.student_id,student_fee_payments.tuition_fee,student_fee_payments.due_fee,student_fee_payments.total_paid_fee,student_fee_payments.payment_date' )
            ->from( 'student_fee_payments' )
            ->join( 'student_session', 'student_session.student_id = student_fee_payments.student_id' );
                
            if (!empty($year_month_data['year']) &&  !empty($year_month_data['month']) ) {
                $current_month = $year_month_data['year']."-".$year_month_data['month']."-1";
                $current_month_l = $year_month_data['year']."-".$year_month_data['month']."-31";
                
                $this->db->where( 'payment_date >=', date($current_month));
                $this->db->where( 'payment_date <=', date($current_month_l));
            }else{
                $this->db->where( 'payment_date <', date("Y-m-1"));
            }
         $q = $this->db->get();
         if ( $q->num_rows() > 0 ) {
            $rows = $q->result_array();

            for ( $i = 0; $i < count( $rows ); $i++ ) {
                $rows[$i]['late_payment_fee'] = $this->student_fee_payments_other->get_by_feename('late fee fine', $rows[$i]['payment_id'] );
            }

            if ( $id === null ) {
                return $rows;
            } else {
                return $rows[0];
            }
        } else {
            return false;
        }
        // var_dump($this->db->last_query());exit;
        // return $q->result_array();
        
    }

     public function search( $class_id, $section_id, $date_from, $date_to, $fee_payment_types,$search_type = null)
     {
		
	   $this->db->select( 'student_fee_payments.*' )
            ->from( 'student_fee_payments' );
            
		if ( !empty( $class_id ) || !empty( $section_id ) ) {
            $this->db->join( 'student_session', 'student_session.student_id = student_fee_payments.student_id', 'inner' )
                ->join( 'sch_settings', 'sch_settings.session_id = student_session.session_id', 'inner' );
        }

           $this->db->order_by("payment_date", "asc");
		   $this->db->where( 'student_fee_payments.voucher_id  !=', 1 );
        if ( !empty( $class_id ) ) {
            $this->db->where( 'student_session.class_id', $class_id );
        }

        if ( !empty( $section_id ) ) {
            $this->db->where( 'student_session.section_id', $section_id );
        }
        
        if ( $search_type !== null && $search_type == "paid" ) {
            if ( !empty( $date_from ) ) {
                $date_from = date( 'Y-m-d', strtotime( $date_from ) );
                $this->db->where( 'student_fee_payments.payment_date >=',  $date_from.' 00:00:00'  );
            }
            if ( !empty( $date_to ) ) {
                $date_to = date( 'Y-m-d', strtotime( $date_to ) );
                $this->db->where( 'student_fee_payments.payment_date <=',   $date_to.' 23:59:59' );
            }
        }elseif( $search_type !== null && $search_type == "pending" ){
            $date_from  = date('Y-m-d',strtotime('first day of this month'));
            $this->db->where( 'student_fee_payments.payment_date <', $date_from );
        }

        if ( !empty( $fee_payment_types ) ) {
            $this->db->join( 'student_fee_payments_others', 'student_fee_payments_others.student_fee_payment_id = student_fee_payments.id', 'inner' );

            $this->db->where_in( 'student_fee_payments_others.fee_name', $fee_payment_types );
            if ( $search_type !== null && $search_type == "paid" ) {
                $this->db->where( 'student_fee_payments_others.amount >', 0 );
            }
        }

        $this->db->order_by( 'student_id');
        $q = $this->db->get();
        // var_dump($this->db->last_query());
        // exit;
        if ( $q->num_rows() > 0 ) {
            return $q->result_array();
        } else {
            return false;
        }
    }

    public function monthly_fee_data( $class_id, $section_id)
    {
        $this->db->select( 'student_fee_payments.*' )
            ->from( 'student_fee_payments' );
        if ( !empty( $class_id ) || !empty( $section_id ) ) {
            $this->db->join( 'student_session', 'student_session.student_id = student_fee_payments.student_id', 'inner' )
                ->join( 'sch_settings', 'sch_settings.session_id = student_session.session_id', 'inner' );
        }
        $this->db->where( 'student_fee_payments.voucher_id  !=', 1 );
        if ( !empty( $class_id ) ) {
            $this->db->where( 'student_session.class_id', $class_id );
        }
        if ( !empty( $section_id ) ) {
            $this->db->where( 'student_session.section_id', $section_id );
        }
        $date_from  = date('Y-m-d',strtotime('first day of this month'));
        $this->db->where( 'student_fee_payments.payment_date >=',  $date_from.' 00:00:00'  );
        $date_to = date( 'Y-m-d', now() );
        $this->db->where( 'student_fee_payments.payment_date <=',   $date_to.' 23:59:59' );
        $q = $this->db->get();
        $student_payments  = $q->result_array();
        if ( $student_payments !== false ) {
            $std_id = NULL;
            $student_fee_payments = array();
            $total = new stdClass();
            $total->other_fee       = 0;
            $total->tuition_fee_paid = 0;
            $total->arrears         = 0;
            $total->fine         = 0;
            foreach ($student_payments as $key => $s_payments) {
                if(empty($std_id) || $std_id != $s_payments['student_id']){
                    $late_payment_fee = $this->student_fee_payments_other->get_by_feename('Fine for late fee payment', $s_payments['id'] );
                    $total->fine  +=  $late_payment_fee;
//                    if($late_payment_fee == null){
//                        $student_fee_fine_type = $this->custom_option_model->get( 'fine_per_day_for_fee');
//                        $late_payment_fee =   $student_fee_fine_type['value'];
//                    }
                    $student_fee_payments[$key]["late_payment_fee"] =  $late_payment_fee;
                    $student_fee_payments[$key]["student_id"]       =  $s_payments['student_id'];
                    $student_fee_payments[$key]["tuition_fee"]      =  $s_payments['tuition_fee'];
                    $student_fee_payments[$key]["due_fee"]          =  $s_payments['due_fee'];
                    $student_fee_payments[$key]["total_paid_fee"]   =  $s_payments['total_paid_fee'];
                    $std_num =  $key;
                }else{
                    foreach ($student_fee_payments as $sfpkey => $sfp) {
                        if ($sfp["student_id"] == $s_payments['student_id']) {
                            if ($s_payments['due_fee'] > $student_fee_payments[$std_num]["due_fee"]) {
                                $student_fee_payments[$key]["due_fee"]               =  $s_payments['due_fee'];
                            }
                            $student_fee_payments[$std_num]["tuition_fee"]          +=  $s_payments['tuition_fee'];
                            $student_fee_payments[$std_num]["total_paid_fee"]       +=  $s_payments['total_paid_fee'];
                            $student_fee_payments[$std_num]["payment_date"]          =  $s_payments['payment_date'];
                        }
                    }
                }
                $std_id  = $s_payments['student_id'];
            }
            $student_fee_payments = array_values($student_fee_payments);
            for ( $i = 0; $i < count( $student_fee_payments ); $i++ ) {
                $student_fee_payments[$i]['student'] = $this->student_model->get_student_fee_discount( $student_fee_payments[$i]['student_id'] );
            }
        }


        foreach ( $student_fee_payments as $key=>$student_fee_payment ) {
            $discount_fee =  intval($student_fee_payment['student']['fee'])- intval($student_fee_payment['student']['discount']);
            if ($student_fee_payment['due_fee'] > 0 ) {   //50>0
                $current_month_arrears = intval($student_fee_payment['due_fee']) -intval($discount_fee) - intval($student_fee_payment['late_payment_fee']);    // cur 50
                if ($student_fee_payment['tuition_fee'] <= $current_month_arrears) {  // 100<=50
                    $arrears = intval($student_fee_payment['tuition_fee']);
                    $tuition_fee = 0;
                    $advance = 0;
                }elseif (intval($student_fee_payment['tuition_fee']) > intval($current_month_arrears)){
                    $arrears = $current_month_arrears;
                    $tuition_fee_left   = $student_fee_payment['tuition_fee'] - $arrears;
                    if ($tuition_fee_left < $discount_fee) {
                        if($tuition_fee_left<=$current_month_arrears) { //1500 >= -750
                            if($current_month_arrears < 0 ){
                                $tuition_fee =  $current_month_arrears + $discount_fee ;
                            }else{
                                $tuition_fee=  $tuition_fee_left  ;
                            }
                        }else{
                            if($current_month_arrears < 0){
                                $tuition_fee   = $tuition_fee_left + $current_month_arrears  ;
                            }else{
                                $tuition_fee   = $tuition_fee_left  ;
                            }
                        }
                        $advance = 0;
                    }elseif($tuition_fee_left >= $discount_fee){
                        if( $current_month_arrears <= 0 ){   //2500
                            $tuition_fee = $current_month_arrears  + $discount_fee;
                        }else{
                            if($tuition_fee_left >=  $current_month_arrears ){
                                $tuition_fee =  $discount_fee ;
                            }else{
                                $tuition_fee =  $discount_fee ;
                            }
                        }
                        $tuition_fee_left   = $tuition_fee_left - $discount_fee; //50-0
                        $advance            = $tuition_fee_left;     // a= 50
                    }
                }
            }
            elseif($student_fee_payment['due_fee'] <= 0){
                $tuition_fee = 0;
                $arrears     = 0;
                $advance     = $student_fee_payment['tuition_fee'];
            }
            if ($arrears < 0) {
                $arrears = 0;
            }
            $total->tuition_fee_paid += $tuition_fee;
            $total->arrears  += $arrears;
            $total->advance  += abs($advance);
            $others = $student_fee_payment["total_paid_fee"] - $student_fee_payment["tuition_fee"];
            $total->other_fee += $others;
        }
        return $total;
    }
    public function monthly_fee_data2( $class_id, $section_id)
    {
        $this->db->select( 'classes.fee,students.id,students.fee_arrears,  
             students.late_payment_fee, students.late_payment_fee_update_date,
          students.updated_at,students.struck_off, students.discount, student_fee_payments.*' )
            ->from( 'students' );
          $this->db->join( 'student_fee_payments', 'students.id = student_fee_payments.student_id', 'inner' )
             ->join( 'student_session', 'student_session.student_id = student_fee_payments.student_id', 'inner' )
             ->join( 'sch_settings', 'sch_settings.session_id = student_session.session_id', 'inner' )
             ->join( 'sections', 'sections.id = student_session.section_id', 'inner' )
             ->join( 'classes', 'student_session.class_id = classes.id', 'inner' );

        $this->db->where( 'student_fee_payments.voucher_id  !=', 1 );
        if ( !empty( $class_id ) ) {
            $this->db->where( 'student_session.class_id', $class_id );
        }
        if ( !empty( $section_id ) ) {
            $this->db->where( 'student_session.section_id', $section_id );
        }
        $date_from  = date('Y-m-d',strtotime('first day of this month'));
        $this->db->where( 'student_fee_payments.payment_date >=',  $date_from.' 00:00:00'  );
        $date_to = date( 'Y-m-d', now() );
        $this->db->where( 'student_fee_payments.payment_date <=',   $date_to.' 23:59:59' );
        $q = $this->db->get();
        $student_payments  = $q->result_array();
        if ( $student_payments !== false ) {
            $total = new stdClass();
            $total->other_fee       = 0;
            $total->tuition_fee_paid = 0;
            $total->arrears         = 0;
            $total->fine         = 0;
        }
        
        foreach ( $student_payments as $key=>$student_fee_payment ) {

            $late_payment_fee = $student_fee_payment['fine'];
            if($student_fee_payment['fine_check']  == 1 ){
                $total->fine  +=  $student_fee_payment['paid_fine'];
            }
            
            $discount_fee =  intval($student_fee_payment['fee'])- intval($student_fee_payment['discount']);
            if ($student_fee_payment['due_fee'] > 0 ) {   //50>0
                $current_month_arrears = intval($student_fee_payment['due_fee']) -intval($discount_fee) - intval($late_payment_fee);    // cur 50
                if ($student_fee_payment['tuition_fee'] <= $current_month_arrears) {  // 100<=50
                    $arrears = intval($student_fee_payment['tuition_fee']);
                    $tuition_fee = 0;
                    $advance = 0;
                }elseif (intval($student_fee_payment['tuition_fee']) > intval($current_month_arrears)){
                    $arrears = $current_month_arrears;
                    $tuition_fee_left   = $student_fee_payment['tuition_fee'] - $arrears;
                    if ($tuition_fee_left < $discount_fee) {
                        if($tuition_fee_left<=$current_month_arrears) { //1500 >= -750
                            if($current_month_arrears < 0 ){
                                $tuition_fee =  $current_month_arrears + $discount_fee ;
                            }else{
                                $tuition_fee=  $tuition_fee_left  ;
                            }
                        }else{
                            if($current_month_arrears < 0){
                                $tuition_fee   = $tuition_fee_left + $current_month_arrears  ;
                            }else{
                                $tuition_fee   = $tuition_fee_left  ;
                            }
                        }
                        $advance = 0;
                    }elseif($tuition_fee_left >= $discount_fee){
                        if( $current_month_arrears <= 0 ){   //2500
                            $tuition_fee = $current_month_arrears  + $discount_fee;
                        }else{
                            if($tuition_fee_left >=  $current_month_arrears ){
                                $tuition_fee =  $discount_fee ;
                            }else{
                                $tuition_fee =  $discount_fee ;
                            }
                        }
                        $tuition_fee_left   = $tuition_fee_left - $discount_fee; //50-0
                        $advance            = $tuition_fee_left;     // a= 50
                    }
                }
            }
            elseif($student_fee_payment['due_fee'] <= 0){
                $tuition_fee = 0;
                $arrears     = 0;
                $advance     = $student_fee_payment['tuition_fee'];
            }
            if ($arrears < 0) {
                $arrears = 0;
            }
            $total->tuition_fee_paid += $tuition_fee;
            $total->arrears  += $arrears;
            $total->advance  += abs($advance);
            $others = $student_fee_payment["total_paid_fee"] - $student_fee_payment["tuition_fee"] -$student_fee_payment['paid_fine'] ;
            $total->other_fee += $others;
        }
        return $total;
    }

    public function payment_fine_sum(){
        $this->db->select( 'SUM(student_fee_payments.fine) as fine ,SUM(student_fee_payments.paid_fine) as paid_fine' )
        ->from( 'student_fee_payments' );
        $this->db->where( 'student_fee_payments.payment_date >=',  date( 'Y-m-1')." 00:00:00"   );
        $this->db->where( 'student_fee_payments.fine_check', 0);
        $q = $this->db->get();
        return $q->row_array();

    }
 public function search_free_month_balance(  $date_from, $date_to)
     {
	   $this->db->select( 'SUM(student_fee_payments.paid_fine) as fine' )
            ->from( 'student_fee_payments' );
        
       
        $where = '(student_fee_payments.voucher_id="1" or student_fee_payments.fine_check = "0")';
        $this->db->where($where);
        
        $date_to =  $date_to == null ?  date( 'Y-m-t') :  $date_to;
        $date_from =  $date_from == null ?  date( 'Y-m-1') :  $date_from;
     
            if ( !empty( $date_from ) ) {
          
                $this->db->where( 'student_fee_payments.payment_date >=',  $date_from." 00:00:00"   );
            }
            if ( !empty( $date_to ) ) {
 
                $this->db->where( 'student_fee_payments.payment_date <=',   $date_to." 23:59:59" );
            }
        
        $q = $this->db->get();
        if ( $q->num_rows() > 0 ) {
            return $q->result();
        } else {
            return false;
        }
    }
    public function search_free_month( $class_id, $section_id, $date_from, $date_to, $fee_payment_types,$search_type = null, $student_id = null,$current_session)
     {
	   $this->db->select( 'student_fee_payments.*' )
            ->from( 'student_fee_payments' );
        if ( !empty( $class_id ) || !empty( $section_id ) ) {
         $this->db->join( 'student_session', 'student_session.student_id = student_fee_payments.student_id', 'inner' );
        }

        if($current_session != null){
            $this->db->join( 'student_session', 'student_session.student_id = student_fee_payments.student_id', 'inner' );
            $this->db->where( 'student_session.session_id', $current_session );
           
        }else{
            $this->db->join( 'student_session', 'student_session.student_id = student_fee_payments.student_id', 'inner' );  
            $this->db->where( 'student_session.session_id', $this->current_session );
        }


        if ( !empty( $class_id ) ) {
            $this->db->where( 'student_session.class_id', $class_id );
        }
        if ( !empty( $section_id ) ) {
            $this->db->where( 'student_session.section_id', $section_id );
        }
		  if ( !empty( $student_id ) ) {
            $this->db->where( 'student_fee_payments.student_id', $student_id );
        }
        
        $where = '(student_fee_payments.voucher_id="1" or (student_fee_payments.fine_check = "0" and  student_fee_payments.fine > 0) )';
        $this->db->where($where);
        
        if ( $search_type !== null && $search_type == "paid" ) {
            if ( !empty( $date_from ) ) {
                $date_from = date( 'Y-m-d', strtotime( $date_from ) );
                $this->db->where( 'student_fee_payments.payment_date >=',  $date_from." 00:00:00"   );
            }
            if ( !empty( $date_to ) ) {
                $date_to = date( 'Y-m-d', strtotime( $date_to ) );
                $this->db->where( 'student_fee_payments.payment_date <=',   $date_to." 23:59:59" );
            }
        }elseif( $search_type !== null && $search_type == "pending" ){
            $date_from  = date('Y-m-d',strtotime('first day of this month'));
            $this->db->where( 'student_fee_payments.payment_date <', $date_from." 23:59:59" );
        }

        if ( !empty( $fee_payment_types ) ) {
            $this->db->join( 'student_fee_payments_others', 'student_fee_payments_others.student_fee_payment_id = student_fee_payments.id', 'inner' );

            $this->db->where_in( 'student_fee_payments_others.fee_name', $fee_payment_types );
            if ( $search_type !== null && $search_type == "paid" ) {
                $this->db->where( 'student_fee_payments_others.amount >', 0 );
            }
        }

        $this->db->order_by( 'student_id');
        $q = $this->db->get();
        // var_dump($this->db->last_query());
        // exit;
        if ( $q->num_rows() > 0 ) {
            return $q->result_array();
        } else {
            return false;
        }
    }

     public function search_fee_waive( $class_id, $section_id)
    {
        $this->db->select( 'student_fee_payments.*' )
            ->from( 'student_fee_payments' );
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
                $this->db->where( 'student_fee_payments.voucher_id', 1 );
                $date_from = date( 'Y-m-01', now() );
                $this->db->where( 'student_fee_payments.payment_date >=',  $date_from." 00:00:00"   );
                $date_to = date( 'Y-m-t', now() );
                $this->db->where( 'student_fee_payments.payment_date <=',   $date_to." 23:59:59" );
        $q = $this->db->get();
        $rows =  $q->result_array();
        $data = [];
        $data['total_fee_waive'] = 0;
        $data['total_arrears_waive'] = 0;
        $data['total_advance_waive'] = 0;
        $data['fine_paid']  = 0;
        $data['other_waive']  = 0;
        foreach ($rows as $key => $row) {
                if($row['other_waive'] !== null){
                    $data['other_waive'] += $row['total_paid_fee'];
                }
            
            $late_payment_fee = $this->student_fee_payments_other->get_by_feename('Fine for late fee payment', $row['id'] );
            $discount_fee  = 0;
            $student = $this->student_model->getStudents($row['student_id'],'collection');
            $discount_fee =  intval( $student['fee']) - intval( $student['discount']);
            if ($row['due_fee'] > 0 ) {   //50>0
                $current_month_arrears = intval($row['due_fee']) -intval($discount_fee) - intval($late_payment_fee);    // cur 50
                if ($row['tuition_fee'] <= $current_month_arrears) {  // 100<=50
                    $arrears = intval($row['tuition_fee']);
                    $tuition_fee = 0;
                    $advance = 0;
                }elseif (intval($row['tuition_fee']) > intval($current_month_arrears)){
                    $arrears = $current_month_arrears;
                    $tuition_fee_left   = $row['tuition_fee'] - $arrears;
                    if ($tuition_fee_left < $discount_fee) {
                        if($tuition_fee_left<=$current_month_arrears) { //1500 >= -750
                            if($current_month_arrears < 0 ){
                                $tuition_fee =  $current_month_arrears + $discount_fee ;
                            }else{
                                $tuition_fee=  $tuition_fee_left  ;
                            }
                        }else{
                            if($current_month_arrears < 0){
                                $tuition_fee   = $tuition_fee_left + $current_month_arrears  ;
                            }else{
                                $tuition_fee   = $tuition_fee_left  ;
                            }
                        }
                        $advance = 0;
                    }elseif($tuition_fee_left >= $discount_fee){
                        if( $current_month_arrears <= 0 ){   //2500
                            $tuition_fee = $current_month_arrears  + $discount_fee;
                        }else{
                            if($tuition_fee_left >=  $current_month_arrears ){
                                $tuition_fee =  $discount_fee ;
                            }else{
                                $tuition_fee =  $discount_fee ;
                            }
                        }
                        $tuition_fee_left   = $tuition_fee_left - $discount_fee; //50-0
                        $advance            = $tuition_fee_left;     // a= 50
                    }
                }
            }
            elseif($row['due_fee'] <= 0){
                $tuition_fee = 0;
                $arrears     = 0;
                $advance     = $row['tuition_fee'];
            }
            if ($arrears < 0) {
                $arrears = 0;
            }

                

            $data['total_fee_waive'] += $tuition_fee;
            $data['total_arrears_waive'] += $arrears;
            $data['total_advance_waive'] += abs($advance);
            $data['fine_paid'] += $late_payment_fee;
        }
        return $data;
    }

     public function search2(  $date_from, $date_to )
     {
  	  $this->db->select( 'student_fee_payments.*' )
	  
            ->from( 'student_fee_payments' );
			
                $date_from = date( 'Y-m-d', strtotime( $date_from ) );
                $this->db->where( 'student_fee_payments.payment_date >=', $date_from );
                $date_to = date( 'Y-m-d', strtotime( $date_to ) );
	            $this->db->where( 'student_fee_payments.payment_date <=', $date_to );
			

        $this->db->order_by( 'student_id');
        $q = $this->db->get();
        // var_dump($this->db->last_query());
        // exit;
        if ( $q->num_rows() > 0 ) {
            return $q->result_array();
        } else {
            return false;
        }


    }
	
	 public function search3(  $date_from, $date_to )
     {
		  
		$this->db->select( 'student_fee_payments.*' )	  
        ->from( 'student_fee_payments' );
        $date_from = date( 'Y-m-d', strtotime( $date_from ) );
        $this->db->where( 'student_fee_payments.payment_date >=', $date_from );
        $date_to = date( 'Y-m-d', strtotime( $date_to ) );
        $this->db->where( 'student_fee_payments.payment_date <=', $date_to );
        $this->db->order_by( 'student_id');
        
        $q = $this->db->get();
        // var_dump($this->db->last_query());
        // exit;
        if ( $q->num_rows() > 0 ) {
            return $q->result_array();
			
			
			
        } else {
            return false;
        }


    }
	
     public function add_fee_other( $student_details, $tuition_fee, $other_fee_types, $date = null ,$late_fee_payment_fine, $fee_description = '',$voucher_id = null ,$user_id )
     {

      // setting date to current date if it is null
		
        $date = ( $date !== null ? $date : date( 'Y-m-d', now() ) );



        $total_paid_fee = 0;
        $total_paid_fee += intval( $tuition_fee );


        foreach ( $other_fee_types as $other_fee_type ) {
            $total_paid_fee += intval( $other_fee_type['amount'] );
        }
		if ($voucher_id == null) {
            $voucher_id = 0;
        }
		
		
        $this->db->trans_start();

        $this->db->insert( 'student_fee_payments', [
            'student_id'        => $student_details['id'],
            'tuition_fee'       => $tuition_fee,
            'due_fee'           => $student_details['fee_arrears'],
            'total_paid_fee'    => $total_paid_fee,
            'fee_description'   => $fee_description,
            'voucher_id'        => $voucher_id,
            'user_id'           => $user_id,
			'payment_date'      => date( 'Y-m-d h:i:s', strtotime( $date ) )
        ] );

        $insert_id = $this->db->insert_id();

        // adding other fee types in the database
        foreach ( $other_fee_types as $other_fee_type ) {
            $this->db->insert( 'student_fee_payments_others', [
                'student_fee_payment_id' => $insert_id,
                'fee_name' => $other_fee_type['name'],
                'amount' => $other_fee_type['amount']
            ] );
        }
        $this->db->trans_complete();

        if ( $this->db->trans_status() ) {
            return $insert_id;
        } else {
            return false;
        }

    }

    
     public function add_fee( $student_details, $tuition_fee, $other_fee_types, $date = null ,$late_fee_payment_fine, $fee_description = '',$voucher_id = null ,$user_id,$late_fee_payment_fine_check, $waive_voucher = null , $fine,$reprint ,$reprint_check )
     {
      // setting date to current date if it is null
        $date = ( $date !== null ? $date : date( 'Y-m-d', now() ) );
        $total_paid_fee = 0;
        $total_paid_fee += intval( $tuition_fee );
        foreach ( $other_fee_types as $other_fee_type ) {
            $total_paid_fee += intval( $other_fee_type['amount'] );
        }
        if ($voucher_id == null) {
            $voucher_id = 0;
        }
        
        if($reprint_check == 1){
            $reprint_paid  = $reprint;
            $reprint_waive = 0;
        }else{
            $reprint_paid  = 0;
            $reprint_waive = $reprint;
        }

        $this->db->trans_start();
        $late_fee_payment_fine   = ( $late_fee_payment_fine != null ?  $late_fee_payment_fine  : 0);
        $this->db->insert( 'student_fee_payments', [
            'student_id'        => $student_details['id'],
            'tuition_fee'       => $tuition_fee,
            'due_fee'           => $student_details['fee_arrears'],
            'total_paid_fee'    => $total_paid_fee,
            'fee_description'   => $fee_description,
            'voucher_id'        => $voucher_id,
            'user_id'           => $user_id,
            'fine'              => $fine,
            'paid_fine'         => $late_fee_payment_fine,
            'fine_check'        => $late_fee_payment_fine_check,
            'other_waive'       => $waive_voucher,
            'reprint_fee'       => $reprint_paid,
            'reprint_waive'       => $reprint_waive,
            'payment_date'      => date( 'Y-m-d H:i:s', strtotime( $date ) )
        ]);
        $insert_id = $this->db->insert_id();
        // adding other fee types in the database
        foreach ( $other_fee_types as $other_fee_type ) {
            $this->db->insert( 'student_fee_payments_others', [
                'student_fee_payment_id' => $insert_id,
                'fee_name' => $other_fee_type['name'],
                'amount' => $other_fee_type['amount']
            ] );
        }

         if(  $tuition_fee != 0){
                                              // if(T  == 0)                 else
             $tuition_fee = $tuition_fee + $fine;
             // T(400) = T(0) + f(400)     T(1400) = T(1000) + F(400)
             // subtracting tuition fee from fee arrears
            
             $fee_arrears = intval( $student_details['fee_arrears'] ) - intval( $tuition_fee );
             // A = sA(1400) - T(400)      A = sA(1000) -T(1400)
             $this->db->update( 'students', [                                 //   sA(1000)            sA(-400)
                 'fee_arrears' => $fee_arrears
             ], [
                 'id' => $student_details['id']
             ] );
         }
        $this->db->trans_complete();
        
        if ( $this->db->trans_status() ) {
            return $insert_id;
        } else {
            return false;
        }
    }

     public function get_total_receiveable_fee_per_month()
     {
        $q = $this->db->select( 'SUM(`classes`.`fee`) AS fee, SUM(`students`.`discount`) AS discount' )
            ->from( 'students' )
            ->join( 'student_session', 'student_session.student_id = students.id', 'inner' )
            ->join( 'sch_settings', 'sch_settings.session_id = student_session.session_id', 'inner' )
            ->join( 'classes', 'classes.id = student_session.class_id', 'inner' )
            ->get();

        $row = $q->row_array();

        $fee = intval( $row['fee'] );
        $discount = intval( $row['discount'] );

        return $fee - $discount;
    }

     public function get_total_received_fee_per_month( $date = null )
     {
        $this->db->select( 'SUM(tuition_fee) AS sm' )
            ->from( $this->table_name );

        if ( $date !== null ) {
            $this->db->like( 'payment_date', date( 'Y-m-', strtotime( $date ) ), 'after' );
        }

        $q = $this->db->get();

        $sm = $q->row_array();
        $sm = intval( $sm['sm'] );
   return $sm;
    }
     
	 public function get_total_received_fee_per_month2( $date = null, $student_id = null )
     {
        $this->db->select( 'SUM(tuition_fee) AS sm' )
            ->from( $this->table_name );
        if ( $date !== null ) {
            $this->db->like( 'payment_date', date( 'Y-m-', strtotime( $date ) ), 'after' );
        }
	  $this->db->where('voucher_id !=', 1 );
      $this->db->where('student_id', $student_id );
        $q = $this->db->get();
        $sm = $q->row_array();
        $sm = intval( $sm['sm'] );
   return $sm;
    }
     
     public function tuition_fee_sum( $session = null, $class = null, $section = null )
     {
        $this->db->select( 'student_fee_payments.id, student_fee_payments.student_id, student_fee_payments.tuition_fee, student_fee_payments.total_paid_fee' )
            ->from( 'student_fee_payments' )
            ->join( 'student_session', 'student_session.student_id = student_fee_payments.student_id', 'inner' );

        if ( $session !== null ) {
            $this->db->where( 'student_session.session_id', $session );
        }

        if ( $class !== null ) {
            $this->db->where( 'student_session.class_id', $class );
        }

        if ( $section !== null ) {
            $this->db->where( 'student_session.section_id', $section );
        }

        $q = $this->db->get();

        if ( $q->num_rows() > 0 ) {

            $sum = 0;
            $total_paid_fee = 0;
            $student_fee_payment_ids = [];
            $student_ids = [];

            $results = $q->result_array();

            foreach ( $results as $result ) {
                $sum += intval( $result['tuition_fee'] );
                $total_paid_fee += intval( $result['total_paid_fee'] );
                $student_fee_payment_ids[] = intval( $result['id'] );
                $student_ids[] = intval( $result['student_id'] );
            }

            return compact( 'sum', 'total_paid_fee', 'student_fee_payment_ids', 'student_ids' );

        } else {
            return false;
        }

    }

}