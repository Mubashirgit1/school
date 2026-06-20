<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Schsettings extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('upload');
        $this->load->helper('file');
        $this->lang->load('message', 'english');
    }

    function index()
    {
        $this->session->set_userdata('top_menu', 'System Settings');
        $this->session->set_userdata('sub_menu', 'schsettings/index');
        $data['title']           = 'Setting List';
        $setting_result          = $this->setting_model->get();
        $data['settinglist']     = $setting_result;
        $data['date_formatlist'] = $this->customlib->getDateFormat();
        $data['getMonthList']    = $this->customlib->getMonthList();
        $this->load->view('layout/header', $data);
        $this->load->view('setting/settingList', $data);
        $this->load->view('layout/footer', $data);
    }

    function editLogo($id)
    {
        $data['title']       = 'School Logo';
        $setting_result      = $this->setting_model->get();
        $data['settinglist'] = $setting_result;
        $data['id']          = $id;
        $this->form_validation->set_rules('file', 'Image', 'callback_handle_upload');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('setting/editLogo', $data);
            $this->load->view('layout/footer', $data);
        } else {
            if (isset($_FILES["file"]) && !empty($_FILES['file']['name'])) {
                $fileInfo = pathinfo($_FILES["file"]["name"]);
                $name     = str_replace(' ', '-', strtolower($setting_result[0]['name']));
                $img_name = $name . '.' . $fileInfo['extension'];


                $name = base_url();
                $name = str_replace("https://", "", $name);
                $name = str_replace("http://", "", $name);
                $name = str_replace("/", "", $name);

                if (!file_exists("./uploads/" . $name)) {
                    mkdir("./uploads/" . $name, 0777, true);
                }

                if (!file_exists("./uploads/" . $name . "/school_content/")) {
                    mkdir("./uploads/" . $name . "/school_content/", 0777, true);
                }
                if (!file_exists("./uploads/" . $name . "/school_content/logo/")) {
                    mkdir("./uploads/" . $name . "/school_content/logo/", 0777, true);
                }

                move_uploaded_file($_FILES["file"]["tmp_name"], "./uploads/" . $name . "/school_content/logo/" . $img_name);
            }
            $data_record = array('id' => $id, 'image' => "./uploads/" . $name . "/school_content/logo/" . $img_name);
            $this->setting_model->add($data_record);
            $this->session->set_flashdata('msg', '<div class="alert alert-left">New Student added Successfully</div>');
            redirect('schsettings/index');
        }
    }

    function editLoginScreenImage($id)
    {

        $data['title']       = 'School Logo';
        $setting_result      = $this->setting_model->get();
        $data['settinglist'] = $setting_result;
        $data['id']          = $id;
        $this->form_validation->set_rules('file', 'Image', 'callback_handle_upload_login_screen');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('setting/editLogoScreenImage', $data);
            $this->load->view('layout/footer', $data);
        } else {

            if (isset($_FILES["file"]) && !empty($_FILES['file']['name'])) {
                $fileInfo = pathinfo($_FILES["file"]["name"]);
                $name     = str_replace(' ', '-', strtolower($setting_result[0]['name']));
                $img_name = $name . '.' . $fileInfo['extension'];


                $name = base_url();
                $name = str_replace("https://", "", $name);
                $name = str_replace("http://", "", $name);
                $name = str_replace("/", "", $name);

                if (!file_exists("./uploads/" . $name)) {
                    mkdir("./uploads/" . $name, 0777, true);
                }

                if (!file_exists("./uploads/" . $name . "/school_content/")) {
                    mkdir("./uploads/" . $name . "/school_content/", 0777, true);
                }
                if (!file_exists("./uploads/" . $name . "/school_content/splash/")) {
                    mkdir("./uploads/" . $name . "/school_content/splash/", 0777, true);
                }

                move_uploaded_file($_FILES["file"]["tmp_name"], "./uploads/" . $name . "/school_content/splash/" . $img_name);
            }
            $data_record = array('id' => $id, 'splash' => "./uploads/" . $name . "/school_content/splash/" . $img_name);
            $this->setting_model->add($data_record);
            $this->session->set_flashdata('msg', '<div class="alert alert-left">New Student added Successfully</div>');
            redirect('schsettings/index');
        }
    }

    function handle_upload()
    {
        if (isset($_FILES["file"]) && !empty($_FILES['file']['name'])) {
            $allowedExts = array('jpg', 'jpeg', 'png');
            $temp        = explode(".", $_FILES["file"]["name"]);
            $extension   = end($temp);
            if ($_FILES["file"]["error"] > 0) {
                $error .= "Error opening the file<br />";
            }
            if ($_FILES["file"]["type"] != 'image/gif' &&
                $_FILES["file"]["type"] != 'image/jpeg' &&
                $_FILES["file"]["type"] != 'image/png') {
                $this->form_validation->set_message('handle_upload', 'File type not allowed');
                return false;
            }
            if (!in_array($extension, $allowedExts)) {
                $this->form_validation->set_message('handle_upload', 'Extension not allowed');
                return false;
            }
            if ($_FILES["file"]["size"] > 102400) {
                $this->form_validation->set_message('handle_upload', 'File size shoud be less than 100 kB');
                return false;
            }
            return true;
        } else {
            $this->form_validation->set_message('handle_upload', 'Logo file is required');
            return false;
        }
    }
    function handle_upload_login_screen()
    {
        if (isset($_FILES["file"]) && !empty($_FILES['file']['name'])) {
            $allowedExts = array('jpg', 'jpeg', 'png');
            $temp        = explode(".", $_FILES["file"]["name"]);
            $extension   = end($temp);
            if ($_FILES["file"]["error"] > 0) {
                $error .= "Error opening the file<br />";
            }
            if ($_FILES["file"]["type"] != 'image/gif' &&
                $_FILES["file"]["type"] != 'image/jpeg' &&
                $_FILES["file"]["type"] != 'image/png') {
                $this->form_validation->set_message('handle_upload', 'File type not allowed');
                return false;
            }
            if (!in_array($extension, $allowedExts)) {
                $this->form_validation->set_message('handle_upload', 'Extension not allowed');
                return false;
            }
            if ($_FILES["file"]["size"] > 20480000) {
                $this->form_validation->set_message('handle_upload', 'File size should be less than 2 MB');
                return false;
            }
            return true;
        } else {
            $this->form_validation->set_message('handle_upload', 'Logo file is required');
            return false;
        }
    }

    function view($id)
    {
        $data['title']   = 'Setting List';
        $setting         = $this->setting_model->get($id);
        $data['setting'] = $setting;
        $this->load->view('layout/header', $data);
        $this->load->view('setting/settingShow', $data);
        $this->load->view('layout/footer', $data);
    }

    function edit($id)
    {
        $timezoneList  = $this->customlib->timezone_list();
        $data['title'] = 'School Setting';
        $data['id']    = $id;
        $setting       = $this->setting_model->get($id);

        $session_result         = $this->session_model->get();
        $language_result        = $this->language_model->get();
        $data['sessionlist']    = $session_result;
        $month_list             = $this->customlib->getMonthList();
        $data['languagelist']   = $language_result;
        $data['timezoneList']   = $timezoneList;
        $data['monthList']      = $month_list;
        $dateFormat             = $this->customlib->getDateFormat();
        $currency               = $this->customlib->getCurrency();
        $data['setting']        = $setting;
        $data['dateFormatList'] = $dateFormat;
        $data['currencyList']   = $currency;
        $this->form_validation->set_rules('session_id', 'Session', 'trim|required|xss_clean');
        $this->form_validation->set_rules('name', 'School Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('phone', 'Phone', 'trim|required|xss_clean');
        $this->form_validation->set_rules('start_month', 'Start Month', 'trim|required|xss_clean');
        $this->form_validation->set_rules('address', 'Address', 'trim|required|xss_clean');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean');
        $this->form_validation->set_rules('lang_id', 'Language', 'trim|required|xss_clean');
        $this->form_validation->set_rules('currency_symbol', 'Currency Symbol', 'trim|required|xss_clean');
        $this->form_validation->set_rules('timezone', 'timezone', 'trim|required|xss_clean');
        $this->form_validation->set_rules('currency', 'Currency', 'trim|required|xss_clean');
        $this->form_validation->set_rules('date_format', 'Date Format', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('setting/settingEdit', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $data = array(
                'id'              => $id,
                'session_id'      => $this->input->post('session_id'),
                'name'            => $this->input->post('name'),
                'phone'           => $this->input->post('phone'),
                'dise_code'       => $this->input->post('dise_code'),
                'start_month'     => $this->input->post('start_month'),
                'address'         => $this->input->post('address'),
                'email'           => $this->input->post('email'),
                'lang_id'         => $this->input->post('lang_id'),
                'timezone'        => $this->input->post('timezone'),
                'date_format'     => $this->input->post('date_format'),
                'is_rtl'          => $this->input->post('is_rtl'),
                'currency_symbol' => $this->input->post('currency_symbol'),
                'currency'        => $this->input->post('currency'),
                'username'        => $this->input->post('username'),
                'password'        => $this->input->post('password'),
                'message_type'    => $this->input->post('message_type'),
                'saturday'        => $this->input->post('saturday'),
                'admission_key'   => $this->input->post('admission_key'),
                'vr_fine'         => $this->input->post('vr_fine'),
                'staff_saturday'  => $this->input->post('staff_saturday'),

            );
            $this->setting_model->add($data);
            $this->load->helper('lang');
            $this->session->userdata['admin']['date_format']     = $this->input->post('date_format');
            $this->session->userdata['admin']['currency_symbol'] = $this->input->post('currency_symbol');
            $this->session->userdata['admin']['is_rtl']          = $this->input->post('is_rtl');
            $this->session->userdata['admin']['timezone']        = $this->input->post('timezone');
            set_language($this->input->post('lang_id'));
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Setting updated successfully</div>');
            redirect('Schsettings/edit/' . $id);
        }
    }

}

?>