<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Content extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->lang->load('message', 'english');
        $this->load->library('Customlib');
    }

    public function index() {
        $this->session->set_userdata('top_menu', 'Download Center');
        $this->session->set_userdata('sub_menu', 'content/index');
        $data['title'] = 'Upload Content';
        $data['title_list'] = 'Upload Content List';
        $list = $this->content_model->get();
        $data['list'] = $list;
        $ght = $this->customlib->getcontenttype();
        $data['ght'] = $ght;
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        $this->load->view('layout/header');
        $this->load->view('admin/content/createcontent', $data);
        $this->load->view('layout/footer');
    }
    
    public function sylabus() {
        $this->session->set_userdata('top_menu', 'Download Center');
        $this->session->set_userdata('sub_menu', 'content/index');
        $data['title'] = 'Upload Content';
        $data['title_list'] = 'Upload Content List';
        $list               = $this->syllabus_model->get();
        $data['list'] = $list;
        $teacherlist = $this->teacher_model->get();

        $data['teacherlist'] = $teacherlist;
        $ght = $this->customlib->getcontenttype();
        $data['ght'] = $ght;
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        $this->load->view('layout/header');
        $this->load->view('admin/syllabus/syllabus', $data);
        $this->load->view('layout/footer');
    }
    function syllabusedit($id)
    {
        $data['title']      = 'Add Content';
        $data['id']         = $id;
        $editpost           = $this->syllabus_model->get($id);
        $data['editpost']   = $editpost;
        $data['teacher_id'] = $this->session->userdata['student']['teacher_id'];
        $class_sections     = $this->class_model->get_teacher_class($data['teacher_id']);
        $data['classlist']  = $class_sections;
        $list = $this->teacher_model->get();

        $data['teacherlist'] = $list;
        $this->form_validation->set_rules('content_title', 'Content Title', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $data['teacher_id'] = $this->session->userdata['student']['teacher_id'];
            $list               = $this->syllabus_model->get();
            $data['list']       = $list;
            $list = $this->teacher_model->get();

            $data['teacherlist'] = $list;
            $this->load->view('layout/header');
            $this->load->view('admin/syllabus/editpost', $data);
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
                'syllabus'   => $this->input->post('syllabus'),
                'date'       => date('Y-m-d', strtotime(str_replace('/', '-', $this->input->post("upload_date")))),
            );
            $insert_id = $this->syllabus_model->add($data);
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
                if (!file_exists("./uploads/" . $name . "/syllabus/")) {
                    mkdir("./uploads/" . $name . "/syllabus/", 0777, true);
                }
                move_uploaded_file($_FILES["file"]["tmp_name"], "./uploads/" . $name . "/syllabus/" . $img_name);
                $data_img = array('id' => $insert_id, 'file' => 'uploads/' . $name . '/syllabus/' . $img_name);
                $this->syllabus_model->add($data_img);
            }
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Content details added to Database!!!</div>');
            redirect('admin/content/sylabus');
        }
    }
    function getByTeacherCreate()
    {
        $teacher_id       = $this->input->get('teacher_id');
        $data['class'] = $this->section_model->getTeacherClass( $teacher_id);
        echo json_encode($data);
    }

    
    function getByClassCreate()
    {
        $class_id         = $this->input->get('class_id');
        $teacher_id       = $this->input->get('teacher_id');
        $data['sections'] = $this->section_model->getTeacherClassBySection($class_id, $teacher_id);
        echo json_encode($data);
    }

    function getSubjectByClsandSectionTeacher()
    {
        $class_id        = $this->input->get('class_id');
        $section_id      = $this->input->get('section_id');
        $teacher_id      = $this->input->get('teacher_id');
        $data['subject'] = $this->teachersubject_model->getSubjectByClsandSectionTeacher($class_id, $section_id, $teacher_id);
        echo json_encode($data);
    }
    function createsyllabus()
    {

        $this->form_validation->set_rules('content_title', 'Content Title', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('file', 'Image', 'callback_handle_upload');
        if ($this->form_validation->run() == FALSE) {

            $list = $this->teacher_model->get();
            $data['teacherlist'] = $list;
            $class = $this->class_model->get();
            $data['classlist'] = $class;
            $list               = $this->syllabus_model->get();


            $data['list'] = $list;
        $this->load->view('layout/header');
        $this->load->view('admin/syllabus/syllabus', $data);
        $this->load->view('layout/footer');

        } else {
            $visibility = "No";
            $classes    = $this->input->post('class_id');
            $section_id = $this->input->post('section_id');
            $subject_id = $this->input->post('subject_id');

            $syllabus  = nl2br($this->input->post('syllabus'));
            $syllabus  = trim($syllabus);
            $classwork = nl2br($this->input->post('classwork'));
            $classwork = trim($classwork);
            $data      = array(
                'title'      => $this->input->post('content_title'),
                'syllabus'   => $syllabus,
                'class_id'   => $classes,
                'section_id' => $section_id,
                'subject_id' => $subject_id,
                'teacher_id' =>$this->input->post('teacher_id'),
                'date'       => date('Y-m-d', strtotime(str_replace('/', '-', $this->input->post("upload_date")))),
                'file'       => $this->input->post('file'),
            );
            $insert_id = $this->syllabus_model->add($data);
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

                if (!file_exists("./uploads/" . $name . "/syllabus/")) {
                    mkdir("./uploads/" . $name . "/syllabus/", 0777, true);
                }

                move_uploaded_file($_FILES["file"]["tmp_name"], "./uploads/" . $name . "/syllabus/" . $img_name);
                $data_img = array('id' => $insert_id, 'file' => 'uploads/' . $name . '/syllabus/' . $img_name);
                $this->syllabus_model->add($data_img);
            }
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Content added successfully</div>');
            redirect('admin/content/sylabus');
        }
    }
    function createcontent() {
        $data['title'] = 'Upload Content';
        $data['title_list'] = 'Upload Content List';
        $this->form_validation->set_rules('content_title', 'Content Title', 'trim|required|xss_clean');
        $this->form_validation->set_rules('content_type', 'Content Type', 'trim|required|xss_clean');
        $this->form_validation->set_rules('file', 'Image', 'callback_handle_upload');
        if ($this->form_validation->run() == FALSE) {
            $list = $this->content_model->get();
            $data['list'] = $list;
            $class = $this->class_model->get();
            $data['classlist'] = $class;
            $ght = $this->customlib->getcontenttype();
            $data['ght'] = $ght;
            $this->load->view('layout/header');
            $this->load->view('admin/content/createcontent', $data);
            $this->load->view('layout/footer');
        } else {
            $visibility = "No";
            $classes = $this->input->post('class_id');
            $vs = $this->input->post('visibility');
            if (isset($vs)) {
                $visibility = $this->input->post('visibility');
                $classes = "";
            }
            $data = array(
                'title' => $this->input->post('content_title'),
                'type' => $this->input->post('content_type'),
                'note' => $this->input->post('note'),
                'class_id' => $classes,
                'date' => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('upload_date'))),
                'file' => $this->input->post('file'),
                'is_public' => $visibility
            );
            $insert_id = $this->content_model->add($data);
            if (isset($_FILES["file"]) && !empty($_FILES['file']['name'])) {
                $fileInfo = pathinfo($_FILES["file"]["name"]);
                $img_name = $insert_id . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["file"]["tmp_name"], "./uploads/school_content/material/" . $img_name);
                $data_img = array('id' => $insert_id, 'file' => 'uploads/school_content/material/' . $img_name);
                $this->content_model->add($data_img);
            }
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Content added successfully</div>');
            redirect('admin/content');
        }
    }

    function handle_upload() {
        if (isset($_FILES["file"]) && !empty($_FILES['file']['name'])) {
            $allowedExts = array('jpg', 'jpeg', 'png', "pdf", "doc", "docx", "rar", "zip");
            $temp = explode(".", $_FILES["file"]["name"]);
            $extension = end($temp);
            if ($_FILES["file"]["error"] > 0) {
                $error .= "Error opening the file<br />";
            }
            if (($_FILES["file"]["type"] != "application/pdf") && ($_FILES["file"]["type"] != "image/gif") && ($_FILES["file"]["type"] != "image/jpeg") && ($_FILES["file"]["type"] != "image/jpg") && ($_FILES["file"]["type"] != "application/vnd.openxmlformats-officedocument.wordprocessingml.document") && ($_FILES["file"]["type"] != "application/vnd.openxmlformats-officedocument.wordprocessingml.document") && ($_FILES["file"]["type"] != "image/pjpeg") && ($_FILES["file"]["type"] != "image/x-png") && ($_FILES["file"]["type"] != "application/x-rar-compressed") && ($_FILES["file"]["type"] != "application/octet-stream") && ($_FILES["file"]["type"] != "application/zip") && ($_FILES["file"]["type"] != "application/octet-stream") && ($_FILES["file"]["type"] != "image/png")) {
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

    public function download($file) {
        $this->load->helper('download');        
        $filepath = "./uploads/school_content/material/" . $this->uri->segment(7);
        $data = file_get_contents($filepath);
        $name = $this->uri->segment(7);
        force_download($name, $data);
    }

    function edit($id) {
        $data['title'] = 'Add Content';
        $data['id'] = $id;
        $editpost = $this->content_model->get($id);
        $data['editpost'] = $editpost;
        $ght = $this->customlib->getcontenttype();
        $data['ght'] = $ght;
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        $this->form_validation->set_rules('content_title', 'Content Title', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $listpost = $this->content_model->get();
            $data['listpost'] = $listpost;
            $this->load->view('layout/header');
            $this->load->view('admin/content/editpost', $data);
            $this->load->view('layout/footer');
        } else {
            $data = array(
                'id' => $this->input->post('id'),
                'content_title' => $this->input->post('content_title'),
                'content_type' => $this->input->post('content_type'),
                'class_id' => $this->input->post('class_id'),
                'date' => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('upload_date'))),
                'file_uploaded' => $this->input->file['file']['name']
            );
            $this->content_model->addcontentpost($data);
            if (isset($_FILES["file"]) && !empty($_FILES['file']['name'])) {
                $fileInfo = pathinfo($_FILES["file"]["name"]);
                $img_name = $id . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["file"]["tmp_name"], "./uploads/student_images/" . $img_name);
                $data_img = array('id' => $id, 'file_uploaded' => 'uploads/student_images/' . $img_name);
                $this->content_model->addcontentpost($data_img);
            }
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Content details added to Database!!!</div>');
            redirect('admin/content/createcontent/index');
        }
    }

    function search() {
        $text = $_GET['content'];
        $data['title'] = 'Fees Master List';
        $contentlist = $this->content_model->search_by_content_type($text);
        $data['contentlist'] = $contentlist;
        $this->load->view('layout/header');
        $this->load->view('admin/content/search', $data);
        $this->load->view('layout/footer');
    }
    function syllabusdelete($id) {
        $data = $this->syllabus_model->get($id);
        $file = $data['file'];
        unlink($file);
        $this->syllabus_model->remove($id);
        redirect('admin/content/sylabus');
    }
    function delete($id) {
        $data = $this->content_model->get($id);
        $file = $data['file'];
        unlink($file);
        $this->content_model->remove($id);
        redirect('admin/content');
    }

    function deleteassignment($id) {
        $this->content_model->remove($id);
        $data['title_list'] = 'Assignment List';
        $list = $this->content_model->getListByCategory("Assignments");
        $data['list'] = $list;
        $this->load->view('layout/header');
        $this->load->view('admin/content/assignment', $data);
        $this->load->view('layout/footer');
    }

    public function assignment() {
        $this->session->set_userdata('top_menu', 'Download Center');
        $this->session->set_userdata('sub_menu', 'content/assignment');
        $data['title_list'] = 'Assignment List';
        $list = $this->content_model->getListByCategory("Assignments");
        $data['list'] = $list;
        $this->load->view('layout/header');
        $this->load->view('admin/content/assignment', $data);
        $this->load->view('layout/footer');
    }

    public function studymaterial() {
        $this->session->set_userdata('top_menu', 'Download Center');
        $this->session->set_userdata('sub_menu', 'content/studymaterial');
        $data['title_list'] = 'Study Material List';
        $list = $this->content_model->getListByCategory("Study Material");
        $data['list'] = $list;
        $this->load->view('layout/header');
        $this->load->view('admin/content/studymaterial', $data);
        $this->load->view('layout/footer');
    }

    public function syllabus() {
        $this->session->set_userdata('top_menu', 'Download Center');
        $this->session->set_userdata('sub_menu', 'content/syllabus');
        $data['title_list'] = 'Syllabus List';
        $list = $this->content_model->getListByCategory("Syllabus");
        $data['list'] = $list;
        $this->load->view('layout/header');
        $this->load->view('admin/content/syllabus', $data);
        $this->load->view('layout/footer');
    }

    public function other() {
        $this->session->set_userdata('top_menu', 'Download Center');
        $this->session->set_userdata('sub_menu', 'content/other');
        $data['title_list'] = 'Other Download List';
        $list = $this->content_model->getListByCategory("Other Download");
        $data['list'] = $list;
        $this->load->view('layout/header');
        $this->load->view('admin/content/other', $data);
        $this->load->view('layout/footer');
    }
	
}

?>