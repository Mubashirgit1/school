<?php

class Teacher extends CI_Controller
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
        $obj = json_decode($postdata);

        foreach( $obj as $post ){
            
            $teacher_id = $post( 'teacher_id' );
            /* this should be dynamic attendance type id */
            $type = $this->attendencetype_model->get(null,'present');

            $attendance_date_time = $post( 'attendance_date' );
            $attendance_date_time = ( $attendance_date_time !== null ? date( "Y-m-d H:i:s", strtotime( $attendance_date_time ) ) : date( 'Y-m-d H:i:s', now() ) );
            $attendance_date = date( 'Y-m-d', strtotime( $attendance_date_time ) );
            $attendance_time = date( "H:i:s", strtotime( $attendance_date_time ) );

            $search = $this->teacher_attendance_model->search_attendance( $teacher_id, $attendance_date );

            // if attendance found
            if ( $search !== false ) {
                
                $exit_time	= date('h:i:s');
		        $date	= date('Y-m-d');
		 
                $this->db->update( 'teacher_attendance', [
                    'exit_time' => $exit_time
                ], [
				    'attendance_date' => $date,
                    'teacher_id' => $teacher_id,
					
                ] );
                
            } else {
                // attendance not found
                $this->teacher_attendance_model->insert( [
                    'teacher_id' => $teacher_id,
                    'teacher_attendence_type_id' => $type['id'],
                    'attendance_date' => $attendance_date,
                    'attendance_time' => $attendance_time
                ] );

                $arr['error'] = false;
                $arr['msg'] = "Attendance marked successfully!";
            }
        }
         
        $this->output->set_content_type( 'json' );
        $this->output->set_output( json_encode( $arr ) );
    }
}