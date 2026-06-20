<?php

class Class_section_monthly_log_model extends CI_Model
{
    public $table_name = "class_section_monthly_logs";

    public function __construct()
    {
        parent::__construct();

        //$this->update_class_section_monthly_log();
    }

    /**
     * @param int $class_section_id
     * @param DateTime $log_date
     * @param int $total_students 0
     * @param int $total_tuition_fee 0
     * @param int $total_other_fee 0
     * @param int $receiveable_total_fee 0
     * @param int $receiveable_total_received 0
     * @return int Record ID
     */


    public function add( $class_section_id, $log_date, $total_students = false,  $total_other_fee = false, $receiveable_total_fee = false, $receiveable_total_received = false,
                         $overall_receivable = false, $struck_off = false, $discount = false,
                         $add_on_update = false, $class_section_fee_arrears = false, $class_section_advance_fee = false,
                         $advance_adjusted_fee,$total_waive_fee,$other_waive,$student_withdrawl,$waive_arrears,$withdrawl_arrears,
                         $total_fine1,$total_paid_arrears1,$total_paid_fee1,$total_advance1,$total_other1 ,$total_due_fee,$total_other_due_fee,$class_id = null , $section_id = null )
    {
        $log_date = date( 'Y-m-01', strtotime( $log_date ) );

        $log = $this->get( null, $class_section_id, $log_date );

        if ( $log === false ) {
            $students_advance = $this->student_model->add_advance_fee($class_id,$section_id);

            $this->db->insert( $this->table_name, [
                'class_section_id'              => $class_section_id,
                'total_students'                => $total_students,
           //     'total_tuition_fee'             => $total_tuition_fee,
                'total_other_fee'               => $total_other_fee,
                'total_other_due_fee'               => $total_other_due_fee,
                'advance_adjusted_fee'          => $advance_adjusted_fee,
                'receiveable_total_fee'         => $receiveable_total_fee,
                'receiveable_total_received'    => $receiveable_total_received,
                'overall_receivable'            => $overall_receivable,
                'struck_off'                    => $struck_off,
                'discount'                      => $discount,
                'class_section_fee_arrears'     => $class_section_fee_arrears,
                'total_waive_fee'               => $total_waive_fee,
                'other_waive'                   => $other_waive,
                'student_withdrawl'             => $student_withdrawl,
                'class_section_advance_fee'     => $class_section_advance_fee,
                'withdrawl_arrears'             => $withdrawl_arrears,
                'waive_arrears'                 => $waive_arrears,
                'total_fine1'                   => $total_fine1,
                'total_paid_arrears1'           => $total_paid_arrears1,
                'total_paid_fee1'               => $total_paid_fee1,
                'total_advance1'                => $total_advance1,
                'total_other1'                  => $total_other1,
                'total_due_fee'                 => $total_due_fee,
                'log_date'                      => $log_date
            ] );

            return $this->db->insert_id();

        } else {
            $log = $log[0];
            $data = [];

            if ( $add_on_update === true ) {
                $data['total_students'] = intval( $log['total_students'] ) + intval( $total_students );
              //  $data['total_tuition_fee'] = intval( $log['total_tuition_fee'] ) + intval( $total_tuition_fee );
                $data['total_other_fee'] = intval( $log['total_other_fee'] ) + intval( $total_other_fee );
                $data['receiveable_total_fee'] = intval( $log['receiveable_total_fee'] ) + intval( $receiveable_total_fee );
                $data['receiveable_total_received'] = intval( $log['receiveable_total_received'] ) + intval( $receiveable_total_received );
                $data['overall_receivable'] = intval( $log['overall_receivable'] ) + intval( $overall_receivable );
                $data['discount'] = intval( $log['discount'] ) + intval( $discount );
                $data['advance_adjusted_fee'] = intval( $log['advance_adjusted_fee'] ) + intval( $advance_adjusted_fee );
                $data['total_waive_fee'] = intval( $log['total_waive_fee'] ) + intval( $total_waive_fee );
                $data['other_waive'] = intval( $log['other_waive'] ) + intval( $other_waive );
                $data['total_other_due_fee'] = intval( $log['total_other_due_fee'] ) + intval( $total_other_due_fee );
               
                $data['student_withdrawl'] = intval( $log['student_withdrawl'] ) + intval( $student_withdrawl );
                $data['withdrawl_arrears'] = intval( $log['withdrawl_arrears'] ) + intval( $withdrawl_arrears );
                $data['waive_arrears'] = intval( $log['waive_arrears'] ) + intval( $waive_arrears );
                $data['class_section_fee_arrears'] = intval( $log['class_section_fee_arrears'] ) + intval( $class_section_fee_arrears );
                $data['class_section_advance_fee'] = intval( $log['class_section_advance_fee'] ) + intval( $class_section_advance_fee );
                $data['total_fine1'] = intval( $log['total_fine1'] ) + intval( $total_fine1 );
                $data['total_paid_arrears1'] = intval( $log['total_paid_arrears1'] ) + intval( $total_paid_arrears1 );
                $data['total_paid_fee1'] = intval( $log['total_paid_fee1'] ) + intval( $total_paid_fee1 );
                $data['total_advance1'] = intval( $log['total_advance1'] ) + intval( $total_advance1 );
                $data['total_other1'] = intval( $log['total_other1'] ) + intval( $total_other1 );
                $data['total_due_fee'] = intval( $log['total_due_fee'] ) + intval( $total_due_fee );
                $data['struck_off'] = intval( $log['struck_off'] ) + intval( $struck_off );

            } else {
                $data['total_students'] = ( $total_students !== false ? $total_students : $log['total_students'] );
              //  $data['total_tuition_fee'] = ( $total_tuition_fee !== false ? $total_tuition_fee : $log['total_tuition_fee'] );
                $data['total_other_fee'] = ( $total_other_fee !== false ? $total_other_fee : $log['total_other_fee'] );
                $data['receiveable_total_fee'] = ( $receiveable_total_fee !== false ? $receiveable_total_fee : $log['receiveable_total_fee'] );
                $data['receiveable_total_received'] = ( $receiveable_total_received !== false ? $receiveable_total_received : $log['receiveable_total_received'] );
                $data['advance_adjusted_fee'] = ( $advance_adjusted_fee !== false ? $advance_adjusted_fee : $log['advance_adjusted_fee'] );
                $data['total_waive_fee'] = ( $total_waive_fee !== false ? $total_waive_fee : $log['total_waive_fee'] );
                $data['other_waive'] = ( $other_waive !== false ? $other_waive : $log['other_waive'] );
                $data['waive_arrears'] = ( $waive_arrears !== false ? $waive_arrears : $log['waive_arrears'] );
                $data['student_withdrawl'] = ( $student_withdrawl !== false ? $student_withdrawl : $log['student_withdrawl'] );
                $data['withdrawl_arrears'] = ( $withdrawl_arrears !== false ? $withdrawl_arrears : $log['withdrawl_arrears'] );
                $data['overall_receivable'] = ( $overall_receivable !== false ? $overall_receivable : $log['overall_receivable'] );
                $data['discount'] = ( $discount !== false ? $discount : $log['discount'] );
                $data['class_section_fee_arrears'] = ( $class_section_fee_arrears !== false ? $class_section_fee_arrears : $log['class_section_fee_arrears'] );
                $data['class_section_advance_fee'] = ( $class_section_advance_fee !== false ? $class_section_advance_fee : $log['class_section_advance_fee'] );
                $data['total_fine1'] = ( $total_fine1 !== false ? $total_fine1 : $log['total_fine1'] );
                $data['total_paid_arrears1'] = ( $total_paid_arrears1 !== false ? $total_paid_arrears1 : $log['total_paid_arrears1'] );
                $data['total_paid_fee1'] = ( $total_paid_fee1 !== false ? $total_paid_fee1 : $log['total_paid_fee1'] );
                $data['total_advance1'] = ( $total_advance1 !== false ? $total_advance1 : $log['total_advance1'] );
                $data['total_other1'] = ( $total_other1 !== false ? $total_other1 : $log['total_other1'] );
                $data['total_due_fee'] = ( $total_due_fee !== false ? $total_due_fee : $log['total_due_fee'] );
                $data['total_other_due_fee'] = ( $total_other_due_fee !== false ? $total_other_due_fee : $log['total_other_due_fee'] );
               
                $data['struck_off'] = ( $struck_off !== false ? $struck_off : $log['struck_off'] );

            }

            $this->db->update( $this->table_name, $data, [
                'id' => $log['id']
            ] );

            return $log['id'];
        }
        
    }

