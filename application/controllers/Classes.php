<?php

if ( !defined( 'BASEPATH' ) )
    exit( 'No direct script access allowed' );

class classes extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper( 'file' );
        $this->lang->load( 'message', 'english' );
    }

    public function index()
    {
        $this->session->set_userdata( 'top_menu', 'Academics' );
        $this->session->set_userdata( 'sub_menu', 'classes/index' );
        $data['title'] = 'Add Class';
        $data['title_list'] = 'Class List';
        $this->form_validation->set_rules(
            'class', 'Class',
            array(
                'required',
                array('class_exists', array($this->class_model, 'class_exists'))
            )
        );
        $this->form_validation->set_rules( 'sections[]', 'Section', 'trim|required|xss_clean' );
        $this->form_validation->set_rules( 'fee', 'Fee', 'trim|required|xss_clean' );
        $data['admission_key'] = $this->setting_model->getadmissionkey();
       
        if($data['admission_key'] == 1){
            $this->form_validation->set_rules( 'class_group', 'Class Group', 'trim|required|xss_clean' );
        }
     
        if ( $this->form_validation->run() == FALSE ) {
        } else {
            $class = $this->input->post( 'class' );
            $class_group = $data['admission_key'] == 0 ? 0 : $this->input->post( 'class_group' );
            $class_array = array(
                'class' => $this->input->post( 'class' ),
                'fee' => $this->input->post( 'fee' ),
                'class_group' =>  $class_group,
            );
            // print_r($data['admission_key']);
            // print_r($class_array);
            // exit;
            $sections = $this->input->post( 'sections' );

            $this->classsection_model->add( $class_array, $sections );
            $this->session->set_flashdata( 'msg', '<div class="alert alert-success text-left">Class added successfully</div>' );
            redirect( 'classes' );
        }
		
	
        $data['vehiclelist']    = $this->section_model->get();
        $data['admission_key']  = $this->setting_model->getadmissionkey();
        if($data['admission_key'] == 1){
        $classgrouplist = $this->class_group_model->get();
          $data['classgrouplist'] = $classgrouplist;  
        }
        $data['vehroutelist']   = $this->classsection_model->getByID();


           
        $this->load->view( 'layout/header', $data );
        $this->load->view( 'class/classList', $data );
        $this->load->view( 'layout/footer', $data );
    }   
    function classgroup() {
        $this->session->set_userdata('top_menu', 'Expenses');
        $this->session->set_userdata('sub_menu', 'expenseshead/index');
        $data['title'] = 'Class Group List';
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        $category_result = $this->class_group_model->get();
        $data['categorylist'] = $category_result;
        $this->load->view('layout/header', $data);
        $this->load->view('class/classgroup', $data);
        $this->load->view('layout/footer', $data);
    }

    public function createClassGroup(){
       
        $this->form_validation->set_rules( 'name', 'Name', 'trim|required|xss_clean' );
        $this->form_validation->set_rules( 'admission_key', 'Admission Key', 'trim|required|xss_clean' );

          if ( $this->form_validation->run() == FALSE ) {
            redirect( 'classes/classgroup' );
          } else {

                $class_array = array(
                    'name'           => $this->input->post( 'name' ),
                    'admission_key'  => $this->input->post( 'admission_key' ),
                );
                $this->class_group_model->add( $class_array );    
            
            $this->session->set_flashdata( 'msg', '<div class="alert alert-success text-left">Class Group added successfully</div>' );
            redirect( 'classes/classgroup' );
        }
        
    }

    public function updateOrder(){
        $data = array();
        $data['order_by']       =    $this->input->get('order');
        $data['id']             =    $this->input->get('class_section');
        $ordercheck =  $this->classsection_model->check_order($data);
    
        if($ordercheck){
            $order = false;
            echo json_encode($order);
            exit();
        }else{
            $order =  $this->classsection_model->updateOrder($data);
        }
   
        echo json_encode($order);
        exit();
     
    }

    public function delete( $id )
    {
        $data['title'] = 'Fees Master List';
        $this->class_model->remove( $id );
        redirect( 'classes' );
    }
	
	public function delete_update_fee( $id )
    {
        $this->class_model->delete_fee( $id );
        redirect( 'classes/class_fee' );
    }

    public function edit( $id )
    {
        $this->session->set_userdata( 'top_menu', 'Academics' );
        $this->session->set_userdata( 'sub_menu', 'classes/index' );
        $data['title'] = 'Edit Class';
        $data['id'] = $id;
        $vehroute = $this->classsection_model->getByID( $id );
        $data['vehroute'] = $vehroute;
        $data['title_list'] = 'Fees Master List';

        $this->form_validation->set_rules(
            'class', 'Class', array(
                'required',
                array('class_exists', array($this->class_model, 'class_exists'))
            )
        );
        $this->form_validation->set_rules( 'sections[]', 'Sections', 'trim|required|xss_clean' );
        $this->form_validation->set_rules( 'fee', 'Fee', 'trim|numeric' );


        if ( $this->form_validation->run() == FALSE ) {
            $vehicle_result = $this->section_model->get();
            $data['vehiclelist'] = $vehicle_result;
            $routeList = $this->route_model->get();
            $data['routelist'] = $routeList;
            $vehroute_result = $this->classsection_model->getByID();

            $data['vehroutelist'] = $vehroute_result;
            $this->load->view( 'layout/header', $data );
            $this->load->view( 'class/classEdit', $data );
            $this->load->view( 'layout/footer', $data );
        } else {

            $sections = $this->input->post( 'sections' );
            $prev_sections = $this->input->post( 'prev_sections' );
            $route_id = $this->input->post( 'route_id' );
            $class_id = $this->input->post( 'pre_class_id' );
            if ( !isset( $prev_sections ) ) {
                $prev_sections = array();
            }
            $add_result = array_diff( $sections, $prev_sections );
            $delete_result = array_diff( $prev_sections, $sections );

            if ( !empty( $add_result ) ) {
                $vehicle_batch_array = array();
                $class_array = array(
                    'id' => $class_id,
                    'class' => $this->input->post( 'class' ),
                    'fee' => $this->input->post( 'fee' )
                );
                foreach ( $add_result as $vec_add_key => $vec_add_value ) {

                    $vehicle_batch_array[] = $vec_add_value;
                }
                $this->classsection_model->add( $class_array, $vehicle_batch_array );
            } else {
				
				$class = $this->input->post( 'class' );
                $fee = $this->input->post( 'fee' );
        		 $class_detail = $this->class_model->get($class_id);
		        
				
				$class_array2 = array(
                    'class' => $this->input->post( 'class' ),
                    'class_fee' => $this->input->post( 'fee' ),
                    'date' => date('Y-m-d', now()),
					'previous_class_fee' => $class_detail['fee'],
					'class_id' => $class_id,
				);


                $all_student = $this->student_model->searchByClass( $class_id,null  );

                  $update_fee =$fee - $class_detail['fee'];

                  foreach($all_student as $stud){
                      $fee_arr =  $stud['fee_arrears'] + $update_fee;
                      $data = array(
                          'fee_arrears' => $fee_arr,
                      );
                      $update = $this->student_model->updateDues( $stud['id'], $data );
                  }

				$this->classsection_model->update_class_fee( $class_array2 );

				$class_array = array(
                    'id' => $class_id,
                    'class' => $this->input->post( 'class' ),
                    'fee' => $this->input->post( 'fee' )
                );
                $this->classsection_model->update( $class_array );
            }

            if ( !empty( $delete_result ) ) {
                $classsection_delete_array = array();
                foreach ( $delete_result as $vec_delete_key => $vec_delete_value ) {

                    $classsection_delete_array[] = $vec_delete_value;
                }

                $this->classsection_model->remove( $class_id, $classsection_delete_array );
            }


            $this->session->set_flashdata( 'msg', '<div class="alert alert-success text-left">Class updated successfully</div>' );
            redirect( 'classes/index' );
        }

    }

    public function assign_class_incharge()
    {
        $this->session->set_userdata( 'top_menu', 'Academics' );
        $this->session->set_userdata( 'sub_menu', 'classes/assign_class_incharge' );

        $data = [];

        $class = $this->class_model->get();
        $data['classlist'] = $class;

        $class_section_incharge = $this->classsection_model->get_class_section_incharge_teacher();
        for ( $i = 0; $i < count( $class_section_incharge ); $i++ ) {
            if ( !empty( $class_section_incharge[$i]['class_incharge_teacher_id'] ) ) {
                $class_section_incharge[$i]['teacher'] = $this->teacher_model->get( $class_section_incharge[$i]['class_incharge_teacher_id'] );
            }
        }
        $data['class_section_incharge'] = $class_section_incharge;

        $teachers = $this->teacher_model->get();
        $data['teachers'] = $teachers;

        $this->load->view( 'layout/header', $data );
        $this->load->view( 'class/assign_class_incharge', $data );
        $this->load->view( 'layout/footer', $data );

    }

    public function assign_class_incharge_process()
    {
        $this->form_validation->set_rules( 'class_id', 'Class', 'trim|required' );
        $this->form_validation->set_rules( 'section_id', 'Section', 'trim|required' );
        $this->form_validation->set_rules( 'teacher_id', 'Teacher', 'trim|required' );

        if ( $this->form_validation->run() == false ) {
            $this->assign_class_incharge();
        } else {

            $class_id = $this->input->post( 'class_id' );
            $section_id = $this->input->post( 'section_id' );
            $teacher_id = $this->input->post( 'teacher_id' );

            $this->db->update( 'class_sections', [
                'class_incharge_teacher_id' => $teacher_id
            ], [
                'class_id' => $class_id,
                'section_id' => $section_id
            ] );

            $this->session->set_flashdata( 'msg', 'Class Incharge Teacher assigned successfully!' );
            redirect( 'classes/assign_class_incharge' );

        }
    }

    public function class_fee( )
    {
	    $this->session->set_userdata( 'top_menu', 'Academics' );
        $this->session->set_userdata( 'sub_menu', 'classes/assign_class_incharge' );
        $class = $this->class_model->get();
        $class_update_fee = $this->classsection_model->get_class_update_fee();
        $class_update = [];
        for( $j = 1; $j <  count($class_update_fee); $j++ ){
        $class = $this->class_model->get();
            for( $i = 0; $i <  count($class); $i++ ){
            $class_update[$class_update_fee[$j]['date']][$i] = $this->classsection_model->get_class_update_fee($class[$i]['id'],$class_update_fee[$j]['date']);
            }
        }
		$data['class_fee'] = $class_update;
        $data['classlist'] = $class;
        $this->load->view( 'layout/header', $data );
        $this->load->view( 'class/class_fee', $data );
        $this->load->view( 'layout/footer', $data );
    }

	public function all_date_sheet( $exam_id )
    {
		
	    $this->session->set_userdata( 'top_menu', 'Academics' );
        $this->session->set_userdata( 'sub_menu', 'classes/assign_class_incharge' );


       if($exam_id  == null){

           $exam_id = $this->input->post('exam_id');

       }




    	$select_exam_detail  = 	$this->exam_model->get($exam_id);
		$exam  = 	$this->examschedule_model->getDetailbyClsandSection_exam($exam_id);

		$exam_detail  = 	$this->exam_model->get();
	   for( $k = 1; $k <  count($exam); $k++ ){
    	   $class = $this->class_model->get();
    	   for( $i = 0; $i <  count($class); $i++ ){
			  $class_section = $this->classsection_model->get($class[$i]['id']);
			  for( $j = 0; $j <  count($class_section); $j++ ){
				 $examSchedule[$exam[$k]['date_of_exam']][$i][$j]   = $this->examschedule_model->getDetailbyClsandSectionbydate($class[$i]['id'], $class_section[$j]['section_id'], $exam_id , $exam[$k]['date_of_exam']);
			 }
		  }
		}
		
		// echo "<pre>";
		// print_r($examSchedule);
		// echo "</pre>";
		// exit;
		$data['examschedule'] =  $examSchedule;
        $data['classlist'] = $class;
        $data['exam'] = $exam_detail;  
        $data['select_exam_detail'] = $select_exam_detail;  


        $this->load->view( 'layout/header', $data );
        $this->load->view( 'class/date_sheet', $data );
        $this->load->view( 'layout/footer', $data );

       }   

}
