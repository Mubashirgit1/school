<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
if (!function_exists('active_link')) {
	
    function activate_menu($controller, $action) {
        $CI = get_instance();
        $method = $CI->router->fetch_method();
        $class = $CI->router->fetch_class();
        return ($method == $action && $controller == $class) ? 'active' : '';
    }

    function set_Topmenu($top_menu_name) {
        $CI = get_instance();
        $session_top_menu = $CI->session->userdata('top_menu');
        if ($session_top_menu == $top_menu_name) {
            return 'active';
        }
        return "";
    }

    function set_Submenu($sub_menu_name) {
        $CI = get_instance();
        $session_sub_menu = $CI->session->userdata('sub_menu');
        if ($session_sub_menu == $sub_menu_name) {
            return 'active';
        }
        return "";
    }
}

function date_sort($a, $b) {
    return strtotime($a) - strtotime($b);
}
function pp($print){
    echo "<pre>";
    print_r($print);
    echo "<pre>";
    exit;

}
function ppp($print){
    echo "<pre>";
    print_r($print);
    echo "<pre>";
   
}
function update_config_installed() {
    $CI = & get_instance();
    $config_path = APPPATH . 'config/config.php';
    $CI->load->helper('file');
    @chmod($config_path, FILE_WRITE_MODE);
    $config_file = read_file($config_path);
    $config_file = trim($config_file);
    $config_file = str_replace("\$config['installed'] = false;", "\$config['installed'] = true;", $config_file);
    $config_file = str_replace("\$config['base_url'] = '';", "\$config['base_url'] = '" . site_url() . "';", $config_file);
    if (!$fp = fopen($config_path, FOPEN_WRITE_CREATE_DESTRUCTIVE)) {
        return FALSE;
    }
    flock($fp, LOCK_EX);
    fwrite($fp, $config_file, strlen($config_file));
    flock($fp, LOCK_UN);
    fclose($fp);
    @chmod($config_path, FILE_READ_MODE);
    return TRUE;
}

function update_autoload_installed() {
    $CI = & get_instance();
    $autoload_path = APPPATH . 'config/autoload.php';
    $CI->load->helper('file');
    @chmod($autoload_path, FILE_WRITE_MODE);
    $autoload_file = read_file($autoload_path);
    $autoload_file = trim($autoload_file);
    $autoload_file = str_replace("\$autoload['model'] = array()", "\$autoload['model'] = array('session_model', 'class_model', 'section_model', 'setting_model', 'classsection_model', 'category_model', 'student_model', 'feemaster_model', 'feecategory_model', 'feetype_model', 'studentfee_model', 'stuattendence_model', 'attendencetype_model', 'studentsession_model', 'language_model', 'admin_model', 'smsconfig_model', 'langpharses_model', 'subject_model', 'teacher_model', 'teachersubject_model', 'exam_model', 'mark_model', 'examschedule_model', 'examresult_model', 'expense_model', 'expensehead_model', 'studenttransportfee_model', 'book_model', 'grade_model', 'timetable_model', 'hostel_model', 'route_model', 'content_model', 'user_model', 'notification_model', 'paymentsetting_model', 'roomtype_model', 'hostelroom_model', 'vehicle_model', 'vehroute_model', 'librarian_model', 'accountant_model', 'librarymanagement_model', 'librarymember_model', 'bookissue_model', 'parent_model', 'feegroup_model', 'feegrouptype_model', 'feesessiongroup_model', 'studentfeemaster_model', 'feediscount_model', 'emailconfig_model')", $autoload_file);
    if (!$fp = fopen($autoload_path, FOPEN_WRITE_CREATE_DESTRUCTIVE)) {
        return FALSE;
    }
    flock($fp, LOCK_EX);
    fwrite($fp, $autoload_file, strlen($autoload_file));
    flock($fp, LOCK_UN);
    fclose($fp);
    @chmod($config_path, FILE_READ_MODE);
    return TRUE;
}

function delete_dir($dirPath) {
    if (!is_dir($dirPath)) {
        throw new InvalidArgumentException("$dirPath must be a directory");
    }
    if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
        $dirPath .= '/';
    }
    $files = glob($dirPath . '*', GLOB_MARK);
    foreach ($files as $file) {
        if (is_dir($file)) {
            delete_dir($file);
        } else {
            unlink($file);
        }
    }
    if (rmdir($dirPath)) {
        return true;
    }
    return false;
}

function admin_url($url = '') {
    if ($url == '') {
        return site_url() . 'site/login';
    } else {
        return site_url() . 'site/login';
    }
}

function admin_permission($admin_id){

        $CI =& get_instance();
        
        $CI->db->from('admin_permissions');
        $CI->db->where('admin_id', $admin_id);
        return $CI->db->get()->row();
}

function admission_text(){

    $CI =& get_instance();
    $CI->db->from('custom_options');
    $CI->db->where( 'name', 'text_admission' );
    $text_admission = $CI->db->get()->row_array();
    $text  =  empty($text_admission['value']) ? 'Admission No' :  $text_admission['value']; 
    return $text;   
}

function classes($class_id = null){
    $CI =& get_instance();
        $CI->db->select('class'); 
        $CI->db->from('classes');
        $CI->db->where('id', $class_id);    
        return $CI->db->get()->row()->class;
}

function sections($section_id = null){
    $CI =& get_instance();
        $CI->db->select('section'); 
        $CI->db->from('sections');
        $CI->db->where('id', $section_id);    
        return $CI->db->get()->row()->section;
}


function getSundays($y,$start_month){
    $counting = 0;
    $counting_next = 0;
    for($j=$start_month; $j<13; $j++ ){
        $date = "$y-$j-01";
        $first_day = date('N',strtotime($date));
        $first_day = 7 - $first_day + 1;
        $last_day =  date('t',strtotime($date));
        $days = array();
        $count = 0;
        for($i=$first_day; $i<=$last_day; $i=$i+7 ){
            $count++;
        }   
        $counting = $counting +  $count;
    }
    for($j=1; $j<$start_month; $j++ ){
        $date = "$y-$j-01";
        $first_day = date('N',strtotime($date));
        $first_day = 7 - $first_day + 1;
        $last_day =  date('t',strtotime($date));
        $days = array();
        $count_next = 0;
        for($i=$first_day; $i<=$last_day; $i=$i+7 ){
            $count_next++;
        }   
        $counting_next = $counting_next +  $count_next;
    }
    return  $counting + $counting_next;
}



function _error($message){
    return_responce(array('responce_type'=>'error', 'data'=>$message));
}

function _success($message){
    return_responce(array('responce_type'=>'success', 'data'=>$message));
}

?>