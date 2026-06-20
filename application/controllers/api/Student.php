<?php

class Student extends CI_Controller
{
    public function get()
    {
        $teacher_id = $this->input->post_get( 'teacher_id' );
        $teacher = $this->teacher_model->get( $teacher_id );

        if ( empty( $teacher ) ) {
            $teacher = [
                'empty' => true,
                'msg' => "No teacher found!"
            ];
        }

        $this->output->set_content_type( 'json' );
        $this->output->set_output( json_encode( $teacher ) );
    }

    public function set_finger_print()
    {
        $rtn = [
            'error' => false,
            'msg' => "",
            'data' => [],
            'site' => base_url()
        ];

        $this->load->library( 'upload' );
        $config['upload_path'] = './uploads/fingerprint/';
        $config['allowed_types'] = '*';
        $config['encrypt_name'] = false;
        $config['overwrite'] = true;
        $this->upload->initialize( $config );

        if ( !$this->upload->do_upload( 'fingerprint' ) ) {
            $rtn['error'] = true;
            $rtn['msg'] = $this->upload->display_errors( '', '' );
        } else {
            $file_data = $this->upload->data();
            $file = "uploads/fingerprint/" . $file_data['file_name'];

            $teacher_id = $file_data['raw_name'];
            $teacher_id = intval( substr( $teacher_id, strrpos( $teacher_id, '_' ) + 1 ) );

            $rtn['error'] = false;
            $rtn['data'] = $file;
            $rtn['msg'] = "File uploaded Successfully!";

            $this->db->update( 'teachers', [
                'fingerprint_file' => $file
            ], ['id' => $teacher_id] );
        }

        $this->output->set_content_type( 'json' );
        $this->output->set_output( json_encode( $rtn ) );
    }

    public function attendance_types()
    {
        $attendance_types = $this->teacher_attendence_type_model->get();

        $this->output->set_content_type( 'json' );
        $this->output->set_output( json_encode( $attendance_types ) );
    }

    public function mark_attendance()
    {
        $arr = [
            'error' => true,
            'msg' => ''
        ];
        $postdata = file_get_contents("php://input"); 

        //$postdata = '{"mail": "mistermuhittin@gmail.com", "number": 6969 }';
        $session_ary = json_decode($postdata);  
                
            foreach ( $session_ary as $key => $value ) {
                $att_date =  date( 'Y-m-d', $this->customlib->datetostrtotime( $date ) );
                $check_student_leave = $this->stuattendence_model->search_attendance($value['student_id'],  $att_date );
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
         
        $this->output->set_content_type( 'json' );
        $this->output->set_output( json_encode( $arr ) );
    }
}