<?php

class Student_assessment extends Admin_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library( 'smsgateway' );
        $this->load->helper( 'file' );
        $this->lang->load( 'message', 'english' );
    }

    public function add( $student_id = null )
    {

        $this->session->set_userdata( 'top_menu', 'Student Information' );
        $this->session->set_userdata( 'sub_menu', 'student/search' );

        if ( $student_id === null ) {
            show_404();
        } else {

            $student_details = $this->student_model->get( $student_id );

            if ( $student_details === null ) {
                show_error( "Maybe you are being redirect to wrong page.", 404, "Student not found!" );
            } else {
                // get start and end date
                $start_end_date = $this->general_library->week_start_end_date( date( 'Y-m-d', now() ) );

                // search between start and end date
                $assessment_details = $this->student_assessment_model->get( null, $start_end_date['start'], $start_end_date['end'] );

                $data = compact( 'student_id', 'student_details', 'assessment_details' );

                $this->load->view( 'layout/header', $data );
                $this->load->view( 'student_assessment/add', $data );
                $this->load->view( 'layout/footer', $data );

            }

        }
    }

    public function add_process( $student_id = null )
    {

        $this->session->set_userdata( 'top_menu', 'Student Information' );
        $this->session->set_userdata( 'sub_menu', 'student/search' );

        if ( $student_id === null ) {
            show_404();
        } else {

            $student_details = $this->student_model->get( $student_id );

            if ( $student_details === null ) {
                show_error( "Maybe you are being redirect to wrong page.", 404, "Student not found!" );
            } else {

                $this->form_validation->set_rules( 'assessment_date', 'Assessment Date', 'trim|required' );
                $this->form_validation->set_rules( 'cleanliness', 'Cleanliness', 'trim|integer|intval|required' );
                $this->form_validation->set_rules( 'classroom_behaviour', 'Classroom Behaviour', 'trim|integer|intval|required' );
                $this->form_validation->set_rules( 'homework', 'Homework', 'trim|integer|intval|required' );
                $this->form_validation->set_rules( 'urdu_reading', 'Urdu Reading', 'trim|integer|intval|required' );
                $this->form_validation->set_rules( 'english_reading', 'English Reading', 'trim|integer|intval|required' );

                if ( $this->form_validation->run() == false ) {
                    $this->add();
                } else {

                    $assessment_date = $this->input->post( 'assessment_date' );
                    $assessment_date = ( $assessment_date === null ? date( 'Y-m-d', now() ) : date( 'Y-m-d', strtotime( $assessment_date ) ) );
                    $cleanliness = $this->input->post( 'cleanliness' );
                    $classroom_behaviour = $this->input->post( 'classroom_behaviour' );
                    $homework = $this->input->post( 'homework' );
                    $urdu_reading = $this->input->post( 'urdu_reading' );
                    $english_reading = $this->input->post( 'english_reading' );

                    // get start and end date
                    $start_end_date = $this->general_library->week_start_end_date( $assessment_date );

                    // search between start and end date
                    $assessment_exists = $this->student_assessment_model->get( null, $start_end_date['start'], $start_end_date['end'] );

                    // if assessment exists
                    if ( $assessment_exists !== false ) {
                        $this->db->update( $this->student_assessment_model->table_name, [
                            'cleanliness' => $cleanliness,
                            'classroom_behaviour' => $classroom_behaviour,
                            'homework' => $homework,
                            'urdu_reading' => $urdu_reading,
                            'english_reading' => $english_reading,
                            'assessment_date' => $assessment_date
                        ], [
                            'id' => $assessment_exists[0]['id']
                        ] );

                        $this->session->set_flashdata( 'msg', "Student assessment has been updated" );
                    } else {
                        $this->db->insert( $this->student_assessment_model->table_name, [
                            'cleanliness' => $cleanliness,
                            'classroom_behaviour' => $classroom_behaviour,
                            'homework' => $homework,
                            'urdu_reading' => $urdu_reading,
                            'english_reading' => $english_reading,
                            'assessment_date' => $assessment_date
                        ] );

                        $this->session->set_flashdata( 'msg', "Student assessment has been saved" );
                    }

                    redirect( 'student_assessment/add/' . $student_id );

                }

            }

        }

    }
}