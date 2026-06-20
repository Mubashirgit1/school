<?php

if ( !defined( 'BASEPATH' ) )
    exit( 'No direct script access allowed' );

class graphs extends Admin_Controller
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

    function teacher_graph1()
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
            $this->load->view( 'graph/graph', $data );
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
                    $this->load->view( 'graph/graph', $data );
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
	
 


    function teacher_graph_month2() 
	{
        $this->session->set_userdata( 'top_menu', 'Reports' );
        $this->session->set_userdata( 'sub_menu', 'admin/teacher/attendance_report' );

        $data = [
            'title' => "Teacher Annual Attendance Report"
        ];
 
        $teacher_id = 24;
       
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
			   

        $data['teachers'] = $teachers;

		
		echo json_encode($teache);
	
		 
         
    }

	function teacher_graph_month() 
	{
        $this->session->set_userdata( 'top_menu', 'Reports' );
        $this->session->set_userdata( 'sub_menu', 'admin/teacher/attendance_report' );

        $data = [
            'title' => "Teacher Annual Attendance Report"
        ];
 
        $teacher_id = 24;
       
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
       $this->load->view('graph/teacher_month_graph', $data);
        $this->load->view( 'layout/footer', $data );
    }	



	

}