    public function get( $id = null, $class_section_id = null, $log_date = null )
    {
        $this->db->select( "*" )
            ->from( $this->table_name );

        if ( $id !== null ) {
            $this->db->where( 'id', $id );
        }

        if ( $class_section_id !== null ) {
            $this->db->where( 'class_section_id', $class_section_id );
        }

        if ( $log_date !== null ) {
            $log_date = date( 'Y-m-', strtotime( $log_date ) );
            $this->db->like( 'log_date', $log_date, 'after' );
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
    /**
     * Will update monthly class section logs.
     * Run this once every month on 1 date through cron job.
     */
    public function get_log_sum()
    {
        $this->db->select( 'SUM(receiveable_total_fee) as total_fee,SUM(discount) as discount , SUM(total_due_fee) as due_fee,SUM(class_section_fee_arrears) as due_arrears, 
        SUM(total_paid_fee1) as paid_fee, SUM(total_paid_arrears1) as paid_arrears, SUM(total_advance1) as advance,
        SUM(total_waive_fee) as waive_fee, SUM(waive_arrears) as waive_arrears,SUM(student_withdrawl) as withdraw_fee,
        SUM(withdrawl_arrears) as withdraw_arrears, SUM(total_other_fee) as total_other_fee , SUM(total_fine1) as paid_fine ,SUM(advance_adjusted_fee) as adjusted_fee ,SUM(other_waive) as other_waive' )
        ->from( 'class_section_monthly_logs' );
        $log_date = date( 'Y-m-');
        $this->db->like( 'log_date', $log_date, 'after' );
        $query = $this->db->get();
        return  $query->row_array();
    }
    public function update_class_section_monthly_log()
    {
        $date = new DateTime( date( "Y-m-01 00:00:00", now() ) );

        $class_sections = $this->classsection_model->class_sections();
        
        if ( $class_sections !== false ) {
            foreach ( $class_sections as $class_section ) {
                // setting default values for the log data
                $log_data = [
                    'class_section_id' => $class_section['id'],
                    'total_students' => 0,
                //    'total_tuition_fee' => 0, // payment
                    'total_other_fee' => 0, // payment
                    'total_due_fee' => 0, // payment
                    'receiveable_total_fee' => 0,
                    'total_waive_fee' => 0,
                    'other_waive' => 0,
                    'waive_arrears' => 0,
                    'total_fine1' =>0,
                    'total_paid_arrears1' =>0,
                    'total_paid_fee1' =>0,
                    'total_advance1' =>0,
                    'total_other1' =>0,
                    'receiveable_total_received' => 0,
                    'advance_adjusted_fee' => 0,
                    'overall_receivable' => 0,
                    'class_section_fee_arrears' => 0,
                    'class_section_advance_fee' => 0,
                    'student_withdrawl' => 0,
                    'withdrawl_arrears' => 0,
                    'total_other_due_fee' => 0,

                    'log_date' => $date->format( "Y-m-d" )
                ];
                // total students in the class and section

                $setting_result = $this->setting_model->get();
                $class_section_students = $this->studentsession_model->searchStudents( $class_section['class_id'], $class_section['section_id'],null ,null,null,$setting_result[0]['session_id']);
                //$class_section_students = $this->studentsession_model->searchStudents( $class_section['class_id'], $class_section['section_id'], null, null, null, true );
                $class_section_students_count = count( $class_section_students );
                $log_data['total_students'] = $class_section_students_count;
                /// add advance fee adjusted
                // $data_advance_adjusted = [
                //     'title'     => 'Daily Transactions',
                //     'date'      => date( 'Y-m-d', now() ), ];
                $log_data['total_due_fee'] = $this->student_model->students_due_fee( $class_section['class_id'],$class_section['section_id']);
                $log_data['total_other_due_fee'] = $this->student_fee_voucher_model->get_unpaid_other_monthly(null,null, $class_section['class_id'],$class_section['section_id']);
                 $log_data['advance_adjusted_fee'] = $this->student_model->adv_adj_balance_sheet( $class_section['class_id'],$class_section['section_id']);
                // add fee waive
                $fee_waive_data     = $this->student_fee_payments->search_fee_waive( $class_section['class_id'], $class_section['section_id'] );
                $log_data['total_waive_fee'] = $fee_waive_data['total_fee_waive'];
                $log_data['waive_arrears']  = $fee_waive_data['total_arrears_waive'];
                $log_data['other_waive']  = $fee_waive_data['other_waive'];
                // add class section fee arrears
                $log_data['class_section_fee_arrears'] = $this->student_model->fee_arears( $class_section['class_id'], $class_section['section_id'] );
                // advance fee for class and section
                $log_data['class_section_advance_fee'] = $this->student_model->sum_advance_fee( $class_section['class_id'], $class_section['section_id'] );
                // withdrawl fee for class and section
                $student_withdrawl =   $this->student_model->withdrawl_students($class_section['class_id'], $class_section['section_id'] );
                $log_data['student_withdrawl']  = $student_withdrawl['total_due_fee'];
                $log_data['withdrawl_arrears']  = $student_withdrawl['total_arrears'];
                $total_paid = $this->student_fee_payments->monthly_fee_data2($class_section['class_id'],$class_section['section_id']);
                $log_data['total_fine1']         = ($total_paid->fine != null ? $total_paid->fine : 0);
                $log_data['total_paid_arrears1'] = ($total_paid->arrears != null ? $total_paid->arrears : 0);
                $log_data['total_paid_fee1']     = ($total_paid->tuition_fee_paid != null ? $total_paid->tuition_fee_paid : 0 );
                $log_data['total_advance1']      = ($total_paid->advance!= null ? $total_paid->advance : 0);
                $log_data['total_other1']        = ($total_paid->other_fee != null ? $total_paid->other_fee : 0);
                $total_tuition_fee      = 0;
                $total_other_fee        = 0;
                $receiveable_total_fee  = 0;
                $overall_receivable     = 0;
                $student_discount       = 0;
                $total_fee_paid         = 0;
                $total_arrears          = 0;
                $total_advance          = 0;
                foreach ( $class_section_students as $class_section_student ) {
                    if ( floatval( $class_section_student['fee_after_discount'] ) > 0 ) {
                        // if current date time is greater than or equal to the fee starting time
                        if ( now() > strtotime( $class_section_student['fee_starting_date'] ) ) {
                            // adding receiveable fee to the total receiveable
                            $receiveable_total_fee += ( intval( $class_section['class']['fee'] ) - intval( $class_section_student['discount'] ) );

                            // overall receivable
                            $overall_receivable += intval( $class_section_student['fee_arrears'] );

                            // adding student discount
                            $student_discount += intval( $class_section_student['discount'] );
                            
                        }

                    }


                    // fee payment calculations
                    $fee_payments = $this->student_fee_payments->get( null, $class_section_student['student_id'], null, null, $date->format( 'Y-m-' ) );
                    if ( $fee_payments !== false ) {
                        for ( $i = 0; $i < count( $fee_payments ); $i++ ) {
                            if($fee_payments[$i]['voucher_id'] != 1){
                                $fee_payment = $fee_payments[$i];
                                $total_tuition_fee += intval( $fee_payment['tuition_fee'] );
                                $student_fee_payment_others = $this->student_fee_payments_other->get( null, $fee_payment['id'] );
                                if ( $student_fee_payment_others !== false ) {
                                    foreach ( $student_fee_payment_others as $student_fee_payment_other ) {
                                        $total_other_fee += intval( $student_fee_payment_other['amount'] );
                                    }
                                }
                            }
                        }
                    }
                }

                // $struck_off_students = $this->student_model->get( null, [
                //     'students.struck_off' => 1,
                //     'student_session.class_id' => $class_section['class_id'],
                //     'student_session.section_id' => $class_section['section_id']
                // ]);
                $struck_off_students = $this->student_model->struckoff_students($class_section['class_id'] , $class_section['section_id']);
                $log_data['struck_off'] = count( $struck_off_students );
                //$log_data['total_tuition_fee'] = $total_tuition_fee;
                $log_data['total_other_fee'] = $total_other_fee;
                $log_data['receiveable_total_fee'] = $receiveable_total_fee;
                $log_data['receiveable_total_received'] = $total_tuition_fee;
                $log_data['overall_receivable'] = $overall_receivable;
                $log_data['discount'] = $student_discount;
                $this->add( $class_section['id'], $log_data['log_date'], $log_data['total_students'],
                    $log_data['total_other_fee'], $log_data['receiveable_total_fee'], $log_data['receiveable_total_received'],
                    $log_data['overall_receivable'], $log_data['struck_off'], $log_data['discount'], false,
                    $log_data['class_section_fee_arrears'], $log_data['class_section_advance_fee'],$log_data['advance_adjusted_fee'],
                    $log_data['total_waive_fee'] ,$log_data['other_waive'], $log_data['student_withdrawl'],$log_data['waive_arrears'],
                    $log_data['withdrawl_arrears'],$log_data['total_fine1'],$log_data['total_paid_arrears1'] ,
                    $log_data['total_paid_fee1'] , $log_data['total_advance1'],$log_data['total_other1'] ,$log_data['total_due_fee'],$log_data['total_other_due_fee'],$class_section['class_id'],$class_section['section_id'] );
            }
         }
    }
}
