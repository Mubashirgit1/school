<?php

if ( !defined( 'BASEPATH' ) )
    exit( 'No direct script access allowed' );

class student extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library( 'smsgateway' );
        $this->load->helper( 'file' );
        $this->lang->load( 'message', 'english' );
        $this->role;
    }

    function index()
    {
        $data['title'] = 'Student List';
        $student_result = $this->student_model->get();
        $data['studentlist'] = $student_result;
        $this->load->view( 'layout/header', $data );
        $this->load->view( 'student/studentList', $data );
        $this->load->view( 'layout/footer', $data );
    }

    function studentreport()
    {
        $this->session->set_userdata( 'top_menu', 'Reports' );
        $this->session->set_userdata( 'sub_menu', 'student/studentreport' );
        $data['title'] = 'student fee';
        $data['title'] = 'student fee';
        $genderList = $this->customlib->getGender();
        $data['genderList'] = $genderList;
        $RTEstatusList = $this->customlib->getRteStatus();
        $data['RTEstatusList'] = $RTEstatusList;
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        $category = $this->category_model->get();
        $data['categorylist'] = $category;
        if ( $this->input->server( 'REQUEST_METHOD' ) == "GET" ) {
            $this->load->view( 'layout/header', $data );
            $this->load->view( 'student/studentReport', $data );
            $this->load->view( 'layout/footer', $data );
        } else {
            $this->form_validation->set_rules( 'class_id', 'Class', 'trim|required|xss_clean' );
            if ( $this->form_validation->run() == FALSE ) {
                $this->load->view( 'layout/header', $data );
                $this->load->view( 'student/studentReport', $data );
                $this->load->view( 'layout/footer', $data );
            } else {
                $class = $this->input->post( 'class_id' );
                $section = $this->input->post( 'section_id' );
                $category_id = $this->input->post( 'category_id' );
                $gender = $this->input->post( 'gender' );
                $rte = $this->input->post( 'rte' );
                $search = $this->input->post( 'search' );
                if ( isset( $search ) ) {
                    if ( $search == 'search_filter' ) {
                        $resultlist = $this->student_model->searchByClassSectionCategoryGenderRte( $class, $section, $category_id, $gender, $rte );
                        $data['resultlist'] = $resultlist;
                    }
                    $data['class_id'] = $class;
                    $data['section_id'] = $section;
                    $data['category_id'] = $category_id;
                    $data['gender'] = $gender;
                    $data['rte_status'] = $rte;
                    $this->load->view( 'layout/header', $data );
                    $this->load->view( 'student/studentReport', $data );
                    $this->load->view( 'layout/footer', $data );
                }
            }
        }
    }

    public function download( $student_id, $doc )
    {
        $this->load->helper( 'download' );
        $filepath = "./uploads/student_documents/$student_id/" . $this->uri->segment( 4 );
        $data = file_get_contents( $filepath );
        $name = $this->uri->segment( 6 );
        force_download( $name, $data );
    }

    function character_certifcate()
    {
        $student_id =     $this->input->get('student_id');
        $section    =     $this->input->get('section');
        $data['section']              = $section;
        $session                    = $this->setting_model->getCurrentSession();
        $data['title']              = 'Certifcate';
        $class_sections             = $this->classsection_model->class_sections(null,$class_id,$section_id);
        $student                = $this->student_model->get($student_id);
        $data['student']              = $student;
        $class_details  = $this->class_model->get( $student['class_id'] );
        $data['class_details'] =  $class_details ;
        $class_details2  = $this->class_model->get( $student['admission_class'] );
        $data['class_details2'] =  $class_details2 ;
        $school_name            = $this->setting_model->getCurrentSchoolName();
        $data['school_name']    = $school_name;
        $school_logo            = $this->setting_model->getCurrentImage();
        $data['school_logo']    = $school_logo;
        $data['print_title']    = $title_mark;

        $this->load->view('layout/header', $data);
        $this->load->view('student/student_certifcate', $data);

    }
    function award_list()
    {
        $student_id =     $this->input->get('student_id');
        $section    =     $this->input->get('section');
        $data['section']              = $section;
        $session                    = $this->setting_model->getCurrentSession();
        $data['title']              = 'Certifcate';
        $class_sections             = $this->classsection_model->class_sections(null,$class_id,$section_id);
        $student                = $this->student_model->get($student_id);
        $data['student']              = $student;
        $class_details  = $this->class_model->get( $student['class_id'] );
        $data['class_details'] =  $class_details ;
        $class_details2  = $this->class_model->get( $student['admission_class'] );
        $data['class_details2'] =  $class_details2 ;
        $school_name            = $this->setting_model->getCurrentSchoolName();
        $data['school_name']    = $school_name;
        $school_logo            = $this->setting_model->getCurrentImage();
        $data['school_logo']    = $school_logo;
        $data['print_title']    = $title_mark;

        $this->load->view('layout/header', $data);
        $this->load->view('student/student_certifcate', $data);

    }
    function send_message()
    {
        $data['title']          = 'Messaging and Communication Center';
        $current_date = new DateTime( date( "Y-m-d", now() ) );
        $data['current_date'] = $current_date;

        $data['class_sections'] =$class_sections;
        $message_result         = $this->student_model->get_message();
        $data['messages']    = $message_result;
        $this->load->view( 'layout/header', $data );
        $this->load->view( 'student/message_list', $data );
        $this->load->view( 'layout/footer', $data );
    }
    function send_message_exam()
    {
     
        $data['title']          = 'Messaging and Communication Center';
        $class_sections = $this->classsection_model->class_sections();
        $current_date = new DateTime( date( "Y-m-d", now() ) );
        $data['current_date'] = $current_date;
        $data['class_sections'] =$class_sections;
        $message_result         = $this->student_model->get_message();
        $data['messages']    = $message_result;
        $class                  = $this->class_model->get();
        $data['classlist']      = $class;
        $class_sections = $this->classsection_model->class_sections();
        $data['class_sections']   = $class_sections;
        $examid             = $this->input->get('exam_id');
        $data['exam_id']    = $examid==null?-1:$examid;
        $exam_result        = $this->exam_model->get();
        $data['examlist']   = $exam_result;
        if (!empty($examid)) {
            $exam_name          = $this->exam_model->get($examid);
            $data['examname']   = $exam_name['name'];
        }
        $this->load->view( 'layout/header', $data );
        $this->load->view( 'student/message_exam', $data );
        $this->load->view( 'layout/footer', $data );
    }

    function send_message_other()
    {
        $data['title']          = 'Messaging and Communication Center';
        $class_id   = $this->input->get( 'class_id' );
        $section_id = $this->input->get( 'section_id' );
        $other_fee_types      = $this->input->get( 'other_fee_types' );
        $data['other_fee_types1']      = $other_fee_types;
        $fee_types              = $this->student_fee_type_model->get();
        $data['fee_types']      = $fee_types;
        $class                  = $this->class_model->get();
        $data['classlist']      = $class;
        $month1    = $this->input->get( 'month' );
        
        $month = !empty($month1) ? date('F', mktime(0, 0, 0, $month1, 10)) :  null;    
          
        $data['month'] = $month;
      
        
        $month_names = [];
            $month_name_date = new DateTime( date( 'Y-01-01', now() ) );
            for ( $i = 0; $i < 12; $i++ ) {
                $month_names[] = $month_name_date->format( 'F' );
                $month_name_date->add( new DateInterval( 'P1M' ) );
            }
            
            $data['month_names1'] = $month_names;
        $std_id = NULL;
        $student_unpaid = array();
        $unpaid_students_other = $this->student_fee_voucher_model->get_unpaid_other2($student_id ,$id,$class_id, $section_id,$other_fee_types, $month1 );
        $std_id = NULL;
        $student_unpaid = array();
        foreach ($unpaid_students_other as $key => $s_payments) {
            $student_unpaid[$key]["student_id"]       =  $s_payments['student_id'];
            $student_unpaid[$key]["voucher_id"]     =  $s_payments['id'];
            $student_unpaid[$key]["total_fee"]     =  $s_payments['total_fee'];
            $student_unpaid[$key]["created_voucher"]     =  $s_payments['created_at'];
            $student_unpaid[$key]["due_voucher"]     =  $s_payments['due_date'];
            $student_unpaid[$key]["voucher_fee_types"]     =  $s_payments['voucher_fee_types'];
            $std_num =  $key;
            $std_id  = $s_payments['student_id'];
        }
        $student_unpaid = array_values($student_unpaid);
        for ( $i = 0; $i < count( $student_unpaid ); $i++ ) {
            $student_unpaid[$i]['student'] = $this->student_model->get( $student_unpaid[$i]['student_id'] );
        }
        $data['unpaid_students_other']  = $student_unpaid;
      
        $this->load->view( 'layout/header', $data );
        $this->load->view( 'student/message_other', $data );
        $this->load->view( 'layout/footer', $data );
    }
    function send_message_tuition()
    {
        $this->session->set_userdata( 'top_menu', 'TeacherAttendance' );
        $this->session->set_userdata( 'sub_menu', 'teacher/index' );
        $data['title']          = 'Messaging and Communication Center';
        $class_id   = $this->input->get( 'class_id' );
        $section_id = $this->input->get( 'section_id' );
        $month      = $this->input->get( 'month' );
        $month = $month != null ? $month : date('m');

        $month_names = [];
        $month_name_date = new DateTime( date( 'Y-01-01', now() ) );
        for ( $i = 0; $i < 12; $i++ ) {
            $month_names[] = $month_name_date->format( 'F' );
            $month_name_date->add( new DateInterval( 'P1M' ) );
        }
        $data['month'] = $month;  
        $data['month_names1'] = $month_names;
        $current_date = new DateTime( date( "Y-m-d", now() ) );
        $data['current_date'] = $current_date;
        $message_result         = $this->student_model->get_message();
        $class                  = $this->class_model->get();
        $data['classlist']      = $class;

        $month = $month != null ? $month : date('m');
        $unpaid_students = $this->student_fee_voucher_model->get_unpaid2( $student_id ,$id, $class_id, $section_id , $month );
        $std_id = NULL;
        $student_unpaid = array();
        foreach ($unpaid_students as $key => $s_payments) {
            $student_unpaid[$key]["student_id"]         =  $s_payments['student_id'];
            $student_unpaid[$key]["voucher_id"]         =  $s_payments['id'];
            $student_unpaid[$key]["total_fee"]          =  $s_payments['total_fee'];
            $student_unpaid[$key]["created_voucher"]    =  $s_payments['created_at'];
            $student_unpaid[$key]["due_voucher"]        =  $s_payments['due_date'];
            $student_unpaid[$key]["fee"]                =  $s_payments['fee'];
            $student_unpaid[$key]["discount"]           =  $s_payments['discount'];
            $student_unpaid[$key]["voucher_fee_types"]  =  $s_payments['voucher_fee_types'];
            $student_unpaid[$key]["voucher_arrears"]    =  $s_payments['arrears'];
            $student_unpaid[$key]["admission_no"]       =  $s_payments['admission_no'];
            $student_unpaid[$key]["father_phone"]       =  $s_payments['father_phone'];
            
            $student_unpaid[$key]["class"]              =  $s_payments['class'];
            $student_unpaid[$key]["section"]            =  $s_payments['section'];
            $student_unpaid[$key]["roll_no"]            =  $s_payments['roll_no'];
            $student_unpaid[$key]["lastname"]           =  $s_payments['lastname'];
            $student_unpaid[$key]["firstname"]          =  $s_payments['firstname'];
            $student_unpaid[$key]["father_cnic"]        =  $s_payments['father_cnic'];
            $student_unpaid[$key]["father_name"]        =  $s_payments['father_name'];
            $student_unpaid[$key]["admission_date"]     =  $s_payments['admission_date'];
            $student_unpaid[$key]["id"]                 =  $s_payments['id'];
            $std_num =  $key;
            $std_id  = $s_payments['student_id'];
        }
        $student_unpaid = array_values($student_unpaid);
        $data['unpaid_students']  = $student_unpaid;
        $this->load->view( 'layout/header', $data );
        $this->load->view( 'student/message_tuition', $data );
        $this->load->view( 'layout/footer', $data );
    }
    function view_message($id)
    {
        $data['title']          = 'Select to Send Message';
        $class_sections = $this->classsection_model->class_sections();
        for ( $i = 0; $i < count( $class_sections ); $i++ ) {
            $class_sections[$i]['students'] = $this->student_model->searchByClassSection( $class_sections[$i]['class_id'], $class_sections[$i]['section_id'] );
        }


        $message_result         = $this->student_model->get_message($id);

        $teachers = $this->teacher_model->get();
        $staff = $this->staff_model->get();


        $data['teachers'] = $teachers;
        $data['staffs'] = $staff;

        $data['messages']       = $message_result;

        $data['class_sections'] =$class_sections;
        $this->load->view( 'layout/header', $data );
        $this->load->view( 'student/message_view', $data );
        $this->load->view( 'layout/footer', $data );
    }

    function user_message()
    {
        $data['title']      = 'Select to Send Message';
        $class_sections     = $this->classsection_model->class_sections();
        for ( $i = 0; $i < count( $class_sections ); $i++ ) {
            $class_sections[$i]['students'] = $this->student_model->searchByClassSection( $class_sections[$i]['class_id'], $class_sections[$i]['section_id'] );
        }
        $parentList         =  $this->parent_model->get();
        $message_result     = $this->student_model->get_message();
        $teachers           = $this->teacher_model->get();
        $staff              = $this->staff_model->get();

        $data['teachers']   = $teachers;
        $data['staffs']     = $staff;
        $data['parentList'] = $parentList;
        $data['messages']   = $message_result;

        $data['class_sections'] =$class_sections;
        $this->load->view( 'layout/header', $data );
        $this->load->view( 'student/message_user', $data );
        $this->load->view( 'layout/footer', $data );
    }

    public function send_message_process()
    {

        $message            = $this->input->post( 'message' );

        $message_title            = $this->input->post( 'message_title' );

        $message_id            = $this->input->post( 'message_id' );

        $student_ids    = $this->input->post( 'student_ids' );

        $teacher_ids    = $this->input->post( 'teacher_ids' );

        $staff_ids    = $this->input->post( 'staff_ids' );

        $admin_id    = $this->input->post( 'admin_id' );

        $message_date    = $this->input->post( 'message_date' );


        if($message_id == null){
            $date = date('Y-m-d', strtotime($message_date ));


            // insert record in student fee voucher table
            $this->db->insert( 'new_message', [
                'date' => $date,
                'title' => $message_title,
                'message' =>$message,
            ] );
        }else{

            $this->db->update( 'new_message', array(
                'message' => $message,
                'title' => $message_title,
            ), array(
                'id' => $message_id
            ) );


            $message_details         = $this->student_model->get_message($message_id);
            $adminsess = $this->session->userdata( 'admin' );
            $this->load->helper('menu_helper');
            $permission = admin_permission($adminsess['id']);
            $message_to_send =  $message_details['message'];

            $date_send  =date('Y-m-d', now());
            if($permission->school_message == 0 ){
                $school_name = '';
            }else{
                $school_name = $this->setting_model->getCurrentSchoolName();
            }
            
            if($student_ids !== null){
                foreach($student_ids as $student_id){
                    $this->db->insert( 'send_message', [
                        'date' => $date_send,
                        'message' =>$message_to_send,
                        'sending_id' =>  $student_id,
                    ] );
                    $student = $this->student_model->get($student_id);
                    $this->sms_library->send_sms( $student['father_phone'], $this->sms_messages->student_specific_message(  $message_to_send ,$school_name ) );


                }
            }

            if($teacher_ids !== null){
                foreach($teacher_ids as $teacher_id){

                    $this->db->insert( 'send_message', [
                        'date' => $date_send,
                        'message' =>$message_to_send,
                        'sending_id' =>  $teacher_id,
                    ] );

                    $teacher = $this->teacher_model->get($teacher_id);

                    $this->sms_library->send_sms( $teacher['phone'], $this->sms_messages->student_specific_message(  $message_to_send  ,$school_name ) );


                }
            }
            if($staff_ids !== null){
                foreach($staff_ids as $staff_id){

                    $this->db->insert( 'send_message', [
                        'date' => $date_send,
                        'message' =>$message_to_send,
                        'sending_id' =>  $staff_id,
                    ] );

                    $staff = $this->staff_model->get($staff_id);

                    $this->sms_library->send_sms( $staff['phone'], $this->sms_messages->student_specific_message(  $message_to_send ,$school_name ) );


                }
            }
            if($admin_id !== null){
                $this->db->insert( 'send_message', [
                    'date' => $date_send,
                    'message' =>$message_to_send,
                    'sending_id' =>$admin_id ,
                ] );

                $admin_phone = $this->custom_option_model->get( 'admin_phone' );
                $this->sms_library->send_sms( $admin_phone['value'], $this->sms_messages->student_specific_message(  $message_to_send ,$school_name ) );

            }
        }

        redirect('student/send_message');

    }
    public function send_message_username()
    {


        $teacher_ids            = $this->input->post( 'teacher_ids' );

        $parent_ids             = $this->input->post( 'parent_ids' );

        $admin_id               = $this->input->post( 'admin_id' );

        $message_date           = $this->input->post( 'message_date' );


            
        
            // $message_details         = $this->student_model->get_message($message_id);
            $adminsess = $this->session->userdata( 'admin' );
            $this->load->helper('menu_helper');
            $permission = admin_permission($adminsess['id']);
            // $message_to_send =  $message_details['message'];

            $date_send  =date('Y-m-d', now());
            if($permission->school_message == 0 ){
                $school_name = '';
            }else{
                $school_name = $this->setting_model->getCurrentSchoolName();
            }
            
            

            if($teacher_ids !== null){
                foreach($teacher_ids as $teacher_id){
                    $teacher = $this->teacher_model->getTeacher($teacher_id);
                  
                    $message_to_send = 'Username  '.$teacher['username'].' Password '.$teacher['user_tbl_password']  ;
                    $this->db->insert( 'send_message', [
                        'date' => $date_send,
                        'message' =>$message_to_send,
                        'sending_id' =>  $teacher_id,
                    ] );

                    $this->sms_library->send_sms( $teacher['phone'], $this->sms_messages->student_specific_message(  $message_to_send  ,$school_name ) );

                }
            }
            if($parent_ids !== null){
                foreach($parent_ids as $parent_id){
                  
                    $parent = $this->parent_model->get_parents($parent_id);
                  
                    $message_to_send = 'Username  '.$parent->username.' Password '.$parent->password  ;
                  
                    $this->db->insert( 'send_message', [
                        'date' => $date_send,
                        'message' =>$message_to_send,
                        'sending_id' =>  $parent_id,
                    ] );
                  
                   
                  
                   $this->sms_library->send_sms( $parent->username, $this->sms_messages->student_specific_message(  $message_to_send ,$school_name ) );
                  

                }
            }

            if($admin_id !== null){
                $admin = $this->admin_model->get($admin_id);
            
                $message_to_send = 'Username  '.$admin['email'].' Password '.MD5($admin['password'])  ;
                $this->db->insert( 'send_message', [
                    'date' => $date_send,
                    'message' =>$message_to_send,
                    'sending_id' =>$admin_id ,
                ] );

                $admin_phone = $this->custom_option_model->get( 'admin_phone' );
                $this->sms_library->send_sms( $admin_phone['value'], $this->sms_messages->student_specific_message(  $message_to_send ,$school_name ) );

            }
     

        redirect('student/send_message');

    }
    function update_message()
    {
        $message_id            = $this->input->post( 'message_id' );
        $message               = $this->input->post( 'message' );
        $message_title         = $this->input->post( 'message_title' );


        $this->db->update( 'new_message', array(
            'message' => $message,
            'title' => $message_title,
        ), array(
            'id' => $message_id
        ) );



        redirect( 'student/view_message/'.$message_id);
    }

    function delete_message( $id )
    {
        $this->db->delete( 'new_message', [
            'id' => $id
        ]);
        redirect( 'student/send_message' );
    }

    function view( $id )
    {
        $redirect_url           = current_url() . '?' . $this->input->server( 'QUERY_STRING' );
        $data['redirect_url']   = $redirect_url;
        $data['title'] = 'Student Details';
        $student = $this->student_model->get( $id );

        $sibling_type = $this->custom_option_model->get( 'sibling_type' );
           
        if($sibling_type['value'] == "phone_sibling" && $student['father_phone'] != null){

            $children = $this->student_model->family_children( $student['father_phone'] , null  ); 

        }elseif( $sibling_type['value'] == "cnic_sibling" && $student['father_cnic'] != null){

            $children  = $this->student_model->family_children(null,$student['father_cnic']);

        }
        $data['children'] =    $children;
        
            

        $gradeList = $this->grade_model->get();
        $student_session_id = $student['student_session_id'];
        $student_due_fee = $this->studentfeemaster_model->getStudentFees( $student_session_id );
        $student_discount_fee = $this->feediscount_model->getStudentFeesDiscount( $student_session_id );
        $data['student_discount_fee'] = $student_discount_fee;
        $data['student_due_fee'] = $student_due_fee;


        $examList = $this->examschedule_model->getExamByClassandSection( $student['class_id'], $student['section_id'] );

        $data['examSchedule'] = array();
        if ( !empty( $examList ) ) {
            $new_array = array();
            foreach ( $examList as $ex_key => $ex_value ) {
                $array = array();
                $x = array();
                $exam_id = $ex_value['exam_id'];
                $student['id'];
                $exam_subjects = $this->examschedule_model->getresultByStudentandExam( $exam_id, $student['id'] );
             
                foreach ( $exam_subjects as $key => $value ) {
                    $exam_array = array();
                    $exam_array['exam_schedule_id'] = $value['exam_schedule_id'];
                    $exam_array['exam_id'] = $value['exam_id'];
                    $exam_array['full_marks'] = $value['max_marks'];
                    $exam_array['passing_marks'] = $value['passing_marks'];
                    $exam_array['exam_name'] = $value['name'];
                    $exam_array['exam_type'] = $value['type'];
                    $exam_array['attendence'] = $value['attendence'];
                    $exam_array['get_marks'] = $value['get_marks'];
                    $x[] = $exam_array;
                }
                $array['exam_name'] = $ex_value['name'];
                $array['exam_result'] = $x;
                $new_array[] = $array;
            }
            $data['examSchedule'] = $new_array;
        }

        $student_doc = $this->student_model->getstudentdoc( $id );
        $data['student_doc'] = $student_doc;
        $data['student_doc_id'] = $id;
        $category_list = $this->category_model->get();
        $data['category_list'] = $category_list;
        $data['gradeList'] = $gradeList;
        $data['student'] = $student;

        $class_details2  = $this->class_model->get( $student['admission_class'] );

        $data['class_details'] = $class_details2;

        $resultlist                 = array();

        $student_id                 = $this->input->post_get( 'student_id' );
        $month                      = date('F', now());

  
        $data['month_selected']     = $month;

        $unpaid_students_other = $this->student_fee_voucher_model->get_unpaid_other($id );
        $data['unpaid_students_other']  = $unpaid_students_other;

        $discount_history =  $this->student_model->get_discount( $id);

        $data['discount_history'] =  $discount_history;
        $studentlist                = $this->student_model->getstudents( $id );
        $session_current            = $this->setting_model->getCurrentSessionName();
        $startMonth                 = $this->setting_model->getStartMonth();
        $centenary                  = substr( $session_current, 0, 2 ); //2017-18 to 2017
        $year_first_substring       = substr( $session_current, 2, 2 ); //2017-18 to 2017
        $year_second_substring      = substr( $session_current, 5, 2 ); //2017-18 to 18

        $month_number[] = array();

        for ( $m = 1; $m < 13; $m++ ):

            $month_number = str_pad($m,2,0,STR_PAD_LEFT);

        endfor;

        if ( $month_number >= $startMonth && $month_number <= 12 ) {
            $year = $centenary . $year_first_substring;
        } else {
            $year = $centenary . $year_second_substring;
        }
        $year  = date( 'Y', now() );
        $attr_result            = array();
        $attendence_array       = array();
        $student_result         = array();
   
        $attendance_dates = [];

        $month_number2  = date('m', now());

        $num_of_days  = cal_days_in_month( CAL_GREGORIAN, $month_number2, $year );

        for ( $day_number = 1; $day_number <= $num_of_days; $day_number++ ) {
            $attendance_dates[] = "{$year}-{$month}-{$day_number}";
        }




        for ( $m = 1; $m < 13; $m++ ):
            $students[$m]['day_attendance'] = array();
            $annual = $m;
            for ( $i = 1; $i <= $num_of_days; $i++ ) {
                $att_date = $year . "-" . $annual . "-" . sprintf( "%02d", $i );
                $attendence_array[] = $att_date;
                $students[$m]['day_attendance'][$att_date] = $this->stuattendence_model->searchAttendencestudent($id,  $att_date );
            }
        endfor;

        $student_details                   = $this->student_model->getstudents($id);
        $data['year'] = $year;
        $data['student_details']         = $student_details;
        $data['resultlist']         = $students;
        $data['attendence_array']   = $attendance_dates;
        $result_subjects = $this->teachersubject_model->getSubjectByClsandSection($student['class_id'], $student['section_id']);
        $getDaysnameList = $this->customlib->getDaysname();
        $data['getDaysnameList'] = $getDaysnameList;
        $final_array = array();
        if (!empty($result_subjects)) {
            foreach ($result_subjects as $subject_k => $subject_v) {
                $result_array = array();
                foreach ($getDaysnameList as $day_key => $day_value) {
                    $where_array = array(
                        'teacher_subject_id' => $subject_v['id'],
                        'day_name' => $day_value
                    );
                    $result = $this->timetable_model->get($where_array);
                    if (!empty($result)) {
                        $obj = new stdClass();
                        $obj->status = "Yes";
                        $obj->start_time = $result[0]['start_time'];
                        $obj->end_time = $result[0]['end_time'];
                        $obj->room_no = $result[0]['room_no'];
                        $result_array[$day_value] = $obj;
                    } else {
                        $obj = new stdClass();
                        $obj->status = "No";
                        $obj->start_time = "N/A";
                        $obj->end_time = "N/A";
                        $obj->room_no = "N/A";
                        $result_array[$day_value] = $obj;
                    }
                }
                $final_array[$subject_v['name']] = $result_array;
            }
        }
        $data['result_array'] = $final_array;
        $subject_list = $this->teachersubject_model->getSubjectByClsandSection($student['class_id'], $student['section_id']);
        $data['subject_array'] = $subject_list;
        $this->load->view( 'layout/header', $data );
        $this->load->view( 'student/studentShow', $data );
        $this->load->view( 'layout/footer', $data );
    }

    function exportformat()
    {
        $array = array(
            array(
                "admission_no",
                "roll_no",
                "admission_date(dd-mm-yyyy)",
                "firstname",
                "lastname",
                "gender (male or female)",
                "mobileno",
                "email",
                "discount (in Rs.)",
                "religion",
                "dob(dd-mm-yyyy)",
                "current_address",
                "permanent_address",
                "father_name",
                "father_phone",
                "father_occupation",
                "father_cnic",
                "guardian_name",
                "guardian_relation",
                "guardian_phone",
                "guardian_address"),
        );
        $this->load->helper( 'csv' );
        echo array_to_csv( $array, 'import_student_sample_file.csv' );
    }

    function delete( $id )
    {
        $this->student_model->remove( $id );
        $this->session->set_flashdata( 'msg', '<i class="fa fa-check-square-o" aria-hidden="true"></i> Record Deleted Successfully' );
        redirect( 'student/search' );
    }

    function doc_delete( $id, $student_id )
    {
        $this->student_model->doc_delete( $id );
        $this->session->set_flashdata( 'msg', '<i class="fa fa-check-square-o" aria-hidden="true"></i> Document Deleted Successfully' );
        redirect( 'student/view/' . $student_id );
    }

    function discount_delete( $id, $student_id )
    {
        $this->student_model->discount_delete( $id );
        $this->session->set_flashdata( 'msg', '<i class="fa fa-check-square-o" aria-hidden="true"></i> Discount Deleted Successfully' );
        redirect( 'fee_management/receive_fee/' . $student_id );
    }

    function create()
    {
        $this->session->set_userdata( 'top_menu', 'Student Information' );
        $this->session->set_userdata( 'sub_menu', 'student/create' );
        $genderList             = $this->customlib->getGender();
        $data['genderList']     = $genderList;
        $data['title']          = 'Add Student';
        $data['title_list']     = 'Recently Added Student';
        $session                = $this->setting_model->getCurrentSession();
        $student_result         = $this->student_model->getRecentRecord();
        $data['studentlist']    = $student_result;
        $class                  = $this->class_model->get();
        $data['classlist']      = $class;
        $category               = $this->category_model->get();
        $data['categorylist']   = $category;
        $vehroute_result        = $this->vehroute_model->get();
        $ad_id                  = $this->student_model->ad_id();

        $data['admission_key'] = $this->setting_model->getadmissionkey();
              
        $fee_starting = new stdClass();
        $fee_starting->year = [
            intval( date( 'Y', now() ) ),
            intval( date( 'Y', now() ) ) + 1
        ];
        $fee_starting->month = [];
        $months = new DateTime( date( 'Y-01-01', now() ) );
        for ( $i = 0; $i < 12; $i++ ) {
            $fee_starting->month[] = [
                'name' => $months->format( 'F' ),
                'value' => $months->format( 'm' )
            ];
            $months->add( new DateInterval( 'P1M' ) );
        }
        $data['ad_id']        = $ad_id;
        $data['fee_starting'] = $fee_starting;
        $data['vehroutelist'] = $vehroute_result;
        $this->form_validation->set_rules( 'firstname', 'First Name', 'trim|required|xss_clean' );
        $this->form_validation->set_rules( 'lastname', 'Last Name', 'trim|xss_clean' );
        $this->form_validation->set_rules( 'gender', 'Gender', 'trim|required|xss_clean' );
        $this->form_validation->set_rules( 'dob', 'Date of Birth', 'trim|xss_clean' );
        $this->form_validation->set_rules( 'class_id', 'Class', 'trim|required|xss_clean' );
        $this->form_validation->set_rules( 'section_id', 'Section', 'trim|required|xss_clean' );
        $this->form_validation->set_rules( 'rte', 'RTE', 'trim|xss_clean' );
        $this->form_validation->set_rules( 'guardian_name', 'Guardian Name', 'trim|required|xss_clean' );
        $this->form_validation->set_rules( 'father_name', 'Father Name', 'trim|required|xss_clean' );
        $this->form_validation->set_rules( 'father_cnic', 'Father CNIC', 'trim|max_length[15]' );
        $this->form_validation->set_rules( 'mother_name', 'Mother Name', 'trim|xss_clean' );
        $this->form_validation->set_rules( 'admission_no', 'Admission No', 'trim|required|xss_clean|is_unique[students.admission_no]' );
        $this->form_validation->set_rules( 'file', 'Image', 'callback_handle_upload' );
        $this->form_validation->set_rules( 'discount', 'Discount', 'trim' );
        $this->form_validation->set_rules( 'arrears', 'Arrears', 'trim' );
        $this->form_validation->set_rules( 'advance', 'Advance', 'trim' );
        $this->form_validation->set_rules( 'fee_starting_year', 'Fee Starting Year', 'trim' );
        $this->form_validation->set_rules( 'fee_starting_month', 'Fee Starting Month', 'trim' );

        if ( $this->form_validation->run() == FALSE ) {
            $this->load->view( 'layout/header', $data );
            $this->load->view( 'student/studentCreate', $data );
            $this->load->view( 'layout/footer', $data );
        } else {
            $admission_class    = $this->input->post( 'admission_class_id' );
            $class_id           = $this->input->post( 'class_id' );
            $section_id         = $this->input->post( 'section_id' );
            $discount           = $this->input->post( 'discount' );
            $class_details      = $this->class_model->get( $class_id );
            $fees_discount      = $this->input->post( 'fees_discount' );
            $vehroute_id        = $this->input->post( 'vehroute_id' );
            $dob                = date( 'm/d/Y', strtotime( $this->input->post( 'dob' ) ) );
            $admission_date     = date( "m/d/Y", strtotime( $this->input->post( 'admission_date' ) ) );
            $arrears            = $this->input->post( 'arrears' );
            $advance            = $this->input->post( 'advance' );
            $final_arrears      = floatval( $arrears ) - floatval( $advance );
            $fee_starting_year  = $this->input->post( 'fee_starting_year' );
            $fee_starting_month = $this->input->post( 'fee_starting_month' );
            $fee_starting_date  = date( 'Y-m-d', strtotime( "{$fee_starting_year}-{$fee_starting_month}-01" ) );
            
            $admission_key = $this->setting_model->getadmissionkey();
          
            if( $admission_key == 1){
                $admission_no = $this->input->post( 'class_group' ).$this->input->post( 'admission_no' );
            }else{
                $admission_no = $this->input->post( 'admission_no' );
            }
            $data = array(
                'discount'          => ( $discount === null ? 0 : $discount ),
                'admission_no'      => $admission_no,
                'roll_no'           => $this->input->post( 'roll_no' ),
                'admission_date'    => date( 'Y-m-d', $this->customlib->datetostrtotime( $admission_date ) ),
                'firstname'         => $this->input->post( 'firstname' ),
                'lastname'          => $this->input->post( 'lastname' ),
                'mobileno'          => $this->input->post( 'mobileno' ),
                'admission_class'   => $this->input->post( 'admission_class_id' ),
                'rte'               => $this->input->post( 'rte' ),
                'email'             => $this->input->post( 'email' ),
                'state'             => $this->input->post( 'state' ),
                'city'              => $this->input->post( 'city' ),
                'guardian_is'       => $this->input->post( 'guardian_is' ),
                'pincode'           => $this->input->post( 'pincode' ),
                'religion'          => $this->input->post( 'religion' ),
                'cast'              => $this->input->post( 'cast' ),
                'b_form'            => $this->input->post( 'b_form' ),
                'previous_school'   => $this->input->post( 'previous_school' ),
                'dob'               => date( 'Y-m-d', $this->customlib->datetostrtotime( $dob ) ),
                'current_address'   => $this->input->post( 'current_address' ),
                'permanent_address' => $this->input->post( 'permanent_address' ),
                'image'             => 'uploads/student_images/no_image.png',
                'category_id'       => $this->input->post( 'category_id' ),
                'adhar_no'          => $this->input->post( 'adhar_no' ),
                'samagra_id'        => $this->input->post( 'samagra_id' ),
                'bank_account_no'   => $this->input->post( 'bank_account_no' ),
                'bank_name'         => $this->input->post( 'bank_name' ),
                'ifsc_code'         => $this->input->post( 'ifsc_code' ),
                'father_name'       => $this->input->post( 'father_name' ),
                'father_phone'      => $this->input->post( 'father_phone' ),
                'father_occupation' => $this->input->post( 'father_occupation' ),
                'father_cnic'       => $this->input->post( 'father_cnic' ),
                'mother_name'       => $this->input->post( 'mother_name' ),
                'mother_phone'      => $this->input->post( 'mother_phone' ),
                'mother_occupation' => $this->input->post( 'mother_occupation' ),
                'guardian_occupation' => $this->input->post( 'guardian_occupation' ),
                'gender'            => $this->input->post( 'gender' ),
                'guardian_name'     => $this->input->post( 'guardian_name' ),
                'guardian_relation' => $this->input->post( 'guardian_relation' ),
                'guardian_phone'    => $this->input->post( 'guardian_phone' ),
                'guardian_address'  => $this->input->post( 'guardian_address' ),
                'fee_arrears'       => $final_arrears,
                'fee_starting_date' => $fee_starting_date
            );

            // if admission date is greater than 20
            //if ( intval( date( 'j', strtotime( $this->input->post( 'admission_date' ) ) ) ) > 20 ) {
            // adding fee update time to admission month's start
            //$data['fee_update_date'] = date( 'Y-m-01', strtotime( $this->input->post( 'admission_date' ) ) );
            //}

            $insert_id = $this->student_model->add( $data );

            if ( !empty( $data['father_phone'] ) ) {
                $firstname  = $this->input->post( 'firstname' );
                $lastname   = $this->input->post( 'lastname' );

                $adminsess = $this->session->userdata( 'admin' );
                $this->load->helper('menu_helper');
                $permission = admin_permission($adminsess['id']);
                if($permission->school_message == 0 ){
                    $school_name = '';
                }else{
                    $school_name = $this->setting_model->getCurrentSchoolName();
                }

            

                $this->sms_library->send_sms( $data['father_phone'], $this->sms_messages->new_admission_sms($firstname,$lastname,$school_name) );
            }
            $data_new = array(
                'student_id'    => $insert_id,
                'class_id'      => $class_id,
                'section_id'    => $section_id,
                'session_id'    => $session,
                'vehroute_id'   => $vehroute_id,
                'fees_discount' => $fees_discount
            );
            // adding or updating class promotion demotion details
            $this->class_promotion_demotion_model->add( [
                'session_id'    => $session,
                'class_id'      => $class_id,
                'section_id'    => $section_id,
                'promoted'      => 0,
                'demoted'       => 0,
                'new_admission' => 1
            ] );
            $student_session_id = $this->student_model->add_student_session( $data_new );
            // free student
            $free_student   = ( intval( $class_details['fee'] ) - intval( $discount ) <= 0 ? 1 : 0 );

            $without_fee    = ( intval( date( 'd', strtotime( $data['admission_date'] ) ) ) >= 20 ? 1 : 0 );

            // adding new admission log to the student log table
            if ( !empty( $student_session_id ) ) {
                $new_current_month_admission = date( 'Y-m', strtotime( $this->input->post( 'admission_date' ) ) ) == date( 'Y-m', now() );
                $this->student_log_model->add( $student_session_id, date( 'Y-m-d', now() ), $new_current_month_admission, 0, 0, $free_student, $without_fee );
            }

            $user_password = $this->role->get_random_password( $chars_min = 6, $chars_max = 6, $use_upper_case = false, $include_numbers = true, $include_special_chars = false );
            
            $father_phone =  $this->input->post( 'father_phone' );
            
            $father_cnic  =  $this->input->post( 'father_cnic' );
            
            $sibling_type = $this->custom_option_model->get( 'sibling_type' );
            

            if($sibling_type['value'] == "cnic_sibling"){

                $sibling  = $this->user_model->check_sibling_cnic($father_cnic);
         
            }elseif( $sibling_type['value'] == "phone_sibling"){

                $sibling  = $this->user_model->check_sibling($father_phone);
           
            }
            if($sibling){
                $sibling_id = $sibling[0]['user_id'];
            }
            $data_student_login = array(
                'username'  => $this->student_login_prefix . $insert_id,
                'password'  => $user_password,
                'user_id'   => $insert_id,
                'role'      => 'student'
            );
            $this->user_model->add( $data_student_login );
             
                $countsib       = 0;
                $up_record      = 0;
                $record_value   = "";
             

                if ( isset( $sibling_id ) ) {
                    
                    $findusers      = $this->user_model->read_user();
                    $find           = $sibling_id;

                    foreach ( $findusers as $key => $value ) {
                      
                        if ( $value->childs != "" ) {
                            $childs = explode( ",", $value->childs );
                            foreach ( $childs as $k_child => $v_child ) {
                                    
                                if ( $find == $v_child ) {
                                    $up_record = $value->id;
                                    $record_value = $value->childs;
                                    $countsib = 1;
                                   
                                  
                                    break;
                                }
                            }
                        }
                    }
                }
               

                if ( $countsib != 0 ) {
                    $json               = array($insert_id);
                    $da                 = array_merge( (array)$record_value, (array)$json );
                    $rec                = implode( ",", $da );
                    $data_parent_login  = array(
                        'id'        => $up_record,
                        'childs'    => $rec
                    );
                    $ins_id             = $this->user_model->add( $data_parent_login );
                } else {
                    $parent_password    = $this->role->get_random_password( $chars_min = 6, $chars_max = 6, $use_upper_case = false, $include_numbers = true, $include_special_chars = false );
                    $temp               = $insert_id;
                    $data_parent_login  = array(
                        'username'  => str_replace("-", "", $father_phone), //$this->parent_login_prefix . $insert_id,
                        'password'  => str_replace("-", "", $father_phone),  // $parent_password,
                        'user_id'   => $insert_id,
                        'role'      => 'parent',
                        'childs'    => $temp
                    );
                    $ins_id = $this->user_model->add( $data_parent_login );
                }
           
            if ( isset( $_FILES["file"] ) && !empty( $_FILES['file']['name'] ) ) {
                $fileInfo = pathinfo( $_FILES["file"]["name"] );
                $img_name = $insert_id . '.' . $fileInfo['extension'];
                $setting_result = $this->setting_model->get();
                // $name      = str_replace(' ', '-', strtolower($setting_result[0]['name']));
                $name = base_url();
                $name = str_replace("https://", "", $name);
                $name = str_replace("http://", "", $name);
                $name = str_replace("/", "", $name);

                if (!file_exists("./uploads/".$name)) {
                    mkdir("./uploads/".$name, 0777, true);
                }

                if (!file_exists("./uploads/".$name."/student_images/")) {
                    mkdir("./uploads/".$name."/student_images/", 0777, true);
                }
                
                move_uploaded_file( $_FILES["file"]["tmp_name"], "./uploads/".$name."/student_images/".$img_name );
                $data_img = array('id' => $insert_id, 'image' => "./uploads/".$name."/student_images/".$img_name);
                $this->student_model->add( $data_img );
            }
            if ( isset( $_FILES["first_doc"] ) && !empty( $_FILES['first_doc']['name'] ) ) {
                $uploaddir = './uploads/'.$name.'/student_documents/' . $insert_id . '/';
                if ( !is_dir( $uploaddir ) && !mkdir( $uploaddir ) ) {
                    die( "Error creating folder $uploaddir" );
                }
                $fileInfo = pathinfo( $_FILES["first_doc"]["name"] );
                $first_title = $this->input->post( 'first_title' );
                $img_name = $uploaddir . basename( $_FILES['first_doc']['name'] );
                move_uploaded_file( $_FILES["first_doc"]["tmp_name"], $img_name );
                $data_img = array('student_id' => $insert_id, 'title' => $first_title, 'doc' => basename( $_FILES['first_doc']['name'] ));
                $this->student_model->adddoc( $data_img );
            }
            if ( isset( $_FILES["second_doc"] ) && !empty( $_FILES['second_doc']['name'] ) ) {
                $uploaddir = './uploads/'.$name.'student_documents/' . $insert_id . '/';
                if ( !is_dir( $uploaddir ) && !mkdir( $uploaddir ) ) {
                    die( "Error creating folder $uploaddir" );
                }
                $fileInfo = pathinfo( $_FILES["second_doc"]["name"] );
                $second_title = $this->input->post( 'second_title' );
                $img_name = $uploaddir . basename( $_FILES['second_doc']['name'] );
                move_uploaded_file( $_FILES["second_doc"]["tmp_name"], $img_name );
                $data_img = array('student_id' => $insert_id, 'title' => $second_title, 'doc' => basename( $_FILES['second_doc']['name'] ));
                $this->student_model->adddoc( $data_img );
            }
            if ( isset( $_FILES["third_doc"] ) && !empty( $_FILES['third_doc']['name'] ) ) {
                $uploaddir = './uploads/'.$name.'student_documents/' . $insert_id . '/';
                if ( !is_dir( $uploaddir ) && !mkdir( $uploaddir ) ) {
                    die( "Error creating folder $uploaddir" );
                }
                $fileInfo = pathinfo( $_FILES["third_doc"]["name"] );
                $third_title = $this->input->post( 'third_title' );
                $img_name = $uploaddir . basename( $_FILES['third_doc']['name'] );
                move_uploaded_file( $_FILES["third_doc"]["tmp_name"], $img_name );
                $data_img = array('student_id' => $insert_id, 'title' => $third_title, 'doc' => basename( $_FILES['third_doc']['name'] ));
                $this->student_model->adddoc( $data_img );
            }
            if ( isset( $_FILES["fourth_doc"] ) && !empty( $_FILES['fourth_doc']['name'] ) ) {
                $uploaddir = './uploads/'.$name.'student_documents/' . $insert_id . '/';
                if ( !is_dir( $uploaddir ) && !mkdir( $uploaddir ) ) {
                    die( "Error creating folder $uploaddir" );
                }
                $fileInfo = pathinfo( $_FILES["fourth_doc"]["name"] );
                $fourth_title = $this->input->post( 'fourth_title' );
                $img_name = $uploaddir . basename( $_FILES['fourth_doc']['name'] );
                move_uploaded_file( $_FILES["fourth_doc"]["tmp_name"], $img_name );
                $data_img = array('student_id' => $insert_id, 'title' => $fourth_title, 'doc' => basename( $_FILES['fourth_doc']['name'] ));
                $this->student_model->adddoc( $data_img );
            }
            if ( isset( $_FILES["fifth_doc"] ) && !empty( $_FILES['fifth_doc']['name'] ) ) {
                $uploaddir = './uploads/'.$name.'student_documents/' . $insert_id . '/';
                if ( !is_dir( $uploaddir ) && !mkdir( $uploaddir ) ) {
                    die( "Error creating folder $uploaddir" );
                }
                $fileInfo = pathinfo( $_FILES["fifth_doc"]["name"] );
                $fifth_title = $this->input->post( 'fifth_title' );
                $img_name = $uploaddir . basename( $_FILES['fifth_doc']['name'] );
                move_uploaded_file( $_FILES["fifth_doc"]["tmp_name"], $img_name );
                $data_img = array('student_id' => $insert_id, 'title' => $fifth_title, 'doc' => basename( $_FILES['fifth_doc']['name'] ));
                $this->student_model->adddoc( $data_img );
            }


            $result = $this->smsgateway->sentRegisterSMS( $insert_id, $this->input->post( 'guardian_phone' ) );
            $this->session->set_flashdata( 'msg', '<div class="alert alert-success">Student added Successfully</div>' );
            redirect( 'student/create' );

        }
    }

    function parent_create(){

        $students =  $this->student_model->get_sib(null,null,null,null,null,null);


        
        foreach($students as $student){
         $user  =  $this->user_model->get($student['father_phone']);
         $data_parent_login  = array(
             'username'  => str_replace("-", "",  $student['father_phone']),
             'password'  => str_replace("-", "",  $student['father_phone']),
             'user_id'   => $student['id'],
             'role'      => 'parent',
             'childs'    => $student['id']
         );
         $ins_id = $this->user_model->add( $data_parent_login );
         ppp($student);
        }

    }


    function update_teacher(){

        $students =  $this->user_model->get_all_teacher();

        foreach($students as $student){

            $user_password = $this->role->get_random_password( $chars_min = 6, $chars_max = 6, $use_upper_case = false, $include_numbers = true, $include_special_chars = false );

            $teacher_name = $student['name'];
            $teacher_name = strtolower( $teacher_name );
            $teacher_name = preg_replace( "/[^a-zA-Z0-9]+/", '', $teacher_name );
    

           
                // search username in users table
               
                    $data_parent_login  = array(
                        'user_id'        => $student["user_id"],
                        'username'  =>     $teacher_name,
                        'password'  =>$user_password,
                    );
                
                    $ins_id   = $this->user_model->editTeacher( $data_parent_login );
       
       
            
           
        }

        pp($students);


    }



  
    function delete_father(){
        $data =  $this->user_model->read_user_father_all();

        foreach($data  as $key=> $sib ){
            $this->user_model->delete_parents($sib->user_id);
        }

        pp($data);

    }

    function update_username(){
        $data =  $this->user_model->read_user_father_all();
        
            foreach($data as $student){
                if($student->father_phone){
                    $data_parent_login  = array(
                        'user_id'        => $student->user_id,
                        'username'  => str_replace("-", "",  $student->father_phone),
                        'password'  =>str_replace("-", "",  $student->father_phone),
                    );
                $ins_id             = $this->user_model->editParent( $data_parent_login );
                }
            }
        pp($data);
    }


    function update_double_child($length){
    
        

        $students =  $this->student_model->get_sib(null,null,null,null,null,$length);

 ppp($students);
        
        foreach($students as $student){
     
        $sibling  = $this->user_model->check_sibling_student($student['father_phone']);
        
   
    
        foreach($sibling as $sib){

 
            if($student['id'] !=  $sib['user_id']){    /// 270 student_id != user_iD = 271
ppp($sib);

                    $sibling_id = $sib['user_id'];      // 271 
                    $insert_id = $student['id'];      //270          
           
                    if ( isset( $sibling_id ) ) {
                        
                        $countsib       = 0;
                        $up_record      = 0;
                        $record_value   = "";
                        $findusers      = $this->user_model->read_user();
                        $find           = $sibling_id;    // 271
                        foreach ( $findusers as $key => $value ) {
                            
                            if ( $value->childs != "" ) {
                                $childs = explode( ",", $value->childs );
                                
                                foreach ( $childs as $k_child => $v_child ) {
                                    if ( $find == $v_child ) {   //271   == compare child 
                                                                               
                                        $up_record = $value->id;  ///id 221
                                        $record_value = $value->childs; // 106
                                        $countsib = 1;
                                       
                                        
                                        break;
                                    }
                                }
                            }
                        }
                       

                        if ( $countsib != 0 ) {
                            $json               = array($insert_id);    // 106
                            $da                 =  (array)$record_value;  // 106 ,106
                            $rec                = implode( ",", $da );
                            $data_parent_login  = array(
                                'id'        => $up_record,
                                'childs'    => $rec,
                                'username'  => str_replace("-", "",  $student['father_phone'])
                            );
                      $ins_id             = $this->user_model->add( $data_parent_login );
                            if($ins_id){
                                $sibling1  = $this->user_model->check_sibling($student['father_phone']);
                                foreach($sibling1 as $key=> $sib ){
                                    if($key > 0){
                                        $this->db->delete( 'users', [
                                            'id' => $sib['id']
                                        ]);
                                    }
                                }
                            }
                        } else {
                            $sibling1  = $this->user_model->check_sibling($student['father_phone']);
                            $countsib       = 0;
                            $up_record      = 0;
                            $record_value   = "";
                            $findusers      = $this->user_model->read_user();
                            $sibling_id = $student['id']; 
                            $insert_id = $sib['user_id'];      //106          
                            $find           = $sibling_id;
                            foreach ( $findusers as $key => $value ) {
                                if ( $value->childs != "" ) {
                                    $childs = explode( ",", $value->childs );
                                    foreach ( $childs as $k_child => $v_child ) {
                                        if ( $find == $v_child ) {   //259   == 106 
                                            $up_record = $value->id;  ///id 221
                                            $record_value = $value->childs; // 106
                                            $countsib = 1;
                                            break;
                                        }
                                    }
                                }
                            }
                            if ( $countsib != 0 ) {
                                $json               = array($insert_id);    // 106
                                $da                 = array_merge( (array)$record_value, (array)$json );  // 106 ,106
                                $rec                = implode( ",", $da );
                                $data_parent_login  = array(
                                    'id'        => $up_record,
                                    'childs'    => $rec,
                                    'username'  => str_replace("-", "",  $student['father_phone'])
                                );
                              $ins_id             = $this->user_model->add( $data_parent_login );
                            if($ins_id){
                                $sibling1  = $this->user_model->check_sibling($student['father_phone']);
                                    foreach($sibling1 as $key=> $sib ){
                                        if($key > 0){
                                            $this->db->delete( 'users', [
                                                'id' => $sib['id']
                                            ]);
                                        }
                                    }
                                }
                            }
                        }
                    }

            }
        }
    }
//pp($students);


exit;

        

        
    }


    function student_children(){

        $students =  $this->student_model->get_sib();
        
        foreach($students as $student){
            if($student['father_phone']  ){
                    
            $sibling  = $this->user_model->check_sibling_student($student['father_phone']);

                // ppp($sibling);
           

            foreach($sibling as $sib){
                    // if($student['id'] == 10){
                    //     ppp($sib);
                    // }

                    // if($student['id'] ==  $sib['user_id']){
                    //     ppp($student['id']);
                        
                    // }
                    
                if($student['id'] !=  $sib['user_id']){
       //             print_r($student['id']);
                //    ppp($sib);
               // ppp('hello');
  
                //     $sibling_id = $sib['user_id']; 
                //     $insert_id = $student['id'];      //106          
                //     if ( isset( $sibling_id ) ) {
                        
                //         $countsib       = 0;
                //         $up_record      = 0;
                //         $record_value   = "";
                //         $findusers      = $this->user_model->read_user();
                //         $find           = $sibling_id;
                //         foreach ( $findusers as $key => $value ) {
                            
                //             if ( $value->childs != "" ) {
                //                 $childs = explode( ",", $value->childs );
                                
                //                 foreach ( $childs as $k_child => $v_child ) {
                //                     if ( $find == $v_child ) {   //259   == 106 
                                        
                //                         $up_record = $value->id;  ///id 221
                //                         $record_value = $value->childs; // 106
                //                         $countsib = 1;
                //                         break;
                //                     }
                //                 }
                //             }
                //         }
                    
                //         if ( $countsib != 0 ) {
                //             $json               = array($insert_id);    // 106
                //             $da                 = array_merge( (array)$record_value, (array)$json );  // 106 ,106
                //             $rec                = implode( ",", $da );
                          
                //             $data_parent_login  = array(
                //                 'id'        => $up_record,
                //                 'childs'    => $rec,
                //                 'username'  => $student['father_phone']
                //             );
                //             echo "<pre>";
                //             print_r($data_parent_login);
                //             echo "</pre>";
                //         $ins_id             = $this->user_model->add( $data_parent_login );
                //             if($ins_id){
                //                 $sibling1  = $this->user_model->check_sibling($student['father_phone']);
                //                 foreach($sibling1 as $key=> $sib ){
                //                     if($key > 0){
                //                         $this->db->delete( 'users', [
                //                             'id' => $sib['id']
                //                         ]);
                //                     }
                //                 }
                //         }
                //         } else {
                //             $sibling1  = $this->user_model->check_sibling($student['father_phone']);
                //             $countsib       = 0;
                //             $up_record      = 0;
                //             $record_value   = "";
                //             $findusers      = $this->user_model->read_user();
                //             $sibling_id = $student['id']; 
                //             $insert_id = $sib['user_id'];      //106          
                //             $find           = $sibling_id;
                //             foreach ( $findusers as $key => $value ) {
                //                 if ( $value->childs != "" ) {
                //                     $childs = explode( ",", $value->childs );
                //                     foreach ( $childs as $k_child => $v_child ) {
                //                         if ( $find == $v_child ) {   //259   == 106 
                //                             $up_record = $value->id;  ///id 221
                //                             $record_value = $value->childs; // 106
                //                             $countsib = 1;
                //                             break;
                //                         }
                //                     }
                //                 }
                //             }
                //             if ( $countsib != 0 ) {
                //                 $json               = array($insert_id);    // 106
                //                 $da                 = array_merge( (array)$record_value, (array)$json );  // 106 ,106
                //                 $rec                = implode( ",", $da );
                //                 $data_parent_login  = array(
                //                     'id'        => $up_record,
                //                     'childs'    => $rec,
                //                     'username'  => $student['father_phone']
                //                 );
                //                 $ins_id             = $this->user_model->add( $data_parent_login );
                //             if($ins_id){
                //                 $sibling1  = $this->user_model->check_sibling($student['father_phone']);
                //                     foreach($sibling1 as $key=> $sib ){
                //                         if($key > 0){
                //                             // $this->db->delete( 'users', [
                //                             //     'id' => $sib['id']
                //                             // ]);
                //                         }
                //                     }
                //                 }
                //             }
                //         }
                //     }
                }
            }
        }
    }
    exit;
    }
    function student_card(){


        $title = "Student Card";

        $student_fee_types = $this->student_fee_type_model->get();


        $class_sections = $this->classsection_model->class_sections();

        $student_id = $this->input->get( 'student_id' );

        $last_date_for_receiving_fee = $this->custom_option_model->get( 'last_date_for_receiving_fee' );


        $last_date_for_receiving_fee = date( "Y-m-{$last_date_for_receiving_fee['value']}", now() );

        $current_date = new DateTime( date( "Y-m-d", now() ) );


        $month_names = [];
        $month_name_date = new DateTime( date( 'Y-01-01', now() ) );
        for ( $i = 0; $i < 12; $i++ ) {
            $month_names[] = $month_name_date->format( 'F' );
            $month_name_date->add( new DateInterval( 'P1M' ) );
        }

        for ( $i = 0; $i < count( $class_sections ); $i++ ) {
            $class_sections[$i]['students'] = $this->student_model->searchByClassSection( $class_sections[$i]['class_id'], $class_sections[$i]['section_id'] );

        }

        // if student ID is available
        if ( $student_id !== null ) {
            $student_details = $this->student_model->get( $student_id );
        } else {
            $student_details = null;
        }



        $unpaid_students_fee_types = $this->student_fee_voucher_fee_types_model->get_unpaid_fee_types($student_id,$vrno );

        $unpaid_students_other = $this->student_fee_voucher_model->get_unpaid_other($student_id,$vrno );

        $unpaid_students = $this->student_fee_voucher_model->get_unpaid($student_id,$vrno );

        $data = compact(
            'title',
            'student_fee_types',
            'class_sections',
            'student_details',
            'last_date_for_receiving_fee',
            'month_names',
            'unpaid_students',
            'current_date',
            'student_id',
            'unpaid_students_other'
        );



        $this->load->view( 'layout/header', $data );
        $this->load->view( 'student/student_card', $data );
        $this->load->view( 'layout/footer', $data );

    }


    public function student_card_print()
    {
        $student_ids    = $this->input->post( 'student_ids' );
        $school_name = $this->setting_model->getCurrentSchoolName();
        $setting_result = $this->setting_model->get();

        foreach ($student_ids as $key=>$student_id) {
            $student[$key]        = $this->student_model->get( $student_id );

        }

        $data['student']  = $student;
        $school_logo = $this->setting_model->getCurrentImage();
        $data['school_logo']  = $school_logo;
        $data['settinglist'] = $setting_result;
        $data['school_name']  = $school_name;


        $this->load->view( 'layout/blank/header', $data );
        $this->load->view( 'student/student_card_print', $data );
        $this->load->view( 'layout/blank/footer', $data );
    }
    function create_doc()
    {
        $student_id = $this->input->post( 'student_id' );
        if ( isset( $_FILES["first_doc"] ) && !empty( $_FILES['first_doc']['name'] ) ) {
            $uploaddir = './uploads/student_documents/' . $student_id . '/';
            if ( !is_dir( $uploaddir ) && !mkdir( $uploaddir ) ) {
                die( "Error creating folder $uploaddir" );
            }
            $fileInfo = pathinfo( $_FILES["first_doc"]["name"] );
            $first_title = $this->input->post( 'first_title' );
            $img_name = $uploaddir . basename( $_FILES['first_doc']['name'] );
            move_uploaded_file( $_FILES["first_doc"]["tmp_name"], $img_name );
            $data_img = array('student_id' => $student_id, 'title' => $first_title, 'doc' => basename( $_FILES['first_doc']['name'] ));
            $this->student_model->adddoc( $data_img );
        }
        redirect( 'student/view/' . $student_id );
    }

    function handle_upload()
    {
        if ( isset( $_FILES["file"] ) && !empty( $_FILES['file']['name'] ) ) {
            $allowedExts = array('jpg', 'jpeg', 'png');
            $temp = explode( ".", $_FILES["file"]["name"] );
            $extension = end( $temp );
            $error = "";
            if ( $_FILES["file"]["error"] > 0 ) {
                $error .= "Error opening the file<br />";
            }
            if ( $_FILES["file"]["type"] != 'image/gif' &&
                $_FILES["file"]["type"] != 'image/jpeg' &&
                $_FILES["file"]["type"] != 'image/png' ) {
                $this->form_validation->set_message( 'handle_upload', 'File type not allowed' );
                return false;
            }
            if ( !in_array( $extension, $allowedExts ) ) {
                $this->form_validation->set_message( 'handle_upload', 'Extension not allowed' );
                return false;
            }
            if ( $_FILES["file"]["size"] > 102400 ) {
                $this->form_validation->set_message( 'handle_upload', 'File size shoud be less than 100 kB' );
                return false;
            }
            return true;
        } else {
            return true;
        }
    }

    function import()
    {
        $data['title'] = 'Import Student';
        $data['title_list'] = 'Recently Added Student';
        $session = $this->setting_model->getCurrentSession();
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        $category = $this->category_model->get();
        $data['categorylist'] = $category;
        $admission_key  = $this->setting_model->getadmissionkey();
        $data['admission_key'] = $admission_key;
        
        $this->form_validation->set_rules( 'class_id', 'Class', 'trim|required|xss_clean' );
        $this->form_validation->set_rules( 'section_id', 'Section', 'trim|required|xss_clean' );
        $this->form_validation->set_rules( 'file', 'Image', 'callback_handle_csv_upload' );
        if ( $this->form_validation->run() == FALSE ) {
            $this->load->view( 'layout/header', $data );
            $this->load->view( 'student/import', $data );
            $this->load->view( 'layout/footer', $data );
        } else {

            $class_id = $this->input->post( 'class_id' );
            $section_id = $this->input->post( 'section_id' );
            $session = $this->setting_model->getCurrentSession();
            if ( isset( $_FILES["file"] ) && !empty( $_FILES['file']['name'] ) ) {
                $file = $_FILES['file']['tmp_name'];
                $this->load->library( 'CSVReader' );
                $result = $this->csvreader->parse_file( $file );
               
                $admission_key  = $this->setting_model->getadmissionkey();
                $class_details      =  $this->class_model->get($class_id);
            
                    for ( $i = 1; $i <= count( $result ); $i++ ) {
                    if($class_details['fee'] < $result[$i]['discount']){
                        $result[$i]['discount'] = $class_details['fee'];  
                    }
                   
                    if($admission_key == 1){
                        $class_group = $this->input->post( 'class_group' );
                        $result[$i]['admission_no'] =  $class_group.$result[$i]['admission_no'];
                    }
                   $result[$i]['admission_date']    =  $result[$i]['admission_date'] == null  ? date('Y-m-d', now()) : $result[$i]['admission_date'];
                   $insert_id = $this->student_model->add( $result[$i]);
                    $data_new = array(
                        'student_id' => $insert_id,
                        'class_id' => $class_id,
                        'section_id' => $section_id,
                        'session_id' => $session
                    );


                    $student_session_id = $this->student_model->add_student_session( $data_new );
                    $class_details      =  $this->class_model->get($class_id);
                    $student_details    =  $this->student_model->GetStudentid($insert_id);


                    // free student
                    $free_student = ( intval( $class_details['fee'] ) - intval( $student_details['discount'] ) <= 0 ? 1 : 0 );
                    $without_fee = ( intval( date( 'd', strtotime( $data['admission_date'] ) ) ) >= 20 ? 1 : 0 );

                    // adding new admission log to the student log table
                    if ( !empty( $student_session_id ) ) {
                        $this->student_log_model->add( $student_session_id, date( 'Y-m-d', now() ), 0, 0, 0, $free_student, 0 );
                    }


                    $user_password = $this->role->get_random_password( $chars_min = 6, $chars_max = 6, $use_upper_case = false, $include_numbers = true, $include_special_chars = false );
                    
                    $father_phone =  $student_details['father_phone'];
                    
                    $father_cnic =  $student_details['father_cnic'];
                    
                    $sibling_type = $this->custom_option_model->get( 'sibling_type' );
        
                    if($sibling_type['value'] == "phone_sibling"){
        
                        $sibling  = $this->user_model->check_sibling($father_phone);
        
                    }elseif( $sibling_type['value'] == "cnic_sibling"){
        
                        $sibling  = $this->user_model->check_sibling_cnic($father_cnic);
                   
                    }

                    if($sibling){
                        $sibling_id = $sibling[0]->id;
                    }
                    $data_student_login = array(
                        'username'  => $this->student_login_prefix . $insert_id,
                        'password'  => $user_password,
                        'user_id'   => $insert_id,
                        'role'      => 'student'
                    );
                    $this->user_model->add( $data_student_login );
                    if ( isset( $sibling_id ) ) {
                        $countsib       = 0;
                        $up_record      = 0;
                        $record_value   = "";
                        $findusers      = $this->user_model->read_user();
                        $find           = $sibling_id;
                        foreach ( $findusers as $key => $value ) {
                            if ( $value->childs != "" ) {
                                $childs = explode( ",", $value->childs );
                                foreach ( $childs as $k_child => $v_child ) {
                                    if ( $find == $v_child ) {
                                        $up_record = $value->id;
                                        $record_value = $value->childs;
                                        $countsib = 1;
                                        break;
                                    }
                                }
                            }
                        }
        
                       // pp($up_record);
                        if ( $countsib != 0 ) {
                            $json               = array($insert_id);
                            $da                 = array_merge( (array)$record_value, (array)$json );
                            $rec                = implode( ",", $da );
                            $data_parent_login  = array(
                                'id'        => $up_record,
                                'childs'    => $rec
                            );
                            $ins_id             = $this->user_model->add( $data_parent_login );
                        } else {
                            $parent_password    = $this->role->get_random_password( $chars_min = 6, $chars_max = 6, $use_upper_case = false, $include_numbers = true, $include_special_chars = false );
                            $temp               = $insert_id;
                            $data_parent_login  = array(
                                'username'  => $this->parent_login_prefix . $insert_id,
                                'password'  => $parent_password,
                                'user_id'   => $insert_id,
                                'role'      => 'parent',
                                'childs'    => $temp
                            );
                            $ins_id = $this->user_model->add( $data_parent_login );
                        }
                    }
                }
                $data['csvData'] = $result;
            }
            $this->session->set_flashdata( 'msg', '<div student="alert alert-success text-center">Students imported successfully</div>' );
            redirect( 'student/import' );
        }
    }

    function handle_csv_upload()
    {
        $error = "";
        if ( isset( $_FILES["file"] ) && !empty( $_FILES['file']['name'] ) ) {
            $allowedExts = array('csv');
            $mimes = array('text/csv',
                'text/plain',
                'application/csv',
                'text/comma-separated-values',
                'application/excel',
                'application/vnd.ms-excel',
                'application/vnd.msexcel',
                'text/anytext',
                'application/octet-stream',
                'application/txt');
            $temp = explode( ".", $_FILES["file"]["name"] );
            $extension = end( $temp );
            if ( $_FILES["file"]["error"] > 0 ) {
                $error .= "Error opening the file<br />";
            }
            if ( !in_array( $_FILES['file']['type'], $mimes ) ) {
                $error .= "Error opening the file<br />";
                $this->form_validation->set_message( 'handle_csv_upload', 'File type not allowed' );
                return false;
            }
            if ( !in_array( $extension, $allowedExts ) ) {
                $error .= "Error opening the file<br />";
                $this->form_validation->set_message( 'handle_csv_upload', 'Extension not allowed' );
                return false;
            }
            if ( $error == "" ) {
                return true;
            }
        } else {
            $this->form_validation->set_message( 'handle_csv_upload', 'Please Select file' );
            return false;
        }
    }

    function pkupdate( $id )
    {
        $data['title'] = 'Update Student Dues';
        $student         = $this->student_model->get( $id );
        $data['student'] = $student;
        $redirect = $this->input->post_get( 'redirect' );
        $redirect = ( $redirect !== null ? urldecode( $redirect ) : site_url( "student/pkupdate/{$id}" ) );
        $fee_dues    = 0;
        $monthly_fee = 0;
        $fee_dues    = $this->input->post( 'fee_dues' );
        $monthly_fee = $this->input->post( 'monthly_fee' );
        $arrears     = $this->input->post( 'arrears' );
        $advance     = $this->input->post( 'advance' );
        $discount     = $this->input->post( 'discount' );


        $student_payment  =  $this->student_fee_payments->get(null, $student['id'], null, null , date('Y-m'));
        // check for this month payment and change discount
        $total_month_payments =  0;
        foreach($student_payment as $monthly){
            $total_month_payments += $monthly['tuition_fee']; 
        }

        $different_discount   =  $student['discount'] - $discount;
        $status = 0;
        if($total_month_payments > 0   ){
            $status =  1;
        }
        if($different_discount != 0 ) {
            $data_history = array(
                'date' => date('Y-m-d', now()),
                'monthly_fee' => $student['fee'] - $discount,
                'class_fee' => $student['fee'],
                'previous_discount' => $student['discount'],
                'latest_discount' => $discount,
                'student_id' => $id,
                'status' => $status
            );
            $this->student_model->add_discount($data_history);
        }
    
        if($total_month_payments == 0   ){
            if($student['discount'] > $discount){
                $total_discount = $student['discount'] - $discount;
                if($fee_dues == 0){
                    $fee_dues =  0;
                }else{
                    $fee_dues    = intval($fee_dues) + intval($arrears) - intval($advance)+ intval($total_discount) + $student['late_payment_fee'];
                }
            }elseif($student['discount'] < $discount){
                $total_discount =  $discount - $student['discount'];
            if($fee_dues == 0){
                $fee_dues =  0;
            }else{
                $fee_dues    = intval($fee_dues) + intval($arrears) - intval($advance)- intval($total_discount) + $student['late_payment_fee'];
            }
            }else{
                $fee_dues    = intval($fee_dues) + intval($arrears) - intval($advance)+ $student['late_payment_fee'];
            }
        }else{
            $discount = $student['discount'];
            $fee_dues    = intval($fee_dues) + intval($arrears) - intval($advance)+ $student['late_payment_fee'];
        }

        $this->form_validation->set_rules( 'fee_dues', 'Fee Dues', 'trim|required|xss_clean' );
        if ( $this->form_validation->run() == FALSE ) {
            $this->session->set_flashdata( 'err', 'Amount Should Be Equal Or Greater Then Monthly Tuition Fee' );
            redirect( $redirect );
            // $this->load->view( 'layout/header', $data );
            // $this->load->view( 'student/studentUpdateDues', $data );
            // $this->load->view( 'layout/footer', $data );
        } else {
            $data = array(
                'fee_arrears' => $fee_dues,
                'discount' =>  $discount
            );
            $update = $this->student_model->updateDues( $id, $data );
                if($status == 1){
                    $this->session->set_flashdata( 'msg_err', 'The student discount will effect next month. because  student fee paid this month' );
                }else{
                    $this->session->set_flashdata( 'msg', 'Student Record Updated successfully' );
                }
    
            redirect( $redirect );
        }
    }

  function edit( $id )
    {
        $data['title']          = 'Edit Student';
        $data['id']             = $id;
        $student                = $this->student_model->get( $id );
        $genderList             = $this->customlib->getGender();
        $data['student']        = $student;
        $data['genderList']     = $genderList;
        $session                = $this->setting_model->getCurrentSession();
        $vehroute_result        = $this->vehroute_model->get();
        $data['vehroutelist']   = $vehroute_result;
        $class                  = $this->class_model->get();
        $data['classlist']      = $class;
        $category               = $this->category_model->get();
        $data['categorylist']   = $category;
        $redirect               = $this->input->get( 'redirect' );
        $redirect               = ( $redirect !== null ? urldecode( $redirect ) : 'student/search' );
        $data['redirect']       = $redirect;

        $fee_starting = new stdClass();
        $fee_starting->year = [
            intval( date( 'Y', now() ) ),
            intval( date( 'Y', now() ) ) + 1
        ];
        $fee_starting->month = [];
        $months = new DateTime( date( 'Y-01-01', now() ) );
        for ( $i = 0; $i < 12; $i++ ) {

            $fee_starting->month[] = [
                'name' => $months->format( 'F' ),
                'value' => $months->format( 'm' )
            ];

            $months->add( new DateInterval( 'P1M' ) );
        }
        $data['fee_starting'] = $fee_starting;

        $this->form_validation->set_rules( 'firstname', 'First Name', 'trim|required|xss_clean' );
        $this->form_validation->set_rules( 'lastname', 'Last Name', 'trim|xss_clean' );
        $this->form_validation->set_rules( 'dob', 'Date of Birth', 'trim|xss_clean' );
        $this->form_validation->set_rules( 'class_id', 'Class', 'trim|required|xss_clean' );
        $this->form_validation->set_rules( 'section_id', 'Section', 'trim|required|xss_clean' );
        $this->form_validation->set_rules( 'guardian_name', 'Guardian Name', 'trim|required|xss_clean' );
        $this->form_validation->set_rules( 'rte', 'RTE', 'trim|xss_clean' );
        $this->form_validation->set_rules( 'father_name', 'Father Name', 'trim|required|xss_clean' );
        $this->form_validation->set_rules( 'father_cnic', 'Father CNIC', 'trim|max_length[15]' );
        $this->form_validation->set_rules( 'mother_name', 'Mother Name', 'trim|xss_clean' );
        $this->form_validation->set_rules( 'file', 'Image', 'callback_handle_upload' );
        $this->form_validation->set_rules( 'discount', 'Discount', 'trim|required' );
        // $this->form_validation->set_rules( 'arrears', 'Arrears', 'trim' );
        // $this->form_validation->set_rules( 'advance', 'Advance', 'trim' );
        // $this->form_validation->set_rules( 'fee_starting_year', 'Fee Starting Year', 'trim' );
        // $this->form_validation->set_rules( 'fee_starting_month', 'Fee Starting Month', 'trim' );

        if ( $this->form_validation->run() == FALSE ) {
            $this->load->view( 'layout/header', $data );
            $this->load->view( 'student/studentEdit', $data );
            $this->load->view( 'layout/footer', $data );

        } else {

            $student                = $this->student_model->get( $id );
            $fee_dues    = 0;
            // $arrears     = $this->input->post( 'arrears' );
            // $advance     = $this->input->post( 'advance' );
            $discount     = $this->input->post( 'discount' );
         
            
            $class_id = $student['class_id'];
            $section_id = $student['section_id'];
             $fees_discount = $discount;
            $vehroute_id = $this->input->post( 'vehroute_id' );
            $class_details      = $this->class_model->get( $class_id );
            $admission_date = date( 'm/d/Y', strtotime( $this->input->post( 'admission_date' ) ) );
            $dob = date( 'm/d/Y', strtotime( $this->input->post( 'dob' ) ) );
               
        
                // if($arrears > 0){
                //     if($arrears > $student['fee']){
                //         $fee_dues  =  $arrears - $student['fee'];    
                //     }elseif($arrears < $student['fee']){
                //         $fee_dues  =  $arrears;    
                //     }else{
                //         $fee_dues  = $student['fee'];    
                //     }
                // }else{
                //     $fee_dues = 0;
                // }
                $student_payment  =  $this->student_fee_payments->get(null, $student['id'], null, null , date('Y-m'));
           
                // check for this month payment and change discount
                $total_month_payments =  0;
                foreach($student_payment as $monthly){
                    $total_month_payments += $monthly['tuition_fee']; 
                }
        
                $different_discount   =  $student['discount'] - $discount;
                $status = 0;

                if($total_month_payments > 0   ){
                    $status =  1;
                }
          
                if($different_discount != 0 ) {
                    $data_history = array(
                        'date' => date('Y-m-d', now()),
                        'monthly_fee' => $student['fee'] - $discount,
                        'class_fee' => $student['fee'],
                        'previous_discount' => $student['discount'],
                        'latest_discount' => $discount,
                        'student_id' => $id,
                        'status' => $status
                    );
                    $this->student_model->add_discount($data_history);
                }
            
                if($total_month_payments == 0   ){
                
                    if($student['discount'] > $discount){
                        $total_discount = $student['discount'] - $discount;
                        if($fee_dues == 0){
                            $fee_dues =  0;
                        }else{
                            // $fee_dues    = intval($arrears) - intval($advance)+ intval($total_discount);
                        }
                    }elseif($student['discount'] < $discount){
                        $total_discount =  $discount - $student['discount'];
                    if($fee_dues == 0){
                        $fee_dues =  0;
                    }else{
                        // $fee_dues    =  intval($arrears) - intval($advance)- intval($total_discount);
                    }
                    }else{
                        // $fee_dues    =  intval($arrears) - intval($advance);
                    }
                }else{
                    $discount = $student['discount'];
                    // $fee_dues    =  intval($arrears) - intval($advance);
                }   

            // $fee_starting_year = $this->input->post( 'fee_starting_year' );
            // $fee_starting_month = $this->input->post( 'fee_starting_month' );
            // $fee_starting_date = date( 'Y-m-d', strtotime( "{$fee_starting_year}-{$fee_starting_month}-01" ) );


            $father_phone =  $this->input->post( 'father_phone' );

            $father_cnic  =  $this->input->post( 'father_cnic' );
            
            $sibling_type = $this->custom_option_model->get( 'sibling_type' );
               
            $student                = $this->student_model->get( $id );
     

            if($sibling_type['value'] == "cnic_sibling"){

                
                $old_siblings  = $this->user_model->check_sibling_cnic($student['father_cnic']);
               
                if($father_cnic != $student['father_cnic'] ){
                  /// remove from previous parent child
                  foreach($old_siblings as $old ){
  
                      $array1 = Array($id);
                      $array2 = explode(',',$old['childs']);
                      $array3 = array_diff($array2, $array1);
                      $output = implode(',', $array3);
                      if(empty($output)){
                          $this->db->delete( 'users', [
                              'id' => $old['id']
                          ] );
                      }else{
                          $this->db->update( 'users', [
                              'childs' => $output
                          ], ['id' => $old['id']] );
              
                      }
                  }
                 
                  /// add to next parent child
            
                  $siblings  = $this->user_model->check_sibling_cnic($father_cnic);

                  if($siblings){
  
                      foreach($siblings as $new ){
  
                          $parts = explode(',', $new['childs']);
                          $parts[] = $id;
                          $newchilds =  implode(',', $parts);
                          $this->db->update( 'users', [
                              'childs' => $newchilds
                          ], ['id' => $new['id']] );
      
                      }
                 
                  }else{
                      $parent_password    = $this->role->get_random_password( $chars_min = 6, $chars_max = 6, $use_upper_case = false, $include_numbers = true, $include_special_chars = false );
                      $temp               = $id;
                      $data_parent_login  = array(
                          'username'  => $this->parent_login_prefix . $id,
                          'password'  => $parent_password,
                          'user_id'   => $id,
                          'role'      => 'parent',
                          'childs'    => $temp
                      );
                      $ins_id = $this->user_model->add( $data_parent_login );
                  }
  
  
               }
    
            }elseif( $sibling_type['value'] == "phone_sibling"){

               
              if($father_phone != $student['father_phone'] ){

                $old_siblings  = $this->user_model->check_sibling($student['father_phone']);
    
                /// remove from previous parent child
                foreach($old_siblings as $old ){

                    $previous_parent_id_update = $old['id'];
                    $array1 = Array($id);
                    $array2 = explode(',',$old['childs']);
                    $array3 = array_diff($array2, $array1);
                    $output = implode(',', $array3);
   
                        if(empty($output)){

                            $this->db->delete( 'users', [
                                'id' => $old['id']
                            ] );
                            
                        }else{

                        if($old['user_id'] == $id ){

                            $this->db->delete( 'users', [
                                'id' => $old['id']
                            ] );
                          
                            $data_parent_login  = array(
                                'username'  => str_replace("-", "", $father_phone), //$this->parent_login_prefix . $insert_id,
                                'password'  => str_replace("-", "", $father_phone), 
                                'user_id'   => $array3[0],
                                'role'      => 'parent',
                                'childs'    =>  $output 
                            );
                           $ins_id = $this->user_model->add( $data_parent_login );
                        }else{
                            $this->db->update( 'users', [
                                'childs' => $output
                            ], ['id' => $old['id']] );
                        }
                    }
                }
               
                /// add to next parent child
          
                $siblings  = $this->user_model->check_sibling($father_phone);
                
               if($siblings){
            
                    foreach($siblings as $new ){

                        $parts = explode(',', $new['childs']);
                        $parts[] = $id;
                        $newchilds =  implode(',', $parts);
                        $data  = array(
                            'childs' => $newchilds,
                            'id' => $new['id']
                        );
                    $update   =  $this->user_model->updateParentChild($data);
                    }
             
                }else{
                    $parent_password    = $this->role->get_random_password( $chars_min = 6, $chars_max = 6, $use_upper_case = false, $include_numbers = true, $include_special_chars = false );
                    $temp               = $id;
                    $data_parent_login  = array(
                        'username'  => str_replace("-", "", $father_phone), //$this->parent_login_prefix . $insert_id,
                        'password'  => str_replace("-", "", $father_phone), 
                        'user_id'   => $id,
                        'role'      => 'parent',
                        'childs'    => $temp
                    );
                   $ins_id = $this->user_model->add( $data_parent_login );
                    if($output){
                        $this->db->update( 'users', [
                            'user_id' => $ins_id
                        ], ['id' => $previous_parent_id_update] );
                    }
                }

             }
                
            }
        

            $data = array(
                'id'                => $id,
                'admission_no'      => $this->input->post( 'admission_no' ),
                'roll_no'           => $this->input->post( 'roll_no' ),
                'admission_date'    => date( 'Y-m-d', $this->customlib->datetostrtotime( $admission_date ) ),
                'admission_class'   => $this->input->post( 'admission_class_id' ),
                'firstname'         => $this->input->post( 'firstname' ),
                'lastname'          => $this->input->post( 'lastname' ),
                'rte'               => $this->input->post( 'rte' ),
                'mobileno'          => $this->input->post( 'mobileno' ),
                'admission_class'   => $this->input->post( 'class_id' ),
                'email'             => $this->input->post( 'email' ),
                'state'             => $this->input->post( 'state' ),
                'city'              => $this->input->post( 'city' ),
                'previous_school'   => $this->input->post( 'previous_school' ),
                'guardian_is'       => $this->input->post( 'guardian_is' ),
                'pincode'           => $this->input->post( 'pincode' ),
                'religion'          => $this->input->post( 'religion' ),
                'dob'               => date( 'Y-m-d', $this->customlib->datetostrtotime( $dob ) ),
                'current_address'   => $this->input->post( 'current_address' ),
                'permanent_address' => $this->input->post( 'permanent_address' ),
                'category_id'       => $this->input->post( 'category_id' ),
                'adhar_no'          => $this->input->post( 'adhar_no' ),
                'samagra_id'        => $this->input->post( 'samagra_id' ),
                'bank_account_no'   => $this->input->post( 'bank_account_no' ),
                'bank_name'         => $this->input->post( 'bank_name' ),
                'ifsc_code'         => $this->input->post( 'ifsc_code' ),
                'cast'              => $this->input->post( 'cast' ),
                'father_name'       => $this->input->post( 'father_name' ),
                'father_phone'      => $this->input->post( 'father_phone' ),
                'father_occupation' => $this->input->post( 'father_occupation' ),
                'father_cnic'       => $this->input->post( 'father_cnic' ),
                'mother_name'       => $this->input->post( 'mother_name' ),
                'mother_phone'      => $this->input->post( 'mother_phone' ),
                'mother_occupation' => $this->input->post( 'mother_occupation' ),
                'guardian_occupation' => $this->input->post( 'guardian_occupation' ),
                'gender'            => $this->input->post( 'gender' ),
                'guardian_name'     => $this->input->post( 'guardian_name' ),
                'guardian_relation' => $this->input->post( 'guardian_relation' ),
                'guardian_phone'    => $this->input->post( 'guardian_phone' ),
                'b_form'    => $this->input->post( 'b_form' ),
                'guardian_address'  => $this->input->post( 'guardian_address' ),
                // 'fee_starting_date' => $fee_starting_date,
                // 'fee_arrears' => $fee_dues,
                'discount' =>  $discount,
            );
          $this->student_model->add( $data );

            $data_new = array(
                'student_id' => $id,
                'class_id' => $class_id,
                'section_id' => $section_id,
                'session_id' => $session,
                'vehroute_id' => $vehroute_id,
                'fees_discount' => $fees_discount
            );

            $insert_id = $this->student_model->add_student_session( $data_new );
            if ( isset( $_FILES["file"] ) && !empty( $_FILES['file']['name'] ) ) {
                $fileInfo = pathinfo( $_FILES["file"]["name"] );
                $img_name = $id . '.' . $fileInfo['extension'];

                $setting_result = $this->setting_model->get();
                // $name      = str_replace(' ', '-', strtolower($setting_result[0]['name']));
                $name = base_url();
                $name = str_replace("https://", "", $name);
                $name = str_replace("http://", "", $name);
                $name = str_replace("/", "", $name);
                

                if (!file_exists("./uploads/".$name)) {
                    mkdir("./uploads/".$name, 0777, true);
                }

                if (!file_exists("./uploads/".$name."/student_images/")) {
                    mkdir("./uploads/".$name."/student_images/", 0777, true);
                }
                move_uploaded_file( $_FILES["file"]["tmp_name"], "./uploads/".$name."/student_images/".$img_name );
                $data_img = array('id' => $id, 'image' => "./uploads/".$name."/student_images/".$img_name);
                $this->student_model->add( $data_img );
                
            }

            // free student
            $free_student = ( intval( $class_details['fee'] ) - intval( $discount ) <= 0 ? 1 : 0 );


            // adding new admission log to the student log table
            if ( !empty( $insert_id ) ) {
                $new_current_month_admission = date( 'Y-m', strtotime( $this->input->post( 'admission_date' ) ) ) == date( 'Y-m', now() );
                $this->student_log_model->update( $insert_id, $free_student );
            }

            $this->session->set_flashdata( 'msg', '<div student="alert alert-success text-left">Student Record Updated successfully</div>' );

            redirect( $redirect );

        }
    }


    function struckof( $id )
    {
        $redirect  = 'student/struck_off';
        $this->student_model->struckOff( $id );
        $this->session->set_flashdata( 'msg', '<div student="alert alert-success text-left">Student Record Updated successfully</div>' );
        redirect( $redirect );
    }

    public function struck_off($class_id ,$section_id,$date_from,$date_to,$current_session)
    {
        $title = "Struck Off Students";

        $classlist = $this->class_model->get();

        $this->form_validation->set_rules( 'class_id', 'Class', 'trim' );
        $this->form_validation->set_rules( 'section_id', 'Section', 'trim' );
        $this->form_validation->set_rules( 'gender', 'Gender', 'trim' );
        $this->form_validation->set_rules( 'date_from', 'Date From', 'trim' );
        $this->form_validation->set_rules( 'date_to', 'Date To', 'trim' );
        $this->form_validation->run();

        $class_id   = $this->input->post_get( 'class_id' );
        $section_id = $this->input->post_get( 'section_id' );
        $gender     = $this->input->post_get( 'gender' );
        $date_from  = $this->input->post_get( 'date_from' );
        $date_to    = $this->input->post_get( 'date_to' );
        $session_id             = $this->input->post_get('session_id');
        $class_id   = ( !empty( $class_id ) ? urldecode( $class_id ) : null );
        $section_id = ( !empty( $section_id ) ? urldecode( $section_id ) : null );
        $date_from  = ( !empty( $date_from ) ? $date_from : null );
        $date_to    = ( !empty( $date_to ) ? $date_to : null );
        $gender     = ( !empty( $gender ) ? $gender : null );
        $session  = $this->setting_model->getCurrentSession();
        $current_session = $session_id != null ? $session_id :  $session;
        $sessionlist = $this->session_model->getAllSession();
      
        $students   = $this->student_model->struckoff_students( $class_id, $section_id, $date_from, $date_to, $gender,$current_session );
        
        for ( $i = 0; $i < count( $students ); $i++ ) {
            $students[$i]['other_fee'] = $this->student_fee_voucher_model->get_unpaid_other_struck_off($students[$i]['id'] ,null,null, null,null,$current_session );
        }

        $data = compact(
            'title',
            'classlist',
            'students',
            'date_from',
            'date_to',
            'sessionlist',
            'current_session'
        );
        $this->load->view( 'layout/header', $data );
        $this->load->view( 'student/struckoff_students', $data );
        $this->load->view( 'layout/footer', $data );
    }

    function getexamscheduledetail() {

        $exam_id        = $this->input->post('exam_id');
        $section_id     = $this->input->post('section_id');
        $class_id       = $this->input->post('class_id');
        $examSchedule   = $this->examschedule_model->getDetailbyClsandSection($class_id, $section_id, $exam_id);
        echo json_encode($examSchedule);
    }


    function get_id() {
        $admission_no          = $this->input->post( 'admission_no' );
        $student_id   = $this->student_model->getId($admission_no);

        $data = array(
            'id' => $student_id->id,
          );
          $this->output
              ->set_content_type('application/json')
              ->set_output(json_encode($data));
    }

    function search()
    {

        $this->session->set_userdata( 'top_menu', 'Student Information' );
        $this->session->set_userdata( 'sub_menu', 'student/search' );
        $data['title']          = 'Due/Advance Fee Report';
        $class                  = $this->class_model->get();
        $data['classlist']      = $class;
        $button                 = $this->input->post( 'search' );
        $redirect_url           = current_url() . '?' . $this->input->server( 'QUERY_STRING' );
        $data['redirect_url']   = $redirect_url;
        $class          = $this->input->post_get( 'class_id' );
        $section        = $this->input->post_get( 'section_id' );
        $search         = $this->input->post_get( 'search' );
        $search_text    = $this->input->post_get( 'search_text' );
        $gender         = $this->input->post_get( 'gender' );
        $fee_status     = $this->input->post_get( 'fee_status' );
        $fee_status     = ( !empty( $fee_status ) ? $fee_status : null );
        $month = date( 'Y-m', now() );
        $data['report_month'] = $month;
        $data['class'] = $class;
        $data['section'] = $section;
        $data['gender'] = $gender;
        $data['fee_status'] = $fee_status;
        // if search is null, set it to search_filter
        $search = ( $search !== null ? $search : 'search_filter' );
        $total = new stdClass();
        $total->male = 0;
        $total->female = 0;
        $total->dues = 0;
        $total->advance = 0;
        $total->class_fee = 0;
        if ( $this->input->server( 'REQUEST_METHOD' ) == "GET" && $class === null && $section === null && $search === null && $search_text === null ) {
            $data['total'] = $total;
            $this->load->view( 'layout/header', $data );
            $this->load->view( 'student/studentSearch', $data );
            $this->load->view( 'layout/footer', $data );
        } else {
            if ( isset( $search ) ) {   
                if ( $this->input->server( 'REQUEST_METHOD' ) == "GET" ) {
                    $this->form_validation->set_data( $_GET );
                }
                if ( $search == 'search_filter' ) {
                    $this->form_validation->set_rules( 'class_id', 'Class', 'trim|xss_clean' );
                    if ( $this->form_validation->run() == FALSE ) {
                    } else {
                        $data['searchby'] = "filter";
                        $data['class_id'] = $this->input->post( 'class_id' );
                        $data['section_id'] = $this->input->post( 'section_id' );
                        $data['search_text'] = $this->input->post( 'search_text' );
                        $resultlist = $this->student_model->searchByClassSection( $class, $section, $gender, $fee_status );
                      
                        foreach ( $resultlist as $value ) {
                            if ( strtolower( $value['gender'] ) == 'male' ) {
                                $total->male++;
                            } else if ( strtolower( $value['gender'] ) == 'female' ) {
                                $total->female++;
                            }
                        }
                        $data['resultlist'] = $resultlist;
                    }
                }
                else if ( $search == 'search_full' ) {
                    $data['searchby']    = "text";
                    $data['class_id']    = $this->input->post( 'class_id' );
                    $data['section_id']  = $this->input->post( 'section_id' );
                    $data['search_text'] = trim( $this->input->post( 'search_text' ) );
                    $resultlist = $this->student_model->searchFullText( $search_text, $gender, $fee_status );
                              
                    foreach ( $resultlist as $value ) {
                        if ( strtolower( $value['gender'] ) == 'male' ) {
                            $total->male++;
                        } else if ( strtolower( $value['gender'] ) == 'female' ) {
                            $total->female++;
                        }
                    }
                  
                }
            }

          
            if ( !empty( $data['resultlist'] ) ) {
              
                foreach ( $data['resultlist'] as $item ) {
                    $total->class_fee += floatval( $item['class_fee'] );

                    // if value is positive
                    if ( intval( $item['fee_arrears'] ) >= 0 ) {
                        $total->dues += abs( $item['fee_arrears'] );
                    }
                    // if value is negative, means fee is collected in advance
                    if ( intval( $item['fee_arrears'] ) < 0 ) {
                        $total->advance += abs( $item['fee_arrears'] );
                    }
                    // if value is 0, means fee is collected in free
                    if ( intval( $item['fee_arrears'] ) < 0 ) {
                        $total->undue += abs( $item['fee_arrears'] );
                    }

                }
            }
            
            $month = date( 'm', now() );
            $year  = date( 'Y', now() );
            $date = date( 'm/d/Y', strtotime( "{$year}-{$month}-01" ) );
            $mdata = [
                'month' => $month,
                'year' => $year,
                'date' => $date,
                'total' => null
            ];
            // $current_month_payments = $this->student_model->current_month_payments();
            $current_month_payments = $this->student_fee_payments->current_payments($mdata);
            
            
            $advance_payments     = $this->student_model->get_advance_report($class , $section);

            // echo "<pre>";
            // print_r($advance_payments);
            // echo "</pre>";
            
            // exit;
            // $std_id = NULL;
            // $student_advance = array();
            // foreach ($advance_payments as $key => $s_payments) {
            //     $student_advance[$key]["student_id"]       =  $s_payments['student_id'];
            //     $student_advance[$key]["class_id"]     =  $s_payments['class_id'];
            //     $student_advance[$key]["section_id"]     =  $s_payments['section_id'];
            //     $student_advance[$key]["advance_fee"]     =  $s_payments['advance_fee'];
            //     $std_num =  $key;
            //     $std_id  = $s_payments['student_id'];
            // }
            // $student_advance = array_values($student_advance);
            // for ( $i = 0; $i < count( $student_advance ); $i++ ) {
            //     $student_advance[$i]['student'] = $this->student_model->get( $student_advance[$i]['student_id'] );
            // }

           
            $data['student_advance'] = $advance_payments;
            
            $sumstudents = [];
            foreach ($current_month_payments as $cpkey => $value) {
                $find_student =0;
                foreach ($sumstudents as $sskey => $ss) {
                    if($value['student_id'] == $sumstudents[$sskey]['student_id'])
                    {
                        if ($value['due_fee'] > $sumstudents[$sskey]['due_fee']) {
                            $sumstudents[$sskey]['due_fee']     = $value['due_fee'];
                        }
                        $sumstudents[$sskey]['tuition_fee'] += $value['tuition_fee'];
                        $find_student = 1;
                    }
                }
                if($find_student == 0){
                    $sumstudents[$cpkey]['section_id']  = $value['section_id'];
                    $sumstudents[$cpkey]['due_fee']     = $value['due_fee'];
                    $sumstudents[$cpkey]['class_id']    = $value['class_id'];
                    $sumstudents[$cpkey]['student_id']  = $value['student_id'];
                    $sumstudents[$cpkey]['tuition_fee'] = $value['tuition_fee'];
                    if ($value['late_payment_fee'] !== false) {
                        $sumstudents[$cpkey]['late_payment_fee'] = $value['late_payment_fee'];
                    }else{
                        $sumstudents[$cpkey]['late_payment_fee'] = 0;
                    }
                }
            }

            $data['resultlist'] = $resultlist;
           
            $data['current_month_payments'] = $current_month_payments;
            $data['total'] = $total;
            $class_id   = '';
            $seciton_id = '';
            $search     = '';
            if (!empty($class) || !empty($section)) {
                $getclass   = $this->class_model->get( $class );
                if (!empty($section)) {
                    $getseciton = $this->section_model->get( $section );
                }
                $class      = $getclass['class'];
                $section    = $getseciton['section'];
                $search = "(".$class." ".$section.")";
            }

            $data['print_title']        = "Monthly Due / Advance Fee Status ".$search;
            $this->load->view( 'layout/header', $data );
            $this->load->view( 'student/studentSearch', $data );
            $this->load->view( 'layout/footer', $data );
        }
    }

    function all_students()
    {

        $this->session->set_userdata( 'top_menu', 'Student Information' );
        $this->session->set_userdata( 'sub_menu', 'student/search' );
        $data['title']      = 'All Student';
        $class              = $this->class_model->get();
        $data['classlist']  = $class;
        $button             = $this->input->post( 'search' );

        $redirect_url           = current_url() . '?' . $this->input->server( 'QUERY_STRING' );
        $data['redirect_url']   = $redirect_url;

        $class          = $this->input->post_get( 'class_id' );
        $section        = $this->input->post_get( 'section_id' );
        $search         = $this->input->post_get( 'search' );
        $search_text    = $this->input->post_get( 'search_text' );
        $gender         = $this->input->post_get( 'gender' );
        $fee_status     = $this->input->post_get( 'fee_status' );
        $fee_status     = ( !empty( $fee_status ) ? $fee_status : null );

        $data['class']      = $class;
        $data['section']    = $section;
        $data['gender']     = $gender;
        $data['fee_status'] = $fee_status;

        // if search is null, set it to search_filter
        $search = ( $search !== null ? $search : 'search_filter' );
        $total = new stdClass();
        $total->male = 0;
        $total->female = 0;

        $total->dues = 0;
        $total->advance = 0;
        $total->class_fee = 0;
        if ( $this->input->server( 'REQUEST_METHOD' ) == "GET" && $class === null && $section === null && $search === null && $search_text === null ) {
            $data['total'] = $total;
            $this->load->view( 'layout/header', $data );
            $this->load->view( 'student/studentSearch', $data );
            $this->load->view( 'layout/footer', $data );
        } else {
            if ( isset( $search ) ) {

                if ( $this->input->server( 'REQUEST_METHOD' ) == "GET" ) {
                    $this->form_validation->set_data( $_GET );
                }

                if ( $search == 'search_filter' ) {
                    $this->form_validation->set_rules( 'class_id', 'Class', 'trim|xss_clean' );
                    if ( $this->form_validation->run() == FALSE ) {

                    } else {
                        
                        $data['searchby'] = "filter";
                        $data['class_id'] = $this->input->post( 'class_id' );
                        $data['section_id'] = $this->input->post( 'section_id' );
                        $data['search_text'] = $this->input->post( 'search_text' );
                        $resultlist = $this->student_model->searchByClassSection( $class, $section, $gender, $fee_status );
                        //print_r($resultlist);
                        foreach ( $resultlist as $value ) {
                            if ( strtolower( $value['gender'] ) == 'male' ) {
                                $total->male++;
                            } else if ( strtolower( $value['gender'] ) == 'female' ) {
                                $total->female++;
                            }
                        }

                        $data['resultlist'] = $resultlist;
                    }
                } else if ( $search == 'search_full' ) {

                    $data['searchby'] = "text";
                    $data['class_id'] = $this->input->post( 'class_id' );
                    $data['section_id'] = $this->input->post( 'section_id' );
                    $data['search_text'] = trim( $this->input->post( 'search_text' ) );
                    $resultlist = $this->student_model->searchFullText( $search_text, $gender, $fee_status );
                    if(empty($resultlist)){
                        $resultlist1 = $this->student_model->get(null,null,null,null, $search_text );
                        if($resultlist1[0]['struck_off'] == 1){
                            redirect( 'student/struck_off'. "?date_from=" . urlencode( date('m/01/Y') ) . "&date_to=" . urlencode( date('m/t/Y') ));
                        }
                    }
                    foreach ( $resultlist as $value ) {
                        if ( strtolower( $value['gender'] ) == 'male' ) {
                            $total->male++;
                        } else if ( strtolower( $value['gender'] ) == 'female' ) {
                            $total->female++;
                        }
                    }
                    $data['resultlist'] = $resultlist;
                }
            }

            if ( !empty( $data['resultlist'] ) ) {
                foreach ( $data['resultlist'] as $item ) {
                    $total->class_fee += floatval( $item['class_fee'] );

                    // if value is positive
                    if ( intval( $item['fee_arrears'] ) >= 0 ) {
                        $total->dues += abs( $item['fee_arrears'] );
                    }
                    // if value is negative, means fee is collected in advance
                    if ( intval( $item['fee_arrears'] ) < 0 ) {
                        $total->advance += abs( $item['fee_arrears'] );
                    }
                }
            }

            $current_month_payments = $this->student_model->current_month_payments();
            $data['current_month_payments'] = $current_month_payments;
            $data['total'] = $total;
            $this->load->view( 'layout/header', $data );
            $this->load->view( 'student/all_students', $data );
            $this->load->view( 'layout/footer', $data );
        }
    }

        function update_arrears_fee(){
            $data['searchby'] = "text";
            $due = 0;
            $discount = 0;
            $discounted = 0;

            $resultlist = $this->student_model->searchByClassSection( $class, $section, $gender, $fee_status );
            foreach($resultlist as $student){
                $discounted11 = $student['class_fee'] - $student['discount'];

                if($discounted11 > 0 ){

                    $class_fee += $student['class_fee'];
                    $discount += $student['discount'];
                    $discounted += $student['class_fee'] - $student['discount'];
                    $due += $student['fee_arrears']  - $fee - $student['late_payment_fee'];

                }
    //      if($student['struck_off'] != 1 ){
                
                   
                // print_r($due);
            //}
            }
            echo "<pre>";
            print_r($class_fee);
            echo "</pre>";  
            echo "<pre>";
            print_r($discount);
            echo "</pre>";
            echo "<pre>";
            print_r($discounted);
            echo "</pre>";

            pp($due);
        }
    function discount_report()
    {

        $this->session->set_userdata( 'top_menu', 'Student Information' );
        $this->session->set_userdata( 'sub_menu', 'student/search' );
       
               
        $resultlist = $this->student_model->searchByClassSection(null, null, null ,null,null,1);

        $discountStudent = array();
        foreach ($resultlist as $key => $student) {
                
                $payments =  $this->student_fee_payments->get(null, $student['id'], null, null , date('Y-m'));

                $arrears1 =0;
                $due1 = 0;
                $advance1 = 0;
                 
                for ( $i = 0; $i < count( $payments ); $i++ ) {
                    $payments[$i]['student'] = $this->student_model->get( $payments[$i]['student_id'] );
                    
                 $discount_fee =  intval($payments[$i]['student']['fee'])- intval($payments[$i]['student']['discount']);
                 $late_payment_fee = $payments[$i]['fine'];
               
                 $current_month_arrears = intval($payments[$i]['due_fee']) -intval($discount_fee) - intval( $late_payment_fee);    // cur 50
                 if ($payments[$i]['due_fee'] > 0 ) {   //50>0
           
               if ($payments[$i]['tuition_fee'] <= $current_month_arrears) {  // 100<=50
                           $arrears = intval($payments[$i]['tuition_fee']);
                           $tuition_fee = 0;
                           $advance = 0;
               }elseif (intval($payments[$i]['tuition_fee']) > intval($current_month_arrears)){
                      $arrears = $current_month_arrears;
                     $tuition_fee_left   = $payments[$i]['tuition_fee'] - $arrears;
                     if ($tuition_fee_left < $discount_fee) {
               if($tuition_fee_left<=$current_month_arrears) { //1500 >= -750
                      if($current_month_arrears < 0 ){
                         $tuition_fee =  $current_month_arrears + $discount_fee ;
                     }else{
                      $tuition_fee=  $tuition_fee_left  ;
                     }
               }else{
                     if($current_month_arrears < 0){
                      $tuition_fee   = $tuition_fee_left + $current_month_arrears  ;
                     }else{
                     $tuition_fee   = $tuition_fee_left  ;
                     }
               }
                      $advance = 0;
                    }elseif($tuition_fee_left >= $discount_fee){
                         if( $current_month_arrears <= 0 ){   //2500
                         $tuition_fee = $current_month_arrears  + $discount_fee;
                          }else{
                         if($tuition_fee_left >=  $current_month_arrears ){
                         $tuition_fee =  $discount_fee ;
                         }else{
                         $tuition_fee =  $discount_fee ;
                         }
                         }
                          $tuition_fee_left   = $tuition_fee_left - $discount_fee; //50-0
                          $advance            = $tuition_fee_left;     // a= 50
                          }
                         }
                    }
                    elseif($payments[$i]['due_fee'] <= 0){
                                 $tuition_fee = 0;
                                 $arrears     = 0;
                                 $advance     = $payments[$i]['tuition_fee'];
                      }
                     if ($arrears < 0) {
                         $arrears = 0;
                     }


                     $arrears1 += $arrears;
                     $due1 += $tuition_fee;
                     $advance1 += $advance;
                     
                }
                $adjusted =  $this->student_advance->get($student['id'] , date('Y-m-01'));

                $djeusted =  empty($adjusted)  ?   0 : $adjusted[0]['advance_fee']; 
                $discountStudent[$key]["adjusted"]           =  $djeusted;
                $discountStudent[$key]["id"]                 =  $student['id'];
                $discountStudent[$key]["discount"]           =  $student['discount'];
                $discountStudent[$key]["class_fee"]          =  $student['class_fee'];
                $discountStudent[$key]["paid_arrears"]       =  $arrears1;
                $discountStudent[$key]["paid_due"]           =  $due1;
                $discountStudent[$key]["paid_advance"]       =  $advance1;
                $discountStudent[$key]["fee_arrears"]        =  $student['fee_arrears'];
                $discountStudent[$key]["late_payment_fee"]   =  $student['late_payment_fee'];
                $discountStudent[$key]["struck_off"]         =  $student['struck_off'];
        }


        $data['resultlist'] = $discountStudent;
       
    
     

            $current_month_payments = $this->student_model->current_month_payments();
            $data['current_month_payments'] = $current_month_payments;
            $data['total'] = $total;
            $this->load->view( 'layout/header', $data );
            $this->load->view( 'balance_sheet/discountWiseReport', $data );
            $this->load->view( 'layout/footer', $data );
        
    }


    function getByClassAndSection()
    {
        $class = $this->input->get( 'class_id' );
        $section = $this->input->get( 'section_id' );
        $resultlist = $this->student_model->searchByClassSection( $class, $section );
        echo json_encode( $resultlist );
    }

    function getStudentRecordByID()
    {
        $student_id = $this->input->get( 'student_id' );
        $resultlist = $this->student_model->get( $student_id );
        echo json_encode( $resultlist );
    }


    function uploadimage( $id )
    {
        $data['title'] = 'Add Image';
        $data['id'] = $id;
        $this->load->view( 'layout/header', $data );
        $this->load->view( 'student/uploadimage', $data );
        $this->load->view( 'layout/footer', $data );
    }

    public function doupload( $id )
    {
        $config = array(
            'upload_path' => "./uploads/student_images/",
            'allowed_types' => "gif|jpg|png|jpeg|df",
            'overwrite' => TRUE,
        );
        $config['file_name'] = $id . ".jpg";
        $this->upload->initialize( $config );
        $this->load->library( 'upload', $config );
        if ( $this->upload->do_upload() ) {
            $data = array('upload_data' => $this->upload->data());
            $upload_data = $this->upload->data();
            $data_record = array('id' => $id, 'image' => $upload_data['file_name']);
            $this->setting_model->add( $data_record );

            $this->load->view( 'upload_success', $data );
        } else {
            $error = array('error' => $this->upload->display_errors());

            $this->load->view( 'file_view', $error );
        }
    }

    function getlogindetail()
    {
        $student_id = $this->input->post( 'student_id' );
        $examSchedule = $this->user_model->getLoginDetails( $student_id );
        echo json_encode( $examSchedule );
    }

    public function new_students()
    {
        $this->session->set_userdata( 'top_menu', 'Reports' );
        $this->session->set_userdata( 'sub_menu', 'student/new_students' );

        $data = [
            'title' => 'New Students'
        ];

        $class = $this->class_model->get();
        $data['classlist'] = $class;

        if ( $this->input->method() == 'get' ) {
            $this->form_validation->set_data( $_GET );
        }
        $this->form_validation->set_rules( 'class_id', 'Class', 'trim' );
        $this->form_validation->set_rules( 'section_id', 'Section', 'trim' );
        $this->form_validation->set_rules( 'gender', 'Gender', 'trim' );
        $this->form_validation->set_rules( 'date_from', 'Date From', 'trim' );
        $this->form_validation->set_rules( 'date_to', 'Date To', 'trim' );
        $this->form_validation->run();

        $class_id   = $this->input->post_get( 'class_id' );
        $section_id = $this->input->post_get( 'section_id' );
        $gender     = $this->input->post_get( 'gender' );
        $date_from  = $this->input->post_get( 'date_from' );
        $date_to    = $this->input->post_get( 'date_to' );


        $class_id = ( !empty( $class_id ) ? urldecode( $class_id ) : null );
        $section_id = ( !empty( $section_id ) ? urldecode( $section_id ) : null );

        $date_from = ( $date_from !== null ? date( "m/d/Y", strtotime( $date_from ) ) : date( 'm/01/Y' ) );
        $date_to = ( $date_to !== null ? date( 'm/d/Y', strtotime( $date_to ) ) : date( "m/t/Y" ) );

        $data['date_to']    = $date_to; 
        $data['date_from']  = $date_from; 
        
        $students = $this->student_model->new_students1( $class_id, $section_id, $date_from, $date_to, $gender );

        $date       = "(".$date_from." - ".$date_to.")";
        $data['students']    = $students;
        $data['print_title'] = "New Students".$date;

        $this->load->view( 'layout/header', $data );
        $this->load->view( 'student/new_students', $data );
        $this->load->view( 'layout/footer', $data );
    }

    public function total_students()
    {
        $this->session->set_userdata( 'top_menu', 'Reports' );
        $this->session->set_userdata( 'sub_menu', 'student/total_students' );

        $title = "Total Students";

        $classlist = $this->class_model->get();

        if ( $this->input->method() == 'get' ) {
            $this->form_validation->set_data( $_GET );
        }
        $this->form_validation->set_rules( 'class_id', 'Class', 'trim' );
        $this->form_validation->set_rules( 'section_id', 'Section', 'trim' );
        $this->form_validation->set_rules( 'gender', 'Gender', 'trim' );
        $this->form_validation->set_rules( 'date_from', 'Date From', 'trim' );
        $this->form_validation->set_rules( 'date_to', 'Date To', 'trim' );
        $this->form_validation->run();

        $class_id = $this->input->post_get( 'class_id' );
        $section_id = $this->input->post_get( 'section_id' );
        $gender = $this->input->post_get( 'gender' );
        $date_from = $this->input->post_get( 'date_from' );
        $date_to = $this->input->post_get( 'date_to' );

        $class_id = ( !empty( $class_id ) ? urldecode( $class_id ) : null );
        $section_id = ( !empty( $section_id ) ? urldecode( $section_id ) : null );

        $date_from = ( $date_from !== null ? date( "Y-m-d", strtotime( $date_from ) ) : date( 'Y-m-01', now() ) );
        $days_in_month = cal_days_in_month( CAL_GREGORIAN, date( 'm', now() ), date( 'Y', now() ) );
        $date_to = ( $date_to !== null ? date( 'Y-m-d', strtotime( $date_to ) ) : date( "Y-m-{$days_in_month}", now() ) );

        $students = $this->student_model->total_student_from_logs( $class_id, $section_id, $date_from, $date_to, $gender );

        $data = compact(
            'title',
            'classlist',
            'students'
        );
        $this->load->view( 'layout/header', $data );
        $this->load->view( 'student/total_students', $data );
        $this->load->view( 'layout/footer', $data );
    }

    public function gender_statistics()
    {
        $this->session->set_userdata( 'top_menu', 'Reports' );
        $this->session->set_userdata( 'sub_menu', 'student/gender_statistics' );

        $title = "Gender Statistics";

        $total = new stdClass();
        $total->male = 0;
        $total->female = 0;
        $total->total = 0;
        $total->new = 0;

        $classes = $this->class_model->get();
        for ( $i = 0; $i < count( $classes ); $i++ ) {
            $classes[$i]['male'] = $this->student_model->gender_wise_count( $classes[$i]['id'], null, 'male' );
            $classes[$i]['female'] = $this->student_model->gender_wise_count( $classes[$i]['id'], null, 'female' );
            $classes[$i]['total'] = $classes[$i]['male'] + $classes[$i]['female'];

            $classes[$i]['new_students'] = count( $this->student_model->new_students( $classes[$i]['id'], null, date( 'Y-01-01', now() ), date( 'Y-12-31', now() ) ) );

            $total->male += $classes[$i]['male'];
            $total->female += $classes[$i]['female'];
            $total->total += $classes[$i]['total'];
            $total->new += $classes[$i]['new_students'];
        }

        $data = compact(
            'title',
            'classes',
            'total'
        );

        $this->load->view( 'layout/header', $data );
        $this->load->view( 'student/gender_statistics', $data );
        $this->load->view( 'layout/footer', $data );
    }

    public function free_students()
    {
        $this->session->set_userdata( 'top_menu', 'Reports' );
        $this->session->set_userdata( 'sub_menu', 'student/free_students' );

        $title = "Free Students";

        $classlist = $this->class_model->get();

        if ( $this->input->method() == 'get' ) {
            $this->form_validation->set_data( $_GET );
        }
        $this->form_validation->set_rules( 'class_id', 'Class', 'trim' );
        $this->form_validation->set_rules( 'section_id', 'Section', 'trim' );
        $this->form_validation->set_rules( 'gender', 'Gender', 'trim' );
        $this->form_validation->set_rules( 'date_from', 'Date From', 'trim' );
        $this->form_validation->set_rules( 'date_to', 'Date To', 'trim' );
        $this->form_validation->run();

        $class_id       = $this->input->post_get( 'class_id' );
        $section_id     = $this->input->post_get( 'section_id' );
        $gender         = $this->input->post_get( 'gender' );
        $date_from      = $this->input->post_get( 'date_from' );
        $date_to        = $this->input->post_get( 'date_to' );

        // echo $date_from;exit;
        $class_id = ( !empty( $class_id ) ? urldecode( $class_id ) : null );
        $section_id     = ( !empty( $section_id ) ? urldecode( $section_id ) : null );
        $gender         = ( !empty( $gender ) ? $gender : null );
        $students       = $this->student_model->free_students_from_logs( $class_id, $section_id, $date_from, $date_to, $gender );
        $data = compact(
            'title',
            'classlist',
            'students'
        );

        $this->load->view( 'layout/header', $data );
        $this->load->view( 'student/free_students', $data );
        $this->load->view( 'layout/footer', $data );
    }

    public function free_month($id)
    {
        $this->session->set_userdata( 'top_menu', 'Reports' );
        $this->session->set_userdata( 'sub_menu', 'student/free_students' );
  

        $student_details=$this->student_model->get($id);
      
        $title = "Free Students";
        $classlist = $this->class_model->get();

        $classlist = $this->class_model->get();

        if ( $this->input->method() == 'get' ) {
            $this->form_validation->set_data( $_GET );
        }
        $this->form_validation->set_rules( 'class_id', 'Class', 'trim' );
        $this->form_validation->set_rules( 'section_id', 'Section', 'trim' );
        $this->form_validation->set_rules( 'gender', 'Gender', 'trim' );
        $this->form_validation->set_rules( 'date_from', 'Date From', 'trim' );
        $this->form_validation->set_rules( 'date_to', 'Date To', 'trim' );
        $this->form_validation->run();

        $class_id       = $this->input->post_get( 'class_id' );
        $section_id     = $this->input->post_get( 'section_id' );
        $gender         = $this->input->post_get( 'gender' );
        $date_from      = $this->input->post_get( 'date_from' );
        $date_to        = $this->input->post_get( 'date_to' );
        // echo $date_from;exit;
        $class_id = ( !empty( $class_id ) ? urldecode( $class_id ) : null );
        $section_id     = ( !empty( $section_id ) ? urldecode( $section_id ) : null );
        $gender         = ( !empty( $gender ) ? $gender : null );





        $students       = $this->student_model->free_students_from_logs( $class_id, $section_id, $date_from, $date_to, $gender );

        $data = compact(
            'title',
            'classlist',
            'students'
        );

        $this->load->view( 'layout/header', $data );
        $this->load->view( 'student/free_students', $data );
        $this->load->view( 'layout/footer', $data );
    }

    public function total_absent_report()
    {
        $title = "Absent Students Report";

        $this->form_validation->set_data( $this->input->get() );
        $this->form_validation->set_rules( 'attendance_date', 'Attendance date', 'trim' );
        $this->form_validation->run();

        $attendance_date = $this->input->get( 'attendance_date' );
        $attendance_date = date( 'Y-m-d', ( $attendance_date !== null ? strtotime( $attendance_date ) : now() ) );

        $absent_students = $this->student_model->total_absent_students( $attendance_date );

        $data = compact(
            'title',
            'attendance_date',
            'absent_students'
        );

        $this->load->view( 'layout/header', $data );
        $this->load->view( 'student/total_absent_report', $data );
        $this->load->view( 'layout/footer', $data );
    }
    public function marking()
    {
        $title = "Absent Students Report";

        $this->form_validation->set_data( $this->input->get() );
        $this->form_validation->set_rules( 'attendance_date', 'Attendance date', 'trim' );
        $this->form_validation->run();

        $attendance_date = $this->input->get( 'attendance_date' );
        $attendance_date = date( 'Y-m-d', ( $attendance_date !== null ? strtotime( $attendance_date ) : now() ) );

        $absent_students = $this->student_model->total_absent_students( $attendance_date );

        $data = compact(
            'title',
            'attendance_date',
            'absent_students'
        );

        $this->load->view( 'layout/header', $data );
        $this->load->view( 'student/marking', $data );
        $this->load->view( 'layout/footer', $data );
    }

    public function total_leave_report()
    {
        $title = "Students Leave Report";

        $this->form_validation->set_data( $this->input->get() );
        $this->form_validation->set_rules( 'attendance_date', 'Attendance date', 'trim' );
        $this->form_validation->run();

        $attendance_date = $this->input->get( 'attendance_date' );
        $attendance_date = date( 'Y-m-d', ( $attendance_date !== null ? strtotime( $attendance_date ) : now() ) );

        $absent_students = $this->student_model->total_leave_students( $attendance_date );

        $data = compact(
            'title',
            'attendance_date',
            'absent_students'
        );

        $this->load->view( 'layout/header', $data );
        $this->load->view( 'student/total_absent_report', $data );
        $this->load->view( 'layout/footer', $data );
    }

    public function send_sms_to_date_sheet()
    {
        $adminsess = $this->session->userdata( 'admin' );
        $this->load->helper('menu_helper');
        $permission = admin_permission($adminsess['id']);
        $exam_id             = $this->input->post('exam_id');
        $class_id             = $this->input->post('class_id');

      
     
        //	$class_id=15;
        //	$section_id= 3;
        $examSchedule = array();
        foreach( $class_id as $id){

            list($clas_id,$sectio_id) = explode('-', $id);
       
          
            $examSchedule   = $this->examschedule_model->getDetailbyClsandSection($clas_id, $sectio_id, $exam_id);
        

            if($examSchedule != null){
                $school_name = $this->setting_model->getCurrentSchoolName();
                $pieces = explode(" ",$school_name);
                if($permission->school_message == 0 ){
                    $school_name = '';
                }else{
                    $school_name = $this->setting_model->getCurrentSchoolName();
                }
                $students   = $this->student_model->searchByClassSection($clas_id, $sectio_id,null,null,null);
                $exam_name = $this->exam_model->get($exam_id);
                foreach($students as $student){
                    $this->sms_library->send_sms( $student['father_phone'], $this->sms_messages->send_date_sheet( $first_part,$examSchedule,  $exam_name['name'],$school_name ) );
                }


            }
        }
        
       

        $redirect = ( $redirect !== null ? urldecode( $redirect ) : site_url( 'student/send_message' ) );
        redirect(  $redirect);

    }

    public function send_sms_to_student_with_due_fee()
    {

        $unpaid_voucher_ids= $this->input->post( 'unpaid_voucher_ids' );

        $redirect = $this->input->get( 'redirect' );

        $redirect = ( $redirect !== null ? urldecode( $redirect ) : site_url( 'student/send_message' ) );

        $current_date_time = new DateTime( date( 'Y-m-d H:i:s', now() ) );

        /* foreach ( $unpaid_student_ids as $unpaid_student_id ) {

         $student = $this->student_model->searchFullText_message( $search_text, $gender, 'due', $unpaid_student_id );
                                               $check                  = 0;
                                            $paid_fee               = 0;
                                            $discount_fee           = $student['class_fee'] - $student['discount'];
                                            $arrears                = 0;
                                            $current_month_arrears  = 0;
                                            if ($student['fee_arrears'] > 0) {
                         // calculate current student arrears
                        $fee_arrears = $student['fee_arrears'] - $discount_fee - $student['late_payment_fee'];
                        // calculate current student fine
                        $late_payment_fee = $student['late_payment_fee'];
             if($late_payment_fee == null){

             $student_fee_fine_type = $this->custom_option_model->get( 'fine_per_day_for_fee');

             $late_payment_fee =   $student_fee_fine_type['value'];

             }

                                                   $current_fee = $student['fee_arrears'] - $late_payment_fee;
                                                    if ($current_fee > $discount_fee) {
                                                        $due_fee     = $discount_fee;
                                                    }else{
                                                        $due_fee     = $current_fee;
                                                    }
                                                    if($fee_arrears < 0){
                                                        $fee_arrears = 0;
                                                    }
                                                }
                                                if ($student['fee_arrears'] < 0) {
                                                    $fee_advance_month += abs($student['fee_arrears']);
                                                }
                                            print_r($student['father_phone']);


                     $this->sms_library->send_sms( $student['father_phone'], $this->sms_messages->fee_due( $student['firstname'], $student['class'], $student['section'], $student['admission_no'], $student['roll_no'], $due_fee, $fee_arrears ) );

                 }*/
        ///  $students = $this->student_model->getStudents($unpaid_student_ids);

        foreach (  $unpaid_voucher_ids as  $unpaid_voucher_id ) {
            $unpaid_student = $this->student_fee_voucher_model->get_unpaid( null,$unpaid_voucher_id,null,null);
            $student = $this->student_model->get( $unpaid_student['student_id']);
          
            // foreach( $unpaid_student['voucher_fee_types'] as $other_fee ){

            //     $discount_fee   = $student['fee'] - $student['discount'] ;

            //     if( $other_fee['amount'] > $discount_fee){

            //         $advance_fee     =   $other_fee['amount'] -$discount_fee;
            //         $tuition_fee     =      $discount_fee;

            //     }elseif($other_fee['amount'] <= $discount_fee   ){

            //         if( $other_fee['amount'] > 0 ){
            //             $advance_fee = 0;
            //             $tuition_fee = $other_fee['amount'];
            //         }

            //     }

            // }
            
                $advance_fee = $unpaid_student['advance'];
                $tuition_fee = $unpaid_student['monthly_fee'];
                $arrears = $unpaid_student['arrears'];
          
            //     echo "<pre>";
            // print_r($unpaid_student);
            // echo "</pre>";
            // $fee_arrears = 0;
            // $fee_arrears = $student['fee_arrears'] - $discount_fee - $student['late_payment_fee'];

            // if($fee_arrears < 0){
            //     $fee_arrears = 0;
            // }else{
            //     $fee_arrears = $fee_arrears;
            // }


            $total  = $arrears + $tuition_fee + $advance_fee;
            $tuition_fee   =	number_format($tuition_fee);
            $advance_fee   =	number_format($advance_fee);
            $arrears   =	number_format($arrears);
            $adminsess = $this->session->userdata( 'admin' );
            $this->load->helper('menu_helper');
            $permission = admin_permission($adminsess['id']);
            if($permission->school_message == 0 ){
                $school_name = '';
            }else{
                $school_name = $this->setting_model->getCurrentSchoolName();
            }
            $month  =  $unpaid_student['month_names'];
            $data = json_decode($unpaid_student['month_names'], TRUE);
            foreach($data as $dat){
            $date = date_parse($dat);
             $dates_name[] =   date("M", mktime(0, 0, 0, $date['month'], 10));
            }
            
            $short_month  =  implode( '/',   $dates_name);
            $d =  date('M');
            if(count($data) > 1 && $unpaid_student['monthly_fee'] == 0){
                $advance_month = $short_month; 
                
            }else{
                $advance_month = str_replace($d.'/', '', $short_month );
            }
            
            
            $this->sms_library->send_sms( $student['father_phone'], $this->sms_messages->fee_due( $student['firstname'], $student['class'], $student['section'] ,$student['admission_no'], $student['roll_no'], $tuition_fee, $advance_fee, $arrears, $total , $school_name,$short_month ,$advance_month) );
        }

        redirect('student/send_message_tuition ');

    }

    function send_sms_to_result_card() {

        $this->session->set_userdata('top_menu', 'Examinations');
        $this->session->set_userdata('sub_menu', 'mark/index');
        $session                    = $this->setting_model->getCurrentSession();

        $data['title']              = 'Exam Marks';
        $data['exam_id']            = "";
        $data['class_id']           = "";
        $data['section_id']         = "";

        $exam_id                    = $this->input->post_get('exam_id');
        $class_id                   = $this->input->post_get('class_id2');
        $exam_name = $this->exam_model->get($exam_id);
        foreach( $class_id as $id){

            list($clas_id,$sectio_id) = explode('-', $id);

            $examSchedule           = $this->examschedule_model->getDetailbyClsandSection($clas_id, $sectio_id, $exam_id);
            $studentList            = $this->student_model->searchByClassSection($clas_id, $sectio_id);


            if (!empty($examSchedule)) {
                $new_array = array();
                $data['examSchedule']['status'] = "yes";
                $adminsess = $this->session->userdata( 'admin' );
                $this->load->helper('menu_helper');
                $permission = admin_permission($adminsess['id']);
                if($permission->school_message == 0 ){
                    $school_name = '';
                }else{
                    $school_name = $this->setting_model->getCurrentSchoolName();
                }
                foreach ($studentList as $stu_key => $stu_value) {
                    $array = array();
                    $array['student_id']    = $stu_value['id'];

                    $array['firstname']     = $stu_value['firstname'];
                    $array['father_phone']  = $stu_value['father_phone'];
                    $x = array();
                    $exa=0;
                    foreach ($examSchedule as $ex_key => $ex_value) {
                        $session_result = $this->session_model->get($ex_value['session_id']);
                        $exam_array = array();
                        $exam_array['exam_schedule_id'] = $ex_value['id'];
                        $exam_array['exam_id']          = $ex_value['exam_id'];
                        $exam_array['full_marks']       = $ex_value['full_marks'];
                        $exam_array['passing_marks']    = $ex_value['passing_marks'];
                        $exam_array['exam_name']        = $ex_value['name'];

                        $student_exam_result            = $this->examresult_model->get_result($ex_value['id'], $stu_value['id']);

                     
                $ex_value2['id']  =  $ex_value['id']+1;


            $student_exam_result            = $this->examresult_model->get_result($ex_value2['id'], $stu_value['id']);

            
                        if (empty($student_exam_result)) {

                        } else {
                            $exam_array['get_marks']    = $student_exam_result->get_marks;
                            $exam_array['total']      = $student_exam_result->total;
                            $get_marks = floatval($student_exam_result->get_marks * 100);
                            $t = floatval($ex_value['full_marks']);
                           
                            
                            $exa = (int)($get_marks / $t);
                         
                             $listgrade= $this->grade_model->get();
                            foreach ($listgrade as $grade) {
                                if ($exam_array['pre'] >= $grade['mark_from'] && $exam_array['pre'] <= $grade['mark_upto'] ){ 
                                    $exam_array['grade']     =  $grade['name']; 
                                }
                            }
                            
                           
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
              
                foreach($new_array as $student2){          
                    $this->sms_library->send_sms( $student2['father_phone'], $this->sms_messages->send_result_card( $student2['firstname'],$student2['exam_array'],  $exam_name['name'],$school_name ) );
                }
            } else {
                $s = array('status' => 'no');
                $data['examSchedule'] = $s;
            }
        }
       redirect('student/send_message_exam');
    }


    public function send_sms_to_student_with_due_fee_all()
    {
        $redirect = $this->input->get( 'redirect' );

        $redirect = ( $redirect !== null ? urldecode( $redirect ) : site_url( 'balance_sheet' ) );

        $current_date_time = new DateTime( date( 'Y-m-d H:i:s', now() ) );

        ///  $students = $this->student_model->getStudents($unpaid_student_ids);

        $students = $this->student_model->get($unpaid_other_student_ids);


        $students = $this->student_model->searchFullText( $search_text, $gender, 'due');

        foreach ( $students as $student ) {

            $check                  = 0;
            $paid_fee               = 0;
            $discount_fee           = $student['class_fee'] - $student['discount'];
            $arrears                = 0;
            $current_month_arrears  = 0;
            if ($student['fee_arrears'] > 0) {
                // calculate current student arrears
                $fee_arrears = $student['fee_arrears'] - $discount_fee - $student['late_payment_fee'];
                // calculate current student fine
                $late_payment_fee = $student['late_payment_fee'];

                if($late_payment_fee == null){

                    $student_fee_fine_type = $this->custom_option_model->get( 'fine_per_day_for_fee');

                    $late_payment_fee =   $student_fee_fine_type['value'];

                }
                $current_fee = $student['fee_arrears'] - $late_payment_fee;
                if ($current_fee > $discount_fee) {
                    $due_fee     = $discount_fee;
                }else{
                    $due_fee     = $current_fee;
                }
                if($fee_arrears < 0){
                    $fee_arrears = 0;
                }
            }
            if ($student['fee_arrears'] < 0) {
                $fee_advance_month += abs($student['fee_arrears']);
            }


            $total = $due_fee + $fee_arrears;

            $adminsess = $this->session->userdata( 'admin' );
            $this->load->helper('menu_helper');
            $permission = admin_permission($adminsess['id']);
            if($permission->school_message == 0 ){
                $school_name = '';
            }else{
                $school_name = $this->setting_model->getCurrentSchoolName();
            }

            $due_fee      =    number_format( $due_fee);
            $fee_arrears  =	number_format($fee_arrears);
            $total        =	number_format($total);

            $this->sms_library->send_sms( $student['father_phone'], $this->sms_messages->fee_due_all( $student['firstname'], $student['class'], $student['section'], $student['admission_no'], $student['roll_no'], $due_fee, $fee_arrears,$total,$school_name ) );

        }


        $this->session->set_flashdata( 'msg', 'Messages sent' );
        redirect( $redirect );
    }

    public function send_sms_to_student_with_other_fee()
    {

        $unpaid_other_voucher_ids= $this->input->post( 'unpaid_other_voucher_ids' );

        $redirect = $this->input->get( 'redirect' );

        $redirect = ( $redirect !== null ? urldecode( $redirect ) : site_url( 'balance_sheet' ) );

        $current_date_time = new DateTime( date( 'Y-m-d H:i:s', now() ) );

        ///  $students = $this->student_model->getStudents($unpaid_student_ids);

        foreach ($unpaid_other_voucher_ids as $unpaid_other_voucher_id ) {

            $unpaid_student = $this->student_fee_voucher_model->get_unpaid_other( null,$unpaid_other_voucher_id);

            $student = $this->student_model->get( $unpaid_student['student_id']);

            foreach( $unpaid_student['voucher_fee_types'] as $other_fee ){

                $total_other	 +=   $other_fee['amount'];

            }

            $adminsess = $this->session->userdata( 'admin' );
            $this->load->helper('menu_helper');
            $permission = admin_permission($adminsess['id']);
            if( $permission->school_message == 0 ){
                $school_name = '';
            }else{
                $school_name = $this->setting_model->getCurrentSchoolName();
            }
            $this->sms_library->send_sms( $student['father_phone'], $this->sms_messages->other_fee( $student['firstname'], $student['class'], $student['section'], $student['admission_no'], $student['roll_no'], $unpaid_student['voucher_fee_types'], $total_other,$school_name ) );
        }

        $this->session->set_flashdata( 'msg', 'Messages sent' );
        redirect( $redirect );
    }

    public function send_sms_to_student_with_fee_arrears()
    {
        $redirect = $this->input->get( 'redirect' );
        $redirect = ( $redirect !== null ? urldecode( $redirect ) : site_url( 'balance_sheet' ) );

        $current_date_time = new DateTime( date( 'Y-m-d H:i:s', now() ) );

        $students = $this->student_model->getStudents();

        $adminsess = $this->session->userdata( 'admin' );
        $this->load->helper('menu_helper');
        $permission = admin_permission($adminsess['id']);
        if($permission->school_message == 0 ){
            $school_name = '';
        }else{
            $school_name = $this->setting_model->getCurrentSchoolName();
        }

        foreach ( $students as $student ) {
            if ( intval( $student['fee_arrears'] ) > 0 ) {
                $this->sms_library->send_sms( $student['father_phone'], $this->sms_messages->fee_arrear( $student['firstname'], $student['class'], $student['section'], $student['admission_no'], $student['roll_no'], $student['fee_arrears'], $school_name ) );
            }
        }

        $this->session->set_flashdata( 'msg', 'Messages sent' );
        redirect( $redirect );
    }


}
