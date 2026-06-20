<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Assignment extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->lang->load('message', 'english');
        $this->load->library('Customlib');
        $this->load->library('auth');
        $this->auth->is_logged_in_teacher();
    }

    public function index()
    {

        $this->session->set_userdata('top_menu', 'Assignment');
        $this->session->set_userdata('sub_menu', 'assignment/index');
        $data['title']      = 'Upload Content';
        $data['title_list'] = 'Upload Content List';
        $data['teacher_id'] = $this->session->userdata['student']['teacher_id'];

        $list = $this->assignment_model->get(null, $data['teacher_id']);
        foreach ($list as $singleAssignment) {


            $assignment = $this->assignment_model->get_std_reply(null, null, null, null, null, $singleAssignment['id']);

            $question = $this->assignment_model->get($singleAssignment['id']);

            //  echo "<pre>";
            //     print_r($question);
            // echo "</pre>";


            $students_submitted_assignment = [];
            foreach ($assignment as $std) {
                $students_submitted_assignment[] = $std['student_id'];
            }

            $class_id   = $question['class_id'];
            $section_id = $question['section_id'];
            $teacher_id = $question['teacher_id'];
            $subject_id = $question['subject_id'];


            $resultlist = $this->student_model->searchByClassSection($class_id, $section_id, $gender = null, $fee_status = null, $excluded_student_ids = null, $order = null, $session_id = null, $students_submitted_assignment);

            $singleAssignment['total_submit']  = count($students_submitted_assignment);
            $singleAssignment['total_pending'] = count($resultlist);

            $allResults[] = $singleAssignment;
        }
        $data['list'] = $allResults;
        $ght          = $this->customlib->getcontenttype();
        $data['ght']  = $ght;

        $class_sections    = $this->class_model->get_teacher_class($data['teacher_id']);
        $data['classlist'] = $class_sections;
        $this->load->view('layout/teacher/header');
        $this->load->view('teacher/assignment/createassignment', $data);
        $this->load->view('layout/teacher/footer');
    }

    function view_results($assignment_id)
    {

        $assignment = $this->assignment_model->get_std_reply(null, null, null, null, null, $assignment_id);

        $question = $this->assignment_model->get($assignment_id);

        //  echo "<pre>";
        //     print_r($question);
        // echo "</pre>";


        $students_submitted_assignment = [];
        foreach ($assignment as $std) {
            $students_submitted_assignment[] = $std['student_id'];
        }

        $class_id   = $question['class_id'];
        $section_id = $question['section_id'];
        $teacher_id = $question['teacher_id'];
        $subject_id = $question['subject_id'];


        $resultlist = $this->student_model->searchByClassSection($class_id, $section_id, $gender = null, $fee_status = null, $excluded_student_ids = null, $order = null, $session_id = null, $students_submitted_assignment);

        // $remaining_students = $this->db->select("students.*, sections.id as section_id, sections.section as section_name")
        //                             ->where("students.admission_class", $question['class_id'])
        //                             ->where_not_in("students.id", $students_submitted_assignment)
        //                             ->join( 'student_session', 'student_session.student_id = students.id', "left")
        //                             ->join( 'sections', 'sections.id = student_session.section_id', "left")
        //                             ->group_by("students.id")
        //                             ->get("students")->result_array();


        // $data['pending'] = $remaining_students;
        $data['pending'] = $resultlist;


        $data['assignments'] = $assignment;
        $data['question']    = $question;
        $this->load->view("teacher/assignment/view_all_assignments", $data);
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


    function createassignment()
    {

        $this->form_validation->set_rules('content_title', 'Content Title', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('file', 'Image', 'callback_handle_upload');
        if ($this->form_validation->run() == FALSE) {

            $data['teacher_id'] = $this->session->userdata['student']['teacher_id'];
            $list               = $this->assignment_model->get(null, $data['teacher_id']);

            $data['list'] = $list;

            $class_sections    = $this->class_model->get_teacher_class($data['teacher_id']);
            $data['classlist'] = $class_sections;
            $ght               = $this->customlib->getcontenttype();
            $data['ght']       = $ght;
            $this->load->view('layout/teacher/header');
            $this->load->view('teacher/assignment/createassignment', $data);
            $this->load->view('layout/teacher/footer');
        } else {
            $visibility  = "No";
            $classes     = $this->input->post('class_id');
            $section_id  = $this->input->post('section_id');
            $subject_id  = $this->input->post('subject_id');
            $description = $this->input->post('description');

            $data = array(
                'title'         => $this->input->post('content_title'),
                'class_id'      => $classes,
                'section_id'    => $section_id,
                'subject_id'    => $subject_id,
                'marks'         => $this->input->post("marks"),
                'passing_marks' => $this->input->post("passing_marks"),
                'teacher_id'    => $this->session->userdata['student']['teacher_id'],
                'description'   => $description,
                'date'          => date('Y-m-d', strtotime(str_replace('/', '-', $this->input->post("upload_date")))),
                'file'          => $this->input->post('file'),
            );

            $insert_id = $this->assignment_model->add($data);
            if (isset($_FILES["file"]) && !empty($_FILES['file']['name'])) {
                $fileInfo = pathinfo($_FILES["file"]["name"]);
                $img_name = $_FILES['file']['name'];
                $img_name = rand(1000, 9999) . "-" . str_replace(" ", "-", $img_name);


                $setting_result = $this->setting_model->get();
                // $name      = str_replace(' ', '-', strtolower($setting_result[0]['name']));

                $name = base_url();
                $name = str_replace("https://", "", $name);
                $name = str_replace("http://", "", $name);
                $name = str_replace("/", "", $name);
                $name = str_replace("www.", "", $name);
                if (!file_exists("./uploads/" . $name)) {
                    mkdir("./uploads/" . $name, 0777, true);
                }

                if (!file_exists("./uploads/" . $name . "/assignment/")) {
                    mkdir("./uploads/" . $name . "/assignment/", 0777, true);
                }

                move_uploaded_file($_FILES["file"]["tmp_name"], "./uploads/" . $name . "/assignment/" . $img_name);
                $data_img = array('id' => $insert_id, 'file' => 'uploads/' . $name . '/assignment/' . $img_name);
                $this->assignment_model->add($data_img);
            }
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Content added successfully</div>');
            redirect('teacher/assignment');
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
        $editpost           = $this->assignment_model->get($id);
        $data['editpost']   = $editpost;
        $data['teacher_id'] = $this->session->userdata['student']['teacher_id'];
        $class_sections     = $this->class_model->get_teacher_class($data['teacher_id']);
        $data['classlist']  = $class_sections;
        $this->form_validation->set_rules('content_title', 'Content Title', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $data['teacher_id'] = $this->session->userdata['student']['teacher_id'];
            $list               = $this->assignment_model->get(null, $data['teacher_id']);
            $data['list']       = $list;
            $this->load->view('layout/teacher/header');
            $this->load->view('teacher/assignment/editpost', $data);
            $this->load->view('layout/teacher/footer');
        } else {
            $id        = $this->input->post('id');
            $data      = array(
                'id'            => $id,
                'title'         => $this->input->post('content_title'),
                'class_id'      => $this->input->post('class_id'),
                'section_id'    => $this->input->post('section_id'),
                'subject_id'    => $this->input->post('subject_id'),
                'marks'         => $this->input->post("marks"),
                'passing_marks' => $this->input->post("passing_marks"),
                'teacher_id'    => $this->input->post('teacher_id'),
                'description'   => $this->input->post('description'),
                'date'          => date('Y-m-d', strtotime(str_replace('/', '-', $this->input->post("upload_date")))),
            );
            $insert_id = $this->assignment_model->add($data);
            if (isset($_FILES["file"]) && !empty($_FILES['file']['name'])) {
                $fileInfo = pathinfo($_FILES["file"]["name"]);
                $img_name = $_FILES['file']['name'];
                $img_name = rand(1000, 9999) . "-" . str_replace(" ", "-", $img_name);

                $setting_result = $this->setting_model->get();
                // $name      = str_replace(' ', '-', strtolower($setting_result[0]['name']));


                $name = base_url();
                $name = str_replace("https://", "", $name);
                $name = str_replace("http://", "", $name);
                $name = str_replace("/", "", $name);
                $name = str_replace("www.", "", $name);
                if (!file_exists("./uploads/" . $name)) {
                    mkdir("./uploads/" . $name, 0777, true);
                }

                if (!file_exists("./uploads/" . $name . "/assignment/")) {
                    mkdir("./uploads/" . $name . "/assignment/", 0777, true);
                }

                move_uploaded_file($_FILES["file"]["tmp_name"], "./uploads/" . $name . "/assignment/" . $img_name);
                $data_img = array('id' => $id, 'file' => 'uploads/' . $name . '/assignment/' . $img_name);
                $this->assignment_model->add($data_img);
            }
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Content details added to Database!!!</div>');
            redirect('teacher/assignment/index');
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
        $data          = $this->assignment_model->get($id);
        $file          = $data['file'];
        unlink($file);
        $this->assignment_model->remove($id);

        $byStudents = $this->assignment_model->get_std_replies_of_assignment($data['id']);
        $stdIds     = array();
        foreach ($byStudents as $std) {
            $stdIds[] = $std['id'];
            if ($std['file']) {
                unlink($std['file']);
            }
            if ($std['reply_file']) {
                unlink($std['reply_file']);
            }
        }
        $this->assignment_model->remove_std_assignments_where_in_id($stdIds);


        redirect('teacher/assignment/createassignment');
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

    function saveMarks()
    {
        $marks = $this->input->post('marks');

        foreach ($marks as $key => $item) {
            $data = array(
                'marks' => $item
            );
            $this->db->where('id', $key);
            $this->db->update('student_assignment', $data);
        }
        echo true;
    }


    function saveMarksSingle()
    {
        $marks = $this->input->post('marks');
        $id    = $this->input->post('result_id');
//        $passing_marks    = $this->input->post('passing_marks');

//        foreach ($marks as $key => $item) {
        $data = array(
            'marks' => $marks
        );
        $this->db->where('id', $id);
        $this->db->update('student_assignment', $data);
//        }
        $result   = $this->db->where("id", $id)->get("student_assignment")->row();
        $question = $this->db->where("id", $result->assignment_id)->get("assignment")->row();

        $status     = "";
        $percentage = "";

        if ($result->marks) {
            if ($result->marks < $question->passing_marks) {
                $status = '<span style="color:red">Fail</span>';
            } else {
                $status = "Pass";
            }
        }

        if ($result->marks) {
            $percentage = $result->marks / $question->marks * 100;
        }

        $data['status']     = $status;
        $data['percentage'] = round($percentage, 2);
        echo json_encode($data);
    }

    function saveRemarksSingle()
    {
        $remarks = $this->input->post('remarks');
        $id      = $this->input->post('result_id');
        $data    = array(
            'reply_comments' => $remarks
        );
        $this->db->where('id', $id);
        $this->db->update('student_assignment', $data);

        $data['status'] = true;
        echo json_encode($data);
    }

    function upload_ajax()
    {
        if (isset($_FILES['file']['name'])) {

            $result_id = $this->input->post("result_id");
            $fileInfo  = pathinfo($_FILES["file"]["name"]);
            $img_name  = $_FILES['file']['name'];
            $img_name  = rand(1000, 9999) . "-" . str_replace(" ", "-", $img_name);


            $setting_result = $this->setting_model->get();
            // $name      = str_replace(' ', '-', strtolower($setting_result[0]['name']));

            $name = base_url();
            $name = str_replace("https://", "", $name);
            $name = str_replace("http://", "", $name);
            $name = str_replace("/", "", $name);
            $name = str_replace("www.", "", $name);
            if (!file_exists("./uploads/" . $name)) {
                mkdir("./uploads/" . $name, 0777, true);
            }

            if (!file_exists("./uploads/" . $name . "/assignment_reply/")) {
                mkdir("./uploads/" . $name . "/assignment_reply/", 0777, true);
            }

            move_uploaded_file($_FILES["file"]["tmp_name"], "./uploads/" . $name . "/assignment_reply/" . $img_name);
            $data_img = array('id' => $result_id, 'reply_file' => 'uploads/' . $name . '/assignment_reply/' . $img_name);


            $prevResult = $this->db->where("id", $result_id)->get("student_assignment")->row();

            if ($prevResult->reply_file) {
                unlink($prevResult->reply_file);
            }

            $res = $this->db->where("id", $result_id)->update("student_assignment", $data_img);

            echo $img_name;
        }
    }

}
