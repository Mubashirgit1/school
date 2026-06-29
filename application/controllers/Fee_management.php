<?php

class Fee_management extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper( 'file' );
        $this->lang->load( 'message', 'english' );
    }

    public function index()
    {
        redirect( 'fee_management/collect_fee' );
    }

    public function collect_fee()
    {
        $this->session->set_userdata( 'top_menu', 'FeeManagement' );
        $this->session->set_userdata( 'sub_menu', 'fee_management/collect_fee' );
        $data = [
            'title' => 'Collect fee'
        ];
        $this->load->view( 'layout/header', $data );
        $this->load->view( 'fee_management/collect_fee', $data );
        $this->load->view( 'layout/footer', $data );
    }

    public function receipt_info()
    {
        $form_data = $this->input->post();
        $rid = $form_data['recno'];
        $receipt_details = $this->student_model->getReceiptInfo( $rid );
        if ( empty( $receipt_details ) ) {
            $this->session->set_flashdata( 'recMsg', 'No Record Found' );
            redirect( 'fee_management/fee_voucher' );
            exit;
        }
        $student_info = $this->student_model->getStudents( $receipt_details[0]->student_id );
        redirect( 'fee_management/receive_fee/' . $student_info['id'] . '?recno=' . $receipt_details[0]->voucher_id );
    }

    public function admission_voucher_t(){
   
       $admission_no  = trim($this->input->post('admission_no'));

        $student_id   =  $this->student_model->getId($admission_no);
       
        if($student_id){

            $voucher_details = $this->student_fee_voucher_model->get_unpaid($student_id->id);

            if($voucher_details){
    
                redirect('fee_management/receive_fee/'.$voucher_details[0]['student_id'].'?admission_no_t='.$admission_no);
    
            }else{
    
                redirect('balance_sheet');
            
            }
        }else{
            
            redirect('balance_sheet');

        }
    }
    public function fee_voucher_collection(){

        $vrno  = $this->input->get('vrno');
            $voucher_details = $this->student_fee_voucher_model->get_unpaid_other(null,$vrno);

            if($voucher_details){

            redirect('fee_management/receive_fee/'.$voucher_details['student_id'].'?voucher_id='.$voucher_details['id']);

        }else{

            redirect('balance_sheet');
        
        }
    
     }
     public function fee_voucher_collection_t(){

            $vrno  = $this->input->get('vrno');
            
            $voucher_details = $this->student_fee_voucher_model->get_unpaid(null,$vrno);
            if($voucher_details){

            redirect('fee_management/receive_fee/'.$voucher_details['student_id'].'?voucher_id='.$voucher_details['id']);

        }else{

            redirect('balance_sheet');
        
        }
    
     }


     public function waive_last_month(){

                
                
                $students = $this->student_model->get();
   
        //pp($students);

        foreach($students as $student){
            $student_fee = $student['fee'] -   $student['discount'];
              
            if($student['fee_arrears'] > $student_fee && $student_fee > 0  ){
         
                $tution_fee_check       = 1;
                $t_fee                  = $student_fee;
                $arrears_fee            = 0;
                $advance_fee            = 0;
                $submission_date        = date('Y-m-d H:i:s' );
                $late_fee_payment_fine  = 0;
                $late_fee_payment_fine_check = 0;
                $voucher_id             = 1;
                $fee_description        = 'Waive April Fee';
                $user_id                = 'Admin';
                $waive_voucher          = null;
                $fine                   = 0;
                $reprint_check          = 0;
                $reprint_fee            = 0;

               
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
                   

                }
                if($waive_voucher != null ){
                    $message = "Voucher has been waived successfully";
                }else{
                    $message = "Payment for Vr No. ".$voucher_id." collected";
                }
          
          
            }else{
                print_r("Student Not Found");
            }
        ppp($student);
         }
       

     } 

    public function admission_voucher_other(){
   
        $admission_no  = trim($this->input->post('admission_no'));
 
         $student_id   =  $this->student_model->getId($admission_no);
        if($student_id){

            $voucher_details = $this->student_fee_voucher_model->get_unpaid_other($student_id->id);

            if($voucher_details){
    
                redirect('fee_management/receive_fee/'.$voucher_details[0]['student_id'].'?admission_no='.$admission_no);
    
            }else{
                redirect('balance_sheet');
            }
        }else{
            redirect('balance_sheet');
        }
     }
    public function other_due_fee_report()
    {
        $this->session->set_userdata( 'top_menu', 'Reports' );
        $this->session->set_userdata( 'sub_menu', 'fee_management/other_fee_report' );
        $data = array(
            'title' => 'Other Fee Types Report'
        );
        $this->form_validation->set_data( $_GET );
        $this->form_validation->set_rules( 'class_id', 'Class', 'trim|urldecode' );
        $this->form_validation->set_rules( 'section_id', 'Section', 'trim|urldecode' );
        $this->form_validation->set_rules( 'other_fee_types', 'Other Fee Types', 'trim|urldecode' );
        $this->form_validation->set_rules( 'date_from', 'Date From', 'trim|urldecode' );
        $this->form_validation->set_rules( 'date_to', 'Date To', 'trim|urldecode' );
        $this->form_validation->set_rules( 'search_type', 'Search Type', 'trim' );
        $this->form_validation->run();
        $class_id           = $this->input->get( 'class_id' );
        $section_id         = $this->input->get( 'section_id' );
        $other_fee_types    = $this->input->get( 'other_fee_types' );
        $other_fee_types    = ( !empty( $other_fee_types ) ? $other_fee_types : null );
        $data['other_fee_types'] = $other_fee_types;
        $date_from = $this->input->get( 'date_from' );
        if ( !empty( $date_from ) ) {
            $date_from = date( 'Y-m-d', strtotime( $date_from ) );
        } else {
            $date_from = null;
        }
        $date_to = $this->input->get( 'date_to' );
        if ( !empty( $date_to ) ) {
            $date_to = date( 'Y-m-d', strtotime( $date_to ) );
        } else {
            $date_to = null;
        }
        $search_type            = $this->input->get( 'search_type' );
        $data['search_type']    = $search_type;
        $class                  = $this->class_model->get();
        $data['classlist']      = $class;
        $fee_types              = $this->student_fee_type_model->get();
        $data['fee_types']      = $fee_types;
        $students_where = array();
        if ( !empty( $class_id ) ) {
            $students_where['student_session.class_id'] = $class_id;
        }
        if ( !empty( $section_id ) ) {
            $students_where['student_session.section_id'] = $section_id;
        }
        $students_processed = array();
        $students = $this->student_model->get( null, $students_where, false,'others' );
        for ( $i = 0; $i < count( $students ); $i++ ) {
            $students[$i]['other_fee_records'] = $this->student_fee_payments_other->student_other_fee_records( $students[$i]['id'], $other_fee_types, $date_from, $date_to, $search_type );
            if ( $search_type === null ) {
                $students_processed[] = $students[$i];
            } else {
                if ( $search_type == 'paid' && !empty( $students[$i]['other_fee_records'] ) ) {
                    $students_processed[] = $students[$i];
                }
                if ( $search_type == 'pending' && empty( $students[$i]['other_fee_records'] ) ) {
                    $students_processed[] = $students[$i];
                }
            }
        }
        $data['search_type'] = $search_type;
        $data['students'] = $students;
        $data['students_processed'] = $students_processed;
        $unpaid_students_other = $this->student_fee_voucher_model->get_unpaid_other2( );
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
        $this->load->view( 'fee_management/other_due_fee_report', $data );
        $this->load->view( 'layout/footer', $data );
    }


    public function unpaid_voucher_setting( $student_id = null )
    {

        $unpaid_students = $this->student_fee_voucher_model->get_unpaid2( $student_id ,$id, $class_id, $section_id  );
        $fee_arrears = 0; 
        $discount = 0;
        $arrears = 0;
        foreach($unpaid_students as $stu){
            $discount  = $stu['fee'] - $stu['discount'];   
            if( $stu['fee_arrears'] >= $discount){
                $this->db->update( 'student_fee_voucher', [
                    'monthly_fee' => $discount,
                ], [
                    'id' => $stu['id']
                ] );
            }
        }
    }
    public function unpaid_voucher_reports( $student_id = null )
    {
        for ( $i = 0; $i < count( $fee_payment_types ); $i++ ) {
            $this->form_validation->set_rules( "fee_payment_type[{$i}]", 'Fee payment type', 'trim' );
        }
        $this->form_validation->run();
        if ( $search_type === null ) {
            $search_type = 'paid';
        }
        if ( $search_type == 'paid' ) {
            $student_payments       = $this->student_fee_payments->search( $class_id, $section_id, $date_from, $date_to, $fee_payment_types, $search_type );

        }
        if ( $search_type == 'pending' ) {
            $student_payments       = $this->student_fee_payments->search( $class_id, $section_id, $date_from, $date_to, $fee_payment_types, $search_type );
        }
        ////////////////////////////////////////////////////////////////////
        $this->session->set_userdata( 'top_menu', 'Reports' );
        $this->session->set_userdata( 'sub_menu', 'fee_management/fee_reports' );
        $fee_payment_types  = $this->input->get( 'fee_payment_type' );
        $transaction_type   = $this->input->get( 'transaction_type' );
        if ($transaction_type == null || empty($transaction_type)) {
            $transaction_type   = "all";
        }
        $this->form_validation->set_data( $_GET );
        $this->form_validation->set_rules( 'class_id', 'Class id', 'trim' );
        $this->form_validation->set_rules( 'section_id', 'Section id', 'trim' );
        $this->form_validation->set_rules( 'search_type', 'Search Type', 'trim' );
        $this->form_validation->set_rules( 'date_from', 'Date from', 'trim|urldecode' );
        $this->form_validation->set_rules( 'date_to', 'Date to', 'trim|urldecode' );
        for ( $i = 0; $i < count( $fee_payment_types ); $i++ ) {
            $this->form_validation->set_rules( "fee_payment_type[{$i}]", 'Fee payment type', 'trim' );
        }
        $class_id           = $this->input->get( 'class_id' );
        $section_id         = $this->input->get( 'section_id' );
        $other_fee_types    = $this->input->get( 'other_fee_types' );
        $other_fee_types    = ( !empty( $other_fee_types ) ? $other_fee_types : null );
        $data['other_fee_types'] = $other_fee_types;
        $date_from = $this->input->get( 'date_from' );
        if ( !empty( $date_from ) ) {
            $date_from = date( 'Y-m-d', strtotime( $date_from ) );
        } else {
            $date_from = null;
        }
        $date_to = $this->input->get( 'date_to' );
        if ( !empty( $date_to ) ) {
            $date_to = date( 'Y-m-d', strtotime( $date_to ) );
        } else {
            $date_to = null;
        }
        $search_type            = $this->input->get( 'search_type' );
        $data['search_type']    = $search_type;
        $class                  = $this->class_model->get();
        $data['classlist']      = $class;
        $fee_types              = $this->student_fee_type_model->get();
        $data['fee_types']      = $fee_types;
        $students_where = array();
        if ( !empty( $class_id ) ) {
            $students_where['student_session.class_id'] = $class_id;
        }
        if ( !empty( $section_id ) ) {
            $students_where['student_session.section_id'] = $section_id;
        }
        $students_processed = array();
        $students = $this->student_model->get( null, $students_where, false,'others' );
        for ( $i = 0; $i < count( $students ); $i++ ) {
            $students[$i]['other_fee_records'] = $this->student_fee_payments_other->student_other_fee_records( $students[$i]['id'], $other_fee_types, $date_from, $date_to, $search_type );
            if ( $search_type === null ) {
                $students_processed[] = $students[$i];
            } else {
                if ( $search_type == 'paid' && !empty( $students[$i]['other_fee_records'] ) ) {
                    $students_processed[] = $students[$i];
                }
                if ( $search_type == 'pending' && empty( $students[$i]['other_fee_records'] ) ) {
                    $students_processed[] = $students[$i];
                }
            }
        }
       
        $data['students'] = $students;
        $data['students_processed'] = $students_processed;
        $unpaid_students = $this->student_fee_voucher_model->get_unpaid();
        $std_id = NULL;
        $student_unpaid = array();
        foreach ($unpaid_students as $key => $s_payments) {
            $student_unpaid[$key]["student_id"]       =  $s_payments['student_id'];
            $student_unpaid[$key]["voucher_id"]     =  $s_payments['id'];
            $student_unpaid[$key]["total_fee"]     =  $s_payments['total_fee'];
            $student_unpaid[$key]["created_voucher"]     =  $s_payments['created_at'];
            $student_unpaid[$key]["due_voucher"]     =  $s_payments['due_date'];
            $student_unpaid[$key]["voucher_fee_types"]     =  $s_payments['voucher_fee_types'];
            $student_unpaid[$key]["voucher_arrears"]     =  $s_payments['arrears'];
            $std_num =  $key;
            $std_id  = $s_payments['student_id'];
        }
        $student_unpaid = array_values($student_unpaid);
        for ( $i = 0; $i < count( $student_unpaid ); $i++ ) {
            $student_unpaid[$i]['student'] = $this->student_model->get( $student_unpaid[$i]['student_id'] );
        }
        $data['unpaid_students']  = $student_unpaid;
        $this->load->view( 'layout/header', $data );
        $this->load->view( 'fee_management/unpaid_voucher', $data );
        $this->load->view( 'layout/footer', $data );
    }

    public function receive_fee( $student_id = null )
    {
        $std_reg_no  = $this->input->get( 'student_registration_no' );
        $voucher_id  = $this->input->get( 'voucher_id' );
        $search_text = $this->input->post_get( 'search_text' );
        $data = array();
        $month      = $this->input->get( 'month' );
        $year       = $this->input->get( 'year' );
        if ($student_id === null && $std_reg_no === null && $search_text !== null) {
            $std_reg_no = $search_text;
        }
        // if student id is not provided, but student registration number is given.
        if ( $student_id === null && !empty( $std_reg_no ) ) {
            // get student id from the student registration number
            $std_id = $this->student_model->get( null, [
                'admission_no' => $std_reg_no
            ] ,false,'cnic');
            if ( $std_id !== false ) {
                $student_id = $std_id[0]['id'];
            }
        }
        $redirect = $this->input->get( 'redirect' );
        $redirect = ( $redirect !== null ? urldecode( $redirect ) : site_url( 'balance_sheet' ) );
        $data['redirect'] = $redirect;
        if ( $student_id === null ) {
            redirect( $redirect );
            $this->session->set_flashdata( 'err', "Something went wrong!" );
            $this->session->set_flashdata( 'err', "Student wasn't found!" );
        } else {
            $student          = $this->student_model->get( $student_id );  
            
            $sibling_type = $this->custom_option_model->get( 'sibling_type' );
 
            if($sibling_type['value'] == "phone_sibling" && $student['father_phone'] != null){
         
                $children = $this->student_model->family_children( $student['father_phone'] , null  ); 

            }elseif( $sibling_type['value'] == "cnic_sibling" && $student['father_cnic'] != null){

                $children  = $this->student_model->family_children(null,$student['father_cnic']);

            }
            

            $data['children'] =    $children;
            

            if ( $student === null ) {
                $this->session->set_flashdata( 'err', "Student wasn't found!" );
                redirect( $redirect );
            } else {
                $data['title'] = 'Pay Fee';
                $data['student'] = $student;
                $student_fee = $this->student_model->getStudentFee( $student['id'] );
                $student_fee = ( $student_fee === false ? 0 : $student_fee['fee'] );
                $data['student_fee'] = $student_fee;
                $category = $this->category_model->get();
                $data['categorylist'] = $category;
                // getting voucher details if voucher id is available
                if ( $voucher_id !== null ) {
                    $voucher_details = $this->student_fee_voucher_model->get( $voucher_id );
                } else {
                    $voucher_details = null;
                }
                $data['voucher_details'] = $voucher_details;
                $student_fee_types = $this->student_fee_type_model->get();
                // if fee types are available
                if ( $student_fee_types !== false ) {
                    // looping through student fee types
                    for ( $i = 0; $i < count( $student_fee_types ); $i++ ) {
                        // setting default value if no values is inserted
                        $student_fee_types[$i]['voucher_amount'] = 0;
                        // if voucher details are available
                        if ( $voucher_details !== null ) {
                            // looping through voucher fee types
                            foreach ( $voucher_details['voucher_fee_types'] as $voucher_fee_type ) {
                                // if student fee type and voucher fee type is same
                                if ( strtolower( $student_fee_types[$i]['name'] ) == strtolower( $voucher_fee_type['name'] ) ) {
                                    $student_fee_types[$i]['voucher_amount'] = $voucher_fee_type['amount'];
                                    break;
                                }
                            }
                        }
                    }
                }

                $year = ( $year !== null ? $year : date( 'Y', now() ) );
                // $advance_payments             = $this->student_model->get_advance_monthly($data2);
                //$data['advance_payments']     = $advance_payments;
                for ( $j = 1; $j < 13; $j++ ){
                    $annual = str_pad($j,2,0,STR_PAD_LEFT);
                }
                $advance_payments2             = $this->student_model->get_advance(null,null,$student_id, null);
                $data['advance_payments2']     = $advance_payments2;
                $student_fee_payments         = $this->student_fee_payments->get( null, $student_id, 10 );
                $data['student_fee_payments'] = $student_fee_payments;
                if(date('m', now()) > '2'){
                    $start = 1;
                    $end = 13;
                }else{
                    $start = 3;
                    $end = 15;
                }
                for ( $j = $start; $j < $end; $j++ ){
                    $year =  date( 'Y', now());
                    if( $j >= 13 ){
                        $annual = $j - 12;
                    }elseif( $j<=12){
                        if(date('m', now()) > '2'){
                            $year =  date( 'Y', now());
                        }else{
                            $year =  date("Y",strtotime("-1 year"));
                        }
                        $annual = str_pad($j,2,0,STR_PAD_LEFT);
                    }
                    $data2 = [
                        'year' => "{$year}",
                        'month' => "{$annual}", ];
                    $advance_payments[$j]             = $this->student_model->get_advance_annual(null,null,$student_id, $data2);
                    $student_fee_payments2[$annual]         = $this->student_fee_payments->get_total_received_fee_per_month2( "{$year}-{$annual}-01",$student_id  );
                    $other_fee_payments2[$annual] = $this->student_fee_payments_other->sum_by_month2("{$year}-{$annual}-01",$student_id );
                }


                $data['student_fee_types'] = $student_fee_types;
                $voucher_tuition_fee = null;
                if ( $voucher_details !== null ) {
                    foreach ( $voucher_details['voucher_fee_types'] as $voucher_fee_type ) {
                        if ( strtolower( $voucher_fee_type['name'] ) == 'tuition fee' || strtolower( $voucher_fee_type['name'] ) == 'due fee' ) {
                            $voucher_tuition_fee = $voucher_fee_type['amount'];
                            break;
                        }
                    }
                }
         

                $data['advance_payments']  = $advance_payments;
                $data['student_fee_payments_annual'] = $student_fee_payments2;
                $data['other_fee_payments'] = $other_fee_payments2;
                $data['voucher_tuition_fee']  = $voucher_tuition_fee;
                $last_date_for_receiving_fee = $this->custom_option_model->get( 'last_date_for_receiving_fee' );
                $data['last_date_for_receiving_fee'] = $last_date_for_receiving_fee['value'];
                $fine_per_day_for_fee = $this->custom_option_model->get( 'fine_per_day_for_fee' );
                $student_fee_fine_type = $this->custom_option_model->get( 'student_fee_fine_type' );
                $data['student_fee_fine_type'] = $student_fee_fine_type['value'];
                $data['fine_per_day_for_fee'] = $fine_per_day_for_fee['value'];
                $reprint_fee = $this->custom_option_model->get( 'reprint_fee' );
                $data['reprint_fee']  = $reprint_fee['value'];
                $advance_payments2             = $this->student_model->get_advance(null,null,$student_id, null);
                $data['voucher_id'] = $voucher_id;
                $unpaid_students = $this->student_fee_voucher_model->get_unpaid($student_id);
                $data['unpaid_students']  = $unpaid_students;
                $unpaid_students_other = $this->student_fee_voucher_model->get_unpaid_other($student_id );
                $data['unpaid_students_other']  = $unpaid_students_other;
                $discount_history =  $this->student_model->get_discount2( $student_id);
                $data['discount_history'] =  $discount_history;
                $discount_history_all =  $this->student_model->get_discount( $student_id);
                $data['discount_history_all'] =  $discount_history_all;
             
                $this->load->view( 'layout/header', $data );
                $this->load->view( 'fee_management/receive_fee', $data );
                $this->load->view( 'layout/footer', $data );
            }
        }
    }

    public function ajax(){
        $this->load->view( 'layout/header', $data );
        $this->load->view( 'fee_management/ajax');
        $this->load->view( 'layout/footer', $data );
    }

    public function unpaid_student_tuition_ajax(){

        $draw = intval($this->input->get("draw"));
        $student_id = intval($this->input->get("student_id"));
        $bank_copy = 1;

        $length = intval($this->input->get("length"));
        $query = $this->student_fee_voucher_model->get_unpaid_ajax($student_id, 0 );
        $data = [];
        $this->load->helper('menu_helper');
        $admind = $this->session->userdata( 'admin' );
        $permission = admin_permission($admind['id']);
        foreach($query as $r) {
            
            $fee = $r->total_fee + $r->arrears;
            $fine = $r->total_fee - $r->monthly_fee - $r->arrears;
            $arrears =  $r->arrears - $r->monthly_fee;
            $voucher =  '<a class="btn btn-default btn-xs  "  href="' . base_url('fee_management/fee_voucher_process2?vrno=') .$r->id.'&student_ids='.$r->student_id.'&bank_copy='.$bank_copy. '&reprint=' .'1'.  '"> <i class="fa fa-newspaper-o" aria-hidden="true"> </i></a>';
            if ($permission->delete_fee == 1) {
            $delete = '<a href="" class="btn btn-default btn-xs delete_voucher" data-voucher="'.$r->id.'" data-type="'.$r->other.'"  title="Delete" > <i class="fa fa-trash-alt"></i></a>';
            }

            $action = $voucher." ".$delete;
            $due_date =  date( 'd-M-y',strtotime($r->due_date));
            $issue_date  = date('d-M-y',strtotime($r->created_at));
            $data[] = array(
                $r->id,
                $r->monthly_fee,
                $r->arrears,
                $fee,
                $issue_date,
                $due_date,
                $action,

            );
        }
        $result = array(
            "draw" => $draw,
            "recordsTotal" => '',
            "recordsFiltered" => '',
            "data" => $data
        );
        echo json_encode($result);
        exit();
    }

    public function unpaid_student_tuition_ajax_ad(){

        $draw = intval($this->input->get("draw"));
        $student_id = intval($this->input->get("student_id"));
        $bank_copy = 1;

        $length = intval($this->input->get("length"));
        $query = $this->student_fee_voucher_model->get_unpaid_ajax($student_id, 0 );
        $data = [];
        $this->load->helper('menu_helper');
        $admind = $this->session->userdata( 'admin' );
        $permission = admin_permission($admind['id']);
        foreach($query as $r) {
            
            $fee = $r->total_fee + $r->arrears;
            $fine = $r->total_fee - $r->monthly_fee - $r->arrears;
            $arrears =  $r->arrears - $r->monthly_fee;
            $voucher =  '<a class="btn btn-default btn-xs  "  href="' . base_url('fee_management/fee_voucher_process2?vrno=') .$r->id.'&student_ids='.$r->student_id.'&bank_copy='.$bank_copy. '"> <i class="fa fa-newspaper-o" aria-hidden="true"> </i></a>';
            $voucher_collect =  '<a class="btn btn-default btn-xs  "  href="' . base_url('fee_management/fee_voucher_collection_t?vrno=') .$r->id.' "> <i class="fa fa-spinner" aria-hidden="true"> </i></a>';
            $action = $voucher_collect." ".$voucher;
            $due_date =  date( 'd-M-y',strtotime($r->due_date));
            $issue_date  = date('d-M-y',strtotime($r->created_at));
            $data[] = array(
                $r->id,
                $r->monthly_fee,
                $r->arrears,
                $fee,
                $issue_date,
                $due_date,
                $action,

            );
        }
        $result = array(
            "draw" => $draw,
            "recordsTotal" => '',
            "recordsFiltered" => '',
            "data" => $data
        );
        echo json_encode($result);
        exit();
    }
    public function annual_report(){
        $student_id = intval($this->input->get("student_id"));


        $year = date( 'Y', now() );
        if(date('m', now()) > '2'){
            $start = 1;
            $end = 13;
        }else{
            $start = 3;
            $end = 15;
        }
        for ( $j = $start; $j < $end; $j++ ){
            $year =  date( 'Y', now());
            if( $j >= 13 ){
                $annual = $j - 12;
            }elseif( $j<=12){
                if(date('m', now()) > '2'){
                    $year =  date( 'Y', now());
                }else{
                    $year =  date("Y",strtotime("-1 year"));
                }
                $annual = str_pad($j,2,0,STR_PAD_LEFT);
            }
            $data2 = [
                'year' => "{$year}",
                'month' => "{$annual}", ];
                $advance[$j]                   = $this->student_model->get_advance_annual(null,null,$student_id, $data2);
                $other_fee[$annual]           = $this->student_fee_payments_other->sum_by_month2("{$year}-{$annual}-01",$student_id );
                $student_fee[$annual]         = $this->student_fee_payments->get_total_received_fee_per_month2( "{$year}-{$annual}-01",$student_id  );
        }

        $table  = '';
        $table .= '<table class="table     mb0 font13">';
        $table .= '<tr>';
        $table .= '<td></td>';
        foreach($student_fee as $key=>$student)
        {
            $monthNum  = $key;
            $dateObj   = DateTime::createFromFormat('!m', $monthNum);
            $monthName = $dateObj->format('M');
            $table .= '<td class="text-center">'.$monthName.'</td>';
        }
        $table .= '</tr><tr>';
        $table .= '<td>Tuition</td>';
        foreach($student_fee as $student)
        {
            $table .= '<td class="text-center">'. $student.'</td>';
        }
        $table .= '</tr><tr>';
        $table .= '<td>Adv.Adj</td>';
        foreach($advance as $advance)
        {
            $table .= '<td class="text-center">'.number_format(  $advance['advance_fee'] ?? 0 ).'</td>';
        }
        $table .= '</tr><tr>';
        $table .= '<td>Other</td>';
        foreach($other_fee as $other)
        {
            $table .= '<td class="text-center">'. $other.'</td>';
        }
        $table .= '</tr>';
        $table  .= '</table>';
        echo json_encode($table);
        exit();
    }

    public function unpaid_student_other_ajax(){
        $draw = intval($this->input->get("draw"));
        $student_id = intval($this->input->get("student_id"));
        $bank_copy = 1;
        $length = intval($this->input->get("length"));
        $query = $this->student_fee_voucher_model->get_unpaid_ajax($student_id, 1 );
        $data = [];
        $this->load->helper('menu_helper');
        $admind = $this->session->userdata( 'admin' );
        $permission = admin_permission($admind['id']);

        foreach($query as $r) {
            $fee = $r['total_fee'] + $r['arrears'];
            $voucher =  '<a class="btn btn-default btn-xs  "  href="' . base_url('fee_management/fee_voucher_process2?vrno=') .$r['id'].'&student_ids='.$r['student_id'].'&bank_copy='.$bank_copy. '"> <i class="fa fa-newspaper-o" aria-hidden="true"> </i></a>';
            
            if ($permission->delete_fee == 1) {
            $delete  = '<a href="" class="btn btn-default btn-xs delete_voucher" data-voucher="'.$r['id'].'" data-type="'.$r['other'].'" title="Delete" > <i class="fa fa-trash-alt"></i></a>';
            }
            if($permission->waive == 1){
            $waive   = '<a href="" class="btn btn-default btn-xs waive_fee" data-voucher="'.$r['id'].'" data-type="'.$r['other'].'" title="Waive" >  <i class="fa fa-gift"></i></a>';
            }
            $action = $voucher." ".$delete." ".$waive;
            $due_date =  date( 'd-M-y',strtotime($r['due_date']));
            $issue_date  = date('d-M-y',strtotime($r['created_at']));
            $total_fee = 0;
            $name = [];
                foreach($r['voucher_fee_types'] as $key => $other){
                $name[$key] =  '<span style="float:left;">'.$other['name'].'</span><span style="float:right;">'.$other['amount'].'</span></br>';
                $total_fee += $other['amount'];
                }
            $data[] = array(
                $r['id'],
                $name,
                $total_fee,
                $issue_date,
                $due_date,
                $action,
            );
        }
        $result = array(
            "draw" => $draw,
            "recordsTotal" => '',
            "recordsFiltered" => '',
            "data" => $data
        );
        echo json_encode($result);
        exit();
    }


    
    public function unpaid_student_other_ajax_collection(){
        $draw = intval($this->input->get("draw"));
        $student_id = intval($this->input->get("student_id"));
        $bank_copy = 1;
        $length = intval($this->input->get("length"));
        $query = $this->student_fee_voucher_model->get_unpaid_ajax($student_id, 1 );
        $data = [];
        $this->load->helper('menu_helper');
        $admind = $this->session->userdata( 'admin' );
        $permission = admin_permission($admind['id']);

        foreach($query as $r) {
            $fee = $r['total_fee'] + $r['arrears'];

            $voucher_collect =  '<a class="btn btn-default btn-xs  "  href="' . base_url('fee_management/fee_voucher_collection?vrno=') .$r['id'].' "> <i class="fa fa-spinner" aria-hidden="true"> </i></a>';
            $voucher_print =  '<a class="btn btn-default btn-xs  "  href="' . base_url('fee_management/fee_voucher_process2?vrno=') .$r['id'].'&student_ids='.$r['student_id'].'&bank_copy='.$bank_copy. '"> <i class="fa fa-newspaper-o" aria-hidden="true"> </i></a>';
           
            $action = $voucher_collect." ".$voucher_print;
            $due_date =  date( 'd-M-y',strtotime($r['due_date']));
            $issue_date  = date('d-M-y',strtotime($r['created_at']));
            $total_fee = 0;
            $name = [];
                foreach($r['voucher_fee_types'] as $key => $other){
                $name[$key] =  '<span style="float:left;">'.$other['name'].'</span><span style="float:right;">'.$other['amount'].'</span></br>';
                $total_fee += $other['amount'];
                }
            $data[] = array(
                $r['id'],
                $name,
                $total_fee,
                $issue_date,
                $due_date,
                $action,
            );
        }
        $result = array(
            "draw" => $draw,
            "recordsTotal" => '',
            "recordsFiltered" => '',
            "data" => $data
        );
        echo json_encode($result);
        exit();
    }
    public function transaction_history(){

        $student_id = intval($this->input->get("student_id"));
        $student_fee_payments         = $this->student_fee_payments->get( null, $student_id, 20 );
        $student_fee_payments         = ( $student_fee_payments !== false ? $student_fee_payments : [] );
        $data = [];
        $total_tuition1  = 0 ;
        $total_paid  = 0;
        $total_other_paid = 0;
        $total_tuition1_waive  = 0 ;
        $total_other_paid_waive = 0;
        $total_reprint = 0;
        $total_fine_due = 0;
        $total_arrears = 0;
        $total_due_fee = 0;
        $total_paid_fee = 0;
        $this->load->helper('menu_helper');
        $admind = $this->session->userdata( 'admin' );
        $permission = admin_permission($admind['id']);
       
        foreach($student_fee_payments as $key => $r) {

            $voucher =  '<a class="btn btn-default btn-xs"  href="' . base_url('fee_management/print_fee_payment_receipt/'.$r['id']). '" target="_blank"> <i class="fa fa-print"></i></a>';
            
			$current_date = date("Y-m-d", now());
	        $payment_date = date('Y-m-d', strtotime($r['payment_date']));
            $delete ='';
            if(($payment_date == $current_date &&  $permission->daily_delete  == 1 ) ||  $permission->payment_delete == 1){
                $delete = '<a href="" class="btn btn-default btn-xs delete_payment" data-payment="'.$r['id'].'" title="Delete"  > <i class="fa fa-trash-alt"></i></a>';
            }

            $action = $voucher." ".$delete;
            $payment_date =  date( 'd-M-y',strtotime($r['payment_date']));
            $late_payment_fee = $this->student_fee_payments_other->get_by_feename('Fine for late fee payment', $r['id'] );
            if($r['fine_check'] == 0 ){
                $fine1  = $r['fine']; 
            }else{
                if($r['paid_fine'] <= $r['fine'] ){
                    $fine1  = $r['fine'] - $r['paid_fine'];
                }else{
                    $fine1  = $r['fine'];
                }
            }
              $other_waive = [];
              $name = [];
              $total_waive        = 0;
              $total_ = 0;
              $total_fee = 0;
            if($r['voucher_id'] == "1"){
                $fee_waive          =  $r['tuition_fee'];
                $tuition_fee        = 0;
                foreach($r['other_fee_payments'] as $key => $other){
                    if ( intval( $other['amount'] ) > 0 ){
                        $other_waive[]      =  $other['fee_name'].'<br>';
                    }
                    $total_waive += $other['amount'];
                }
            }else{
                $fee_waive   = 0;
                $tuition_fee = $r['tuition_fee'];
                $total_ =   $r['total_paid_fee'];
                $total_fee = 0;
            foreach($r['other_fee_payments'] as $key => $other){
                if ( intval( $other['amount'] ) > 0 ){
                $name[] =  $other['fee_name'].'<br>';
                }
                $total_fee += $other['amount'];
            } 
            }

           if($r['fine_check'] == 0 && $r['fine'] > 0 OR  $r['paid_fine'] < $r['fine']  ){

               if($r['paid_fine'] < $r['fine']){
                $other_waive[] ="Fine for late fee Payment";
                        $total_waive = $total_waive + $r['fine'] - $r['paid_fine'];
               }else{
                $other_waive[] ="Fine for late fee Payment";

                   
                    $total_waive = $total_waive + $r['fine'];
               }
              
            }

            $vocher_details = $this->student_fee_voucher_model->get( $r['voucher_id'] );

            
            if($r['reprint_waive'] > 0 ){
                $other_waive[] ="Voucher Reprint Fee";
                $total_waive = $total_waive + $r['reprint_waive'];
            }
                if($r['tuition_fee'] == 0){
                    $t_due_fee  =  0;
                    $arrears  = 0;
                    $reprint_fee = 0 ;
                    $balance           =  0;
                }else{
                    $reprint_fee = $r['reprint_fee'] + $r['reprint_waive'] ;
                    $t_due_fee =    number_format($vocher_details['monthly_fee']);
                    $arrears =  number_format($vocher_details['arrears']);
                    $balance =      number_format($r['due_fee'] - $r['total_paid_fee'] -$fine1 + $r['reprint_fee']  );
                }
             $total_paid   += $total_;
             $total_tuition1 +=  $vocher_details['monthly_fee'];
             $total_other_paid += $total_fee;
             $total_tuition1_waive += $fee_waive;
             $total_other_paid_waive += $total_waive;
             $total_reprint += $reprint_fee;
             $total_fine_due += $r['fine'];
             $total_arrears += $vocher_details['arrears'];
             $total_due_fee += $r['due_fee'];
             $total_paid_fee += $tuition_fee;
             
             
            $data[] = array(
                $payment_date,
                $r['user_id'],
                $r['voucher_id'],
                $t_due_fee,
                $arrears,
                $r['fine'],
                $reprint_fee,
                number_format($r['due_fee']),
                number_format($tuition_fee),
                $r['fee_description'],
                $fee_waive,
                $balance,
                $name,
                number_format($total_fee),
                $other_waive,
                number_format($total_waive),
                number_format($total_),
                $action,
            );

            

        }
    //exit;
        $data[] = array(
            'Total',
            '',
            '',
            number_format($total_tuition1),
            number_format($total_arrears),
            number_format($total_fine_due),
            number_format($total_reprint),
            number_format($total_due_fee),
            number_format($total_paid_fee),
            '',
            number_format($total_tuition1_waive),
            '',
            '',
            number_format($total_other_paid),
            '',
            number_format($total_other_paid_waive),
            number_format($total_paid),
            '',
        );

        
        $result = array(
            "draw" => '',
            "recordsTotal" => '',
            "recordsFiltered" => '',
            "data" => $data
        );


        echo json_encode($result);
        exit();
    }

    public function receive_fee_process( $student_id = null )
    {
        $adminsess = $this->session->userdata( 'admin' );
        $this->load->helper('menu_helper');
        $permission = admin_permission($adminsess['id']);
        if ( $student_id === null ) {
            $this->session->set_flashdata( "Something went wrong!!" );
            redirect( 'studentfee' );
        } else {
            $student = $this->student_model->get( $student_id );
            if ( $student === null ) {
                $this->session->set_flashdata( "Something went wrong!!!" );
                redirect( 'studentfee' );
            } else {
                $other_fee_types = $this->input->post( 'other_fee_types' );
                $this->form_validation->set_rules( 'tuition_fee', 'Tuition fee', 'trim|required' );
                $this->form_validation->set_rules( 'submission_date', 'Submission Date', 'trim' );
                $this->form_validation->set_rules( 'late_fee_payment_fine', 'Late fee payment fine', 'trim' );
                $this->form_validation->set_rules( 'late_fee_payment_fine_check', 'Late fee payment fine checkbox', 'trim' );
                for ( $i = 0; $i < count( $other_fee_types ); $i++ ) {
                    $_POST['other_fee_types'][$i]['name'] = ( !empty( $_POST['other_fee_types'][$i]['name'] ) ? $_POST['other_fee_types'][$i]['name'] : "0" );
                    $_POST['other_fee_types'][$i]['amount'] = ( !empty( $_POST['other_fee_types'][$i]['amount'] ) ? $_POST['other_fee_types'][$i]['amount'] : "0" );
                    $this->form_validation->set_rules( "other_fee_types[$i][name]", $other_fee_types[$i]['name'], 'trim|required|strtolower|ucwords' );
                    $this->form_validation->set_rules( "other_fee_types[$i][amount]", $other_fee_types[$i]['amount'], 'trim|required|numeric|intval' );
                }
                if ( $this->form_validation->run() == false ) {
                    $this->receive_fee( $student_id );
                } else {
                    
                    $tution_fee_check               = $this->input->post( 'tution_fee_check' );
                    $t_fee                          = $this->input->post( 'tution_fee' );
                    $arrears_fee                    = $this->input->post( 'arrears_fee' );
                    $advance_fee                    = $this->input->post( 'advance' );
                    $submission_date                = $this->input->post( 'submission_date' );
                    $late_fee_payment_fine          = $this->input->post( 'late_fee_payment_fine' );
                    $late_fee_payment_fine_check    = $this->input->post( 'late_fee_payment_fine_check' );
                    $voucher_id                     = $this->input->post( 'voucher_id' );
                    $fee_description                = $this->input->post( 'arrears_description' );
                    $user_id                        = $this->input->post( 'user_id' );
                    if($voucher_id == null){
                        $voucher_id = 1;
                    }
                    if ( $tution_fee_check == '1' ) {
                        if($advance_fee > 0 ){
                            $tuition_fee =	$t_fee + $advance_fee;
                        }else{
                            $tuition_fee = $t_fee + $arrears_fee;
                        }
                    }else{
                        if($advance_fee > 0 ){
                            $tuition_fee =  $advance_fee;
                        }else{
                            $tuition_fee = $arrears_fee;
                        }
                    }




                    // if fine checkbox is selected
                    // remove fine from the student late payment fee and add it to other fee
                    if ( $late_fee_payment_fine_check == '1' ) {
                        // set late fee payment to 0
                        $this->db->update( 'students', [
                            'late_payment_fee' => 0
                        ], ['id' => $student['id']] );
                        // setting late fee payment fine
                        $other_fee_types[] = [
                            'name' => 'Fine for late fee payment',
                            'amount' => $student['late_payment_fee']
                        ];
                    } else {
                        // if tuition fee is paid
                        if ( intval( $tuition_fee ) > 0 ) {
                            $lfpf = floatval( $student['late_payment_fee'] ) - floatval( $late_fee_payment_fine );
                            $lfpf = ( $lfpf < 0 ? 0 : $lfpf );
                            $this->db->update( 'students', [
                                'late_payment_fee' => $lfpf
                            ], ['id' => $student['id']] );
                        }
                    }
                    $add_fee = $this->student_fee_payments->add_fee( $student, $tuition_fee, $other_fee_types, $submission_date ,$late_fee_payment_fine, $fee_description,$voucher_id, $user_id);

                    if ( $add_fee !== false ) {
                        $this->session->set_flashdata( 'msg', "Fee record has been added successfully!" );
                        // refereshing student id
                        $student = $this->student_model->get( $student['id'] );
                        // if voucher ID is available
                        if ( $voucher_id !== null ) {
                            // change paid status to 1
                            $this->db->update( 'student_fee_voucher', ['paid' => 1], ['id' => $voucher_id] );
                        }
                        // if father phone is not empty
                        if ( !empty( $student['father_phone'] ) ) {
                            $_fee_details = $this->student_fee_payments->get( $add_fee );
                            $arrears                = 0;
                            $advance                = 0;
                            $tuition_fee_left       = 0;
                            $current_month_arrears  = 0;
                            $discount_fee =  intval($student['fee'])- intval($student['discount']);
                            if ($_fee_details['due_fee'] > 0 ) {
                                $current_month_arrears = intval($_fee_details['due_fee']) -intval($discount_fee) - intval($_fee_details['late_payment_fee']);
                                if ($_fee_details['tuition_fee'] <= $current_month_arrears) {
                                    $arrears = intval($_fee_details['tuition_fee']);
                                    $tuition_fee = 0;
                                    $advance = 0;
                                }elseif ($_fee_details['tuition_fee'] > $current_month_arrears){
                                    $arrears            = $current_month_arrears;
                                    $tuition_fee_left   = $_fee_details['tuition_fee'] - $arrears;
                                    if ($tuition_fee_left <= $discount_fee) {
                                        $tuition_fee        = $tuition_fee_left;
                                        $advance = 0;
                                    }else{
                                        $tuition_fee        = $discount_fee;
                                        $tuition_fee_left   = $tuition_fee_left - $discount_fee;
                                        $advance            = $tuition_fee_left;
                                    }
                                }
                            }elseif($_fee_details['due_fee'] <= 0){
                                $tuition_fee = 0;
                                $arrears     = 0;
                                $advance     = $_fee_details['tuition_fee'];
                            }
                            if ($arrears < 0) {
                                $arrears = 0;
                            }
                            if ( !empty( $_fee_details['other_fee_payments'] ) ) {
                                foreach ( $_fee_details['other_fee_payments'] as $_other_fee_payment ) {
                                    if (  $_other_fee_payment['fee_name']   == "Fine for late fee payment" ) {
                                        $fine = $_other_fee_payment['amount'];
                                    }
                                }
                            }
                            $classsss_fee = $_fee_details['tuition_fee'] - $arrears;
                            if($classsss_fee > 0){
                                $tuition_fee_sms = $_fee_details['tuition_fee'] - $arrears + $fine;
                            }elseif($classsss_fee == 0){
                                $tuition_fee_sms = $_fee_details['tuition_fee'] - $arrears;
                            }
                            $_fee_types = [];
                            $_fee_types[] = "Tuition Fee:  ".$tuition_fee_sms;
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
                            $advance      =    number_format( $advance);
                            $arrears      =	number_format($arrears);
                            if($permission->fee_collection_message == 1 ) {
                                $this->sms_library->send_sms($student['father_phone'], $this->sms_messages->student_fee_receive_message($student['firstname'], $student['class'], $student['section'], $student['roll_no'], $student['admission_no'], $arrears, $advance, $_fee_details['total_paid_fee'], $_fee_types, $student['fee_arrears'], $_fee_details['payment_date'], $school_name));

                            }

                            if($permission->admin_fee_message == 1 ){
                                $admin_phone = $this->custom_option_model->get('admin_phone');
                                $this->sms_library->send_sms( $admin_phone['value'], $this->sms_messages->student_fee_receive_message( $student['firstname'], $student['class'], $student['section'], $student['roll_no'], $student['admission_no'], $arrears,$advance, $_fee_details['total_paid_fee'],$_fee_types,$student['fee_arrears'], $_fee_details['payment_date'], $school_name ) );
                            }
                        }
                    }
                    else {
                        $this->session->set_flashdata( 'err', "Fee record wasn't added. Please try again." );
                    }
                    redirect( 'fee_management/receive_fee/' . $student_id );
                }
            }
        }
    }

    public function delete_fee( $fee_payment_id = null )
    {
        if ( $fee_payment_id === null ) {
            show_404();
        } else {
            $adminsess = $this->session->userdata( 'admin' );
            $redirect_url = $this->input->get( 'redirect' );
            $redirect_url = ( $redirect_url !== null ? urldecode( $redirect_url ) : site_url( 'fee_management/collect_fee/' ) );
            $fee_payment = $this->student_fee_payments->get( $fee_payment_id );
            if ( $fee_payment !== false ) {
                $fine = 0;
                foreach($fee_payment['other_fee_payments'] as $fine_payment){
                    if($fine_payment['fee_name'] == 'Fine for late fee payment'){;
                        $fine =$fine_payment['amount'];
                    }
                }
                $student = $this->student_model->get( $fee_payment['student_id'] );
                if ( $student !== null ) {
                    $this->db->update( 'students', [
                        'fee_arrears' => intval( $student['fee_arrears'] ) + intval( $fee_payment['tuition_fee'] ) +$fine,
                        'late_payment_fee' => $fine,
                    ], [
                        'id' => $student['id']
                    ] );
                }
                if($fee_payment["voucher_id"] != 0){
                    $this->db->update( 'student_fee_voucher', [
                        'paid' => 0
                    ], [
                        'id' => $fee_payment['voucher_id']
                    ] );
                }
                $this->db->delete( 'student_fee_payments_others', [
                    'student_fee_payment_id' => $fee_payment_id
                ] );
                $this->db->delete( 'student_fee_payments', [
                    'id' => $fee_payment_id
                ] );
                $this->session->set_flashdata( 'msg', "Fee payment record has been deleted!" );
                redirect( $redirect_url );
            } else {
                $this->session->set_flashdata( 'err', "Fee payment wasn't found!" );
            }
        }
    }

    public function delete_unpaid($vrno = null  )
    {
        $redirect_url = $this->input->get( 'redirect' );
        $redirect_url = ( $redirect_url !== null ? urldecode( $redirect_url ) : site_url( 'fee_management/fee_voucher/' ) );
        $this->db->delete( 'student_fee_voucher', [
            'id' => $vrno
        ] );
        $this->session->set_flashdata( 'msg', "unpaid Fee voucher record has been deleted!" );
        redirect( $redirect_url );
    }

    public function delete_unpaid_ajax()
    {
        $vrno = $this->input->post( 'vrno' );
         $delete = $this->student_fee_voucher_model->delete_voucher( $vrno );
        if($delete){
            $message = "Vr No.". $vrno ." has been Delete" ;
        }else{
            $message = "Vr No.". $vrno ." has been not Delete" ;
        }
        $array = array('status' => 'success', 'error' => '','message' => $message);
        echo json_encode($array);
    }
    
    public function delete_unpaid_ajax_all()
    {
        $vrno = $this->input->post( 'vrno' );
        foreach($vrno as $voucher ){
            $delete = $this->student_fee_voucher_model->delete_voucher( $voucher );
        }   
        if($delete){
            $message =  $vrno." Voucher Delete";
        }else{
            $message =  $vrno." Voucher not Delete";
        }
        $array = array('status' => 'success', 'error' => '','message' => $message);
        echo json_encode($array);
    }

    public function delete_voucher_unpaid()
    {
        $vrno = $this->input->post('vrno');
        $myArray = explode(',', $vrno);
        $date = date('Y-m-d H:i:s');
           
        foreach($myArray as $voucher ){
            $this->db->update( 'student_fee_voucher', [
                'delete_v' => 1,
                'updated_at' => $date,
            ], [
                'id' => $voucher
            ] );
        }
        $message =  $vrno." Voucher Delete";
        $array = array('status' => 'success', 'error' => '','message' => $message);
        echo json_encode($array);
    }

    public function delete_payment_ajax()
    {
        $payment = $this->input->post( 'payment' );
        $fee_payment = $this->student_fee_payments->get( $payment );
        if ( $fee_payment !== false ) {
            $fine = 0;
            // foreach($fee_payment['other_fee_payments'] as $fine_payment){
            //     if($fine_payment['fee_name'] == 'Fine for late fee payment'){;
            //         $fine =$fine_payment['amount'];
            //     }
            // }
            $fine = $fee_payment['fine'];
            $student = $this->student_model->get( $fee_payment['student_id'] );
            if ( $student !== null ) {
                $this->db->update( 'students', [
                    'fee_arrears' => intval( $student['fee_arrears'] ) + intval( $fee_payment['tuition_fee'] ) + $fine,
                    'late_payment_fee' => $fine,
                ], [
                    'id' => $student['id']
                ] );
            }
            if($fee_payment["voucher_id"] != 0){
                $this->db->update( 'student_fee_voucher', [
                    'paid' => 0
                ], [
                    'id' => $fee_payment['voucher_id']
                ] );
            }
            $this->db->delete( 'student_fee_payments_others', [
                'student_fee_payment_id' => $payment
            ]);
        if($this->db->delete( 'student_fee_payments', [
            'id' => $payment
        ] )){
            $message =  "Payment for Vr No ".$fee_payment['voucher_id']." deleted";
        }else{
            $message =  "Payment for Vr No ".$fee_payment['voucher_id']." deleted";
        }
        }
        $student = $this->student_model->get( $fee_payment['student_id'] );
        $student_fee = $student['fee'] -   $student['discount'];
        if($student['fee_arrears'] < 0){
            $advance = abs($student['fee_arrears']);
            $arrears = 0;
            $due = 0;
        }else{
            $arrears =    $student['fee_arrears'] - $student_fee;
            if($arrears > 0){
                $arrears = $student['fee_arrears'] - $student_fee -$fine;
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
        $array = array('status' => 'success', 'error' => '','message' => $message,'data' => $data);
        echo json_encode($array);
    }

    public function fee_reports2()
    {
        $this->session->set_userdata( 'top_menu', 'Reports' );
        $this->session->set_userdata( 'sub_menu', 'fee_management/fee_reports' );
        $fee_payment_types  = $this->input->get( 'fee_payment_type' );
        $transaction_type   = $this->input->get( 'transaction_type' );
        if ($transaction_type == null || empty($transaction_type)) {
            $transaction_type   = "all";
        }
        $this->form_validation->set_data( $_GET );
        $this->form_validation->set_rules( 'class_id', 'Class id', 'trim' );
        $this->form_validation->set_rules( 'section_id', 'Section id', 'trim' );
        $this->form_validation->set_rules( 'search_type', 'Search Type', 'trim' );
        $this->form_validation->set_rules( 'date_from', 'Date from', 'trim|urldecode' );
        $this->form_validation->set_rules( 'date_to', 'Date to', 'trim|urldecode' );
        for ( $i = 0; $i < count( $fee_payment_types ); $i++ ) {
            $this->form_validation->set_rules( "fee_payment_type[{$i}]", 'Fee payment type', 'trim' );
        }
        $this->form_validation->run();
        $class_id   = $this->input->get( 'class_id' );
        $section_id = $this->input->get( 'section_id' );
        $date_from  = $this->input->get( 'date_from' );
        $date_to    = $this->input->get( 'date_to' );
        $search_type = $this->input->get( 'search_type' );
        // echo $search_type;exit;
        $class = $this->class_model->get();
        if ( $search_type === null ) {
            $search_type = 'paid';
        }
        if ( $search_type == 'paid' ) {
            $student_payments       = $this->student_fee_payments->search( $class_id, $section_id, $date_from, $date_to, $fee_payment_types, $search_type );
        }
        if ( $search_type == 'pending' ) {
            $student_payments       = $this->student_fee_payments->search( $class_id, $section_id, $date_from, $date_to, $fee_payment_types, $search_type );
        }
        if ( $student_payments !== false ) {
            // appending other fee payments too
            $std_id = NULL;
            $student_fee_payments = array();
            foreach ($student_payments as $key => $s_payments) {
                if(empty($std_id) || $std_id != $s_payments['student_id']){
                    $late_payment_fee = $this->student_fee_payments_other->get_by_feename('Fine for late fee payment', $s_payments['id']+1 );
                    $student_fee_payments[$key]["late_payment_fee"] =  $late_payment_fee;
                    $student_fee_payments[$key]["student_id"]       =  $s_payments['student_id'];
                    $student_fee_payments[$key]["tuition_fee"]      =  $s_payments['tuition_fee'];
                    $student_fee_payments[$key]["due_fee"]          =  $s_payments['due_fee'];
                    $student_fee_payments[$key]["total_paid_fee"]   =  $s_payments['total_paid_fee'];
                    $student_fee_payments[$key]["payment_date"]     =  $s_payments['payment_date'];
                    $std_num =  $key;
                }else{
                    foreach ($student_fee_payments as $sfpkey => $sfp) {
                        if ($sfp["student_id"] == $s_payments['student_id']) {
                            if ($s_payments['due_fee'] > $student_fee_payments[$std_num]["due_fee"]) {
                                $student_fee_payments[$key]["due_fee"]               =  $s_payments['due_fee'];
                            }
                            $student_fee_payments[$std_num]["tuition_fee"]          +=  $s_payments['tuition_fee'];
                            $student_fee_payments[$std_num]["total_paid_fee"]       +=  $s_payments['total_paid_fee'];
                            $student_fee_payments[$std_num]["payment_date"]          =  $s_payments['payment_date'];
                        }
                    }
                }
                $std_id  = $s_payments['student_id'];
            }
            $student_fee_payments = array_values($student_fee_payments);
            for ( $i = 0; $i < count( $student_fee_payments ); $i++ ) {
                $student_fee_payments[$i]['student'] = $this->student_model->get( $student_fee_payments[$i]['student_id'] );
            }
        }
   
        $data = array(
            'title'         => "Fee Collection Report",
            'date_from'     => $date_from,
            'date_to'       => $date_to,
            'search_type'   => $search_type
        );
        $data['classlist'] = $class;
        //sort records by last date
        $data['student_fee_payments']       = $student_fee_payments;
        // print_r($data['student_fee_payments']);exit;
        $data['transaction_type']           = $transaction_type;
        $student_fee_payment_types          = $this->student_fee_type_model->get();
        $data['student_fee_payment_types']  = $student_fee_payment_types;
        $class   = '';
        $seciton = '';
        $search  = '';
        if (!empty($class_id) || !empty($section_id)) {
            $getclass   = $this->class_model->get( $class_id );
            if (!empty($section_id)) {
                $getseciton = $this->section_model->get( $section_id );
            }
            $class      = $getclass['class'];
            $section    = $getseciton['section'];
            $search = "(".$class." ".$section.")";
        }
        $date                       = "(".$date_from." - ".$date_to.")";
        $data['print_title']        = "Fee Collection Report ".$search." ".$date;
        $unpaid_students = $this->student_fee_voucher_model->get_unpaid();
        $std_id = NULL;
        $student_unpaid = array();
        foreach ($unpaid_students as $key => $s_payments) {
            $student_unpaid[$key]["student_id"]       =  $s_payments['student_id'];
            $student_unpaid[$key]["voucher_id"]     =  $s_payments['id'];
            $student_unpaid[$key]["total_fee"]     =  $s_payments['total_fee'];
            $student_unpaid[$key]["created_voucher"]     =  $s_payments['created_at'];
            $student_unpaid[$key]["due_voucher"]     =  $s_payments['due_date'];
            $student_unpaid[$key]["voucher_fee_types"]     =  $s_payments['voucher_fee_types'];
            $student_unpaid[$key]["voucher_arrears"]     =  $s_payments['arrears'];
            $std_num =  $key;
            $std_id  = $s_payments['student_id'];
        }
        $student_unpaid = array_values($student_unpaid);

        for ( $i = 0; $i < count( $student_unpaid ); $i++ ) {
            $student_unpaid[$i]['student'] = $this->student_model->get( $student_unpaid[$i]['student_id'] );
        }
        $data['unpaid_students']  = $student_unpaid;
        $this->load->view( 'layout/header', $data );
        $this->load->view( 'fee_management/fee_reports2', $data );
        $this->load->view( 'layout/footer', $data );
    }

    public function fee_reports()
    {
       
        $this->session->set_userdata( 'top_menu', 'Reports' );
        $this->session->set_userdata( 'sub_menu', 'fee_management/fee_reports' );
        $fee_payment_types  = $this->input->get( 'fee_payment_type' );
        $transaction_type   = $this->input->get( 'transaction_type' );
        if ($transaction_type == null || empty($transaction_type)) {
            $transaction_type   = "all";
        }
        $this->form_validation->set_data( $_GET );
        $this->form_validation->set_rules( 'class_id', 'Class id', 'trim' );
        $this->form_validation->set_rules( 'section_id', 'Section id', 'trim' );
        $this->form_validation->set_rules( 'search_type', 'Search Type', 'trim' );
        $this->form_validation->set_rules( 'search_type_paid', 'Search status', 'trim' );
        $this->form_validation->set_rules( 'date_from', 'Date from', 'trim|urldecode' );
        $this->form_validation->set_rules( 'date_to', 'Date to', 'trim|urldecode' );
        for ( $i = 0; $i < count( $fee_payment_types ); $i++ ) {
            $this->form_validation->set_rules( "fee_payment_type[{$i}]", 'Fee payment type', 'trim' );
        }
        $this->form_validation->run();
        $class_id   = $this->input->get( 'class_id' );
        $section_id = $this->input->get( 'section_id' );
        $date_from  = $this->input->get( 'date_from' );
        $date_to    = $this->input->get( 'date_to' );
        $month      = $this->input->get( 'month' );
       
        $month = $month != null ? $month : date('m');

        $data['month'] = date('F', mktime(0, 0, 0, $month, 10));;
      
        $date_from  =  $date_from != null ? $date_from : date('Y-m-1');
        $date_to    =  $date_to != null ? $date_to : date('Y-m-t');
        $search_type       = $this->input->get( 'search_type' );
        $search_type_paid  = $this->input->get( 'search_type_paid' );
        $class = $this->class_model->get();
         if ( $search_type === null ) {
            $search_type = 'paid';
        }
        if ( $search_type == 'paid' ) {
            $student_payments       = $this->student_fee_payments->search( $class_id, $section_id, $date_from, $date_to, $fee_payment_types, $search_type );
        }
      
        $data['search_type'] = $search_type;
        $data['search_type_paid'] = $search_type_paid;
        //////////////////////////////////voucher//////////////////////////////////
        if($search_type_paid == 'student'){
            if ( $student_payments !== false ) {
                // appending other fee payments too
                $std_id = NULL;
                $student_fee_payments = array();
                foreach ($student_payments as $key => $s_payments) {
                    if(empty($std_id) || $std_id != $s_payments['student_id']){
                        $late_payment_fee = $this->student_fee_payments_other->get_by_feename('Fine for late fee payment', $s_payments['id'] );

                        $student_fee_payments[$key]["late_payment_fee"] =  $late_payment_fee;
                        $student_fee_payments[$key]["student_id"]       =  $s_payments['student_id'];
                        $student_fee_payments[$key]["tuition_fee"]      =  $s_payments['tuition_fee'];
                        $student_fee_payments[$key]["due_fee"]          =  $s_payments['due_fee'];
                        $student_fee_payments[$key]["total_paid_fee"]   =  $s_payments['total_paid_fee'];
                        $student_fee_payments[$key]["payment_date"]     =  $s_payments['payment_date'];
                        $student_fee_payments[$key]["fine"]             =  $s_payments['fine'];
                        $student_fee_payments[$key]["fine_check"]       =  $s_payments['fine_check'];
                        $student_fee_payments[$key]["date_time"]        =  $s_payments['date_time'];
                        $std_num =  $key;
                    }else{
                        foreach ($student_fee_payments as $sfpkey => $sfp) {
                            if ($sfp["student_id"] == $s_payments['student_id']) {
                                if ($s_payments['due_fee'] > $student_fee_payments[$std_num]["due_fee"]) {
                                    $student_fee_payments[$key]["due_fee"]               =  $s_payments['due_fee'];
                                }
                                $student_fee_payments[$std_num]["tuition_fee"]          +=  $s_payments['tuition_fee'];
                                $student_fee_payments[$std_num]["total_paid_fee"]       +=  $s_payments['total_paid_fee'];
                                $student_fee_payments[$std_num]["payment_date"]          =  $s_payments['payment_date'];
                            }
                        }
                    }
                    $std_id  = $s_payments['student_id'];
                }
                $student_fee_payments = array_values($student_fee_payments);
                for ( $i = 0; $i < count( $student_fee_payments ); $i++ ) {
                    $student_fee_payments[$i]['student'] = $this->student_model->get( $student_fee_payments[$i]['student_id'] );
                }
            }
            /////////////////////////////////////////student wise////////////////////
        }else{
            if ( $student_payments !== false ) {
                // appending other fee payments too
                $std_id = NULL;
                $student_fee_payments = array();
                foreach ($student_payments as $key => $s_payments) {
                    
                    $late_payment_fee = $this->student_fee_payments_other->get_by_feename('Fine for late fee payment', $s_payments['id'] );
                    $student_fee_payments[$key]["late_payment_fee"] =  $late_payment_fee;
                    $student_fee_payments[$key]["student_id"]       =  $s_payments['student_id'];
                    $student_fee_payments[$key]["tuition_fee"]      =  $s_payments['tuition_fee'];
                    $student_fee_payments[$key]["due_fee"]          =  $s_payments['due_fee'];
                    $student_fee_payments[$key]["total_paid_fee"]   =  $s_payments['total_paid_fee'];
                    $student_fee_payments[$key]["payment_date"]     =  $s_payments['payment_date'];
                    $student_fee_payments[$key]["fine"]             =  $s_payments['fine'];
                    $student_fee_payments[$key]["fine_check"]       =  $s_payments['fine_check'];
                    $student_fee_payments[$key]["voucher_id"]       =  $s_payments['voucher_id'];
                    $student_fee_payments[$key]["user_id"]          =  $s_payments['user_id'];
                    $std_num =  $key;
                    $std_id  = $s_payments['student_id'];
                }
                $student_fee_payments = array_values($student_fee_payments);
                for ( $i = 0; $i < count( $student_fee_payments ); $i++ ) {
                    $student_fee_payments[$i]['student'] = $this->student_model->get( $student_fee_payments[$i]['student_id'] );
                }
            }
        }
        //////////////////////////////////////////////////////////////////
        $data = array(
            'title'         => "",
            'date_from'     => $date_from,
            'date_to'       => $date_to,
            'search_type'   => $search_type,
            'search_type_paid'   => $search_type_paid
        );
        $data['classlist'] = $class;
        //sort records by last date
        $student_fee_payments    = $student_fee_payments;
        $data['student_fee_payments']       = $student_fee_payments;
        // print_r($data['student_fee_payments']);exit;
        $data['transaction_type']           = $transaction_type;
        $student_fee_payment_types          = $this->student_fee_type_model->get();
        $data['student_fee_payment_types']  = $student_fee_payment_types;
        $class   = '';
        $seciton = '';
        $search  = '';
        if (!empty($class_id) || !empty($section_id)) {
            $getclass   = $this->class_model->get( $class_id );
            if (!empty($section_id)) {
                $getseciton = $this->section_model->get( $section_id );
            }
            $class      = $getclass['class'];
            $section    = $getseciton['section'];
            $search = "(".$class." ".$section.")";
        }
        $date                       = "(".$date_from." - ".$date_to.")";
        if ( $search_type == 'pending' ) {
            $data['print_title']        =   date('M').' Unpaid Vouchers (Monthly Fee) '.$search.' '.$date.'<span style="float:right;" > Print Date:'.date('d-m-Y',now()).'</span>';
        }
        else{
            $data['print_title']        = ' Fee Collection Report '.$search.' '.$date.'<span style="float:right;" > Print Date:'.date('d-m-Y',now()).'</span>';
        }
        if ( $search_type == 'pending' ) {
            $unpaid_students = $this->student_fee_voucher_model->get_unpaid2( $student_id ,$id, $class_id, $section_id ,$month );
            $std_id = NULL;
            $student_unpaid = array();
            foreach ($unpaid_students as $key => $s_payments) {
                $student_unpaid[$key]["student_id"]         =  $s_payments['student_id'];
                $student_unpaid[$key]["late_payment_fee"]   =  $s_payments['late_payment_fee'];
                $student_unpaid[$key]["voucher_id"]         =  $s_payments['id'];
                $student_unpaid[$key]["total_fee"]          =  $s_payments['total_fee'];
				$student_unpaid[$key]["monthly_fee"]        =  $s_payments['monthly_fee'];
				$student_unpaid[$key]["advance_fee"]        =  $s_payments['advance'];
                $student_unpaid[$key]["created_voucher"]    =  $s_payments['created_at'];
                $student_unpaid[$key]["due_voucher"]        =  $s_payments['due_date'];
                $student_unpaid[$key]["voucher_fee_types"]  =  $s_payments['voucher_fee_types'];
                $student_unpaid[$key]["fee"]                =  $s_payments['fee'];
                $student_unpaid[$key]["discount"]           =  $s_payments['discount'];
                $student_unpaid[$key]["voucher_arrears"]    =  $s_payments['arrears'];
                $student_unpaid[$key]["admission_no"]       =  $s_payments['admission_no'];
                $student_unpaid[$key]["class"]              =  $s_payments['class'];
                $student_unpaid[$key]["section"]            =  $s_payments['section'];
                $student_unpaid[$key]["roll_no"]            =  $s_payments['roll_no'];
                $student_unpaid[$key]["lastname"]    =  $s_payments['lastname'];
                $student_unpaid[$key]["firstname"]    =  $s_payments['firstname'];
                $student_unpaid[$key]["father_cnic"]    =  $s_payments['father_cnic'];
                $student_unpaid[$key]["father_name"]    =  $s_payments['father_name'];
                $student_unpaid[$key]["father_phone"]    =  $s_payments['father_phone'];
                $student_unpaid[$key]["admission_date"]    =  $s_payments['admission_date'];
                $student_unpaid[$key]["id"]    =  $s_payments['id'];
                $std_num =  $key;
                $std_id  = $s_payments['student_id'];
            }
            $student_unpaid = array_values($student_unpaid);
        }

            $month_names = [];
            $month_name_date = new DateTime( date( 'Y-01-01', now() ) );
            for ( $i = 0; $i < 12; $i++ ) {
                $month_names[] = $month_name_date->format( 'F' );
                $month_name_date->add( new DateInterval( 'P1M' ) );
            }
            $data['month'] = date('F', mktime(0, 0, 0, $month, 10));;
        
            $data['month_names1'] = $month_names;
            $current_date = new DateTime( date( "Y-m-d", now() ) );
            $data['current_date'] = $current_date;

        $session_result = $this->session_model->get();
        $data['sessionlist'] = $session_result;
        $data['unpaid_students']  = $student_unpaid;
        $data['class_id'] =  $class_id;
        $data['section_id'] = $section_id;
        $data['width'] =  $search_type ==  'paid' ? '100px':'300px';
      
        $this->load->view( 'layout/header', $data );
        $this->load->view( 'fee_management/fee_reports', $data );
        $this->load->view( 'layout/footer', $data );
    }

    public function classWiseReport()
    {
       
        $this->session->set_userdata( 'top_menu', 'Reports' );
        $this->session->set_userdata( 'sub_menu', 'balance_sheet/index' );

        $month      = $this->input->get( 'month' );
        $year       = $this->input->get( 'year' );
        $day        = date("d");
        $month      = ( !empty( $month ) ? $month : date( 'm' ) );
        $year       = ( !empty( $year ) ? $year : date( 'Y') );
        $date_from  = date( 'Y-m-01', strtotime( "{$year}-{$month}-01" ) );
        $date_to    = date( 'Y-m-d', strtotime( "{$year}-{$month}-{$day}" ));
        $date       = date( 'Y-m-d');
        
        $date_previous  = date("m") <= 2 ? date("Y-03-01",strtotime("-1 year")) : date("Y-03-01");
        $date           = date( 'm/d/Y', strtotime( "{$year}-{$month}-01" ) );
        $data = [
            'total' => null 
        ];
        
        $data['current_session'] = $this->setting_model->getCurrentSession();
        $class_sections = $this->classsection_model->class_sections();
        for ( $i = 0; $i < count( $class_sections ); $i++ ) {
            $class_sections[$i]['attendance']       = $this->student_model->calculate_attendance( $class_sections[$i]['class_id'], $class_sections[$i]['section_id'], date( 'Y-m-d', now() ) );
            $class_sections[$i]['attendance_cus']   = [
                'p' => 0,
                'l' => 0,
                'a' => 0
            ];

            foreach ( $class_sections[$i]['attendance']['attendance_types'] as $itm ) {
                if ( strtolower( $itm['type'] ) == 'absent' ) {
                    $class_sections[$i]['attendance_cus']['a'] += intval( $itm['attendance_count'] );
                } elseif (strtolower( $itm['type'] ) == 'leave') {
                    $class_sections[$i]['attendance_cus']['l'] += intval( $itm['attendance_count'] );
                } else {
                    $class_sections[$i]['attendance_cus']['p'] += intval( $itm['attendance_count'] );
                }
            }
        }
        if ( $class_sections !== false ) {
            for ( $i = 0; $i < count( $class_sections ); $i++ ) {
                $date_from_log  = ( $date_from !== null ? date( "Y-m-d", strtotime( $date_from ) ) : date( 'Y-m-01', now() ) );
                $days_in_month  = cal_days_in_month( CAL_GREGORIAN, date( 'm', now() ), date( 'Y', now() ) );
                $date_to_log    = ( $date_to !== null ? date( 'Y-m-d', strtotime( $date_to ) ) : date( "Y-m-{$days_in_month}", now() ) );
                $student_logs   = $this->student_log_model->calculate( $class_sections[$i]['class_id'], $class_sections[$i]['section_id'], "2018-01-01",$date_from_log,$date_to_log );
                $class_sections[$i]['student_logs'] = $student_logs;
                $class_section_monthly_log = $this->class_section_monthly_log_model->get( null, $class_sections[$i]['id'], "{$year}-{$month}-01" );
                $class_sections[$i]['class_section_monthly_log'] = $class_section_monthly_log;
            }
            $student_logs_total = $this->student_log_model->total_calculate();
            $data['student_logs_total'] = $student_logs_total;
            $total = [
                'promote'                       => 0,
                'demote'                        => 0,
                'new_admission'                 => 0,
                'free'                          => 0,
                'without_fee'                   => 0,
                'struck_off'                    => 0,
                'total_students'                => 0,
           //   'total_tuition_fee'             => 0,
                'total_other_fee'               => 0,
                'advance_adjusted_fee'          => 0,
           //   'total_tuition_fee_other_fee'   => 0,
                'discount'                      => 0,
                'student_withdrawl'             => 0,
                'withdrawl_arrears'             => 0,
                'total_waive_fee'               => 0,
                'other_waive'                   => 0,
                'total_fine1'                   => 0,
                'total_paid_arrears11'          => 0,
                'total_paid_fee1'               => 0,
                'total_advance11'               => 0,
                'total_due_fee'                 => 0,
                'total_other1'                  => 0,
                'waive_arrears'                 => 0,
                'receiveable_total_fee'         => 0,
         //     'receiveable_total_received'    => 0,
                'class_section_fee_arrears'     => 0,
                'class_section_advance_fee'     => 0
            ];
            foreach ( $class_sections as $class_section ) {
                $total['promote']                    += intval( $class_section['student_logs']['promote'] );
                $total['demote']                     += intval( $class_section['student_logs']['demote'] );
                $total['new_admission']              += intval( $class_section['student_logs']['new_admission'] );
                $total['free']                       += intval( $class_section['student_logs']['free'] );
                $total['without_fee']                += intval( $class_section['student_logs']['without_fee'] );
            // $total['struck_off']                  += intval( $class_section['student_logs']['struck_off'] );
                $total['total_students']             += ( $class_section['class_section_monthly_log'] !== false ? intval( $class_section['class_section_monthly_log'][0]['total_students'] ) : 0 );
                $total['struck_off']                 += intval( $class_section['student_logs']['struck_off'] );
                $total['struck_off']                 += ( $class_section['class_section_monthly_log'] !== false ? intval( $class_section['class_section_monthly_log'][0]['struck_off'] ) : 0 );
            // $total['total_tuition_fee']           += ( $class_section['class_section_monthly_log'] !== false ? intval( $class_section['class_section_monthly_log'][0]['total_tuition_fee'] ) : 0 );
                $total['total_other_fee']            += ( $class_section['class_section_monthly_log'] !== false ? intval( $class_section['class_section_monthly_log'][0]['total_other_fee'] ) : 0 );
            //  $total['total_tuition_fee_other_fee'] += ( $class_section['class_section_monthly_log'] !== false ? intval( $class_section['class_section_monthly_log'][0]['total_tuition_fee'] ) + intval( $class_section['class_section_monthly_log'][0]['total_other_fee'] ) : 0 );
                $total['discount']                   += ( $class_section['class_section_monthly_log'] !== false ? intval( $class_section['class_section_monthly_log'][0]['discount'] ) : 0 );
                $total['receiveable_total_fee']      += ( $class_section['class_section_monthly_log'] !== false ? intval( $class_section['class_section_monthly_log'][0]['receiveable_total_fee'] ) : 0 );
                $total['advance_adjusted_fee']       += ( $class_section['class_section_monthly_log'] !== false ? intval( $class_section['class_section_monthly_log'][0]['advance_adjusted_fee'] ) : 0 );
                $total['total_waive_fee']            += ( $class_section['class_section_monthly_log'] !== false ? intval( $class_section['class_section_monthly_log'][0]['total_waive_fee'] ) : 0 );
                $total['other_waive']                += ( $class_section['class_section_monthly_log'] !== false ? intval( $class_section['class_section_monthly_log'][0]['other_waive'] ) : 0 );
                $total['waive_arrears']              += ( $class_section['class_section_monthly_log'] !== false ? intval( $class_section['class_section_monthly_log'][0]['waive_arrears'] ) : 0 );
                $total['total_fine1']                += ( $class_section['class_section_monthly_log'] !== false ? intval( $class_section['class_section_monthly_log'][0]['total_fine1'] ) : 0 );
                $total['total_paid_arrears11']       += ( $class_section['class_section_monthly_log'] !== false ? intval( $class_section['class_section_monthly_log'][0]['total_paid_arrears1'] ) : 0 );
                $total['total_paid_fee1']            += ( $class_section['class_section_monthly_log'] !== false ? intval( $class_section['class_section_monthly_log'][0]['total_paid_fee1'] ) : 0 );
                $total['total_advance11']            += ( $class_section['class_section_monthly_log'] !== false ? intval( $class_section['class_section_monthly_log'][0]['total_advance1'] ) : 0 );
                $total['total_other1']               += ( $class_section['class_section_monthly_log'] !== false ? intval( $class_section['class_section_monthly_log'][0]['total_other1'] ) : 0 );
                $total['student_withdrawl']          += ( $class_section['class_section_monthly_log'] !== false ? intval( $class_section['class_section_monthly_log'][0]['student_withdrawl'] ) : 0 );
                $total['withdrawl_arrears']          += ( $class_section['class_section_monthly_log'] !== false ? intval( $class_section['class_section_monthly_log'][0]['withdrawl_arrears'] ) : 0 );
                $total['total_due_fee']              += ( $class_section['class_section_monthly_log'] !== false ? intval( $class_section['class_section_monthly_log'][0]['total_due_fee'] ) : 0 );
            //  $total['receiveable_total_received'] += ( $class_section['class_section_monthly_log'] !== false ? intval( $class_section['class_section_monthly_log'][0]['receiveable_total_received'] ) : 0 );
                $total['class_section_fee_arrears']  += ( $class_section['class_section_monthly_log'] !== false ? intval( $class_section['class_section_monthly_log'][0]['class_section_fee_arrears'] ) : 0 );
                $total['class_section_advance_fee']  += ( $class_section['class_section_monthly_log'] !== false ? intval( $class_section['class_section_monthly_log'][0]['class_section_advance_fee'] ) : 0 );
            }

            $data['total'] = $total;
           
        }


        $total_class_students   = [];
        $total_students_list    = $this->student_model->searchByClassSection( null, null, null, null );
       

        foreach ( $total_students_list  as $tskey => $item ) {
            $find_class = 0;
            $total_late_fine     += $item['late_payment_fee'];
            if($item['class_id'] == $student_class_id && $item['section_id'] == $student_section_id)
            {
                $total_class_students[$class_num]['class_fee']      += $item['class_fee'] - $item['discount'];
                $total_class_students[$class_num]['class_fine']     += $item['late_payment_fee'];
                $total_class_students[$class_num]['class_discount'] += $item['discount'];
                $find_class = 1;
            }
            if($find_class == 0){
                $total_class_students[$tskey]['section_id']     = $item['section_id'];
                $total_class_students[$tskey]['class_id']       = $item['class_id'];
                $total_class_students[$tskey]['class_fee']      = $item['class_fee'] - $item['discount'];
                $total_class_students[$tskey]['class_fine']     = $item['late_payment_fee'];
                $total_class_students[$tskey]['class_discount'] = $item['discount'];
                $student_class_id                               = $item['class_id'];
                $student_section_id                             = $item['section_id'];
                $class_num                                      = $tskey;
            }
        }
        $data['total_class_students']   = $total_class_students;
        $data['total_late_fine']        = $total_late_fine;
        $data['class_sections']         = $class_sections;
        $this->load->view( 'layout/header', $data );
        $this->load->view( 'balance_sheet/classWiseReport', $data );
        $this->load->view( 'layout/footer', $data );
    }

    public function fee_reports_fee_waive()
    {
        $this->session->set_userdata( 'top_menu', 'Reports' );
        $this->session->set_userdata( 'sub_menu', 'fee_management/fee_reports' );
        $fee_payment_types  = $this->input->get( 'fee_payment_type' );
        $transaction_type   = $this->input->get( 'transaction_type' );
        if ($transaction_type == null || empty($transaction_type)) {
            $transaction_type   = "all";
        }
        $this->form_validation->set_data( $_GET );
        $this->form_validation->set_rules( 'class_id', 'Class id', 'trim' );
        $this->form_validation->set_rules( 'section_id', 'Section id', 'trim' );
        $this->form_validation->set_rules( 'search_type', 'Search Type', 'trim' );
        $this->form_validation->set_rules( 'search_type_paid', 'Search status', 'trim' );
        $this->form_validation->set_rules( 'date_from', 'Date from', 'trim|urldecode' );
        $this->form_validation->set_rules( 'date_to', 'Date to', 'trim|urldecode' );
        for ( $i = 0; $i < count( $fee_payment_types ); $i++ ) {
            $this->form_validation->set_rules( "fee_payment_type[{$i}]", 'Fee payment type', 'trim' );
        }
        $this->form_validation->run();
        $class_id   = $this->input->get( 'class_id' );
        $section_id = $this->input->get( 'section_id' );
        $date_from  = $this->input->get( 'date_from' );
        $date_to    = $this->input->get( 'date_to' );
        $session_id    = $this->input->get( 'session_id' );
        $search_type       = $this->input->get( 'search_type' );
        $search_type_paid       = $this->input->get( 'search_type_paid' );
        $session  = $this->setting_model->getCurrentSession();
        $data['current_session'] = $session_id != null ? $session_id :  $session;
    
       

        $class = $this->class_model->get();
        $search_type = 'paid';
        $student_payments       = $this->student_fee_payments->search_free_month( $class_id, $section_id, $date_from, $date_to, $fee_payment_types, $search_type,null,$data['current_session'] );
       
       
    
        $data['search_type_paid'] = $search_type_paid;
        
        //////////////////////////////////voucher//////////////////////////////////
        if($search_type_paid == 'voucher'){
            if ( $student_payments !== false ) {
                // appending other fee payments too
                $std_id = NULL;
                $student_fee_payments = array();
                foreach ($student_payments as $key => $s_payments) {
                    $late_payment_fee = $this->student_fee_payments_other->get_by_feename('Fine for late fee payment', $s_payments['id'] );
                   
                    $student_fee_payments[$key]["late_payment_fee"] =  $late_payment_fee;
                    $student_fee_payments[$key]["student_id"]       =  $s_payments['student_id'];
                    $student_fee_payments[$key]["tuition_fee"]      =  $s_payments['tuition_fee'];
                    $student_fee_payments[$key]["due_fee"]          =  $s_payments['due_fee'];
                    $student_fee_payments[$key]["total_paid_fee"]   =  $s_payments['total_paid_fee'];
                    $student_fee_payments[$key]["payment_date"]     =  $s_payments['payment_date'];
                    $student_fee_payments[$key]["fine"]             =  $s_payments['fine'];
                    $student_fee_payments[$key]["fine_check"]       =  $s_payments['fine_check'];
                    $student_fee_payments[$key]["voucher_id"]       =  $s_payments['voucher_id'];
                    $student_fee_payments[$key]["user_id"]          =  $s_payments['user_id'];
                    $std_num =  $key;
                    $std_id  = $s_payments['student_id'];
                }
                $student_fee_payments = array_values($student_fee_payments);
                for ( $i = 0; $i < count( $student_fee_payments ); $i++ ) {
                    $student_fee_payments[$i]['student'] = $this->student_model->get( $student_fee_payments[$i]['student_id'] );
                }
            }
            /////////////////////////////////////////student wise////////////////////
        }else{
            if ( $student_payments !== false ) {
                // appending other fee payments too
                $std_id = NULL;
                $student_fee_payments = array();
                foreach ($student_payments as $key => $s_payments) {
                    if(empty($std_id) || $std_id != $s_payments['student_id']){
                        $late_payment_fee = $this->student_fee_payments_other->get_by_feename('Fine for late fee payment', $s_payments['id'] );

                        $student_fee_payments[$key]["late_payment_fee"] =  $late_payment_fee;
                        $student_fee_payments[$key]["student_id"]       =  $s_payments['student_id'];
                        $student_fee_payments[$key]["tuition_fee"]      =  $s_payments['tuition_fee'];
                        $student_fee_payments[$key]["due_fee"]          =  $s_payments['due_fee'];
                        $student_fee_payments[$key]["fine"]             =  $s_payments['fine'];
                        $student_fee_payments[$key]["fine_check"]       =  $s_payments['fine_check'];
                        $student_fee_payments[$key]["total_paid_fee"]   =  $s_payments['total_paid_fee'];
                        $student_fee_payments[$key]["payment_date"]     =  $s_payments['payment_date'];
                        $student_fee_payments[$key]["voucher_id"]       =  $s_payments['voucher_id'];
                   
                        $std_num =  $key;

                    }else{
                        foreach ($student_fee_payments as $sfpkey => $sfp) {
                            if ($sfp["student_id"] == $s_payments['student_id']) {
                                if ($s_payments['due_fee'] > $student_fee_payments[$std_num]["due_fee"]) {
                                    $student_fee_payments[$key]["due_fee"]               =  $s_payments['due_fee'];
                                }
                                $student_fee_payments[$std_num]["tuition_fee"]          +=  $s_payments['tuition_fee'];
                                $student_fee_payments[$std_num]["total_paid_fee"]       +=  $s_payments['total_paid_fee'];
                                $student_fee_payments[$std_num]["payment_date"]          =  $s_payments['payment_date'];
                            }
                        }
                    }
                    $std_id  = $s_payments['student_id'];
                }
                $student_fee_payments = array_values($student_fee_payments);
                for ( $i = 0; $i < count( $student_fee_payments ); $i++ ) {
                    $student_fee_payments[$i]['student'] = $this->student_model->get( $student_fee_payments[$i]['student_id'] );
                }
            }
        }
        //////////////////////////////////////////////////////////////////
        $data = array(
            'title'         => "Fee Waived Report",
            'date_from'     => $date_from,
            'date_to'       => $date_to,
            'search_type'   => $search_type,
            'search_type_paid'   => $search_type_paid
        );
        
        $data['classlist'] = $class;
        $data['student_fee_payments']       = $student_fee_payments;
        $data['transaction_type']           = $transaction_type;
        $student_fee_payment_types          = $this->student_fee_type_model->get();
        $data['student_fee_payment_types']  = $student_fee_payment_types;
        $class   = '';
        $seciton = '';
        $search  = '';
        $session  = $this->setting_model->getCurrentSession();
        $data['current_session'] = $session_id != null ? $session_id :  $session;
        $data['sessionlist'] = $this->session_model->getAllSession();
        if (!empty($class_id) || !empty($section_id)) {
            $getclass   = $this->class_model->get( $class_id );
            if (!empty($section_id)) {
                $getseciton = $this->section_model->get( $section_id );
            }
            $class      = $getclass['class'];
            $section    = $getseciton['section'];
            $search = "(".$class." ".$section.")";
        }
        $date                       = "(".$date_from." - ".$date_to.")";
        $data['print_title']        = "Fee Waived Report ".$search." ".$date;
        $this->load->view( 'layout/header', $data );
        $this->load->view( 'fee_management/fee_reports_fee_waive', $data );
        $this->load->view( 'layout/footer', $data );
    } 
    
    public function other_fee_report()
    {   
        $this->session->set_userdata( 'top_menu', 'Reports' );
        $this->session->set_userdata( 'sub_menu', 'fee_management/other_fee_report' );
        $data = array();
        $this->form_validation->set_data( $_GET );
        $this->form_validation->set_rules( 'class_id', 'Class', 'trim|urldecode' );
        $this->form_validation->set_rules( 'section_id', 'Section', 'trim|urldecode' );
        $this->form_validation->set_rules( 'other_fee_types', 'Other Fee Types', 'trim|urldecode' );
        $this->form_validation->set_rules( 'date_from', 'Date From', 'trim|urldecode' );
        $this->form_validation->set_rules( 'date_to', 'Date To', 'trim|urldecode' );
        $this->form_validation->set_rules( 'search_type', 'Search Type', 'trim' );
        $this->form_validation->run();
        $class_id           = $this->input->get( 'class_id' );
        $section_id         = $this->input->get( 'section_id' );
        $other_fee_types    = $this->input->get( 'other_fee_types' );
        $other_fee_types    = ( !empty( $other_fee_types ) ? $other_fee_types : null );
        $data['other_fee_types'] = $other_fee_types;
    
        $date_from = $this->input->get( 'date_from' );
        $date_to = $this->input->get( 'date_to' );

        $date_from = $date_from == null ? date( 'Y-m-1' ) : date( 'Y-m-d', strtotime( $date_from ) );

        $date_to = $date_to == null ? date( 'Y-m-t' ) : date( 'Y-m-d', strtotime( $date_to ) );

       
        $search_type            = $this->input->get( 'search_type' );
        $search_type_            = $this->input->get( 'search_type_' );
        if($search_type  != 'paid' ){
            $month1    = $this->input->get( 'month' );
            $month =  $month1  !=  ' ' ? date('F', mktime(0, 0, 0, $month1, 10)) :  date('F'); 
            $data['month'] = $month;
        }else{
            $month  =  ' ';
        }        
        $data['search_type']    = $search_type;
        $data['search_type_']    = $search_type_;
        
        $class                  = $this->class_model->get();
        $data['classlist']      = $class;
        $fee_types              = $this->student_fee_type_model->get();
        $data['fee_types']      = $fee_types;
        $data['class_id'] =  $class_id;
        $data['section_id'] = $section_id;
    
        
        $students_where = array();
        if ( !empty( $class_id ) ) {
            $students_where['student_session.class_id'] = $class_id;
        }
        if ( !empty( $section_id ) ) {
            $students_where['student_session.section_id'] = $section_id;
        }
        $month_names = [];
        $month_name_date = new DateTime( date( 'Y-01-01', now() ) );
        for ( $i = 0; $i < 12; $i++ ) {
            $month_names[] = $month_name_date->format( 'F' );
            $month_name_date->add( new DateInterval( 'P1M' ) );
        }
        $data['month_names1'] = $month_names;

        $search  = '';
        if (!empty($class_id) || !empty($section_id)) {
            $getclass   = $this->class_model->get( $class_id );
            if (!empty($section_id)) {
                $getseciton = $this->section_model->get( $section_id );
            }
            $class      = $getclass['class'];
            $section    = $getseciton['section'];
            $search = "(".$class." ".$section.")";
        }
        $date = "(".$date_from." - ".$date_to.")";

        if($search_type_ == "student_wise"){


        if ( $search_type == 'pending' ) {

            $current_date = new DateTime( date( "Y-m-d", now() ) );
            $data['current_date'] = $current_date;
            $data['print_title']        =   ' Unpaid Vouchers (Other Fee) '.$search.' '.$date.'<span style="float:right;" > Print Date:'.date('d-m-Y',now()).'</span>';
           
     
        $unpaid_students_other = $this->student_fee_voucher_model->get_unpaid_other2(null ,null,$class_id, $section_id,$other_fee_types,$month1 );
        $std_id = NULL;
        $student_unpaid = array();
       
        foreach ($unpaid_students_other as $key => $s_payments) {
            $student_unpaid[$key]["student_id"]         =  $s_payments['student_id'];
            $student_unpaid[$key]["voucher_id"]         =  $s_payments['id'];
            $student_unpaid[$key]["total_fee"]          =  $s_payments['total_fee'];
            $student_unpaid[$key]["created_voucher"]    =  $s_payments['created_at'];
            $student_unpaid[$key]["due_voucher"]        =  $s_payments['due_date'];
            $student_unpaid[$key]["voucher_fee_types"]  =  $s_payments['voucher_fee_types'];
            $std_num =  $key;
            $std_id  = $s_payments['student_id'];
        }
        $student_unpaid = array_values($student_unpaid);
        for ( $i = 0; $i < count( $student_unpaid ); $i++ ) {
            $student_unpaid[$i]['student'] = $this->student_model->get( $student_unpaid[$i]['student_id'] );
        }
        $data['unpaid_students_other']  = $student_unpaid;
    }else{
        $data['print_title']        =   ' paid Vouchers (Other Fee) '.$search.' '.$date.'<span style="float:right;" > Print Date:'.date('d-m-Y',now()).'</span>';
        $students_processed = array();
        $students = $this->student_model->get( null, $students_where, true,'others' );
        for ( $i = 0; $i < count( $students ); $i++ ) {
            $students[$i]['other_fee_records'] = $this->student_fee_payments_other->student_other_fee_records_test( $students[$i]['id'], $other_fee_types, $date_from, $date_to, $search_type,$month1 );
           if ( $search_type === null ) {
                $students_processed[] = $students[$i];
            } else {
                if ( $search_type == 'paid' && !empty( $students[$i]['other_fee_records'] ) ) {
                    $students_processed[] = $students[$i];
                }
                if ( $search_type == 'pending' && empty( $students[$i]['other_fee_records'] ) ) {
                    $students_processed[] = $students[$i];
                }
            }
        }
        
        $data['students_processed'] = $students_processed;    
    }
       
    }else{

        $month_names = [];
        $month_name_date = new DateTime( date( 'Y-01-01', now() ) );
        for ( $i = 0; $i < 12; $i++ ) {
            $month_names[] = $month_name_date->format( 'F' );
            $month_name_date->add( new DateInterval( 'P1M' ) );
        }

        $data['month_names1'] = $month_names;
        if($class_id){ $class_id = $class_id; }else{ $class_id  = null;  }  
        if($section_id){ $section_id = $section_id; }else{ $section_id  = null;  }  
      
        $class_sections = $this->classsection_model->class_sections_others(null, $class_id, $section_id);
        $fee_types1              = $this->student_fee_type_model->get(null , null , $other_fee_types);
        $data['month'] = $month;
        $data['fee_types1']      = $fee_types1;
        if ( $search_type == 'pending' ) {
      
        $fee_type1 = [];
        foreach($class_sections as $key => $class_section ){
            $other_unpaid        =  $this->student_fee_voucher_model->get_unpaid_other2(null,null,$class_section['class_id']  , $class_section['section_id'],null,$month1  );   
            foreach($fee_types1 as $key1 => $type){
                if($other_unpaid ){ 
                    foreach($other_unpaid  as $key2 => $voucher){
                        if($voucher){
                            if($voucher['voucher_fee_types']){
                                foreach($voucher['voucher_fee_types'] as $fee){
                                    if( $fee['name'] ==  $type['name'] ){
                                        $fee_type1[$class_section['class']['class'].'/'.$class_section['section']['section']][$key1][$key2]['id']    +=  $fee['amount']; 
                                    }else{
                                        $fee_type1[$class_section['class']['class'].'/'.$class_section['section']['section']][$key1][$key2]['id'] = 0;
                                    }
                                }                 
                            } 
                        }    
                    }
                }else{
                    $fee_type1[$class_section['class']['class'].'/'.$class_section['section']['section']][$key1]['id']  = 0;
                }
            }
        }

        $data['class_sections']   = $fee_type1;
    }else{

        $fee_types1              = $this->student_fee_type_model->get(null , null , $other_fee_types);
        $data['fee_types1']      = $fee_types1;
        $fee_type2 = [];
        foreach($class_sections as $key => $class_section ){
        
        $students  = $this->student_fee_payments_other->student_other_fee_payment_class( null,$class_section['class_id'],$class_section['section_id'], null, $date_from, $date_to, null,null );
        
        foreach($fee_types1 as $key1 => $type){
       
            if($students ){     
                foreach($students  as $key2 => $voucher){
                    if($voucher){
                        if( $voucher['fee_name'] ==  $type['name'] ){
                            $fee_type2[$class_section['class']['class'].'/'.$class_section['section']['section']][$key1]['id']    +=  $voucher['amount']; 
                        }else{
                            $fee_type2[$class_section['class']['class'].'/'.$class_section['section']['section']][$key1]['id'] = 0;
                        }
                    }else{

                    }    
                }
            }else{
                $fee_type2[$class_section['class']['class'].'/'.$class_section['section']['section']][$key1]['id']  = 0;
            }
        }
    }

    }
      

    }
    $this->load->view( 'layout/header', $data );
    $this->load->view( 'fee_management/other_fee_report', $data );
    $this->load->view( 'layout/footer', $data );
    }

    public function other_fee_report_unpaid()
    {
        $this->session->set_userdata( 'top_menu', 'Reports' );
        $this->session->set_userdata( 'sub_menu', 'fee_management/other_fee_report' );

        $data = array(
            'title' => 'Other Fee Types Report'
        );

        $this->form_validation->set_data( $_GET );
        $this->form_validation->set_rules( 'class_id', 'Class', 'trim|urldecode' );
        $this->form_validation->set_rules( 'section_id', 'Section', 'trim|urldecode' );
        $this->form_validation->set_rules( 'other_fee_types', 'Other Fee Types', 'trim|urldecode' );
        $this->form_validation->set_rules( 'date_from', 'Date From', 'trim|urldecode' );
        $this->form_validation->set_rules( 'date_to', 'Date To', 'trim|urldecode' );
        $this->form_validation->set_rules( 'search_type', 'Search Type', 'trim' );
        $this->form_validation->run();

        $class_id           = $this->input->get( 'class_id' );
        $section_id         = $this->input->get( 'section_id' );

        $other_fee_types    = $this->input->get( 'other_fee_types' );
        $other_fee_types    = ( !empty( $other_fee_types ) ? $other_fee_types : null );
        $data['other_fee_types'] = $other_fee_types;

        $date_from = $this->input->get( 'date_from' );
        if ( !empty( $date_from ) ) {
            $date_from = date( 'Y-m-d', strtotime( $date_from ) );
        } else {
            $date_from = null;
        }

        $date_to = $this->input->get( 'date_to' );
        if ( !empty( $date_to ) ) {
            $date_to = date( 'Y-m-d', strtotime( $date_to ) );
        } else {
            $date_to = null;
        }

        $search_type            = $this->input->get( 'search_type' );
        $data['search_type']    = $search_type;

        $class                  = $this->class_model->get();
        $data['classlist']      = $class;

        $fee_types              = $this->student_fee_type_model->get();
        $data['fee_types']      = $fee_types;

        $students_where = array();

        if ( !empty( $class_id ) ) {
            $students_where['student_session.class_id'] = $class_id;
        }

        if ( !empty( $section_id ) ) {
            $students_where['student_session.section_id'] = $section_id;
        }

        $students_processed = array();
        $students = $this->student_model->get( null, $students_where, false,'others' );


        for ( $i = 0; $i < count( $students ); $i++ ) {
            $students[$i]['other_fee_records'] = $this->student_fee_payments_other->student_other_fee_records( $students[$i]['id'], $other_fee_types, $date_from, $date_to, $search_type );

            if ( $search_type === null ) {
                $students_processed[] = $students[$i];
            } else {
                if ( $search_type == 'paid' && !empty( $students[$i]['other_fee_records'] ) ) {
                    $students_processed[] = $students[$i];
                }

                if ( $search_type == 'pending' && empty( $students[$i]['other_fee_records'] ) ) {
                    $students_processed[] = $students[$i];
                }
            }
        }





        $data['students'] = $students;
        $data['students_processed'] = $students_processed;


        $unpaid_students_other = $this->student_fee_voucher_model->get_unpaid_other2( );
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
        $this->load->view( 'fee_management/other_fee_report_unpaid', $data );
        $this->load->view( 'layout/footer', $data );
    }

    public function student_fee_types()
    {
        $this->session->set_userdata( 'top_menu', 'FeeManagement' );
        $this->session->set_userdata( 'sub_menu', 'fee_management/student_fee_types' );

        $data = [
            'title' => "Student fee types"
        ];

        $student_fee_types = $this->student_fee_type_model->get();
        $data['student_fee_types'] = $student_fee_types;

        $this->load->view( 'layout/header', $data );
        $this->load->view( 'fee_management/student_fee_types', $data );
        $this->load->view( 'layout/footer', $data );
    }

    public function student_fee_types_add()
    {
        $this->form_validation->set_rules( 'fee_name', 'Fee name', 'trim|required|strtolower|ucfirst' );
        $this->form_validation->set_rules( 'fee_amount', 'Fee amount', 'trim|required|integer' );

        if ( $this->form_validation->run() == false ) {
            $this->student_fee_types();
        } else {

            $fee_name = $this->input->post( 'fee_name' );
            $fee_amount = $this->input->post( 'fee_amount' );

            $this->student_fee_type_model->insert( [
                'name' => $fee_name,
                'amount' => $fee_amount
            ] );

            $this->session->set_flashdata( 'msg', "Fee type has been added!" );
            redirect( 'fee_management/student_fee_types' );

        }
    }

    public function student_fee_types_delete( $id = null )
    {
        if ( $id === null ) {
            $this->session->set_flashdata( 'err', "Something went wrong. Please try again!" );
            redirect( 'fee_management/student_fee_types' );
        } else {

            $this->student_fee_type_model->delete( $id );

            $this->session->set_flashdata( 'msg', "Fee type has been deleted!" );
            redirect( 'fee_management/student_fee_types' );

        }
    }

    public function pending_fee_report()
    {
        $this->session->set_userdata( 'top_menu', 'Reports' );
        $this->session->set_userdata( 'sub_menu', 'fee_management/pending_fee_report' );

        $year = $this->input->get( 'year' );
        $year = ( !empty( $year ) ? $year : date( 'Y', now() ) );

        $month = $this->input->get( 'month' );
        $month = ( !empty( $month ) ? $month : date( 'm', now() ) );

        $class_id = $this->input->get( 'class_id' );
        $section_id = $this->input->get( 'section_id' );

        $students_pending_fee = $this->student_model->students_pending_fee( $class_id, $section_id );
      

        for ( $i = 0; $i < count( $students_pending_fee ); $i++ ) {
            $class_update_fee[$i]['fee_update'] = $this->classsection_model->get_class_date($students_pending_fee[$i]['std_details']['class_id']);
            if($class_update_fee[$i]['fee_update'] != null){
                $students_pending_fee[$i]['student_class_fee_after_discount']= floatval($class_update_fee[$i]['fee_update']['previous_class_fee']) - floatval( $students_pending_fee[$i]['discount'] );
            }else{
                $students_pending_fee[$i]['student_class_fee_after_discount'] = floatval( $students_pending_fee[$i]['class_fee'] ) - floatval( $students_pending_fee[$i]['discount'] );
            }
            $students_pending_fee[$i]['student_class_fee_after_discount'] = ( $students_pending_fee[$i]['student_class_fee_after_discount'] >= 0 ? $students_pending_fee[$i]['student_class_fee_after_discount'] : 0 );
        }

        $report_month = date( 'm/Y', now() );
        $data = [
            'title'                 => 'Pending Fee Report',
            'year'                  => $year,
            'report_month'          => $report_month,
            'month'                 => $month,
            'students_pending_fee'  => $students_pending_fee
        ];
        $date                       = "(".$report_month.")";
        $data['print_title']        = "Fee Arrears Report ".$date;

        $this->load->view( 'layout/header', $data );
        $this->load->view( 'fee_management/pending_fee_report', $data );
        $this->load->view( 'layout/footer', $data );
    }

    public function print_fee_payment_receipt( $fee_payment_id = null )
    {
        if ( $fee_payment_id === null ) {
            show_404();
        } else {

            $student_fee_payment = $this->student_fee_payments->get( $fee_payment_id );
            $school_logo = $this->setting_model->getCurrentImage();
            // echo "<pre>";
            // print_r($student_fee_payment);
            // echo "</pre>";exit;
            if ( $student_fee_payment === false ) {
                show_404();
            } else {

                $student_fee_payment['student_fee_payments_other'] = $this->student_fee_payments_other->get( null, $fee_payment_id, "ASC" );
                $student_fee_payment['student'] = $this->student_model->get( $student_fee_payment['student_id'] );
                $data = [
                    'title'                 => "Student Fee Payment Receipt",
                    'student_fee_payment'   => $student_fee_payment,
                    'school_logo'           => $school_logo
                ];

                $this->load->view( 'layout/blank/header', $data );
                $this->load->view( 'fee_management/print_fee_payment_receipt', $data );
                $this->load->view( 'layout/blank/footer', $data );

            }

        }
    }

    public function check_voucher()
    {
        $students_id =  $this->input->post( 'student_id' );
		$month = $this->input->post( 'month' );
		$advance_fee = $this->input->post( 'advance_fee' );
		
		$paid   = array();
        $unpaid = array();
        
        $month_name = '["' . implode ( '","', $month ) . '"]';		
        foreach($students_id as $key=>$student_id){
            $unpaid_students = $this->student_fee_voucher_model->check_unpaid_current_month($student_id,$month_name,$advance_fee);
		    if($unpaid_students == null){
                $paid[$key] = $unpaid_students->id;
            }else{  
			    $unpaid[$key] = $unpaid_students->id;
			}
        }


        $paid = array_values($paid);
        $unpaid = array_values($unpaid);
        $data =array(
          'paid' => $paid,
          'unpaid' => $unpaid,
        );

        
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
    }

    public function check_unpaid_ajax($student_id)
    {
        $student_id   = $this->input->get('student_id');
      
        $unpaid_students = $this->student_fee_voucher_model->get_unpaid($student_id);
        $unpaid = empty($unpaid_students) ? 0 : 1;
        $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($unpaid));
    }


    public function fee_voucher()
    {

        $type = $this->attendencetype_model->get(null,'present');
       

        $title = "Fee Voucher";

        $student_fee_types = $this->student_fee_type_model->get();

        $class_sections = $this->classsection_model->class_sections();

        $student_id = $this->input->get( 'student_id' );
        $vrno = $this->input->get( 'vrno' );

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
        $this->load->view( 'fee_management/fee_voucher', $data );
        $this->load->view( 'layout/footer', $data );
    }

    public function fee_voucher_process()
    {

        $this->load->helper('menu_helper');

        $fee                  = $this->input->post( 'fee' );

        $student_ids          = $this->input->post( 'student_ids' );

        $month_names          = $this->input->post( 'month_names' );

        $voucher_months       =  $this->input->post( 'voucher_months' );
        
        $voucher_months       = ( $voucher_months != null ? intval( $voucher_months ) : 1 ); 
        
        $due_date_check       = $this->input->post( 'due_date_check' );

        $due_date_tuition     = $this->input->post( 'due_date' );

        $due_date_other       = $this->input->post( 'due_date_h_date_other' );

        $due_date_tuition_optional       = $this->input->post( 'due_date_tuition' );
        
       
        $arrears              = $this->input->post( 'arrears' );

        $advance_fee          = $this->input->post( 'advance_fee1' );

        $summer1              = $this->input->post( 'summer' );

        $optional_date = "0000-00-00";

        if(!empty($due_date_tuition_optional)){

           $optional_date = date('Y-m-d',strtotime($due_date_tuition_optional));

        }
     
     
        if (  !empty( $arrears ) && $arrears == '1' && empty( $advance_fee ) ) {

            $due_date = $due_date_tuition;

        }elseif( !empty( $advance_fee ) && $advance_fee == '1' ){
            $time = strtotime($due_date_tuition);
            $due_date = date("m/d/Y", strtotime("+1 month",$time ));
        }else{
            $due_date =  $due_date_other;
        }
        // if due date check is not empty and is equal to 1
        if ( !empty( $due_date_check ) && $due_date_check == '1' ) {
            if ( empty( $due_date ) ) {
                $this->session->set_flashdata( 'err', "Due date not provided." );
                redirect( 'fee_management/fee_voucher' );
            } else {
                $due_date = date( 'Y-m-d', strtotime( $due_date ) );
            }
        } else { // if due date should not be added in the voucher
            $due_date = null;
        }

        $atlease_one_fee_selected = false;
        $arrears_selected = false;
        $student_fee_voucher_ids = [];
        // looping through all of the fee
        foreach ( $fee as $feeItem ) {
            if ( !empty( $arrears ) && $arrears == '1' ) {
                $arrears_selected = true;
            }
            // fee is checked
            if ( !empty( $feeItem['check'] ) && $feeItem['check'] == '1' ) {
                $atlease_one_fee_selected = true;
                break;
            }
        }


        // if no fee is selected
        if ( $atlease_one_fee_selected === false && $arrears_selected === false ) {
            $this->session->set_flashdata( 'err', "No fee type has been selected." );
            redirect( 'fee_management/fee_voucher' );
        }
        // if no student ids are selected
        if ( empty( $student_ids ) ) {
            $this->session->set_flashdata( 'err', "You haven't selected any student or class for assigning fee voucher to." );
            redirect( 'fee_management/fee_voucher' );
        }


        // starting transaction
        $this->db->trans_start();

        $fee_name = "tfee";
        // looping through all of the students
        $count = 0;
        foreach ( $student_ids as $student_id ) {

            $student = $this->student_model->get($student_id);
            
            $class_details = $this->class_model->get($student['class_id']);
            if($student['discount'] == $class_details['fee'] ){
    
            }
            $unpaid_students = $this->student_fee_voucher_model->check_unpaid_current_month($student_id);
            $student_arrears  = $student['fee_arrears'] - $student['late_payment_fee'];
            //////// student have allresdy voucher
          

            // Remove all the arrears in the fee amount
            if (!empty($arrears) && $arrears == '1' && $atlease_one_fee_selected === false) {
                $fee_studen = (floatval($class_details['fee']) - floatval($student['discount']));
                $monthly_fee_voucher  = 0;
                $fee_arrears = floatval($student_arrears  - floatval($fee_studen));
                $advance_fee_voucher  = 0;
            } elseif (!empty($arrears) && $arrears == '1' && $atlease_one_fee_selected == true) {
                $fee_studen = (floatval($class_details['fee']) - floatval($student['discount']));
                if($advance_fee == 1){
                    $voucher_months2  =   $voucher_months - 1;
                    $advance_fee_voucher  =  $fee_studen * $voucher_months2;
                    if ($student_arrears <= $fee_studen) {   ///1000 <= 2500

                        $fee_arrears = 0;
                        $monthly_fee_voucher = (floatval($student_arrears));
                    } else {
                       
                        $monthly_fee_voucher  =  $fee_studen;
                        $fee_arrears = (floatval($student_arrears) - floatval($fee_studen));
                    }

                }else{
                    $advance_fee_voucher = 0;
                    if ($student_arrears <= $fee_studen) {   ///1000 <= 2500
                        $fee_arrears = 0;
                        $monthly_fee_voucher = (floatval($student_arrears));                       
                    } else {
                        
                        $monthly_fee_voucher  =  $fee_studen;
                        $fee_arrears = (floatval($student_arrears) - floatval($fee_studen));
                    }

                }

            }  else {

                $monthly_fee_voucher = 0;
                $fee_arrears = 0;
                $advance_fee_voucher = 0;
            }

            foreach ($fee as $feeItem) {
                // if fee is selected
                if (!empty($feeItem['check']) && $feeItem['check'] == '1') {

                    // if fee item is tuition fee
                    if (strtolower($feeItem['name']) == 'due fee') {
                        $fee_name = "duefee";
                    }
                }
            }
            // tuition fee select        
            if ($fee_name == "duefee" && empty($advance_fee) ) {
                if($class_details['fee'] !=  $student['discount']){
                    if(count($month_names) > 1){
                        $m = count($month_names) - 1;
                        $advance_fee_voucher = $fee_studen * $m;
                    }

                    if ($student['fee_arrears'] > 0) {
                        
                        $expire = date("Y-m-t", now());
                        // insert record in student fee voucher table
                        $this->db->insert('student_fee_voucher', [
                            'student_id' => $student['id'],
                            'total_fee' => 0,
                            'fine' => $student['late_payment_fee'],
                            'monthly_fee' => $monthly_fee_voucher,
                            'advance' => $advance_fee_voucher,
                            'arrears' => $fee_arrears,
                            'month_names' => json_encode($month_names),
                            'created_at' => date('Y-m-d', now()),
                            'due_date' => $due_date,
                            'expire_date' => date('Y-m-d', strtotime($expire)),
                            'due_date_optional' => $optional_date
                        ]);
                        $student_fee_voucher_id = $this->db->insert_id();
                        $total_fee = 0;
                        // looping through all the fee types

                        foreach ($fee as $feeItem) {
                            // if fee is selected
                            if (!empty($feeItem['check']) && $feeItem['check'] == '1') {
                                // if fee item is tuition fee
                                if (strtolower($feeItem['name']) == 'due fee') {
                                    // setting fee amount to 0 for current student's tuition fee
                                    $fee_amount = 0;

                                    // looping for number of months
                                    for ($i = 0; $i < $voucher_months; $i++) {
                                        // Don't add tuition fee if arrears are already in negative
                                        // if ( intval( $student['fee_arrears'] ) < 0 ) {
                                        //     continue;
                                        // }
                                        if ($student['fee_arrears'] >= (floatval($class_details['fee']) - floatval($student['discount']))) {
                                            // adding fee amount for remaining number of months
                                            $fee_amount += (floatval($class_details['fee']) - floatval($student['discount']));
                                        } else {
                                            // adding fee amount for remaining number of months
                                            $fee_amount += $student['fee_arrears'];
                                            $fee_arrears = 0;

                                        }

                                    }
                                } else { // if fee type is other than tuition fee
                                    $fee_amount = floatval($feeItem['amount']);
                                }

                                // if fee amount is not 0
                                if ($fee_amount != 0) {
                                    // add fee in the fee voucher fee type
                                    $this->db->insert('student_fee_voucher_fee_types', [
                                        'student_fee_voucher_id' => $student_fee_voucher_id,
                                        'name' => $feeItem['name'],
                                        'amount' => $fee_amount
                                    ]);
                                }

                                // adding fee amount to total fee
                                $total_fee += floatval($fee_amount);
                            }
                        }

                        // if totoal fee is greater than 0. Means there is something in the fee
                        if ($total_fee > 0) {
                            // adding fee voucher id if it is generated successfully
                            $student_fee_voucher_ids[] = $student_fee_voucher_id;

                            // updating student fee voucher total fee
                            
                            if(count($month_names) > 1){
                            $advance_fee_voucher = 0;
                            }

                            $this->db->update('student_fee_voucher', [
                                'total_fee' => $total_fee + $advance_fee_voucher,
                                'arrears' => $fee_arrears
                            ], [
                                'id' => $student_fee_voucher_id
                            ]);
                        } elseif ($arrears_selected === true) {
                            $student_fee_voucher_ids[] = $student_fee_voucher_id;
                        } else { // There is not fee available
                            // Delete student voucher
                            $this->db->delete('student_fee_voucher', [
                                'id' => $student_fee_voucher_id
                            ]);
                        }
                    }
                }
            // advance fee and arrears check
            } elseif (!empty($advance_fee) && !empty($arrears)) {
              
                if($class_details['fee'] !=  $student['discount']){

                if (!empty($arrears) && $arrears == '1' && !empty($advance_fee)) {
                   

                    if ($fee_arrears > 0) {
                        $advance_arrears = $fee_arrears;
                    } else {
                        $advance_arrears = 0;
                    }

                } elseif (!empty($arrears) && $arrears == '1') {
            
                    $advance_arrears = $fee_arrears - floatval($class_details['fee']) + floatval($student['discount']);
                } else {
            
                    $advance_arrears = 0;
                }
              
              
                $january = 0;
                foreach ($month_names as $month) {
                    if ($month == 'January') {
                        $january = 1;
                    }
                }
                
                                        //  $last_month	=	end($month_names);
                        //                $first_month	=	current($month_names);
                        //                $date_expire = date_parse($first_month);
                        //
                        //                $month_num	= $date_expire['month'];
                        //
                        //                $due_date_days =  date( 'd', strtotime($due_date));
                        //
                        //                if($january != 1 ){
                        //                    $due_years = date( 'Y', now());
                        //                    $month_num	= $date_expire['month'];
                        //                }else{
                        //                    $today = date("d-m-Y");
                        //                    $due_years = date( 'Y', strtotime($today . "1 year"));
                        //                    $month_num	= $january;
                        //                }
                        //                $date_due = date("Y-m-d", strtotime($due_years."-".$month_num."-". $due_date_days));
                        //                $due_date = date('Y-m-d', strtotime($date_due));
                        //
                        //                $expire =date("Y-m-t", strtotime($due_years."-".$month_num."-". $due_date_days));


                $days_in_month = cal_days_in_month(CAL_GREGORIAN, date('m', strtotime('first day of +1 month')), date('Y', now()));
                $expire = date("Y-m-{$days_in_month}", strtotime('first day of +1 month'));
                       
                if($student['fee_arrears'] == 0){
                    $d =  date('F');
                    foreach (array_keys($month_names, $d) as $key) {
                        unset($month_names[$key]);
                    }
                }
       
                // if($student['fee_arrears'] < 0){
                   
                //      if(abs($student['fee_arrears']) == floatval($fee_studen) ){     

                //         $d =  date('F');
                //         foreach (array_keys($month_names, $d) as $key) {
                //             unset($month_names[$key]);
                //         }
                //         $month_names = array_values($month_names);
              
                //         $n  =  date('F',strtotime('first day of +1 month'));
                //         foreach (array_keys($month_names, $n) as $key) {
                //             unset($month_names[$key]);
                //         }
                //         $month_names = array_values($month_names);
                //         $monthly_fee_voucher  = 0;
                //          $n =  count($month_names);

                //         $advance_fee_voucher  = $fee_studen *  $n;  
                   
                //      }elseif(abs($student['fee_arrears']) < floatval($fee_studen)){


                //      }else{


                //      }
                    
                // }
             //  exit;
                $month_names = array_values($month_names);
               




             //   exit;
                // insert record in student fee voucher table

                ///check for 0 value in advance
             
                $this->db->insert('student_fee_voucher', [
                    'student_id' => $student['id'],
                    'total_fee' => 0,
                    'arrears' => $advance_arrears,
                    'advance' => $advance_fee_voucher,
                    'monthly_fee' => $monthly_fee_voucher,
                    'month_names' => json_encode($month_names),
                    'fine' =>$student['late_payment_fee'],
                    'created_at' => date('Y-m-d', now()),
                    'other' => 0,
                    'due_date' => date('Y-m-d', strtotime($due_date)),
                    'expire_date' => date('Y-m-d', strtotime($expire)),
                    'due_date_optional' => $optional_date
                     
                ]);
                $student_fee_voucher_id = $this->db->insert_id();
                $total_fee = 0;
                // looping through all the fee types
                foreach ($fee as $feeItem) {
                    // if fee is selected
                    if (!empty($feeItem['check']) && $feeItem['check'] == '1') {

                        // if fee item is tuition fee
                        if (strtolower($feeItem['name']) == 'tuition fee') {
                            // setting fee amount to 0 for current student's tuition fee
                            $fee_amount = 0;

                            // looping for number of months
                           $student_fee = floatval($class_details['fee']) - floatval($student['discount']);
                                if($student['fee_arrears'] < $student_fee){
                                    $voucher_months3 = $voucher_months - 1;
                                    $du_fee = $student['fee_arrears'];
                                }else{
                                    $du_fee = 0;
                                    $voucher_months3 =  $voucher_months;
                                }

                            for ($i = 0; $i < $voucher_months3; $i++) {
                                // Don't add tuition fee if arrears are already in negative
                                // if ( intval( $student['fee_arrears'] ) < 0 ) {
                                //     continue;
                                // }
                                // adding fee amount for remaining number of months
                                $fee_amount += (floatval($class_details['fee']) - floatval($student['discount']));
                            }
                              $fee_amount = $fee_amount + $du_fee;
                        } else { // if fee type is other than tuition fee
                            $fee_amount = floatval($feeItem['amount']);
                        }

                        // if fee amount is not 0
                        if ($fee_amount != 0) {
                            // add fee in the fee voucher fee type
                            $this->db->insert('student_fee_voucher_fee_types', [
                                'student_fee_voucher_id' => $student_fee_voucher_id,
                                'name' => $feeItem['name'],
                                'amount' => $fee_amount
                            ]);
                        }

                        // adding fee amount to total fee
                        $total_fee += floatval($fee_amount);
                    }
                }

                // if totoal fee is greater than 0. Means there is something in the fee
                if ($total_fee > 0) {
                    // adding fee voucher id if it is generated successfully
                    $student_fee_voucher_ids[] = $student_fee_voucher_id;

                    // updating student fee voucher total fee
                    $this->db->update('student_fee_voucher', [
                        'total_fee' => $total_fee,
                    ], [
                        'id' => $student_fee_voucher_id
                    ]);
                } elseif ($arrears_selected === true) {
                    $student_fee_voucher_ids[] = $student_fee_voucher_id;
                } else { // There is not fee available
                    // Delete student voucher
                    $this->db->delete('student_fee_voucher', [
                        'id' => $student_fee_voucher_id
                    ]);
                }
            }
            
            } else {
                
               $other = 1;
               $expire = date("Y-m-t", now());

               if($summer1 == 1){

                $student_fee = floatval($class_details['fee']) - floatval($student['discount']);
                $other = 0;
                $advance_fee_voucher  =  $student_fee * $voucher_months;
                        $last_month	=	end($month_names);
                        $first_month	=	current($month_names);
                        $date_expire = date_parse($first_month);
        
                        $month_num	= $date_expire['month'];
        
                        $due_date_days =  date( 'd', strtotime($due_date));
        
                        if($january != 1 ){
                            $due_years = date( 'Y', now());
                            $month_num	= $date_expire['month'];
                        }else{
                            $today = date("d-m-Y");
                            $due_years = date( 'Y', strtotime($today . "1 year"));
                            $month_num	= $january;
                        }
                        $date_due = date("Y-m-d", strtotime($due_years."-".$month_num."-". $due_date_days));
                        $due_date = date('Y-m-d', strtotime($date_due));
        
                        $expire =date("Y-m-t", strtotime($due_years."-".$month_num."-". $due_date_days));

                }
                  // insert record in student fee voucher table
                $this->db->insert('student_fee_voucher', [
                    'student_id' => $student['id'],
                    'total_fee' => 0,
                    'monthly_fee' => $monthly_fee_voucher ,
                    'advance' => $advance_fee_voucher,
                    'arrears' => $fee_arrears,
                    'fine' => 0,
                    'month_names' => json_encode($month_names),
                    'created_at' => date('Y-m-d', now()),
                    'other' => $other,
                    'due_date' => date('Y-m-d', strtotime($due_date)),
                    'expire_date' => date('Y-m-d', strtotime($expire)),
                    'due_date_optional' => $optional_date
                     
                ]);
                $student_fee_voucher_id = $this->db->insert_id();
                $total_fee = 0;
                // looping through all the fee types
                foreach ($fee as $feeItem) {
                    // if fee is selected
                    if (!empty($feeItem['check']) && $feeItem['check'] == '1') {

                        // if fee item is tuition fee
                        if (strtolower($feeItem['name']) == 'tuition fee') {
                            // setting fee amount to 0 for current student's tuition fee
                            $fee_amount = 0;

                            // looping for number of months
                            for ($i = 0; $i < $voucher_months; $i++) {
                                // Don't add tuition fee if arrears are already in negative
                                // if ( intval( $student['fee_arrears'] ) < 0 ) {
                                //     continue;
                                // }

                                // adding fee amount for remaining number of months
                                $fee_amount += (floatval($class_details['fee']) - floatval($student['discount']));

                            }
                        } else { // if fee type is other than tuition fee
                            $fee_amount = floatval($feeItem['amount']);
                        }

                        // if fee amount is not 0
                        if ($fee_amount != 0) {
                            // add fee in the fee voucher fee type
                            $this->db->insert('student_fee_voucher_fee_types', [
                                'student_fee_voucher_id' => $student_fee_voucher_id,
                                'name' => $feeItem['name'],
                                'amount' => $fee_amount
                            ]);
                        }

                        // adding fee amount to total fee
                        $total_fee += floatval($fee_amount);
                    }
                }

                // if totoal fee is greater than 0. Means there is something in the fee
                if ($total_fee > 0) {
                    // adding fee voucher id if it is generated successfully
                    $student_fee_voucher_ids[] = $student_fee_voucher_id;

                    // updating student fee voucher total fee
                    $this->db->update('student_fee_voucher', [
                        'total_fee' => $total_fee
                    ], [
                        'id' => $student_fee_voucher_id
                    ]);
                } elseif ($arrears_selected === true) {
                    $student_fee_voucher_ids[] = $student_fee_voucher_id;
                } else { // There is not fee available
                    // Delete student voucher
                    $this->db->delete('student_fee_voucher', [
                        'id' => $student_fee_voucher_id
                    ]);
                }
            }
        
        }

        // completing the transaction
        $this->db->trans_complete();
        $bankcopy = 0;
        $bank_copy = $this->input->post( 'bank_copy' );
        if ( !empty( $bank_copy ) && $bank_copy == '1' ) {
            $bankcopy = 1;
        }

        //exit;
        // if transaction completed successfully
        if ( $this->db->trans_status() === true ) {
            // if some vouchers are generated
            if ( !empty( $student_fee_voucher_ids ) ) {
                $this->session->set_flashdata( 'msg', "Vouchers has been generated" );
                redirect( "fee_management/fee_voucher_print?bankcopy=".$bankcopy."&unpaid=".$count."&fee_voucher_ids=" . urlencode( json_encode( $student_fee_voucher_ids ) ) );
            } else {
                $this->session->set_flashdata( 'err', "No voucher has been generated." );
                redirect( 'fee_management/fee_voucher' );
            }
        } else { // transactions weren't completed successfully
            $this->session->set_flashdata( 'err', "Something went wrong while generating vouchers. Kindly try again." );
            redirect( 'fee_management/fee_voucher' );
        }

    }

    public function fee_voucher_process_other()
    {

        $fee            = $this->input->post( 'fee' );

        $student_ids    = $this->input->post( 'student_ids' );

        $month_names    = $this->input->post( 'month_names' );

        $voucher_months = $this->input->post( 'voucher_months' );

        $voucher_months = ( $voucher_months !== null ? intval( $voucher_months ) : 1 );

        $due_date_check = $this->input->post( 'due_date_check' );

        $due_date       = $this->input->post( 'due_date' );

        $arrears        = $this->input->post( 'arrears' );


        // if due date check is not empty and is equal to 1
        if ( !empty( $due_date_check ) && $due_date_check == '1' ) {
            if ( empty( $due_date ) ) {
                $this->session->set_flashdata( 'err', "Due date not provided." );
                redirect( 'fee_management/fee_voucher' );
            } else {
                $due_date = date( 'Y-m-d', strtotime( $due_date ) );
            }
        } else { // if due date should not be added in the voucher
            $due_date = null;
        }

        $atlease_one_fee_selected = false;
        $arrears_selected = false;

        $student_fee_voucher_ids = [];



        // looping through all of the fee
        foreach ( $fee as $feeItem ) {
            if ( !empty( $arrears ) && $arrears == '1' ) {
                $arrears_selected = true;
            }
            // fee is checked
            if ( !empty( $feeItem['check'] ) && $feeItem['check'] == '1' ) {
                $atlease_one_fee_selected = true;
                break;
            }
        }


        // if no fee is selected
        if ( $atlease_one_fee_selected === false && $arrears_selected === false ) {
            $this->session->set_flashdata( 'err', "No fee type has been selected." );
            redirect( 'fee_management/fee_voucher' );
        }
        // if no student ids are selected
        if ( empty( $student_ids ) ) {
            $this->session->set_flashdata( 'err', "You haven't selected any student or class for assigning fee voucher to." );
            redirect( 'fee_management/fee_voucher' );
        }


        // starting transaction
        $this->db->trans_start();

        $fee_name = "tfee";
        // looping through all of the students
        foreach ( $student_ids as $student_id ) {
            $student        = $this->student_model->get( $student_id );

            $class_details  = $this->class_model->get( $student['class_id'] );


            // Remove all the arrears in the fee amount
            if ( !empty( $arrears ) && $arrears == '1' && $atlease_one_fee_selected === false ) {
                $fee_arrears = floatval( $student['fee_arrears'] );
            } elseif ( !empty( $arrears ) && $arrears == '1' ) {
                $fee_arrears = ( floatval( $student['fee_arrears'] ) - floatval( $class_details['fee']) + floatval( $student['discount'] ) );
            } else {
                $fee_arrears = 0;
            }

            foreach ( $fee as $feeItem ) {
                // if fee is selected
                if ( !empty( $feeItem['check'] ) && $feeItem['check'] == '1' ) {

                    // if fee item is tuition fee
                    if ( strtolower( $feeItem['name'] ) == 'due fee' ) {
                        $fee_name = "duefee";
                    }
                }
            }


            if ($fee_name == "duefee") {
                if ($student['fee_arrears'] > 0) {

                    // insert record in student fee voucher table
                    $this->db->insert( 'student_fee_voucher', [
                        'student_id' => $student['id'],
                        'total_fee' => 0,
                        'arrears' => $fee_arrears,
                        'month_names' => json_encode( $month_names ),
                        'other' =>    1,
                        'created_at' => date( 'Y-m-d', now() ),
                        'due_date' => $due_date,
                        'expire_date' => 0
                    ] );

                    $student_fee_voucher_id = $this->db->insert_id();


                    $total_fee = 0;
                    // looping through all the fee types
                    foreach ( $fee as $feeItem ) {
                        // if fee is selected
                        if ( !empty( $feeItem['check'] ) && $feeItem['check'] == '1' ) {
                            // if fee item is tuition fee
                            if ( strtolower( $feeItem['name'] ) == 'due fee' ) {
                                // setting fee amount to 0 for current student's tuition fee
                                $fee_amount = 0;

                                // looping for number of months
                                for ( $i = 0; $i < $voucher_months; $i++ ) {
                                    // Don't add tuition fee if arrears are already in negative
                                    // if ( intval( $student['fee_arrears'] ) < 0 ) {
                                    //     continue;
                                    // }
                                    if ($student['fee_arrears'] >= ( floatval( $class_details['fee'] ) - floatval( $student['discount'] ) )) {
                                        // adding fee amount for remaining number of months
                                        $fee_amount += ( floatval( $class_details['fee'] ) - floatval( $student['discount'] ) );
                                    }else{
                                        // adding fee amount for remaining number of months
                                        $fee_amount += $student['fee_arrears'];
                                        $fee_arrears = 0;

                                    }

                                }
                            } else { // if fee type is other than tuition fee
                                $fee_amount = floatval( $feeItem['amount'] );
                            }

                            // if fee amount is not 0
                            if ( $fee_amount != 0 ) {
                                // add fee in the fee voucher fee type
                                $this->db->insert( 'student_fee_voucher_fee_types', [
                                    'student_fee_voucher_id' => $student_fee_voucher_id,
                                    'name'                   => $feeItem['name'],
                                    'amount'                 => $fee_amount
                                ] );
                            }

                            // adding fee amount to total fee
                            $total_fee += floatval( $fee_amount );
                        }
                    }

                    // if totoal fee is greater than 0. Means there is something in the fee
                    if ( $total_fee > 0 ) {
                        // adding fee voucher id if it is generated successfully
                        $student_fee_voucher_ids[] = $student_fee_voucher_id;


                        // updating student fee voucher total fee
                        $this->db->update( 'student_fee_voucher', [
                            'total_fee' => $total_fee,
                            'arrears'   => $fee_arrears
                        ], [
                            'id' => $student_fee_voucher_id
                        ] );
                    } elseif ( $arrears_selected === true ) {
                        $student_fee_voucher_ids[] = $student_fee_voucher_id;
                    } else { // There is not fee available
                        // Delete student voucher
                        $this->db->delete( 'student_fee_voucher', [
                            'id' => $student_fee_voucher_id
                        ] );
                    }
                }
            }else{

                // insert record in student fee voucher table
                $this->db->insert( 'student_fee_voucher', [
                    'student_id' => $student['id'],
                    'total_fee' => 0,
                    'arrears' => $fee_arrears,
                    'month_names' => json_encode( $month_names ),
                    'other' => 1,
                    'created_at' => date( 'Y-m-d', now() ),
                    'due_date' => $due_date,
                    'expire_date' => 'null'
                ] );


                $student_fee_voucher_id = $this->db->insert_id();


                $total_fee = 0;
                // looping through all the fee types
                foreach ( $fee as $feeItem ) {
                    // if fee is selected
                    if ( !empty( $feeItem['check'] ) && $feeItem['check'] == '1' ) {

                        // if fee item is tuition fee
                        if ( strtolower( $feeItem['name'] ) == 'tuition fee' ) {
                            // setting fee amount to 0 for current student's tuition fee
                            $fee_amount = 0;

                            // looping for number of months
                            for ( $i = 0; $i < $voucher_months; $i++ ) {
                                // Don't add tuition fee if arrears are already in negative
                                // if ( intval( $student['fee_arrears'] ) < 0 ) {
                                //     continue;
                                // }

                                // adding fee amount for remaining number of months
                                $fee_amount += ( floatval( $class_details['fee'] ) - floatval( $student['discount'] ) );

                            }
                        } else { // if fee type is other than tuition fee
                            $fee_amount = floatval( $feeItem['amount'] );
                        }

                        // if fee amount is not 0
                        if ( $fee_amount != 0 ) {
                            // add fee in the fee voucher fee type
                            $this->db->insert( 'student_fee_voucher_fee_types', [
                                'student_fee_voucher_id' => $student_fee_voucher_id,
                                'name' => $feeItem['name'],
                                'amount' => $fee_amount
                            ] );
                        }

                        // adding fee amount to total fee
                        $total_fee += floatval( $fee_amount );
                    }
                }

                // if totoal fee is greater than 0. Means there is something in the fee
                if ( $total_fee > 0 ) {
                    // adding fee voucher id if it is generated successfully
                    $student_fee_voucher_ids[] = $student_fee_voucher_id;

                    // updating student fee voucher total fee
                    $this->db->update( 'student_fee_voucher', [
                        'total_fee' => $total_fee
                    ], [
                        'id' => $student_fee_voucher_id
                    ] );
                } elseif ( $arrears_selected === true ) {
                    $student_fee_voucher_ids[] = $student_fee_voucher_id;
                } else { // There is not fee available
                    // Delete student voucher
                    $this->db->delete( 'student_fee_voucher', [
                        'id' => $student_fee_voucher_id
                    ] );
                }
            }

        }

        // completing the transaction
        $this->db->trans_complete();

        $bankcopy = 0;
        $bank_copy = $this->input->post( 'bank_copy' );
        if ( !empty( $bank_copy ) && $bank_copy == '1' ) {
            $bankcopy = 1;
        }

        // if transaction completed successfully
        if ( $this->db->trans_status() === true ) {
            // if some vouchers are generated


            if ( !empty( $student_fee_voucher_ids ) ) {
                $this->session->set_flashdata( 'msg', "Vouchers has been generated" );
                redirect( "fee_management/fee_voucher_print?bankcopy=".$bankcopy."&fee_voucher_ids=" . urlencode( json_encode( $student_fee_voucher_ids ) ) );
            } else {
                $this->session->set_flashdata( 'err', "No voucher has been generated." );
                redirect( 'fee_management/fee_voucher' );
            }
        } else { // transactions weren't completed successfully
            $this->session->set_flashdata( 'err', "Something went wrong while generating vouchers. Kindly try again." );
            redirect( 'fee_management/fee_voucher' );
        }
    }

    public function fee_voucher_print()
    {
        $title = "Fee Vouchers";
        $fee_voucher_ids = $this->input->get( 'fee_voucher_ids' );
        $unpaid = $this->input->get( 'unpaid' );


        // if fee voucher ids contain single numeric ID
        if ( is_numeric( $fee_voucher_ids ) ) {
            $fee_voucher_ids = [$fee_voucher_ids];
        } else {
            $fee_voucher_ids = json_decode( urldecode( $fee_voucher_ids ), true );
        }
        $fee_vouchers = [];
        foreach ( $fee_voucher_ids as $voucher_id ) {
            $__fee_vouchers = $this->student_fee_voucher_model->get( $voucher_id );
            if ( !empty( $__fee_vouchers ) ) {
                $fee_vouchers[] = $__fee_vouchers;
            }
        }
        if ( !empty( $fee_vouchers ) ) {
            for ( $i = 0; $i < count( $fee_vouchers ); $i++ ) {
                $fee_vouchers[$i]['student'] = $this->student_model->get( $fee_vouchers[$i]['student_id'] );
                $fee_vouchers[$i]['other_voucher'] = $this->student_fee_voucher_model->get_unpaid_other( $fee_vouchers[$i]['student_id'] );
            }
        }

       
        $school_name = $this->setting_model->getCurrentSchoolName();
        $school_address = $this->setting_model->getSchoolAddress();

        $school_logo = $this->setting_model->getCurrentImage();
        $student_fee_fine_type = $this->custom_option_model->get( 'student_fee_fine_type' );
        $student_fee_fine_type = $student_fee_fine_type['value'];
        $fine_per_day_for_fee = $this->custom_option_model->get( 'fine_per_day_for_fee' );
        $fine_per_day_for_fee = $fine_per_day_for_fee['value'];
        $bank_account = $this->custom_option_model->get( 'bank_account' );
        $bank_account_other = $this->custom_option_model->get( 'bank_account_other' );
        $bank_account_other = $bank_account_other['value'];
        $bank_account = $bank_account['value'];
        $reprint_fee = $this->custom_option_model->get( 'reprint_fee' );
        $reprint_fee = $reprint_fee['value'];
        $bank_account_top = $this->custom_option_model->get( 'bank_account_top' );
        $bank_account_top = $bank_account_top['value'];
        
        $bank_name = $this->custom_option_model->get( 'bank_name' );
        $bank_name = $bank_name['value'];
        $bankcopy = $this->input->get( 'bankcopy' );

        $data = compact(
            'title',
            'fee_vouchers',
            'school_name',
            'school_address',
            'school_logo',
            'student_fee_fine_type',
            'fine_per_day_for_fee',
            'bank_account',
            'bank_account_top',
            'bank_name',
            'bank_account_other',
            'bankcopy',
            'unpaid',
            'reprint_fee'
        );
        $this->load->view( 'layout/blank/header', $data );
        $this->load->view( 'fee_management/fee_voucher_print', $data );
        $this->load->view( 'layout/blank/footer', $data );
    }

    public function fee_voucher_process2()
    {

        $fee            = $this->input->post( 'fee' );
       
        $student_ids    = $this->input->post_get( 'student_ids' );

        $vrno           = $this->input->get('vrno');
        
        $reprint           = $this->input->get('reprint');

        $month_names    = $this->input->post( 'month_names' );

        $voucher_months = $this->input->post( 'voucher_months' );

        $voucher_months = ( $voucher_months !== null ? intval( $voucher_months ) : 1 );

        $due_date_check1 = $this->input->post( 'due_date_check' );

        $due_date       = $this->input->post( 'due_date' );

        $arrears        = $this->input->post( 'arrears' );
 
     
        // if due date check is not empty and is equal to 1
        if ( !empty( $due_date_check ) && $due_date_check == '1' ) {
            if ( empty( $due_date ) ) {
                $this->session->set_flashdata( 'err', "Due date not provided." );
                redirect( 'fee_management/fee_voucher' );
            } else {
                $due_date = date( 'Y-m-d', strtotime( $due_date ) );
            }
        } else { // if due date should not be added in the voucher
            $due_date = null;
        }

        $atlease_one_fee_selected = false;
        $arrears_selected = false;

        $student_fee_voucher_ids = [];


        // looping through all of the fee
        foreach ( $fee as $feeItem ) {
            if ( !empty( $arrears ) && $arrears == '1' ) {
                $arrears_selected = true;
            }
            // fee is checked
            if ( !empty( $feeItem['check'] ) && $feeItem['check'] == '1' ) {
                $atlease_one_fee_selected = true;
                break;
            }
        }


        /*   // if no fee is selected
           if ( $atlease_one_fee_selected === false && $arrears_selected === false ) {
               $this->session->set_flashdata( 'err', "No fee type has been selected." );
              redirect( 'fee_management/fee_voucher' );
           }*/


        //   if no student ids are selected
        if ( empty( $student_ids ) ) {
            $this->session->set_flashdata( 'err', "You haven't selected any student or class for assigning fee voucher to." );
            redirect( 'fee_management/fee_voucher' );
        }


        // starting transaction
        $this->db->trans_start();

        $fee_name = "tfee";
        // looping through all of the students
        foreach ( $student_ids as $student_id ) {
            $student        = $this->student_model->get( $student_id );

            $class_details  = $this->class_model->get( $student['class_id'] );


            // Remove all the arrears in the fee amount
            if ( !empty( $arrears ) && $arrears == '1' && $atlease_one_fee_selected === false ) {
                $fee_arrears = floatval( $student['fee_arrears'] );
            } elseif ( !empty( $arrears ) && $arrears == '1' ) {
                $fee_arrears = ( floatval( $student['fee_arrears'] ) - floatval( $class_details['fee']) + floatval( $student['discount'] ) );
            } else {
                $fee_arrears = 0;
            }

            foreach ( $fee as $feeItem ) {
                // if fee is selected
                if ( !empty( $feeItem['check'] ) && $feeItem['check'] == '1' ) {

                    // if fee item is tuition fee
                    if ( strtolower( $feeItem['name'] ) == 'due fee' ) {
                        $fee_name = "duefee";
                    }
                }
            }


            if ($fee_name == "duefee") {
                if ($student['fee_arrears'] > 0) {
                    $expire = date("Y-m-t", now());

                    // insert record in student fee voucher table
                    $this->db->insert( 'student_fee_voucher', [
                        'student_id' => $student['id'],
                        'total_fee' => 0,
                        'arrears' => $fee_arrears,
                        'month_names' => json_encode( $month_names ),
                        'created_at' => date( 'Y-m-d ', now() ),
                        'due_date' => $due_date,
                        'expire_date' => date( 'Y-m-d', strtotime( $expire ))

                    ] );

                    $student_fee_voucher_id = $this->db->insert_id();


                    $total_fee = 0;
                    // looping through all the fee types
                    foreach ( $fee as $feeItem ) {
                        // if fee is selected
                        if ( !empty( $feeItem['check'] ) && $feeItem['check'] == '1' ) {
                            // if fee item is tuition fee
                            if ( strtolower( $feeItem['name'] ) == 'due fee' ) {
                                // setting fee amount to 0 for current student's tuition fee
                                $fee_amount = 0;

                                // looping for number of months
                                for ( $i = 0; $i < $voucher_months; $i++ ) {
                                    // Don't add tuition fee if arrears are already in negative
                                    // if ( intval( $student['fee_arrears'] ) < 0 ) {
                                    //     continue;
                                    // }
                                    if ($student['fee_arrears'] >= ( floatval( $class_details['fee'] ) - floatval( $student['discount'] ) )) {
                                        // adding fee amount for remaining number of months
                                        $fee_amount += ( floatval( $class_details['fee'] ) - floatval( $student['discount'] ) );
                                    }else{
                                        // adding fee amount for remaining number of months
                                        $fee_amount += $student['fee_arrears'];
                                        $fee_arrears = 0;

                                    }

                                }
                            } else { // if fee type is other than tuition fee
                                $fee_amount = floatval( $feeItem['amount'] );
                            }

                            // if fee amount is not 0
                            if ( $fee_amount != 0 ) {
                                // add fee in the fee voucher fee type
                                $this->db->insert( 'student_fee_voucher_fee_types', [
                                    'student_fee_voucher_id' => $student_fee_voucher_id,
                                    'name'                   => $feeItem['name'],
                                    'amount'                 => $fee_amount
                                ] );
                            }

                            // adding fee amount to total fee
                            $total_fee += floatval( $fee_amount );
                        }
                    }
                    // if totoal fee is greater than 0. Means there is something in the fee
                    if ( $total_fee > 0 ) {
                        // adding fee voucher id if it is generated successfully
                        $student_fee_voucher_ids[] = $student_fee_voucher_id;
                        // updating student fee voucher total fee
                            $this->db->update( 'student_fee_voucher', [
                                'total_fee' => $total_fee,
                                'arrears'   => $fee_arrears
                            ], [
                                'id' => $student_fee_voucher_id
                            ] );
                    } elseif ( $arrears_selected === true ) {
                        $student_fee_voucher_ids[] = $student_fee_voucher_id;
                    } else { // There is not fee available
                        // Delete student voucher
                        $this->db->delete( 'student_fee_voucher', [
                            'id' => $student_fee_voucher_id
                        ] );
                    }
                }
            }else{
                // insert record in student fee voucher table
                $this->db->insert( 'student_fee_voucher', [
                    'student_id' => $student['id'],
                    'total_fee' => 0,
                    'arrears' => $fee_arrears,
                    'month_names' => json_encode( $month_names ),
                    'created_at' => date( 'Y-m-d', now() ),
                    'due_date' => $due_date,
                    'expire_date' => date( 'Y-m-d', strtotime( $expire ))

                ] );


                $student_fee_voucher_id = $this->db->insert_id();


                $total_fee = 0;
                // looping through all the fee types
                foreach ( $fee as $feeItem ) {
                    // if fee is selected
                    if ( !empty( $feeItem['check'] ) && $feeItem['check'] == '1' ) {

                        // if fee item is tuition fee
                        if ( strtolower( $feeItem['name'] ) == 'tuition fee' ) {
                            // setting fee amount to 0 for current student's tuition fee
                            $fee_amount = 0;

                            // looping for number of months
                            for ( $i = 0; $i < $voucher_months; $i++ ) {
                                // Don't add tuition fee if arrears are already in negative
                                // if ( intval( $student['fee_arrears'] ) < 0 ) {
                                //     continue;
                                // }

                                // adding fee amount for remaining number of months
                                $fee_amount += ( floatval( $class_details['fee'] ) - floatval( $student['discount'] ) );

                            }
                        } else { // if fee type is other than tuition fee
                            $fee_amount = floatval( $feeItem['amount'] );
                        }

                        // if fee amount is not 0
                        if ( $fee_amount != 0 ) {
                            // add fee in the fee voucher fee type
                            $this->db->insert( 'student_fee_voucher_fee_types', [
                                'student_fee_voucher_id' => $student_fee_voucher_id,
                                'name' => $feeItem['name'],
                                'amount' => $fee_amount
                            ] );
                        }

                        // adding fee amount to total fee
                        $total_fee += floatval( $fee_amount );
                    }
                }

                // if totoal fee is greater than 0. Means there is something in the fee
                if ( $total_fee > 0 ) {
                    // adding fee voucher id if it is generated successfully
                    $student_fee_voucher_ids[] = $student_fee_voucher_id;

                    // updating student fee voucher total fee
                    $this->db->update( 'student_fee_voucher', [
                        'total_fee' => $total_fee
                    ], [
                        'id' => $student_fee_voucher_id
                    ] );
                } elseif ( $arrears_selected === true ) {
                    $student_fee_voucher_ids[] = $student_fee_voucher_id;
                } else { // There is not fee available
                    // Delete student voucher
                    $this->db->delete( 'student_fee_voucher', [
                        'id' => $student_fee_voucher_id
                    ] );
                }
            }

        }

        // completing the transaction
        $this->db->trans_complete();

        $bankcopy = 0;
        $bank_copy = $this->input->post_get( 'bank_copy' );
        if ( !empty( $bank_copy ) && $bank_copy == '1' ) {
            $bankcopy = 1;
        }

        // if transaction completed successfully
        if ( $this->db->trans_status() === true ) {
            // if some vouchers are generated
            $student_fee_voucher_ids= $vrno;

            if ( !empty( $student_fee_voucher_ids ) ) {

                 $this->load->helper('menu_helper');
                $admind = $this->session->userdata( 'admin' );
                $permission = admin_permission($admind['id']);
               
                if($reprint == 1 && $permission->vr_reprint_fee  == 1){
                   $reprint1 =      "&reprint=1";
                }
                $this->session->set_flashdata( 'msg', "Vouchers has been generated" );
                redirect( "fee_management/fee_voucher_print2?bankcopy=".$bankcopy."&fee_voucher_ids=" . urlencode( json_encode( $student_fee_voucher_ids ) )."&vrno=".$vrno.$reprint1 );
            } else {
                $this->session->set_flashdata( 'err', "No voucher has been generated." );
                redirect( 'fee_management/fee_voucher' );
            }
        }
        else { // transactions weren't completed successfully


            $this->session->set_flashdata( 'err', "Something went wrong while generating vouchers. Kindly try again." );
            redirect( 'fee_management/fee_voucher' );
        }
    }


    public function fee_voucher_delete_all(){

        $voucher_ids    = $this->input->post( 'voucher_ids' );

        print_r($voucher_ids);
        exit;

    }
    
    

    public function fee_voucher_process_all()
    {
        $fee            = $this->input->post( 'fee' );

        $student_ids    = $this->input->post( 'student_ids' );

        $voucher_ids    = $this->input->post( 'voucher_ids' );

        $vrno           = $this->input->get('vrno');

        $month_names    = $this->input->post( 'month_names' );

        $voucher_months = $this->input->post( 'voucher_months' );

        $voucher_months = ( $voucher_months !== null ? intval( $voucher_months ) : 1 );

        $due_date_check1 = $this->input->post( 'due_date_check' );

        $due_date       = $this->input->post( 'due_date' );

        $arrears        = $this->input->post( 'arrears' );


        if($vrno == null){
            $vrno =  $voucher_ids;
        }

        // if due date check is not empty and is equal to 1
        if ( !empty( $due_date_check ) && $due_date_check == '1' ) {
            if ( empty( $due_date ) ) {
                $this->session->set_flashdata( 'err', "Due date not provided." );
                redirect( 'fee_management/fee_voucher' );
            } else {
                $due_date = date( 'Y-m-d', strtotime( $due_date ) );
            }
        } else { // if due date should not be added in the voucher
            $due_date = null;
        }

        $atlease_one_fee_selected = false;
        $arrears_selected = false;

        $student_fee_voucher_ids = [];


        // looping through all of the fee
        foreach ( $fee as $feeItem ) {
            if ( !empty( $arrears ) && $arrears == '1' ) {
                $arrears_selected = true;
            }
            // fee is checked
            if ( !empty( $feeItem['check'] ) && $feeItem['check'] == '1' ) {
                $atlease_one_fee_selected = true;
                break;
            }
        }


        /*   // if no fee is selected
           if ( $atlease_one_fee_selected === false && $arrears_selected === false ) {
               $this->session->set_flashdata( 'err', "No fee type has been selected." );
              redirect( 'fee_management/fee_voucher' );
           }*/


        //   if no student ids are selected
        if ( empty( $student_ids ) ) {
            $this->session->set_flashdata( 'err', "You haven't selected any student or class for assigning fee voucher to." );
            redirect( 'fee_management/fee_voucher' );
        }


        // starting transaction
        $this->db->trans_start();

        $fee_name = "tfee";
        // looping through all of the students
        foreach ( $student_ids as $student_id ) {
            $student        = $this->student_model->get( $student_id );

            $class_details  = $this->class_model->get( $student['class_id'] );


            // Remove all the arrears in the fee amount
            if ( !empty( $arrears ) && $arrears == '1' && $atlease_one_fee_selected === false ) {
                $fee_arrears = floatval( $student['fee_arrears'] );
            } elseif ( !empty( $arrears ) && $arrears == '1' ) {
                $fee_arrears = ( floatval( $student['fee_arrears'] ) - floatval( $class_details['fee']) + floatval( $student['discount'] ) );
            } else {
                $fee_arrears = 0;
            }

            foreach ( $fee as $feeItem ) {
                // if fee is selected
                if ( !empty( $feeItem['check'] ) && $feeItem['check'] == '1' ) {

                    // if fee item is tuition fee
                    if ( strtolower( $feeItem['name'] ) == 'due fee' ) {
                        $fee_name = "duefee";
                    }
                }
            }


            if ($fee_name == "duefee") {
                if ($student['fee_arrears'] > 0) {

                    // insert record in student fee voucher table
                    $this->db->insert( 'student_fee_voucher', [
                        'student_id' => $student['id'],
                        'total_fee' => 0,
                        'arrears' => $fee_arrears,
                        'month_names' => json_encode( $month_names ),
                        'created_at' => date( 'Y-m-d ', now() ),
                        'due_date' => $due_date
                    ] );

                    $student_fee_voucher_id = $this->db->insert_id();


                    $total_fee = 0;
                    // looping through all the fee types
                    foreach ( $fee as $feeItem ) {
                        // if fee is selected
                        if ( !empty( $feeItem['check'] ) && $feeItem['check'] == '1' ) {
                            // if fee item is tuition fee
                            if ( strtolower( $feeItem['name'] ) == 'due fee' ) {
                                // setting fee amount to 0 for current student's tuition fee
                                $fee_amount = 0;

                                // looping for number of months
                                for ( $i = 0; $i < $voucher_months; $i++ ) {
                                    // Don't add tuition fee if arrears are already in negative
                                    // if ( intval( $student['fee_arrears'] ) < 0 ) {
                                    //     continue;
                                    // }
                                    if ($student['fee_arrears'] >= ( floatval( $class_details['fee'] ) - floatval( $student['discount'] ) )) {
                                        // adding fee amount for remaining number of months
                                        $fee_amount += ( floatval( $class_details['fee'] ) - floatval( $student['discount'] ) );
                                    }else{
                                        // adding fee amount for remaining number of months
                                        $fee_amount += $student['fee_arrears'];
                                        $fee_arrears = 0;

                                    }

                                }
                            } else { // if fee type is other than tuition fee
                                $fee_amount = floatval( $feeItem['amount'] );
                            }

                            // if fee amount is not 0
                            if ( $fee_amount != 0 ) {
                                // add fee in the fee voucher fee type
                                $this->db->insert( 'student_fee_voucher_fee_types', [
                                    'student_fee_voucher_id' => $student_fee_voucher_id,
                                    'name'                   => $feeItem['name'],
                                    'amount'                 => $fee_amount
                                ] );
                            }

                            // adding fee amount to total fee
                            $total_fee += floatval( $fee_amount );
                        }
                    }

                    // if totoal fee is greater than 0. Means there is something in the fee
                    if ( $total_fee > 0 ) {
                        // adding fee voucher id if it is generated successfully
                        $student_fee_voucher_ids[] = $student_fee_voucher_id;



                        // updating student fee voucher total fee
                        $this->db->update( 'student_fee_voucher', [
                            'total_fee' => $total_fee,
                            'arrears'   => $fee_arrears
                        ], [
                            'id' => $student_fee_voucher_id
                        ] );
                    } elseif ( $arrears_selected === true ) {
                        $student_fee_voucher_ids[] = $student_fee_voucher_id;
                    } else { // There is not fee available
                        // Delete student voucher
                        $this->db->delete( 'student_fee_voucher', [
                            'id' => $student_fee_voucher_id
                        ] );
                    }
                }
            }else{

                // insert record in student fee voucher table
                $this->db->insert( 'student_fee_voucher', [
                    'student_id' => $student['id'],
                    'total_fee' => 0,
                    'arrears' => $fee_arrears,
                    'month_names' => json_encode( $month_names ),
                    'created_at' => date( 'Y-m-d', now() ),
                    'due_date' => $due_date
                ] );
                $student_fee_voucher_id = $this->db->insert_id();
                $total_fee = 0;
                // looping through all the fee types
                foreach ( $fee as $feeItem ) {
                    // if fee is selected
                    if ( !empty( $feeItem['check'] ) && $feeItem['check'] == '1' ) {

                        // if fee item is tuition fee
                        if ( strtolower( $feeItem['name'] ) == 'tuition fee' ) {
                            // setting fee amount to 0 for current student's tuition fee
                            $fee_amount = 0;

                            // looping for number of months
                            for ( $i = 0; $i < $voucher_months; $i++ ) {
                                // Don't add tuition fee if arrears are already in negative
                                // if ( intval( $student['fee_arrears'] ) < 0 ) {
                                //     continue;
                                // }

                                // adding fee amount for remaining number of months
                                $fee_amount += ( floatval( $class_details['fee'] ) - floatval( $student['discount'] ) );

                            }
                        } else { // if fee type is other than tuition fee
                            $fee_amount = floatval( $feeItem['amount'] );
                        }

                        // if fee amount is not 0
                        if ( $fee_amount != 0 ) {
                            // add fee in the fee voucher fee type
                            $this->db->insert( 'student_fee_voucher_fee_types', [
                                'student_fee_voucher_id' => $student_fee_voucher_id,
                                'name' => $feeItem['name'],
                                'amount' => $fee_amount
                            ] );
                        }

                        // adding fee amount to total fee
                        $total_fee += floatval( $fee_amount );
                    }
                }

                // if totoal fee is greater than 0. Means there is something in the fee
                if ( $total_fee > 0 ) {
                    // adding fee voucher id if it is generated successfully
                    $student_fee_voucher_ids[] = $student_fee_voucher_id;

                    // updating student fee voucher total fee
                    $this->db->update( 'student_fee_voucher', [
                        'total_fee' => $total_fee
                    ], [
                        'id' => $student_fee_voucher_id
                    ] );
                } elseif ( $arrears_selected === true ) {
                    $student_fee_voucher_ids[] = $student_fee_voucher_id;
                } else { // There is not fee available
                    // Delete student voucher
                    $this->db->delete( 'student_fee_voucher', [
                        'id' => $student_fee_voucher_id
                    ] );
                }
            }

        }

        // completing the transaction
        $this->db->trans_complete();

        $bankcopy = 0;
        $bank_copy = $this->input->post( 'bank_copy' );
        if ( !empty( $bank_copy ) && $bank_copy == '1' ) {
            $bankcopy = 1;
        }

        // if transaction completed successfully
        if ( $this->db->trans_status() === true ) {
            // if some vouchers are generated
            $student_fee_voucher_ids= $vrno;

            if ( !empty( $student_fee_voucher_ids ) ) {
                $this->session->set_flashdata( 'msg', "Vouchers has been generated" );
                redirect( "fee_management/fee_voucher_print?bankcopy=".$bankcopy."&fee_voucher_ids=" . urlencode( json_encode( $student_fee_voucher_ids ) )."&vrno=".$vrno );
            } else {
                $this->session->set_flashdata( 'err', "No voucher has been generated." );
                redirect( 'fee_management/fee_voucher' );
            }
        }
        else { // transactions weren't completed successfully


            $this->session->set_flashdata( 'err', "Something went wrong while generating vouchers. Kindly try again." );
            redirect( 'fee_management/fee_voucher' );
        }
    }

    public function fee_voucher_print2()
    {
        $title = "Fee Vouchers";

        $fee_voucher_ids = $this->input->get( 'vrno' );

        $vrno = $this->input->get( 'vrno' );
        $reprint = $this->input->get( 'reprint' );
        if($reprint == 1 ){
            $this->db->update( 'student_fee_voucher', [
             'reprint' => 1
         ], [
             'id' => $vrno
         ] );     
         }

        $unpaid_fee_types = $this->student_fee_voucher_fee_types_model->get_unpaid_fee_types($vrno);
 
        // if fee voucher ids contain single numeric ID
        if ( is_numeric( $fee_voucher_ids ) ) {
            $fee_voucher_ids = [$fee_voucher_ids];
        } else {
            $fee_voucher_ids = json_decode( urldecode( $fee_voucher_ids ), true );
        }


        $fee_vouchers = [];
        foreach ( $fee_voucher_ids as $voucher_id ) {
            $__fee_vouchers = $this->student_fee_voucher_model->get($voucher_id );

            if ( !empty( $__fee_vouchers ) ) {
                $fee_vouchers[] = $__fee_vouchers;

            }
        }



        if ( !empty( $fee_vouchers ) ) {
            for ( $i = 0; $i < count( $fee_vouchers ); $i++ ) {
                $fee_vouchers[$i]['student'] = $this->student_model->get( $fee_vouchers[$i]['student_id'] );
                $fee_vouchers[$i]['other_voucher'] = $this->student_fee_voucher_model->get_unpaid_other( $fee_vouchers[$i]['student_id'] );
            }
        }

        $school_name = $this->setting_model->getCurrentSchoolName();
        $school_address = $this->setting_model->getSchoolAddress();
        $school_logo = $this->setting_model->getCurrentImage();
        $student_fee_fine_type = $this->custom_option_model->get( 'student_fee_fine_type' );
        $student_fee_fine_type = $student_fee_fine_type['value'];
        $fine_per_day_for_fee = $this->custom_option_model->get( 'fine_per_day_for_fee' );
        $fine_per_day_for_fee = $fine_per_day_for_fee['value'];
        $bank_account = $this->custom_option_model->get( 'bank_account' );
        $bank_account_other = $this->custom_option_model->get( 'bank_account_other' );
        $bank_account_other = $bank_account_other['value'];
        $bank_account = $bank_account['value'];
        $bank_account_top = $this->custom_option_model->get( 'bank_account_top' );
        $bank_account_top = $bank_account_top['value'];
        $bank_name = $this->custom_option_model->get( 'bank_name' );
        $bank_name = $bank_name['value'];
        $bankcopy = $this->input->get( 'bankcopy' );
        $reprint_fee = $this->custom_option_model->get( 'reprint_fee' );
        $reprint_fee = $reprint_fee['value'];
       
        $data = compact(
            'title',
            'fee_vouchers',
            'school_name',
            'school_address',
            'school_logo',
            'student_fee_fine_type',
            'fine_per_day_for_fee',
            'bank_account',
            'bank_account_top',
            'bank_name',
            'bank_account_other',
            'bankcopy',
            'vrno',
            'reprint_fee',
            'unpaid_fee_types'
        );



        $this->load->view( 'layout/blank/header', $data );
        $this->load->view( 'fee_management/fee_voucher_printold', $data );
        $this->load->view( 'layout/blank/footer', $data );
    }

    public function fee_voucher_receive()
    {
        $voucher_id = $this->input->get( 'voucher_id' );
        $redirect = $this->input->get( 'redirect' );
        $redirect = ( $redirect !== null ? urldecode( $redirect ) : "fee_management/fee_voucher" );


        //pp($redirect.'?paid=1');

        $voucher_details = $this->student_fee_voucher_model->get( $voucher_id );

        if ( $voucher_details === null ) {
            $this->session->set_flashdata( 'err', "Voucher doesn't exists." );
            $this->session->set_flashdata( 'Voucher_error', "Voucher doesn't exists." );
            redirect( $redirect );
        } else {
            // if voucher is already paid
            if ( $voucher_details['paid'] == 1 ) {
                $this->session->set_flashdata( 'err', "Voucher has already been paid." );
                $this->session->set_flashdata( 'Voucher_error', "Voucher has already been paid." );
                redirect( $redirect );
            } else {
                redirect( "fee_management/receive_fee/{$voucher_details['student_id']}?voucher_id={$voucher_details['id']}" );

            }
        }
    }

    public function student_account()
    {

        $student_id = $this->input->get( 'search_text' );


        $redirect = $this->input->get( 'redirect' );

        $redirect = ( $redirect !== null ? urldecode( $redirect ) : "balance_sheet" );

        $student = $this->student_model->get_balance_sheet($student_id  );

        if ( empty($student) ) {

            $this->session->set_flashdata( 'err', "Student Admission no is not valid." );
            $this->session->set_flashdata( 'expense_err', "Student Admission no is not valid." );
            redirect("balance_sheet" );

        } else {
            // if voucher is already paid


            redirect( "fee_management/receive_fee?search_text={$student_id}" );

        }
    }

}