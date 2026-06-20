<?php

class Option extends CI_Controller
{
    public function attendance_restriction_time()
    {
        $restrict_attendance_after = $this->custom_option_model->get( 'restrict_attendance_after' );

        $this->output->set_content_type( 'json' );
        $this->output->set_output( json_encode( $restrict_attendance_after ) );
    }
}