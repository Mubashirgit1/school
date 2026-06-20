<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Youtube extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->lang->load('message', 'english');
         
    }

    public function index()
    {

        $this->session->set_userdata('top_menu', 'youtube');
        $this->session->set_userdata('sub_menu', 'youtube/index');
     
        $list               = $this->youtube_model->get();
        $data['list']       = $list;
   
        $teacherlist = $this->teacher_model->get();

        $data['teacherlist'] = $teacherlist;
      
        $this->load->view('layout/header');
        $this->load->view('admin/youtube/createyoutube', $data);
        $this->load->view('layout/footer');
    }



    function createyoutube()
    {

        $this->form_validation->set_rules('content_title', 'Content Title', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('file', 'Image', 'callback_handle_upload');
        if ($this->form_validation->run() == FALSE) {

          
            $list               = $this->youtube_model->get();
            $data['list'] = $list;
            $teacherlist = $this->teacher_model->get();

            $data['teacherlist'] = $teacherlist;
         
            
            $this->load->view('layout/header');
            $this->load->view('admin/youtube/createyoutube', $data);
            $this->load->view('layout/footer');
        } else {
            $visibility  = "No";
            $classes     = $this->input->post('class_id');
            $section_id  = $this->input->post('section_id');
            $subject_id  = $this->input->post('subject_id');
            $description = $this->input->post('description');

            $data      = array(
                'title'      => $this->input->post('content_title'),
                'class_id'   => $classes,
                'section_id' => $section_id,
                'subject_id' => $subject_id,
                'teacher_id' =>  $this->input->post('teacher_id'),
                'link'       => $description,
                'date'       => date('Y-m-d', strtotime(str_replace('/', '-', $this->input->post("upload_date")))),
            );
            $insert_id = $this->youtube_model->add($data);

            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Content added successfully</div>');
            redirect('admin/youtube');
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
        $editpost           = $this->youtube_model->get($id);
        $data['editpost']   = $editpost;
      
        $teacherlist = $this->teacher_model->get();

        $data['teacherlist'] = $teacherlist;
        $this->form_validation->set_rules('content_title', 'Content Title', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
          
            $list               = $this->youtube_model->get();
            $data['list']       = $list;
            $teacherlist = $this->teacher_model->get();

            $data['teacherlist'] = $teacherlist;
            $this->load->view('layout/header');
            $this->load->view('admin/youtube/editpost', $data);
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
                'link'       => $this->input->post('description'),
                'date'       => date('Y-m-d', strtotime(str_replace('/', '-', $this->input->post("upload_date")))),
            );
            $insert_id = $this->youtube_model->add($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Content details added to Database!!!</div>');
            redirect('admin/youtube/index');
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
        
        $data          = $this->youtube_model->get($id);
        $file          = $data['file'];
        unlink($file);
        $this->youtube_model->remove($id);
        redirect('admin/youtube');
    }

    function deleteyoutube($id)
    {
        $this->content_model->remove($id);
        $data['title_list'] = 'youtube List';
        $list               = $this->content_model->getListByCategory("youtubes");
        $data['list']       = $list;
        $this->load->view('layout/teacher/header');
        $this->load->view('teacher/content/youtube', $data);
        $this->load->view('layout/teacher/footer');
    }

}

?>