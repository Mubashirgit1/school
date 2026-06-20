<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Exam extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('file');
        $this->lang->load('message', 'english');
    }
 
    public function examclasses($id) {
        $this->session->set_userdata('top_menu', 'Examinations');
        $this->session->set_userdata('sub_menu', 'exam/index');
        $data['title']      = 'list of  Alloted';


        $exam               = $this->exam_model->get($id);
        $data['exam']       = $exam;
        $classsectionList   = $this->examschedule_model->getclassandsectionbyexam($id);
        $array = array();
        foreach ($classsectionList as $key => $value) {
            $s = array();
            $exam_id = $value['exam_id'];
            $class_id = $value['class_id'];
            $section_id = $value['section_id'];
            $result_prepare = $this->examresult_model->checkexamresultpreparebyexam($exam_id, $class_id, $section_id);
            $s['exam_id'] = $exam_id;
            $s['class_id'] = $class_id;
            $s['section_id'] = $section_id;
            $s['class'] = $value['class'];
            $s['section'] = $value['section'];
            if ($result_prepare) {
                $s['result_prepare'] = "yes";
            } else {
                $s['result_prepare'] = "no";
            }
            $array[] = $s;
        }
        $data['classsectionList'] = $array;
        $this->load->view('layout/header');
        $this->load->view('admin/exam/examClasses', $data);
        $this->load->view('layout/footer');
    }

    public function examclassesajax() {
      
	    $this->session->set_userdata('top_menu', 'Examinations');
        $this->session->set_userdata('sub_menu', 'exam/index');
        $id                 = $this->input->get('id');


        $exam               = $this->exam_model->get($id);
        $data['exam']       = $exam;
        $classsectionList   = $this->examschedule_model->getclassandsectionbyexam($id);
        $array = array();
        foreach ($classsectionList as $key => $value) {
            $s = array();
            $exam_id = $value['exam_id'];
            $class_id = $value['class_id'];
            $section_id = $value['section_id'];
            $result_prepare = $this->examresult_model->checkexamresultpreparebyexam($exam_id, $class_id, $section_id);
            $s['exam_id'] = $exam_id;
            $s['class_id'] = $class_id;
            $s['section_id'] = $section_id;
            $s['class'] = $value['class'];
            $s['section'] = $value['section'];
            if ($result_prepare) {
        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";exit;
                $s['result_prepare'] = "yes";
            } else {
                $s['result_prepare'] = "no";
            }
            $array[] = $s;
        }
        $data['classsectionList'] = $array;
        echo json_encode($data);
    }
    
    function index() {
        $this->session->set_userdata('top_menu', 'Examinations');
        $this->session->set_userdata('sub_menu', 'exam/index');
        $data['title']      = '';
	    $data['title_list'] = 'Exam List';
        $examid             = $this->input->post_get('exam_id');
        $data['exam_id']    = $examid==null?-1:$examid;
  
        $session_id             = $this->input->get('session_id');
     
       

        $session_result = $this->session_model->getAllSession();
        $data['sessionlist']   =$session_result;
  
         $this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
        } else {
            $session                = $this->setting_model->getCurrentSession();
         
            $data = array(
                'name' => $this->input->post('name'),
                'note' => $this->input->post('note'),
                'session_id' =>$session
            );
            $this->exam_model->add($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Exam added successfully</div>');
            redirect('admin/exam/index');            
        }
        $class_sections = $this->classsection_model->class_sections();
        $session  = $this->setting_model->getCurrentSession();
        $session_result = $this->session_model->getAllSession();
        $data['sessionlist']   =$session_result;
        $data['class_sections']   = $class_sections;

        $session = $session_id != null ? $session_id :  $session;
        $data['current_session']   = $session;
        $exam_result        = $this->exam_model->get(null , $session);
        $data['examlist']   = $exam_result;
	    $school_logo = $this->setting_model->getCurrentImage();
        $data['school_logo']   = $school_logo;
        $school_name = $this->setting_model->getCurrentSchoolName();
        $data['school_name']   = $school_name;
        
        if (!empty($examid)) {
            $exam_name          = $this->exam_model->get($examid);
            $data['examname']   = $exam_name['name'];
        }
        $this->load->view('layout/header', $data);
        $this->load->view('admin/exam/examList', $data);
        $this->load->view('layout/footer', $data);
    }

    function award() {
        $this->session->set_userdata('top_menu', 'Examinations');
        $this->session->set_userdata('sub_menu', 'exam/index');
        $data['title']      = '';
	    $data['title_list'] = 'Exam List';
        $examid             = $this->input->post_get('exam_id');
        $data['exam_id']    = $examid==null?-1:$examid;
  
        $session_id             = $this->input->get('session_id');
        $session_result = $this->session_model->getAllSession();
        $data['sessionlist']   =$session_result;
  
        
        $class_sections = $this->classsection_model->class_sections();
        $session  = $this->setting_model->getCurrentSession();
        $session_result = $this->session_model->getAllSession();
        $data['sessionlist']   =$session_result;
        $data['class_sections']   = $class_sections;
        $session = $session_id != null ? $session_id :  $session;
        $data['current_session']   = $session;
        $exam_result        = $this->exam_model->get(null , $session);
        $data['examlist']   = $exam_result;
	    $school_logo = $this->setting_model->getCurrentImage();
        $data['school_logo']   = $school_logo;
        $school_name = $this->setting_model->getCurrentSchoolName();
        $data['school_name']   = $school_name;

        if (!empty($examid)) {
            $exam_name          = $this->exam_model->get($examid);
            $data['examname']   = $exam_name['name'];
        }
        $this->load->view('layout/header', $data);
        $this->load->view('admin/exam/awardList', $data);
        $this->load->view('layout/footer', $data);
       
    }

    public function awardclass(){


        $data['exam_id'] = $this->input->get('exam_id');
        
        $class_sections = $this->classsection_model->class_sections();
        $session  = $this->setting_model->getCurrentSession();

        $data['class_sections']   = $class_sections;
        $session = $session_id != null ? $session_id :  $session;
        $data['current_session']   = $session;
        $exam_result        = $this->exam_model->get(null , $session);
        $data['examlist']   = $exam_result;
	    $school_logo = $this->setting_model->getCurrentImage();
        $data['school_logo']   = $school_logo;
        $school_name = $this->setting_model->getCurrentSchoolName();
        $data['school_name']   = $school_name;
        if (!empty($data['exam_id'])) {
            $exam_name          = $this->exam_model->get($data['exam_id']);
            $data['examname']   = $exam_name['name'];
        }
        $this->load->view('layout/header', $data);
        $this->load->view('admin/exam/awardList', $data);
        $this->load->view('layout/footer', $data);  
    }
    
    public function examclass(){

        $data['exam_id'] = $this->input->get('exam_id');
        $session_id             = $this->input->get('session_id');
           
        $session  = $this->setting_model->getCurrentSession();
        $session_result = $this->session_model->getAllSession();
        $data['sessionlist']   =$session_result;
        $class_sections = $this->classsection_model->class_sections();


        $data['class_sections']   = $class_sections;
        $session = $session_id != null ? $session_id :  $session;
        $data['current_session']   = $session;
        $exam_result        = $this->exam_model->get(null , $session);
        $data['examlist']   = $exam_result;
	    $school_logo = $this->setting_model->getCurrentImage();
        $data['school_logo']   = $school_logo;
        $school_name = $this->setting_model->getCurrentSchoolName();
        $data['school_name']   = $school_name;
        if (!empty($data['exam_id'])) {
            $exam_name          = $this->exam_model->get($data['exam_id']);
            $data['examname']   = $exam_name['name'];
        }
        $this->load->view('layout/header', $data);
        $this->load->view('admin/exam/examList', $data);
        $this->load->view('layout/footer', $data);  
    }

    function view($id) {
        $data['title']              = 'Exam List';


        $exam                       = $this->exam_model->get($id);
        $data['exam']               = $exam;
        $this->load->view('layout/header', $data);
        $this->load->view('exam/examShow', $data);
        $this->load->view('layout/footer', $data);
    }

    function getByFeecategory() {
        $feecategory_id = $this->input->get('feecategory_id');
        $data = $this->feetype_model->getTypeByFeecategory($feecategory_id);
        echo json_encode($data);
    }

    function getStudentCategoryFee() {
        $type = $this->input->post('type');
        $class_id = $this->input->post('class_id');
        $data = $this->exam_model->getTypeByFeecategory($type, $class_id);
        if (empty($data)) {
            $status = 'fail';
        } else {
            $status = 'success';
        }
        $array = array('status' => $status, 'data' => $data);
        echo json_encode($array);
    }

    function delete($id) {
        $data['title'] = 'Exam List';
        $this->exam_model->remove($id);
        redirect('admin/exam/index');
    }

    function create() {
        $data['title'] = 'Add Exam';
        $this->form_validation->set_rules('exam', 'Exam', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('exam/examCreate', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $data = array(
                'exam' => $this->input->post('exam'),
                'note' => $this->input->post('note'),
            );
            $this->exam_model->add($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Exam added successfully</div>');
            redirect('exam/index');
        }
    }

    function edit($id) {
        $data['title'] = 'Edit Exam';
        $data['id'] = $id;


        $exam = $this->exam_model->get($id);
        $data['exam'] = $exam;
        $data['title_list'] = 'Exam List';

        $exam_result = $this->exam_model->get();
        $data['examlist'] = $exam_result;
        $this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/exam/examEdit', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $data = array(
                'id' => $id,
                'name' => $this->input->post('name'),
                'note' => $this->input->post('note'),
            );
            $this->exam_model->add($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Exam update successfully</div>');
            redirect('admin/exam/index');
        }
    }

    function examSearch() {
        $data['title'] = 'Search exam';
        if ($this->input->server('REQUEST_METHOD') == "POST") {
            $search = $this->input->post('search');
            if ($search == "search_filter") {
                $data['exp_title'] = 'exam Result From ' . $this->input->post('date_from') . " To " . $this->input->post('date_to');
                $date_from = date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('date_from')));
                $date_to = date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('date_to')));
                $resultList = $this->exam_model->search("", $date_from, $date_to);
                $data['resultList'] = $resultList;
            } else {
                $data['exp_title'] = 'exam Result';
                $search_text = $this->input->post('search_text');
                $resultList = $this->exam_model->search($search_text, "", "");
                $data['resultList'] = $resultList;
            }
            $this->load->view('layout/header', $data);
            $this->load->view('admin/exam/examSearch', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/exam/examSearch', $data);
            $this->load->view('layout/footer', $data);
        }
    }
	
}

?>