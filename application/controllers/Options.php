<?php

class Options extends Admin_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library( 'upload' );
        $this->load->helper( 'file' );
        $this->lang->load( 'message', 'english' );
    }

    public function index()
    {
        $this->session->set_userdata( 'top_menu', 'System Settings' );
        $this->session->set_userdata( 'sub_menu', 'options/index' );

        $title = "Options";
        
        $teachers_max_leaves_in_month = $this->custom_option_model->get( 'teachers_max_leaves_in_month' );
        $teachers_salary_deduction_per_leave = $this->custom_option_model->get( 'teachers_salary_deduction_per_leave' );
        $last_date_for_receiving_fee = $this->custom_option_model->get( 'last_date_for_receiving_fee' );
        $expiry_date_for_receiving_fee = $this->custom_option_model->get( 'expiry_date_for_receiving_fee' );
        $fine_per_day_for_fee = $this->custom_option_model->get( 'fine_per_day_for_fee' );
        $restrict_attendance_after = $this->custom_option_model->get( 'restrict_attendance_after' );
        $restrict_attendance_after_staff = $this->custom_option_model->get( 'restrict_attendance_after_staff' );
        $admin_phone = $this->custom_option_model->get( 'admin_phone' );
        $student_fee_fine_type = $this->custom_option_model->get( 'student_fee_fine_type' );
        $bank_account = $this->custom_option_model->get( 'bank_account' );
        $bank_name = $this->custom_option_model->get( 'bank_name' );
        $bank_account_top = $this->custom_option_model->get( 'bank_account_top' );
        $sibling_type = $this->custom_option_model->get( 'sibling_type' );
        $text_admission = $this->custom_option_model->get( 'text_admission' );
        $eobi = $this->custom_option_model->get( 'eobi' );
        $bank_account_other = $this->custom_option_model->get( 'bank_account_other' );
        $reprint_fee = $this->custom_option_model->get( 'reprint_fee' );
       
        $data = compact(
            'title',
            'teachers_max_leaves_in_month',
            'teachers_salary_deduction_per_leave',
            'last_date_for_receiving_fee',
            'expiry_date_for_receiving_fee',
            'fine_per_day_for_fee',
			'restrict_attendance_after_staff',
            'restrict_attendance_after',
            'admin_phone',
            'bank_name',
            'bank_account_top',
            'student_fee_fine_type',
            'bank_account',
            'eobi',
            'bank_account_other',
            'sibling_type',
            'text_admission',
            'reprint_fee'
        );

        $this->load->view( 'layout/header', $data );
        $this->load->view( 'options/index', $data );
        $this->load->view( 'layout/footer', $data );
    }

    public function index_process()
    {
        $this->session->set_userdata( 'top_menu', 'System Settings' );
        $this->session->set_userdata( 'sub_menu', 'options/index' );

        foreach ( $this->input->post() as $key => $value ) {
             $this->custom_option_model->add( $key, $value );
        }
        $this->session->set_flashdata( 'msg', "Saved!" );
        redirect( 'options/index' );
    }
}