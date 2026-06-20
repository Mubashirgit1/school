<?php

if ( !defined( 'BASEPATH' ) )
    exit( 'No direct script access allowed' );

class Stdtransfer extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper( 'file' );
        $this->lang->load( 'message', 'english' );
    }

    function index()
    {
//        $class_post_details = $this->class_model->get( 15 );
//        $promoted_class_details = $this->class_model->get( 18 );
//
//        $student_details = $this->student_model->get( 666 );
//
//        echo "<pre>";
//        print_r($student_details['fee_arrears'] );
//        echo "</pre>";
//        echo "<pre>";
//        print_r($promoted_class_details );
//        echo "</pre>";
//        exit;

        $this->session->set_userdata( 'top_menu', 'Student Information' );
        $this->session->set_userdata( 'sub_menu', 'stdtransfer/index' );
        $data['title'] = 'Exam Schedule';
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        $feecategory = $this->feecategory_model->get();
        $data['feecategorylist'] = $feecategory;
        $this->form_validation->set_rules( 'class_id', 'Class', 'trim|required|xss_clean' );
        $this->form_validation->set_rules( 'section_id', 'Section', 'trim|required|xss_clean' );
        if ( $this->form_validation->run() == FALSE ) {
            $this->load->view( 'layout/header', $data );
            $this->load->view( 'admin/stdtransfer/stdtransfer', $data );
            $this->load->view( 'layout/footer', $data );
        } else {
            $class = $this->input->post( 'class_id' );
            $section = $this->input->post( 'section_id' );
            $session_result = $this->session_model->get();
            $data['sessionlist'] = $session_result;
            $data['class_post'] = $class;
            $data['section_post'] = $section;
            $resultlist = $this->student_model->searchByClassSection( $class, $section );
            $data['resultlist'] = $resultlist;
            $this->load->view( 'layout/header', $data );
            $this->load->view( 'admin/stdtransfer/stdtransfer', $data );
            $this->load->view( 'layout/footer', $data );
        }
    }

    public function promote()
    {
        $this->form_validation->set_error_delimiters( '', '' );
        $this->form_validation->set_rules( 'session_id', 'session_id', 'required|trim|xss_clean' );
        $this->form_validation->set_rules( 'class_promote_id', 'class_promote_id', 'required|trim|xss_clean' );
        $this->form_validation->set_rules( 'section_promote_id', 'section_promote_id', 'required|trim|xss_clean' );

        if ( $this->form_validation->run() == false ) {
            $errors = array(
                'session_id' => form_error( 'session_id' ),
                'class_promote_id' => form_error( 'class_promote_id' ),
                'section_promote_id' => form_error( 'section_promote_id' )
            );
            echo json_encode( array('status' => 'fail', 'msg' => $errors) );
        } else {
            $student_list = $this->input->post( 'student_list' );
            $promoted_student_number = 0;
            $demoted_student_number = 0;

            foreach ( $student_list as $key => $value ) {
                $student_id = $value;
                $result = $this->input->post( 'result_' . $value );
                $session_status = $this->input->post( 'next_working_' . $value );

                $student_details = $this->student_model->get( $student_id );

                if ( $result == "pass" && $session_status == "countinue" ) {
                    $promoted_student_number++;

                    $promoted_class = $this->input->post( 'class_promote_id' );
                    $promoted_section = $this->input->post( 'section_promote_id' );
                    $promoted_session = $this->input->post( 'session_id' );
                    $data_new = array(
                        'student_id' => $student_id,
                        'class_id' => $promoted_class,
                        'section_id' => $promoted_section,
                        'session_id' => $promoted_session,
                        'transport_fees' => 0,
                        'fees_discount' => 0
                    );
                    $student_session_id = $this->student_model->add_student_session( $data_new );

                    $promoted_class_details = $this->class_model->get( $promoted_class );

                    $class_fee_differ = $promoted_class_details['fee'] - $student_details['fee'];

                    $final_arrears = $student_details['fee_arrears'] + $class_fee_differ;
                    $data = array(
                        'fee_arrears' => $final_arrears,
                    );

                    $update = $this->student_model->updateDues( $student_details['id'], $data );

                    $free_student = ( intval( $promoted_class_details['fee'] ) - intval( $student_details['discount'] ) <= 0 ? 1 : 0 );

                    // add promoted student details to the student_logs table
                    $this->student_log_model->add( $student_session_id, null, 0, 1, 0, $free_student );


                } elseif ( $result == "fail" && $session_status == "countinue" ) {
                    $demoted_student_number++;

                    $promoted_session = $this->input->post( 'session_id' );
                    $class_post = $this->input->post( 'class_post' );
                    $promoted_section = $this->input->post( 'section_promote_id' );
                    $section_post = $this->input->post( 'section_post' );
                    $data_new = array(
                        'student_id' => $student_id,
                        'class_id' => $class_post,
                        'section_id' => $section_post,
                        'session_id' => $promoted_session,
                        'transport_fees' => 0,
                        'fees_discount' => 0,
                    );
                    $student_session_id = $this->student_model->add_student_session( $data_new );

                    $class_post_details = $this->class_model->get( $class_post );

                    $free_student = ( intval( $class_post_details['fee'] ) - intval( $student_details['discount'] ) <= 0 ? 1 : 0 );


                    // add demoted student to the student_log table
                    $this->student_log_model->add( $student_session_id, null, 0, 0, 1, $free_student );
                }
            }
            echo json_encode( array('status' => 'success', 'msg' => "") );

        }
    }

}

?>