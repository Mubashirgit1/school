<?php

if ( !defined( 'BASEPATH' ) )
    exit( 'No direct script access allowed' );

class Teacher extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->load->helper( 'file' );
        $this->lang->load( 'message', 'english' );
        $this->role;
    }

    function index()
    {
        $this->session->set_userdata( 'top_menu', 'TeacherAttendance' );
        $this->session->set_userdata( 'sub_menu', 'teacher/index' );
        
        $data['title']          = 'Add Teacher';
        
        $teacher_result         = $this->teacher_model->get();
        $data['teacherlist']    = $teacher_result;

        $genderList             = $this->customlib->getGender();
        $data['genderList']     = $genderList;
        
        $teacher_types          = $this->teacher_type_model->get();
		
        $data['teacher_types']  = $teacher_types;

        $this->load->view( 'layout/header', $data );
        $this->load->view( 'admin/teacher/teacherList', $data );
        $this->load->view( 'layout/footer', $data );
    }

    function getSubjctByClassandSection()
    {
        $class_id = $this->input->post( 'class_id' );
        $section_id = $this->input->post( 'section_id' );
        $data = $this->teachersubject_model->getSubjectByClsandSection( $class_id, $section_id );
        echo json_encode( $data );
    }

    function assignteacher()
    {
        $this->session->set_userdata( 'top_menu', 'Academics' );
        $this->session->set_userdata( 'sub_menu', 'teacher/assignTeacher' );
        $data['title']              = 'Assign Teacher with Class and Subject wise';
        $teacher                    = $this->teacher_model->get();
        $data['teacherlist']        = $teacher;
        $subject                    = $this->subject_model->get();
        $data['subjectlist']        = $subject;
        $class                      = $this->class_model->get();
        $data['classlist']          = $class;
        $input_class_id             = $this->input->post_get( 'class_id' );
        $input_section_id           = $this->input->post_get( 'section_id' );
        $seciton_name               = $this->section_model->get($input_section_id);
        $data['section_name']       = $seciton_name['section'] ?? null;
        $data['input_class_id']     = $input_class_id;
        $data['input_section_id']   = $input_section_id;

        $this->load->view( 'layout/header', $data );
        $this->load->view( 'admin/teacher/assignTeacher', $data );
        $this->load->view( 'layout/footer', $data );
        if ( $this->input->server( 'REQUEST_METHOD' ) == "POST" ) {
            $loop = $this->input->post( 'i' );
            $array = array();
            foreach ( $loop as $key => $value ) {
                $s = array();

                $s['session_id'] = $this->setting_model->getCurrentSession();
                $class_id = $this->input->post( 'class_id' );
                $section_id = $this->input->post( 'section_id' );
				
				$dt = $this->classsection_model->getDetailbyClassSection( $class_id, $section_id );

                $s['class_section_id'] = $dt['id'];
                $s['teacher_id'] = $this->input->post( 'teacher_id_' . $value );
                $s['subject_id'] = $this->input->post( 'subject_id_' . $value );
            	$s['max_marks'] = $this->input->post( 'max_marks_' . $value );
				$s['passing_marks'] = $this->input->post( 'passing_marks_' . $value );
				
                $row_id = $this->input->post( 'row_id_' . $value );
                if ( $row_id == 0 ) {
                    $insert_id = $this->teachersubject_model->add( $s );
                    $array[] = $insert_id;
                } else {
                    $s['id'] = $row_id;
                    $array[] = $row_id;
                    $this->teachersubject_model->add( $s );
                }
            }
				
            $ids = $array;
            $class_section_id = $dt['id'];
            $this->teachersubject_model->deleteBatch( $ids, $class_section_id );
            
            $this->session->set_flashdata( 'msg', '<div class="alert alert-success">Record updated successfully</div>' );
           
            redirect( 'admin/timetable/index?class_id='.$input_class_id.'&section_id='.$input_section_id );
            
       
        }
    }

    public function getSubjectTeachers()
    {
        $this->form_validation->set_error_delimiters( '', '' );
        $this->form_validation->set_rules( 'class_id', 'Class', 'trim|required|xss_clean' );
        $this->form_validation->set_rules( 'section_id', 'Section', 'trim|required|xss_clean' );
        if ( $this->form_validation->run() ) {
			
	        $class_id = $this->input->post( 'class_id' );
            $section_id = $this->input->post( 'section_id' );
            $dt = $this->classsection_model->getDetailbyClassSection( $class_id, $section_id );
            $data = $this->teachersubject_model->getDetailByclassAndSection( $dt['id'] );
            echo json_encode( array('st' => 0, 'msg' => $data) );
        } else {
            $data = array(
                'class_id' => form_error( 'class_id' ),
                'section_id' => form_error( 'section_id' ),
            );
            echo json_encode( array('st' => 1, 'msg' => $data) );
        }
    }

    function view( $id )
    {
        $data['title'] = 'Teacher List';
        $teacher = $this->teacher_model->get( $id );
        $teachersubject = $this->teachersubject_model->getTeacherClassSubjects( $id );
        $data['teacher'] = $teacher;
        $data['teachersubject'] = $teachersubject;

        $year = $this->input->get( 'year' );
        $year = ( $year !== null ? $year : date( 'Y', now() ) );
        $data['year'] = $year;

        for ( $i = 1; $i < 13; $i++ ):
		$month = str_pad($i,2,0,STR_PAD_LEFT);
        endfor;
        $days_in_month = cal_days_in_month( CAL_GREGORIAN, $month, $year );

        $data['days_in_month'] = $days_in_month;

        $attendance_dates = [];
		
        for ( $day_number = 1; $day_number <= $days_in_month; $day_number++ ) {
            $attendance_dates[] = "{$year}-{$month}-{$day_number}";
        }
		
        $data["attendance_dates"] = $attendance_dates;
		
        $teachers1 = $this->teacher_model->get($id);
        
		$data['teachers1'] =    $teachers1;    
      
       for ( $i = 1; $i < 13; $i++ ):

            $annual = str_pad($i,2,0,STR_PAD_LEFT);
            $teachers[$i]['day_attendance'] = array();

            for ( $day_number = 1; $day_number <= $days_in_month; $day_number++ ) {
         $teachers[$i]['day_attendance'][$day_number] = $this->teacher_attendance_model->search_attendance($id, "{$year}-{$annual}-{$day_number}" );

                if ( $teachers[$i]['day_attendance'][$day_number] !== false ) {
                    for ( $k = 0; $k < count( $teachers[$i]['day_attendance'][$day_number] ); $k++ ) {
                        $teachers[$i]['day_attendance'][$day_number]['teacher_attendence_type'] = $this->teacher_attendence_type_model->get( $teachers[$i]['day_attendance'][$day_number]['teacher_attendence_type_id'] );
                    }
                }
            }
			   endfor;
			   
			 
       $holidays   = $this->stuattendence_model->get_holiday();
		$total_holiday= 0;
		foreach($holidays as $holiday){
			
			$total_holiday += $holiday['days']; 
			
			}
		
		$end_date = date('Y-m-d', strtotime('12/30'));
		
		$total  = $total_holiday + date("W", strtotime("$end_date"));
		
		$data['total'] = $total;  



        $data['teachers'] = $teachers;




        $this->load->view( 'layout/header', $data );
        $this->load->view( 'admin/teacher/teacherShow', $data );
        $this->load->view( 'layout/footer', $data );
    }
	
    function resign( $id )
    {
		
	    $redirect  = 'admin/teacher/create';
        
        $this->teacher_model->resign( $id );
		
        $this->session->set_flashdata( 'msg', '<div student="alert alert-success text-left">Teacher Record Updated successfully</div>' );
        redirect( $redirect );
        
    }
	
	function rejoin( $id )
    {
		
	    $redirect  = 'admin/teacher/create';
        
        $this->teacher_model->rejoin( $id );
		
        $this->session->set_flashdata( 'msg', '<div student="alert alert-success text-left">Teacher Record Updated successfully</div>' );
        redirect( $redirect );
        
    }
	
    function delete( $id )
    {
        $data['title'] = 'Teacher List';
        $this->teacher_model->remove( $id );
        redirect( 'admin/teacher/index' );
    }
	
    function create()
    {
        $data['title'] = 'Add teacher';
        $genderList = $this->customlib->getGender();
        $data['genderList'] = $genderList;
        $this->form_validation->set_rules( 'name', 'Teacher', 'trim|required|xss_clean' );
        $this->form_validation->set_rules( 'email', 'Email', 'trim|xss_clean' );
        $this->form_validation->set_rules( 'gender', 'Gender', 'trim|required|xss_clean' );
        $this->form_validation->set_rules( 'dob', 'Date of Birth', 'trim|xss_clean' );
        $this->form_validation->set_rules( 'phone', 'Phone', 'trim|xss_clean' );
        $this->form_validation->set_rules( 'file', 'Image', 'callback_handle_upload' );
        $this->form_validation->set_rules( 'teacher_type_id', 'Teacher type', 'trim|required|integer' );
        $this->form_validation->set_rules( 'teacher_salary', 'Teacher salary', 'trim|integer' );
        $this->form_validation->set_rules( 'joining_date', 'Date of joining', 'trim' );
        $this->form_validation->set_rules( 'teacher_qualification', 'Teacher Qualification', 'trim|max_length[255]' );
        $this->form_validation->set_rules( 'qualification_details', 'Qualification details', 'trim|max_length[65000]' );
        if ( $this->form_validation->run() == FALSE ) {
			
		   $teacher_type =    $this->input->get( 'teacher_type' ) != null ?  $this->input->get( 'teacher_type' ) : "all" ;
           $data['teacher_type_search'] = $teacher_type;
		   
		    if($teacher_type == 'all'){
                $teacher_result = $this->teacher_model->get();
                $data['teacherlist'] = $teacher_result;
			}else{
                $teacher_result = $this->teacher_model->get2( null, null, $teacher_type);
                $data['teacherlist'] = $teacher_result;
            }
			
		   	$teacher_types          = $this->teacher_type_model->get();
		     $data['teacher_types']  = $teacher_types;	
				
			
			$genderList = $this->customlib->getGender();
            $data['genderList'] = $genderList;
            $this->load->view( 'layout/header', $data );
            $this->load->view( 'admin/teacher/teacherList', $data );
            //$this->load->view( 'admin/teacher/teacherCreate', $data );
            $this->load->view( 'layout/footer', $data );
        }else {
            $joining_date   = $this->input->post( 'joining_date' );
            $joining_date   = ( $joining_date !== null ? date( 'Y-m-d', strtotime( $joining_date ) ) : date( 'Y-m-d', now() ) );

            $dob            = $this->input->post( 'dob' );
            $dob            = ( $dob !== null ? date( 'Y-m-d', $this->customlib->datetostrtotime( $this->input->post( 'dob' ) ) ) : null );

            $teacher_salary = $this->input->post( 'teacher_salary' );
            $teacher_security = $this->input->post( 'teacher_security' );
            $teacher_advance = $this->input->post( 'teacher_advance' );
            $teacher_eobi = $this->input->post( 'teacher_eobi' );
            
            $teacher_id             = $this->teacher_model->TGetid();
            if ($teacher_id != null) {
                $teacher_id    = $teacher_id+1;
            }else{
                $teacher_id    = 1;
            }
            
            if ( $teacher_salary === null ) $teacher_salary = 0;
            if ( $teacher_security === null ) $teacher_security = 0;
            if ( $teacher_advance === null ) $teacher_advance = 0;
            if ( $teacher_eobi === null ) $teacher_eobi = 0;

            $data = array(
                'teacher_id'            => $teacher_id,
                'name'                  => $this->input->post( 'name' ),
                'email'                 => $this->input->post( 'email' ),
                'password'              => $this->input->post( 'password' ),
                'sex'                   => $this->input->post( 'gender' ),
                'dob'                   => $dob,
                'address'               => $this->input->post( 'address' ),
                'phone'                 => $this->input->post( 'phone' ),
                'designation'           => $this->input->post( 'designation' ),
                'image'                 => 'uploads/student_images/no_image.png',
                'teacher_type_id'       => $this->input->post( 'teacher_type_id' ),
                'teacher_salary'        => $teacher_salary,
                'teacher_security'      => $teacher_security,
                'teacher_advance'       => $teacher_advance,
                'teacher_eobi'          => $teacher_eobi,
                'joining_date'          => $joining_date,
                'qualification'         => $this->input->post( 'teacher_qualification' ),
                'qualification_details' => $this->input->post( 'qualification_details' ),
				'active'                 => 1,
            );
          
            $insert_id = $this->teacher_model->add( $data );
            $user_password = $this->role->get_random_password( $chars_min = 6, $chars_max = 6, $use_upper_case = false, $include_numbers = true, $include_special_chars = false );

            $teacher_name = $this->input->post( 'name' );
            $teacher_name = strtolower( $teacher_name );
            $teacher_name = preg_replace( "/[^a-zA-Z0-9]+/", '', $teacher_name );

            // search if the name already exists
            $username_count = 1;
            do {
                // search username in users table
                $username_exists = $this->user_model->user_exists( $teacher_name );
                if ( $username_exists === false ) {
          	    $data_student_login = array(
                        'username' =>   $teacher_name,
                        'password' =>   $user_password,
                        'user_id' =>    $insert_id,
                        'role' => 'teacher'
                    );
                    $this->user_model->add( $data_student_login );
                }
				 else {

                    $teacher_name = $teacher_name . $username_count;
                    $username_count++;

                }

            } while ( $username_exists === true );


            if ( isset( $_FILES["file"] ) && !empty( $_FILES['file']['name'] ) ) {
				
                $fileInfo = pathinfo( $_FILES["file"]["name"] );
                $img_name = $insert_id . '.' . $fileInfo['extension'];
                
                $name = base_url();
                $name = str_replace("https://", "", $name);
                $name = str_replace("http://", "", $name);
                $name = str_replace("/", "", $name);

                if (!file_exists("./uploads/".$name)) {
                    mkdir("./uploads/".$name, 0777, true);
                }

                if (!file_exists("./uploads/".$name."/teacher_images/")) {
                    mkdir("./uploads/".$name."/teacher_images/", 0777, true);
                }
                
                
                move_uploaded_file( $_FILES["file"]["tmp_name"], "./uploads/'.$name.'/teacher_images/" . $img_name );
                $data_img = array('id' => $insert_id, 'image' => 'uploads/'.$name.'/teacher_images/' . $img_name);
                $this->teacher_model->add( $data_img );
            }
			
            $this->session->set_flashdata( 'msg', '<div class="alert alert-success text-left">Teacher added successfully</div>' );
            redirect( 'admin/teacher/index' );
        }
    }

    function handle_upload()
    {
        if ( isset( $_FILES["file"] ) && !empty( $_FILES['file']['name'] ) ) {
            $error = '';
            $allowedExts = array('jpg', 'jpeg', 'png');
            $temp = explode( ".", $_FILES["file"]["name"] );
            $extension = end( $temp );
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
            if ( $_FILES["file"]["size"] > 10240000 ) {

                $this->form_validation->set_message( 'handle_upload', 'File size shoud be less than 100 kB' );
                return false;
            }
            if ( $error == "" ) {
                return true;
            }
        } else {
            return true;
        }
    }

    /**
     * @param $id
     */
    function edit( $id )
    {
        $data['title']          = 'Edit Teacher';
        $data['id']             = $id;
        
        $genderList             = $this->customlib->getGender();
        $data['genderList']     = $genderList;
        
        $teacher                = $this->teacher_model->get( $id );
        $data['teacher']        = $teacher;
       
        $teacher_types          = $this->teacher_type_model->get();
        $data['teacher_types']  = $teacher_types;

        $this->form_validation->set_rules( 'name', 'Teacher', 'trim|required|xss_clean' );
        $this->form_validation->set_rules( 'email', 'Email', 'trim|xss_clean' );
        $this->form_validation->set_rules( 'gender', 'Gender', 'trim|required|xss_clean' );
        $this->form_validation->set_rules( 'dob', 'Date of Birth', 'trim|xss_clean' );
        $this->form_validation->set_rules( 'phone', 'Phone', 'trim|xss_clean' );
        $this->form_validation->set_rules( 'file', 'Image', 'callback_handle_upload' );
        $this->form_validation->set_rules( 'teacher_type_id', 'Teacher type', 'trim|required|integer' );
        $this->form_validation->set_rules( 'teacher_salary', 'Teacher salary', 'trim|integer' );
        $this->form_validation->set_rules( 'joining_date', 'Date of joining', 'trim' );
        $this->form_validation->set_rules( 'teacher_qualification', 'Teacher Qualification', 'trim|max_length[255]' );
        $this->form_validation->set_rules( 'qualification_details', 'Qualification details', 'trim|max_length[65000]' );
        if ( $this->form_validation->run() == FALSE ) {
			
            $teacher_result = $this->teacher_model->get();
            $data['teacherlist'] = $teacher_result;
            $this->load->view( 'layout/header', $data );
            $this->load->view( 'admin/teacher/teacherEdit', $data );
            $this->load->view( 'layout/footer', $data );
        }
		 else {
            $dob                    = $this->input->post( 'dob' );
            $dob                    = ( $dob !== null ? date( 'Y-m-d', $this->customlib->datetostrtotime( $this->input->post( 'dob' ) ) ) : null );
            $name                   = $this->input->post( 'name' );
            $name                   = ( !empty( $name ) ? $name : null );
            $email                  = $this->input->post( 'email' );
            $email                  = ( !empty( $email ) ? $email : null );
            $password               = $this->input->post( 'password' );
            $password               = ( !empty( $password ) ? $password : null );
            $gender                 = $this->input->post( 'gender' );
            $gender                 = ( !empty( $gender ) ? $gender : null );
            $address                = $this->input->post( 'address' );
            $address                = ( !empty( $address ) ? $address : null );
            $phone                  = $this->input->post( 'phone' );
            $phone                  = ( !empty( $phone ) ? $phone : null );
            $teacher_type_id        = $this->input->post( 'teacher_type_id' );
            $teacher_type_id        = ( !empty( $teacher_type_id ) ? $teacher_type_id : null );
            $teacher_salary         = $this->input->post( 'teacher_salary' );
            $teacher_salary         = ( !empty( $teacher_salary ) ? $teacher_salary : 0 );
            $teacher_security         = $this->input->post( 'teacher_security' );
            
            $teacher_security         = ( !empty( $teacher_security ) ? $teacher_security : 0 );
            $teacher_advance         = $this->input->post( 'teacher_advance' );
            
            $teacher_advance         = ( !empty( $teacher_advance ) ? $teacher_advance : 0 );
            $teacher_eobi         = $this->input->post( 'teacher_eobi' );
            
            $teacher_eobi         = ( !empty( $teacher_eobi ) ? $teacher_eobi : 0 );
            $joining_date           = $this->input->post( 'joining_date' );
            $joining_date           = ( !empty( $joining_date ) ? date( 'Y-m-d', strtotime( $joining_date ) ) : null );
            $teacher_qualification  = $this->input->post( 'teacher_qualification' );
            $teacher_qualification  = ( !empty( $teacher_qualification ) ? $teacher_qualification : null );
            $qualification_details  = $this->input->post( 'qualification_details' );
            $qualification_details  = ( !empty( $qualification_details ) ? $qualification_details : null );

            $data = array(
                'id'                    => $id,
                'name'                  => $name,
                'email'                 => $email,
                'password'              => $password,
                'sex'                   => $gender,
                'dob'                   => $dob,
                'address'               => $address,
                'phone'                 => $phone,
                'teacher_type_id'       => $teacher_type_id,
                'teacher_salary'        => $teacher_salary,
                'teacher_security'      => $teacher_security,
                'teacher_advance'       => $teacher_advance,
                'teacher_eobi'          => $teacher_eobi,
                'joining_date'          => $joining_date,
                'qualification'         => $teacher_qualification,
                'qualification_details' => $qualification_details
            );
        
           
            if(strcmp($this->input->post( 'name' ) ,  $teacher['name'])  ){

                $teacher_name = $this->input->post( 'name' );

                $teacher_name = strtolower( $teacher_name );
                $teacher_name = preg_replace( "/[^a-zA-Z0-9]+/", '', $teacher_name );
                
                // search if the name already exists
                $username_count = 1;
                do {
                    // search username in users table
                    $username_exists = $this->user_model->user_exists( $teacher_name );
                  
                    if ( $username_exists === false ) {
                      
                        $data_parent_login  = array(
                            'username'  =>     $teacher_name,
                            'user_id'  =>     $teacher['id']
                            
                        );
                      
                        $ins_id   = $this->user_model->editTeacher( $data_parent_login );
                   
                    }
                     else {
    
                        $teacher_name = $teacher_name . $username_count;
                        $username_count++;
    
                    }
    
                } while ( $username_exists === true );
            }



            $insert_id = $this->teacher_model->add( $data );
            if ( isset( $_FILES["file"] ) && !empty( $_FILES['file']['name'] ) ) {
                $fileInfo = pathinfo( $_FILES["file"]["name"] );
                $img_name = $id . '.' . $fileInfo['extension'];
                
                $name = base_url();
                $name = str_replace("https://", "", $name);
                $name = str_replace("http://", "", $name);
                $name = str_replace("/", "", $name);

                if (!file_exists("./uploads/".$name)) {
                    mkdir("./uploads/".$name, 0777, true);
                }

                if (!file_exists("./uploads/".$name."/teacher_images/")) {
                    mkdir("./uploads/".$name."/teacher_images/", 0777, true);
                }
                
                move_uploaded_file( $_FILES["file"]["tmp_name"], "./uploads/'.$name.'/teacher_images/" . $img_name );
                $data_img = array('id' => $id, 'image' => 'uploads/'.$name.'/teacher_images/' . $img_name);
                $this->teacher_model->add( $data_img );
            }
            $this->session->set_flashdata( 'msg', '<div class="alert alert-success text-center">Teacher updated successfully</div>' );
            redirect( 'admin/teacher/create?search=search_filter&teacher_type=active' );
        }
    }
	
	
	function edit2( $id )
    {
      	 $this->form_validation->set_rules( 'joining_date', 'Date of joining', 'trim' );
		  if ( $this->form_validation->run() == FALSE ) {
			 $payment_id = $this->input->get('payment_id'); 
             $data['salary_payments'] = $this->teacher_salary_payment->teacher_salary_records2( null, $payment_id, null, null );
        
             $this->load->view( 'layout/header',$data);
            $this->load->view( 'admin/teacher/teacherpaymentEdit2', $data );
            $this->load->view( 'layout/footer', $data );
	     }
	 }
	 
    function updateteacher($id)
	{
	   
		    $id                    = $this->input->post( 'teacher_id' );
            $name                  = $this->input->post( 'name' );
            $payments              = $this->input->post( 'payments' );
            $date                  = $this->input->post( 'joining_date' );
		
		
         $data = array(
                'id'                    => $id,
                'teacher_salary_payment_date'       => $joining_date,
                'paid_salary'         => $teacher_qualification
                
            );
		
		 $salary_payments = $this->teacher_salary_payment->teacher_salary_update( $id, $data);
		
		 
	 }

    function getlogindetail()
    {
        $teacher_id = $this->input->post( 'teacher_id' );
        $examSchedule = $this->user_model->getTeacherLoginDetails( $teacher_id );
        echo json_encode( $examSchedule );
    }

    public function attendance()
    {
        $this->session->set_userdata( 'top_menu', 'Attendance' );
        $this->session->set_userdata( 'sub_menu', 'teacher/attendance' );
        $data['title'] = 'Add Teacher';

        $teacher_result = $this->teacher_model->get();
        $data['teacherlist'] = $teacher_result;

        $genderList = $this->customlib->getGender();
        $data['genderList'] = $genderList;

        $teacher_types = $this->teacher_type_model->get();
        $data['teacher_types'] = $teacher_types;

        $staff_members = $this->staff_model->get();
        $data['staff_members'] = $staff_members;
		
		  $restrict_attendance_after = $this->custom_option_model->get( 'restrict_attendance_after' );
		 $data['restrict_attendance_after'] = $restrict_attendance_after;
		
		  $restrict_attendance_after_staff = $this->custom_option_model->get( 'restrict_attendance_after_staff' );
		 $data['restrict_attendance_after_staff'] = $restrict_attendance_after_staff;
		 
		
		 
		
        $attendance_date = $this->input->get( 'attendance_for' );
        $attendance_date = ( !empty( $attendance_date ) ? urldecode( $attendance_date ) : date( "m/d/Y", now() ) );
        $data['attendance_date'] = $attendance_date;

       
 

        $this->load->view( 'layout/header', $data );
        $this->load->view( 'admin/teacher/attendance', $data );
        $this->load->view( 'layout/footer', $data );
    }

    public function attendance_process()
    {
	
        $this->form_validation->set_rules( "attendance_for", "Attendance date", "trim|required" );

        $teachers = $this->input->post( 'teacher' );

        foreach ( $teachers as $teacher_k => $teacher_v ) {
            $this->form_validation->set_rules( "teacher[{$teacher_k}][id]", "Teacher identity", 'trim|required|integer' );
            $this->form_validation->set_rules( "teacher[{$teacher_k}][type]", 'Teacher type', 'trim|required' );
            $this->form_validation->set_rules( "teacher[{$teacher_k}][attendance]", 'Teacher attendance', 'trim' );
            $this->form_validation->set_rules( "teacher[{$teacher_k}][number_of_lectures]", "Teacher's attended lectures", 'trim' );
            $this->form_validation->set_rules( "teacher[{$teacher_k}][total_lectures]", "Teacher's total lectures", 'trim' );
            $this->form_validation->set_rules( "attendance_for", "Attendence date", 'trim' );
        }

        if ( $this->form_validation->run() == false ) {
            $this->attendance();
        } else {


             $absent_teacher_names = [];
             $late_teacher_names = [];
            foreach ( $teachers as $teacher_k => $teacher_v ) {
                $teacher_id = $this->input->post( "teacher[{$teacher_k}][id]" );
                $teacher_type = $this->input->post( "teacher[{$teacher_k}][type]" );
                $teacher_attendance = $this->input->post( "teacher[{$teacher_k}][attendance]" );
                $teacher_attended_lectures = $this->input->post( "teacher[{$teacher_k}][number_of_lectures]" );
                $teacher_total_lectures = $this->input->post( "teacher[{$teacher_k}][total_lectures]" );
                $attendance_date = $this->input->post( 'attendance_for' );
                $teacher_details = $this->teacher_model->get( $teacher_id );

                $insert_data = array();
                $insert_data['teacher_id'] = $teacher_id;
                $insert_data['attendance_date'] = date( 'Y-m-d', strtotime( $attendance_date ) );

                // if teacher is permanent. Attendence woun't be lecture based
                if ( $teacher_type == "permanent" ) {
                    
					$insert_data['attendance_lecture_based'] = 0;
                    
					$teacher_attendance_type = $this->teacher_attendence_type_model->search( $teacher_attendance );
                    
					
					
                    $months = date('m', now());  
                    $years= date('Y', now());                                      
                    $monthName = date("F", mktime(0, 0, 0, $months));
                    $fromdt=date('Y-m-01 ',strtotime("First Day Of  $monthName $years")) ;
                    $todt=date('Y-m-d ',strtotime("Last Day of $monthName $years"));

                    $num_sundays='';                
                    for ($i = 0; $i < ((strtotime($todt) - strtotime($fromdt)) / 86400); $i++)
                    {
                        if(date('l',strtotime($fromdt) + ($i * 86400)) == 'Sunday')
                        {
                                $num_sundays++;
                        }    
                    }
					 $student_fee_fine_type = $this->custom_option_model->get( 'teachers_max_leaves_in_month' );
					 $teacher_time_attendance = $this->custom_option_model->get( 'restrict_attendance_after' );
					 
				      $total_days = 	date('t')- $student_fee_fine_type['value'] - $num_sundays;
				 
				
					if($teacher_attendance_type['teacher_attendence_type_name'] == 'absent'){
					
					 $day_salary  = $teacher_details['teacher_salary']/$total_days;
					
					   $this->db->insert( 'incentive_deduction', [
                                'teacher_id' => $teacher_id,
                                'amount' => $day_salary ,
								'name' => 'absent',
								'type' => 'deduction',
								'paid' => '1',
								'date' =>  date('Y-m-d', strtotime($attendance_date))
	                          ] );
					
						
				
					$due_salary = $teacher_details['due_salary'] - $day_salary;
					 $this->db->update( $this->teacher_model->table_name, array(
                        'due_salary' => $due_salary
						
                    ), array(
                        'id' => $teacher_details['id']
                    ) );
					}
					
					
					
					if($teacher_attendance_type['teacher_attendence_type_name'] == 'half'){
					
					 $day_salary  = $teacher_details['teacher_salary']/$total_days;
					
					$working_hour = 6;
					
					$hour_salary =  $day_salary/$working_hour; 

					
					$min_salary =  $hour_salary/60; 
					
					
                    $datetime1 = new DateTime();
                    $datetime2 = new DateTime($teacher_time_attendance['value']);


                    $interval = $datetime1->diff($datetime2);
                    $elapsed = $interval->format('%H');
                    $elapsed2 = $interval->format('%i');


                    $total = $elapsed*60 + $elapsed2;	
                    $deduction_time = 	round($min_salary*$total); 
	 				   $this->db->insert( 'incentive_deduction', [
                                'teacher_id' => $teacher_id,
                                'amount' => $deduction_time ,
								'name' => 'Late',
								'type' => 'deduction',
								'paid' => '1',
								'date' =>  date('Y-m-d', strtotime($attendance_date))
	                          ] );
					$due_salary = $teacher_details['due_salary'] -$deduction_time;
					 $this->db->update( $this->teacher_model->table_name, array(
                        'due_salary' => $due_salary
						
                    ), array(
                        'id' => $teacher_details['id']
                    ) );
					}


					$insert_data['teacher_attendence_type_id'] = $teacher_attendance_type['teacher_attendence_type_id'];

                    // setting attended lectures and total lectures 0 for permanent users
                    $insert_data['attended_lectures'] = 0;
                    $insert_data['total_lectures'] = 0;

                    if ( !empty( $teacher_attendance_type ) && strtolower( $teacher_attendance_type['teacher_attendence_type_name'] ) == 'absent' ) {
                        $absent_teacher_names[] = $teacher_details['name'];
                    }
					if ( !empty( $teacher_attendance_type ) && strtolower( $teacher_attendance_type['teacher_attendence_type_name'] ) == 'half' ) {
                        $late_teacher_names[] = $teacher_details['name'];
                    }
		

                } else { // teacher is lecture based

                    $insert_data['attendance_lecture_based'] = 1;
                    $insert_data['attended_lectures'] = $teacher_attended_lectures;
                    $insert_data['total_lectures'] = $teacher_total_lectures;

                    // if attended lectures are less than 1.
                    // no lectures attended. Absent
                    if ( $teacher_attended_lectures < 1 ) {
                        $teacher_attendance_type = $this->teacher_attendence_type_model->search( 'absent' );
                        $insert_data['teacher_attendence_type_id'] = $teacher_attendance_type['teacher_attendence_type_id'];
                    } else {
                        $teacher_attendance_type = $this->teacher_attendence_type_model->search( 'present' );
                        $insert_data['teacher_attendence_type_id'] = $teacher_attendance_type['teacher_attendence_type_id'];
                    }
			      }

                $insert_data['attendance_time'] = date( 'H:i:s', now() );

                // insert data to the database.
                // if already inserted for the selected date then update it.
                $this->teacher_attendance_model->insert( $insert_data );

            }
		
		
		
	        if ( !empty( $late_teacher_names ) ) {
                $admin_phone = $this->custom_option_model->get( 'admin_phone' );
	            $this->sms_library->send_sms( $admin_phone['value'], $this->sms_messages->teacher_staff_late_message( $late_teacher_names, 'teachers' ) );
            }
		
		
		
            if ( !empty( $absent_teacher_names ) ) {
                $admin_phone = $this->custom_option_model->get( 'admin_phone' );
	
              //  $this->sms_library->send_sms( $admin_phone['value'], $this->sms_messages->teacher_staff_absent_message( $absent_teacher_names, 'teachers' ) );
            }

            $this->session->set_flashdata( 'msg', 'Attendance updated' );
            redirect( 'admin/teacher/attendance' );

        }
    }

    public function salary()
    {
        
        $this->session->set_userdata( 'top_menu', 'Expenses' );
        $this->session->set_userdata( 'sub_menu', 'teacher/salary' );

        $teacher_name_search = $this->input->get( 'teacher_name' );
        $month = $this->input->get( 'month' ) != null ?  $this->input->get( 'month' ) :  date('m') ;
        $year = $this->input->get( 'year' ) != null ?  $this->input->get( 'year' ) :  date('Y') ;
        
        $data['title'] = 'Payroll Monthly Status';
        $data['month'] = $month;

        $redirect = $this->input->post_get( 'redirect' );
        $redirect = ( $redirect !== null ? urldecode( $redirect ) : current_url() );
        $data['redirect'] = $redirect;

        $teacher_result = $this->teacher_model->get( null, $teacher_name_search );
        
        for ( $i = 0; $i < count( $teacher_result ); $i++ ) {
            $month_start_date = date( "{$year}-{$month}-01" );
            $_days_in_month = cal_days_in_month( CAL_GREGORIAN, date( 'm', strtotime( $month_start_date ) ), date( 'Y', strtotime( $month_start_date ) ) );
            $teacher_result[$i]['current_month_last_payment'] = $this->teacher_salary_payment->get( null, $teacher_result[$i]['id'], 'desc', null, $month_start_date, date( "Y-m-{$_days_in_month}", strtotime( $month_start_date ) ) );
            $teacher_result[$i]['due_incentive']          = $this->teacher_salary_payment->get_incentive( $teacher_result[$i]['id'], date( "Y-m-{$_days_in_month}", strtotime( $month_start_date ) )    ,null ,null, 1  );
        }
        
    
        $data['teacherlist'] = $teacher_result;
        $genderList = $this->customlib->getGender();
        $data['genderList'] = $genderList;

        $teacher_types = $this->teacher_type_model->get();
        $data['teacher_types'] = $teacher_types;


        $staff_list = $this->staff_model->get( null );

        if ( $staff_list !== false ) {
            for ( $i = 0; $i < count( $staff_list ); $i++ ) {
				
            $month_start_date = date( "{$year}-{$month}-01");
            $_days_in_month = cal_days_in_month( CAL_GREGORIAN, date( 'm', strtotime( $month_start_date ) ), date( 'Y', strtotime( $month_start_date ) ) );
            $staff_list[$i]['current_month_last_payment'] = $this->staff_salary_payments_model->get( null ,$staff_list[$i]['id'], $month_start_date, date( "Y-m-{$_days_in_month}", strtotime( $month_start_date ) ) );

	    }
        }
        
        
		$data['staff_list'] = $staff_list;

        $this->load->view( 'layout/header', $data );
        $this->load->view( 'admin/teacher/salary', $data );
        $this->load->view( 'layout/footer', $data );
    }
 
    public function review_heads()
    {
        $this->session->set_userdata( 'top_menu', 'Expenses' );
        $this->session->set_userdata( 'sub_menu', 'teacher/salary' );

        
        $date_from = $this->input->get( 'date_from' );
        $date_to = $this->input->get( 'date_to' );
        $data = array(
                'title' => 'Incentive & Deduction Due Report',
            'date_from'     => $date_from,
            'date_to'       => $date_to,
        );

        

        $incentives = $this->student_fee_type_model->get_incentive(null,null ,'incentive');
        $data['incentives'] = $incentives;
		
		$deductions = $this->student_fee_type_model->get_incentive(null,null, 'deduction');
        $data['deductions'] = $deductions;
		
        $teacher_result = $this->teacher_model->get(  );
        
        for ( $i = 0; $i < count( $teacher_result ); $i++ ) {
            $incentive = $this->student_fee_type_model->get_incentive(null, null, 'incentive');
            for ( $j = 0; $j < count( $incentive ); $j++ ) {
                $teacher_result[$i]['current_month_last_payment'][$j] = $this->teacher_salary_payment->get_incentives( null, $teacher_result[$i]['id'], 'desc', null,  $date_from,  $date_to, '1',$incentive[$j]['id'] );
            }
		}
         
		 $teacher_result2 = $this->teacher_model->get(  );
		 for ( $i = 0; $i < count( $teacher_result2 ); $i++ ) {
            $month_start_date = date( 'Y-m-01', now() );
            $_days_in_month = cal_days_in_month( CAL_GREGORIAN, date( 'm', strtotime( $month_start_date ) ), date( 'Y', strtotime( $month_start_date ) ) );
			$deduction = $this->student_fee_type_model->get_incentive(null, null, 'deduction');
			for ( $j = 0; $j < count( $deduction ); $j++ ) {
                $teacher_result2[$i]['current_month_last_payment'][$j] = $this->teacher_salary_payment->get_incentives( null, $teacher_result2[$i]['id'], 'desc', null,$date_from ,$date_to, '1', $deduction[$j]['id']   );
            }
        }
       
        $staff_result = $this->staff_model->get();
         
        for ( $i = 0; $i < count( $staff_result ); $i++ ) {
            $incentive = $this->student_fee_type_model->get_incentive(null, null, 'incentive');
            for ( $j = 0; $j < count( $incentive ); $j++ ) {
                $staff_result[$i]['current_month_last_payment'][$j] = $this->teacher_salary_payment->get_incentive( null, $staff_result[$i]['id'], 'desc', null,  $date_from,  $date_to, '1',$incentive[$j]['id'] );
            }
		}
       
 
		 $staff_result2 = $this->staff_model->get(  );
		 for ( $i = 0; $i < count( $staff_result2 ); $i++ ) {
        	$deduction = $this->student_fee_type_model->get_incentive(null, null, 'deduction');
			for ( $j = 0; $j < count( $deduction ); $j++ ) {
                $staff_result2[$i]['current_month_last_payment'][$j] = $this->teacher_salary_payment->get_incentives( null, $staff_result2[$i]['id'], 'desc', null,$date_from ,$date_to, '1', $deduction[$j]['id']   );
            }
        }
       
		$data['staff_result'] = $staff_result;	 
		$data['staff_result2'] = $staff_result2;
		$data['teacherlist2'] = $teacher_result2;	 
		$data['teacherlist'] = $teacher_result;

        $this->load->view( 'layout/header', $data );
        $this->load->view( 'admin/teacher/review_heads', $data );
        $this->load->view( 'layout/footer', $data );
    }
    
    
    public function incentive()
    {
   
        $date_from = $this->input->get( 'date_from' );
        $date_to = $this->input->get( 'date_to' );
        $date_from = $date_from != null ? $date_from : date('m/01/Y');
        $date_to = $date_to != null ? $date_to : date('m/t/Y');

        $data = array(
            'title' =>'Incentive & Deduction Paid Report',
            'date_from'     => $date_from,
            'date_to'       => $date_to,
        );

       

        $incentives = $this->student_fee_type_model->get_incentive(null,null ,'incentive');
        $data['incentives'] = $incentives;
		
		$deductions = $this->student_fee_type_model->get_incentive(null,null, 'deduction');
        $data['deductions'] = $deductions;
		
        $teacher_result = $this->teacher_model->get();
	    for ( $i = 0; $i < count( $teacher_result ); $i++ ) {
        	$incentive = $this->student_fee_type_model->get_incentive(null, null, 'incentive');
	        for ( $j = 0; $j < count( $incentive ); $j++ ) {
                $teacher_result[$i]['current_month_last_payment'][$j] = $this->teacher_salary_payment->get_incentives( null, $teacher_result[$i]['id'], 'desc', null,  $date_from,  $date_to, '0',$incentive[$j]['id'] );
            }
	    }
         
		 $teacher_result2 = $this->teacher_model->get(  );
		 for ( $i = 0; $i < count( $teacher_result2 ); $i++ ) {
            $month_start_date = date( 'Y-m-01', now() );
            $_days_in_month = cal_days_in_month( CAL_GREGORIAN, date( 'm', strtotime( $month_start_date ) ), date( 'Y', strtotime( $month_start_date ) ) );
			$deduction = $this->student_fee_type_model->get_incentive(null, null, 'deduction');
            for ( $j = 0; $j < count( $deduction ); $j++ ) {
                $teacher_result2[$i]['current_month_last_payment'][$j] = $this->teacher_salary_payment->get_incentives( null, $teacher_result2[$i]['id'], 'desc', null,$date_from ,$date_to, '0' ,$deduction[$j]['id']  );
            }
	    }
       
		$data['teacherlist2'] = $teacher_result2;	 
		$data['teacherlist'] = $teacher_result;

        $this->load->view( 'layout/header', $data );
        $this->load->view( 'admin/teacher/incentive_deduction', $data );
        $this->load->view( 'layout/footer', $data );
    }


    public function salary_payment( $teacher_id = null )
    {
        if ( $teacher_id === null ) {
            show_404();
        } else {

            $data = array();

            $redirect = $this->input->post_get( 'redirect' );
            $redirect = ( $redirect !== null ? urldecode( $redirect ) : current_url() );
            $data['redirect'] = $redirect;

            $redirect_back = $this->input->post_get( 'redirect_back' );
            $redirect_back = ( $redirect_back !== null ? urldecode( $redirect_back ) : current_url() );
            $data['redirect_back'] = $redirect_back;
            
            $staff_list = $this->staff_model->get();
            $data['staff_list'] = $staff_list;

            $teacher_details = $this->teacher_model->get( $teacher_id );
            $data['teacher_details'] = $teacher_details;

            if ( $teacher_details === null ) {
                $this->session->set_flashdata( 'err', "Teacher not found!" );
                redirect( 'admin/teacher/salary' );
            } else {
           $teacher_result         = $this->teacher_model->get2(null,null,'active');
           $data['teacherlist']    = $teacher_result;
            
			 $teacher_result2         = $this->teacher_model->get2(null,null,'in-active');
             $data['teacherlist2']    = $teacher_result2;   
			 $data['title'] = 'Add Teacher';

                $teacher_salary_payments = $this->teacher_salary_payment->get2( null, $teacher_details['id'] );
				
				$teacher_salarys = $this->teacher_salary_payment->get2( );
				
				$teacher_incentive_deduction = $this->teacher_salary_payment->get_incentive( $teacher_details['id'] );
				$data['teacher_incentive_deduction'] =$teacher_incentive_deduction;
				
		    $student_fee_types = $this->student_fee_type_model->get_incentive(null, null, 'incentive');
			$data['student_fee_types'] = $student_fee_types;
			$student_fee_types2 = $this->student_fee_type_model->get_incentive(null, null, 'deduction');
			$data['student_fee_types2'] = $student_fee_types2;
            $teacher_payments = array();
            			 
			$incentive_deductions = $this->teacher_salary_payment->get_incentive( $teacher_details['id'],null,null,null,1);
	           
				$data['incentive_deductions'] = $incentive_deductions;
				$data['teacher_salary_payments'] = $teacher_salary_payments;
				$data['teacher_payments'] = $teacher_payments;
				
                $this->load->view( 'layout/header', $data );
                $this->load->view( 'admin/teacher/salary_payment', $data );
                $this->load->view( 'layout/footer', $data );

            }

        }
    }

    public function salary_payment_process( $teacher_id = null )
    {


        if ( $teacher_id === null ) {

            $this->session->set_flashdata( 'err', "Something went wrong!" );
            redirect( 'admin/teacher/salary' );

        } else {

            $this->form_validation->set_rules( 'paid_amount', 'Paid amount', 'trim|required|integer|intval' );

            if ( $this->form_validation->run() == false ) {
                $this->salary_payment();
            } else {

                $teacher_details = $this->teacher_model->get( $teacher_id );

                if ( $teacher_details === null ) {
                    $this->session->set_flashdata( 'err', "Teacher details were not found!" );
                    redirect( 'admin/teacher/salary' );
                } else {

                     $paid_amount = $this->input->post( 'paid_amount' );
                     
                     $teacher_advance1  = $this->input->post( 'teacher_advance' );
                     $teacher_security1 = $this->input->post( 'teacher_security' );
                     $teacher_eobi1     = $this->input->post( 'teacher_eobi' );

                     $admin = $this->input->post( 'admin' );
                     $teacher_advance = 0;
                     $teacher_eobi = 0;
                     $teacher_security = 0;
                     
                    if($teacher_advance1 > 0){
                        if($teacher_details['teacher_advance'] >= $teacher_advance1){
                            $teacher_advance  = $teacher_details['teacher_advance'] - $teacher_advance1;
                        }else{
                            $teacher_advance  =  $teacher_advance1 -  $teacher_details['teacher_advance'] ;
                        }
                        $this->db->update( $this->teacher_model->table_name, array(
                            'teacher_advance' => $teacher_advance
                        ), array(
                            'id' => $teacher_details['id']
                        ) );
                    }
                    if($teacher_security1 > 0){
                        if($teacher_details['teacher_security'] >= $teacher_security1){
                            $teacher_security  = $teacher_details['teacher_security'] - $teacher_security1;
                        }else{
                            $teacher_security  =  $teacher_security1 -  $teacher_details['teacher_security'] ;
                        }
                        $this->db->update( $this->teacher_model->table_name, array(
                            'teacher_security' => $teacher_security
                        ), array(
                            'id' => $teacher_details['id']
                        ) );
                    }

                    if($teacher_eobi1 > 0){
                        if($teacher_details['teacher_eobi'] >= $teacher_eobi1){
                            $teacher_eobi  = $teacher_details['teacher_eobi'] - $teacher_eobi1;
                        }else{
                            $teacher_eobi  =  $teacher_eobi1 -  $teacher_details['teacher_eobi'] ;
                        }
                        $this->db->update( $this->teacher_model->table_name, array(
                            'teacher_eobi' => $teacher_eobi
                        ), array(
                            'id' => $teacher_details['id']
                        ) );
                    }

                    if($paid_amount >= 0){
                        $paid_amount = $paid_amount - $teacher_advance1 + $teacher_security1 - $teacher_eobi1;
                    }
                 $due_salary = intval( $teacher_details['due_salary'] ) - $paid_amount;


                // updating due salary
                $this->db->update( $this->teacher_model->table_name, array(
                    'due_salary' => $due_salary
                ), array(
                    'id' => $teacher_details['id']
                ) );

		 $teacher_salary_payments = $this->teacher_salary_payment->get();	
		 
	     $max  =	max(array_column($teacher_salary_payments, 'teacher_salary_payment_id'));	
		 
        $incentive_deductions = $this->teacher_salary_payment->get_incentive( $teacher_details['id'],null,null,null,1);
        
       
            $total_inc = 0;
            $total_dedu = 0;
            
            foreach($incentive_deductions as $inc){
                if($inc['type'] == 'incentive' ){

                    $total_inc += $inc['amount'];

                }
                if($inc['type'] == 'deduction'){
                    $total_dedu += $inc['amount'];
                }
            }
		
		
	        // adding payment details to the teacher salary payment
                 $insert =  $this->teacher_salary_payment->insert( array(
                        'teacher_id' => $teacher_details['id'],
                        'due_salary' => $teacher_details['due_salary'],
                        'paid_salary' => $paid_amount,
                        'teacher_security' => $teacher_security1,
                        'teacher_advance' => $teacher_advance1,
                        'teacher_eobi' => $teacher_eobi1,
                        'teacher_salary_payment_date' => date( 'Y-m-d', now() ),
						'admin_id' => $admin,
						'paid' => 1,
						'incentive'=> $total_inc,
						'deduction'=> $total_dedu,
					  ));

                      $data1= array(
                          'payment_id' => $insert,
                          'paid' => '0'
                      );
                    foreach($incentive_deductions as $inc){
                        $this->db->set('paid','payment_id');
                        $this->db->where('teacher_id',$inc['teacher_id']);
                        $this->db->where('paid',1);
                        $this->db->update('incentive_deduction  ',$data1);

                    }
      

                    $this->session->set_flashdata( 'msg', "Payment record has been added!" );
                    redirect( site_url("admin/teacher/salary_payment/".$teacher_details['id']) );

                }

            }

        }

    }

    public function teacher_incentives()
    {
        $this->session->set_userdata( 'top_menu', 'FeeManagement' );
        $this->session->set_userdata( 'sub_menu', 'fee_management/student_fee_types' );

        $data = [
            'title' => "Add Heads"
        ];

        $incentives = $this->student_fee_type_model->get_incentive(null,null ,'incentive');
        $data['incentives'] = $incentives;
		$deductions = $this->student_fee_type_model->get_incentive(null,null, 'deduction');
        $data['deductions'] = $deductions;

        $this->load->view( 'layout/header', $data );
        $this->load->view( 'admin/teacher/teacher_incentives', $data );
        $this->load->view( 'layout/footer', $data );
    }
	
	public function teacher_incentives_add()
    {
    	
		$this->form_validation->set_rules( 'incentive', 'incentive', 'trim|required|strtolower|ucfirst' );
		$this->form_validation->set_rules( 'incentive_amount', 'incentive_amount', 'trim|required|integer' );
		
		if($this->form_validation->run() == false){
			
			 $this->teacher_incentives();
	    }else{
				
			
			$incentive = $this->input->post( 'incentive' );
		    $incentive_amount = $this->input->post( 'incentive_amount' );
		   
            $this->student_fee_type_model->insert_incentive( [
                'name' => $incentive,
                'amount' => $incentive_amount,
                'type' => 'incentive'
             
			] );

            $this->session->set_flashdata( 'msg', "Teacher Incentive has been added!" );
            redirect( 'admin/teacher/teacher_incentives' );

        }
    }

    public function teacher_deduction_add()
    {
        
		$this->form_validation->set_rules( 'deduction', 'deduction', 'trim|required|strtolower|ucfirst' );
		$this->form_validation->set_rules( 'deduction_amount', 'deduction_amount', 'trim|required|integer' );
		
		if($this->form_validation->run() == false){
			
			 $this->teacher_incentives();
	    }else{
				
					
            $deduction = $this->input->post( 'deduction' );
            $deduction_amount = $this->input->post( 'deduction_amount' );
			
           $this->student_fee_type_model->insert_incentive( [
                'name' => $deduction,
                'amount' => $deduction_amount,
                'type' => 'deduction'
             
			] );

            $this->session->set_flashdata( 'msg', "Teacher Deduction has been added!" );
			
			
            redirect( 'admin/teacher/teacher_incentives' );

        }
    }

     public function teacher_incentive_delete( $id = null )
    {
        if ( $id === null ) {
            $this->session->set_flashdata( 'err', "Something went wrong. Please try again!" );
            redirect( 'admin/teacher/teacher_incentives' );
        } else {

            $this->student_fee_type_model->delete_incentive( $id );

            $this->session->set_flashdata( 'msg', "Teacher Incentives/Deductions has been deleted!" );
            redirect( 'admin/teacher/teacher_incentives' );

        }
    }
	
	public function teacher_exit( $teacher_id = null )
    {
		if ( $teacher_id === null ) {
            $this->session->set_flashdata( 'err', "Something went wrong. Please try again!" );
            redirect( 'admin/teacher/attendance' );
        } else {

        $teacher_details  =   $this->teacher_model->get( $teacher_id );

    	 $exit_time	= date('h:i:s');
		 $date	= date('Y-m-d');
		 
           $this->db->update( 'teacher_attendance', [
                    'exit_time' => $exit_time
                ], [
				    'attendance_date' => $date,
                    'teacher_id' => $teacher_details['id'],
					
                ] );
            $this->session->set_flashdata( 'msg', "Teacher Incentives/Deductions has been deleted!" );
            redirect( 'admin/teacher/attendance' );

        }
    }
	
	public function staff_exit( $staff_id = null )
    {
		if ( $staff_id === null ) {
            $this->session->set_flashdata( 'err', "Something went wrong. Please try again!" );
            redirect( 'admin/teacher/attendance' );
        } else {

        $staff_details  =   $this->staff_model->get( $staff_id );

    	 $exit_time	= date('h:i:s');
		 $date	= date('Y-m-d');
		 
           $this->db->update( 'staff_attendance', [
                    'exit_time' => $exit_time
                ], [
				    'attendance_date' => $date,
                    'staff_id' => $staff_details['id'],
					
                ] );
            $this->session->set_flashdata( 'msg', "Teacher Incentives/Deductions has been deleted!" );
            redirect( 'admin/teacher/attendance' );

        }
    }
	
    public function salary_payment_delete( $salary_payment_id = null )
    {
        $redirect = $this->input->get( 'redirect' );

        // get paid salary
        
		
		$salary_payment = $this->teacher_salary_payment->get( $salary_payment_id );
		
				
        if ( $salary_payment === false ) {
            show_404( 'Salary payment not found!' );
        } else {
            // get teacher's record
			
		
		
		
	
            $teacher = $this->teacher_model->get( $salary_payment['teacher_id'] );

	
            if ( $teacher === false ) {
                show_404( 'Teacher was not found!' );
            } else {
                // add salary to the due salary in teachers table
				


			  $this->db->update( 'teachers', [
                    'due_salary' => intval( $teacher['due_salary'] ) + $salary_payment['paid_salary'] -  $salary_payment['incentive'] +  $salary_payment['deduction']
                ], [
                    'id' => $teacher['id']
                ] );


				// delete salary payment record
               
                // delete salary payment record
               
			  $this->db->update( 'teacher_salary_payments', [
                    'paid' => 0
                ], [
                    'teacher_salary_payment_id' => $salary_payment_id
                ] );

			   
			   
			  
        
               $redirect = ( $redirect !== null ? urldecode( $redirect ) : "admin/teacher/salary_payment/" . $teacher['id'] );

                $redirect_back = $this->input->get( 'redirect_back' );
                $redirect_back = ( $redirect_back !== null ? "?redirect_back={$redirect_back}" : "" );

                redirect( $redirect . $redirect_back );
            }
        }
    }
	
	public function incentive_delete( $incentive_id = null )
    {
        $redirect = $this->input->get( 'redirect' );
        // get paid salary
        $incentive = $this->teacher_salary_payment->get_incentives($incentive_id);

         if ( $incentive === false ) {
            show_404( 'Salary payment not found!' );
        } else {
            // get teacher's record
            if($incentive[0]['teacher_staff'] == 1){
                $teacher = $this->teacher_model->get( $incentive[0]['teacher_id'] );
                if ( $teacher === false ) {
                    show_404( 'Teacher was not found!' );
                } else {
                    // add salary to the due salary in teachers table
                    if($incentive[0]['type'] == 'incentive'){
                    $this->db->update( 'teachers', [
                        'due_salary' => intval( $teacher['due_salary'] ) - $incentive[0]['amount']
                    ], [
                        'id' => $teacher['id']
                    ] );
                    }
                    if($incentive[0]['type'] == 'deduction'){
                     $this->db->update( 'teachers', [
                        'due_salary' => intval( $teacher['due_salary'] ) + $incentive[0]['amount']
                    ], [
                        'id' => $teacher['id']
                    ] );
                    }
                    // delete salary payment record
                    $this->db->delete( 'incentive_deduction', [
                        'id' => $incentive[0]['id']
                    ] );
                    redirect( site_url("admin/teacher/salary_payment/" . $teacher['id']) );
                }

            }elseif($incentive[0]['teacher_staff'] == 0){
                $staff = $this->staff_model->get( $incentive[0]['teacher_id'] );
                
                if ( $staff === false ) {
                    show_404( 'Staff was not found!' );
                } else {
                    // add salary to the due salary in teachers table
                    if($incentive[0]['type'] == 'incentive'){
                    $this->db->update( 'staff', [
                        'due_salary' => intval( $staff['due_salary'] ) - $incentive[0]['amount']
                    ], [
                        'id' => $staff['id']
                    ] );
                    }
                    if($incentive[0]['type'] == 'deduction'){
                     $this->db->update( 'staff', [
                        'due_salary' => intval( $staff['due_salary'] ) + $incentive[0]['amount']
                    ], [
                        'id' => $staff['id']
                    ] );
                    }
                    // delete salary payment record
                    $this->db->delete( 'incentive_deduction', [
                        'id' => $incentive[0]['id']
                    ] );
                    redirect( site_url("admin/teacher/salary_payment/" . $staff['id']) );
                }

            }

      

            
           
        }
    }
	
	public function teacher_incentive_deduction($teacher_id)
    {
        $incentive              = $this->input->post( 'incentive' );
		$deduction              = $this->input->post( 'deduction' );
		$deduction_date         = $this->input->post( 'deduction_date' );
        $incentive_date         = $this->input->post( 'incentive_date' );
		$admin                  = $this->input->post( 'admin_id' );
		$teacher_details        = $this->teacher_model->get( $teacher_id );
      


       
	     $ADD = 0;
	if(!empty($incentive)){	
       $this->db->trans_start();
       
        foreach ( $incentive as $feeItem ) {
            $paid = 1;
            $ADD += $feeItem['amount'];	 
	        if( !empty( $feeItem['check'] ) && $feeItem['check'] == '1' ) {
                $ADD = 0;	 
                
                if(strtolower($feeItem['name']) == 'advance' ){
                    $paid = 0;
                    $update_advance = $teacher_details['teacher_advance'] + $feeItem['amount'];
                    $this->db->update( 'teachers', [
                        'teacher_advance' => $update_advance,
                    ], [
                        'id' => $teacher_id
                    ] );
            
                }
                if(strtolower($feeItem['name']) == 'security' ){
                    $ADD = 0;	
                    $paid = 0;
                    $update_security = $teacher_details['teacher_security'] + $feeItem['amount'];
                    $this->db->update( 'teachers', [
                        'teacher_security' => $update_security,
                    ], [
                        'id' => $teacher_id
                    ] );
                }
                if(strtolower($feeItem['name']) == 'eobi' ){
                    $paid = 0;
                    $ADD = 0;	
                    $update_eobi = $teacher_details['teacher_eobi'] + $feeItem['amount'];
                    $this->db->update( 'teachers', [
                        'teacher_eobi' => $update_eobi,
                    ], [
                        'id' => $teacher_id
                    ] );
                }
                $this->db->insert( 'incentive_deduction', [
                                    'teacher_id' => $teacher_id,
                                    'amount' => $feeItem['amount'],
                                    'name' => $feeItem['name'],
                                    'incentive_id' => $feeItem['id'],
                                    'type' => 'incentive',
                                    'paid' => $paid,
                                    'date' =>  date('Y-m-d', strtotime($incentive_date)),
                                    'teacher_staff' => '1'
                                ] );
            }
		}
		$due_salary   =   $teacher_details['due_salary'] + $ADD;
		$this->db->update( 'teachers', [
                            'due_salary' => $due_salary,
                        ], [
                            'id' => $teacher_id
                        ] );
	   $this->db->trans_complete();
	}else{
		  $this->db->trans_start();
         	$subtract = 0;
		 
		 foreach ( $deduction as $feeItem ) {
            if ( !empty( $feeItem['check'] ) && $feeItem['check'] == '1' ) {
                $subtract += $feeItem['amount'];
                $subtract = 0;
                $paid = 1;
                if(strtolower($feeItem['name']) == 'advance' ){
                    $paid = 0;
                    $update_advance = $teacher_details['teacher_advance'] - $feeItem['amount'];
                    $this->db->update( 'teachers', [
                        'teacher_advance' => $update_advance,
                    ], [
                        'id' => $teacher_id
                    ] );
                }
                if(strtolower($feeItem['name']) == 'security' ){
                    $paid = 0;
                    $subtract = 0;
                    $update_security = $teacher_details['teacher_security'] - $feeItem['amount'];
                    $this->db->update( 'teachers', [
                        'teacher_security' => $update_security,
                    ], [
                        'id' => $teacher_id
                    ] );
                }
                if(strtolower($feeItem['name']) == 'eobi' ){
                    $paid = 0;
                    $subtract = 0;
                    $update_eobi = $teacher_details['teacher_eobi'] - $feeItem['amount'];
                    $this->db->update( 'teachers', [
                        'teacher_eobi' => $update_eobi,
                    ], [
                        'id' => $teacher_id
                    ] );
                }
                $this->db->insert( ' incentive_deduction', [
                                    'teacher_id' => $teacher_id,
                                    'amount' => $feeItem['amount'],
                                    'name' => $feeItem['name'],
                                    'type' => 'deduction',
                                    'incentive_id' => $feeItem['id'],
                                    'paid' =>$paid,
                                    'date' => date('Y-m-d', strtotime($deduction_date)),
                                    'teacher_staff' => '1' 
                                ] );
            }

		}
        $due_salary   =   $teacher_details['due_salary'] - $subtract;
        $this->db->update( 'teachers', [
                            'due_salary' => $due_salary,
                        ], [
                            'id' => $teacher_id
                        ] );

                $this->db->trans_complete();
    }
	  
	   redirect( "admin/teacher/salary_payment/{$teacher_details['id']}" );
    }
	
    public function salary_payment_update( $teacher_id )
    {
		    $name                  = $this->input->post( 'name' );
            $payments              = $this->input->post( 'payments' );
            $date                  = $this->input->post( 'joining_date' );
            $teacher_id            = $this->input->post('teacher_id');
            $salary_payment_id     = $this->input->post('salary_payment_id');
            $admin_id            = $this->input->post('admin');
            $salary_payment = $this->teacher_salary_payment->get( $salary_payment_id );
     
            $my_date = date('Y-m-d', strtotime($date));
			$data = array(
                'teacher_salary_payment_date'         => $my_date,
                'paid_salary'                         => $payments,
				'teacher_salary_payment_id'           => $salary_payment_id,
				'admin_id'                            => $admin_id,
            );
           

            $teacher = $this->teacher_model->get( $teacher_id );

            if($payments > $salary_payment['paid_salary']){                     //  50000 > 40000
                $techer_salary  = $payments - $salary_payment['paid_salary'] +$teacher['due_salary'] ;   /// 50000 - 40000  = 10000 + 10000 
            }else{
                $techer_salary  = $salary_payment['paid_salary']  - $payments + $teacher['due_salary']  ;   //40000 < 50000
                                                                                  //  50000  - 40000  = 10000 +10000
            }
 		
         $update_salary_payment  =  $this->teacher_salary_payment->teacher_salary_update($data, $id);
	   
		 $this->db->update( 'teachers', [
                    'due_salary' =>$techer_salary
                ], [
                    'id' => $teacher['id']
                ] );
				$this->db->update( 'teacher_salary_payments', [
                    'teacher_salary_payment_id' => $salary_payment['teacher_salary_payment_id']
                ] );
          
        redirect( 'admin/teacher/salary_report' );
		 
		 
    }

    public function attendance_report_teacher()
    {
        $this->session->set_userdata( 'top_menu', 'Reports' );
        $this->session->set_userdata( 'sub_menu', 'admin/teacher/attendance_report' );

        $data = [
            'title' => "Teacher Annual Attendance Report"
        ];
 
        $teacher_id = $this->input->get( 'teacher_id' );
       
	    $year = $this->input->get( 'year' );
        $year = ( $year !== null ? $year : date( 'Y', now() ) );
        $data['year'] = $year;

        for ( $i = 1; $i < 13; $i++ ):
		$month = str_pad($i,2,0,STR_PAD_LEFT);
        endfor;



        $days_in_month = cal_days_in_month( CAL_GREGORIAN, $month, $year );

        $data['days_in_month'] = $days_in_month;

        $attendance_dates = [];
		
        for ( $day_number = 1; $day_number <= $days_in_month; $day_number++ ) {
            $attendance_dates[] = "{$year}-{$month}-{$day_number}";
        }
		
        $data["attendance_dates"] = $attendance_dates;
		
        $teachers1 = $this->teacher_model->get($teacher_id);
        
		$data['teachers1'] =    $teachers1;    
      
       for ( $i = 1; $i < 13; $i++ ):

            $annual = str_pad($i,2,0,STR_PAD_LEFT);
            $teachers[$i]['day_attendance'] = array();

            for ( $day_number = 1; $day_number <= $days_in_month; $day_number++ ) {
         $teachers[$i]['day_attendance'][$day_number] = $this->teacher_attendance_model->search_attendance($teacher_id, "{$year}-{$annual}-{$day_number}" );

                if ( $teachers[$i]['day_attendance'][$day_number] !== false ) {
                    for ( $k = 0; $k < count( $teachers[$i]['day_attendance'][$day_number] ); $k++ ) {
                        $teachers[$i]['day_attendance'][$day_number]['teacher_attendence_type'] = $this->teacher_attendence_type_model->get( $teachers[$i]['day_attendance'][$day_number]['teacher_attendence_type_id'] );
                    }
                }
            }
			   endfor;
			   
			 
       $holidays   = $this->stuattendence_model->get_holiday();
		$total_holiday= 0;
		foreach($holidays as $holiday){
			
			$total_holiday += $holiday['days']; 
			
			}
		
		$end_date = date('Y-m-d', strtotime('12/30'));
		
		$total  = $total_holiday + date("W", strtotime("$end_date"));
		
		$data['total'] = $total;  



        $data['teachers'] = $teachers;

        $this->load->view( 'layout/header', $data );
        $this->load->view( 'admin/teacher/attendance_report_teacher', $data );
        $this->load->view( 'layout/footer', $data );
    }

    public function attendance_report()
    {
        $this->session->set_userdata( 'top_menu', 'Reports' );
        $this->session->set_userdata( 'sub_menu', 'admin/teacher/attendance_report' );

        $data = [
            'title' => "Teacher Attendance Report"
        ];
 
        $year = $this->input->get( 'year' );
        $year = ( $year !== null ? $year : date( 'Y', now() ) );
        $data['year'] = $year;

        $month = $this->input->get( 'month' );
        $month = ( $month !== null ? $month : date( 'm', now() ) );
        $data['month'] = $month;

        $days_in_month = cal_days_in_month( CAL_GREGORIAN, $month, $year );
        $data['days_in_month'] = $days_in_month;

        $attendance_dates = [];
        for ( $day_number = 1; $day_number <= $days_in_month; $day_number++ ) {
            $attendance_dates[] = "{$year}-{$month}-{$day_number}";
        }
        $data["attendance_dates"] = $attendance_dates;

        $teachers = $this->teacher_model->get();

        for ( $i = 0; $i < count( $teachers ); $i++ ) {
            $teachers[$i]['day_attendance'] = array();

            for ( $day_number = 1; $day_number <= $days_in_month; $day_number++ ) {
                $teachers[$i]['day_attendance'][$day_number] = $this->teacher_attendance_model->search_attendance( $teachers[$i]['id'], "{$year}-{$month}-{$day_number}" );

                if ( $teachers[$i]['day_attendance'][$day_number] !== false ) {
                    for ( $k = 0; $k < count( $teachers[$i]['day_attendance'][$day_number] ); $k++ ) {
                        $teachers[$i]['day_attendance'][$day_number]['teacher_attendence_type'] = $this->teacher_attendence_type_model->get( $teachers[$i]['day_attendance'][$day_number]['teacher_attendence_type_id'] );
                    }
                }
            }
        }
		
		
		 $staff_members = $this->staff_model->get();
        $month_days = cal_days_in_month( CAL_GREGORIAN, $month, $year );
        $month_dates = [];
        for ( $i = 1; $i <= $month_days; $i++ ) {
            $month_dates[] = date( "Y-m-d", strtotime( "{$year}-{$month}-{$i}" ) );
        }
        if ( $staff_members !== false ) {
            for ( $j = 0; $j < count( $staff_members ); $j++ ) {
                $staff_members[$j]['attendance'] = array();

                // get attendance for everyday
                foreach ( $month_dates as $month_date ) {
                    $staff_members[$j]['attendance'][$month_date] = $this->staff_attendance_model->get( null, $staff_members[$j]['id'], $month_date );
                }
            }
        }

        $holidays   = $this->stuattendence_model->get_holiday();
		$total_holiday= 0;
		foreach($holidays as $holiday){
			$total_holiday += $holiday['days']; 	
		}	
        $start_month = $this->setting_model->getStartMonth();
        $counting  =  getSundays(date('Y'),$start_month);
        if($saturday == 1){
            $counting = $counting + $counting;
        }
        $total  = $total_holiday + $counting;

		
		$data['total'] = $total;

        $data['month_dates'] = $month_dates;
        $data['staff_members'] = $staff_members;

        $data['teachers'] = $teachers;
		$date = date("F-Y", now());
		
		$attendece = $this->staff_attendance_model->get();
		
		$sum_teacher_attendance = $this->teacher_attendance_model->sum_teacher_attendance_by_date2( date( 'Y-m-d', now() ) );
        $data['sum_teacher_attendance'] = $sum_teacher_attendance;
		
		$sum_staff_attendance = $this->staff_attendance_model->sum_staff_attendance_by_date2( date( 'Y-m-d', now() ) ); 
        $data['sum_staff_attendance'] = $sum_staff_attendance;
	    
		
	   
		
		$data['print_title']  = "Teachers Attendance Report for the Month of (".$date.")";
		$data['print_title_2']  = "Staff Attendance Report for the Month of (".$date.")";
		 
		 
        $this->load->view( 'layout/header', $data );
        $this->load->view( 'admin/teacher/attendance_report', $data );
        $this->load->view( 'layout/footer', $data );
    }

    public function salary_report()
    {
        $this->session->set_userdata( 'top_menu', 'Reports' );
        $this->session->set_userdata( 'sub_menu', 'admin/teacher/salary_report' );

        $this->form_validation->set_data( $_GET );
		  $teacher_name_search = $this->input->get( 'teacher_name' );
	    $search_type = $this->input->get('search_type');
	
        if($search_type  == null){
            $search_type  = "date" ;
        }

        $this->form_validation->set_rules( 'date_from', 'Date from', 'trim|urldecode' );
        $this->form_validation->set_rules( 'date_to', 'Date to', 'trim|urldecode' );
		$this->form_validation->set_rules( 'search_type', 'search Type', 'trim|urldecode' );
        $this->form_validation->run();

        $print_title = 'Salary Report';

        $current_date = new DateTime( date( 'Y-m-d', now() ) );

        $date_from = $this->input->get( 'date_from' );
        $date_from = ( $date_from !== null ? date( 'Y-m-d', strtotime( $date_from ) ) : $current_date->format( 'Y-m-01' ) );
        $date_to = $this->input->get( 'date_to' );
        $date_to = ( $date_to !== null ? date( 'Y-m-d', strtotime( $date_to ) ) : $current_date->format( "Y-m-" . cal_days_in_month( CAL_GREGORIAN, $current_date->format( 'm' ), $current_date->format( 'Y' ) ) ) );


  

        $salary_payments = $this->teacher_salary_payment->teacher_salary_records( null, null, $date_from, $date_to );

		
	 $teacher_result = $this->teacher_model->get();
	
        for ( $i = 0; $i < count( $teacher_result ); $i++ ) {
           
            $teacher_result[$i]['current_month_last_payment'] = $this->teacher_salary_payment->get( null, $teacher_result[$i]['id'], 'desc', null,$date_from , $date_to );
       
		}
	
	$teacherlist = $teacher_result;
	
    $data = compact(
            'title',
            'salary_payments',
            'date_from',
            'date_to',
			'search_type',
			'teacherlist'
		 );
		 
        $this->load->view( 'layout/header', $data );
        $this->load->view( 'admin/teacher/salary_report', $data );
        $this->load->view( 'layout/footer', $data );
    }

}
