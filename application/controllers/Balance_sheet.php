<?php
class Balance_sheet extends Admin_Controller
{
    public function __construct()
    {
         parent::__construct();
         $this->load->helper( 'file' );
         $this->lang->load( 'message', 'english' );
    //     $this->class_section_monthly_log_model->update_class_section_monthly_log();
    // //      $this->staff_attendance_model->mark_all_absent();
    // //      //$this->staff_model->keepUpdatingStaffSalary();
    //      $this->student_model->keepUpdatingStudentFee();
    //       $this->student_model->keepUpdatingLatePaymentFee();
    // //  $this->teacher_attendance_model->mark_all_absent();
    // //      $this->teacher_model->keepUpdatingDueSalaries();
    // //      $this->stuattendence_model->mark_all_absent();

    }
    public function index()
    {

       
        $this->session->set_userdata( 'top_menu', 'Reports' );
        $this->session->set_userdata( 'sub_menu', 'balance_sheet/index' );

        $month      = $this->input->get( 'month' );
        $year       = $this->input->get( 'year' );
        $day        = date("d");
        $month      = ( !empty( $month ) ? $month : date( 'm' ) );
        $year       = ( !empty( $year ) ? $year : date( 'Y') );
        $date_from  = date( 'Y-m-01', strtotime( "{$year}-{$month}-01" ) );
        $date_to    = date( 'Y-m-d', strtotime( "{$year}-{$month}-{$day}" ));
        $date       = date( 'Y-m-d');
        //////////////////////month wise/////////////////
        $revenue    = $this->transactions_model->get( $date, $date_from, $date_to );
        $revenue    = ( $revenue !== false ? $revenue : [] );
        ///////////////////////////daily////////////////////////////
        $revenue3   = $this->transactions_model->get( $date,$date,$date );
        $revenue3   = ( $revenue3 !== false ? $revenue3 : [] );
        //////////////////////////yearly/////////////////////////////
        $date_previous  = date("m") <= 2 ? date("Y-03-01",strtotime("-1 year")) : date("Y-03-01");
        $revenue_year   = $this->transactions_model->get( $date, $date_previous, $date_to );
        $revenue_year   = ( $revenue_year !== false ? $revenue_year : [] );
        $date           = date( 'm/d/Y', strtotime( "{$year}-{$month}-01" ) );
        $data = [
            'month' => $month,
            'year'  => $year,
            'date'  => $date,
            'total' => null
        ];
        $data['current_session'] = $this->setting_model->getCurrentSession();
        $class_sections = $this->classsection_model->class_sections();

        if ( $class_sections !== false ) {
            for ( $i = 0; $i < count( $class_sections ); $i++ ) {
            $attendance_day = min( intval( $day ), cal_days_in_month( CAL_GREGORIAN, intval( $month ), intval( $year ) ) );
            $class_sections[$i]['attendance']       = $this->student_model->calculate_attendance( $class_sections[$i]['class_id'], $class_sections[$i]['section_id'], sprintf( '%04d-%02d-%02d', $year, $month, $attendance_day ) );
            $class_sections[$i]['attendance_cus']   = [
                'p' => 0,
                'l' => 0,
                'a' => 0
            ];

            foreach ( $class_sections[$i]['attendance']['attendance_types'] as $itm ) {
                if ( strtolower( $itm['type'] ) == 'absent' ) {
                    $class_sections[$i]['attendance_cus']['a'] += intval( $itm['attendance_count'] );
                } elseif (strtolower( $itm['type'] ) == 'leave') {
                    $class_sections[$i]['attendance_cus']['l'] += intval( $itm['attendance_count'] );
                } else {
                    $class_sections[$i]['attendance_cus']['p'] += intval( $itm['attendance_count'] );
                }
            }

                $date_from_log  = ( $date_from !== null ? date( "Y-m-d", strtotime( $date_from ) ) : date( 'Y-m-01', now() ) );
                $days_in_month  = cal_days_in_month( CAL_GREGORIAN, date( 'm', now() ), date( 'Y', now() ) );
                $date_to_log    = ( $date_to !== null ? date( 'Y-m-d', strtotime( $date_to ) ) : date( "Y-m-{$days_in_month}", now() ) );
                $student_logs   = $this->student_log_model->calculate( $class_sections[$i]['class_id'], $class_sections[$i]['section_id'], "2025-01-01",$date_from_log,$date_to_log );
                $class_sections[$i]['student_logs'] = $student_logs;
                $class_section_monthly_log = $this->class_section_monthly_log_model->get( null, $class_sections[$i]['id'], "{$year}-{$month}-01" );
                $class_sections[$i]['class_section_monthly_log'] = $class_section_monthly_log;
              
            }
           
            $student_logs_total = $this->student_log_model->total_calculate();
            $data['student_logs_total'] = $student_logs_total;
           
            $total = [
                'promote'                       => 0,
                'demote'                        => 0,
                'new_admission'                 => 0,
                'free'                          => 0,
                'without_fee'                   => 0,
                'struck_off'                    => 0,
                'total_students'                => 0,
                'total_other_fee'               => 0,
                'advance_adjusted_fee'          => 0,
           //   'total_tuition_fee_other_fee'   => 0,
                'discount'                      => 0,
                'student_withdrawl'             => 0,
                'withdrawl_arrears'             => 0,
                'total_waive_fee'               => 0,
                'other_waive'                   => 0,
                'total_fine1'                   => 0,
                'total_paid_arrears11'          => 0,
                'total_paid_fee1'               => 0,
                'total_advance11'               => 0,
                'total_due_fee'                 => 0,
                'total_other1'                  => 0,
                'waive_arrears'                 => 0,
                'receiveable_total_fee'         => 0,
         //     'receiveable_total_received'    => 0,
                'class_section_fee_arrears'     => 0,
                'class_section_advance_fee'     => 0
            ];
            foreach ( $class_sections as $class_section ) {
                $total['promote']                    += intval( $class_section['student_logs']['promote'] );
                $total['demote']                     += intval( $class_section['student_logs']['demote'] );
                $total['new_admission']              += intval( $class_section['student_logs']['new_admission'] );
                $total['free']                       += intval( $class_section['student_logs']['free'] );
                $total['without_fee']                += intval( $class_section['student_logs']['without_fee'] );
                $total['total_students']             += ( $class_section['class_section_monthly_log'] !== false ? intval( $class_section['class_section_monthly_log'][0]['total_students'] ) : 0 );
                $total['struck_off']                 += intval( $class_section['student_logs']['struck_off'] );
                $total['struck_off']                 += ( $class_section['class_section_monthly_log'] !== false ? intval( $class_section['class_section_monthly_log'][0]['struck_off'] ) : 0 );
            // $total['total_tuition_fee']           += ( $class_section['class_section_monthly_log'] !== false ? intval( $class_section['class_section_monthly_log'][0]['total_tuition_fee'] ) : 0 );
                $total['total_other_fee']            += ( $class_section['class_section_monthly_log'] !== false ? intval( $class_section['class_section_monthly_log'][0]['total_other_fee'] ) : 0 );
            //  $total['total_tuition_fee_other_fee'] += ( $class_section['class_section_monthly_log'] !== false ? intval( $class_section['class_section_monthly_log'][0]['total_tuition_fee'] ) + intval( $class_section['class_section_monthly_log'][0]['total_other_fee'] ) : 0 );
                $total['discount']                   += ( $class_section['class_section_monthly_log'] !== false ? intval( $class_section['class_section_monthly_log'][0]['discount'] ) : 0 );
                $total['receiveable_total_fee']      += ( $class_section['class_section_monthly_log'] !== false ? intval( $class_section['class_section_monthly_log'][0]['receiveable_total_fee'] ) : 0 );
                $total['advance_adjusted_fee']       += ( $class_section['class_section_monthly_log'] !== false ? intval( $class_section['class_section_monthly_log'][0]['advance_adjusted_fee'] ) : 0 );
                $total['total_waive_fee']            += ( $class_section['class_section_monthly_log'] !== false ? intval( $class_section['class_section_monthly_log'][0]['total_waive_fee'] ) : 0 );
                $total['other_waive']                += ( $class_section['class_section_monthly_log'] !== false ? intval( $class_section['class_section_monthly_log'][0]['other_waive'] ) : 0 );
                $total['waive_arrears']              += ( $class_section['class_section_monthly_log'] !== false ? intval( $class_section['class_section_monthly_log'][0]['waive_arrears'] ) : 0 );
                $total['total_fine1']                += ( $class_section['class_section_monthly_log'] !== false ? intval( $class_section['class_section_monthly_log'][0]['total_fine1'] ) : 0 );
                $total['total_paid_arrears11']       += ( $class_section['class_section_monthly_log'] !== false ? intval( $class_section['class_section_monthly_log'][0]['total_paid_arrears1'] ) : 0 );
                $total['total_paid_fee1']            += ( $class_section['class_section_monthly_log'] !== false ? intval( $class_section['class_section_monthly_log'][0]['total_paid_fee1'] ) : 0 );
                $total['total_advance11']            += ( $class_section['class_section_monthly_log'] !== false ? intval( $class_section['class_section_monthly_log'][0]['total_advance1'] ) : 0 );
                $total['total_other1']               += ( $class_section['class_section_monthly_log'] !== false ? intval( $class_section['class_section_monthly_log'][0]['total_other1'] ) : 0 );
                $total['student_withdrawl']          += ( $class_section['class_section_monthly_log'] !== false ? intval( $class_section['class_section_monthly_log'][0]['student_withdrawl'] ) : 0 );
                $total['withdrawl_arrears']          += ( $class_section['class_section_monthly_log'] !== false ? intval( $class_section['class_section_monthly_log'][0]['withdrawl_arrears'] ) : 0 );
                $total['total_due_fee']              += ( $class_section['class_section_monthly_log'] !== false ? intval( $class_section['class_section_monthly_log'][0]['total_due_fee'] ) : 0 );
            //  $total['receiveable_total_received'] += ( $class_section['class_section_monthly_log'] !== false ? intval( $class_section['class_section_monthly_log'][0]['receiveable_total_received'] ) : 0 );
                $total['class_section_fee_arrears']  += ( $class_section['class_section_monthly_log'] !== false ? intval( $class_section['class_section_monthly_log'][0]['class_section_fee_arrears'] ) : 0 );
                $total['class_section_advance_fee']  += ( $class_section['class_section_monthly_log'] !== false ? intval( $class_section['class_section_monthly_log'][0]['class_section_advance_fee'] ) : 0 );
            
            }
            $data['total'] = $total;
        }

        $total_students_list    = $this->student_model->searchByClassSection( null, null, null, null );   
        $total_late_fine        = 0;
        $student_class_id       = 0;
        $student_section_id     = 0;
        $total_class_students   = [];
        $class_num              =  0;
        foreach ( $total_students_list  as $tskey => $item ) {

            $find_class = 0;
            $total_late_fine     += $item['late_payment_fee'];
            if($item['class_id'] == $student_class_id && $item['section_id'] == $student_section_id)
            {
                $total_class_students[$class_num]['class_fee']      += $item['class_fee'] - $item['discount'];
                $total_class_students[$class_num]['class_fine']     += $item['late_payment_fee'];
                $total_class_students[$class_num]['class_discount'] += $item['discount'];
                $find_class = 1;
            }
            if($find_class == 0){
                $total_class_students[$tskey]['section_id']     = $item['section_id'];
                $total_class_students[$tskey]['class_id']       = $item['class_id'];
                $total_class_students[$tskey]['class_fee']      = $item['class_fee'] - $item['discount'];
                $total_class_students[$tskey]['class_fine']     = $item['late_payment_fee'];
                $total_class_students[$tskey]['class_discount'] = $item['discount'];
                $student_class_id                               = $item['class_id'];
                $student_section_id                             = $item['section_id'];
                $class_num                                      = $tskey;
            }
        }
      
        $struckoff_s        = $this->student_model->struckoff_students( null, null, null, null, null );
        $total_struckoff    = 0;
        $total_struckoff_s  = [];
        $struck_off_num     = 0;
        $s_class_id         = 0;
        $s_section_id       = 0;
        $class_num          = 0;
        foreach ( $struckoff_s  as $soskey => $sos ) {
            $find_class = 0;
            $total_struckoff     += 1;
            if($sos['class_id'] == $s_class_id && $sos['section_id'] == $s_section_id)
            {
                $total_struckoff_s[$class_num]['class_stds']++;
                $find_class = 1;
            }
            if($find_class == 0){
                $total_struckoff_s[$soskey]['section_id']     = $sos['section_id'];
                $total_struckoff_s[$soskey]['class_id']       = $sos['class_id'];
                $total_struckoff_s[$soskey]['class_stds']     = 1;
                $s_class_id   = $sos['class_id'];
                $s_section_id = $sos['section_id'];
                $class_num    = $soskey;
            }
        }
        $sum_teacher_attendance = $this->teacher_attendance_model->sum_teacher_attendance_by_date( date( 'Y-m-d', now() ) );
        $tot_teacher            = $this->teacher_model->getTotalteacher();
        $total_teachers         = 0;
        if ( !empty( $tot_teacher ) )
        {
            $total_teachers = $tot_teacher->total_teacher;
        }
        $data['total_teachers']         = $total_teachers;
        $data['sum_teacher_attendance'] = $sum_teacher_attendance;
        $data['total_struckoff']        = $total_struckoff;
        $data['total_struckoff_s']      = $total_struckoff_s;
        $data['total_class_students']   = $total_class_students;
        $data['total_late_fine']        = $total_late_fine;
        $data['class_sections']         = $class_sections;
        // getting expense head
        $expense_head                   = $this->expensehead_model->get();
        $data['expense_head']           = $expense_head;
        // getting inventory head
        $inventory_heads                = $this->inventoryhead_model->get();
        $data['inventory_heads']        = $inventory_heads;
        $data['print_title']            = "Balance Sheet (".$month."/".$year.")";
        $data['transactions2']          =  $revenue;
        $data['transactions3']          =  $revenue3;
        $data['transactions_year']      =  $revenue_year;
        $class_id   = $this->input->get( 'class_id' );
        $section_id = $this->input->get( 'section_id' );
        $students_pending_fee = $this->student_model->students_pending_fee( $class_id, $section_id );
        $students_pending_fee = ( $students_pending_fee !== false ? $students_pending_fee : [] );

        for ( $i = 0; $i < count( $students_pending_fee ); $i++ ) {
            $students_pending_fee[$i]['student_class_fee_after_discount'] = floatval( $students_pending_fee[$i]['class_fee'] ) - floatval( $students_pending_fee[$i]['discount'] );
            $students_pending_fee[$i]['student_class_fee_after_discount'] = ( $students_pending_fee[$i]['student_class_fee_after_discount'] >= 0 ? $students_pending_fee[$i]['student_class_fee_after_discount'] : 0 );
        }

    
        $data['students_pending_fee'] = $students_pending_fee;
        $unpaid_students_other = $this->student_fee_voucher_model->get_unpaid_other45( );
        $data['unpaid_students_other']  = $unpaid_students_other;
        $date2 = date( 'Y-m-d', now() );

            ////////////////////////////teacher//////////////////////////////

        $teacher_result = $this->teacher_model->get(  );
        for ( $i = 0; $i < count( $teacher_result ); $i++ ) {
            $month_start_date = date( 'Y-m-01', now() );
            $_days_in_month = cal_days_in_month( CAL_GREGORIAN, date( 'm', strtotime( $month_start_date ) ), date( 'Y', strtotime( $month_start_date ) ) );
            $teacher_result[$i]['current_month_last_payment'] = $this->teacher_salary_payment->get( null, $teacher_result[$i]['id'], 'desc', null, $month_start_date, date( "Y-m-{$_days_in_month}", strtotime( $month_start_date ) ) );

        }
        $total_salary_teacher_paid    = 0;
        $total_salary_teacher         = 0;
        $total_salary_teacher_balance = 0;
        $total_salary_teacher_advance = 0;
        $total_arrears_teacher        = 0;
        $total_fee_paid1              = 0;
        foreach($teacher_result as $teacher){
            $total_salary = 0;
		
			if($teacher['current_month_last_payment'] !=null){
                foreach($teacher['current_month_last_payment'] as $teacher_payments){
                    $total_salary += $teacher_payments['paid_salary'];
                }
            }
            $total_salary_teacher_paid      +=  $total_salary;
            $total_salary_teacher           += $teacher['teacher_salary'];
            $total_salary_teacher_balance   += $teacher['due_salary'];
            $paid_salary                     =  number_format($teacher['teacher_salary']-$teacher['due_salary']);
            if ($teacher['due_salary'] > 0 )
            {
                $current_month_arrears1 = intval($teacher['due_salary'])  ;
                if ($teacher['teacher_salary'] <= $current_month_arrears1) {
                    $arrears1       = intval($teacher['due_salary']+ $total_salary );
                    $tuition_fee1   = 0;
                    $advance1       = 0;
                }elseif ($teacher['teacher_salary'] > $current_month_arrears1){
                    $arrears1            =  $current_month_arrears1 + $total_salary ;
                    $tuition_fee_left1   = $teacher['teacher_salary'] - $arrears1;

                    if ($tuition_fee_left1 <= $teacher['teacher_salary']) {
                        $tuition_fee1        = $tuition_fee_left1;
                        $advance1            = 0;
                    }else{
                        $tuition_fee1        = $teacher['teacher_salary'];
                        $tuition_fee_left1   = $tuition_fee_left1 - $teacher['teacher_salary'];
                        $advance1            = $tuition_fee_left1;
                    }

                }

            }
            elseif($teacher['due_salary'] <= 0){
                $tuition_fee1 = 0;
                $arrears1     = $teacher['teacher_salary'];
                $advance1     = $teacher['due_salary'];
            }
            if ($arrears1 < 0) {
                $arrears1 = 0;
            }
            $total_fee_paid1                += $tuition_fee1;
            $total_arrears_teacher          += $arrears1;
            $total_salary_teacher_advance   += abs($advance1);
        }
        $data['teacher_salary']                 = $total_salary_teacher;
        $data['total_salary_teacher_paid']      = $total_salary_teacher_paid;
        $data['total_salary_due_teacher']       = $total_salary_teacher_balance;
        $data['total_salary_teacher_balance']   = $total_salary_teacher_balance;
        $data['total_salary_teacher_advance']   = $total_salary_teacher_advance;
        $data['teacher_salary']                 = $total_salary_teacher;
        $data['teacher_salary_arrears']         =  $total_arrears_teacher;

            ////////////////////////////staff//////////////////////////////

        $staff_result = $this->staff_model->get();
        $staff_result = ( $staff_result !== false ? $staff_result : [] );
        for ( $i = 0; $i < count( $staff_result ); $i++ ) {
            $month_start_date = date( 'Y-m-01', now() );
            $_days_in_month = cal_days_in_month( CAL_GREGORIAN, date( 'm', strtotime( $month_start_date ) ), date( 'Y', strtotime( $month_start_date ) ) );
            $staff_result[$i]['current_month_last_payment'] = $this->staff_salary_payments_model->get( null, $staff_result[$i]['id'], $month_start_date, date( "Y-m-{$_days_in_month}", strtotime( $month_start_date ) ) );
        }
        $total_salary_staff_paid     = 0;
        $total_salary_staff          = 0;
        $total_salary_staff_balance  = 0;
        $total_arrears_staff         = 0;
        $total_salary_staff_advance  = 0;
        foreach($staff_result as $staff){
            $total_salary = 0;
            if($staff['current_month_last_payment'] != null){
                foreach($staff['current_month_last_payment'] as $staff_payments){
                    $total_salary += $staff_payments['paid_salary'];
                }
            }
            $total_salary_staff_paid      +=  $total_salary;
            $total_salary_staff           += intval( $staff['basic_salary'] );
            $total_salary_staff_balance   += intval( $staff['due_salary'] );
            if ( intval( $staff['due_salary'] ) > 0 )
            {
                $current_month_arrears2 = intval( $staff['due_salary'] );
                if ( intval( $staff['basic_salary'] ) <= $current_month_arrears2 ) {
                    $arrears2       = intval( $staff['due_salary'] + $total_salary );
                    $advance2       = 0;
                }else{
                    $arrears2            = $current_month_arrears2 + $total_salary;
                    $salary_left2        = intval( $staff['basic_salary'] ) - $arrears2;

                    if ($salary_left2 <= intval( $staff['basic_salary'] )) {
                        $advance2            = 0;
                    }else{
                        $advance2            = $salary_left2 - intval( $staff['basic_salary'] );
                    }
                }
            }
            elseif( intval( $staff['due_salary'] ) <= 0){
                $arrears2     = intval( $staff['basic_salary'] );
                $advance2     = intval( $staff['due_salary'] );
            }
            if ($arrears2 < 0) {
                $arrears2 = 0;
            }
            $total_arrears_staff         += $arrears2;
            $total_salary_staff_advance  += abs($advance2);
        }
        $data['staff_salary_month']             = $total_salary_staff;
        $data['staff_salary_arrears']            = $total_arrears_staff;
        $data['total_salary_staff_paid']         = $total_salary_staff_paid;
        $data['total_salary_staff_balance']      = $total_salary_staff_balance;
        $data['total_salary_staff_advance']      = $total_salary_staff_advance;

            /////////////////////////////////////////////////////////
       
            $students_struck    = $this->student_model->struckoff_students();
            $students_str       = 0;
            $fine               = 0;
            for ( $i = 0; $i < count( $students_struck ); $i++ ) {
                $students_str += $this->student_fee_voucher_model->get_unpaid_other_struck($students_struck[$i]['id'] ,null,null, null,null );
                $fine +=  $students_struck[$i]['late_payment_fee'];
            }
        //    $fine  = $this->student_fee_payments->payment_fine_sum();

        //    pp($fine);
        $waive_fine             = $this->student_fee_payments->payment_fine_sum();
     //   $waive_fine                     = $this->student_fee_payments->search_free_month_balance(  $date_from, $date_to );

        $data['waive_fine']             = $waive_fine;
        $data['struck_other']           = $students_str;
        $data['struck_fine']            = $fine;

   
        $this->load->view( 'layout/header', $data );
        $this->load->view( 'balance_sheet/index', $data );
        $this->load->view( 'layout/footer', $data );
    }

   

    public function do_extra_tasks(){
        $this->class_section_monthly_log_model->update_class_section_monthly_log();
        $this->staff_attendance_model->mark_all_absent();
        //$this->staff_model->keepUpdatingStaffSalary();
        $this->student_model->keepUpdatingStudentFee();
        $this->student_model->keepUpdatingLatePaymentFee();
        $this->teacher_attendance_model->mark_all_absent();
        $this->teacher_model->keepUpdatingDueSalaries();
        $this->stuattendence_model->mark_all_absent();
   
        echo "success";   
    }

}