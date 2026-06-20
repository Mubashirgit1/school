<?php

class Student extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function father_information( $father_phone = null )
    {
        $value = [
            'error' => true,
            'msg' => '',
            'data' => ''
        ];

        if ( $father_phone  === null ) {
            $value['error'] = true;
            $value['msg'] = "Required information was not submitted!";
            $value['data'] = '';
        } else {

            $father_details = $this->student_model->get(null, [
                'father_phone' => $father_phone 
            ], false,'phone');

            // if some record is found regarding father's cnic
            if(count($father_details) > 0){
                $value['error'] = false;
                $value['msg'] = "";
                $value['data'] = $father_details[0];
            } else {
                $value['error'] = true;
                $value['msg'] = "";
                $value['data'] = '';
            }

        }

        $this->output->set_content_type('json');
        $this->output->set_output(json_encode($value));
    }
}