<?php

if ( !defined( 'BASEPATH' ) )
    exit( 'No direct script access allowed' );

class site extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
		
        $this->check_installation();
        if ( $this->config->item( 'installed' ) == true ) {
            $this->db->reconnect();
        }
        $this->load->library( 'Auth' );
        $this->load->helper( 'file' );
        $this->lang->load( 'message', 'english' );
    }

    private function check_installation()
    {
        if ( $this->uri->segment( 1 ) !== 'install' ) {
            $this->load->config( 'migration' );
            if ( $this->config->item( 'installed' ) == false && $this->config->item( 'migration_enabled' ) == false ) {
                redirect( base_url() . 'install/start' );
            } else {
                if ( is_dir( APPPATH . 'controllers/install' ) ) {
                    echo '<h3>Delete the install folder from application/controllers/install</h3>';
                    die;
                }
            }
        }
    }

    function login2()
    {
        $data['title'] = 'Login';
        $this->form_validation->set_rules( 'username', 'Username', 'trim|required|xss_clean' );
        $this->form_validation->set_rules( 'password', 'Password', 'trim|required|xss_clean' );
        if ( $this->form_validation->run() == FALSE ) {
            $this->load->view( 'admin/login', $data );
        } else {
            $data = array(
                'username' => $this->input->post( 'username' ),
                'password' => $this->input->post( 'password' )
            );
            $result = $this->admin_model->checkLogin( $data );
            if ( $result == TRUE ) {
                $username = $this->input->post( 'username' );
                $admin_details = $this->admin_model->read_user_information( $username );
                if ( $admin_details != false ) {
                    $setting_result = $this->setting_model->get();
                    $session_data = array(
                        'id' => $admin_details[0]->id,
                        'username' => $admin_details[0]->username,
                        'email' => $admin_details[0]->email,
                        'date_format' => $setting_result[0]['date_format'],
                        'currency_symbol' => $setting_result[0]['currency_symbol'],
                        'start_month' => $setting_result[0]['start_month'],
                        'school_name' => $setting_result[0]['name'],
                        'timezone' => $setting_result[0]['timezone'],
                        'sch_name' => $setting_result[0]['name'],
                        'language' => array('lang_id' => $setting_result[0]['lang_id'], 'language' => $setting_result[0]['language']),
                        'is_rtl' => $setting_result[0]['is_rtl'],
                    );
                    $this->session->set_userdata( 'admin', $session_data );
                    redirect( 'admin/admin/dashboard' );
                }
            } else {
                $data = array(
                    'error_message' => 'Invalid Username or Password'
                );
                $this->load->view( 'admin/login', $data );
            }
        }
    }

    function login()
    {


        $data = array();

        $data['title'] = 'Login';

        $setting_result = $this->setting_model->get();
		     
        $data['setting_result'] = $setting_result[0];

        $this->form_validation->set_rules( 'username', 'Username', 'trim|required|xss_clean' );
        $this->form_validation->set_rules( 'password', 'Password', 'trim|required|xss_clean' );
   
        if ( $this->form_validation->run() == FALSE ) {
        
            $this->load->view( 'admin/login_new', $data );
            $this->load->view( 'layout/new/footer', $data );
        } else {
            $data['username'] = $this->input->post( 'username' );
            $data['password'] = $this->input->post( 'password' );
 
            $result = $this->admin_model->checkLogin( $data );


            if ( $result == TRUE ) {
                $username = $this->input->post( 'username' );
             
                $admin_details = $this->admin_model->read_user_information( $username );
       
                if ( $admin_details != false ) {
                    $setting_result = $this->setting_model->get();
                    $session_data = array(
                        'id'                    => $admin_details[0]->id,
                        'username'              => $admin_details[0]->username,
                        'email'                 => $admin_details[0]->email,
                        'role'                  => $admin_details[0]->role,
						'date_format'           => $setting_result[0]['date_format'],
                        'currency_symbol'       => $setting_result[0]['currency_symbol'],
                        'start_month'           => $setting_result[0]['start_month'],
                        'school_name'           => $setting_result[0]['name'],
                        'timezone'              => $setting_result[0]['timezone'],
                        'sch_name'              => $setting_result[0]['name'],
                        'language'              => array('lang_id' => $setting_result[0]['lang_id'], 'language' => $setting_result[0]['language']),
                        'is_rtl'                => $setting_result[0]['is_rtl'],
                    );
                    $this->session->set_userdata( 'admin', $session_data );
   
 error_reporting(E_ALL);
ini_set('display_errors', 1);

                    redirect( 'balance_sheet' );
                }
            } else {
                $data['error_message'] = "Invalid Username or Password";

                $this->load->view( 'admin/login_new', $data );
                $this->load->view( 'layout/new/footer', $data );
            }
        }
    }

    function logout()
    {
        $admin_session = $this->session->userdata( 'admin' );
        $student_session = $this->session->userdata( 'student' );
        $this->auth->logout();
        if ( $admin_session ) {
            redirect( 'site/login' );
        } else if ( $student_session ) {
            redirect( 'site/userlogin' );
        }
    }

    function forgotpassword()
    {
        $this->form_validation->set_rules( 'username', 'Username', 'trim|required|xss_clean' );
        if ( $this->form_validation->run() == FALSE ) {
            $this->load->view( 'layout/new/header' );
            $this->load->view( 'admin/forgotpassword_new' );
            $this->load->view( 'layout/new/footer' );
        } else {
            $username = $this->input->post( 'username' );
            $result = $this->admin_model->read_user_information( $username );
            if ( $result == TRUE ) {

                $randompassword = $this->role->get_random_password();
                $newdata = array(
                    'email' => $username,
                    'password' => md5( $randompassword )
                );
                $query = $this->admin_model->saveForgotPass( $newdata );
                if ( $query ) {
                    $subject = "Your new password for Admin Login";
                    $body = "Your new password is: <b>" . $randompassword . "</b><br><br>Please change the password immediately after login for security reasons.";
                    $result = $this->customlib->send_mail_to( $username, $subject, $body );
                    if ( $result ) {
                        $data = array(
                            'error_message' => 'New password has been sent on your email'
                        );
                        $this->load->view( 'admin/login', $data );
                    } else {
                        $data = array(
                            'error_message' => 'Error in processing'
                        );
                        $this->load->view( 'admin/forgotpassword', $data );
                    }
                }
            } else {
                $data = array(
                    'error_message' => 'Invalid Username'
                );
                $this->load->view( 'admin/forgotpassword', $data );
            }
        }
    }

    function admin_fee_message(){

        $admin_phone = $this->custom_option_model->get( 'admin_phone' );
        $school_name = $this->setting_model->getCurrentSchoolName();

        $date_from              = date( 'Y-m-01' );
        $date_to                = date('Y-m-d',strtotime("-1 days"));;
        $date                   = date( 'Y-m-d');
        $opening                = $this->transactions_model->get( $date, $date_from, $date_to );
        $log                    = $this->class_section_monthly_log_model->get_log_sum();
        $unpaid_students_other  = $this->student_fee_voucher_model->get_unpaid_other45( );
        $fine                   = $this->student_model->fine_sum();
        $waive_fine             = $this->student_fee_payments->payment_fine_sum();
        $fine_struck_sum        = $this->student_model->fine_struck_sum();

        $fine_struck_sum['struck_fine'];
        $total_arrears          = $log['due_arrears'] +  $log['paid_arrears'] + $log['waive_arrears'] + $log['withdraw_arrears'] - $log['due_fee']- $fine['total_fine'];
        $total_monthly_due      = $log['total_fee'] - $log['adjusted_fee'] ;
        $arrears                = $log['due_arrears'] - $fine['total_fine'] - $log['due_fee'];
        
        $due_fine               =  $fine['total_fine']  + $log['paid_fine'] + $waive_fine['fine'] + $fine_struck_sum['struck_fine'];
        $paid_other             =  $log['total_other_fee'];
        $due_other_fee          =  $unpaid_students_other  + $paid_other;
        
        
        $receive_o = 0;
        $expense_o = 0;
        foreach($opening as $pay){
            if($pay['type'] == "in"){
                $receive_o += $pay['amount'];
            }
            if($pay['type']  == "out"){
                $expense_o  += $pay['amount'];
            }
        }

        $opening_cash = $receive_o - $expense_o;
      
        $today    = $this->transactions_model->get( $date, $date, $date );
        $receive_d = 0;
        $expense_d = 0;
        $payments_d = 0;
        foreach($today as $pay){
            if($pay['type'] == "in"){
                $receive_d += $pay['amount'];
            }

            if($pay['type']  == "out"){
                if($pay['name'] == "Teacher Salary Payments" OR  $pay['name'] == "Staff Salary Payment" ){
                    $payments_d += $pay['amount']; 
                }else{
                    $expense_d  += $pay['amount'];
                }
            }
        }
        $closing_cash  = $opening_cash + $receive_d - $expense_d - $payments_d;
       
        $closing_cash  =number_format($closing_cash);
        
        $opening_cash =  number_format($opening_cash);
       
        // $this->sms_library->send_sms( $admin_phone['value'], $this->sms_messages->admin_fee_message1( $date,$total_monthly_due,$total_arrears,$log['paid_fee'],$log['paid_arrears'],$log['advance'],
        // $log['waive_fee'],$log['waive_arrears'] ,$log['withdraw_fee'],$log['withdraw_arrears'],$log['due_fee'], $arrears,$school_name  ) );

        $this->sms_library->send_sms( $admin_phone['value'], $this->sms_messages->admin_fee_message2(
            $date,$due_other_fee,$paid_other,$log['other_waive'],$unpaid_students_other ,$due_fine, $log['paid_fine'],$waive_fine['fine'] ,$fine_struck_sum['struck_fine'],$fine['total_fine']  ,$school_name  ) );

        //  $this->sms_library->send_sms( $admin_phone['value'], $this->sms_messages->admin_fee_message( $opening_cash, $receive_d , $expense_d,$payments_d,$closing_cash,date('Y-M-d'),$school_name) );
    }
    
    function userlogin()
    {
        $data['title'] = 'Login';
        $setting_result = $this->setting_model->get();
		
        $data['setting_result'] = $setting_result[0];
        
        
        $this->form_validation->set_rules( 'username', 'Username', 'trim|required|xss_clean' );
        $this->form_validation->set_rules( 'password', 'Password', 'trim|required|xss_clean' );
        if ( $this->form_validation->run() == FALSE ) {
            
            
            // $this->load->view( 'layout/new/header', $data );
            // $this->load->view( 'userlogin_new', $data );
            $this->load->view( 'userlogin1', $data );
            // $this->load->view( 'layout/new/footer', $data );
        } else {
            $data = array(
                'username' => $this->input->post( 'username' ),
                'password' => $this->input->post( 'password' )
            );
            $result = $this->user_model->checkLogin( $data );

            if ( $result ) {
                if ( $result[0]->is_active == "yes" ) {
                    $username = $this->input->post( 'username' );
                    if ( $result[0]->role == "student" ) {
                        $result = $this->user_model->read_user_information( $username );
                    } else if ( $result[0]->role == "parent" ) {
                        $result = $this->user_model->read_user_information( $username );
                    } else if ( $result[0]->role == "teacher" ) {
                        $result = $this->user_model->read_teacher_information( $username );
                    } else if ( $result[0]->role == "accountant" ) {
                        $result = $this->user_model->read_accountant_information( $username );
                    } else if ( $result[0]->role == "librarian" ) {
                        $result = $this->user_model->read_librarian_information( $username );
                    }

                    if ( $result != false ) {
                        $setting_result = $this->setting_model->get();
                        if ( $result[0]->role == "student" ) {
                            $session_data = array(
                                'id' => $result[0]->id,
                                'student_id' => $result[0]->user_id,
                                'role' => $result[0]->role,
                                'username' => $result[0]->firstname . " " . $result[0]->lastname,
                                'date_format' => $setting_result[0]['date_format'],
                                'currency_symbol' => $setting_result[0]['currency_symbol'],
                                'timezone' => $setting_result[0]['timezone'],
                                'sch_name' => $setting_result[0]['name'],
                                'language' => array('lang_id' => $setting_result[0]['lang_id'], 'language' => $setting_result[0]['language']),
                                'is_rtl' => $setting_result[0]['is_rtl'],
                            );
                            $this->session->set_userdata( 'student', $session_data );
                            redirect( 'user/user/dashboard' );
                        } else if ( $result[0]->role == "parent" ) {
                            $session_data = array(
                                'id' => $result[0]->id,
                                'student_id' => $result[0]->user_id,
                                'role' => $result[0]->role,
                                'username' => $result[0]->guardian_name,
                                'date_format' => $setting_result[0]['date_format'],
                                'timezone' => $setting_result[0]['timezone'],
                                'sch_name' => $setting_result[0]['name'],
                                'currency_symbol' => $setting_result[0]['currency_symbol'],
                                'language' => array('lang_id' => $setting_result[0]['lang_id'], 'language' => $setting_result[0]['language']),
                                'is_rtl' => $setting_result[0]['is_rtl'],
                            );
                            $this->session->set_userdata( 'student', $session_data );
                            $s = array();

                          
                            $childs_ids = ( $result[0]->childs );

                  
                            $students_array = $this->student_model->read_siblings_students( $childs_ids );
                        
                            foreach ( $students_array as $key => $each ) {
                                $d = array(
                                    'student_id' => $each['id'],
                                    'name' => $each['firstname'] . " " . $each['lastname']
                                );
                                $s[] = $d;
                            }
                            $this->session->set_userdata( 'parent_childs', $s );
                            redirect( 'parent/parents/dashboard' );
                        } else if ( $result[0]->role == "teacher" ) {
                            $session_data = array(
                                'id' => $result[0]->id,
                                'teacher_id' => $result[0]->user_id,
                                'role' => $result[0]->role,
                                'username' => $result[0]->name,
                                'date_format' => $setting_result[0]['date_format'],
                                'timezone' => $setting_result[0]['timezone'],
                                'sch_name' => $setting_result[0]['name'],
                                'currency_symbol' => $setting_result[0]['currency_symbol'],
                                'language' => array('lang_id' => $setting_result[0]['lang_id'], 'language' => $setting_result[0]['language']),
                                'is_rtl' => $setting_result[0]['is_rtl'],
                            );
                            $this->session->set_userdata( 'student', $session_data );
                            redirect( 'teacher/teacher/dashboard' );
                        } else if ( $result[0]->role == "accountant" ) {
                            $session_data = array(
                                'id' => $result[0]->id,
                                'accountant_id' => $result[0]->user_id,
                                'role' => $result[0]->role,
                                'username' => $result[0]->name,
                                'date_format' => $setting_result[0]['date_format'],
                                'timezone' => $setting_result[0]['timezone'],
                                'sch_name' => $setting_result[0]['name'],
                                'currency_symbol' => $setting_result[0]['currency_symbol'],
                                'language' => array('lang_id' => $setting_result[0]['lang_id'], 'language' => $setting_result[0]['language']),
                                'is_rtl' => $setting_result[0]['is_rtl'],
                            );

                            $this->session->set_userdata( 'student', $session_data );
                            redirect( 'accountant/accountant/dashboard' );
                        } else if ( $result[0]->role == "librarian" ) {

                            $session_data = array(
                                'id' => $result[0]->id,
                                'librarian_id' => $result[0]->user_id,
                                'role' => $result[0]->role,
                                'username' => $result[0]->name,
                                'date_format' => $setting_result[0]['date_format'],
                                'timezone' => $setting_result[0]['timezone'],
                                'sch_name' => $setting_result[0]['name'],
                                'currency_symbol' => $setting_result[0]['currency_symbol'],
                                'language' => array('lang_id' => $setting_result[0]['lang_id'], 'language' => $setting_result[0]['language']),
                                'is_rtl' => $setting_result[0]['is_rtl'],
                            );

                            $this->session->set_userdata( 'student', $session_data );
                            redirect( 'librarian/librarian/dashboard' );
                        }
                    } else {
                        $data = array(
                            'error_message' => 'Account Suspended'
                        );
                        $this->load->view( 'userlogin', $data );
                    }
                } else {
                    $data = array(
                        'error_message' => 'Your account is disabled please contact to administrator'
                    );
                    $this->load->view( 'userlogin', $data );
                }
            } else {
                
                $setting_result = $this->setting_model->get();
		
		
                $data['setting_result'] = $setting_result[0];
                $data ['error_message']='Invalid Username or Password';
                
                
                
                // $this->load->view( 'layout/new/header', $data );
                // $this->load->view( 'userlogin_new', $data );
                // $this->load->view( 'layout/new/footer', $data );
                
                 $this->load->view( 'userlogin1', $data );
            }
        }
    }

}

?>