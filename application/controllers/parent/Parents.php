<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @property Assignment_model assignment_model
 */
class Parents extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('auth');
        $this->lang->load('message', 'english');
        $this->load->library('auth');
        $this->auth->is_logged_in_parent();
    }

    function dashboard()
    {
        $this->session->set_userdata('top_menu', 'My Children');
        $this->session->set_userdata('sub_menu', 'parent/parents/dashboard');
        $student_id = $this->customlib->getStudentSessionUserID();

        $array_childs = array();
        $ch           = $this->session->userdata('parent_childs');
        foreach ($ch as $key_ch => $value_ch) {
            $array_childs[] = $this->student_model->get($value_ch['student_id']);
        }
        $data['student_list'] = $array_childs;
        $this->load->view('layout/parent/header', $data);
        $this->load->view('parent/dashboard', $data);
        $this->load->view('layout/parent/footer', $data);
    }

    public function download($student_id, $doc)
    {
        $this->load->helper('download');
        $filepath = "./uploads/student_documents/$student_id/" . $this->uri->segment(5);
        $data     = file_get_contents($filepath);
        $name     = $this->uri->segment(6);
        force_download($name, $data);
    }

    function changepass()
    {
        $data['title'] = 'Change Password';
        $this->form_validation->set_rules('current_pass', 'Current password', 'trim|required|xss_clean');
        $this->form_validation->set_rules('new_pass', 'New password', 'trim|required|xss_clean|matches[confirm_pass]');
        $this->form_validation->set_rules('confirm_pass', 'Confirm password', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $sessionData            = $this->session->userdata('loggedIn');
            $this->data['id']       = $sessionData['id'];
            $this->data['username'] = $sessionData['username'];
            $this->load->view('layout/parent/header', $data);
            $this->load->view('parent/change_password', $data);
            $this->load->view('layout/parent/footer', $data);
        } else {
            $sessionData = $this->session->userdata('student');
            $data_array  = array(
                'current_pass' => ($this->input->post('current_pass')),
                'new_pass'     => ($this->input->post('new_pass')),
                'user_id'      => $sessionData['id'],
                'user_name'    => $sessionData['username']
            );
            $newdata     = array(
                'id'       => $sessionData['id'],
                'password' => $this->input->post('new_pass')
            );
            $query1      = $this->user_model->checkOldPass($data_array);
            if ($query1) {
                $query2 = $this->user_model->saveNewPass($newdata);
                if ($query2) {

                    $this->session->set_flashdata('success_msg', 'Password changed successfully');
                    $this->load->view('layout/parent/header', $data);
                    $this->load->view('parent/change_password', $data);
                    $this->load->view('layout/parent/footer', $data);
                }
            } else {

                $this->session->set_flashdata('error_msg', 'Invalid current password');
                $this->load->view('layout/parent/header', $data);
                $this->load->view('parent/change_password', $data);
                $this->load->view('layout/parent/footer', $data);
            }
        }
    }

    function changeusername()
    {
        $sessionData = $this->customlib->getLoggedInUserData();

        $data['title'] = 'Change Username';
        $this->form_validation->set_rules('current_username', 'Current username', 'trim|required|xss_clean');
        $this->form_validation->set_rules('new_username', 'New username', 'trim|required|xss_clean|matches[confirm_username]');
        $this->form_validation->set_rules('confirm_username', 'Confirm username', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {

        } else {

            $data_array = array(
                'username'     => $this->input->post('current_username'),
                'new_username' => $this->input->post('new_username'),
                'role'         => $sessionData['role'],
                'user_id'      => $sessionData['id'],
            );
            $newdata    = array(
                'id'       => $sessionData['id'],
                'username' => $this->input->post('new_username')
            );
            $is_valid   = $this->user_model->checkOldUsername($data_array);

            if ($is_valid) {
                $is_exists = $this->user_model->checkUserNameExist($data_array);
                if (!$is_exists) {
                    $is_updated = $this->user_model->saveNewUsername($newdata);
                    if ($is_updated) {
                        $this->session->set_flashdata('success_msg', 'Username changed successfully');
                        redirect('parent/parents/changeusername');
                    }
                } else {
                    $this->session->set_flashdata('error_msg', 'Username Already Exists, Please choose other');
                }
            } else {
                $this->session->set_flashdata('error_msg', 'Invalid current username');
            }
        }
        $this->data['id']       = $sessionData['id'];
        $this->data['username'] = $sessionData['username'];
        $this->load->view('layout/parent/header', $data);
        $this->load->view('parent/change_username', $data);
        $this->load->view('layout/parent/footer', $data);
    }

    function getstudent($id)
    {
        $this->session->set_userdata('top_menu', 'My Children');
        $this->session->set_userdata('sub_menu', 'parent/parents/getStudent');
        $student_id                   = $id;
        $payment_setting              = $this->paymentsetting_model->get();
        $data['payment_setting']      = $payment_setting;
        $category                     = $this->category_model->get();
        $data['category_list']        = $category;
        $student                      = $this->student_model->get($student_id);
        $gradeList                    = $this->grade_model->get();
        $data['gradeList']            = $gradeList;
        $class_id                     = $student['class_id'];
        $section_id                   = $student['section_id'];
        $data['title']                = 'Student Details';
        $student_session_id           = $student['student_session_id'];
        $student_due_fee              = $this->studentfeemaster_model->getStudentFees($student_session_id);
        $student_discount_fee         = $this->feediscount_model->getStudentFeesDiscount($student_session_id);
        $data['student_discount_fee'] = $student_discount_fee;
        $data['student_due_fee']      = $student_due_fee;


        $examList             = $this->examschedule_model->getExamByClassandSection($student['class_id'], $student['section_id']);
        $data['examSchedule'] = array();
        if (!empty($examList)) {
            $new_array = array();
            foreach ($examList as $ex_key => $ex_value) {
                $array         = array();
                $x             = array();
                $exam_id       = $ex_value['exam_id'];
                $exam_subjects = $this->examschedule_model->getresultByStudentandExam($exam_id, $student['id']);
                foreach ($exam_subjects as $key => $value) {
                    $exam_array                     = array();
                    $exam_array['exam_schedule_id'] = $value['exam_schedule_id'];
                    $exam_array['exam_id']          = $value['exam_id'];
                    $exam_array['full_marks']       = $value['full_marks'];
                    $exam_array['passing_marks']    = $value['passing_marks'];
                    $exam_array['exam_name']        = $value['name'];
                    $exam_array['exam_type']        = $value['type'];
                    $exam_array['attendence']       = $value['attendence'];
                    $exam_array['get_marks']        = $value['get_marks'];
                    $x[]                            = $exam_array;
                }
                $array['exam_name']   = $ex_value['name'];
                $array['exam_result'] = $x;
                $new_array[]          = $array;
            }
            $data['examSchedule'] = $new_array;
        }
        $data['student'] = $student;
        $this->load->view('layout/parent/header', $data);
        $this->load->view('parent/student/getstudent', $data);
        $this->load->view('layout/parent/footer', $data);
    }

    public function student_all_specific()
    {

        $year = $this->input->post('year');

        $student_id = $this->input->post('student_id');

        $year = ($year !== null ? $year : date('Y', now()));

        $data['year'] = $year;

        $month = ($month !== null ? $month : date('m', now()));

        $data['month'] = $month;

        $days_in_month = cal_days_in_month(CAL_GREGORIAN, $month, $year);


        $attendance_dates = [];
        for ($day_number = 1; $day_number <= $days_in_month; $day_number++) {
            $attendance_dates[] = "{$year}-{$month}-{$day_number}";
        }

        $studentlist = $this->student_model->getstudent_id();
        for ($j = 1; $j < 13; $j++) {

            $annual        = str_pad($j, 2, 0, STR_PAD_LEFT);
            $days_in_month = cal_days_in_month(CAL_GREGORIAN, $month, $year);
            for ($day_number = 1; $day_number <= $days_in_month; $day_number++) {

                $teache[$j][$day_number][$i] = $this->stuattendence_model->searchAttendencestudent2($student_id, "{$year}-{$annual}-{$day_number}");


            }
        }


        echo json_encode($teache);
    }

    function getdocuments($id)
    {
        $this->session->set_userdata('top_menu', 'My Children');
        $this->session->set_userdata('sub_menu', 'parent/parents/getdocuments');
        $student_id = $id;

        $student = $this->student_model->get($student_id);

        $data['title'] = 'Download Documents';


        $student_doc            = $this->student_model->getstudentdoc($id);
        $data['student_doc']    = $student_doc;
        $data['student_doc_id'] = $id;


        $data['student'] = $student;
        $this->load->view('layout/parent/header', $data);
        $this->load->view('parent/student/getdocuments', $data);
        $this->load->view('layout/parent/footer', $data);
    }

    function getHomework($student_id)
    {
        $this->session->set_userdata('top_menu', 'Homework');
        $this->session->set_userdata('sub_menu', 'parent/parents/homework');
        $subjects = [];
        $student  = $this->student_model->get($student_id);

        $homeworkSubject = $this->homework_model->getListBySubject($student['class_id'], $student['section_id']);
        foreach ($homeworkSubject as $key => $subject) {
            $subjects[$subject['subject']] = $this->homework_model->getListByDate($student['class_id'], $student['section_id'], $subject['subject_id']);
        }

        $data['homework'] = $subjects;
        $data['student']  = $student;

        $this->load->view('layout/parent/header', $data);
        $this->load->view('parent/student/gethomework', $data);
        $this->load->view('layout/parent/footer', $data);
    }

    function upload_assignment($student_id = null, $assignment_id = null)
    {

        if ($this->input->post()) {

            $student    = $this->student_model->get($student_id);
            $assignment = $this->assignment_model->get($assignment_id);

            $assignment_check = $this->assignment_model->get_std_reply(null, null, null, null, null, $assignment_id, $student_id);

//            pwodie($this->db->last_query());
//            pwodie($assignment_check, false);
//             die(print_r($assignment_check));

            $classes     = $assignment['class_id'];
            $section_id  = $assignment['section_id'];
            $subject_id  = $assignment['subject_id'];
            $description = $this->input->post('description');

            $data = array(
                'title'         => $assignment['title'],
                'class_id'      => $classes,
                'student_id'    => $student_id,
                'assignment_id' => $assignment_id,
                'section_id'    => $section_id,
                'subject_id'    => $subject_id,
                'teacher_id'    => $assignment['teacher_id'],
                'description'   => $description,
                'date'          => date('Y-m-d'),
            );

//            pwodie($_FILES);
            if ($this->input->post('file')) {
                $isFile       = true;
                $data['file'] = $this->input->post('file');
            } else {
                $isFile = false;
            }

//            pwodie($data, false);

            if (count($assignment_check) > 0) {

                $data['id'] = $assignment_check[0]['id'];
                $insert_id  = $this->assignment_model->add_std_reply($data);
                $insert_id  = $data['id'];

            } else {
                $insert_id = $this->assignment_model->add_std_reply($data);
            }


            if (isset($_FILES["file"]) && !empty($_FILES['file']['name'])) {
                $fileInfo = pathinfo($_FILES["file"]["name"]);
                $img_name = $_FILES['file']['name'];
                $img_name = rand(1000, 9999) . "-" . str_replace(" ", "-", $img_name);

                $setting_result = $this->setting_model->get();
//                $name           = str_replace(' ', '-', strtolower($setting_result[0]['name']));

                $name = base_url();
                $name = str_replace("https://", "", $name);
                $name = str_replace("http://", "", $name);
                $name = str_replace("/", "", $name);
                $name = str_replace("www", "", $name);


                if (!file_exists("./uploads/" . $name)) {
                    mkdir("./uploads/" . $name, 0777, true);
                }

                if (!file_exists("./uploads/" . $name . "/student_assignment/")) {
                    mkdir("./uploads/" . $name . "/student_assignment/", 0777, true);
                }

                if ($isFile) {
                    unlink("./uploads/" . $name . "/student_assignment/" . $img_name);
                }

                move_uploaded_file($_FILES["file"]["tmp_name"], "./uploads/" . $name . "/student_assignment/" . $img_name);
                $data_img = array('id' => $insert_id, 'file' => 'uploads/' . $name . '/student_assignment/' . $img_name);

                $this->assignment_model->add_std_reply($data_img);
            }

            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Content added successfully</div>');
            redirect('parent/parents/getAssignment/' . $student_id . "/" . $assignment_id);

        } else {

            $data['assignment_id'] = $assignment_id;
            $data['student_id']    = $student_id;

            $this->session->set_userdata('top_menu', 'Homework');
            $this->session->set_userdata('sub_menu', 'parent/parents/homework');

            $student         = $this->student_model->get($student_id);
            $data['student'] = $student;

            $this->load->view('layout/parent/header', $data);
            $this->load->view('parent/student/upload_assignment', $data);
            $this->load->view('layout/parent/footer', $data);

        }

    }

    function studentHomework()
    {
        $student_id = $this->input->post('student_id');
        $date       = $this->input->post('date');
        // $homework = '';
        // if($date){
        //     $student = $this->student_model->get($student_id);
        //     $homework =  $this->homework_model->get(null, null,$student['class_id'],$student['section_id'],$date);
        // }


        $date = date('Y-m-d', strtotime(str_replace('/', '-', $date)));

        $subjects = [];
        $student  = $this->student_model->get($student_id);
        if ($date) {
            $homeworkSubject = $this->homework_model->getListBySubject($student['class_id'], $student['section_id']);
            foreach ($homeworkSubject as $key => $subject) {
                $subjects[$subject['subject']] = $this->homework_model->getListByDate($student['class_id'], $student['section_id'], $subject['subject_id'], $date);
            }
        }

        echo json_encode($subjects);
    }

    function getOnlineClass($student_id)
    {
        $this->session->set_userdata('top_menu', 'Homework');
        $this->session->set_userdata('sub_menu', 'parent/parents/homework');

        $student         = $this->student_model->get($student_id);
        $data['student'] = $student;

        $this->load->view('layout/parent/header', $data);
        $this->load->view('parent/student/getonlineclass', $data);
        $this->load->view('layout/parent/footer', $data);
    }

    function studentOnlineClass()
    {
        $student_id = $this->input->post('student_id');
        $date       = $this->input->post('date');

        // $date = DateTime::createFromFormat('d/m/Y', $date);
        // $date->format('Y-m-d');

        $date = str_replace('/', '-', $date);
        $date = date('Y-m-d', strtotime($date));


        $onlineclass['classes'] = array();

        $student = $this->student_model->get($student_id);

        // $vocationSubject =  $this->youtube_model->getListBySubject($student['class_id'],$student['section_id']);

        // foreach($vocationSubject as $key => $subject){
        //     $vocationDate[$subject['subject']] =  $this->youtube_model->getListByDate($student['class_id'],$student['section_id'], $subject['subject_id']);
        // }


        $subjects = $this->onlineclass_model->getAllSubjects($date, $student['class_id'], $student['section_id']);
        // die(json_encode($subjects));

        $onlineclass['subjects'] = $subjects;

        if ($date) {
            foreach ($subjects as $subject) {
                $onlineclass['classes'][$subject['id']] = $this->onlineclass_model->get(null, null, $student['class_id'], $student['section_id'], $date, $subject['id']);
            }
        }

        // if($date){
        //     $student = $this->student_model->get($student_id);
        //     $onlineclass =  $this->onlineclass_model->get(null, null,$student['class_id'],$student['section_id'],$date);
        // }

        echo json_encode($onlineclass);
    }

    function getAssignment($student_id)
    {
        $this->session->set_userdata('top_menu', 'Assignment');
        $this->session->set_userdata('sub_menu', 'parent/parents/assignment');

        $syllabusDate = [];
        $student      = $this->student_model->get($student_id);

        $syllabusSubject = $this->assignment_model->getListBySubject($student['class_id'], $student['section_id']);

        foreach ($syllabusSubject as $key => $subject) {
            $syllabusDate[$subject['subject']] = $this->assignment_model->getListByDate($student['class_id'], $student['section_id'], $subject['subject_id'], null, $student_id);
            $data['query'][] = $this->db->last_query();
        }

//        pwodie($syllabusDate, true);

        $data['assignments'] = $syllabusDate;
        $data['student']     = $student;

        $this->load->view('layout/parent/header', $data);
        $this->load->view('parent/student/getassignment', $data);
        $this->load->view('layout/parent/footer', $data);
    }

    function studentAssignment()
    {
        $student_id = $this->input->post('student_id');
        $date       = $this->input->post('date');

        $date = str_replace('/', '-', $date);
        $date = date('Y-m-d', strtotime($date));

        $syllabusDate = [];
        $student      = $this->student_model->get($student_id);
        if ($date) {
            $syllabusSubject = $this->assignment_model->getListBySubject($student['class_id'], $student['section_id']);
            foreach ($syllabusSubject as $key => $subject) {
                $syllabusDate[$subject['subject']] = $this->assignment_model->getListByDate($student['class_id'], $student['section_id'], $subject['subject_id'], $date);
            }
        }

        $data['student']      = $student;
        $data['assignments']  = $syllabusDate;
        $data['ajaxResponse'] = 1;
        $msg                  = $this->load->view("parent/student/getassignment_table", $data, true);
//         $msg= $this->load->view("parent/student/views/assignments", $data, true);
        echo $msg;

//        echo json_encode($syllabusDate);
    }

    function getVocation($student_id)
    {
        $this->session->set_userdata('top_menu', 'Vocation');
        $this->session->set_userdata('sub_menu', 'parent/parents/Vocation');

        $student         = $this->student_model->get($student_id);
        $vocationSubject = $this->vocation_model->getListBySubject($student['class_id'], $student['section_id']);

        // foreach($vocationSubject as $key => $subject){
        //     $vocationDate[$subject['subject']] =  $this->vocation_model->getListByDate($student['class_id'],$student['section_id'], $subject['subject_id']);
        // }
        // $vocation = array();
        // foreach($vocationDate as $key => $dates){
        //     foreach($dates as $date){
        //         $vocation[$key] =  $this->vocation_model->get(null, null,$student['class_id'],$student['section_id'],$date['date'], $date['subject_id']);
        //     }    
        // }
        $subjects = $this->vocation_model->getListBySubject($student['class_id'], $student['section_id']);

        foreach ($subjects as $key => $subject) {
            $vocationOf[$subject['subject']] = $this->vocation_model->getListByDate($student['class_id'], $student['section_id'], $subject['subject_id']);
        }
        $data['student']  = $student;
        $data['vocation'] = $vocationOf;

        $this->load->view('layout/parent/header', $data);
        $this->load->view('parent/student/getvocation', $data);
        $this->load->view('layout/parent/footer', $data);
    }

    function getyoutube($student_id)
    {
        $this->session->set_userdata('top_menu', 'Youtube');
        $this->session->set_userdata('sub_menu', 'parent/parents/Youtube');

        $student = $this->student_model->get($student_id);

        $vocationSubject = $this->youtube_model->getListBySubject($student['class_id'], $student['section_id']);

        foreach ($vocationSubject as $key => $subject) {
            $vocationDate[$subject['subject']] = $this->youtube_model->getListByDate($student['class_id'], $student['section_id'], $subject['subject_id']);
        }


        $data['student']  = $student;
        $data['vocation'] = $vocationDate;

        $this->load->view('layout/parent/header', $data);
        $this->load->view('parent/student/getyoutube', $data);
        $this->load->view('layout/parent/footer', $data);
    }

    function getSyllabus($student_id)
    {
        $this->session->set_userdata('top_menu', 'Syllabus');
        $this->session->set_userdata('sub_menu', 'parent/parents/Syllabus');
        $student         = $this->student_model->get($student_id);
        $syllabusSubject = $this->syllabus_model->getListBySubject($student['class_id'], $student['section_id']);
        // foreach($syllabusSubject as $key => $subject){
        //     $syllabusDate[$subject['subject']] =  $this->syllabus_model->getListByDate($student['class_id'],$student['section_id'], $subject['subject_id']);
        // }
        // $syllabus = array();
        // foreach($syllabusDate as $key => $dates){
        //     foreach($dates as $date){
        //         $syllabus[$key] =  $this->syllabus_model->get(null, null,$student['class_id'],$student['section_id'],$date['date'], $date['subject_id']);
        //     }    
        // }

        $subjects = $this->syllabus_model->getListBySubject($student['class_id'], $student['section_id']);

        foreach ($subjects as $key => $subject) {
            $syllabusOf[$subject['subject']] = $this->syllabus_model->getListByDate($student['class_id'], $student['section_id'], $subject['subject_id']);
            // echo "<div class='container'><pre>";
            // print_r($syllabusOf);
            // echo "</pre></div>";
        }

        // echo "<div class='container'><pre>";
        // print_r($syllabusOf);
        // echo "</pre></div>";


        $data['student']  = $student;
        $data['syllabus'] = $syllabusOf;
        $this->load->view('layout/parent/header', $data);
        $this->load->view('parent/student/getsyllabus', $data);
        $this->load->view('layout/parent/footer', $data);
    }

    function getfees($id)
    {
        $this->session->set_userdata('top_menu', 'Fees');
        $this->session->set_userdata('sub_menu', 'parent/parents/getFees');
        $paymentoption                = $this->customlib->checkPaypalDisplay();
        $data['paymentoption']        = $paymentoption;
        $student_id                   = $id;
        $student                      = $this->student_model->get($student_id);
        $class_id                     = $student['class_id'];
        $section_id                   = $student['section_id'];
        $data['title']                = 'Student Details';
        $student_due_fee              = $this->studentfeemaster_model->getStudentFees($student['student_session_id']);
        $student_discount_fee         = $this->feediscount_model->getStudentFeesDiscount($student['student_session_id']);
        $data['student_discount_fee'] = $student_discount_fee;
        $data['student_due_fee']      = $student_due_fee;
        $data['student']              = $student;
        $this->load->view('layout/parent/header', $data);
        $this->load->view('parent/student/getfees', $data);
        $this->load->view('layout/parent/footer', $data);
    }

    function gettimetable($id)
    {
        $this->session->set_userdata('top_menu', 'Time Table');
        $this->session->set_userdata('sub_menu', 'parent/parents/gettimetable');
        $student_id              = $id;
        $student                 = $this->student_model->get($student_id);
        $class_id                = $student['class_id'];
        $section_id              = $student['section_id'];
        $data['title']           = 'Student Details';
        $result_subjects         = $this->teachersubject_model->getSubjectByClsandSection($class_id, $section_id);
        $getDaysnameList         = $this->customlib->getDaysname();
        $data['getDaysnameList'] = $getDaysnameList;

        $final_array = array();
        if (!empty($result_subjects)) {
            foreach ($getDaysnameList as $day_key => $day_value) {

                if ($day_value !== "Sunday") {
                    foreach ($result_subjects as $subject_k => $subject_v) {


                        $where_array = array(
                            'teacher_subject_id' => $subject_v['id'],
                            'day_name'           => $day_value
                        );
                        $result      = $this->timetable_model->get($where_array);
                        if (!empty($result)) {
                            $obj             = new stdClass();
                            $obj->status     = "Yes";
                            $obj->start_time = $result[0]['start_time'];
                            $obj->end_time   = $result[0]['end_time'];
                            $obj->room_no    = $result[0]['room_no'];
                            $teacher_id      = $this->teachersubject_model->get($result[0]['teacher_subject_id']);
                            $teacher_details = $this->teacher_model->get($teacher_id['teacher_id']);
                            $obj->teacher    = $teacher_details;


                            $result_array[$subject_v['name']] = $obj;

                        } else {
                            $obj                              = new stdClass();
                            $obj->status                      = "No";
                            $obj->start_time                  = "N/A";
                            $obj->end_time                    = "N/A";
                            $obj->room_no                     = "N/A";
                            $result_array[$subject_v['name']] = $obj;
                        }
                    }
                    $final_array[$day_value] = $result_array;
                }

            }
        }
        $data['result_array'] = $final_array;
        $data['student']      = $student;
        $this->load->view('layout/parent/header', $data);
        $this->load->view('parent/student/gettimetable', $data);
        $this->load->view('layout/parent/footer', $data);
    }

    function getsubject($id)
    {
        $this->session->set_userdata('top_menu', 'Subjects');
        $this->session->set_userdata('sub_menu', 'parent/parents/getsubject');
        $student_id           = $id;
        $student              = $this->student_model->get($student_id);
        $data['student']      = $student;
        $class_id             = $student['class_id'];
        $section_id           = $student['section_id'];
        $data['title']        = 'Student Details';
        $subject_list         = $this->teachersubject_model->getSubjectByClsandSection($class_id, $section_id);
        $data['result_array'] = $subject_list;
        $this->load->view('layout/parent/header', $data);
        $this->load->view('parent/student/getsubject', $data);
        $this->load->view('layout/parent/footer', $data);
    }

    function getattendence($id)
    {
        $this->session->set_userdata('top_menu', 'Attendance');
        $this->session->set_userdata('sub_menu', 'parent/parents/getattendence');
        $student_id            = $id;
        $session_current       = $this->setting_model->getCurrentSessionName();
        $startMonth            = $this->setting_model->getStartMonth();
        $centenary             = substr($session_current, 0, 2); //2017-18 to 2017
        $year_first_substring  = substr($session_current, 2, 2); //2017-18 to 2017
        $year_second_substring = substr($session_current, 5, 2); //2017-18 to 18
        $month                 = date('F', now());


        $data['month_selected'] = $month;
        $month_number[]         = array();

        for ($m = 1; $m < 13; $m++):

            $month_number = str_pad($m, 2, 0, STR_PAD_LEFT);

        endfor;

        if ($month_number >= $startMonth && $month_number <= 12) {
            $year = $centenary . $year_first_substring;
        } else {
            $year = $centenary . $year_second_substring;
        }
        $year             = date('Y', now());
        $attr_result      = array();
        $attendence_array = array();
        $student_result   = array();

        $attendance_dates = [];

        $month_number2 = date('m', now());

        $num_of_days = cal_days_in_month(CAL_GREGORIAN, $month_number2, $year);

        for ($day_number = 1; $day_number <= $num_of_days; $day_number++) {
            $attendance_dates[] = "{$year}-{$month}-{$day_number}";
        }


        for ($m = 1; $m < 13; $m++):
            $students[$m]['day_attendance'] = array();
            $annual                         = $m;
            for ($i = 1; $i <= $num_of_days; $i++) {
                $att_date                                  = $year . "-" . $annual . "-" . sprintf("%02d", $i);
                $attendence_array[]                        = $att_date;
                $students[$m]['day_attendance'][$att_date] = $this->stuattendence_model->searchAttendencestudent($id, $att_date);
            }
        endfor;

        $student_details          = $this->student_model->getstudents($id);
        $data['year']             = $year;
        $data['student_details']  = $student_details;
        $data['resultlist']       = $students;
        $data['attendence_array'] = $attendance_dates;
        $student                  = $this->student_model->get($student_id);
        $data['student']          = $student;
        $this->load->view('layout/parent/header', $data);
        $this->load->view('parent/student/getattendence', $data);
        $this->load->view('layout/parent/footer', $data);
    }

    function getdiscount($id)
    {
        $this->session->set_userdata('top_menu', 'Attendance');
        $this->session->set_userdata('sub_menu', 'parent/parents/getattendence');
        $student_id = $id;

        $discount_history = $this->student_model->get_discount($student_id);

        $data['discount_history'] = $discount_history;
        $student                  = $this->student_model->get($student_id);
        $data['student']          = $student;
        $this->load->view('layout/parent/header', $data);
        $this->load->view('parent/student/getdiscount', $data);
        $this->load->view('layout/parent/footer', $data);
    }

    function getgraph($id)
    {
        $this->session->set_userdata('top_menu', 'Attendance');
        $this->session->set_userdata('sub_menu', 'parent/parents/getattendence');
        $student_id             = $id;
        $session_current        = $this->setting_model->getCurrentSessionName();
        $startMonth             = $this->setting_model->getStartMonth();
        $centenary              = substr($session_current, 0, 2); //2017-18 to 2017
        $year_first_substring   = substr($session_current, 2, 2); //2017-18 to 2017
        $year_second_substring  = substr($session_current, 5, 2); //2017-18 to 18
        $data['student_doc_id'] = $student_id;
        $month_number[]         = array();

        for ($m = 1; $m < 13; $m++):

            $month_number = str_pad($m, 2, 0, STR_PAD_LEFT);

        endfor;

        $year = $centenary . $year_second_substring;

        $data['year'] = $year;

        $student         = $this->student_model->get($student_id);
        $data['student'] = $student;
        $this->load->view('layout/parent/header', $data);
        $this->load->view('parent/student/getgraph', $data);
        $this->load->view('layout/parent/footer', $data);
    }

    function getfeeHistory($id)
    {
        $this->session->set_userdata('top_menu', 'Attendance');
        $this->session->set_userdata('sub_menu', 'parent/parents/getattendence');
        $student         = $this->student_model->get($id);
        $data['student'] = $student;
        $this->load->view('layout/parent/header', $data);
        $this->load->view('parent/student/getfeehistory', $data);
        $this->load->view('layout/parent/footer', $data);
    }

    public function transaction_history()
    {

        $student_id             = intval($this->input->get("student_id"));
        $student_fee_payments   = $this->student_fee_payments->get(null, $student_id, 20);
        $data                   = [];
        $total_tuition1         = 0;
        $total_paid             = 0;
        $total_other_paid       = 0;
        $total_tuition1_waive   = 0;
        $total_other_paid_waive = 0;
        $this->load->helper('menu_helper');
        $admind     = $this->session->userdata('admin');
        $permission = admin_permission($admind['id']);

        foreach ($student_fee_payments as $key => $r) {

            $fee     = $r->total_fee + $r->arrears;
            $voucher = '<a class="btn btn-default btn-xs"  href="' . base_url('fee_management/print_fee_payment_receipt/' . $r['id']) . '" target="_blank"> <i class="fa fa-print"></i></a>';

            $current_date = date("Y-m-d", now());
            $payment_date = date('Y-m-d', strtotime($r['payment_date']));
            $delete       = '';
            if (($payment_date == $current_date && $permission->daily_delete == 1) || $permission->payment_delete == 1) {
                $delete = '<a href="" class="btn btn-default btn-xs delete_payment" data-payment="' . $r['id'] . '" title="Delete"  > <i class="fa fa-trash-alt"></i></a>';
            }

            $action           = $voucher . " " . $delete;
            $payment_date     = date('d-M-y', strtotime($r['payment_date']));
            $late_payment_fee = $this->student_fee_payments_other->get_by_feename('Fine for late fee payment', $r['id']);
            if ($r['fine_check'] == 0) {
                $fine1 = $r['fine'];
            } else {
                if ($r['paid_fine'] <= $r['fine']) {
                    $fine1 = $r['fine'] - $r['paid_fine'];
                } else {
                    $fine1 = $r['fine'];
                }
            }
            $other_waive = [];
            $name        = [];
            $total_waive = 0;
            $total_      = 0;
            if ($r['voucher_id'] == "1") {
                $fee_waive   = $r['tuition_fee'];
                $tuition_fee = 0;
                foreach ($r['other_fee_payments'] as $key => $other) {
                    if (intval($other['amount']) > 0) {
                        $other_waive[] = $other['fee_name'] . '<br>';
                    }
                    $total_waive += $other['amount'];
                }
            } else {
                $fee_waive   = 0;
                $tuition_fee = $r['tuition_fee'];
                $total_      = $r['total_paid_fee'];
                $total_fee   = 0;
                foreach ($r['other_fee_payments'] as $key => $other) {
                    if (intval($other['amount']) > 0) {
                        $name[] = $other['fee_name'] . '<br>';
                    }
                    $total_fee += $other['amount'];
                }
            }

            if ($r['fine_check'] == 0 && $r['fine'] > 0 or $r['paid_fine'] < $r['fine']) {

                if ($r['paid_fine'] < $r['fine']) {
                    $other_waive[] = "Fine for late fee Payment";
                    $total_waive   = $total_waive + $r['fine'] - $r['paid_fine'];
                } else {
                    $other_waive[] = "Fine for late fee Payment";


                    $total_waive = $total_waive + $r['fine'];
                }

            }

            $vocher_details = $this->student_fee_voucher_model->get($r['voucher_id']);


            if ($r['reprint_waive'] > 0) {
                $other_waive[] = "Voucher Reprint Fee";
                $total_waive   = $total_waive + $r['reprint_waive'];
            }
            if ($r['tuition_fee'] == 0) {
                $t_due_fee   = 0;
                $arrears     = 0;
                $reprint_fee = 0;
                $balance     = 0;
            } else {
                $reprint_fee = $r['reprint_fee'] + $r['reprint_waive'];
                $t_due_fee   = number_format($vocher_details['monthly_fee']);
                $arrears     = number_format($vocher_details['arrears']);
                $balance     = number_format($r['due_fee'] - $r['total_paid_fee'] - $fine1 + $r['reprint_fee']);
            }
            $total_paid             += $total_;
            $total_tuition1         += $vocher_details['monthly_fee'];
            $total_other_paid       += $total_fee;
            $total_tuition1_waive   += $fee_waive;
            $total_other_paid_waive += $total_waive;
            $total_reprint          += $reprint_fee;
            $total_fine_due         += $r['fine'];
            $total_arrears          += $vocher_details['arrears'];
            $total_due_fee          += $r['due_fee'];
            $total_paid_fee         += $tuition_fee;


            $data[] = array(
                $payment_date,
                $r['user_id'],
                $r['voucher_id'],
                $t_due_fee,
                $arrears,
                $r['fine'],
                $reprint_fee,
                number_format($r['due_fee']),
                number_format($tuition_fee),
                $r['fee_description'],
                $fee_waive,
                $balance,
                $name,
                number_format($total_fee),
                $other_waive,
                number_format($total_waive),
                number_format($total_),
                $action,
            );


        }
        //exit;
        $data[] = array(
            'Total',
            '',
            '',
            number_format($total_tuition1),
            number_format($total_arrears),
            number_format($total_fine_due),
            number_format($total_reprint),
            number_format($total_due_fee),
            number_format($total_paid_fee),
            '',
            number_format($total_tuition1_waive),
            '',
            '',
            number_format($total_other_paid),
            '',
            number_format($total_other_paid_waive),
            number_format($total_paid),
            '',
        );


        $result = array(
            "draw"            => '',
            "recordsTotal"    => '',
            "recordsFiltered" => '',
            "data"            => $data
        );


        echo json_encode($result);
        exit();
    }

    function getduefee($id)
    {

        $id      = $this->customlib->getStudentSessionUserID();
        $student = $this->student_model->get($id);

        $sibling_type = $this->custom_option_model->get('sibling_type');

        if ($sibling_type['value'] == "phone_sibling" && $student['father_phone'] != null) {

            $children = $this->student_model->family_children($student['father_phone'], null);

        } elseif ($sibling_type['value'] == "cnic_sibling" && $student['father_cnic'] != null) {

            $children = $this->student_model->family_children(null, $student['father_cnic']);

        }


        if ($children === null) {
            show_404('Page you are trying to access does not exists!');
        } else {
            $data = [
                'title' => "Family children details"
            ];

            $data['children2'] = $children;
            if (date('m', now()) > '2') {
                $start = 1;
                $end   = 13;
            } else {
                $start = 3;
                $end   = 15;
            }
            for ($i = 0; $i < count($children); $i++) {
                $children[$i]['voucher_id'] = $this->student_fee_voucher_model->get_unpaid_sibling($children[$i]['id'], null);
                for ($j = $start; $j < $end; $j++) {
                    $year_child = date('Y', now());
                    if ($j >= 13) {
                        $annual_child = $j - 12;
                    } elseif ($j <= 12) {
                        if (date('m', now()) > '2') {
                            $year_child = date('Y', now());
                        } else {
                            $year_child = date("Y", strtotime("-1 year"));
                        }
                        $annual_child = str_pad($j, 2, 0, STR_PAD_LEFT);
                    }
                    $data3                                    = [
                        'year'  => "{$year_child}",
                        'month' => "{$annual_child}",
                    ];
                    $children[$i]['advance'][$j]              = $this->student_model->get_advance_annual_sibling($children[$i]['id'], $data3);
                    $children[$i]['tuition'][$annual_child]   = $this->student_fee_payments->get_total_received_fee_per_month2("{$year_child}-{$annual_child}-01", $children[$i]['id']);
                    $children[$i]['other_fee'][$annual_child] = $this->student_fee_payments_other->sum_by_month2("{$year_child}-{$annual_child}-01", $children[$i]['id']);
                }
                $children[$i]['other_fee_due'] = $this->student_fee_voucher_model->get_unpaid_other2($children[$i]['id']);
            }

            $data['children'] = $children;


            $this->load->view('layout/parent/header', $data);
            $this->load->view('parent/student/children_summary', $data);
            $this->load->view('layout/parent/footer', $data);

        }
    }

    public function dateSheet($exam_id)
    {

        $this->session->set_userdata('top_menu', 'Academics');
        $this->session->set_userdata('sub_menu', 'classes/assign_class_incharge');


        if ($exam_id == null) {

            $exam_id = $this->input->post('exam_id');

        }


        $select_exam_detail = $this->exam_model->get($exam_id);
        $exam               = $this->examschedule_model->getDetailbyClsandSection_exam($exam_id);

        $exam_detail = $this->exam_model->get();
        for ($k = 1; $k < count($exam); $k++) {
            $class = $this->class_model->get();
            for ($i = 0; $i < count($class); $i++) {
                $class_section = $this->classsection_model->get($class[$i]['id']);
                for ($j = 0; $j < count($class_section); $j++) {
                    $examSchedule[$exam[$k]['date_of_exam']][$i][$j] = $this->examschedule_model->getDetailbyClsandSectionbydate($class[$i]['id'], $class_section[$j]['section_id'], $exam_id, $exam[$k]['date_of_exam']);
                }
            }
        }

        // echo "<pre>";
        // print_r($examSchedule);
        // echo "</pre>";
        // exit;
        $data['examschedule']       = $examSchedule;
        $data['classlist']          = $class;
        $data['exam']               = $exam_detail;
        $data['select_exam_detail'] = $select_exam_detail;


        $this->load->view('layout/parent/header', $data);
        $this->load->view('parent/student/date_sheet', $data);
        $this->load->view('layout/parent/footer', $data);

    }


    public function getAjaxAttendence()
    {
        $year                 = $this->input->get('year');
        $month                = $this->input->get('month');
        $student_session_id   = $this->input->get('student_session');
        $result               = array();
        $new_date             = "01-" . $month . "-" . $year;
        $totalDays            = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $first_day_this_month = date('01-m-Y');
        $fst_day_str          = strtotime(date($new_date));
        $array                = array();
        for ($day = 2; $day <= $totalDays; $day++) {
            $fst_day_str        = ($fst_day_str + 86400);
            $date               = date('Y-m-d', $fst_day_str);
            $student_attendence = $this->attendencetype_model->getStudentAttendence($date, $student_session_id);
            if (!empty($student_attendence)) {
                $s           = array();
                $s['date']   = $date;
                $s['badge']  = false;
                $s['footer'] = "Extra information";
                $s['body']   = "Information for this date<\/p>You can add html<\/strong> in this block<\/p>";
                $type        = $student_attendence->type;
                $s['title']  = $type;
                if ($type == 'Present') {
                    $s['classname'] = "grade-4";
                } else if ($type == 'Absent') {
                    $s['classname'] = "grade-1";
                } else if ($type == 'Late') {
                    $s['classname'] = "grade-3";
                } else if ($type == 'Late with excuse') {
                    $s['classname'] = "grade-2";
                } else if ($type == 'Holiday') {
                    $s['classname'] = "grade-5";
                }
                $array[] = $s;
            }
        }
        if (!empty($array)) {
            echo json_encode($array);
        } else {
            echo false;
        }
    }

    function getexams($id)
    {
        $this->session->set_userdata('top_menu', 'Examination');
        $this->session->set_userdata('sub_menu', 'parent/parents/getexams');
        $student_id           = $id;
        $student              = $this->student_model->get($student_id);
        $class_id             = $student['class_id'];
        $section_id           = $student['section_id'];
        $data['title']        = 'Student Details';
        $gradeList            = $this->grade_model->get();
        $data['gradeList']    = $gradeList;
        $examList             = $this->examschedule_model->getExamByClassandSection($student['class_id'], $student['section_id']);
        $data['examSchedule'] = array();
        if (!empty($examList)) {
            $new_array = array();
            foreach ($examList as $ex_key => $ex_value) {
                $array         = array();
                $x             = array();
                $exam_id       = $ex_value['exam_id'];
                $exam_subjects = $this->examschedule_model->getresultByStudentandExam($exam_id, $student['id']);

                foreach ($exam_subjects as $key => $value) {
                    $exam_array                     = array();
                    $exam_array['exam_schedule_id'] = $value['exam_schedule_id'];
                    $exam_array['exam_id']          = $value['exam_id'];
                    $exam_array['full_marks']       = $value['max_marks'];
                    $exam_array['passing_marks']    = $value['passing_marks'];
                    $exam_array['exam_name']        = $value['name'];
                    $exam_array['exam_type']        = $value['type'];
                    $exam_array['attendence']       = $value['attendence'];
                    $exam_array['get_marks']        = $value['get_marks'];
                    $x[]                            = $exam_array;
                }
                $array['exam_name']   = $ex_value['name'];
                $array['exam_result'] = $x;
                $new_array[]          = $array;
            }
            $data['examSchedule'] = $new_array;
        }
        $data['student'] = $student;
        $this->load->view('layout/parent/header', $data);
        $this->load->view('parent/student/getexams', $data);
        $this->load->view('layout/parent/footer', $data);
    }

    function getexamresult()
    {
        $student_id        = $this->uri->segment('4');
        $exam_id           = $this->uri->segment('5');
        $student           = $this->student_model->get($student_id);
        $class_id          = $student['class_id'];
        $section_id        = $student['section_id'];
        $data['title']     = 'Exam Result';
        $data['student']   = $student;
        $new_array         = array();
        $array             = array();
        $x                 = array();
        $exam_detail_array = $this->exam_model->get($exam_id);
        $exam_subjects     = $this->examschedule_model->getresultByStudentandExam($exam_id, $student_id);
        foreach ($exam_subjects as $key => $value) {
            $exam_array                     = array();
            $exam_array['exam_schedule_id'] = $value['exam_schedule_id'];
            $exam_array['exam_id']          = $value['exam_id'];
            $exam_array['full_marks']       = $value['full_marks'];
            $exam_array['passing_marks']    = $value['passing_marks'];
            $exam_array['exam_name']        = $value['name'];
            $exam_array['exam_type']        = $value['type'];
            $exam_array['attendence']       = $value['attendence'];
            $exam_array['get_marks']        = $value['get_marks'];
            $x[]                            = $exam_array;
        }
        $array['exam_name']   = $exam_detail_array['name'];
        $array['exam_result'] = $x;
        $new_array[]          = $array;
        $data['examSchedule'] = $new_array;
        $this->load->view('layout/parent/header', $data);
        $this->load->view('parent/student/examresult', $data);
        $this->load->view('layout/parent/footer', $data);
    }

    function getexamtimetable()
    {
        $data['title']        = 'Student Details';
        $class_id             = $this->uri->segment('4');
        $section_id           = $this->uri->segment('5');
        $exam_id              = $this->uri->segment('6');
        $examSchedule         = $this->examschedule_model->getDetailbyClsandSection($class_id, $section_id, $exam_id);
        $data['examSchedule'] = $examSchedule;
        $exam_detail_array    = $this->exam_model->get($exam_id);
        $data['exam_name']    = $exam_detail_array['name'];
        $this->load->view('layout/parent/header', $data);
        $this->load->view('parent/student/examtimetable', $data);
        $this->load->view('layout/parent/footer', $data);
    }

}

?>