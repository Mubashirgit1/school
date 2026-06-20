<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('test_method'))
{
    function test_method()
    {
        return "hello";
    }
    function admin_permission($admin_id){

        $CI =& get_instance();
        $CI->db->from('admin');
        $CI->db->where('id', $admin_id);
        return $CI->db->get()->row();

    }

}