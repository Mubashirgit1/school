<?php

class Staff extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->helper( 'file' );
        $this->lang->load( 'message', 'english' );
        $this->role;
    }

    public function index()
    {

        $this->session->set_userdata( 'top_menu', 'TeacherAttendance' );
        $this->session->set_userdata( 'sub_menu', 'staff/index' );

        $data = [];
        $data['title'] = 'Add Staff Member';

             $staff_type = $this->input->get( 'staff_type' );
			$data['staff_type_search'] = $staff_type;
       
	    $data['staff_member'] = null;
        $staff_id = $this->input->get( 'staff_id' );
        // if staff id doesn't exists
        if ( $staff_id !== null ) {
            $staff_member = $this->staff_model->get( $staff_id );
            // if staff member doesn't exists
            if ( $staff_member === false ) {
                $this->session->set_flashdata( 'err', "Staff member wasn't found in the system." );
                redirect( 'admin/staff' );
            } else { // staff member exists
                $data['staff_member'] = $staff_member;
            }
        }



        $staff_list = $this->staff_model->get();
        $data['staff_list'] = $staff_list;

        $genderList = $this->customlib->getGender();
        $data['genderList'] = $genderList;

        $staff_departments = $this->staff_departments_model->get();
        $data['staff_departments'] = $staff_departments;

        $this->load->view( 'layout/header', $data );
        $this->load->view( 'admin/staff/index', $data );
        $this->load->view( 'layout/footer', $data );

    }
	
	
	function edit2( $id =null)
    {
	        $staff_id   =	$this->input->get('staff_id');
		    $salary_payments = $this->staff_salary_payments_model->staff_salary_records2( $staff_id, null, null, null);
			$data['salary_payments'] = $salary_payments;
			$this->load->view( 'layout/header',$data);
            $this->load->view( 'admin/staff/staffpaymentEdit2', $data );
            $this->load->view( 'layout/footer', $data );
       
	 }

    function rejoin( $id )
    {
		
		$id = $this->input->get('staff_id');
		
	    $redirect  = 'admin/staff/create';
        
        $this->staff_model->rejoin( $id );
		
        $this->session->set_flashdata( 'msg', '<div student="alert alert-success text-left">Staff Record Updated successfully</div>' );
        redirect( $redirect );
        
    }
	
	function resign( $id )
    {
		$id = $this->input->get('staff_id');
		
		$redirect  = 'admin/staff/create';
        
        $this->staff_model->resign( $id );
		
        $this->session->set_flashdata( 'msg', '<div student="alert alert-success text-left">Staff Record Updated successfully</div>' );
        redirect( $redirect );
        
    }

    public function create()
    {
		
	
        $this->form_validation->set_rules( 'staff_id', 'Staff ID', 'trim' );
        $this->form_validation->set_rules( 'name', 'Name', 'trim|required' );
        $this->form_validation->set_rules( 'email', 'Email', 'trim|valid_email' );
        $this->form_validation->set_rules( 'gender', 'Gender', 'trim|required' );
        $this->form_validation->set_rules( 'staff_departments', 'Staff departments', 'trim|required|integer' );
        $this->form_validation->set_rules( 'salary', 'Salary', 'trim|integer' );
        $this->form_validation->set_rules( 'dob', 'DOB', 'trim' );
        $this->form_validation->set_rules( 'address', 'Address', 'trim' );
        $this->form_validation->set_rules( 'phone', 'Phone', 'trim' );
		
        $this->form_validation->set_rules( 'joining_date', 'Date Of Joining', 'trim' );
        $this->form_validation->set_rules( 'qualification', 'Qualification', 'trim' );
        $this->form_validation->set_rules( 'qualification_details', 'Qualification Details', 'trim' );

        if ( $this->form_validation->run() == false ) {
            
			$staff_type = $this->input->get( 'staff_type' );
			
			
			$data['staff_type_search'] = $staff_type;
			
			if($staff_type == 'all'){
				
            $staff_result = $this->staff_model->get();
			$data['staff_list'] = $staff_result;
			
			}elseif($staff_type == 'in-active'){
		    
			$staff_result = $this->staff_model->get2( null, null, $staff_type);
			$data['staff_list'] = $staff_result;
				
			}else{
					
		    $staff_result = $this->staff_model->get2( null, null, 'active');
			$data['staff_list'] = $staff_result;
					
            }
			
			$genderList = $this->customlib->getGender();
            $data['genderList'] = $genderList;
			
			
			
			$this->index();
			
			
			
        } else {
			
			
            
            $staff_id           = $this->input->post( 'staff_id' );
            $name               = $this->input->post( 'name' );
            $email              = $this->input->post( 'email' );
            $gender             = $this->input->post( 'gender' );
            $staff_departments  = $this->input->post( 'staff_departments' );
            $salary             = $this->input->post( 'salary' );
            $dob                = ( !empty( $this->input->post( 'dob' ) ) ? date( 'Y-m-d', strtotime( $this->input->post( 'dob' ) ) ) : null );
            $address            = $this->input->post( 'address' );
            $phone              = $this->input->post( 'phone' );
			 $joining_date      = $this->input->post( 'joining_date' );
            $qualification      = $this->input->post( 'qualification' );
            $qualification_details = $this->input->post( 'qualification_details' );


            $data = [
			    'id'                    => $staff_id,
			    'name'                  => $name,
                'name'                  => $name,
                'email'                 => $email,
                'sex'                   => $gender,
                'staff_department_id'   => $staff_departments,
                'salary'                => $salary,
                'dob'                   => $dob,
                'address'               => $address,
                'phone'                 => $phone,
			    'image'                 => 'uploads/student_images/no_image.png',
                'joining_date'          => $joining_date,
                'qualification'         => $qualification,
                'qualification_details' => $qualification_details,
				'active'                => 1,
            ];


          $insert_id = $this->staff_model->add( $data );
           
		   
		   if($insert_id == null){
			$insert_id =  $staff_id;
			}
			
			
			 $user_password = $this->role->get_random_password( $chars_min = 6, $chars_max = 6, $use_upper_case = false, $include_numbers = true, $include_special_chars = false );
    
            $staff_name = $this->input->post( 'name' );
            $staff_name = strtolower( $staff_name );
            $staff_name = preg_replace( "/[^a-zA-Z0-9]+/", '', $staff_name );
    
	             
		  $username_count = 1;
            do {
                // search username in users table
                $username_exists = $this->user_model->user_exists( $staff_name );
                if ( $username_exists === false ) {
          	    $data_staff_login = array(
                        'username' => $staff_name,
                        'password' => $user_password,
                        'user_id' => $insert_id,
                        'role' => 'staff'
                    );
                    $this->user_model->add( $data_staff_login );
                }
				 else {

                    $staff_name = $staff_name . $username_count;
                    $username_count++;

                }

            } while ( $username_exists === true );
			
			

			 if ( isset( $_FILES["file"] ) && !empty( $_FILES['file']['name'] ) ) {
				 
                $fileInfo = pathinfo( $_FILES["file"]["name"] );
			
				 
                $img_name = $insert_id . '.' . $fileInfo['extension'];
			
				
                move_uploaded_file( $_FILES["file"]["tmp_name"], "./uploads/teacher_images/" . $img_name );
				
                $data_img = array('id' => $insert_id, 'image' => 'uploads/teacher_images/' . $img_name);
               
			    $this->staff_model->add( $data_img );
            }
			
			
            redirect( 'admin/staff' );

        }
    }

    public function delete( $id = null )
    {
        if ( $id === null ) {
            show_404();
        } else {

            $this->db->delete( 'staff', ['id' => $id] );

            $this->session->set_flashdata( 'err', "Record of requested staff member has been deleted scucessfully!" );
            redirect( 'admin/staff' );

        }
    }

    public function staff_departments()
    {
        $this->session->set_userdata( 'top_menu', 'TeacherAttendance' );
        $this->session->set_userdata( 'sub_menu', 'staff/staff_departments' );

        $data = [];
        $data['title'] = 'Add Staff Member';

        $staff_deps = $this->staff_departments_model->get();
        $data['staff_deps'] = $staff_deps;

        $this->load->view( 'layout/header', $data );
        $this->load->view( 'admin/staff/staff_departments', $data );
        $this->load->view( 'layout/footer', $data );
    }

    public function staff_departments_process()
    {
        $this->form_validation->set_rules( 'dep_name', 'Department Name', 'trim|required' );

        if ( $this->form_validation->run() == false ) {
            $this->staff_departments();
        } else {

            $this->db->insert( $this->staff_departments_model->table_name, [
                'name' => $this->input->post( 'dep_name' )
            ] );

            $this->session->set_flashdata( 'msg', "Department has been added!" );
            redirect( 'admin/staff/staff_departments' );

        }
    }

    public function staff_departments_delete( $id = null )
    {
        if ( $id === null ) {
            show_404();
        } else {

            $this->db->delete( $this->staff_departments_model->table_name, ['id' => $id] );

            $this->session->set_flashdata( 'msg', "Department has been deleted!" );
            redirect( 'admin/staff/staff_departments' );

        }
    }

    // public function salary()
    // {
    //     $this->session->set_userdata( 'top_menu', 'Expenses' );
    //     $this->session->set_userdata( 'sub_menu', 'staff/salary' );

    //     $name = $this->input->get( 'name' );

    //     $data = [];
    //     $data['title'] = ' Staff Accounts Status';

    //     $redirect = $this->input->get( 'redirect' );
    //     $redirect = ( $redirect !== null ? urldecode( $redirect ) : current_url() );
    //     $data['redirect'] = $redirect;

    //     $staff_list = $this->staff_model->get( null, $name );
    //     if ( $staff_list !== false ) {
    //         for ( $i = 0; $i < count( $staff_list ); $i++ ) {
				
    //       $month_start_date = date( 'Y-m-01', now() );
    //         $_days_in_month = cal_days_in_month( CAL_GREGORIAN, date( 'm', strtotime( $month_start_date ) ), date( 'Y', strtotime( $month_start_date ) ) );
    //         $staff_list[$i]['current_month_last_payment'] = $this->staff_salary_payments_model->get( null ,$staff_list[$i]['id'], $month_start_date, date( "Y-m-{$_days_in_month}", strtotime( $month_start_date ) ) );
	//     }
	// 	}
	// 	$data['staff_list'] = $staff_list;
    //     $this->load->view( 'layout/header', $data );
    //     $this->load->view( 'admin/staff/salary', $data );
    //     $this->load->view( 'layout/footer', $data );
    // }

    public function salary_payment( $id = null )
    {
        if ( $id === null ) {
            show_404();
        } else {

            $data = array();

            $data['staff_details'] = $this->staff_model->get( $id );

            if ( $data['staff_details'] === false ) {
                $this->session->set_flashdata( 'err', "Staff member not found!" );
                redirect( 'admin/staff/salary' );
            } else {

                $data['title'] = 'Staff Salary';

                $redirect_back = $this->input->get( 'redirect_back' );
                $redirect_back = ( $redirect_back !== null ? urldecode( $redirect_back ) : current_url() );
                $data['redirect_back'] = $redirect_back;

               $staff_salary_payments  = $this->staff_salary_payments_model->get( null, $data['staff_details']['id'] );
				
				$staff_list = $this->staff_model->get();
                $data['staff_list'] = $staff_list;
                $student_fee_types = $this->student_fee_type_model->get_incentive(null, null, 'incentive');
                $data['student_fee_types'] = $student_fee_types;
                $student_fee_types2 = $this->student_fee_type_model->get_incentive(null, null, 'deduction');
                $data['student_fee_types2'] = $student_fee_types2;

                $teacher_result         = $this->teacher_model->get2(null,null,'active');
                $data['teacherlist']    = $teacher_result;
                
                $incentive_deductions = $this->staff_salary_payments_model->get_incentive( $data['staff_details']['id'],null,null,null,1);
                $data['incentive_deductions']    = $incentive_deductions;
                
				$data['staff_salary_payments']=$staff_salary_payments;
				
                $this->load->view( 'layout/header', $data );
                $this->load->view( 'admin/staff/salary_payment', $data );
                $this->load->view( 'layout/footer', $data );

            }

        }
    }
    public function staff_incentive_deduction($staff_id)
    {
        $incentive                = $this->input->post( 'incentive' );
		$deduction                = $this->input->post( 'deduction' );
		$deduction_date           = $this->input->post( 'deduction_date' );
		$incentive_date           = $this->input->post( 'incentive_date' );
        $admin                    = $this->input->post( 'admin_id' );
        $staff_details = $this->staff_model->get( $staff_id );
     
	     $ADD = 0;
	if(!empty($incentive)){	
	   $this->db->trans_start();
         foreach ( $incentive as $feeItem ) {

	 if( !empty( $feeItem['check'] ) && $feeItem['check'] == '1' ) {

        $ADD += $feeItem['amount'];	 
       
        $this->db->insert( 'incentive_deduction', [
                                'teacher_id' => $staff_id,
                                'amount' => $feeItem['amount'],
								'name'   =>   $feeItem['name'],
								'incentive_id' => $feeItem['id'],
								'type' => 'incentive',
								'paid' => '1',
                                'date' =>  date('Y-m-d', strtotime($incentive_date)),
                                ]);
               }
		 }
		$due_salary   =   $staff_details['due_salary'] + $ADD;
		 
		 $this->db->update( 'staff', [
                            'due_salary' => $due_salary,
                        ], [
                            'id' => $staff_id
                        ] );
		 
		 
		 
	   $this->db->trans_complete();
	}else{
		  $this->db->trans_start();
         	$subtract = 0;
		 
		 foreach ( $deduction as $feeItem ) {
   if ( !empty( $feeItem['check'] ) && $feeItem['check'] == '1' ) {
 
      $subtract += $feeItem['amount'];	
 
                 $this->db->insert( ' incentive_deduction', [
                                'teacher_id' => $staff_id,
                                'amount' => $feeItem['amount'],
								'name' => $feeItem['name'],
								'type' => 'deduction',
							   'incentive_id' => $feeItem['id'],
								'paid' => '1',
                                'date' => date('Y-m-d', strtotime($deduction_date)),
                            ] );
           }
		 }
		 
		 
       $due_salary   =   $staff_details['due_salary'] - $subtract;
	 
	  $this->db->update( 'staff', [
                            'due_salary' => $due_salary,
                        ], [
                            'id' => $staff_id
                        ] );
	   $this->db->trans_complete();
			}
	  
	   redirect( "admin/staff/salary_payment/{$staff_details['id']}" );
    }

	public function incentive_delete( $incentive_id = null )
    {
        $redirect = $this->input->get( 'redirect' );
        // get paid salary
        $incentive = $this->teacher_salary_payment->get_incentive(null, null, $incentive_id  );
         if ( $incentive === false ) {
            show_404( 'Salary payment not found!' );
        } else {
            // get teacher's record
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

               $redirect = ( $redirect !== null ? urldecode( $redirect ) : "admin/teacher/salary_payment/" . $teacher['id'] );

                $redirect_back = $this->input->get( 'redirect_back' );
                $redirect_back = ( $redirect_back !== null ? "?redirect_back={$redirect_back}" : "" );

                     redirect( $redirect . $redirect_back );
            }
        }
    }
	

    public function salary_payment_process( $id = null )
    {
        if ( $id === null ) {
            show_404();
        } else {

            $staff_member = $this->staff_model->get( $id );

            if ( $staff_member === false ) {
                show_404();
            } else {

                $paid_amount = $this->input->post( 'paid_amount' );
				$admin = $this->input->post( 'admin' );
                $due_salary = intval( $staff_member['due_salary'] );
                $incentive_deductions = $this->staff_salary_payments_model->get_incentive( $staff_member['id'],null,null,null,1);
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
          

                $this->db->trans_start();

              $insert =  $this->db->insert( 'staff_salary_payments', [
                    'staff_id'      => $id,
                    'due_salary'    => $due_salary,
                    'paid_salary'   => $paid_amount,
                    'user_id'       => $admin,
                    'payment_date'  => date( 'Y-m-d', now() ),
                    'incentive'     => $total_inc,
                    'deduction'     => $total_dedu
                ] );

                $due_salary -= $paid_amount;

                $this->db->update( 'staff', [
                    'due_salary' => $due_salary
                ], [
                    'id' => $id
                ] );

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
                $this->db->trans_complete();

                if ( $this->db->trans_status() === true ) {
                    $this->session->set_flashdata( 'msg', "Staff salary record has been added!" );
                    redirect( 'admin/staff/salary_payment/' . $id  );
                } else {
                    $this->session->set_flashdata( 'err', "Staff salary record wasn't added. Please try again later!" );
                    redirect( 'admin/staff/salary_payment/' . $id );
                }

            }

        }
    }

    public function salary_payment_delete( $id = null )
    {
        if ( $id === null ) {
            show_404();
        } else {

            $redirect = $this->input->get( 'redirect' );
            $redirect = ( $redirect !== null ? urldecode( $redirect ) : "admin/staff/salary_payment/{$id}" );

            $redirect_back = $this->input->get( 'redirect_back' );
            $redirect_back = ( $redirect_back !== null ? urldecode( $redirect_back ) : "admin/staff/salary_payment/{$id}" );

            $staff_salary_payment = $this->staff_salary_payments_model->get( $id );

            if ( $staff_salary_payment === false ) {
                show_404();
            } else {

                $staff_detail = $this->staff_model->get( $staff_salary_payment['staff_id'] );

                if ( $staff_detail === false ) {
                    show_404();
                } else {

      $staff_detail['due_salary'] = floatval( $staff_detail['due_salary'] ) + floatval( $staff_salary_payment['paid_salary'] );


      $this->db->update( 'staff', [
                            'due_salary' => $staff_detail['due_salary'],
                          
                        ], [
                            'id' => $staff_detail['id'],
                        ] );

         
                    $this->db->delete( 'staff_salary_payments', ['id' => $staff_salary_payment['id']] );

                    $this->session->set_flashdata( 'msg', 'Staff salary transaction has been deleted.' );
                    redirect( $redirect . '?redirect_back=' . $redirect_back );

                }

            }

        }
    }
	
	
	public function salary_payment_update( $staff_id )
    {
       
	   
           
            $name                  = $this->input->post( 'name' );
            $payments              = $this->input->post( 'payments' );
            $date                  = $this->input->post( 'joining_date' );
			$id                    = $this->input->post('staff_id');
			$admin                 = $this->input->post('admin');
			
		 $salary_payment = $this->staff_salary_payments_model->get_by_staff( $id );
			
			
		   
		  $my_date = date('Y-m-d', strtotime($date));
			
			$data = array(
                
                'payment_date'          => $my_date,
                'paid_salary'           => $payments,
				'id'                    => $id,
                'user_id'               => $admin
         );
            
			
			$result2  =  $this->staff_salary_payments_model->staff_salary_update($data, $id);
			
		    $salary_payment = $this->staff_salary_payments_model->get( $id );
		
		
		 
  		 $staff = $this->staff_model->get( $salary_payment['staff_id'] );
		 
		 
		 $this->db->update( 'staff', [
                    'due_salary' => intval( $staff['salary'] ) - $salary_payment['paid_salary']
                ],
				 [
                    'id' => $staff['id']
                ] );
				$this->db->update( 'staff_salary_payments',[
                    'due_salary' => intval( $staff['salary'] ) - $salary_payment['paid_salary']
                ], [
                    'id' => $salary_payment['id']
                ] );
              $redirect = ( $redirect !== null ? urldecode( $redirect ) : "admin/staff/edit2?staff_id=" . $staff['id'] );

                
            $this->session->set_flashdata( 'msg', 'Staff salary transaction has been Updated.' );      
         
		   redirect($redirect );
		 
			

	}
	

    public function salary_report()
    {


        $this->session->set_userdata( 'top_menu', 'Reports' );
        $this->session->set_userdata( 'sub_menu', 'admin/staff/salary_report' );

        $this->form_validation->set_data( $_GET );
        $this->form_validation->set_rules( 'date_from', 'Date from', 'trim|urldecode' );
        $this->form_validation->set_rules( 'date_to', 'Date to', 'trim|urldecode' );
		$this->form_validation->set_rules( 'search_type', 'search Type', 'trim|urldecode' );
        $this->form_validation->run();
           $search_type = $this->input->get('search_type');
        $print_title = 'Staff Salary Report';

        $current_date = new DateTime( date( 'Y-m-d', now() ) );

        $date_from = $this->input->get( 'date_from' );
        $date_from = ( $date_from !== null ? date( 'Y-m-d', strtotime( $date_from ) ) : $current_date->format( 'Y-m-01' ) );
        $date_to = $this->input->get( 'date_to' );
        $date_to = ( $date_to !== null ? date( 'Y-m-d', strtotime( $date_to ) ) : $current_date->format( 'Y-m-' ) . cal_days_in_month( CAL_GREGORIAN, $current_date->format( 'm' ), $current_date->format( 'Y' ) ) );

        $staff_salary_payments = $this->staff_salary_payments_model->get( null, null, $date_from, $date_to );
		
		
		
		$staff_list = $this->staff_model->get(  );
		
        if ( $staff_list !== false ) {
            for ( $i = 0; $i < count( $staff_list ); $i++ ) {
            $month_start_date = date( 'Y-m-01', now() );
			$_days_in_month = cal_days_in_month( CAL_GREGORIAN, date( 'm', strtotime( $month_start_date ) ), date( 'Y', strtotime( $month_start_date ) ) );
	        $staff_list[$i]['current_month_last_payment'] = $this->staff_salary_payments_model->get(null,  $staff_list[$i]['id'] , $date_from,$date_to);
        }
            }
            // echo "<pre>";
            // print_r($staff_list);
            // echo "</pre>";
           
            // exit;
	
        $data['staff_list'] = $staff_list;
	
        $data = compact(
            'print_title',
            'staff_salary_payments',
            'date_from',
            'date_to',
			'staff_list',
			'search_type'
			
        );
		
        $this->load->view( 'layout/header', $data );
        $this->load->view( 'admin/staff/salary_report', $data );
        $this->load->view( 'layout/footer', $data );
    }

    public function attendance_report_staff()
    {
        $this->session->set_userdata( 'top_menu', 'Reports' );
        $this->session->set_userdata( 'sub_menu', 'admin/teacher/attendance_report' );

        $data = [
            'title' => "Staff Annual Attendance Report"
        ];
 
        $staff_id = $this->input->get( 'staff_id' );
       
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
		
        $staff1 = $this->staff_model->get($staff_id);
        
		$data['staff1'] =    $staff1;    
      
         
			    for ( $i = 1; $i < 13; $i++ ):
		       $month = str_pad($i,2,0,STR_PAD_LEFT);
			   $month_days = cal_days_in_month( CAL_GREGORIAN, $month, $year );
                endfor;
			   
			   
		  $staff_members = $this->staff_model->get($staff_id);
		  
		  $month_dates = [];
      
	
	   for ( $j = 1; $j <= $month_days; $j++ ) {
            $month_dates[] = date( "Y-m-d", strtotime( "{$year}-{$month}-{$j}" ) );
        }
  
                // get attendance for everyday
            
			 for ( $i = 1; $i < 13; $i++ ):
               $month = str_pad($i,2,0,STR_PAD_LEFT);
			   $month_days = cal_days_in_month( CAL_GREGORIAN, $month, $year );

            $staff_members[$i]['attendance'] = array();

			  for ( $day_number = 1; $day_number <=  $month_days; $day_number++ ) {
					 
           $staff_members[$i]['attendance'][$day_number] = $this->staff_attendance_model->get( null,  $staff_members['id'], "{$year}-{$i}-{$day_number}");
              
            }
			
			
			 endfor;
			 
			 
			 //	echo "<pre>";
			//	 print_r($staff_members);
			 //  echo "</pre>";
			 
		
		//	 exit;
			
          $holidays   = $this->stuattendence_model->get_holiday();
		$total_holiday= 0;
		foreach($holidays as $holiday){
			
			$total_holiday += $holiday['days']; 
			
			}
		
		$end_date = date('Y-m-d', strtotime('12/30'));
		
		$total  = $total_holiday + date("W", strtotime("$end_date"));
		
		$data['total'] = $total;
		$data['month_dates'] =  $month_dates;
		$data['staff_members'] = $staff_members;	   
			   
			   
			   
			   
// echo "<pre>";
// print_r($teachers);
// echo "</pre>";
// exit;


        $data['teachers'] = $teachers;

        $this->load->view( 'layout/header', $data );
        $this->load->view( 'admin/staff/attendance_report_staff', $data );
        $this->load->view( 'layout/footer', $data );
    }

    public function attendance()
    {

        $this->session->set_userdata( 'top_menu', 'Attendance' );
        $this->session->set_userdata( 'sub_menu', 'staff/attendance' );

        $data = [
            'title' => "Staff Attendance"
        ];

        $attendance_date = $this->input->get( 'attendance_for' );
        $attendance_date = ( $attendance_date !== null ? urldecode( $attendance_date ) : date( 'm/d/Y', now() ) );
        $data['attendance_date'] = $attendance_date;

        $staff_members = $this->staff_model->get();
        $data['staff_members'] = $staff_members;

        $this->load->view( 'layout/header', $data );
        $this->load->view( 'admin/staff/attendance', $data );
        $this->load->view( 'layout/footer', $data );

    }

    public function attendance_process()
    {
	
        $staff = $this->input->post( 'staff' );
        $attendance_date = $this->input->post( 'attendance_date' );
        $attendance_date = date( 'Y-m-d', ( $attendance_date !== null ? strtotime( $attendance_date ) : now() ) );
	
        for ( $i = 0; $i < count( $staff ); $i++ ) {
            $this->form_validation->set_rules( "staff[{$i}][id]", "Staff ID $i", 'trim|required|integer|intval' );
            $this->form_validation->set_rules( "staff[{$i}][attendance]", "Staff ID $i", 'trim|required|in_list[present,absent,leave,half]' );
        }



        if ( $this->form_validation->run() == false ) {
            $this->attendance();
        } else {

            $absent_staff_names = [];
			$late_staff_names = [];

            for ( $i = 0; $i < count( $staff ); $i++ ) {
                $staff_id = $staff[$i]['id'];
                $staff_attendance = $staff[$i]['attendance'];
                $staff_details = $this->staff_model->get( $staff_id );

                   if ( strtolower( $staff_attendance ) == 'absent' ) {
                        $absent_staff_names[] = $staff_details['name'];
                    }
					if ( strtolower( $staff_attendance ) == 'half' ) {
                        $late_staff_names[] = $staff_details['name'];
                    }
                
				$staff_attendance_model = $this->staff_attendance_model->get( null, $staff_id, $attendance_date );

                // if attendance is not marked for today
                if ( $staff_attendance_model === false ) {
                    $this->db->insert( 'staff_attendance', [
                        'staff_id' => $staff_id,
                        'attendance' => $staff_attendance,
                        'attendance_date' => $attendance_date
                    ] );

                
                } else { // Attendance is marked for today



                    // update it
                  $this->db->update( 'staff_attendance', [
                        'attendance' => $staff_attendance,
                        'attendance_date' => $attendance_date
                    ], [
                        'id' => $staff_attendance_model['id']
                    ] );

                }
            }
			
      if ( !empty( $late_staff_names ) ) {
                $admin_phone = $this->custom_option_model->get( 'admin_phone' );
           //     $this->sms_library->send_sms( $admin_phone['value'], $this->sms_messages->teacher_staff_late_message( $absent_staff_names, 'staff members' ) );
            }

      if ( !empty( $absent_staff_names ) ) {
                $admin_phone = $this->custom_option_model->get( 'admin_phone' );
           //     $this->sms_library->send_sms( $admin_phone['value'], $this->sms_messages->teacher_staff_absent_message( $absent_staff_names, 'staff members' ) );
            }

            $this->session->set_flashdata( 'msg', "Attendance has been saved/updated!" );
            redirect( 'admin/teacher/attendance' );

        }
    }

    public function attendance_report()
    {
        $this->session->set_userdata( 'top_menu', 'Reports' );
        $this->session->set_userdata( 'sub_menu', 'admin/staff/attendance_report' );

        $data = [
            'title' => "Staff Attendance report"
        ];

        $year = $this->input->get( 'year' );
        $year = ( $year !== null ? $year : date( 'Y', now() ) );
        $data['year'] = $year;

        $month = $this->input->get( 'month' );
        $month = ( $month !== null ? $month : date( 'm', now() ) );
        $data['month'] = $month;

        $month_days = cal_days_in_month( CAL_GREGORIAN, $month, $year );
        $month_dates = [];
        for ( $i = 1; $i <= $month_days; $i++ ) {
            $month_dates[] = date( "Y-m-d", strtotime( "{$year}-{$month}-{$i}" ) );
        }



        $staff_members = $this->staff_model->get();
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
            $saturday = $this->setting_model->getStaffSaturday();
        if($saturday == 1){
            $counting = $counting + $counting;
        }
		
		$total  = $total_holiday + $counting;
		
		$data['total'] = $total;
		
	    $data['month_dates'] = $month_dates;
        $data['staff_members'] = $staff_members;

        $this->load->view( 'layout/header', $data );
        $this->load->view( 'admin/staff/attendance_report' );
        $this->load->view( 'layout/footer', $data );
    }

}