<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class mark extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->load->helper('file');
        $this->lang->load('message', 'english');
        $this->load->library('auth');
        $this->auth->is_logged_in_teacher();
    }


    function index()
    {
        $this->session->set_userdata('top_menu', 'Examinations');
        $this->session->set_userdata('sub_menu', 'exam/index');
        $data['title']      = '';
        $data['title_list'] = 'Exam List';
        $examid             = $this->input->post_get('exam_id');
        $data['exam_id']    = $examid == null ? -1 : $examid;

        $exam_result         = $this->exam_model->get();
        $data['examlist']    = $exam_result;
        $school_logo         = $this->setting_model->getCurrentImage();
        $data['school_logo'] = $school_logo;
        $school_name         = $this->setting_model->getCurrentSchoolName();
        $data['school_name'] = $school_name;

        if (!empty($examid)) {
            $exam_name        = $this->exam_model->get($examid);
            $data['examname'] = $exam_name['name'];
        }

        $this->load->view('layout/teacher/header', $data);
        $this->load->view('teacher/mark/examList', $data);
        $this->load->view('layout/teacher/footer', $data);
    }

    public function examclass()
    {

        $data['exam_id'] = $this->input->get('exam_id');
        $teacher_id      = $this->session->userdata['student']['teacher_id'];
        $class_sections  = $this->classsection_model->get_teacher_class($teacher_id);
// /pp($class_sections);

        $data['class_sections'] = $class_sections;

        $exam_result         = $this->exam_model->get();
        $data['examlist']    = $exam_result;
        $school_logo         = $this->setting_model->getCurrentImage();
        $data['school_logo'] = $school_logo;
        $school_name         = $this->setting_model->getCurrentSchoolName();
        $data['school_name'] = $school_name;

        if (!empty($data['exam_id'])) {
            $exam_name        = $this->exam_model->get($data['exam_id']);
            $data['examname'] = $exam_name['name'];
        }
        $this->load->view('layout/teacher/header', $data);
        $this->load->view('teacher/mark/examList', $data);
        $this->load->view('layout/teacher/footer', $data);
    }

    function getexamscheduledetail()
    {
        $exam_id      = $this->input->post('exam_id');
        $section_id   = $this->input->post('section_id');
        $class_id     = $this->input->post('class_id');
        $examSchedule = $this->examschedule_model->getDetailbyClsandSection($class_id, $section_id, $exam_id);
        echo json_encode($examSchedule);
    }

    function index1()
    {
        $this->session->set_userdata('top_menu', 'Examinations');
        $this->session->set_userdata('sub_menu', 'mark/index');

        $exam_id    = $this->input->get('exam_id');
        $class_id   = $this->input->get('class_id');
        $section_id = $this->input->get('section_id');
        if (!empty($exam_id)) {
            $exam_name        = $this->exam_model->get($exam_id);
            $data['examname'] = $exam_name['name'];
        }
        if (!empty($class_id)) {
            $class_name = $this->class_model->get($class_id);

            $data['class'] = $class_name['class'];
        }
        if (!empty($section_id)) {
            $section_name = $this->section_model->get($section_id);

            $data['section'] = $section_name['section'];
        }
        $teacher_id         = $this->session->userdata['student']['teacher_id'];
        $data['exam_id']    = $exam_id;
        $data['class_id']   = $class_id;
        $data['section_id'] = $section_id;
        $examSchedule       = $this->examschedule_model->getDetailbyClsandSectionTeacher($class_id, $section_id, $exam_id, $teacher_id);

        $listgrade         = $this->grade_model->get();
        $data['listgrade'] = $listgrade;


        $studentList          = $this->student_model->searchByClassSection($class_id, $section_id);
        $data['examSchedule'] = array();
        if (!empty($examSchedule)) {
            $new_array                      = array();
            $data['examSchedule']['status'] = "yes";
            foreach ($studentList as $stu_key => $stu_value) {
                $array                 = array();
                $array['student_id']   = $stu_value['id'];
                $array['roll_no']      = $stu_value['roll_no'];
                $array['firstname']    = $stu_value['firstname'];
                $array['lastname']     = $stu_value['lastname'];
                $array['admission_no'] = $stu_value['admission_no'];
                $array['dob']          = $stu_value['dob'];
                $array['father_name']  = $stu_value['father_name'];
                $x                     = array();
                foreach ($examSchedule as $ex_key => $ex_value) {
                    $exam_array                     = array();
                    $exam_array['exam_schedule_id'] = $ex_value['id'];
                    $exam_array['exam_id']          = $ex_value['exam_id'];
                    $exam_array['full_marks']       = $ex_value['full_marks'];
                    $exam_array['passing_marks']    = $ex_value['passing_marks'];
                    $exam_array['exam_name']        = $ex_value['name'];
                    $exam_array['exam_type']        = $ex_value['type'];
                    $student_exam_result            = $this->examresult_model->get_result($ex_value['id'], $stu_value['id']);

                    if (empty($student_exam_result)) {


                    } else {
                        $exam_array['attendence'] = $student_exam_result->attendence;
                        $exam_array['get_marks']  = $student_exam_result->get_marks;
                    }
                    $x[] = $exam_array;
                }
                if (empty($x)) {
                    $data['examSchedule']['status'] = "no";
                }
                $array['exam_array'] = $x;
                $new_array[]         = $array;
            }

            $data['examSchedule']['result'] = $new_array;
        } else {
            $s                    = array('status' => 'no');
            $data['examSchedule'] = $s;
        }
        $this->load->view('layout/teacher/header', $data);
        $this->load->view('teacher/mark/markList1', $data);
        $this->load->view('layout/teacher/footer', $data);

    }

    function view($id)
    {
        $data['title'] = 'Mark List';
        $mark          = $this->mark_model->get($id);
        $data['mark']  = $mark;
        $this->load->view('layout/teacher/header', $data);
        $this->load->view('teacher/mark/markShow', $data);
        $this->load->view('layout/teacher/footer', $data);
    }

    function delete($id)
    {
        $data['title'] = 'Mark List';
        $this->mark_model->remove($id);
        redirect('teacher/admin/mark/index');
    }

    function create()
    {

        $exam_id    = $this->input->get('exam_id');
        $class_id   = $this->input->get('class_id');
        $section_id = $this->input->get('section_id');
        if (!empty($exam_id)) {
            $exam_name        = $this->exam_model->get($exam_id);
            $data['examname'] = $exam_name['name'];
        }
        if (!empty($class_id)) {
            $class_name    = $this->class_model->get($class_id);
            $data['class'] = $class_name['class'];
        }
        if (!empty($section_id)) {
            $section_name    = $this->section_model->get($section_id);
            $data['section'] = $section_name['section'];
        }
        $teacher_id           = $this->session->userdata['student']['teacher_id'];
        $data['exam_id']      = $exam_id;
        $data['class_id']     = $class_id;
        $data['section_id']   = $section_id;
        $examSchedule         = $this->examschedule_model->getDetailbyClsandSectionTeacher($class_id, $section_id, $exam_id, $teacher_id);
        $studentList          = $this->student_model->searchByClassSection($class_id, $section_id);
        $data['examSchedule'] = array();
        if (!empty($examSchedule)) {
            $new_array = array();
            foreach ($studentList as $stu_key => $stu_value) {
                $array                 = array();
                $array['student_id']   = $stu_value['id'];
                $array['admission_no'] = $stu_value['admission_no'];
                $array['roll_no']      = $stu_value['roll_no'];
                $array['firstname']    = $stu_value['firstname'];
                $array['lastname']     = $stu_value['lastname'];
                $array['dob']          = $stu_value['dob'];
                $array['father_name']  = $stu_value['father_name'];
                $x                     = array();
                foreach ($examSchedule as $ex_key => $ex_value) {
                    $exam_array                     = array();
                    $exam_array['exam_schedule_id'] = $ex_value['id'];
                    $exam_array['exam_id']          = $ex_value['exam_id'];
                    $exam_array['full_marks']       = $ex_value['full_marks'];
                    $exam_array['passing_marks']    = $ex_value['passing_marks'];
                    $exam_array['exam_name']        = $ex_value['name'];
                    $exam_array['exam_type']        = $ex_value['type'];
                    $student_exam_result            = $this->examresult_model->get_exam_result($ex_value['id'], $stu_value['id']);
                    $exam_array['attendence']       = $student_exam_result->attendence;
                    $exam_array['get_marks']        = $student_exam_result->get_marks;
                    $x[]                            = $exam_array;
                }
                $array['exam_array'] = $x;
                $new_array[]         = $array;
            }
            $data['examSchedule'] = $new_array;
        }
        if ($this->input->post('save_exam') == "save_exam") {
            $student_array = $this->input->post('student');
            $exam_array    = $this->input->post('exam_schedule');
            foreach ($student_array as $key => $student) {
                foreach ($exam_array as $key => $exam) {
                    $record['get_marks']  = 0;
                    $record['attendence'] = "pre";
                    if ($this->input->post('student_absent' . $student . "_" . $exam) == "") {
                        $record['get_marks'] = $this->input->post('student_number' . $student . "_" . $exam);
                    } else {
                        $record['attendence'] = $this->input->post('student_absent' . $student . "_" . $exam);
                    }
                    $record['exam_schedule_id'] = $exam;
                    $record['student_id']       = $student;
                    $this->examresult_model->add_exam_result($record);
                }
            }
            redirect('teacher/mark');
        }
        $this->load->view('layout/teacher/header', $data);
        $this->load->view('teacher/mark/markCreate', $data);
        $this->load->view('layout/teacher/footer', $data);

    }

    function edit($id)
    {
        $data['title'] = 'Edit Mark';
        $data['id']    = $id;
        $mark          = $this->mark_model->get($id);
        $data['mark']  = $mark;
        $this->form_validation->set_rules('name', 'Mark', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/teacher/header', $data);
            $this->load->view('teacher/mark/markEdit', $data);
            $this->load->view('layout/teacher/footer', $data);
        } else {
            $data = array(
                'id'   => $id,
                'name' => $this->input->post('name'),
                'note' => $this->input->post('note'),
            );
            $this->mark_model->add($data);
            $this->session->set_flashdata('msg', '<div mark="alert alert-success text-center">Employee details added to Database!!!</div>');
            redirect('teacher/mark/index');
        }
    }

}

?>