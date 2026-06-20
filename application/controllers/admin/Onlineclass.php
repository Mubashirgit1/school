<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Onlineclass extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->lang->load('message', 'english');

    }

    public function index()
    {

        $this->session->set_userdata('top_menu', 'OnlineClass');
        $this->session->set_userdata('sub_menu', 'OnlineClass/index');

        $list         = $this->onlineclass_model->get();
        $data['list'] = $list;
        $teacherlist  = $this->teacher_model->get();

        $data['teacherlist'] = $teacherlist;


        $this->load->view('layout/header');
        $this->load->view('admin/onlineclass/createonlineclass', $data);
        $this->load->view('layout/footer');
    }


    function createonlineclass()
    {

        $this->form_validation->set_rules('content_title', 'Content Title', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('file', 'Image', 'callback_handle_upload');
        if ($this->form_validation->run() == FALSE) {

            $list                = $this->onlineclass_model->get();
            $data['list']        = $list;
            $teacherlist         = $this->teacher_model->get();
            $data['teacherlist'] = $teacherlist;

            $this->load->view('layout/header');
            $this->load->view('admin/onlineclass/createonlineclass', $data);
            $this->load->view('layout/footer');
        } else {
            $visibility  = "No";
            $classes     = $this->input->post('class_id');
            $section_id  = $this->input->post('section_id');
            $subject_id  = $this->input->post('subject_id');
            $description = $this->input->post('description');
            $link        = $this->input->post('link');
            $class_time  = $this->input->post('class_time');
            $password    = $this->input->post('password');
            $data        = array(
                'title'       => $this->input->post('content_title'),
                'class_id'    => $classes,
                'section_id'  => $section_id,
                'subject_id'  => $subject_id,
                'teacher_id'  => $this->input->post('teacher_id'),
                'class_time'  => $class_time,
                'password'    => $password,
                'link'        => $link,
                'description' => $description,
                'date'        => date('Y-m-d', strtotime(str_replace('/', '-', $this->input->post("upload_date")))),
            );
            $insert_id   = $this->onlineclass_model->add($data);

            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Content added successfully</div>');
            redirect('admin/onlineclass');
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


    function edit($id)
    {

        $data['title']    = 'Add Content';
        $data['id']       = $id;
        $editpost         = $this->onlineclass_model->get($id);
        $data['editpost'] = $editpost;
        $list             = $this->onlineclass_model->get();
        $data['list']     = $list;
        $teacherlist      = $this->teacher_model->get();

        $data['teacherlist'] = $teacherlist;
        $this->form_validation->set_rules('content_title', 'Content Title', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $list         = $this->onlineclass_model->get();
            $data['list'] = $list;
            $teacherlist  = $this->teacher_model->get();

            $data['teacherlist'] = $teacherlist;
            $this->load->view('layout/header');
            $this->load->view('admin/onlineclass/editpost', $data);
            $this->load->view('layout/footer');
        } else {
            $id          = $this->input->post('id');
            $description = $this->input->post('description');
            $link        = $this->input->post('link');
            $class_time  = $this->input->post('class_time');
            $password    = $this->input->post('password');
            $data        = array(
                'id'          => $id,
                'title'       => $this->input->post('content_title'),
                'class_id'    => $this->input->post('class_id'),
                'section_id'  => $this->input->post('section_id'),
                'subject_id'  => $this->input->post('subject_id'),
                'teacher_id'  => $this->input->post('teacher_id'),
                'class_time'  => $class_time,
                'password'    => $password,
                'link'        => $link,
                'description' => $description,
                'date'        => date('Y-m-d', strtotime(str_replace('/', '-', $this->input->post("upload_date")))),
            );
            $insert_id   = $this->onlineclass_model->add($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Content details added to Database!!!</div>');
            redirect('teacher/onlineclass/index');
        }
    }


    function delete($id)
    {
        $data['title'] = 'Fees Master List';
        $data          = $this->onlineclass_model->get($id);
        $file          = $data['file'];
        unlink($file);
        $this->onlineclass_model->remove($id);
        redirect('admin/onlineclass');
    }

    function deleteonlineclass($id)
    {
        $this->content_model->remove($id);
        $data['title_list'] = 'onlineclass List';
        $list               = $this->content_model->getListByCategory("onlineclasss");
        $data['list']       = $list;
        $this->load->view('layout/teacher/header');
        $this->load->view('teacher/content/onlineclass', $data);
        $this->load->view('layout/teacher/footer');
    }

}

?>