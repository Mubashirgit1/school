<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Timetable extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('file');

        $this->lang->load('message', 'english');
    }

    function index()
    {

        $this->session->set_userdata('top_menu', 'Academics');
        $this->session->set_userdata('sub_menu', 'timetable/index');
        $session                 = $this->setting_model->getCurrentSession();
        $data['title']           = 'Timetable';
        $data['exam_id']         = "";
        $data['class_id']        = "";
        $data['section_id']      = "";
        $exam                    = $this->exam_model->get();
        $class                   = $this->class_model->get();
        $data['examlist']        = $exam;
        $data['classlist']       = $class;
        $feecategory             = $this->feecategory_model->get();
        $data['feecategorylist'] = $feecategory;
        if ($this->input->method() == 'get') {
            $this->form_validation->set_data($_GET);
        }

        $class_sections         = $this->classsection_model->class_sections();
        $data['class_sections'] = $class_sections;


        $this->form_validation->set_rules('class_id', 'Class', 'trim|required|xss_clean');
        $this->form_validation->set_rules('section_id', 'Section', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/timetable/timetableList', $data);
            $this->load->view('layout/footer', $data);
        } else {

            $class_id           = $this->input->post_get('class_id');
            $section_id         = $this->input->post_get('section_id');
            $data['class_id']   = $class_id;
            $data['section_id'] = $section_id;
            $result_subjects    = $this->teachersubject_model->getSubjectByClsandSection($class_id, $section_id);

            $getDaysnameList         = $this->customlib->getDaysname();
            $data['getDaysnameList'] = $getDaysnameList;
            $final_array             = array();
            $subject_details         = array();
            $subject_class_teacher   = array();


            if (!empty($result_subjects)) {
                foreach ($result_subjects as $subject_k => $subject_v) {
                    $subject_details[$subject_v['name']] = $subject_v;

                    $dta_subjects = $this->teachersubject_model->getDetailByclassAndSection($subject_v['class_section_id']);
                    foreach ($dta_subjects as $dta_subject) {
                        if ($dta_subject['subject_id'] == $subject_v['subject_id']) {
                            $dta_subject['teacher_details']            = $this->teacher_model->get($dta_subject['teacher_id']);
                            $subject_class_teacher[$subject_v['name']] = $dta_subject;
                        }
                    }

                    $result_array = array();
                    foreach ($getDaysnameList as $day_key => $day_value) {
                        $where_array = array(
                            'teacher_subject_id' => $subject_v['id'],
                            'day_name'           => $day_value
                        );
                        $result      = $this->timetable_model->get($where_array);
                        if (!empty($result)) {
                            $obj                      = new stdClass();
                            $obj->status              = "Yes";
                            $obj->start_time          = $result[0]['start_time'];
                            $obj->end_time            = $result[0]['end_time'];
                            $obj->room_no             = $result[0]['room_no'];
                            $result_array[$day_value] = $obj;
                        } else {
                            $obj                      = new stdClass();
                            $obj->status              = "No";
                            $obj->start_time          = "N/A";
                            $obj->end_time            = "N/A";
                            $obj->room_no             = "N/A";
                            $result_array[$day_value] = $obj;
                        }
                    }
                    $final_array[$subject_v['name']] = $result_array;
                }
            }
            $class_sections                = $this->classsection_model->class_sections(null, $class_id, $section_id);
            $data['class_sections_name']   = $class_sections;
            $data['result_array']          = $final_array;
            $data['subject_details']       = $subject_details;
            $data['subject_class_teacher'] = $subject_class_teacher;
            $data['print_title']           = $class_sections['class']['class'] . "(" . $class_sections['section']['section'] . ") Class Timetable";

            $this->load->view('layout/header', $data);
            $this->load->view('admin/timetable/timetableList', $data);
            $this->load->view('layout/footer', $data);
        }
    }

    function view($id)
    {
        $data['title'] = 'Mark List';
        $mark          = $this->mark_model->get($id);
        $data['mark']  = $mark;
        $this->load->view('layout/header', $data);
        $this->load->view('admin/timetable/timetableShow', $data);
        $this->load->view('layout/footer', $data);
    }

    function delete($id)
    {
        $data['title'] = 'Mark List';
        $this->mark_model->remove($id);
        redirect('admin/timetable/index');
    }

    function create()
    {
        $session                 = $this->setting_model->getCurrentSession();
        $data['title']           = 'Timetable Schedule';
        $data['subject_id']      = "";
        $data['class_id']        = "";
        $data['section_id']      = "";
        $exam                    = $this->exam_model->get();
        $class                   = $this->class_model->get();
        $data['examlist']        = $exam;
        $data['classlist']       = $class;
        $feecategory             = $this->feecategory_model->get();
        $data['feecategorylist'] = $feecategory;

        if ($this->input->method() == 'get') {
            $this->form_validation->set_data($_GET);
        }

        $this->form_validation->set_rules('subject_id', 'Subject', 'trim|required|xss_clean');
        $this->form_validation->set_rules('class_id', 'Class', 'trim|required|xss_clean');
        $this->form_validation->set_rules('section_id', 'Section', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/timetable/timetableCreate', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $feecategory_id            = $this->input->post_get('feecategory_id');
            $subject_id                = $this->input->post_get('subject_id');
            $class_id                  = $this->input->post_get('class_id');
            $section_id                = $this->input->post_get('section_id');
            $data['subject_id']        = $subject_id;
            $data['class_id']          = $class_id;
            $data['section_id']        = $section_id;
            $getDaysnameList           = $this->customlib->getDaysname();
            $data['getDaysnameList']   = $getDaysnameList;
            $array                     = array();
            $data['timetableSchedule'] = array();
            $class_name                = $this->class_model->get($class_id);
            $section_name              = $this->section_model->get($section_id);
            $teacher_subject_name      = $this->teachersubject_model->get($subject_id);
            $subject_name              = $this->subject_model->get($teacher_subject_name['subject_id']);

//            pwodie($this->db->last_query(), true);
            $data['class_name']   = $class_name['class'];
            $data['section_name'] = $section_name['section'];
            $data['subject_name'] = $subject_name['name'];

            foreach ($getDaysnameList as $key => $value) {
                $where_array = array(
                    'teacher_subject_id' => $subject_id,
                    'day_name'           => $value
                );
                $result      = $this->timetable_model->get($where_array);
                if (empty($result)) {
                    $obj                = new stdClass();
                    $obj->starting_time = "";
                    $obj->post_id       = 0;
                    $obj->ending_time   = "";
                    $obj->room_no       = "";
                } else {
                    $obj                = new stdClass();
                    $obj->starting_time = $result[0]['start_time'];
                    $obj->post_id       = $result[0]['id'];
                    $obj->ending_time   = $result[0]['end_time'];
                    $obj->room_no       = $result[0]['room_no'];
                }
                $array[$value] = $obj;
            }
            $data['timetableSchedule'] = $array;
            if ($this->input->post('save_exam') == "save_exam") {

                $loop = $this->input->post('i');
                foreach ($loop as $key => $value) {
                    $data = array(
                        'day_name'           => $value,
                        'teacher_subject_id' => $this->input->post('subject_id'),
                        'start_time'         => $this->input->post('stime_' . $value),
                        'end_time'           => $this->input->post('etime_' . $value),
                        'room_no'            => $this->input->post('room_' . $value),
                        'id'                 => $this->input->post('edit_' . $value),
                    );
                    $this->timetable_model->add($data);
                }

                $class_id   = $this->input->get('class_id');
                $section_id = $this->input->get('section_id');

                $redirect = ($redirect !== null ? urldecode($redirect) : "admin/timetable");
                redirect('admin/timetable');
                redirect('admin/timetable/index?class_id=' . $class_id . '&section_id=' . $section_id . '');
            }
            $this->load->view('layout/header', $data);
            $this->load->view('admin/timetable/timetableCreate', $data);
            $this->load->view('layout/footer', $data);
        }
    }

    function edit($id)
    {
        $data['title'] = 'Edit Mark';
        $data['id']    = $id;
        $mark          = $this->mark_model->get($id);
        $data['mark']  = $mark;
        $this->form_validation->set_rules('name', 'Mark', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/timetable/timetableEdit', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $data = array(
                'id'   => $id,
                'name' => $this->input->post('name'),
                'note' => $this->input->post('note'),
            );
            $this->mark_model->add($data);
            $this->session->set_flashdata('msg', '<div mark="alert alert-success text-center">Employee added successfully</div>');
            redirect('admin/timetable/index');
        }
    }

    public function teacher_timetable()
    {
        $this->session->set_userdata('top_menu', 'Academics');
        $this->session->set_userdata('sub_menu', 'timetable/teacher_timetable');

        $title = "Teacher's timetable";

        $teachers = $this->teacher_model->get();

        for ($i = 0; $i < count($teachers); $i++) {
            $teachers[$i]['teacher_subjects'] = $this->teachersubject_model->get(null, $teachers[$i]['id']);

            for ($j = 0; $j < count($teachers[$i]['teacher_subjects']); $j++) {
                $teachers[$i]['teacher_subjects'][$j]['subject_details'] = $this->subject_model->get($teachers[$i]['teacher_subjects'][$j]['subject_id']);

                $teachers[$i]['teacher_subjects'][$j]['class_setion_details'] = $this->classsection_model->class_sections($teachers[$i]['teacher_subjects'][$j]['class_section_id']);

                $teachers[$i]['teacher_subjects'][$j]['timetable'] = $this->timetable_model->get([
                    'teacher_subject_id' => $teachers[$i]['teacher_subjects'][$j]['id']
                ]);
            }
        }

        $data = compact('title', 'teachers');
        $this->load->view('layout/header', $data);
        $this->load->view('admin/timetable/teacher_timetable', $data);
        $this->load->view('layout/footer', $data);
    }

    public function day_timetable()
    {
        $this->session->set_userdata('top_menu', 'Academics');
        $this->session->set_userdata('sub_menu', 'timetable/day_timetable');

        $title = "Day Timetable";


        $classlist = $this->class_model->get();

        if ($this->input->method() == 'get') {
            $this->form_validation->set_data($_GET);
        }
        $this->form_validation->set_rules('class_id', 'Class ID', 'trim');
        $this->form_validation->set_rules('section_id', 'Section ID', 'trim');
        $this->form_validation->set_rules('timetable_date', 'Timetable Date', 'trim');
        $this->form_validation->run();

        $class_id       = $this->input->post_get('class_id');
        $section_id     = $this->input->post_get('section_id');
        $timetable_date = $this->input->post_get('timetable_date');

        $class_id   = (empty($class_id) ? null : $class_id);
        $section_id = (empty($section_id) ? null : $section_id);

        $timetable_date = ($timetable_date !== null ? date('Y-m-d', strtotime($timetable_date)) : date('Y-m-d', now()));

        $day_name           = $this->general_library->get_day_name($timetable_date);
        $max_day_timetables = 0;

        $class_sections = $this->classsection_model->getDetailbyClassSection($class_id, $section_id);

        if ($class_id !== null && $section_id !== null) {
            $class_sections = array($class_sections);
        }

        $sections_timetable = array();

//        foreach ($class_sections as $key => $section) {
//            $section['day_timetable'] = $this->timetable_model->get_day_timetable($section['class_id'], $section['section_id'], $day_name);
//
//            if (count($section['day_timetable']) > $max_day_timetables) {
//                $max_day_timetables = count($section['day_timetable']);
//            }
//            $sections_timetable[] = $section;
////            pwodie($section, true);
//        }
//        die();
//        pwodie($sections_timetable, true);
        for ($i = 0; $i < count($class_sections); $i++) {
            $class_sections[$i]['day_timetable'] = $this->timetable_model->get_day_timetable($class_sections[$i]['class_id'], $class_sections[$i]['section_id'], $day_name);

            if (count($class_sections[$i]['day_timetable']) > $max_day_timetables) {
                $max_day_timetables = count($class_sections[$i]['day_timetable']);
            }
//            pwodie($class_sections[$i], true);
        }

        $next_day = new DateTime($timetable_date);
        $next_day->add(new DateInterval('P1D'));

        $previous_day = new DateTime($timetable_date);
        $previous_day->sub(new DateInterval('P1D'));

        $next_link     = "admin/timetable/day_timetable?class_id=" . (!empty($class_id) ? $class_id : '') . "&section_id=" . (!empty($section_id) ? $section_id : '') . "&timetable_date=" . urlencode($next_day->format('m/d/Y'));
        $previous_link = "admin/timetable/day_timetable?class_id=" . (!empty($class_id) ? $class_id : '') . "&section_id=" . (!empty($section_id) ? $section_id : '') . "&timetable_date=" . urlencode($previous_day->format('m/d/Y'));

        $data = compact(
            'title',
            'classlist',
            'timetable_date',
            'class_sections',
            'max_day_timetables',
            'day_name',
            'next_link',
            'previous_link'
        );
        $this->load->view('layout/header', $data);
        $this->load->view('admin/timetable/day_timetable', $data);
        $this->load->view('layout/footer', $data);
    }

}
