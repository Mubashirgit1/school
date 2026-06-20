<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mark extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('file');
        $this->lang->load('message', 'english');
    }

    function index() {
        $this->session->set_userdata('top_menu', 'Examinations');
        $this->session->set_userdata('sub_menu', 'mark/index');
        $session                    = $this->setting_model->getCurrentSession();
        $data['title']              = 'Exam Marks';
        $data['exam_id']            = "";
        $data['class_id']           = "";
        $data['section_id']         = "";
        $exam_id                    = $this->input->post_get('exam_id');
        $class_id                   = $this->input->post_get('class_id');
        $section_id                 = $this->input->post_get('section_id');
        $session_id                 = $this->input->post_get('session_id');

        if (!isset($exam_id)) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger text-left">Please Select Exam First</div>');
            redirect('admin/exam');
        }


        $exam                       = $this->exam_model->get($exam_id);
        $class                      = $this->class_model->get();
        $data['examlist']           = $exam;
        $data['classlist']          = $class;
        $feecategory                = $this->feecategory_model->get();
        $data['feecategorylist']    = $feecategory;
        $class_sections             = $this->classsection_model->class_sections(null,$class_id,$section_id);
        $this->form_validation->set_rules('exam_id', 'Exam', 'trim|required|xss_clean');
        $this->form_validation->set_rules('class_id', 'Class', 'trim|required|xss_clean');
        $this->form_validation->set_rules('section_id', 'Section', 'trim|required|xss_clean');

        if ($this->form_validation->run() == FALSE && ( empty($exam_id) && empty($class_id) && empty($section_id) )) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/mark/markList', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $feecategory_id         = $this->input->post('feecategory_id');
            $data['exam_id']        = $exam_id;
            $data['class_id']       = $class_id;
            $data['section_id']     = $section_id;
            $data['class_sections'] = $class_sections;

            $examSchedule           = $this->examschedule_model->getDetailbyClsandSection($class_id, $section_id, $exam_id,$session_id);



            $studentList            = $this->student_model->searchByClassSection($class_id, $section_id ,null,null,null,null,$session_id);
            $data['examSchedule']   = array();
            if (!empty($examSchedule)) {
                $new_array = array();
                $data['examSchedule']['status'] = "yes";
                foreach ($studentList as $stu_key => $stu_value) {
                    $array = array();
                    $array['student_id']    = $stu_value['id'];
                    $array['roll_no']       = $stu_value['roll_no'];
                    $array['firstname']     = $stu_value['firstname'];
                    $array['lastname']      = $stu_value['lastname'];
                    $array['admission_no']  = $stu_value['admission_no'];
                    $array['dob']           = $stu_value['dob'];
                    $array['father_name']   = $stu_value['father_name'];
                    $x = array();
                    foreach ($examSchedule as $ex_key => $ex_value) {
                        $session_result = $this->session_model->get($ex_value['session_id']);
                        $exam_array = array();
                        $exam_array['exam_schedule_id'] = $ex_value['id'];
                        $exam_array['exam_id']          = $ex_value['exam_id'];
                        $exam_array['full_marks']       = $ex_value['full_marks'];
                        $exam_array['passing_marks']    = $ex_value['passing_marks'];
                        $exam_array['exam_name']        = $ex_value['name'];
                        $exam_array['exam_type']        = $ex_value['type'];
                        $exam_array['teacher_id']        = $ex_value['teacher_id'];

                        $student_exam_result            = $this->examresult_model->get_result($ex_value['id'], $stu_value['id']);


                        /*
                        $ex_value2['id']  =  $ex_value['id']+1;


                    $student_exam_result            = $this->examresult_model->get_result($ex_value2['id'], $stu_value['id']);

                    */
                        if (empty($student_exam_result)) {

                        } else {

                            $exam_array['attendence']   = $student_exam_result->attendence;
                            $exam_array['get_marks']    = $student_exam_result->get_marks;
                            $exam_array['total']      = $student_exam_result->total;

                        }

                        $x[] = $exam_array;
                    }


                    //for each exam schedule
                    if(empty($x)){
                        $data['examSchedule']['status'] = "no";
                    }
                    $array['exam_array'] = $x;
                    $new_array[] = $array;
                }

                $data['examSchedule']['result'] = $new_array;
                //	echo "<pre>";
                //	print_r($new_array);
                //	echo "</pre>";

            } else {
                $s = array('status' => 'no');
                $data['examSchedule'] = $s;
            }
            $title_mark
                =  $exam['name']." Marks Sheet (".$class_sections['class']['class']."/".$class_sections['section']['section'].")";
            $data['print_title']    = $title_mark;


            $listgrade= $this->grade_model->get();
            $data['listgrade']      = $listgrade;


            $listgradelast = $this->grade_model->last_record();

            $data['listgradelast']      = $listgradelast;

            $this->load->view('layout/header', $data);
            $this->load->view('admin/mark/markList', $data);
            $this->load->view('layout/footer', $data);
        }
    }

    function result_card() {
        $this->session->set_userdata('top_menu', 'Examinations');
        $this->session->set_userdata('sub_menu', 'mark/index');
        $session                    = $this->setting_model->getCurrentSession();
        $data['title']              = 'Exam Marks';
        $data['exam_id']            = "";
        $data['class_id']           = "";
        $data['section_id']         = "";
        $exam_id                    = $this->input->post_get('exam_id');
        $class_id                   = $this->input->post_get('class_id');
        $section_id                 = $this->input->post_get('section_id');
        $student_id                 = $this->input->post_get('student_id');
        $student_ids                = $this->input->post('student_ids');


        $exam                       = $this->exam_model->get($exam_id);
        $class                      = $this->class_model->get($class_id);
        $data['exam']               = $exam;
        $data['class']              = $class;
        $class_sections             = $this->classsection_model->class_sections(null,$class_id,$section_id);
        if (!empty($exam_id) && !empty($class_id) && !empty($section_id) && !empty($student_id))
        {
            $data['exam_id']        = $exam_id;
            $data['class_id']       = $class_id;
            $data['section_id']     = $section_id;
            $data['class_sections'] = $class_sections;
            $examSchedule           = $this->examschedule_model->getDetailbyClsandSection($class_id, $section_id, $exam_id);

            $student                = $this->student_model->get($student_id);
            $student        = $this->student_model->get( $student_id );
            $class_details  = $this->class_model->get( $student['class_id'] );
            $data['examSchedule']   = array();
            if (!empty($examSchedule)) {
                $new_array = array();
                $data['examSchedule']['status'] = "yes";
                $array = array();
                $array['student_id']    = $student['id'];
                $array['roll_no']       = $student['roll_no'];
                $array['firstname']     = $student['firstname'];
                $array['lastname']      = $student['lastname'];
                $array['admission_no']  = $student['admission_no'];
                $array['dob']           = $student['dob'];
                $array['father_name']   = $student['father_name'];
                $array['image']         = $student['image'];
                $x = array();

                foreach ($examSchedule as $ex_key => $ex_value) {
                    $session_result = $this->session_model->get($ex_value['session_id']);
                    $exam_array = array();
                    $exam_array['exam_schedule_id'] = $ex_value['id'];
                    $exam_array['exam_id']          = $ex_value['exam_id'];
                    $exam_array['full_marks']       = $ex_value['full_marks'];
                    $exam_array['passing_marks']    = $ex_value['passing_marks'];
                    $exam_array['exam_name']        = $ex_value['name'];
                    $exam_array['exam_type']        = $ex_value['type'];
                    $student_exam_result            = $this->examresult_model->get_result($ex_value['id'], $student['id']);
                    if (empty($student_exam_result)) {
                    } else {
                        $exam_array['attendence']   = $student_exam_result->attendence;
                        $exam_array['get_marks']    = $student_exam_result->get_marks;
                    }
                    $x[] = $exam_array;
                }
                if(empty($x)){
                    $data['examSchedule']['status'] = "no";
                }
                $array['exam_array'] = $x;

                $data['examSchedule'] = $array;
            } else {
                $s = array('status' => 'no');
                $data['examSchedule'] = $s;
            }
            $schedule_id = $exam_array['exam_schedule_id'];
            $total_result	=  $this->examresult_model->get_result2(null,$schedule_id);
            $id =$student_id;
            $student_class	=  $this->student_model->searchByClassSection($class_id,$section_id);
            foreach($student_class as $key=>$cla){
                $total_result1[$key]	=  $this->examschedule_model->getresultByStudentandExam_position($exam_id , $cla['id']);
            }
            $position = array();
            foreach($total_result1 as $key=>$total){
                $position[$key]['percentage'] = ($total['total_marks']/$total['full_marks'])* 100;
                $position[$key]['student_id'] = $total['student_id'];
            }
            rsort($position);
            for($i=0;$i<count($position);$i++){
                if($position[$i]['student_id'] == $id)
                    $percentage  = $i+1;
            }
            $data['position']= $percentage;
            $data['total_result']= $total_result  ;
            $school_name            = $this->setting_model->getCurrentSchoolName();
            $data['school_name']    = $school_name;
            $school_logo            = $this->setting_model->getCurrentImage();
            $data['school_logo']    = $school_logo;
            $listgrade              = $this->grade_model->get();
            $data['listgrade']      = $listgrade;
            $title_mark             =  $exam['name']." Marks Sheet (".$class_sections['class']['class']."/".$class_sections['section']['section'].")";
            $data['print_title']    = $title_mark;
            $this->load->view('layout/header', $data);
            $this->load->view('admin/mark/resultCard', $data);
        }
    }

    function result_card_all() {
        $this->session->set_userdata('top_menu', 'Examinations');
        $this->session->set_userdata('sub_menu', 'mark/index');
        $session                    = $this->setting_model->getCurrentSession();
        $data['title']              = 'Exam Marks';
        $data['exam_id']            = "";
        $data['class_id']           = "";
        $data['section_id']         = "";
        $exam_id                    = $this->input->post_get('exam_id');
        $class_id                   = $this->input->post_get('class_id');
        $section_id                 = $this->input->post_get('section_id');
        $student_id                 = $this->input->post_get('student_id');
        $student_ids                = $this->input->post('student_ids');

         $exams_by_id =  $this->examschedule_model->getExamByClassandSection( $class_id,$section_id);
       


        foreach ( $student_ids as $student_id ){
            $exam                       = $this->exam_model->get($exam_id);
            $class                      = $this->class_model->get($class_id);
            $data['exam']               = $exam;
            $data['class']              = $class;
            $class_sections             = $this->classsection_model->class_sections(null,$class_id,$section_id);
            if (!empty($exam_id) && !empty($class_id) && !empty($section_id) && !empty($student_id))
            {
                $data['exam_id']        = $exam_id;
                $data['class_id']       = $class_id;
                $data['section_id']     = $section_id;
                $data['class_sections'] = $class_sections;
                $examSchedule           = $this->examschedule_model->getDetailbyClsandSection($class_id, $section_id, $exam_id);
                $student        = $this->student_model->get( $student_id );
                $class_details  = $this->class_model->get( $student['class_id'] );
                $data['examSchedule']   = array();
                if (!empty($examSchedule)) {
                    $new_array = array();
                    $data['examSchedule']['status'] = "yes";
                    $array = array();
                    $array['student_id']    = $student['id'];
                    $array['roll_no']       = $student['roll_no'];
                    $array['firstname']     = $student['firstname'];
                    $array['lastname']      = $student['lastname'];
                    $array['admission_no']  = $student['admission_no'];
                    $array['dob']           = $student['dob'];
                    $array['father_name']   = $student['father_name'];
                    $array['image']         = $student['image'];
                    $x = array();
                    foreach ($examSchedule as $ex_key => $ex_value) {
                        $session_result = $this->session_model->get($ex_value['session_id']);
                        $exam_array = array();
                        $exam_array['exam_schedule_id'] = $ex_value['id'];
                        $exam_array['exam_id']          = $ex_value['exam_id'];
                        $exam_array['full_marks']       = $ex_value['full_marks'];
                        $exam_array['passing_marks']    = $ex_value['passing_marks'];
                        $exam_array['exam_name']        = $ex_value['name'];
                        $exam_array['exam_type']        = $ex_value['type'];
                        $student_exam_result            = $this->examresult_model->get_result($ex_value['id'], $student['id']);
                        if (empty($student_exam_result)) {
                        } else {
                            $exam_array['attendence']   = $student_exam_result->attendence;
                            $exam_array['get_marks']    = $student_exam_result->get_marks;
                        }
                        $x[] = $exam_array;
                    }
                    if(empty($x)){
                        $data['examSchedule']['status'] = "no";
                    }
                    $array['exam_array'] = $x;

                    $data['examSchedule'] = $array;
                } else {
                    $s = array('status' => 'no');
                    $data['examSchedule'] = $s;
                }
                $schedule_id = $exam_array['exam_schedule_id'];
                $total_result	=  $this->examresult_model->get_result2($schedule_id);
                $id =$student_id;
                $student_class	=  $this->student_model->searchByClassSection($class_id,$section_id);
                foreach($student_class as $key=>$cla){
                    $total_result1[$key]	=  $this->examschedule_model->getresultByStudentandExam_position($exam_id , $cla['id']);
                }
                $position = array();
                foreach($total_result1 as $key=>$total){
                    $position[$key]['percentage'] = ($total['total_marks']/$total['full_marks'])* 100;
                    $position[$key]['student_id'] = $total['student_id'];
                }
                rsort($position);
                for($i=0;$i<count($position);$i++){
                    if($position[$i]['student_id'] == $id)
                        $percentage  = $i+1;
                }
                $data['position']= $percentage;
                $data['total_result']= $total_result  ;
                $school_name            = $this->setting_model->getCurrentSchoolName();
                $data['school_name']    = $school_name;
                $school_logo            = $this->setting_model->getCurrentImage();
                $data['school_logo']    = $school_logo;
                $listgrade              = $this->grade_model->get();
                $data['listgrade']      = $listgrade;
                $title_mark             =  $exam['name']." Marks Sheet (".$class_sections['class']['class']."/".$class_sections['section']['section'].")";
                $data['print_title']    = $title_mark;
                $this->load->view('layout/header', $data);
                $this->load->view('admin/mark/resultCard', $data);

            }
        }

    }
    function result_card_custom() {
        $this->session->set_userdata('top_menu', 'Examinations');
        $this->session->set_userdata('sub_menu', 'mark/index');
        $session                    = $this->setting_model->getCurrentSession();
        $data['title']              = 'Exam Marks';
        $data['exam_id']            = "";
        $data['class_id']           = "";
        $data['section_id']         = "";
        $exam_id                    = $this->input->post_get('exam_id');
        $class_id                   = $this->input->post_get('class_id');
        $section_id                 = $this->input->post_get('section_id');
        $student_id                 = $this->input->post_get('student_id');
        $student_ids                = $this->input->post('student_ids');

        $ranking                       = $this->exam_model->get_ranking();

        $data['ranking'] = $ranking;
        foreach ( $student_ids as $student_id ){
            $exam                       = $this->exam_model->get($exam_id);
            $class                      = $this->class_model->get($class_id);
            $data['exam']               = $exam;
            $data['class']              = $class;
            $class_sections             = $this->classsection_model->class_sections(null,$class_id,$section_id);
            if (!empty($exam_id) && !empty($class_id) && !empty($section_id) && !empty($student_id))
            {
                $data['exam_id']        = $exam_id;
                $data['class_id']       = $class_id;
                $data['section_id']     = $section_id;
                $data['class_sections'] = $class_sections;
                $examSchedule           = $this->examschedule_model->getDetailbyClsandSection($class_id, $section_id, $exam_id);
                $student        = $this->student_model->get( $student_id );
                $class_details  = $this->class_model->get( $student['class_id'] );
                $data['examSchedule']   = array();
                if (!empty($examSchedule)) {
                    $new_array = array();
                    $data['examSchedule']['status'] = "yes";
                    $array = array();
                    $array['student_id']    = $student['id'];
                    $array['roll_no']       = $student['roll_no'];
                    $array['firstname']     = $student['firstname'];
                    $array['lastname']      = $student['lastname'];
                    $array['admission_no']  = $student['admission_no'];
                    $array['dob']           = $student['dob'];
                    $array['father_name']   = $student['father_name'];
                    $array['image']         = $student['image'];
                    $x = array();
                    foreach ($examSchedule as $ex_key => $ex_value) {
                        $session_result = $this->session_model->get($ex_value['session_id']);
                        $exam_array = array();
                        $exam_array['exam_schedule_id'] = $ex_value['id'];
                        $exam_array['exam_id']          = $ex_value['exam_id'];
                        $exam_array['full_marks']       = $ex_value['full_marks'];
                        $exam_array['passing_marks']    = $ex_value['passing_marks'];
                        $exam_array['exam_name']        = $ex_value['name'];
                        $exam_array['exam_type']        = $ex_value['type'];
                        $student_exam_result            = $this->examresult_model->get_result($ex_value['id'], $student['id']);
                        if (empty($student_exam_result)) {
                        } else {
                            $exam_array['attendence']   = $student_exam_result->attendence;
                            $exam_array['get_marks']    = $student_exam_result->get_marks;
                        }
                        $x[] = $exam_array;
                    }
                    if(empty($x)){
                        $data['examSchedule']['status'] = "no";
                    }
                    $array['exam_array'] = $x;

                    $data['examSchedule'] = $array;
                } else {
                    $s = array('status' => 'no');
                    $data['examSchedule'] = $s;
                }
                $schedule_id = $exam_array['exam_schedule_id'];
                $total_result	=  $this->examresult_model->get_result2($schedule_id);
                $id =$student_id;
                $student_class	=  $this->student_model->searchByClassSection($class_id,$section_id);
                foreach($student_class as $key=>$cla){
                    $total_result1[$key]	=  $this->examschedule_model->getresultByStudentandExam_position($exam_id , $cla['id']);
                }
                $position = array();
                foreach($total_result1 as $key=>$total){
                    $position[$key]['percentage'] = ($total['total_marks']/$total['full_marks'])* 100;
                    $position[$key]['student_id'] = $total['student_id'];
                }
                rsort($position);
                for($i=0;$i<count($position);$i++){
                    if($position[$i]['student_id'] == $id)
                        $percentage  = $i+1;
                }
                $data['position']= $percentage;
                $data['total_result']= $total_result  ;
                $school_name            = $this->setting_model->getCurrentSchoolName();
                $data['school_name']    = $school_name;
                $school_logo            = $this->setting_model->getCurrentImage();
                $data['school_logo']    = $school_logo;
                $listgrade              = $this->grade_model->get();
                $data['listgrade']      = $listgrade;
                $title_mark             =  $exam['name']." Marks Sheet (".$class_sections['class']['class']."/".$class_sections['section']['section'].")";
                $data['print_title']    = $title_mark;
                $this->load->view('layout/header', $data);
                $this->load->view('admin/mark/customResultCard', $data);

            }
        }

    }
    function getId($rank, $id){
        foreach($rank as $item){
            if ($item->ID == $id)
                return $item->total;
        }
        return "blah!";
    }




    function view($id) {
        $data['title'] = 'Mark List';
        $mark = $this->mark_model->get($id);
        $data['mark'] = $mark;
        $this->load->view('layout/header', $data);
        $this->load->view('admin/mark/markShow', $data);
        $this->load->view('layout/footer', $data);
    }

    function delete($id) {
        $data['title'] = 'Mark List';
        $this->mark_model->remove($id);
        redirect('admin/mark/index');
    }

    function create() {
        $session                    = $this->setting_model->getCurrentSession();
        $data['title']              = 'Exam Schedule';
        $data['exam_id']            = "";
        $data['class_id']           = "";
        $data['section_id']         = "";
        $exam_id                    = $this->input->post_get('exam_id');
        $class_id                   = $this->input->post_get('class_id');
        $section_id                 = $this->input->post_get('section_id');

        if (!isset($exam_id)) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger text-left">Please Select The Exam</div>');
            redirect('admin/exam');
        }


        $exam                       = $this->exam_model->get($exam_id);
        $class                      = $this->class_model->get();
        $data['examlist']           = $exam;
        $data['classlist']          = $class;
        $feecategory                = $this->feecategory_model->get();
        $data['feecategorylist']    = $feecategory;
        $class_sections             = $this->classsection_model->class_sections(null,$class_id,$section_id);

        $this->form_validation->set_rules('exam_id', 'Exam', 'trim|required|xss_clean');
        $this->form_validation->set_rules('class_id', 'Class', 'trim|required|xss_clean');
        $this->form_validation->set_rules('section_id', 'Section', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE && ( empty($exam_id) && empty($class_id) && empty($section_id) )) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/mark/markCreate', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $feecategory_id = $this->input->post('feecategory_id');
            $data['exam_id'] = $exam_id;
            $data['class_id'] = $class_id;
            $data['section_id'] = $section_id;
            $data['class_sections'] = $class_sections;

            $examSchedule = $this->examschedule_model->getDetailbyClsandSection($class_id, $section_id, $exam_id);
            $studentList = $this->student_model->searchByClassSection($class_id, $section_id);
            $data['examSchedule'] = array();
            if (!empty($examSchedule)) {
                $new_array = array();
                foreach ($studentList as $stu_key => $stu_value) {
                    $array = array();
                    $array['student_id'] = $stu_value['id'];
                    $array['admission_no'] = $stu_value['admission_no'];
                    $array['roll_no'] = $stu_value['roll_no'];
                    $array['firstname'] = $stu_value['firstname'];
                    $array['lastname'] = $stu_value['lastname'];
                    $array['dob'] = $stu_value['dob'];
                    $array['father_name'] = $stu_value['father_name'];
                    $x = array();
                    foreach ($examSchedule as $ex_key => $ex_value) {
                        $exam_array = array();
                        $exam_array['exam_schedule_id'] = $ex_value['id'];
                        $exam_array['exam_id']          = $ex_value['exam_id'];
                        $exam_array['full_marks']       = $ex_value['full_marks'];
                        $exam_array['passing_marks']    = $ex_value['passing_marks'];
                        $exam_array['exam_name']        = $ex_value['name'];
                        $exam_array['exam_type']        = $ex_value['type'];

                        $student_exam_result            = $this->examresult_model->get_exam_result($ex_value['id'], $stu_value['id']);
                        $exam_array['attendence']       = $student_exam_result->attendence;
                        $exam_array['get_marks']        = $student_exam_result->get_marks;
                        $x[] = $exam_array;
                    }
                    $array['exam_array']    = $x;
                    $new_array[]            = $array;
                }
                $data['examSchedule'] = $new_array;
            }

            if ($this->input->post('save_exam') == "save_exam") {

                $student_array  = $this->input->post('student');
                $exam_array     = $this->input->post('exam_schedule');

                foreach ($student_array as $student_key => $student) {
                    foreach ($exam_array as $exam_key => $exam) {
                        $record['get_marks']    = 0;

                        $record['attendence']   = "pre";
                        if ($this->input->post('student_absent' . $student . "_" . $exam) == "") {
                            $record['get_marks']    = $this->input->post('student_number' . $student . "_" . $exam);

                        } else {
                            $record['attendence']   = $this->input->post('student_absent' . $student . "_" . $exam);

                        }


                        $record['exam_schedule_id'] = $exam;


                        $record['total']    =  $this->input->post('total' . $student . "_" . $exam);

                        $record['student_id'] = $student;


                        $this->examresult_model->add_exam_result($record);
                    }
                }
                redirect('admin/exam?exam_id='.$exam_id);
            }
            $title_mark             =  $exam['name']." ".$this->lang->line('fill_mark')." (".$class_sections['class']['class']."/".$class_sections['section']['section'].")";

            $data['print_title']    = $title_mark;
            $this->load->view('layout/header', $data);
            $this->load->view('admin/mark/markCreate', $data);
            $this->load->view('layout/footer', $data);
        }
    }
    function ranking() {

        $session                    = $this->setting_model->getCurrentSession();
        $data['title']              = 'Exam Schedule';
        $data['exam_id']            = "";
        $data['class_id']           = "";
        $data['section_id']         = "";
        $exam_id                    = $this->input->post_get('exam_id');
        $class_id                   = $this->input->post_get('class_id');
        $section_id                 = $this->input->post_get('section_id');

        if (!isset($exam_id)) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger text-left">Please Select The Exam</div>');
            redirect('admin/exam');
        }


        $exam                       = $this->exam_model->get($exam_id);
        $ranking                       = $this->exam_model->get_ranking();

        $class                      = $this->class_model->get();
        $data['examlist']           = $exam;
        $data['rankinglist']           = $ranking;
        
        $data['classlist']          = $class;
        $feecategory                = $this->feecategory_model->get();
        $data['feecategorylist']    = $feecategory;
        $class_sections             = $this->classsection_model->class_sections(null,$class_id,$section_id);

        $this->form_validation->set_rules('exam_id', 'Exam', 'trim|required|xss_clean');
        $this->form_validation->set_rules('class_id', 'Class', 'trim|required|xss_clean');
        $this->form_validation->set_rules('section_id', 'Section', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE && ( empty($exam_id) && empty($class_id) && empty($section_id) )) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/mark/ranking', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $feecategory_id = $this->input->post('feecategory_id');
            $data['exam_id'] = $exam_id;
            $data['class_id'] = $class_id;
            $data['section_id'] = $section_id;
            $data['class_sections'] = $class_sections;

            $examSchedule = $this->examschedule_model->getDetailbyClsandSection($class_id, $section_id, $exam_id);
            $studentList = $this->student_model->searchByClassSection($class_id, $section_id);
            $data['examRank'] = array();
            if (!empty($examSchedule)) {
                $new_array = array();
                foreach ($studentList as $stu_key => $stu_value) {
                    $array = array();
                    $array['student_id'] = $stu_value['id'];
                    $array['admission_no'] = $stu_value['admission_no'];
                    $array['roll_no'] = $stu_value['roll_no'];
                    $array['firstname'] = $stu_value['firstname'];
                    $array['lastname'] = $stu_value['lastname'];
                    $array['dob'] = $stu_value['dob'];
                    $array['father_name'] = $stu_value['father_name'];
                    $x = array();
                    foreach ($ranking as $rank_key => $rank_value) {
                        $exam_array = array();
                        $exam_array['id'] = $rank_value['id'];
                        $exam_array['name']          = $rank_value['name'];
                        $student_rank               = $this->exam_model->get_exam_ranking($rank_value['id'], $stu_value['id'] ,$exam_id);
                        $exam_array['rank_id']       = $student_rank->rank_id;
                        $exam_array['rating']        = $student_rank->rating;
                        $x[] = $exam_array;
                    }
                    $array['rank_array']    = $x;
                    $new_array[]            = $array;
                }
                $data['examRank'] = $new_array;
            }

          

            if ($this->input->post('save_exam') == "save_exam") {

                $student_array  = $this->input->post('student');
                $exam_array     = $this->input->post('exam_schedule');

                foreach ($student_array as $student_key => $student) {
                    foreach ($exam_array as $exam_key => $exam) {
                        $record['get_marks']    = 0;

                        $record['attendence']   = "pre";
                        if ($this->input->post('student_absent' . $student . "_" . $exam) == "") {
                            $record['get_marks']    = $this->input->post('student_number' . $student . "_" . $exam);

                        } else {
                            $record['attendence']   = $this->input->post('student_absent' . $student . "_" . $exam);

                        }


                        $record['exam_schedule_id'] = $exam;


                        $record['total']    =  $this->input->post('total' . $student . "_" . $exam);

                        $record['student_id'] = $student;


                        $this->examresult_model->add_exam_result($record);
                    }
                }
                redirect('admin/exam?exam_id='.$exam_id);
            }
            $title_mark             =  $exam['name']." ".$this->lang->line('fill_mark')." (".$class_sections['class']['class']."/".$class_sections['section']['section'].")";

            $data['print_title']    = $title_mark;
            $this->load->view('layout/header', $data);
            $this->load->view('admin/mark/ranking', $data);
            $this->load->view('layout/footer', $data);
        }
    }
    function award_list() {
        $session                    = $this->setting_model->getCurrentSession();
        $data['title']              = 'Exam Schedule';
        $data['exam_id']            = "";
        $data['class_id']           = "";
        $data['section_id']         = "";
        $exam_id                    = $this->input->post_get('exam_id');
        $class_id                   = $this->input->post_get('class_id');
        $section_id                 = $this->input->post_get('section_id');

        if (!isset($exam_id)) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger text-left">Please Select The Exam</div>');
            redirect('admin/exam');
        }


        $exam                       = $this->exam_model->get($exam_id);
        $class                      = $this->class_model->get();
        $data['examlist']           = $exam;
        $data['classlist']          = $class;
        $feecategory                = $this->feecategory_model->get();
        $data['feecategorylist']    = $feecategory;
        $class_sections             = $this->classsection_model->class_sections(null,$class_id,$section_id);

        $this->form_validation->set_rules('exam_id', 'Exam', 'trim|required|xss_clean');
        $this->form_validation->set_rules('class_id', 'Class', 'trim|required|xss_clean');
        $this->form_validation->set_rules('section_id', 'Section', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE && ( empty($exam_id) && empty($class_id) && empty($section_id) )) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/mark/award', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $feecategory_id = $this->input->post('feecategory_id');
            $data['exam_id'] = $exam_id;
            $data['class_id'] = $class_id;
            $data['section_id'] = $section_id;
            $data['class_sections'] = $class_sections;

            $examSchedule = $this->examschedule_model->getDetailbyClsandSection($class_id, $section_id, $exam_id);
            $studentList = $this->student_model->searchByClassSection($class_id, $section_id);
            $data['examSchedule'] = array();

            if (!empty($examSchedule)) {
                $new_array = array();
                foreach ($studentList as $stu_key => $stu_value) {
                    $array = array();
                    $array['student_id'] = $stu_value['id'];
                    $array['admission_no'] = $stu_value['admission_no'];
                    $array['roll_no'] = $stu_value['roll_no'];
                    $array['firstname'] = $stu_value['firstname'];
                    $array['lastname'] = $stu_value['lastname'];
                    $array['dob'] = $stu_value['dob'];
                    $array['father_name'] = $stu_value['father_name'];
                    $x = array();
                    foreach ($examSchedule as $ex_key => $ex_value) {
                        $exam_array = array();
                        $exam_array['exam_schedule_id'] = $ex_value['id'];
                        $exam_array['exam_id']          = $ex_value['exam_id'];
                        $exam_array['full_marks']       = $ex_value['full_marks'];
                        $exam_array['passing_marks']    = $ex_value['passing_marks'];
                        $exam_array['exam_name']        = $ex_value['name'];
                        $exam_array['exam_type']        = $ex_value['type'];
                        $exam_array['teacher']        = $this->teacher_model->get($ex_value['teacher_id']);

                        $student_exam_result            = $this->examresult_model->get_exam_result($ex_value['id'], $stu_value['id']);
                        $exam_array['attendence']       = $student_exam_result->attendence;
                        $exam_array['get_marks']        = $student_exam_result->get_marks;
                        $x[] = $exam_array;
                    }
                    $array['exam_array']    = $x;
                    $new_array[]            = $array;
                }
                $data['examSchedule'] = $new_array;
            }


            if ($this->input->post('save_exam') == "save_exam") {

                $student_array  = $this->input->post('student');
                $exam_array     = $this->input->post('exam_schedule');

                foreach ($student_array as $student_key => $student) {
                    foreach ($exam_array as $exam_key => $exam) {
                        $record['get_marks']    = 0;

                        $record['attendence']   = "pre";
                        if ($this->input->post('student_absent' . $student . "_" . $exam) == "") {
                            $record['get_marks']    = $this->input->post('student_number' . $student . "_" . $exam);

                        } else {
                            $record['attendence']   = $this->input->post('student_absent' . $student . "_" . $exam);

                        }


                        $record['exam_schedule_id'] = $exam;


                        $record['total']    =  $this->input->post('total' . $student . "_" . $exam);

                        $record['student_id'] = $student;


                        $this->examresult_model->add_exam_result($record);
                    }
                }
                redirect('admin/exam?exam_id='.$exam_id);
            }
            $title_mark             =  $exam['name']." ".$this->lang->line('fill_mark')." (".$class_sections['class']['class']."/".$class_sections['section']['section'].")";
            $school_name            = $this->setting_model->getCurrentSchoolName();
            $data['school_name']    = $school_name;
            $school_logo            = $this->setting_model->getCurrentImage();
            $data['school_logo']    = $school_logo;
            $data['print_title']    = $title_mark;
            $this->load->view('layout/header', $data);
            $this->load->view('admin/mark/award', $data);
            $this->load->view('layout/footer', $data);
        }
    }
    function edit($id) {
        $data['title']  = 'Edit Mark';
        $data['id']     = $id;
        $mark           = $this->mark_model->get($id);
        $data['mark']   = $mark;
        $this->form_validation->set_rules('name', 'Mark', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/mark/markEdit', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $data = array(
                'id'    => $id,
                'name'  => $this->input->post('name'),
                'note'  => $this->input->post('note'),
            );
            $this->mark_model->add($data);
            $this->session->set_flashdata('msg', '<div mark="alert alert-success text-center">Employee details added to Database!!!</div>');
            redirect('admin/mark/index');
        }
    }

}

?>