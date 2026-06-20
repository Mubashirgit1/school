<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class studentfee extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('smsgateway');
        $this->load->helper('file');
        $this->lang->load('message', 'english');
    }

    function index() {
        $this->session->set_userdata('top_menu', 'Fees Collection');
        $this->session->set_userdata('sub_menu', 'studentfee/index');
        $data['title'] = 'student fees';
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        $this->load->view('layout/header', $data);
        $this->load->view('studentfee/studentfeeSearch', $data);
        $this->load->view('layout/footer', $data);
    }

    function pdf() {
        $this->load->helper('pdf_helper');
    }

    function search() {
        $data['title'] = 'Student Search';
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        $button = $this->input->post('search');
        if ($this->input->server('REQUEST_METHOD') == "GET") {
            $this->load->view('layout/header', $data);
            $this->load->view('studentfee/studentfeeSearch', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $class = $this->input->post('class_id');
            $section = $this->input->post('section_id');
            $search = $this->input->post('search');
            $search_text = $this->input->post('search_text');
            if (isset($search)) {
                if ($search == 'search_filter') {
                    $this->form_validation->set_rules('class_id', 'Class', 'trim|required|xss_clean');
                    if ($this->form_validation->run() == FALSE) {
                        
                    } else {
                        $resultlist = $this->student_model->searchByClassSection($class, $section);
                        $data['resultlist'] = $resultlist;
                    }
                } else if ($search == 'search_full') {
                    $resultlist = $this->student_model->searchFullText($search_text);
                    $data['resultlist'] = $resultlist;
                }
                $this->load->view('layout/header', $data);
                $this->load->view('studentfee/studentfeeSearch', $data);
                $this->load->view('layout/footer', $data);
            }
        }
    }

    function feesearch() {
        $this->session->set_userdata('top_menu', 'Fees Collection');
        $this->session->set_userdata('sub_menu', 'studentfee/feesearch');
        $data['title'] = 'student fees';
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        $feesessiongroup = $this->feesessiongroup_model->getFeesByGroup();

        $data['feesessiongrouplist'] = $feesessiongroup;
        $this->form_validation->set_rules('feegroup_id', 'Fee Group', 'trim|required|xss_clean');

        $this->form_validation->set_rules('class_id', 'Class', 'trim|required|xss_clean');
        $this->form_validation->set_rules('section_id', 'Section', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('studentfee/studentSearchFee', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $data['student_due_fee'] = array();
            $feegroup_id = $this->input->post('feegroup_id');
            $feegroup = explode("-", $feegroup_id);
            $feegroup_id = $feegroup[0];
            $fee_groups_feetype_id = $feegroup[1];
            $class_id = $this->input->post('class_id');
            $section_id = $this->input->post('section_id');
            $student_due_fee = $this->studentfee_model->getDueStudentFees($feegroup_id, $fee_groups_feetype_id, $class_id, $section_id);
            if (!empty($student_due_fee)) {
                foreach ($student_due_fee as $student_due_fee_key => $student_due_fee_value) {
                    $amt_due = $student_due_fee_value['amount'];
                    $a = json_decode($student_due_fee_value['amount_detail']);
                    if (!empty($a)) {
                        $amount = 0;
                        foreach ($a as $a_key => $a_value) {
                            $amount = $amount + $a_value->amount;
                        }
                        if ($amt_due <= $amount) {
                            unset($student_due_fee[$student_due_fee_key]);
                        } else {

                            $student_due_fee[$student_due_fee_key]['amount_detail'] = $amount;
                        }
                    }
                }
            }

            $data['student_due_fee'] = $student_due_fee;
            $this->load->view('layout/header', $data);
            $this->load->view('studentfee/studentSearchFee', $data);
            $this->load->view('layout/footer', $data);
        }
    }

    function reportbyname() {
        $this->session->set_userdata('top_menu', 'Fees Collection');
        $this->session->set_userdata('sub_menu', 'studentfee/reportbyname');
        $data['title'] = 'student fees';
        $data['title'] = 'student fees';
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        if ($this->input->server('REQUEST_METHOD') == "GET") {
            $this->load->view('layout/header', $data);
            $this->load->view('studentfee/reportByName', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $this->form_validation->set_rules('section_id', 'Section', 'trim|required|xss_clean');
            $this->form_validation->set_rules('class_id', 'Class', 'trim|required|xss_clean');
            $this->form_validation->set_rules('student_id', 'Student', 'trim|required|xss_clean');
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('layout/header', $data);
                $this->load->view('studentfee/reportByName', $data);
                $this->load->view('layout/footer', $data);
            } else {
                $data['student_due_fee'] = array();
                $class_id = $this->input->post('class_id');
                $section_id = $this->input->post('section_id');
                $student_id = $this->input->post('student_id');
                $student = $this->student_model->get($student_id);
                $data['student'] = $student;
                $student_due_fee = $this->studentfeemaster_model->getStudentFees($student_id);
                $student_discount_fee = $this->feediscount_model->getStudentFeesDiscount($student_id);
                $data['student_discount_fee'] = $student_discount_fee;
                $data['student_due_fee'] = $student_due_fee;

                $data['class_id'] = $class_id;
                $data['section_id'] = $section_id;
                $data['student_id'] = $student_id;
                $category = $this->category_model->get();
                $data['categorylist'] = $category;
                $this->load->view('layout/header', $data);
                $this->load->view('studentfee/reportByName', $data);
                $this->load->view('layout/footer', $data);
            }
        }
    }

    function reportbyclass() {
        $data['title'] = 'student fees';
        $data['title'] = 'student fees';
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        if ($this->input->server('REQUEST_METHOD') == "GET") {
            $this->load->view('layout/header', $data);
            $this->load->view('studentfee/reportByClass', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $student_fees_array = array();
            $class_id = $this->input->post('class_id');
            $section_id = $this->input->post('section_id');
            $student_result = $this->student_model->searchByClassSection($class_id, $section_id);
            $data['student_due_fee'] = array();
            if (!empty($student_result)) {
                foreach ($student_result as $key => $student) {
                    $student_array = array();
                    $student_array['student_detail'] = $student;
                    $student_session_id = $student['student_session_id'];
                    $student_id = $student['id'];
                    $student_due_fee = $this->studentfee_model->getDueFeeBystudentSection($class_id, $section_id, $student_session_id);
                    $student_array['fee_detail'] = $student_due_fee;
                    $student_fees_array[$student['id']] = $student_array;
                }
            }
            $data['class_id'] = $class_id;
            $data['section_id'] = $section_id;
            $data['student_fees_array'] = $student_fees_array;
            $this->load->view('layout/header', $data);
            $this->load->view('studentfee/reportByClass', $data);
            $this->load->view('layout/footer', $data);
        }
    }

    function view($id) {
        $data['title'] = 'studentfee List';
        $studentfee = $this->studentfee_model->get($id);
        $data['studentfee'] = $studentfee;
        $this->load->view('layout/header', $data);
        $this->load->view('studentfee/studentfeeShow', $data);
        $this->load->view('layout/footer', $data);
    }

    function deleteFee() {

        $invoice_id = $this->input->post('main_invoice');
        $sub_invoice = $this->input->post('sub_invoice');
        if (!empty($invoice_id)) {
            $this->studentfee_model->remove($invoice_id, $sub_invoice);
        }
        $array = array('status' => 'success', 'result' => 'success');
        echo json_encode($array);
    }

    function addfee($id) {
        $data['title'] = 'Student Detail';
        $student = $this->student_model->get($id);
        $data['student'] = $student;
        $student_due_fee = $this->studentfeemaster_model->getStudentFees($student['student_session_id']);
        $student_discount_fee = $this->feediscount_model->getStudentFeesDiscount($student['student_session_id']);


        $data['student_discount_fee'] = $student_discount_fee;
        $data['student_due_fee'] = $student_due_fee;
        $category = $this->category_model->get();
        $data['categorylist'] = $category;
        $this->load->view('layout/header', $data);
        $this->load->view('studentfee/studentAddfee', $data);
        $this->load->view('layout/footer', $data);
    }

    function deleteTransportFee() {
        $id = $this->input->post('feeid');
        $this->studenttransportfee_model->remove($id);
        $array = array('status' => 'success', 'result' => 'success');
        echo json_encode($array);
    }

    function delete($id) {
        $data['title'] = 'studentfee List';
        $this->studentfee_model->remove($id);
        redirect('studentfee/index');
    }

    function create() {
        $data['title'] = 'Add studentfee';
        $this->form_validation->set_rules('category', 'Category', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('studentfee/studentfeeCreate', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $data = array(
                'category' => $this->input->post('category'),
            );
            $this->studentfee_model->add($data);
            $this->session->set_flashdata('msg', '<div studentfee="alert alert-success text-center">Employee added to ssuccessfully</div>');
            redirect('studentfee/index');
        }
    }

    function edit($id) {
        $data['title'] = 'Edit studentfees';
        $data['id'] = $id;
        $studentfee = $this->studentfee_model->get($id);
        $data['studentfee'] = $studentfee;
        $this->form_validation->set_rules('category', 'category', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('studentfee/studentfeeEdit', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $data = array(
                'id' => $id,
                'category' => $this->input->post('category'),
            );
            $this->studentfee_model->add($data);
            $this->session->set_flashdata('msg', '<div studentfee="alert alert-success text-center">Employee updated successfully</div>');
            redirect('studentfee/index');
        }
    }

    function addstudentfee() {

        $this->form_validation->set_rules('student_fees_master_id', 'Fee Master', 'required|trim|xss_clean');
        $this->form_validation->set_rules('fee_groups_feetype_id', 'Student', 'required|trim|xss_clean');
        $this->form_validation->set_rules('amount', 'Amount', 'required|trim|xss_clean');
        $this->form_validation->set_rules('amount_discount', 'Discount', 'required|trim|xss_clean');
        $this->form_validation->set_rules('amount_fine', 'Fine', 'required|trim|xss_clean');
        $this->form_validation->set_rules('payment_mode', 'Payment Mode', 'required|trim|xss_clean');

        if ($this->form_validation->run() == false) {
            $data = array(
                'amount' => form_error('amount'),
                'student_fees_master_id' => form_error('student_fees_master_id'),
                'fee_groups_feetype_id' => form_error('fee_groups_feetype_id'),
                'amount_discount' => form_error('amount_discount'),
                'amount_fine' => form_error('amount_fine'),
                'payment_mode' => form_error('payment_mode'),
            );
            $array = array('status' => 'fail', 'error' => $data);
            echo json_encode($array);
        } else {
            $json_array = array(
                'amount' => $this->input->post('amount'),
                'date' => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('date'))),
                'amount_discount' => $this->input->post('amount_discount'),
                'amount_fine' => $this->input->post('amount_fine'),
                'description' => $this->input->post('description'),
                'payment_mode' => $this->input->post('payment_mode')
            );
            $data = array(
                'student_fees_master_id' => $this->input->post('student_fees_master_id'),
                'fee_groups_feetype_id' => $this->input->post('fee_groups_feetype_id'),
                'amount_detail' => $json_array
            );

            $send_to = $this->input->post('guardian_phone');
            $inserted_id = $this->studentfeemaster_model->fee_deposit($data, $send_to);

            $_amount = ( intval( $json_array['amount'] ) + intval( $json_array['amount_fine'] ) ) - intval( $json_array['amount_discount'] );

            // adding record in the transactions table
            $this->transaction_model->addTransaction("Student fee received", $_amount, 0, $json_array);

            $array = array('status' => 'success', 'error' => '');
            echo json_encode($array);
        }
    }

    function addstudentfee2()
    {
        $adminsess = $this->session->userdata('admin');
        $this->load->helper('menu_helper');
        $permission = admin_permission($adminsess['id']);
        $student_id = 525;
        if ($student_id === null) {
            $this->session->set_flashdata("Something went wrong!!");
            redirect('studentfee');
        } else {
            $student = $this->student_model->get($student_id);
            if ($student === null) {
                $this->session->set_flashdata("Something went wrong!!!");
                redirect('studentfee');
            } else {
                $other_fee_types = $this->input->post('other_fee_types');
                $this->form_validation->set_rules('tuition_fee', 'Tuition fee', 'trim|required');
                $this->form_validation->set_rules('submission_date', 'Submission Date', 'trim');
                $this->form_validation->set_rules('late_fee_payment_fine', 'Late fee payment fine', 'trim');
                $this->form_validation->set_rules('late_fee_payment_fine_check', 'Late fee payment fine checkbox', 'trim');

                for ($i = 0; $i < count($other_fee_types); $i++) {
                    $_POST['other_fee_types'][$i]['name'] = (!empty($_POST['other_fee_types'][$i]['name']) ? $_POST['other_fee_types'][$i]['name'] : "0");
                    $_POST['other_fee_types'][$i]['amount'] = (!empty($_POST['other_fee_types'][$i]['amount']) ? $_POST['other_fee_types'][$i]['amount'] : "0");
                    $this->form_validation->set_rules("other_fee_types[$i][name]", $other_fee_types[$i]['name'], 'trim|required|strtolower|ucwords');
                    $this->form_validation->set_rules("other_fee_types[$i][amount]", $other_fee_types[$i]['amount'], 'trim|required|numeric|intval');
                }

                if ($this->form_validation->run() == false) {
                    $this->receive_fee($student_id);
                } else {
                    $tution_fee_check = $this->input->post('tution_fee_check');
                    $t_fee = $this->input->post('tuition_fee');
                    $arrears_fee = $this->input->post('arrears_fee');
                    $advance_fee = $this->input->post('advance');
                    $submission_date = $this->input->post('submission_date');
                    $late_fee_payment_fine = $this->input->post('late_fee_payment_fine');
                    $late_fee_payment_fine_check = $this->input->post('late_fee_payment_fine_check');
                    $voucher_id = $this->input->post('voucher_id');
                    $fee_description = $this->input->post('arrears_description');
                    $user_id = $this->input->post('user_id');
                    if ($voucher_id == null) {
                        $voucher_id = 1;
                    }
                    if ($tution_fee_check == 1) {
                        if ($advance_fee > 0) {
                            $tuition_fee = $t_fee + $advance_fee;
                        } else {

                            $tuition_fee = $t_fee + $arrears_fee;
                        }
                    } else {
                        if ($advance_fee > 0) {
                            $tuition_fee = $advance_fee;
                        } else {
                            $tuition_fee = $arrears_fee;
                        }
                    }
                    // if fine checkbox is selected
                    // remove fine from the student late payment fee and add it to other fee
                    if ($late_fee_payment_fine_check == 1) {
                        // set late fee payment to 0
                        $this->db->update('students', [
                            'late_payment_fee' => 0
                        ], ['id' => $student['id']]);
                        // setting late fee payment fine
                        $other_fee_types[] = [
                            'name' => 'Fine for late fee payment',
                            'amount' => $student['late_payment_fee']
                        ];
                    } else {
                        // if tuition fee is paid
                        if (intval($tuition_fee) > 0) {
                            $lfpf = floatval($student['late_payment_fee']) - floatval($late_fee_payment_fine);
                            $lfpf = ($lfpf < 0 ? 0 : $lfpf);
                            $this->db->update('students', [
                                'late_payment_fee' => $lfpf
                            ], ['id' => $student['id']]);
                        }
                    }
                    $add_fee = $this->student_fee_payments->add_fee($student, $tuition_fee, $other_fee_types, $submission_date, $late_fee_payment_fine, $fee_description, $voucher_id, $user_id,$late_fee_payment_fine_check);
                    $array = array('status' => 'success', 'error' => '');
                    echo json_encode($array);
                }

            }
        }
    }

    function smallify($arr, $numberOfSlices){

        $sliceLength = sizeof($arr) /$numberOfSlices;
        for($i=1; $i<=$numberOfSlices; $i++){

            $arr1 = array_chunk($arr, $sliceLength*$i);
            return $arr1;
            unset($arr1);
        }
    }

    function addstudentfee3()
    {
                $student_id = $this->input->post('student_id');
                $voucher_id = $this->input->post('voucher_id');
                $voucher = $this->student_fee_voucher_model->get_unpaid(null,$voucher_id);
               
                
                $student = $this->student_model->get_student_fee_ajax($student_id);
                $status = false;
                $data = array();
       
                if(!empty($student)){
                $this->form_validation->set_rules( 'tution_fee', 'Tution fee', 'trim|required' );
                $this->form_validation->set_rules( 'submission_date', 'Submission Date', 'trim' );
                $this->form_validation->set_rules( 'late_fee_payment_fine', 'Late fee payment fine', 'trim' );
                $other_fee_ = $this->input->post( 'other_fee_types' );
        
                if($other_fee_ != null) {
                    $other_fee_ = json_decode($other_fee_, true);
                    $odd = array();
                    $even = array();
                    foreach ($other_fee_ as $k => $v) {
                        if ($k % 2 == 0) {
                            $even[$k] = $v;
                        } else {
                            $odd[$k] = $v;
                        }
                    }
                    $odd = array_values($odd);
                    $even = array_values($even);
                    $other_fee_types = array();
                    for ($i = 0; $i < count($odd); $i++) {
                        $other_fee_types[$i] = array(
                            'name'   => $even[$i],
                            'amount' => $odd[$i],
                        );
                    }
                }

            if ( $this->form_validation->run() == false ) {
                $message = "Some thing Went Wrong";
            }
            else {

                $tution_fee_check       = $this->input->post('tution_fee_check');
                $t_fee                  = $this->input->post('tution_fee');
                $arrears_fee            = $this->input->post('arrears_fee');
                $advance_fee            = $this->input->post('advance');
                $submission_date        = $this->input->post('submission_date');
                $late_fee_payment_fine  = $this->input->post('late_fee_payment_fine');
                $late_fee_payment_fine_check = $this->input->post('late_fee_payment_fine_check');
                $voucher_id             = $this->input->post('voucher_id');
                $fee_description        = $this->input->post('arrears_description');
                $user_id                = $this->input->post('user_id');
                $waive_voucher          = $this->input->post('waive_voucher');
                $fine                   = $student['late_payment_fee'];
                $reprint_check          = $this->input->post('reprint_check');
                $reprint_fee            = $this->input->post('reprint_fee');
                if ($waive_voucher != null) {
                    $voucher_details = $this->student_fee_voucher_model->get( $waive_voucher);
                    $tution_fee_check       = 0;
                    $t_fee                  = 0;
                    $arrears_fee            = 0;
                    $advance_fee            = 0;
                    $late_fee_payment_fine  = 0;
                    $late_fee_payment_fine_check = 0;
                    $fee_description = "Other Fee Waive ".$waive_voucher;
                    $other_fee_types = $voucher_details['voucher_fee_types'];
                    $this->db->update('student_fee_voucher', ['paid' => 1], ['id' => $waive_voucher]);
                }


                if ($voucher_id == null) {
                    $voucher_id = 1;
                }

                if ( $tution_fee_check == '1' ) {
                    if($advance_fee > 0 && $arrears_fee > 0  ){
                        $tuition_fee =	$t_fee + $advance_fee + $arrears_fee;
                    }elseif($advance_fee > 0){
                        $tuition_fee = $t_fee + $advance_fee;
                    }else{
                        $tuition_fee = $t_fee + $arrears_fee;
                    }
                }else{
                    if($advance_fee > 0 && $arrears_fee > 0  ){
                        $tuition_fee = $advance_fee + $arrears_fee;
                    }elseif($advance_fee > 0){
                        $tuition_fee =  $advance_fee;
                    }else{
                        $tuition_fee = $arrears_fee;
                    }
                }

                if($reprint_check  == 1){
                    $other_fee_types[] = [
                        'name' => 'Voucher Reprint Fee',
                        'amount' => $reprint_fee
                    ];
                }
                
                // if fine checkbox is selected
                // remove fine from the student late payment fee and add it to other fee
                if ($late_fee_payment_fine_check == '1') {
                    // set late fee payment to 0
                    $this->db->update('students', [
                        'late_payment_fee' => 0
                    ], ['id' => $student['id']]);
                    // setting late fee payment fine
                 
                    $other_fee_types[] = [
                        'name' => 'Fine for late fee payment',
                        'amount' => $late_fee_payment_fine
                    ];
                } else {
                    // if tuition fee is paid

                    $dateTimestamp1 =   strtotime(date('Y-m-d'));
                    $dateTimestamp2 =strtotime($submission_date); 
                    if($dateTimestamp1 >= $dateTimestamp2){
                        $this->db->update('students', [
                            'late_payment_fee' => 0
                        ], ['id' => $student['id']]);
                        $other_fee_types[] = [
                            'name' => 'Fine for late fee payment',
                            'amount' => $late_fee_payment_fine
                        ];
                    }else{
                        if (intval($tuition_fee) > 0) {
                            $lfpf = floatval($student['late_payment_fee']) - floatval($late_fee_payment_fine);
                            $lfpf = ($lfpf < 0 ? 0 : $lfpf);
                            $this->db->update('students', [
                                'late_payment_fee' => $lfpf
                            ], ['id' => $student['id']]);
                        }
                    }
                }
          
               // $tuition_fee = $t_fee + $arrears_fee;
                $add_fee = $this->student_fee_payments->add_fee($student, $tuition_fee, $other_fee_types, $submission_date, $late_fee_payment_fine, $fee_description, $voucher_id, $user_id,$late_fee_payment_fine_check,$waive_voucher,$fine,$reprint_fee,$reprint_check );
                if ($add_fee !== false) {
                    $this->session->set_flashdata('msg', "Fee record has been added successfully!");
                    // refereshing student id
                    $student = $this->student_model->get($student['id']);
                    // if voucher ID is available
                    if ($voucher_id !== null) {
                        // change paid status to 1
                        $this->db->update('student_fee_voucher',
                         ['paid' => 1], ['id' => $voucher_id]);

                    }

                    if (!empty($student['father_phone']) &&  $voucher_id  != 1) {
                        $this->send_collection_message($add_fee);
                    }

                }
                if($waive_voucher != null ){
                    $message = "Voucher has been waived successfully";
                }else{
                    $message = "Payment for Vr No. ".$voucher_id." collected";
                }
            }
            $student_fee = $student['fee'] -   $student['discount'];
            if($student['fee_arrears'] < 0){
                $advance = abs($student['fee_arrears']);
                $arrears = 0;
                $due = 0;
            }else{
                $arrears =    $student['fee_arrears'] - $student_fee;
                if($arrears > 0){
                    $arrears = $student['fee_arrears'] - $student_fee;
                    $due = $student_fee;
                    $advance = 0;
                }else{
                    if($arrears == $student_fee){
                        $due = $student_fee;
                        $arrears = 0;
                        $advance = 0;
                    }else{
                        $arrears = 0;
                        $advance = 0;
                        $due = $student['fee_arrears'];
                    }
                }
            }

            $data = array(
                'advance' =>  ( $advance !== false ? floatval($advance ) : 0) ,
                'due' => ( $due !== false ? floatval($due ) : 0),
                'arrears' => ( $arrears !== false ? floatval($arrears ) : 0),
                'fine' => $student['late_payment_fee']
            );
            $status= true;
        }else{
            
            $message = "Student Not Found";
        }
    
        $array = array('status' => $status, 'error' => '','message' => $message,'data' => $data);
        echo json_encode($array);
    }

    public function send_collection_message($payment_id){

        $adminsess = $this->session->userdata( 'admin' );
        $this->load->helper('menu_helper');
        $permission = admin_permission($adminsess['id']);

        $_fee_details = $this->student_fee_payments->get( $payment_id );
        $student = $this->student_model->get($_fee_details['student_id']);

        $arrears                = 0;
        $advance                = 0;
        $tuition_fee_left       = 0;
        $current_month_arrears  = 0;





////////////////////////////////////////////////


  $discount_fee =  intval($student['fee'])- intval($student['discount']);

        if ($_fee_details['due_fee'] > 0 ) {   //50>0
            $current_month_arrears = intval($_fee_details['due_fee']) -intval($discount_fee) - intval($_fee_details['fine']);    // cur 50
        if ($_fee_details['tuition_fee'] <= $current_month_arrears) {  // 100<=50
              $arrears = intval($_fee_details['tuition_fee']);
              $tuition_fee = 0;
              $advance = 0;
        }elseif (intval($_fee_details['tuition_fee']) > intval($current_month_arrears)){
         $arrears = $current_month_arrears;
        $tuition_fee_left   = $_fee_details['tuition_fee'] - $arrears;      
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
              elseif($_fee_details['due_fee'] <= 0){
            $tuition_fee = 0;
            $arrears     = 0;
            $advance     = $_fee_details['tuition_fee'];
                      }
            if ($arrears < 0) {
                $arrears = 0;
            }

    

//////////////////////////////////////////////////////





      
        // if ($_fee_details['due_fee'] > 0 ) {
        //     $current_month_arrears = intval($_fee_details['due_fee']) -intval($discount_fee) - intval($_fee_details['late_payment_fee']);
        //     if ($_fee_details['tuition_fee'] <= $current_month_arrears) {
        //         $arrears = intval($_fee_details['tuition_fee']);
        //         $tuition_fee = 0;
        //         $advance = 0;
        //     }elseif ($_fee_details['tuition_fee'] > $current_month_arrears){
        //         $arrears            = $current_month_arrears;
        //         $tuition_fee_left   = $_fee_details['tuition_fee'] - $arrears;
        //         if ($tuition_fee_left <= $discount_fee) {
        //             $tuition_fee        = $tuition_fee_left;
        //             $advance = 0;
        //         }else{
        //             $tuition_fee        = $discount_fee;
        //             $tuition_fee_left   = $tuition_fee_left - $discount_fee;
        //             $advance            = $tuition_fee_left;
        //         }
        //     }
        // }elseif($_fee_details['due_fee'] <= 0){
        //     $tuition_fee = 0;
        //     $arrears     = 0;
        //     $advance     = $_fee_details['tuition_fee'];
        // }
        // if ($arrears < 0) {
        //     $arrears = 0;
        // }


        if ( !empty( $_fee_details['other_fee_payments'] ) ) {
            foreach ( $_fee_details['other_fee_payments'] as $_other_fee_payment ) {
                if (  $_other_fee_payment['fee_name']   == "Fine for late fee payment" ) {
                    $fine = $_other_fee_payment['amount'];
                }
            }
        }
        //$classsss_fee = $_fee_details['tuition_fee'] - $arrears ;
        // exit;
        // if($classsss_fee > 0){
        //     $tuition_fee_sms = $_fee_details['tuition_fee'] - $arrears + $fine - $advance ;
        // }elseif($classsss_fee == 0){
        //     $tuition_fee_sms = $_fee_details['tuition_fee'] - $arrears -$advance;
        // }



        $_fee_types = [];
        $_fee_types[] = date('M')." Fee:  ".$tuition_fee;
        if ( !empty( $_fee_details['other_fee_payments'] ) ) {
            foreach ( $_fee_details['other_fee_payments'] as $_other_fee_payment ) {
                if ( intval( $_other_fee_payment['amount'] ) > 0 ) {
                    $_fee_types[] = "{$_other_fee_payment['fee_name']}: {$_other_fee_payment['amount']}";
                }
            }
        }
        if($permission->school_message == 0 ){
            $school_name = '';
        }else{
            $school_name = $this->setting_model->getCurrentSchoolName();
        }
            

        if(intval($advance) <= intval($discount_fee)){
        $month  =  date('M', strtotime('+1 month')); 
        }elseif(intval($advance) <= intval((2*$discount_fee)) ){
            $month =     date('M', strtotime('+1 month')). "/".date('M', strtotime('+2 month'));
        }elseif(intval($advance) <= intval((3*$discount_fee))){
        $month =     date('M', strtotime('+1 month'))."/".date('M', strtotime('+2 month'))."/".date('M', strtotime('+3 month'));
        }elseif(intval($advance) <= intval((4*$discount_fee))){
            $month =     date('M', strtotime('+1 month'))."/".date('M', strtotime('+2 month'))."/".date('M', strtotime('+3 month'))."/".date('M', strtotime('+4 month'));
        }else{
            $month =     date('M', strtotime('+1 month'))."/".date('M', strtotime('+2 month'))."/".date('M', strtotime('+3 month'))."/".date('M', strtotime('+4 month'))."/".date('M', strtotime('+5 month'));
        }
 
       $advance    =    number_format( $advance);
       $arrears    =	number_format($arrears);

        if($permission->fee_collection_message == 1 ) {
            $this->sms_library->send_sms($student['father_phone'], $this->sms_messages->student_fee_receive_message($student['firstname'], $student['class'], $student['section'], $student['roll_no'], $student['admission_no'], $arrears, $advance, $_fee_details['total_paid_fee'], $_fee_types, $student['fee_arrears'], $_fee_details['payment_date'], $school_name, $month));
        }

        if($permission->admin_fee_message == 1 ){
            $admin_phone = $this->custom_option_model->get('admin_phone');
            $this->sms_library->send_sms( $admin_phone['value'], $this->sms_messages->student_fee_receive_message( $student['firstname'], $student['class'], $student['section'], $student['roll_no'], $student['admission_no'], $arrears,$advance, $_fee_details['total_paid_fee'],$_fee_types,$student['fee_arrears'], $_fee_details['payment_date'], $school_name,$month ) );
        }
    }

    function printFeesByName() {
        $data = array('payment' => "0");
        $record = $this->input->post('data');
        $invoice_id = $this->input->post('main_invoice');
        $sub_invoice_id = $this->input->post('sub_invoice');
        $student_session_id = $this->input->post('student_session_id');
        $setting_result = $this->setting_model->get();
        $data['settinglist'] = $setting_result;
        $student = $this->studentsession_model->searchStudentsBySession($student_session_id);
        $fee_record = $this->studentfeemaster_model->getFeeByInvoice($invoice_id, $sub_invoice_id);
        $data['student'] = $student;
        $data['sub_invoice_id'] = $sub_invoice_id;
        $data['feeList'] = $fee_record;
        $this->load->view('print/printFeesByName', $data);
    }

    function printFeesByGroup() {
        $fee_groups_feetype_id = $this->input->post('fee_groups_feetype_id');
        $fee_master_id = $this->input->post('fee_master_id');
        $fee_session_group_id = $this->input->post('fee_session_group_id');
        $setting_result = $this->setting_model->get();
        $data['settinglist'] = $setting_result;
        $data['feeList'] = $this->studentfeemaster_model->getDueFeeByFeeSessionGroupFeetype($fee_session_group_id, $fee_master_id, $fee_groups_feetype_id);

        $this->load->view('print/printFeesByGroup', $data);
    }



    function searchpayment() {
        $this->session->set_userdata('top_menu', 'Fees Collection');
        $this->session->set_userdata('sub_menu', 'studentfee/searchpayment');
        $data['title'] = 'Edit studentfees';


        $this->form_validation->set_rules('paymentid', 'Payment ID', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            
        } else {
            $paymentid = $this->input->post('paymentid');
            $invoice = explode("/", $paymentid);

            if (array_key_exists(0, $invoice) && array_key_exists(1, $invoice)) {
                $invoice_id = $invoice[0];
                $sub_invoice_id = $invoice[1];
                $feeList = $this->studentfeemaster_model->getFeeByInvoice($invoice_id, $sub_invoice_id);
                $data['feeList'] = $feeList;
                 $data['sub_invoice_id'] = $sub_invoice_id;
            } else {
                $data['feeList'] = array();
            }
          
        
        }
        $this->load->view('layout/header', $data);
        $this->load->view('studentfee/searchpayment', $data);
        $this->load->view('layout/footer', $data);
    }

    function addfeegroup() {
        $this->form_validation->set_rules('fee_session_groups', 'Fee Group', 'required|trim|xss_clean');
        $this->form_validation->set_rules('student_session_id[]', 'Student', 'required|trim|xss_clean');

        if ($this->form_validation->run() == false) {
            $data = array(
                'fee_session_groups' => form_error('fee_session_groups'),
                'student_session_id[]' => form_error('student_session_id[]'),
            );
            $array = array('status' => 'fail', 'error' => $data);
            echo json_encode($array);
        } else {

            $fee_session_groups = $this->input->post('fee_session_groups');
            $student_sesssion_array = $this->input->post('student_session_id');
            // $record_insert=array();
            $preserve_record = array();
            foreach ($student_sesssion_array as $key => $value) {

                $insert_array = array(
                    'student_session_id' => $value,
                    'fee_session_group_id' => $fee_session_groups,
                );
                $inserted_id = $this->studentfeemaster_model->add($insert_array);

                $preserve_record[] = $inserted_id;
            }
            if (!empty($preserve_record)) {
                $this->studentfeemaster_model->delete($fee_session_groups, $preserve_record);
            }

            $array = array('status' => 'success', 'error' => '', 'message' => 'Record Saved Successfully');
            echo json_encode($array);
        }
    }

    function geBalanceFee() {
        $this->form_validation->set_rules('fee_groups_feetype_id', 'fee_groups_feetype_id', 'required|trim|xss_clean');
        $this->form_validation->set_rules('student_fees_master_id', 'student_fees_master_id', 'required|trim|xss_clean');

        if ($this->form_validation->run() == false) {
            $data = array(
                'fee_groups_feetype_id' => form_error('fee_groups_feetype_id'),
                'student_fees_master_id' => form_error('student_fees_master_id'),
            );
            $array = array('status' => 'fail', 'error' => $data);
            echo json_encode($array);
        } else {
            $data = array();
            $data['fee_groups_feetype_id'] = $this->input->post('fee_groups_feetype_id');
            $data['student_fees_master_id'] = $this->input->post('student_fees_master_id');

            $result = $this->studentfeemaster_model->studentDeposit($data);
            $amount_balance = 0;
            $amount = 0;
            $amount_fine = 0;
            $amount_discount = 0;
            $amount_detail = json_decode($result->amount_detail);

            if (is_object($amount_detail)) {

                foreach ($amount_detail as $amount_detail_key => $amount_detail_value) {
                    $amount = $amount + $amount_detail_value->amount;
                    $amount_discount = $amount_discount + $amount_detail_value->amount_discount;
                    $amount_fine = $amount_fine + $amount_detail_value->amount_fine;
                }
            }

            $amount_balance = $result->amount - ($amount + $amount_discount);
            $array = array('status' => 'success', 'error' => '', 'balance' => $amount_balance);
            echo json_encode($array);
        }
    }

}

?>