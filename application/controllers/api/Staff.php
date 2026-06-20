<?php

class Staff extends CI_Controller
{
    public function get()
    {
        $staff_id = $this->input->post_get( 'staff_id' );
		
		
        $staff = $this->staff_model->get( $staff_id );

        if ( empty( $staff ) ) {
            $staff = [
                'empty' => true,
                'msg' => "No staff found!"
            ];
        }

        $this->output->set_content_type( 'json' );
		
        $this->output->set_output( json_encode( $staff ) );
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

            $staff_id = $file_data['raw_name'];
            $staff_id = intval( substr( $staff_id, strrpos( $staff_id, '_' ) + 1 ) );

            $rtn['error'] = false;
            $rtn['data'] = $file;
            $rtn['msg'] = "File uploaded Successfully!";

            $this->db->update( 'staff', [
                'fingerprint_file' => $file
            ], ['id' => $staff_id] );
        }

        $this->output->set_content_type( 'json' );
        $this->output->set_output( json_encode( $rtn ) );
    }

    public function mark_attendance()
    {
        $rtn = [
            'error' => true,
            'msg' => ''
        ];

        $this->form_validation->set_rules( 'staff_id', 'Staff ID', 'trim|required|numeric' );
        $this->form_validation->set_rules( 'attendance', 'Attendance', 'trim|required|strtolower|in_list[present,absent]' );
        $this->form_validation->set_rules( 'attendance_date_time', 'Date and time for Attendance', 'trim' );

        if ( $this->form_validation->run() === false ) {
            $rtn['error'] = true;
            $rtn['msg'] = $this->form_validation->error_string( '', '' );
        } else {

            $staff_id = $this->input->post( 'staff_id' );
            $attendance = $this->input->post( 'attendance' );

            $attendance_date_time = $this->input->post( 'attendance_date_time' );
            $attendance_date_time = new DateTime( date( 'Y-m-d H:i:s', ( $attendance_date_time !== null ? strtotime( $attendance_date_time ) : now() ) ) );

            $attendance_search = $this->staff_attendance_model->get( null, $staff_id, $attendance_date_time->format( 'Y-m-d' ) );

            if ( $attendance_search !== false ) {
                $rtn['error'] = true;
                $rtn['msg'] = "Attendance has already been marked";
            } else {
                $this->staff_attendance_model->add( $staff_id, $attendance, $attendance_date_time->format( 'Y-m-d' ), $attendance_date_time->format( 'H:i:s' ) );

                $rtn['error'] = false;
                $rtn['msg'] = "Attendance marked successfully!";
            }

        }

        $this->output->set_content_type( 'json' );
        $this->output->set_output( json_encode( $rtn ) );

    }
}