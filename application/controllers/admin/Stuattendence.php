<?php

if ( !defined( 'BASEPATH' ) )
    exit( 'No direct script access allowed' );

class Stuattendence extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper( 'file' );
        $this->lang->load( 'message', 'english' );
    }

    function index()
    {
        $this->session->set_userdata( 'top_menu', 'Attendance' );
        $this->session->set_userdata( 'sub_menu', 'stuattendence/index' );
        $data['title']      = 'Student Attendance';
        $data['title_list'] = 'Fees Type List';
        $class              = $this->class_model->get();
        $data['classlist']  = $class;
        $data['class_id']   = "";
        $data['section_id'] = "";
        $data['date']       = date( 'm/d/Y', now() );


        $class_sections = $this->classsection_model->class_sections();
     
        for ( $i = 0; $i < count( $class_sections ); $i++ ) {
            $class_sections[$i]['attendance'] = $this->student_model->calculate_attendance( $class_sections[$i]['class_id'], $class_sections[$i]['section_id'], date( 'Y-m-d', strtotime( $data['date'] ) ) );
            $class_sections[$i]['attendance_cus'] = [
                'p' => 0,
                'l' => 0,
                'a' => 0
            ];

            foreach ( $class_sections[$i]['attendance']['attendance_types'] as $itm ) {
                if ( strtolower( $itm['type'] ) == 'absent' ) {
                    $class_sections[$i]['attendance_cus']['a'] += intval( $itm['attendance_count'] );
                }   elseif (strtolower( $itm['type'] ) == 'leave') {
                    $class_sections[$i]['attendance_cus']['l'] += intval( $itm['attendance_count'] );
                } else {
                    $class_sections[$i]['attendance_cus']['p'] += intval( $itm['attendance_count'] );
                }
            }
        }
       


        $data['class_sections'] = $class_sections;

        if ( $this->input->server( 'REQUEST_METHOD' ) == "GET" ) {
            $this->form_validation->set_data( $_GET );
        }

        $this->form_validation->set_rules( 'class_id', 'Class', 'trim|required|xss_clean' );
        $this->form_validation->set_rules( 'section_id', 'Section', 'trim|required|xss_clean' );
        if ( $this->form_validation->run() == FALSE ) {

            $this->load->view( 'layout/header', $data );
            $this->load->view( 'admin/stuattendence/attendenceList', $data );
            $this->load->view( 'layout/footer', $data );
        } else {
            $class                  = $this->input->post_get( 'class_id' );
            $section                = $this->input->post_get( 'section_id' );
            $date                   = $this->input->post_get( 'date' );
            $student_list           = $this->stuattendence_model->get();
            $data['studentlist']    = $student_list;
            $data['class_id']       = $class;
            $data['section_id']     = $section;
            $data['date']           = $date;
            
          
            $class1                       = $this->class_model->get($class);
            $section1                     = $this->section_model->get($section);
            $data['class_name']          = $class1['class'];
            $data['section_name']        = $section1['section'];

            $search     = $this->input->post_get( 'search' );
            $holiday    = $this->input->post_get( 'holiday' );
            if ( $search == "saveattendence" ) {
    
                $session_ary = $this->input->post_get( 'student_session' );
              
                
                foreach ( $session_ary as $key => $value ) {
                    $att_date =  date( 'Y-m-d', $this->customlib->datetostrtotime( $date ) );
                    $check_student_leave = $this->stuattendence_model->search_attendance($value,  $att_date );
                    $checkForUpdate = $this->input->post_get( 'attendendence_id' . $value );
                    if ( $checkForUpdate != 0 ) {
                        if ( isset( $holiday ) ) {
                            $arr = array(
                                'id'                    => $checkForUpdate,
                                'student_session_id'    => $value,
                                'attendence_type_id'    => 5,
                                'date'                  => date( 'Y-m-d', $this->customlib->datetostrtotime( $date ) )
                            );
                        } else {
                            $arr = array(
                                'id'                 => $checkForUpdate,
                                'student_session_id' => $value,
                                'attendence_type_id' => $this->input->post( 'attendencetype' . $value ),
                                'date'               => date( 'Y-m-d', $this->customlib->datetostrtotime( $date ) )
                            );
                        }
                        $insert_id = $this->stuattendence_model->add( $arr );
                    } else {
                        if ( isset( $holiday ) ) {
                            $arr = array(
                                'student_session_id' => $value,
                                'attendence_type_id' => 5,
                                'date'               => date( 'Y-m-d', $this->customlib->datetostrtotime( $date ) )
                            );
                        } else {
                            $arr = array(
                                'student_session_id' => $value,
                                'attendence_type_id' => $this->input->post( 'attendencetype' . $value ),
                                'date'               => date( 'Y-m-d', $this->customlib->datetostrtotime( $date ) )
                            );
                        }

                        $insert_id = $this->stuattendence_model->add( $arr );
                        $_attendance_type = $this->attendencetype_model->get( $arr['attendence_type_id'] );
                        
                        if ( !empty( $_attendance_type ) && strtolower( $_attendance_type['type'] ) == 'absent' ) {
                            $_sms_ab_student = $this->studentsession_model->searchStudents( null, null, null, null, null, null, $arr['student_session_id'] );
                            $adminsess = $this->session->userdata( 'admin' );
                            $this->load->helper('menu_helper');
                            $permission = admin_permission($adminsess['id']);
                            if($permission->school_message == 1 ){
                                $school_name = '';
                            }else{
                                $school_name = $this->setting_model->getCurrentSchoolName();
                            }
                            if($permission->parent_att_msg == 1){
                                $this->sms_library->send_sms( $_sms_ab_student['father_phone'], $this->sms_messages->student_absent_message( "{$_sms_ab_student['firstname']} {$_sms_ab_student['lastname']}", $_sms_ab_student['gender'], $_sms_ab_student['class'], $_sms_ab_student['section'],$school_name ) );
                            }
                           
                        }
                       
                    }
                }
                $this->session->set_flashdata( 'msg', '<div class="alert alert-success text-left">Attendance Saved Successfully</div>' );
                redirect( 'admin/stuattendence/index' );
            }

            $attendencetypes             = $this->attendencetype_model->get();
            $data['attendencetypeslist'] = $attendencetypes;
            $resultlist                  = $this->stuattendence_model->searchAttendenceClassSection( $class, $section, date( 'Y-m-d', $this->customlib->datetostrtotime( $date ) ) );
            $data['resultlist']          = $resultlist;
            $this->load->view( 'layout/header', $data );
            $this->load->view( 'admin/stuattendence/attendenceList', $data );
            $this->load->view( 'layout/footer', $data );
        }
    }

    public function marking_student()
    {
        $admission_no =  $this->input->post( 'admission_no' );
        $section_id =  $this->input->post( 'section_id' );
        $class_id =  $this->input->post( 'class_id' );
        $students_where = array();
        if ( !empty( $class_id ) ) {
            $students_where['student_session.class_id'] = $class_id;
        }
        if ( !empty( $section_id ) ) {
            $students_where['student_session.section_id'] = $section_id;
        }
        $student = $this->student_model->get(null, $students_where, null,'phone',$admission_no);
       
	    $data =array(
          'student' => $student,
        );
 
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
    }


    function marking()
    {
        $this->session->set_userdata( 'top_menu', 'Attendance' );
        $this->session->set_userdata( 'sub_menu', 'stuattendence/index' );
        $data['title']      = 'Student Attendance';
        $data['title_list'] = 'Fees Type List';
        $class              = $this->class_model->get();
        $data['classlist']  = $class;
        $data['class_id']   = "";
        $data['section_id'] = "";
        $data['date']       = date( 'm/d/Y', now() );


        $class_sections = $this->classsection_model->class_sections();
     
        for ( $i = 0; $i < count( $class_sections ); $i++ ) {
            $class_sections[$i]['attendance'] = $this->student_model->calculate_attendance( $class_sections[$i]['class_id'], $class_sections[$i]['section_id'], date( 'Y-m-d', strtotime( $data['date'] ) ) );
            $class_sections[$i]['attendance_cus'] = [
                'p' => 0,
                'l' => 0,
                'a' => 0
            ];

            foreach ( $class_sections[$i]['attendance']['attendance_types'] as $itm ) {
                if ( strtolower( $itm['type'] ) == 'absent' ) {
                    $class_sections[$i]['attendance_cus']['a'] += intval( $itm['attendance_count'] );
                }   elseif (strtolower( $itm['type'] ) == 'leave') {
                    $class_sections[$i]['attendance_cus']['l'] += intval( $itm['attendance_count'] );
                } else {
                    $class_sections[$i]['attendance_cus']['p'] += intval( $itm['attendance_count'] );
                }
            }
        }
       


        $data['class_sections'] = $class_sections;

        if ( $this->input->server( 'REQUEST_METHOD' ) == "GET" ) {
            $this->form_validation->set_data( $_GET );
        }

        $this->form_validation->set_rules( 'class_id', 'Class', 'trim|required|xss_clean' );
        $this->form_validation->set_rules( 'section_id', 'Section', 'trim|required|xss_clean' );
        if ( $this->form_validation->run() == FALSE ) {

            $this->load->view( 'layout/header', $data );
            $this->load->view( 'admin/stuattendence/marking', $data );
            $this->load->view( 'layout/footer', $data );
        } else {
            $class                  = $this->input->post_get( 'class_id' );
            $section                = $this->input->post_get( 'section_id' );
            $date                   = $this->input->post_get( 'date' );
            $student_list           = $this->stuattendence_model->get();
            $data['studentlist']    = $student_list;
            $data['class_id']       = $class;
            $data['section_id']     = $section;
            $data['date']           = $date;
            
          
            $class1                       = $this->class_model->get($class);
            $section1                     = $this->section_model->get($section);
            $data['class_name']          = $class1['class'];
            $data['section_name']        = $section1['section'];

            $search     = $this->input->post_get( 'search' );
            $holiday    = $this->input->post_get( 'holiday' );
           

            $attendencetypes             = $this->attendencetype_model->get();
            $data['attendencetypeslist'] = $attendencetypes;
            $resultlist                  = $this->stuattendence_model->searchAttendenceClassSection( $class, $section, date( 'Y-m-d', $this->customlib->datetostrtotime( $date ) ) );
            $data['resultlist']          = $resultlist;
          

            $this->load->view( 'layout/header', $data );
            $this->load->view( 'admin/stuattendence/marking', $data );
            $this->load->view( 'layout/footer', $data );
        }
    }

    function attendencereport()
    {
        $this->session->set_userdata( 'top_menu', 'Reports' );
        $this->session->set_userdata( 'sub_menu', 'stuattendence/attendenceReport' );
        $data['title'] = 'Add Fees Type';
        $data['title_list'] = 'Fees Type List';
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        $data['class_id'] = "";
        $data['section_id'] = "";
        $data['date'] = "";
        $this->form_validation->set_rules( 'class_id', 'Class', 'trim|required|xss_clean' );
        $this->form_validation->set_rules( 'section_id', 'Section', 'trim|required|xss_clean' );
        $this->form_validation->set_rules( 'date', 'Date', 'trim|required|xss_clean' );
        if ( $this->form_validation->run() == FALSE ) {
            $this->load->view( 'layout/header', $data );
            $this->load->view( 'admin/stuattendence/attendencereport', $data );
            $this->load->view( 'layout/footer', $data );
        } else {
            $class = $this->input->post( 'class_id' );
            $section = $this->input->post( 'section_id' );
            $date = $this->input->post( 'date' );
            $student_list = $this->stuattendence_model->get();
            $data['studentlist'] = $student_list;
            $data['class_id'] = $class;
            $data['section_id'] = $section;
            $data['date'] = $date;
            $search = $this->input->post( 'search' );
            if ( $search == "saveattendence" ) {
                $session_ary = $this->input->post( 'student_session' );
                foreach ( $session_ary as $key => $value ) {
                    $checkForUpdate = $this->input->post( 'attendendence_id' . $value );
                    if ( $checkForUpdate != 0 ) {
                        $arr = array(
                            'id' => $checkForUpdate,
                            'student_session_id' => $value,
                            'attendence_type_id' => $this->input->post( 'attendencetype' . $value ),
                            'date' => date( 'Y-m-d', $this->customlib->datetostrtotime( $date ) )
                        );
                        $insert_id = $this->stuattendence_model->add( $arr );
                    } else {
                        $arr = array(
                            'student_session_id' => $value,
                            'attendence_type_id' => $this->input->post( 'attendencetype' . $value ),
                            'date' => date( 'Y-m-d', $this->customlib->datetostrtotime( $date ) )
                        );
                        $insert_id = $this->stuattendence_model->add( $arr );
                    }
                }
            }
            $attendencetypes = $this->attendencetype_model->get();
            $data['attendencetypeslist'] = $attendencetypes;
            $resultlist = $this->stuattendence_model->searchAttendenceClassSectionPrepare( $class, $section, date( 'Y-m-d', $this->customlib->datetostrtotime( $date ) ) );


            $data['resultlist'] = $resultlist;




            $this->load->view( 'layout/header', $data );
            $this->load->view( 'admin/stuattendence/attendencereport', $data );
            $this->load->view( 'layout/footer', $data );
        }
    }

    function classattendencereport()
    {
        $this->session->set_userdata( 'top_menu', 'Reports' );
        $this->session->set_userdata( 'sub_menu', 'stuattendence/classattendencereport' );
        $attendencetypes = $this->attendencetype_model->get();
        $data['attendencetypeslist'] = $attendencetypes;
        $data['title'] = 'Student Attendance';
        $data['title_list'] = 'Student List';
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        $data['monthlist'] = $this->customlib->getMonthDropdown();
        $data['class_id'] = "";
        $data['section_id'] = "";
        $data['date'] = "";
        $data['month_selected'] = date( 'F', now() );

        $class_sections = $this->classsection_model->class_sections();

        for ( $i = 0; $i < count( $class_sections ); $i++ ) {
            $class_sections[$i]['attendance']       = $this->student_model->calculate_attendance( $class_sections[$i]['class_id'], $class_sections[$i]['section_id'], date( 'Y-m-d', now() ) );
            $class_sections[$i]['attendance_cus']   = [
                'p' => 0,
                'l' => 0,
                'a' => 0
            ];

            foreach ( $class_sections[$i]['attendance']['attendance_types'] as $itm ) {
                if ( strtolower( $itm['type'] ) == 'absent' ) {
                    $class_sections[$i]['attendance_cus']['a'] += intval( $itm['attendance_count'] );
                }   elseif (strtolower( $itm['type'] ) == 'leave') {
                    $class_sections[$i]['attendance_cus']['l'] += intval( $itm['attendance_count'] );
                } else {
                    $class_sections[$i]['attendance_cus']['p'] += intval( $itm['attendance_count'] );
                }
            }
        }

        $holidays   = $this->stuattendence_model->get_holiday();
        $total_holiday= 0;
        foreach($holidays as $holiday){
            $total_holiday += $holiday['days'];
        }
        $start_month = $this->setting_model->getStartMonth();
        $saturday = $this->setting_model->getSaturday();
        $data['saturday']  =    $saturday;  
               
        $counting  =  getSundays(date('Y'),$start_month);
       if($saturday == 1){
        $counting = $counting +$counting;
       }
       
        $total  = $total_holiday + $counting;
        $data['total'] = $total;
        $data['class_sections'] = $class_sections;

        if ( $this->input->method( 'get' ) ) {
            $this->form_validation->set_data( $this->input->get() );
        }

        $this->form_validation->set_rules( 'class_id', 'Class', 'trim|required|xss_clean' );
        $this->form_validation->set_rules( 'section_id', 'Section', 'trim|required|xss_clean' );
        $this->form_validation->set_rules( 'month', 'Month', 'trim|required|xss_clean' );
        if ( $this->form_validation->run() == FALSE ) {
            $this->load->view( 'layout/header', $data );
            $this->load->view( 'admin/stuattendence/classattendencereport', $data );
            $this->load->view( 'layout/footer', $data );
        } else {
            $resultlist                 = array();
            $class                      = $this->input->post_get( 'class_id' );
            $section                    = $this->input->post_get( 'section_id' );
            $month                      = $this->input->post_get( 'month' );
            $data['class_id']           = $class;
            $data['section_id']         = $section;
            $data['month_selected']     = $month;
            $studentlist                = $this->student_model->searchByClassSection( $class, $section );
            $session_current            = $this->setting_model->getCurrentSessionName();
            $startMonth                 = $this->setting_model->getStartMonth();
            $centenary                  = substr( $session_current, 0, 2 ); //2017-18 to 2017
            $year_first_substring       = substr( $session_current, 2, 2 ); //2017-18 to 2017
            $year_second_substring      = substr( $session_current, 5, 2 ); //2017-18 to 18
            $month_number               = date( "m", strtotime( $month ) );

            if ( $month_number >= $startMonth && $month_number <= 12 ) {
                $year = $centenary . $year_first_substring;
            } else {
                $year = $centenary . $year_second_substring;
            }
            $num_of_days            = cal_days_in_month( CAL_GREGORIAN, $month_number, $year );
            $attr_result            = array();
            $attendence_array       = array();
            $student_result         = array();
            $data['no_of_days']     = $num_of_days;
            $date_result = array();

            for ( $i = 1; $i <= $num_of_days; $i++ ) {
                $att_date = $year . "-" . $month_number . "-" . sprintf( "%02d", $i );
                $attendence_array[] = $att_date;

                $res = $this->stuattendence_model->searchAttendenceClassSection( $class, $section, $att_date );

                $student_result = $res;
                $s = array();
                foreach ( $res as $result_k => $result_v ) {
                    $s[$result_v['student_session_id']] = $result_v;
                }

                $date_result[$att_date] = $s;
            }

            



            $class                      = $this->class_model->get($class);
            $section                    = $this->section_model->get($section);
            $data['class_name']         = $class['class'];
            $data['section_name']       = $section['section'];
            $data['resultlist']         = $date_result;
            $data['attendence_array']   = $attendence_array;
            $data['student_array']      = $student_result;
            $this->load->view( 'layout/header', $data );
            $this->load->view( 'admin/stuattendence/classattendencereport', $data );
            $this->load->view( 'layout/footer', $data );
        }
    }

    public function bulk_student_attendance()
    {
        $bulk_student_admission_numbers1 = $this->input->get( 'bulk_student_attendance' );
       
        foreach($bulk_student_admission_numbers1 as $bulk_student_admission_number){
           $bulk_student_admission_numbers =   $bulk_student_admission_number;
        }
            if(!empty($bulk_student_admission_numbers)){
            }else{
            redirect('admin/stuattendence/marking');
            }           
            $attendance_date = new DateTime( date( 'Y-m-d', now() ) );

            // removing spaces from the admission numbers
            $bulk_student_admission_numbers = str_replace( ' ', '', $bulk_student_admission_numbers );
            // converting to array of admission numbers
            $bulk_student_admission_numbers = explode( ',', $bulk_student_admission_numbers );

            // starting transactions
            $this->db->trans_start();

            $absent_students = array();
            $absent_student_ids = array();

            foreach ( $bulk_student_admission_numbers as $admission_number ) {
                $student = $this->student_model->search_student( null, $admission_number );
                if ( $student !== null ) {
                    $absent_students[] = $student;
                    $absent_student_ids[] = $student['id'];
                }
            }

            // getting present students
            $present_students = $this->student_model->searchByClassSection( null, null, null, null, $absent_student_ids );

            $attendance_types = [
                'present' => $this->attendencetype_model->get( null, 'present' ),
                'absent' => $this->attendencetype_model->get( null, 'absent' )
            ];

            $leave_students  =  $this->stuattendence_model->search_attendance_leave( $attendance_date->format( 'Y-m-d' ) );
            foreach ( $leave_students as $leave_students ) {
                if($permission->parent_att_msg == 1){
                     $this->sms_library->send_sms( $leave_students['father_phone'], $this->sms_messages->student_absent_message( "{$leave_students['firstname']} {$leave_students['lastname']}", strtolower( $leave_students['gender'] ), $leave_students['class'], $leave_students['section'],'leave' ) );
                }
            }
            // marking students as present
            foreach ( $present_students as $present_student ) {
                $this->stuattendence_model->mark_attendance( $present_student['student_session_id'], $attendance_types['present']['id'], $attendance_date->format( 'Y-m-d' ) );
            }
           

            // marking students as absent
            foreach ( $absent_students as $absent_student ) {
                $this->stuattendence_model->mark_attendance( $absent_student['student_session_id'], $attendance_types['absent']['id'], $attendance_date->format( 'Y-m-d' ) );
                if($permission->parent_att_msg == 1){
                     $this->sms_library->send_sms( $absent_student['father_phone'], $this->sms_messages->student_absent_message( "{$absent_student['firstname']} {$absent_student['lastname']}", strtolower( $absent_student['gender'] ), $absent_student['class'], $absent_student['section'] ) );
                }
            }

            $admin_phone = $this->custom_option_model->get( 'admin_phone' );
                
                
            $total_student =  count( $present_students ) + count( $absent_students ) + count( $absent_students ) + count($leave_students);
        

            $this->sms_library->send_sms( $admin_phone['value'], $this->sms_messages->admin_attendence( date('d-M-Y',now()), count( $present_students ), count( $absent_students ) ,count($leave_students),$total_student ));

            // ending transactions
            $this->db->trans_complete();

            // if something went wrong
            if ( $this->db->trans_status() === FALSE ) {
                $this->session->set_flashdata( 'err', "Something went wrong while performing the operation. Please try again." );
                $this->session->set_flashdata( 'expense_err', "Something went wrong while performing the operation. Please try again." );
            } else { // everything succeeded
                $this->session->set_flashdata( 'msg', " Today's attendance has been marked"  );
                $this->session->set_flashdata( 'expense_msg', count( $present_students ) . " student(s) were marked as present and " . count( $absent_students ) . " student(s) were marked as absent." );
            }

            redirect( 'admin/stuattendence/marking' );

    }

    public function attendance_report_student()
    {
        $this->session->set_userdata( 'top_menu', 'Reports' );
        $this->session->set_userdata( 'sub_menu', 'stuattendence/classattendencereport' );

        $resultlist                 = array();
        $student_id                 = $this->input->post_get( 'student_id' );
        $month                      = date('F');
        $data['month_selected']     = $month;
        $studentlist                = $this->student_model->getstudents( $student_id );
        $session_current            = $this->setting_model->getCurrentSessionName();
        $startMonth                 = $this->setting_model->getStartMonth();
        $centenary                  = substr( $session_current, 0, 2 ); //2017-18 to 2017
        $year_first_substring       = substr( $session_current, 2, 2 ); //2017-18 to 2017
        $year_second_substring      = substr( $session_current, 5, 2 ); //2017-18 to 18

        $month_number[] = array();
        for ( $m = 1; $m < 13; $m++ ):
            $month_number= str_pad($m,2,0,STR_PAD_LEFT);
        endfor;


        if ( $month_number >= $startMonth && $month_number <= 12 ) {
            $year = $centenary . $year_first_substring;
        } else {
            $year = $centenary . $year_second_substring;
        }
        $year = date('Y',now());

        $attr_result            = array();
        $attendence_array       = array();
        $student_result         = array();

        $attendance_dates = [];

        $num_of_days  = cal_days_in_month( CAL_GREGORIAN, $month_number, $year );
        $data['no_of_days']     = $num_of_days;
        for ( $day_number = 1; $day_number <= $num_of_days; $day_number++ ) {
            $attendance_dates[] = "{$year}-{$month}-{$day_number}";
        }


        for ( $m = 1; $m < 13; $m++ ):
            $students[$m]['day_attendance'] = array();
            $num_of_days  = cal_days_in_month( CAL_GREGORIAN, $m, $year );
            $annual = $m;
            for ( $i = 1; $i <= $num_of_days; $i++ ) {

                $att_date = $year . "-" . $annual . "-" . sprintf( "%02d", $i );
                $attendence_array[] = $att_date;
                $students[$m]['day_attendance'][$att_date] = $this->stuattendence_model->searchAttendencestudent($student_id,  $att_date );
        //         if(date( 'D', $this->customlib->dateyyyymmddTodateformat( $att_date ) ) == "Sun"){
        // echo "<pre>";
       
        //             print_r($students[$m]['day_attendance'][$att_date][0]['key'] = "H" );
        // echo "</pre>";
       
        //         }
               
            }
        endfor;
        // echo "<pre>";
        // print_r($students);
        // echo "</pre>";
         //   exit;
        $holidays   = $this->stuattendence_model->get_holiday();
        $total_holiday= 0;
        foreach($holidays as $holiday){
            $total_holiday += $holiday['days'];

        }

        $start_month = $this->setting_model->getStartMonth();
        $saturday = $this->setting_model->getSaturday();
        
        $counting  =  getSundays(date('Y'),$start_month);
       if($saturday == 1){
        $counting = $counting +$counting;
       }

        $total  = $total_holiday+ $counting;

        $data['total'] = $total;

        $student_details                   = $this->student_model->getstudents($student_id);

        $data['student_details']         = $student_details;
        $data['resultlist']         = $students;
        $data['attendence_array']   = $attendance_dates;
        $data['student_array']      = $student_result;
        $this->load->view( 'layout/header', $data );
        $this->load->view( 'admin/stuattendence/attendance_report_student', $data );
        $this->load->view( 'layout/footer', $data );
    }


    function holiday()
    {

        $this->session->set_userdata( 'top_menu', 'TeacherAttendance' );
        $this->session->set_userdata( 'sub_menu', 'teacher/index' );
        $data['title']          = 'Holiday(s) Management ';

        $redirect_url           = current_url() . '?' . $this->input->server( 'QUERY_STRING' );
        $data['redirect_url']   = $redirect_url;

        $message_result         = $this->stuattendence_model->get_holiday();
        $data['messages']    = $message_result ;

        $this->load->view( 'layout/header', $data );

        $this->load->view( 'admin/stuattendence/mark_holiday', $data );

        $this->load->view( 'layout/footer', $data );
    }


    public function holiday_process()
    {

        $this->form_validation->set_rules( 'message_title', 'message_title', 'trim|required|xss_clean' );
        $this->form_validation->set_rules( 'date_to', 'Date', 'trim|required|xss_clean' );
        $this->form_validation->set_rules( 'date_from', 'Date', 'trim|required|xss_clean' );

        if ( $this->form_validation->run() == FALSE ) {

            $data = [];
            $this->load->view( 'layout/header', $data );
            $this->load->view( 'admin/stuattendence/mark_holiday', $data );
            $this->load->view( 'layout/footer', $data );
        } else {

            $holiday_title            = $this->input->post( 'message_title' );

            $date_to    = $this->input->post( 'date_to' );

            $date_from    = $this->input->post( 'date_from' );

            $now = time(); // or your date as well

            $to_date = strtotime("$date_to");

            $from_date = strtotime("$date_from");

            $datediff = $to_date - $from_date;

            $number_days  =   round($datediff / (60 * 60 * 24));

            $students = $this->student_model->get();
            // get all the teachers

            $teachers = $this->teacher_model->get();

            $staffs = $this->staff_model->get();


            foreach ( $staffs as $staff ) {
                $f = date("Y-m-d" ,strtotime($date_from));
                $t = date("Y-m-d" ,strtotime($date_to));
        
                $datearray =  $this->createDateRangeArray($f,$t);
                foreach ($datearray as $key => $value) {

                    $this->staff_attendance_model->add2($staff['id'],'Holiday',date( 'Y-m-d',  strtotime($value) ),'00:00:00');

                }
            }

            foreach ( $teachers as $teacher ) {
                
                $f = date("Y-m-d" ,strtotime($date_from));
                $t = date("Y-m-d" ,strtotime($date_to));
        
                $datearray =  $this->createDateRangeArray($f,$t);
                foreach ($datearray as $key => $value) {
                    $teacher_attendance = $this->teacher_attendance_model->search_attendance( $teacher['id'], date( 'm/d/Y', strtotime( $value )));
                    if(empty($teacher_attendance)){
                        $this->teacher_attendance_model->insert2( [
                            'teacher_id' => $teacher['id'],
                            'teacher_attendence_type_id' => 5,
                            'attendance_date' => date( 'Y-m-d',  strtotime($value) ),
                            'attendance_time' => '00:00:00'
                        ] );
                    }
                }
            }

            
            foreach ( $students as $student ) {


                $f = date("Y-m-d" ,strtotime($date_from));
                $t = date("Y-m-d" ,strtotime($date_to));
        
                $datearray =  $this->createDateRangeArray($f,$t);
               
                foreach ($datearray as $key => $value) {
                $search_attendance = $this->stuattendence_model->search_attendance($student['student_session_id'], date( 'm/d/Y', strtotime( $value )));
                    if(empty($search_attendance)){
                        $this->stuattendence_model->add( [
                            'student_session_id' => $student['student_session_id'],
                            'attendence_type_id' => 5,
                            'date'               => date( 'Y-m-d',  strtotime($value) )
                        ] );
                    }else{
                        $arr = array(
                            'id'                 => $search_attendance['id'],
                            'student_session_id' => $student_id1,
                            'attendence_type_id' => 5,
                            'date'               =>  $value 
                        );
                        $insert_id = $this->stuattendence_model->add( $arr );
                    }
                }
            }

        
            // insert record in student fee voucher table
            $this->db->insert( 'holiday', [
                'date_from' => date('Y-m-d', strtotime($date_to )),
                'date_to' => date('Y-m-d', strtotime($date_from )),
                'title' => $holiday_title,
                'days' =>  $number_days+1,
            ] );

        }
        redirect('admin/stuattendence/holiday');
    }
    public function holiday_process_saturday()
    {
        $data = array(
            'saturday' => $this->input->post('saturday'),
            );
        $this->setting_model->add($data);
        redirect('admin/stuattendence/holiday');
    }

    function delete_holiday( $id )
    {
        $this->db->delete( 'holiday', [
            'id' => $id
        ]);
        redirect( 'admin/stuattendence/holiday' );
    }


    public function advanceAttendance(){

        $details = array();

        $advanceLeave =  $this->student_model->getAdvanceLeave();

        foreach($advanceLeave as $key => $leave){
            $details[$key]['student_id']     =   $leave['student_id'];
            $details[$key]['teacher_id']     =   $leave['teacher_id'];
            $details[$key]['days']           =   $leave['days'];
            $details[$key]['id']             =   $leave['id'];
            $details[$key]['reason']         =   $leave['reason'];
            $details[$key]['date_from']      =   $leave['date_from'];
            $details[$key]['date_to']        =   $leave['date_to'];
            
            if($leave['student_id'] != 0){
                $details[$key]['student'] = $this->student_model->get($leave['student_id']);
            }else{
                $details[$key]['teacher'] = $this->teacher_model->get($leave['teacher_id']);
            }
        }

        $data['advanceLeave']  = $details;
        $data['title']     = "Advance Leave Mark";
        $data['teachers']  = $this->teacher_model->get();
        $this->load->view( 'layout/header', $data );
        $this->load->view( 'admin/stuattendence/advanceAttendence', $data );
        $this->load->view( 'layout/footer', $data );

    }

    public function getstudentdetails( ){
        $data= array();
        $admission =  $this->input->post("admission");
        $data['student']  = $this->student_model->search_student(null,$admission);
        echo json_encode($data);
        exit();
    }


    public function SaveAdvanceLeave( ){
        
        $this->form_validation->set_rules( 'leave', 'leave', 'trim|required|xss_clean' );
        $this->form_validation->set_rules( 'date_to', 'Date', 'trim|required|xss_clean' );
        $this->form_validation->set_rules( 'date_from', 'Date', 'trim|required|xss_clean' );
        $this->form_validation->set_rules( 'reason', 'reason', 'trim|required|xss_clean' );

        $student_id    = $this->input->post('student_id');
        $teacher_id    = $this->input->post('teacher_id');
        $leave         = $this->input->post('leave');
        $date_to       = $this->input->post('date_to');
        $date_from     = $this->input->post('date_from');
        $reason        = $this->input->post('reason');
        
        $to_date        = strtotime("$date_to");
        $from_date      = strtotime("$date_from");
        $datediff       = $to_date - $from_date;
        $number_days    = round($datediff / (60 * 60 * 24));

        $f = date("Y-m-d" ,strtotime($date_from));
        $t = date("Y-m-d" ,strtotime($date_to));

        $datearray =  $this->createDateRangeArray($f,$t);
        
      
    if(!empty($student_id)){

        $student  = $this->student_model->get($student_id);

        $student_id1 = $student['student_session_id'];

        foreach ( $datearray as $key => $value ) {
            $checkAttendence =    $this->student_model->checkAttendenceDate($student_id1 , $value  );
            
            if(empty($checkAttendence)){
                $arr = array(
                    'student_session_id' => $student_id1,
                    'attendence_type_id' => 3,
                    'date'               =>  $value  
                );
                $insert_id = $this->stuattendence_model->add( $arr );
            }else{
                $arr = array(
                    'id'                 => $checkAttendence['id'],
                    'student_session_id' => $student_id1,
                    'attendence_type_id' => 3,
                    'date'               =>  $value 
                );
                $insert_id = $this->stuattendence_model->add( $arr );
            }
       }

    
    }elseif(!empty($teacher_id)){

        $teacher  =$this->teacher_model->get($teacher_id);
       
        foreach ( $datearray as $key => $value ) {
        
            $insert_data = array();
            $insert_data['teacher_id'] = $teacher_id;
            $insert_data['attendance_date'] = date( 'Y-m-d', strtotime($value));
            $insert_data['attendance_time'] = date( 'H:i:s', now() );
            $insert_data['attendance_lecture_based'] = 0;
            $insert_data['teacher_attendence_type_id'] = 3;
        // setting attended lectures and total lectures 0 for permanent users
            $insert_data['attended_lectures'] = 0;
            $insert_data['total_lectures'] = 0;

            $this->teacher_attendance_model->insert( $insert_data );  
        
        }
    }



        $data = array(
            'student_id' => $student_id,
            'teacher_id' => $teacher_id,
            'leave' => $leave,
            'days'  => $number_days +1,
            'date_to' => date('Y-m-d',strtotime($date_to)),
            'date_from' => date('Y-m-d',strtotime($date_from)),
            'reason' => $reason,
        );
        $insert = $this->student_model->leaveAttendence($data);
        redirect("admin/stuattendence/advanceAttendance");
    }


    public function createDateRangeArray($strDateFrom,$strDateTo)
    {
        // takes two dates formatted as YYYY-MM-DD and creates an
        // inclusive array of the dates between the from and to dates.
    
        // could test validity of dates here but I'm already doing
        // that in the main script
    
        $aryRange=array();
    
        $iDateFrom=mktime(1,0,0,substr($strDateFrom,5,2),     substr($strDateFrom,8,2),substr($strDateFrom,0,4));
        $iDateTo=mktime(1,0,0,substr($strDateTo,5,2),     substr($strDateTo,8,2),substr($strDateTo,0,4));
    
        if ($iDateTo>=$iDateFrom)
        {
            array_push($aryRange,date('Y-m-d',$iDateFrom)); // first entry
            while ($iDateFrom<$iDateTo)
            {
                $iDateFrom+=86400; // add 24 hours
                array_push($aryRange,date('Y-m-d',$iDateFrom));
            }
        }
        return $aryRange;
    }


    public function deleteleave($id ){


  
        $delete = $this->student_model->leave_delete($id);

        redirect("admin/stuattendence/advanceAttendance");
  

    }

    /*?> public function mark_all_absent()
      {
        $current_time =  date( 'm/d/Y', now());

        $date1 = date( 'Y-m-d', $this->customlib->datetostrtotime( $current_time  ) );

        $restrict_attendance_after = $this->custom_option_model->get( 'restrict_attendance_after' );
        $restrict_attendance_after = $restrict_attendance_after['value'];

        $this->load->model( ['student_model', 'teacher_attendence_type_model'] );

        // if current time is greater than the restriction time for the attendance

              if ( date( 'D', $this->customlib->dateyyyymmddTodateformat( $date1 ) ) == "Sun" ) {

               $students = $this->student_model->get(  );
            // get all the teachers

              foreach ( $students as $student ) {

          $search_attendance = $this->stuattendence_model->search_attendance($student['student_session_id'], $current_time );

          if ( $search_attendance === null ) {

          $this->stuattendence_model->add( [
                                'student_session_id' => $student['student_session_id'],
                                'attendence_type_id' => 5,
                                'date'               => date( 'Y-m-d', $this->customlib->datetostrtotime( $current_time ) )
                            ] );

          }

            }

        }

    }<?php */




}
