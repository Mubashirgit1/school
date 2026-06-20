<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class adminuser extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('file');
        $this->load->helper('menu_helper');
        $this->lang->load('message', 'english');
    }

    function index() {
		 if ($this->customlib->getAdminSessionUserRole() == 'admin_main') {
            $this->session->set_userdata('top_menu', 'System Settings');
            $this->session->set_userdata('sub_menu', 'adminuser/index');
            $data['title'] = 'Admin User';
			$adminuser_result = $this->admin_model->get();
		    $data['adminlist'] = $adminuser_result;
			$this->load->view('layout/header', $data);
            $this->load->view('admin/adminuser/adminuserList', $data);
            $this->load->view('layout/footer', $data);
        }else{
            redirect('balance_sheet');
        }
    }

    function userpermission($id = null) {
	    $this->session->set_userdata('top_menu', 'System Settings');
        $this->session->set_userdata('sub_menu', 'adminuser/index');
       
	    $data['title'] = 'Admin/User Premissions';
        $adminuser_result = $this->admin_model->get($id);
        $data['admin'] = $adminuser_result;

        $this->load->view('layout/header', $data);
        $this->load->view('admin/adminuser/adminuserpermissions', $data);
        $this->load->view('layout/footer', $data);
    }

 
    function delete($id) {
        $data['title'] = 'Admin User List';
        $this->admin_model->remove($id);
        redirect('admin/adminuser/index');
    }

    function create() {
        $data['title']      = 'Add Admin User';
        $adminuser_result   = $this->admin_model->get();
        $data['adminlist']  = $adminuser_result;
        $this->form_validation->set_rules('username', 'Admin Name', 'trim|required|xss_clean');     
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean');
        $this->form_validation->set_rules('role', 'role', 'trim|required|xss_clean');		
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/adminuser/adminuserList', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $data = array(
                'username'  => $this->input->post('username'),
                'email'     => $this->input->post('email'),
				'role'      => $this->input->post('role'),				
                'password'  => md5($this->input->post('password')),
				'is_active' => 'yes'
            );
            $insert_id = $this->admin_model->add($data);
            
            if($insert_id){
                $p_data = array(
                    'admin_id'              => $insert_id,
                    'admission_teacher'        => 0,
                    'admission_student'        => 0,
                    'student_access'           => 0,
                    'teacher_access'           => 0,
                    'academics'                => 0,
                    'class'                    => 0,
                    'section'                  => 0,
                    'subject'                  => 0,
                    'assign_subject'           => 0,
                    'assign_class_incharge'    => 0,
                    'class_wise_timtable'      => 0,
                    'daily_timetable'          => 0,
                    'teacher_wise_table'       => 0,
                    'classes_fee_history'      => 0,
                    'date_sheet'               => 0,
                    'class_u'                    => 0,
                    'section_u'                  => 0,
                    'subject_u'                  => 0,
                    'assign_subject_u'           => 0,
                    'assign_class_incharge_u'    => 0,
                    'class_wise_timtable_u'      => 0,
                    'daily_timetable_u'          => 0,
                    'holiday'                    => 0,
					'saturday'                   => 0,
					'student_card'          => 0,
					'session'               => 0,
					'graphs'                => 0,
					'exams'                 => 0,
                    'mark_sheet'            => 0,
                    'mark_sheet_u'            => 0,
                    'date_sheet_u'          => 0,
                    'voucher_generation'    => 0,
                    'expiry_date'           => 0,
					'voucher_details'       => 0,
                    'delete_fee'            => 0,              
                    'vr_search'             => 0,              
                    'message'               => 0,
					'school_message'        => 0,
					'admin_fee_message'     => 0,
					'parent_att_msg'        => 0,
					'admin_daily_message'   => 0,
                    'fee_collection_message'=> 0,
                    'date_sheet_all'        => 0,
                    'expense'               => 0,
                    'expense_u'             => 0,
                    'bank'                  => 0,
                    'daily_transactions'    => 0,
                    'daily_filter'          => 0,
                    'daily_left'            => 0,
                    'daily_right'           => 0,
                    'fee_collect_filter'    => 0,
                    'salary'                => 0,
					'register_t'            => 0,
					'register_s'            => 0,
					'salary_status'         => 0,
					'active_t'              => 0,
					'inactive_t'            => 0,
                    'transaction_t'         => 0,
                    'transaction_s'         => 0,
                    'heads_due'             => 0,
					'heads_history'         => 0,
					'add_heads'             => 0,
					'account_ts'            => 0,
					'arrears_adjust'        => 0,
                    'fine'                  => 0,
					'submission'            => 0,	
					'daily_delete'          => 0,
                    'payment_delete'        => 0,
                    'balancesheet_figures'  => 0,
                    'student_balance_sheet' => 0,
                    'attendance_balance_sheet' => 0,
                    'fine_arrears'          => 0,
                    'waive'                 => 0,
                    'summary'               => 0,
                    'class_group'           => 0,
                    'award'                 => 0,
                    'advance_leave'         => 0,
                    'vr_due_fine'           => 0,
                    'admission_roll'        => 0,
                    'vr_reprint_fee'        => 0,
                    'other_voucher_fine'    => 0,
                    'combine_fee'           => 0,
                    'due_date'              => 0,
                    'menu_bar'              => 0,
                    'download'              => 0,
                    'users'                 => 0,
                    'fee_columns'           => 0,
                    's_fee'                     => 0,
                    's_attendance'              => 0,
                    's_due_fee'                 => 0,
                    's_date_sheet'              => 0,
                    's_subjects'                => 0,
                    's_timetable'               => 0,
                    's_youtube'                 => 0,
                    's_assignment'              => 0,
                    's_exam'                    => 0,
                    's_homework'                => 0,
                    's_syllabus'                => 0,
                    's_discount'                => 0,
                    's_graph'                   => 0,
                    's_vacation'                => 0,

                );
                //70    
                $this->admin_model->add_permission($p_data);
                $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Admin user added successfully</div>');
            }
            redirect('admin/adminuser/index');
        }
    }
    function permission() {
        
        $data['title']      = 'Add Admin User';
        $admin_id                   = !empty($this->input->post('admin_id')) ?$this->input->post('admin_id'):null;
        $admission_teacher          = $this->input->post('admission_teacher') == '1'?$this->input->post('admission_teacher'):0;
        $admission_student          = $this->input->post('admission_student') == '1'?$this->input->post('admission_student'):0;
        $student_access             = $this->input->post('student_access') == '1'?$this->input->post('student_access'):0;
        $teacher_access             = $this->input->post('teacher_access') == '1'?$this->input->post('teacher_access'):0;
        $academics                  = $this->input->post('academics') == '1'?$this->input->post('academics'):0;
        $class                      = $this->input->post('class') == '1'?$this->input->post('class'):0;
        $section                    = $this->input->post('section') == '1'?$this->input->post('section'):0;
        $subject                    = $this->input->post('subject') == '1'?$this->input->post('subject'):0;
        $assign_subject             = $this->input->post('assign_subject') == '1'?$this->input->post('assign_subject'):0;
        $assign_class_incharge      = $this->input->post('assign_class_incharge') == '1'?$this->input->post('assign_class_incharge'):0;
        $class_wise_timtable        = $this->input->post('class_wise_timtable') == '1'?$this->input->post('class_wise_timtable'):0;
        $daily_timetable            = $this->input->post('daily_timetable') == '1'?$this->input->post('daily_timetable'):0;
        $teacher_wise_table         = $this->input->post('teacher_wise_table') == '1'?$this->input->post('teacher_wise_table'):0;
        $classes_fee_history        = $this->input->post('classes_fee_history') == '1'?$this->input->post('classes_fee_history'):0;
        $date_sheet_all             = $this->input->post('date_sheet_all') == '1'?$this->input->post('date_sheet_all'):0;
        $class_u                    = $this->input->post('class_u') == '1'?$this->input->post('class_u'):0;
        $section_u                  = $this->input->post('section_u') == '1'?$this->input->post('section_u'):0;
        $subject_u                  = $this->input->post('subject_u') == '1'?$this->input->post('subject_u'):0;
        $assign_subject_u           = $this->input->post('assign_subject_u') == '1'?$this->input->post('assign_subject_u'):0;
        $assign_class_incharge_u    = $this->input->post('assign_class_incharge_u') == '1'?$this->input->post('assign_class_incharge_u'):0;
        $class_wise_timtable_u      = $this->input->post('class_wise_timtable_u') == '1'?$this->input->post('class_wise_timtable_u'):0;
        $daily_timetable_u          = $this->input->post('daily_timetable_u') == '1'?$this->input->post('daily_timetable_u'):0;
        $holiday                    = $this->input->post('holiday')   == '1'?$this->input->post('holiday'):0;
        $saturday                   = $this->input->post('saturday')   == '1'?$this->input->post('saturday'):0;
        $student_card               = $this->input->post('student_card')   == '1'?$this->input->post('student_card'):0;
        $session                    = $this->input->post('session')   == '1'?$this->input->post('session'):0;
        $graphs                     = $this->input->post('graphs')   == '1'?$this->input->post('graphs'):0;
        $exams                      = $this->input->post('exams')   == '1'?$this->input->post('exams'):0;
        $date_sheet                 = $this->input->post('date_sheet') == '1'?$this->input->post('date_sheet'):0;
        $date_sheet_u               = $this->input->post('date_sheet_u') == '1'?$this->input->post('date_sheet_u'):0;
        $mark_sheet                 = $this->input->post('mark_sheet') == '1'?$this->input->post('mark_sheet'):0;
        $mark_sheet_u               = $this->input->post('mark_sheet_u') == '1'?$this->input->post('mark_sheet_u'):0;
        $voucher_generation         = $this->input->post('voucher_generation')   == '1'?$this->input->post('voucher_generation'):0;
        $expiry_date                = $this->input->post('expiry_date')   == '1'?$this->input->post('expiry_date'):0;
        $voucher_details            = $this->input->post('voucher_details')   == '1'?$this->input->post('voucher_details'):0;
        $delete_fee                 = $this->input->post('delete_fee')     == '1'?$this->input->post('delete_fee'):0;
        $vr_search                  = $this->input->post('vr_search')     == '1'?$this->input->post('vr_search'):0;
        $message                    = $this->input->post('message')   == '1'?$this->input->post('message'):0;
        $school_message             = $this->input->post('school_message')   == '1'?$this->input->post('school_message'):0;
        $admin_fee_message          = $this->input->post('admin_fee_message')   == '1'?$this->input->post('admin_fee_message'):0;
        $fee_collection_message     = $this->input->post('fee_collection_message')   == '1'?$this->input->post('fee_collection_message'):0;
        $parent_att_msg             = $this->input->post('parent_att_msg')   == '1'?$this->input->post('parent_att_msg'):0;
        $admin_daily_message        = $this->input->post('admin_daily_message')   == '1'?$this->input->post('admin_daily_message'):0;
        $expense                    = $this->input->post('expense')   == '1'?$this->input->post('expense'):0;
        $expense_u                  = $this->input->post('expense_u')   == '1'?$this->input->post('expense_u'):0;
        $daily_transactions         = $this->input->post('daily_transactions')   == '1'?$this->input->post('daily_transactions'):0;
        $bank                       = $this->input->post('bank')   == '1'?$this->input->post('bank'):0;
        $daily_filter               = $this->input->post('daily_filter')   == '1'?$this->input->post('daily_filter'):0;
        $daily_left                 = $this->input->post('daily_left')   == '1'?$this->input->post('daily_left'):0;
        $daily_right                = $this->input->post('daily_right')   == '1'?$this->input->post('daily_right'):0;
        $fee_collect_filter         = $this->input->post('fee_collect_filter')   == '1'?$this->input->post('fee_collect_filter'):0;
        $salary                     = $this->input->post('salary')   == '1'?$this->input->post('salary'):0;
        $register_t                 = $this->input->post('register_t')   == '1'?$this->input->post('register_t'):0;
        $register_s                 = $this->input->post('register_s')   == '1'?$this->input->post('register_s'):0;
        $salary_status              = $this->input->post('salary_status')   == '1'?$this->input->post('salary_status'):0;
        $active_t                   = $this->input->post('active_t')   == '1'?$this->input->post('active_t'):0;
        $inactive_t                 = $this->input->post('inactive_t')   == '1'?$this->input->post('inactive_t'):0;
        $transaction_t              = $this->input->post('transaction_t')   == '1'?$this->input->post('transaction_t'):0;
        $transaction_s              = $this->input->post('transaction_s')   == '1'?$this->input->post('transaction_s'):0;
        $heads_due                  = $this->input->post('heads_due')   == '1'?$this->input->post('heads_due'):0;
        $heads_history              = $this->input->post('heads_history')   == '1'?$this->input->post('heads_history'):0;
        $add_heads                  = $this->input->post('add_heads')   == '1'?$this->input->post('add_heads'):0;
        $account_ts                 = $this->input->post('account_ts')   == '1'?$this->input->post('account_ts'):0;
        $arrears_adjust             = $this->input->post('arrears_adjust') == '1'?$this->input->post('arrears_adjust'):0;
        $fine                       = $this->input->post('fine')   == '1'?$this->input->post('fine'):0;
        $submission                 = $this->input->post('submission')   == '1'?$this->input->post('submission'):0;
        $daily_delete               = $this->input->post('daily_delete')   == '1'?$this->input->post('daily_delete'):0;
        $payment_delete             = $this->input->post('payment_delete')   == '1'?$this->input->post('payment_delete'):0;
        $attendance_balance_sheet   = $this->input->post('attendance_balance_sheet')   == '1'?$this->input->post('attendance_balance_sheet'):0;
        $balancesheet_figures       = $this->input->post('balancesheet_figures')   == '1'?$this->input->post('balancesheet_figures'):0;
        $student_balance_sheet      = $this->input->post('student_balance_sheet')   == '1'?$this->input->post('student_balance_sheet'):0;
        $fine_arrears               = $this->input->post('fine_arrears')   == '1'?$this->input->post('fine_arrears'):0;
        $waive                      = $this->input->post('waive')   == '1'?$this->input->post('waive'):0;
        $summary                    = $this->input->post('summary')   == '1'?$this->input->post('summary'):0;
        $class_group                = $this->input->post('class_group')   == '1'?$this->input->post('class_group'):0;
        $award                      = $this->input->post('award')   == '1'?$this->input->post('award'):0;
        $advance_leave              = $this->input->post('advance_leave')   == '1'?$this->input->post('advance_leave'):0;
        $vr_due_fine                = $this->input->post('vr_due_fine')   == '1'?$this->input->post('vr_due_fine'):0;
        $admission_roll             = $this->input->post('admission_roll')   == '1'?$this->input->post('admission_roll'):0;
        $vr_reprint_fee             = $this->input->post('vr_reprint_fee')   == '1'?$this->input->post('vr_reprint_fee'):0;
        $other_voucher_fine         = $this->input->post('other_voucher_fine')   == '1'?$this->input->post('other_voucher_fine'):0;
        $combine_fee                = $this->input->post('combine_fee')   == '1'?$this->input->post('combine_fee'):0;
        $due_date                   = $this->input->post('due_date')   == '1'?$this->input->post('due_date'):0;
        $download                   = $this->input->post('download')   == '1'?$this->input->post('download'):0;
        $users                      = $this->input->post('users')   == '1'?$this->input->post('users'):0;
        $menu_bar                   = $this->input->post('menu_bar')   == '1'?$this->input->post('menu_bar'):0;
        $fee_columns                = $this->input->post('fee_columns')   == '1'?$this->input->post('fee_columns'):0;
        $s_fee                = $this->input->post('s_fee')   == '1'?$this->input->post('s_fee'):0;
        $s_attendance                = $this->input->post('s_attendance')   == '1'?$this->input->post('s_attendance'):0;
        $s_due_fee                = $this->input->post('s_due_fee')   == '1'?$this->input->post('s_due_fee'):0;
        $s_date_sheet                = $this->input->post('s_date_sheet')   == '1'?$this->input->post('s_date_sheet'):0;
        $s_subjects                = $this->input->post('s_subjects')   == '1'?$this->input->post('s_subjects'):0;
        $s_timetable                = $this->input->post('s_timetable')   == '1'?$this->input->post('s_timetable'):0;
        $s_youtube                = $this->input->post('s_youtube')   == '1'?$this->input->post('s_youtube'):0;
        $s_assignment                = $this->input->post('s_assignment')   == '1'?$this->input->post('s_assignment'):0;
        $s_exam                = $this->input->post('s_exam')   == '1'?$this->input->post('s_exam'):0;
        $s_homework                = $this->input->post('s_homework')   == '1'?$this->input->post('s_homework'):0;
        $s_syllabus                = $this->input->post('s_syllabus')   == '1'?$this->input->post('s_syllabus'):0;
        $s_discount                = $this->input->post('s_discount')   == '1'?$this->input->post('s_discount'):0;
        $s_graph                = $this->input->post('s_graph')   == '1'?$this->input->post('s_graph'):0;
        $s_vacation                = $this->input->post('s_vacation')   == '1'?$this->input->post('s_vacation'):0;
        
      
        if($admin_id !== null){
            $p_data = array(
                'admin_id'              => $admin_id,
                'admission_teacher'     => $admission_teacher,
                'admission_student'     => $admission_student,
                'student_access'        => $student_access,
                'teacher_access'        => $teacher_access,
                'academics'             => $academics,
                'class'                 => $class,
                'section'               => $section,
                'subject'               => $subject,
                'assign_subject'        => $assign_subject,
                'assign_class_incharge' => $assign_class_incharge,
                'class_wise_timtable'   => $class_wise_timtable,
                'daily_timetable'       => $daily_timetable,
                'teacher_wise_table'    => $teacher_wise_table,
                'classes_fee_history'   => $classes_fee_history,
                'date_sheet'            => $date_sheet,
                'date_sheet_all'        => $date_sheet_all,
                'class_u'                 => $class_u,
                'section_u'               => $section_u,
                'subject_u'               => $subject_u,
                'assign_subject_u'        => $assign_subject_u,
                'assign_class_incharge_u' => $assign_class_incharge_u,
                'class_wise_timtable_u'   => $class_wise_timtable_u,
                'daily_timetable_u'       => $daily_timetable_u,
                'holiday'                 => $holiday,
                'saturday'                => $saturday,
				'student_card'            => $student_card,
                'session'                 => $session,
				'graphs'                  => $graphs,
                'exams'                   => $exams,
                'date_sheet_u'            => $date_sheet_u,
                'mark_sheet'              => $mark_sheet,
                'mark_sheet_u'            => $mark_sheet_u,
                'voucher_generation'    => $voucher_generation,
                'expiry_date'           => $expiry_date,
                'voucher_details'       => $voucher_details,
                'delete_fee'            => $delete_fee,  
                'vr_search'             => $vr_search,              
                'message'               => $message,
				'admin_fee_message'     => $admin_fee_message,
                'school_message'        => $school_message,
                'parent_att_msg'        => $parent_att_msg,
                'fee_collection_message'=> $fee_collection_message,
                'admin_daily_message'   => $admin_daily_message,
                'expense'               => $expense,
                'expense_u'             => $expense_u,
                'bank'                  => $bank,
				'daily_filter'          => $daily_filter,
				'daily_left'            => $daily_left,
				'daily_right'           => $daily_right,
				'fee_collect_filter'    => $fee_collect_filter,
				'daily_transactions'    => $daily_transactions,
				'salary'                => $salary,
				'register_t'                => $register_t,
				'register_s'                => $register_s,
				'salary_status'             => $salary_status,
				'active_t'                  => $active_t,
				'inactive_t'                => $inactive_t,
				'transaction_t'             => $transaction_t,
				'transaction_s'             => $transaction_s,
				'heads_due'                 => $heads_due,
				'heads_history'             => $heads_history,
				'add_heads'                 => $add_heads,
				'account_ts'                => $account_ts,
				'fine'                      => $fine,
			    'submission'                => $submission,
                'payment_delete'            => $payment_delete,
                'daily_delete'              => $daily_delete,
                'arrears_adjust'            => $arrears_adjust,
                'attendance_balance_sheet'  => $attendance_balance_sheet,
                'balancesheet_figures'      => $balancesheet_figures,
                'student_balance_sheet'     => $student_balance_sheet,
                'fine_arrears'              => $fine_arrears,
                'waive'                     => $waive,
                'summary'                   => $summary,
                'class_group'               => $class_group,
                'award'                     => $award,
                'advance_leave'             => $advance_leave,
                'vr_due_fine'               => $vr_due_fine,
                'admission_roll'            => $admission_roll,
                'vr_reprint_fee'            => $vr_reprint_fee,
                'other_voucher_fine'        => $other_voucher_fine,
                'combine_fee'               => $combine_fee,
                'due_date'                  => $due_date,
                'menu_bar'                  => $menu_bar,
                'download'                  => $download,
                'users'                     => $users,
                's_fee'                     => $s_fee,
                's_attendance'              => $s_attendance,
                's_due_fee'                 => $s_due_fee,
                's_date_sheet'              => $s_date_sheet,
                's_subjects'                => $s_subjects,
                's_timetable'               => $s_timetable,
                's_youtube'                 => $s_youtube,
                's_assignment'              => $s_assignment,
                's_exam'                    => $s_exam,
                's_homework'                => $s_homework,
                's_syllabus'                => $s_syllabus,
                's_discount'                => $s_discount,
                's_graph'                   => $s_graph,
                's_vacation'                => $s_vacation,
                         
            );
            //70
             $this->admin_model->add_permission($p_data);

            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Premissions Updated successfully</div>');
        }
            
        redirect('admin/adminuser/index');
    }


}

?>