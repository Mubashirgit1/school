<?php

class Authenticate extends CI_Controller
{
    public function auth()
    {
        $username = $this->input->post_get( 'username' );
        $password = $this->input->post_get( 'password' );

        $login_check = $this->admin_model->checkLogin( [
            'username' => $username,
            'password' => $password
        ] );

        $rtn = [
            'login' => true,
            'msg' => "Credentials matched"
        ];

        if ( $login_check === false ) {
            $rtn['login'] = false;
            $rtn['msg'] = "Credentials didn't match.";
        }

        $this->output->set_content_type( 'json' );
        $this->output->set_output( json_encode( $rtn ) );
    }
}