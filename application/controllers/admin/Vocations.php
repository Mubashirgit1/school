<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Vocations extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->lang->load('message', 'english');
         
    }

    public function index()
    {

        $this->session->set_userdata('top_menu', 'Vocations');
        $this->session->set_userdata('sub_menu', 'Vocations/index');
        $data['title']      = 'Upload Content';
        $data['title_list'] = 'Upload Content List';

        
        $list         = $this->vocation_model->get();
        $data['list'] = $list;
         
        $teacherlist = $this->teacher_model->get();

        $data['teacherlist'] = $teacherlist;
        
        $this->load->view('layout/header');
        $this->load->view('admin/vocation/createvocation', $data);
        $this->load->view('layout/footer');
    }

 


    function createvocation()
    {

        $this->form_validation->set_rules('vacation_title', 'Content Title', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('file', 'Image', 'callback_handle_upload');
        if ($this->form_validation->run() == FALSE) {

            $data['teacher_id'] = $this->session->userdata['student']['teacher_id'];
            $list               = $this->vocation_model->get(null, $data['teacher_id']);
            $data['list']       = $list;
            $teacherlist = $this->teacher_model->get();

            $data['teacherlist'] = $teacherlist;
            
         
            $this->load->view('layout/header');
            $this->load->view('admin/vocation/createvocation', $data);
            $this->load->view('layout/footer');
        } else {
            $visibility = "No";
            $classes    = $this->input->post('class_id');
            $section_id = $this->input->post('section_id');
            $subject_id = $this->input->post('subject_id');

            $vocation  = nl2br($this->input->post('vocation'));
            $vocation  = trim($vocation);
            $data      = array(
                'title'      => $this->input->post('vacation_title'),
                'vocations'  => $vocation,
                'class_id'   => $classes,
                'section_id' => $section_id,
                'subject_id' => $subject_id,
                'teacher_id' => $this->input->post('teacher_id'),
                'date'       => date('Y-m-d', strtotime(str_replace('/', '-', $this->input->post("upload_date")))),
                'file'       => $this->input->post('file'),
            );
            $insert_id = $this->vocation_model->add($data);
            if (isset($_FILES["file"]) && !empty($_FILES['file']['name'])) {
                $fileInfo       = pathinfo($_FILES["file"]["name"]);
                $img_name       = $_FILES['file']['name'];
                $img_name       = rand(1000, 9999) . "-" . str_replace(" ", "-", $img_name);

                $setting_result = $this->setting_model->get();
                // $name      = str_replace(' ', '-', strtolower($setting_result[0]['name']));

                $name = base_url();
                $name = str_replace("https://", "", $name);
                $name = str_replace("http://", "", $name);
                $name = str_replace("/", "", $name);
                $name = str_replace("www", "", $name);
                if (!file_exists("./uploads/" . $name)) {
                    mkdir("./uploads/" . $name, 0777, true);
                }

                if (!file_exists("./uploads/" . $name . "/vocation/")) {
                    mkdir("./uploads/" . $name . "/vocation/", 0777, true);
                }

                move_uploaded_file($_FILES["file"]["tmp_name"], "./uploads/" . $name . "/vocation/" . $img_name);
                $data_img = array('id' => $insert_id, 'file' => 'uploads/' . $name . '/vocation/' . $img_name);
                $this->vocation_model->add($data_img);
            }
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Content added successfully</div>');
            redirect('admin/vocations');
        }
    }

    function handle_upload()
    {
        if (isset($_FILES["file"]) && !empty($_FILES['file']['name'])) {
            $allowedExts = array('jpg', 'jpeg', 'png', "pdf", "doc", "docx");
            $temp        = explode(".", $_FILES["file"]["name"]);
            $extension   = end($temp);
            if ($_FILES["file"]["error"] > 0) {
                $error .= "Error opening the file<br />";
            }
            if (($_FILES["file"]["type"] != "application/pdf") && ($_FILES["file"]["type"] != "image/gif") && ($_FILES["file"]["type"] != "image/jpeg") && ($_FILES["file"]["type"] != "image/jpg") && ($_FILES["file"]["type"] != "application/vnd.openxmlformats-officedocument.wordprocessingml.document") && ($_FILES["file"]["type"] != "application/vnd.openxmlformats-officedocument.wordprocessingml.document") && ($_FILES["file"]["type"] != "image/pjpeg") && ($_FILES["file"]["type"] != "image/x-png") && ($_FILES["file"]["type"] != "image/png")) {
                $this->form_validation->set_message('handle_upload', 'File type not allowed');
                return false;
            }
            if (!in_array($extension, $allowedExts)) {
                $this->form_validation->set_message('handle_upload', 'Extension not allowed');
                return false;
            }
            return true;
        } else {
            $this->form_validation->set_message('handle_upload', 'The File field is required.');
            return false;
        }
    }

    public function download($file)
    {
        $this->load->helper('download');
        $filepath = "./uploads/school_content/material/" . $this->uri->segment(7);
        $data     = file_get_contents($filepath);
        $name     = $this->uri->segment(7);
        force_download($name, $data);
    }

    function edit($id)
    {
        $data['title']      = 'Add Content';
        $data['id']         = $id;
        $editpost           = $this->vocation_model->get($id);
        $data['editpost']   = $editpost;
        $teacherlist = $this->teacher_model->get();

        $data['teacherlist'] = $teacherlist;
        $this->form_validation->set_rules('vacation_title', 'Content Title', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $data['teacher_id'] = $this->session->userdata['student']['teacher_id'];
            $list               = $this->vocation_model->get(null, $data['teacher_id']);
            $data['list']       = $list;
            $this->load->view('layout/header');
            $this->load->view('admin/vocation/editpost', $data);
            $this->load->view('layout/footer');
        } else {
            $id        = $this->input->post('id');
            $data      = array(
                'id'         => $id,
                'title'      => $this->input->post('content_title'),
                'class_id'   => $this->input->post('class_id'),
                'section_id' => $this->input->post('section_id'),
                'subject_id' => $this->input->post('subject_id'),
                'teacher_id' => $this->input->post('teacher_id'),
                'vocations'  => $this->input->post('vocation'),
                'date'       => date('Y-m-d', strtotime(str_replace('/', '-', $this->input->post("upload_date")))),
            );
            $insert_id = $this->vocation_model->add($data);
            if (isset($_FILES["file"]) && !empty($_FILES['file']['name'])) {
                $fileInfo       = pathinfo($_FILES["file"]["name"]);
                $img_name       = $_FILES['file']['name'];
                $img_name       = rand(1000, 9999) . "-" . str_replace(" ", "-", $img_name);

                $setting_result = $this->setting_model->get();
                // $name      = str_replace(' ', '-', strtolower($setting_result[0]['name']));

                $name = base_url();
                $name = str_replace("https://", "", $name);
                $name = str_replace("http://", "", $name);
                $name = str_replace("/", "", $name);
                $name = str_replace("www", "", $name);
                if (!file_exists("./uploads/" . $name)) {
                    mkdir("./uploads/" . $name, 0777, true);
                }
                if (!file_exists("./uploads/" . $name . "/vocation/")) {
                    mkdir("./uploads/" . $name . "/vocation/", 0777, true);
                }
                move_uploaded_file($_FILES["file"]["tmp_name"], "./uploads/" . $name . "/vocation/" . $img_name);
                $data_img = array('id' => $insert_id, 'file' => 'uploads/' . $name . '/vocation/' . $img_name);
                $this->vocation_model->add($data_img);
            }
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Content details added to Database!!!</div>');
            redirect('admin/vocations/index');
        }
    }

    function search()
    {
        $text                = $_GET['content'];
        $data['title']       = 'Fees Master List';
        $contentlist         = $this->content_model->search_by_content_type($text);
        $data['contentlist'] = $contentlist;
        $this->load->view('layout/teacher/header');
        $this->load->view('teacher/content/search', $data);
        $this->load->view('layout/teacher/footer');
    }

    function delete($id)
    {
        $data['title'] = 'Fees Master List';
        $data          = $this->vocation_model->get($id);
        $file          = $data['file'];
        unlink($file);
        $this->vocation_model->remove($id);
        redirect('teacher/vocations');
    }

    function deleteassignment($id)
    {
        $this->content_model->remove($id);
        $data['title_list'] = 'Assignment List';
        $list               = $this->content_model->getListByCategory("Assignments");
        $data['list']       = $list;
        $this->load->view('layout/teacher/header');
        $this->load->view('teacher/content/assignment', $data);
        $this->load->view('layout/teacher/footer');
    }

    public function assignment()
    {
        $this->session->set_userdata('top_menu', 'Download Center');
        $this->session->set_userdata('sub_menu', 'content/assignment');
        $data['title_list'] = 'Assignment List';
        $list               = $this->content_model->getListByCategory("Assignments");
        $data['list']       = $list;
        $this->load->view('layout/teacher/header');
        $this->load->view('teacher/content/assignment', $data);
        $this->load->view('layout/teacher/footer');
    }

    public function studymaterial()
    {
        $this->session->set_userdata('top_menu', 'Download Center');
        $this->session->set_userdata('sub_menu', 'content/studymaterial');
        $data['title_list'] = 'Study Material List';
        $list               = $this->content_model->getListByCategory("Study Material");
        $data['list']       = $list;
        $this->load->view('layout/teacher/header');
        $this->load->view('teacher/content/studymaterial', $data);
        $this->load->view('layout/teacher/footer');
    }

    public function syllabus()
    {
        $this->session->set_userdata('top_menu', 'Download Center');
        $this->session->set_userdata('sub_menu', 'content/syllabus');
        $data['title_list'] = 'Syllabus List';
        $list               = $this->content_model->getListByCategory("Syllabus");
        $data['list']       = $list;
        $this->load->view('layout/teacher/header');
        $this->load->view('teacher/content/syllabus', $data);
        $this->load->view('layout/teacher/footer');
    }

    public function other()
    {
        $this->session->set_userdata('top_menu', 'Download Center');
        $this->session->set_userdata('sub_menu', 'content/other');
        $data['title_list'] = 'Other Download List';
        $list               = $this->content_model->getListByCategory("Other Download");
        $data['list']       = $list;
        $this->load->view('layout/teacher/header');
        $this->load->view('teacher/content/other', $data);
        $this->load->view('layout/teacher/footer');
    }

}

?>