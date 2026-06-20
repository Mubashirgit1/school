<?php

if ( !defined( 'BASEPATH' ) )
    exit( 'No direct script access allowed' );

class Student_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->current_session = $this->setting_model->getCurrentSession();
        $this->current_date = $this->setting_model->getDateYmd();

        $this->load->model( 'student_fee_payments' );
        $this->load->model( 'student_advance' );

        //$this->keepUpdatingStudentFee();
        //$this->keepUpdatingLatePaymentFee();
    }

    public function keepUpdatingStudentFee()
    {


        $students = $this->getStudentsWithFeeUpdatedDate();
        $discount_update_student =$this->getStudentsDiscountUpdate();
        foreach($discount_update_student as  $update_discount){
            $data = array(
                'discount' =>  $update_discount['latest_discount']
            );
            $update = $this->student_model->updateDues( $update_discount['student_id'], $data );
        }   
      
        if ( $students !== false ) {

            foreach ( $students as $student ) {

                // if student fee starting date is null or current date is greater or equal to fee starting date
                if ( $student['fee_starting_date'] === null || now() >= strtotime( $student['fee_starting_date'] ) ) {
                    // get fee of the class
                    $student_fee = $this->getStudentFee( $student['id'] );
                    $student_fee = ( $student_fee === false ? 0 : $student_fee['fee'] );

                    // subtract discount from it
                    $student_fee = $student_fee - intval( $student['discount'] );

                    // add fee to the fee arrears
                    $fee_arrears = intval( $student['fee_arrears'] ) + $student_fee;

                    $data = array(
                        'fee_update_date' => date( 'Y-m-01', now() ),
                        'fee_arrears' => $fee_arrears
                    );

                    $this->db->update( 'students', $data, [
                        'id' => $student['id']
                    ] );
                }

            }

        }
    }

    public function getStudentsWithFeeUpdatedDate()
    {
        $q = $this->db->select( "*" )
            ->from( 'students' )
            ->where( 'YEAR(`fee_update_date`) <', date( 'Y', now() ) )
            ->or_where( 'MONTH(`fee_update_date`) <', date( 'm', now() ) )
            ->get();

        if ( $q->num_rows() > 0 ) {
            return $q->result_array();
        } else {
            return false;
        }
    }
    public function getStudentsDiscountUpdate()
    {
        $q = $this->db->query('SELECT *
        FROM (
            SELECT student_id, MAX(id) as id , `date`, `status`  , latest_discount
            FROM discount_history WHERE  YEAR(`date`) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH)
            && `status` = 1
            GROUP BY student_id DESC ) as ids 
        ORDER BY student_id');
        if ( $q->num_rows() > 0 ) {
            return $q   ->result_array();
        } else {
            return false;
        }
    }
    public function getsessionstudent($student_session_id)
    {
        $q = $this->db->select( "student_id" )
            ->from( 'student_session' )
            ->where( 'id', $student_session_id)
            ->get();

        if ( $q->num_rows() > 0 ) {
            return $q->row();
        } else {
            return false;
        }
    }
    public function getId($admission_no)
    {
        $q = $this->db->select( "id" )
            ->from( 'students' )
            ->where( 'admission_no', $admission_no)
            ->get();

        if ( $q->num_rows() > 0 ) {
            return $q->row();
        } else {
            return false;
        }
    }

    public function leaveAttendence($data)
    {
       $this->db->insert( 'advance_leave', $data );
        return $this->db->insert_id();
        
    }

    public function leave_delete( $id )
    {
        $this->db->where( 'id', $id );
        $del = $this->db->delete( 'advance_leave' );
        if($del){
            return true;
        }else{
            return false;
        }
        
    }
    public function checkAttendenceDate($student_id= null, $date = null){

        $q = $this->db->select( '*' )
        ->from( 'student_attendences' );
        if($date != null){
            $this->db->where( 'date', date("Y-m-d",strtotime($date) ));
        }
        if($student_id != null){
            $this->db->where( 'student_session_id', $student_id );
        }
        $q =  $this->db->get();
        return $q->row_array();
    }

    public function getAdvanceLeave($date_from = null ,$date_to = null ){
        $q = $this->db->select( '*' )
        ->from( 'advance_leave' );
        if(empty($date_from) &&  empty($date_to)){
        $this->db->where( 'created_at >=', date("Y-m-1",now()) );    
        }
        
        if($date_from != null){
           $this->db->where( 'date_from >=', date("Y-m-d",strtotime($date_from) ));
        }
        if($date_to != null){
            $this->db->where( 'date_to <=', date("Y-m-d", strtotime($date_to)) );
        }
        $q =  $this->db->get();
        return $q->result_array();
    }
    public function getStudentFee( $id )
    {
        $q = $this->db->select( 'classes.fee' )
            ->from( 'students' )
            ->join( 'student_session', 'student_session.student_id = students.id', 'inner' )
            ->join( 'sch_settings', 'sch_settings.session_id = student_session.session_id', 'inner' )
            ->join( 'classes', 'classes.id = student_session.class_id', 'inner' )
            ->where( 'students.id', $id )
            ->get();

        if ( $q->num_rows() > 0 ) {
            return $q->row_array();
        } else {
            return false;
        }
    }

    /**
     * This funtion takes id as a parameter and will fetch the record.
     * If id is not provided, then it will fetch all the records form the table.
     * @param int $id
     * @return mixed
     */

    public function getReceiptInfo( $rid )
    {
        $query = $this->db->select( '*' )->from( 'fee_voucher_saved' )->where( 'voucher_id', $rid )->get();
        $results = $query->result();
        return $results;
    }

    public function GetStudentid( $id )
    {
        $query = $this->db->select( '*' )->from( 'students' )->where( 'id', $id )->get();
        $results = $query->row_array();
        return $results;
    }

    public function pkGetStudent( $id )
    {
        $query = $this->db->select( '*' )->from( 'students' )->where( 'id', $id )->get();
        $results = $query->result();
        return $results;
    }

    public function pksave_voucher( $data )
    {
        $this->db->insert( 'fee_voucher_saved', $data );
        return true;
    }

    public function getLastVoucherNumber()
    {
        $result = $this->db->select( 'MAX(voucher_id) AS max_vid' )->from( 'fee_voucher_saved' )->get();
        return $result->result();
    }

    public function getStudents( $id = null , $forwhat = null)
    {
        $this->db->select( 'classes.id AS `class_id`,student_session.id as student_session_id,students.id,classes.class,classes.fee,sections.id AS `section_id`,sections.section,students.id,students.admission_no , students.roll_no,students.admission_date,students.firstname,  students.lastname,students.image,    students.mobileno, students.email ,students.state ,   students.city , students.pincode ,     students.religion,     students.dob ,students.current_address,    students.permanent_address,IFNULL(students.category_id, 0) as `category_id`,IFNULL(categories.category, "") as `category`,students.adhar_no,students.samagra_id,students.bank_account_no,students.bank_name, students.ifsc_code , students.guardian_name , students.guardian_relation,students.guardian_phone,students.guardian_address,students.is_active ,students.created_at ,students.updated_at,students.father_name,students.rte,students.gender,users.id as `user_tbl_id`,users.username,users.password as `user_tbl_password`,users.is_active as `user_tbl_active`, students.father_phone, students.fee_arrears, students.discount' )->from( 'students' );
        $this->db->join( 'student_session', 'student_session.student_id = students.id' );
        $this->db->join( 'classes', 'student_session.class_id = classes.id' );
        $this->db->join( 'sections', 'sections.id = student_session.section_id' );
        $this->db->join( 'categories', 'students.category_id = categories.id', 'left' );
        $this->db->join( 'users', 'users.user_id = students.id', 'left' );
        $this->db->where( 'student_session.session_id', $this->current_session );
        $this->db->where( 'users.role', 'student' );
        // $this->db->where( 'students.struck_off' , 0 );

       // $next_month = date("Y-m-d",strtotime("first day of +1 month"));
       // $this->db->where("(students.updated_at >= '$next_month' OR students.updated_at  = '0000-00-00 00:00:00')");
        // $this->db->where( 'students.is_active', "yes" );

        if ( $id !== null ) {
            $this->db->where( 'students.id', $id );
        }
        $this->db->order_by( 'students.id' );

        $query = $this->db->get();

        if ( $id !== null ) {
            return $query->row_array();
        } else {
            return $query->result_array();
        }
    }

    public function getstudent_id($id = null){

        $query = $this->db->query( 'select id from students' );


        return $query->result_array();


    }

    public function searchByClass( $class_id = null )
    {
        $this->db->select( 'classes.id AS `class_id`, sections.id AS `sections_id`, classes.fee as class_fee,student_session.id as student_session_id,students.id,students.fee_arrears' )
            ->from( 'students' );
        $this->db->join( 'student_session', 'student_session.student_id = students.id' );
        $this->db->join( 'classes', 'student_session.class_id = classes.id' );
        $this->db->join( 'sections', 'sections.id = student_session.section_id' );
        $this->db->join( 'categories', 'students.category_id = categories.id', 'left' );
        $this->db->where( 'student_session.session_id', $this->current_session );

        if ( $class_id != null ) {
            $this->db->where( 'student_session.class_id', $class_id );
            $next_month = date("Y-m-d",strtotime("first day of +1 month"));
            $this->db->where("(students.updated_at >= '$next_month' OR students.updated_at  = '0000-00-00 00:00:00' OR students.updated_at IS Null)");
        }

        $this->db->order_by( 'classes.id' );
        $query = $this->db->get();

        return $query->result_array();
    }

    public function getRecentRecord( $id = null )
    {
        $this->db->select( 'classes.id AS `class_id`,classes.class,sections.id AS `section_id`,sections.section,students.id,students.admission_no , students.roll_no,students.admission_date,students.firstname,  students.lastname,students.image,    students.mobileno, students.email ,students.state ,   students.city , students.pincode ,     students.religion,     students.dob ,students.current_address,    students.permanent_address,students.category_id,    students.adhar_no,students.samagra_id,students.bank_account_no,students.bank_name, students.ifsc_code , students.guardian_name , students.guardian_relation,students.guardian_phone,students.guardian_address,students.is_active ,students.created_at ,students.updated_at,students.father_name,students.father_phone,students.father_occupation,students.mother_name,students.mother_phone,students.mother_occupation,students.guardian_occupation,students.gender,students.guardian_is' )->from( 'students' );
        $this->db->join( 'student_session', 'student_session.student_id = students.id' );
        $this->db->join( 'classes', 'student_session.class_id = classes.id' );
        $this->db->join( 'sections', 'sections.id = student_session.section_id' );
        $this->db->where( 'student_session.session_id', $this->current_session );
        if ( $id != null ) {
            $this->db->where( 'students.id', $id );
        } else {

        }
        $this->db->order_by( 'students.id', 'desc' );
        $this->db->limit( 5 );
        $query = $this->db->get();
        if ( $id != null ) {
            return $query->row_array();
        } else {
            return $query->result_array();
        }
    }

    public function search_student( $id = null, $admission_no = null )
    {
        $this->db->select( 'student_session.id AS student_session_id, classes.id AS `class_id`,classes.class,sections.id AS `section_id`,sections.section,students.id,students.admission_no , students.roll_no,students.admission_date,students.firstname,  students.lastname,students.image,    students.mobileno, students.email ,students.state ,   students.city , students.pincode ,     students.religion,     students.dob ,students.current_address,    students.permanent_address,students.category_id,    students.adhar_no,students.samagra_id,students.bank_account_no,students.bank_name, students.ifsc_code , students.guardian_name , students.guardian_relation,students.guardian_phone,students.guardian_address,students.is_active ,students.created_at ,students.updated_at,students.father_name,students.father_phone,students.father_occupation,students.mother_name,students.mother_phone,students.mother_occupation,students.guardian_occupation, students.gender' )->from( 'students' );
        $this->db->join( 'student_session', 'student_session.student_id = students.id' );
        $this->db->join( 'classes', 'student_session.class_id = classes.id' );
        $this->db->join( 'sections', 'sections.id = student_session.section_id' );
        $this->db->where( 'student_session.session_id', $this->current_session );
        if ( $id != null ) {
            $this->db->where( 'students.id', $id );
        } else {
            $this->db->order_by( 'students.id' );
        }
        if ( $admission_no !== null ) {
            $this->db->where( 'admission_no', $admission_no );
        }
        $query = $this->db->get();
        if ( $id !== null || $admission_no !== null ) {
            return $query->row_array();
        } else {
            return $query->result_array();
        }
    }

    public function getstudentdoc( $id )
    {
        $this->db->select()->from( 'student_doc' );
        $this->db->where( 'student_id', $id );
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * @param null $class_id
     * @param null $section_id
     * @param null $gender
     * @param null $fee_status can be 'advance' or due
     * @param array|string|int $excluded_student_ids
     * @return array
     */
    public function searchByClassSection( $class_id = null, $section_id = null, $gender = null, $fee_status = null, $excluded_student_ids = null , $order = null,$session_id =null, $where_not_in_id = null)
    {
        $this->db->select( 'classes.id AS `class_id`,class_sections.order_by, classes.fee as class_fee,student_session.id as student_session_id,students.id,classes.class,sections.id AS `section_id`,sections.section,students.id,students.admission_no , students.roll_no,students.admission_date,students.firstname,  students.lastname,students.image,    students.mobileno, students.email ,students.state ,   students.city , students.pincode ,students.fee_arrears,students.late_payment_fee,     students.religion,     students.dob ,students.current_address,    students.permanent_address,IFNULL(students.category_id, 0) as `category_id`,IFNULL(categories.category, "") as `category`,students.adhar_no,students.samagra_id,students.bank_account_no,students.bank_name, students.ifsc_code , students.guardian_name , students.guardian_relation,students.guardian_phone,students.guardian_address,students.is_active ,students.created_at ,students.updated_at,students.father_name,students.father_phone,students.rte,students.gender, students.fee_arrears, students.father_cnic,students.struck_off, students.discount, students.late_payment_fee' )
            ->from( 'students' );
        $this->db->join( 'student_session', 'student_session.student_id = students.id' );
        $this->db->join( 'classes', 'student_session.class_id = classes.id' );
        $this->db->join( 'sections', 'sections.id = student_session.section_id' );
        $this->db->join( 'categories', 'students.category_id = categories.id', 'left' );
        $this->db->select("class_sections.order_by as section_order");
        $this->db->join( 'class_sections', 'student_session.section_id = class_sections.section_id and student_session.class_id=class_sections.class_id', "left" );
        
        
        if($session_id != null){

            $this->db->where( 'student_session.session_id', $session_id );
       
        }else{
            $this->db->where( 'student_session.session_id', $this->current_session );
        }
        
        if ( $class_id != null ) {
            $this->db->where( 'student_session.class_id', $class_id );
            $next_month = date("Y-m-d",strtotime("first day of this month"));
            $this->db->where("(students.updated_at >= '$next_month' OR students.updated_at  = '0000-00-00 00:00:00' OR students.updated_at IS Null)");
        }else{
            $next_month = date("Y-m-d",strtotime("first day of this month"));
            $this->db->where("(students.updated_at >= '$next_month' OR students.updated_at  = '0000-00-00 00:00:00' OR students.updated_at IS Null)");
        }
        if($order != null){
            $this->db->order_by( 'students.discount', 'asc' );

        }
        if ( $section_id != null ) {
            $this->db->where( 'student_session.section_id', $section_id );
        }
        if ( !empty( $gender ) ) {
            $this->db->where( 'LOWER(students.gender)', $gender );
        }
        
        
        if ( $fee_status !== null ) {
            switch ( $fee_status ) {
                case "advance":
                    $this->db->where( 'students.fee_arrears <', 0 );
                    break;
                case "due":
                    $this->db->where( 'students.fee_arrears >', 0 );
                    break;
                case "undue":
                    $this->db->where( 'students.fee_arrears <', 0 );
                    break;
            }
        }
       
        if ( $excluded_student_ids !== null ) {
            if ( is_array( $excluded_student_ids ) ) {
                $this->db->where_not_in( 'students.id', $excluded_student_ids );
            } else {
                $this->db->where( 'students.id !=', $excluded_student_ids );
            }
        }
        if(!$order){
            $this->db->order_by("class_sections.order_by", "asc");
        }
        if($where_not_in_id){
            $this->db->where_not_in("students.id", $where_not_in_id);
        }
        
        $query = $this->db->get();
        
        return $query->result_array();
    }

    public function get_roll($class_id = null, $section_id = null)
    {
        $this->db->select('*')->from('student_session');
        $this->db->where('class_id',$class_id );
        $this->db->where('section_id', $section_id);
        $student_id =	$this->db->select_max('student_id');

        $query = $this->db->get();
        return $query->row_array();

    }

    public function current_month_payments()
    {
        $this->db->select('*')->from('student_fee_payments');
        $this->db->where('month(payment_date)', date('m'));
        $this->db->where('year(payment_date)', date('Y'));
        $query = $this->db->get();
        return $query->result_array();
    }

    public function searchByClassSectionCategoryGenderRte( $class_id = null, $section_id = null
        , $category = null, $gender = null, $rte = null )
    {
        $this->db->select( 'classes.id AS `class_id`,student_session.id as student_session_id,students.id,classes.class,sections.id AS `section_id`,sections.section,students.id,students.admission_no , students.roll_no,students.admission_date,students.firstname,  students.lastname,students.image,    students.mobileno, students.email ,students.state ,   students.city , students.pincode ,     students.religion,     students.dob ,students.current_address,    students.permanent_address,students.category_id, categories.category,   students.adhar_no,students.samagra_id,students.bank_account_no,students.bank_name, students.ifsc_code , students.guardian_name , students.guardian_relation,students.guardian_phone,students.guardian_address,students.is_active ,students.created_at ,students.updated_at,students.father_name,students.rte,students.gender' )->from( 'students' );
        $this->db->join( 'student_session', 'student_session.student_id = students.id' );
        $this->db->join( 'classes', 'student_session.class_id = classes.id' );
        $this->db->join( 'sections', 'sections.id = student_session.section_id' );
        $this->db->join( 'categories', 'students.category_id = categories.id' );
        $this->db->where( 'student_session.session_id', $this->current_session );
        if ( $class_id != null ) {
            $this->db->where( 'student_session.class_id', $class_id );
        }
        if ( $section_id != null ) {
            $this->db->where( 'student_session.section_id', $section_id );
        }
        if ( $category != null ) {
            $this->db->where( 'students.category_id', $category );
        }
        if ( $gender != null ) {
            $this->db->where( 'students.gender', $gender );
        }
        if ( $rte != null ) {
            $this->db->where( 'students.rte', $rte );
        }
        $this->db->order_by( 'students.id' );
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * @param $searchterm
     * @param null $gender
     * @param null $fee_status can be either 'advance' or 'due'
     * @return array
     */
    public function searchFullText( $searchterm, $gender = null, $fee_status = null )
    {
      
        $this->db->select( 'classes.id AS `class_id`,students.id,classes.class, classes.fee as class_fee,sections.id AS `section_id`,sections.section,students.id,students.admission_no , students.roll_no,students.admission_date,students.firstname,  students.lastname,students.image,    students.mobileno, students.email ,students.state ,   students.city , students.pincode ,     students.religion,     students.dob ,students.current_address,    students.permanent_address,IFNULL(students.category_id, 0) as `category_id`,IFNULL(categories.category, "") as `category`,      students.adhar_no,students.samagra_id,students.bank_account_no,students.bank_name, students.ifsc_code ,students.father_name , students.guardian_name , students.guardian_relation,students.guardian_phone,students.father_phone,students.guardian_address,students.is_active ,students.created_at ,students.updated_at,students.gender,students.rte,student_session.session_id, students.fee_arrears,students.struck_off, students.father_cnic, students.discount, students.late_payment_fee' )
            ->from( 'students' );
        $this->db->join( 'student_session', 'student_session.student_id = students.id' );
        $this->db->join( 'classes', 'student_session.class_id = classes.id' );
        $this->db->join( 'sections', 'sections.id = student_session.section_id' );
        $this->db->join( 'categories', 'students.category_id = categories.id', 'left' );
        $this->db->where( 'student_session.session_id', $this->current_session );
        $this->db->group_start();
        $this->db->like( 'students.firstname', $searchterm );
        $this->db->or_like( 'students.lastname', $searchterm );
        $this->db->or_like( 'students.guardian_name', $searchterm );
        $this->db->or_like( 'students.adhar_no', $searchterm );
        $this->db->or_like( 'students.samagra_id', $searchterm );
        $this->db->or_where( 'students.admission_no', $searchterm );
        // $this->db->or_where( 'students.roll_no', $searchterm );
        $this->db->group_end();
        $this->db->order_by( 'students.id' );
        $next_month = date("Y-m-d",strtotime("first day of +1 month"));
        $this->db->where("(students.updated_at >= '$next_month' OR students.updated_at  = '0000-00-00 00:00:00' OR students.updated_at IS Null)");
        $this->db->limit( '100' );
        if ( !empty( $gender ) ) {
            $this->db->where( 'LOWER(students.gender)', $gender );
        }
        if ( $fee_status !== null ) {
            switch ( $fee_status ) {
                case 'advance':
                    $this->db->where( 'students.fee_arrears <', 0 );
                    break;
                case 'due':
                    $this->db->where( 'students.fee_arrears >', 0 );
                    break;
            }
        }
        $query = $this->db->get();
       

        return $query->result_array();
    }

    public function searchFullText_message( $searchterm, $gender = null, $fee_status = null, $id=null )
    {

        $this->db->select( 'classes.id AS `class_id`,students.id,classes.class, classes.fee as class_fee,sections.id AS `section_id`,sections.section,students.id,students.admission_no , students.roll_no,students.admission_date,students.firstname,  students.lastname,students.image,    students.mobileno, students.email ,students.state ,   students.city , students.pincode ,     students.religion,     students.dob ,students.current_address,    students.permanent_address,IFNULL(students.category_id, 0) as `category_id`,IFNULL(categories.category, "") as `category`,      students.adhar_no,students.samagra_id,students.bank_account_no,students.bank_name, students.ifsc_code ,students.father_name , students.guardian_name , students.guardian_relation,students.guardian_phone,students.guardian_address,students.father_phone,students.is_active ,students.created_at ,students.updated_at,students.gender,students.rte,student_session.session_id, students.fee_arrears,students.struck_off, students.father_cnic, students.discount, students.late_payment_fee' )
            ->from( 'students' );
        $this->db->join( 'student_session', 'student_session.student_id = students.id' );
        $this->db->join( 'classes', 'student_session.class_id = classes.id' );
        $this->db->join( 'sections', 'sections.id = student_session.section_id' );
        $this->db->join( 'categories', 'students.category_id = categories.id', 'left' );
        $this->db->where( 'student_session.session_id', $this->current_session );
        $this->db->group_start();
        $this->db->like( 'students.firstname', $searchterm );
        $this->db->or_like( 'students.lastname', $searchterm );
        $this->db->or_like( 'students.guardian_name', $searchterm );
        $this->db->or_like( 'students.adhar_no', $searchterm );
        $this->db->or_like( 'students.samagra_id', $searchterm );
        $this->db->or_where( 'students.admission_no', $searchterm );


        // $this->db->or_where( 'students.roll_no', $searchterm );
        $this->db->group_end();
        $this->db->order_by( 'students.id' );
        $next_month = date("Y-m-d",strtotime("first day of +1 month"));
        $this->db->where("(students.updated_at >= '$next_month' OR students.updated_at  = '0000-00-00 00:00:00'OR students.updated_at IS Null)");
        $this->db->limit( '100' );

        if ( !empty( $gender ) ) {
            $this->db->where( 'LOWER(students.gender)', $gender );
        }
        $this->db->where( 'students.id', $id );

        if ( $fee_status !== null ) {
            switch ( $fee_status ) {
                case 'advance':
                    $this->db->where( 'students.fee_arrears <', 0 );
                    break;
                case 'due':
                    $this->db->where( 'students.fee_arrears >', 0 );
                    break;
            }
        }
        $query = $this->db->get();

        if($id == null){
            return $query->result_array();
        }else{
            return $query->row_array();

        }

    }

    public function remove( $id )
    {
        $this->db->trans_start();
        $this->db->where( 'id', $id );
        $this->db->delete( 'students' );

        $this->db->where( 'student_id', $id );
        $this->db->delete( 'student_session' );

        $this->db->where( 'user_id', $id );
        $this->db->where( 'role', 'student' );
        $this->db->delete( 'users' );
        $this->db->trans_complete();

        if ( $this->db->trans_status() === FALSE ) {
            return false;
        } else {
            return true;
        }
    }

    public function fine_sum()
    {
        $this->db->select('SUM(late_payment_fee) as total_fine')
        ->from('students')
        ->join('student_session','students.id = student_session.student_id','inner')
        ->where( 'students.struck_off ', 0)
        ->where( 'student_session.session_id',  $this->current_session);
        $query = $this->db->get();
        return $query->row_array();
    }
    public function fine_struck_sum()
    {
        $this->db->select('SUM(late_payment_fee) as struck_fine')
        ->from('students')
        ->where( 'students.struck_off ', 1);
        
        $updated_at = date('Y-m-1');
        $this->db->where("(students.updated_at >= '$updated_at')");
        //$this->db->where( 'updated_at >=', $updated_at."00:00:00" );
        $query = $this->db->get();
        return $query->row_array();
    }

    public function struckOff( $id )
    {
        $this->db->trans_start();
        $date = date('Y-m-d');
        $data = array(
            'struck_off' => 1,
            'updated_at' => $date,
        );
        $this->db->where( 'id', $id );
        $this->db->update( 'students', $data );
        $data1 = array(
            'is_active'     => 'no',
        );
        $this->db->where( 'user_id', $id );
        $this->db->where( 'role', 'student' );
        $this->db->update( 'users',$data1 );
        $this->db->trans_complete();

        if ( $this->db->trans_status() === FALSE ) {
            return false;
        } else {
            return true;
        }
    }

    public function doc_delete( $id )
    {
        $this->db->where( 'id', $id );
        $this->db->delete( 'student_doc' );
    }

    /**
     * This function will take the post data passed from the controller
     * If id is present, then it will do an update
     * else an insert. One function doing both add and edit.
     * @param $data
     */

    public function updateDues( $id, $data )
    {
        $this->db->where( 'id', $id );
        $this->db->update( 'students', $data );
        $this->db->where( 'student_id', $id );
        $this->db->update( 'discount_history', $data );
        return TRUE;
    }

    public function add( $data )
    {
        if ( isset( $data['id'] ) ) {
  
            $this->db->where( 'id', $data['id'] );
            $this->db->update( 'students', $data );
        } else {
            $this->db->insert( 'students', $data );
            return $this->db->insert_id();
        }
    }

    public function add_discount( $data )
    {
        $this->db->insert( 'discount_history', $data );
        return $this->db->insert_id();

    }

    public function get_discount( $id )
    {
        $this->db->select( "*" )
            ->from( 'discount_history' )
            ->where( 'student_id', $id );

        $q = $this->db->get();


        if ( $q->num_rows() > 0 ) {
            return $q->result_array();
        } else {
            return false;
        }
    }
    public function get_discount2( $id )
    {
        $this->db->select( "*" )
            ->from( 'discount_history' )
            ->order_by('date', 'desc')
            ->limit(1)
            ->where( 'student_id', $id );
        $q = $this->db->get();
        if ( $q->num_rows() > 0 ) {
            return $q->row_array();
        } else {
            return false;
        }
    }

    public function discount_delete( $id )
    {
        $this->db->where( 'id', $id );
        $this->db->delete( 'discount_history' );
    }

    public function add_student_sibling( $data_sibling )
    {
        if ( isset( $data_sibling['id'] ) ) {
            $this->db->where( 'id', $data_sibling['id'] );
            $this->db->update( 'student_sibling', $data_sibling );
        } else {
            $this->db->insert( 'student_sibling', $data_sibling );
            return $this->db->insert_id();
        }
    }

    public function add_student_session( $data )
    {
        $this->db->where( 'session_id', $data['session_id'] );
        $this->db->where( 'student_id', $data['student_id'] );
        $q = $this->db->get( 'student_session' );
        if ( $q->num_rows() > 0 ) {
            $rec = $q->row_array();
            $this->db->where( 'id', $rec['id'] );
            $this->db->update( 'student_session', $data );

            return $rec['id'];
        } else {
            $this->db->insert( 'student_session', $data );
            return $this->db->insert_id();
        }
    }


    public function add_student_session_update( $data )
    {
        $this->db->where( 'session_id', $data['session_id'] );
        $q = $this->db->get( 'student_session' );
        if ( $q->num_rows() > 0 ) {
            $this->db->where( 'session_id', $this->current_session );
            $this->db->update( 'student_session', $data );
        } else {
            $this->db->insert( 'student_session', $data );
            return $this->db->insert_id();
        }
    }

    public function adddoc( $data )
    {
        $this->db->insert( 'student_doc', $data );
        return $this->db->insert_id();
    }

    public function read_siblings_students( $ids_comma )
    {
        $query = $this->db->query( 'select * from students WHERE id in (' . $ids_comma . ')' );
        return $query->result_array();
    }

    public function getAttedenceByDateandClass( $date )
    {
        $sql = "SELECT IFNULL(student_attendences.id, 0) as attencence FROM `student_session`left JOIN student_attendences on student_attendences.student_session_id=student_session.id and student_attendences.date=" . $this->db->escape( $date ) . " and student_attendences.attendence_type_id != 2 where student_session.class_id=7 and student_session.session_id=$this->current_session";
        $query = $this->db->query( $sql );
        return $query->result_array();
    }

    public function searchCurrentSessionStudents()
    {
        $this->db->select( 'classes.id AS `class_id`,student_session.id as student_session_id,students.id,classes.class,sections.id AS `section_id`,sections.section,students.id,students.admission_no , students.roll_no,students.admission_date,students.firstname,  students.lastname,students.image,    students.mobileno, students.email ,students.state ,   students.city , students.pincode ,     students.religion,     students.dob ,students.current_address,    students.permanent_address,IFNULL(students.category_id, 0) as `category_id`,IFNULL(categories.category, "") as `category`,students.adhar_no,students.samagra_id,students.bank_account_no,students.bank_name, students.ifsc_code , students.guardian_name , students.guardian_relation,students.guardian_phone,students.guardian_address,students.is_active ,students.created_at ,students.updated_at,students.father_name,students.rte,students.gender, students.fee_arrears, students.late_payment_fee,students.fee_starting_date, students.late_payment_fee_update_date,student_logs.free' )->from( 'students' );

        $this->db->join( 'student_session', 'student_session.student_id = students.id' );
        $this->db->join( 'student_logs', 'student_session.id = student_logs.student_session_id' );
        $this->db->join( 'classes', 'student_session.class_id = classes.id' );
        $this->db->join( 'sections', 'sections.id = student_session.section_id' );
        $this->db->join( 'categories', 'students.category_id = categories.id', 'left' );
        $this->db->where( 'student_session.session_id', $this->current_session );
        $this->db->where( 'students.struck_off', 0 );
        $this->db->where( 'student_logs.free', 0 );

        $this->db->order_by( 'students.firstname', 'asc' );

        $query = $this->db->get();

        return $query->result_array();
    }

    public function searchLibraryStudent( $class_id = null, $section_id = null )
    {
        $this->db->select( 'classes.id AS `class_id`,student_session.id as student_session_id,students.id,classes.class,sections.id AS `section_id`,
           IFNULL(libarary_members.id,0) as `libarary_member_id`,
           IFNULL(libarary_members.library_card_no,0) as `library_card_no`,sections.section,students.id,students.admission_no , students.roll_no,students.admission_date,students.firstname,  students.lastname,students.image,    students.mobileno, students.email ,students.state ,   students.city , students.pincode ,     students.religion,     students.dob ,students.current_address,    students.permanent_address,IFNULL(students.category_id, 0) as `category_id`,IFNULL(categories.category, "") as `category`,students.adhar_no,students.samagra_id,students.bank_account_no,students.bank_name, students.ifsc_code , students.guardian_name , students.guardian_relation,students.guardian_phone,students.guardian_address,students.is_active ,students.created_at ,students.updated_at,students.father_name,students.rte,students.gender' )->from( 'students' );
        $this->db->join( 'student_session', 'student_session.student_id = students.id' );
        $this->db->join( 'classes', 'student_session.class_id = classes.id' );
        $this->db->join( 'sections', 'sections.id = student_session.section_id' );
        $this->db->join( 'categories', 'students.category_id = categories.id', 'left' );
        $this->db->join( 'libarary_members', 'libarary_members.member_id = students.id and libarary_members.member_type = "student"', 'left' );


        $this->db->where( 'student_session.session_id', $this->current_session );
        if ( $class_id != null ) {
            $this->db->where( 'student_session.class_id', $class_id );
        }
        if ( $section_id != null ) {
            $this->db->where( 'student_session.section_id', $section_id );
        }
        $this->db->order_by( 'students.id' );

        $query = $this->db->get();
        return $query->result_array();
    }

    public function sum_total_due_fee()
    {
        $q = $this->db->select_sum( 'fee_arrears', 'sm' )
            ->from( 'students' )
            ->get();

        $sm = $q->row_array();
        $sm = intval( $sm['sm'] );

        return $sm;
    }

    public function get_balance_sheet($id)
    {
        $this->db->select( '*')
            ->from( 'students' );

        if (!empty($id) ) {
            $this->db->where( 'students.admission_no ',  $id );
        }

        $q = $this->db->get();

        if($id !==null){
            return $q->result_array();
        }else{
            return false;
        }

    }

    public function fee_arears( $class_id = null, $section_id = null )
    {
        $this->db->select( '`students`.`admission_date`, `students`.`discount`, `students`.`fee_arrears`, `students`.`fee_starting_date`, `classes`.`fee`' )
            ->from( 'students' )
            ->join( 'student_session', 'student_session.student_id = students.id', 'inner' )
            ->join( 'sch_settings', 'sch_settings.session_id = student_session.session_id', 'inner' )
            ->join( 'classes', '`classes`.`id` = `student_session`.`class_id`', 'inner' )
            ->where( 'students.fee_arrears >', 0 );
           
            if ( $class_id !== null ) {
            $this->db->where( 'student_session.class_id', $class_id );
            $next_month = date("Y-m-d",strtotime("first day of +1 month"));
            $this->db->where("(students.updated_at >= '$next_month' OR students.updated_at  = '0000-00-00 00:00:00' OR students.updated_at IS Null)");
        }

        $this->db->where( 'students.struck_off', 0 );

        if ( $section_id !== null ) {
            $this->db->where( 'student_session.section_id', $section_id );
        }

        $q = $this->db->get();

        $rows = $q->result_array();
        $fee_arrears = 0;


        for ( $i = 0; $i < count( $rows ); $i++ ) {
            // if student student isn't given full fee concession
            if ( floatval( $rows[$i]['fee'] ) - floatval( $rows[$i]['discount'] ) > 0 ) {
                // if current time is greater than fee starting time
                if ( now() >= strtotime( $rows[$i]['fee_starting_date'] ) ) {
                 
                    
                        $fee_arrears += floatval( $rows[$i]['fee_arrears'] );
                  
                }
                
            }
        }
       
        return $fee_arrears;
    }

    public function sum_advance_fee( $class_id = null, $section_id = null )
    {
        $this->db->select( '`students`.`admission_date`, `students`.`discount`, `students`.`fee_arrears`, `classes`.`fee`' )
            ->from( 'students' )
            ->join( 'student_session', 'student_session.student_id = students.id', 'inner' )
            ->join( 'sch_settings', 'sch_settings.session_id = student_session.session_id', 'inner' )
            ->join( 'classes', '`classes`.`id` = `student_session`.`class_id`', 'inner' )
            ->where( 'students.fee_arrears <', 0 );

        if ( $class_id !== null ) {
            $this->db->where( 'student_session.class_id', $class_id );
            $next_month = date("Y-m-d",strtotime("first day of thistudent month"));
            $this->db->where("(students.updated_at >= '$next_month' OR students.updated_at  = '0000-00-00 00:00:00' OR students.updated_at IS Null)");
        }

        if ( $section_id !== null ) {
            $this->db->where( 'student_session.section_id', $section_id );
        }

        $q = $this->db->get();

        $rows = $q->result_array();
        $total_arrears = 0;

        foreach ( $rows as $row ) {
            $total_arrears += abs( $row['fee_arrears'] );
        }

        return $total_arrears;
    }

    public function add_advance_fee( $class_id = null, $section_id = null )
    {
        $created_at = date( 'Y-m-', now() );

        $this->db->select( '*' )->from( 'student_advance' );
        if ( $class_id !== null ) {
            $this->db->where( 'class_id', $class_id );
        }
        if ( $section_id !== null ) {
            $this->db->where( 'section_id', $section_id );
        }

        $this->db->like( 'created_at', $created_at, 'after' );

        $std_ad = $this->db->get();
     
        if ( $std_ad->num_rows() > 0 ) {
            return false;
        } else {
            $this->db->select( '`students`.`admission_date`,`students`.`id`, `students`.`discount`, `students`.`fee_arrears`, `classes`.`fee`' )
                ->from( 'students' )
                ->join( 'student_session', 'student_session.student_id = students.id', 'inner' )
                ->join( 'classes', '`classes`.`id` = `student_session`.`class_id`', 'inner' )
                ->join( 'sections', 'sections.id = student_session.section_id' )
                ->where( 'students.fee_arrears <', 0 )
                ->where( 'student_session.session_id', $this->current_session );

            if ( $class_id !== null ) {
                $this->db->where( 'student_session.class_id', $class_id );
            }

            if ( $section_id !== null ) {
                $this->db->where( 'student_session.section_id', $section_id );
            }

            $q = $this->db->get();

            $rows = $q->result_array();

            $total_arrears = 0;

            $created_at = date('Y-m-1', now() );

            foreach ( $rows as $row ) {
                $total_advance  = abs( $row['fee_arrears'] );
                $monthly_fee    = $row['fee']- $row['discount'];
                if ($total_advance > $monthly_fee ) {
                    $total_advance = $monthly_fee;
                }
                $this->db->insert( 'student_advance', [
                    'student_id'    => $row['id'],
                    'class_id'      => $class_id,
                    'section_id'    => $section_id,
                    'advance_fee'   => $total_advance,
                    'created_at'    => $created_at
                ] );

            }
            return $this->db->insert_id();
        }
    }

    public function get_advance($class_id = null, $section_id = null,  $student_id = null, $year_month_data = null )
    {
        $this->db->select( '*')
            ->from( 'student_advance' );

        if (!empty($student_id)) {
            $this->db->where( 'student_id', $student_id);
        }
        if (!empty($year_month_data['year']) &&  !empty($year_month_data['month']) ) {
            $current_month = $year_month_data['year']."-".$year_month_data['month']."-1";
            $current_month_l = $year_month_data['year']."-".$year_month_data['month']."-31";
            $this->db->where( 'created_at >=', date($current_month));
            $this->db->where( 'created_at <=', date($current_month_l));
        }
        $this->db->order_by( 'created_at','DESC' );

        // else{
        //     $this->db->where( 'created_at >=', date("Y-m-1"));
        //     $this->db->where( 'created_at <=', date("Y-m-30"));
        // }

        $q = $this->db->get();
        // $q =  $q->result_array();
        return $q->result_array();

    }


    public function get_advance_annual($class_id = null, $section_id = null,  $student_id = null, $year_month_data = null )
    {
        $this->db->select( '*')
            ->from( 'student_advance' );

        if (!empty($student_id)) {
            $this->db->where( 'student_id', $student_id);
        }
        if (!empty($year_month_data['year']) &&  !empty($year_month_data['month']) ) {
            $current_month = $year_month_data['year']."-".$year_month_data['month']."-1";
            $current_month_l = $year_month_data['year']."-".$year_month_data['month']."-31";
            $this->db->where( 'created_at', date($current_month));
            $this->db->where( 'created_at <=', date($current_month_l));
        }
        $this->db->order_by( 'created_at','DESC' );
        $q = $this->db->get();
        // $q =  $q->result_array();
        return $q->row_array();

    }

    public function get_advance_annual_sibling( $student_id = null, $year_month_data = null )
    {
        $this->db->select( 'advance_fee')
            ->from( 'student_advance' );
        if (!empty($student_id)) {
            $this->db->where( 'student_id', $student_id);
        }
        if (!empty($year_month_data['year']) &&  !empty($year_month_data['month']) ) {
            $current_month = $year_month_data['year']."-".$year_month_data['month']."-1";
            $current_month_l = $year_month_data['year']."-".$year_month_data['month']."-31";
            $this->db->where( 'created_at', date($current_month));
            $this->db->where( 'created_at <=', date($current_month_l));
        }
        $q = $this->db->get();
        $sm = $q->row_array();
        $sm = intval( $sm['advance_fee'] );
        return $sm;
    }


    public function get_advance1($class_id = null, $section_id = null,  $student_id = null, $year_month_data = null )
    {
        $month = date('m');
        $year =  date('Y');
        $year_month_data['month']=$month;
        $year_month_data['year']=$year;
        $this->db->select( '*')
            ->from( 'student_advance' );

        if (!empty($student_id)) {
            $this->db->where( 'student_id', $student_id);
        }
        if (!empty($year_month_data['year']) &&  !empty($year_month_data['month']) ) {
            $current_month = $year_month_data['year']."-".$year_month_data['month']."-1";
            $current_month_l = $year_month_data['year']."-".$year_month_data['month']."-31";
            $this->db->where( 'created_at >=', date($current_month));
            $this->db->where( 'created_at <=', date($current_month_l));
        }
        $this->db->order_by( 'created_at','DESC' );
        // else{
        //     $this->db->where( 'created_at >=', date("Y-m-1"));
        //     $this->db->where( 'created_at <=', date("Y-m-30"));
        // }
        $q = $this->db->get();
        // $q =  $q->result_array();
        return $q->result_array();
    }

    public function get_advance_report( $class_id=null ,$section_id=null)
    {
       
        $this->db->select( 'student_advance.*, students.struck_off, students.admission_no,students.roll_no,students.admission_date,students.firstname,students.lastname,
        students.father_phone,students.father_name ,students.gender ,students.fee_arrears')
            ->from( 'student_advance' )
            ->join( 'students', 'students.id = student_advance.student_id', 'inner' )
            ->join( 'student_session', 'student_session.student_id = students.id', 'inner' )
            ->join( 'classes', 'classes.id = student_session.class_id', 'inner' );
            $this->db->where( 'student_advance.created_at >=', date('Y-m-01'));
            $this->db->where( 'student_advance.created_at <=', date('Y-m-t'));
           // $this->db->where( 'students.struck_off', 0);
            $this->db->where( 'student_session.session_id', $this->current_session );
            
            if($class_id !== null){
                $this->db->where( 'student_session.class_id', $class_id);
            }
            if($section_id !== null){
                $this->db->where( 'student_session.section_id', $section_id);
            }
         $this->db->order_by( 'student_advance.created_at','DESC' );
         $q = $this->db->get();
        return $q->result_array();
    }

    public function adv_adj_balance_sheet( $class_id = null,$section_id = null )
    {
    
        $this->db->select( 'sum(advance_fee) as advance')
            ->from( 'student_advance' )
            ->join( 'students', 'students.id = student_advance.student_id', 'inner' )
            ->join( 'student_session', 'student_session.student_id = students.id', 'inner' )
            ->join( 'classes', 'classes.id = student_session.class_id', 'inner' );
           
            $this->db->where( 'student_advance.created_at >=', date('Y-m-01'));
            $this->db->where( 'student_advance.created_at <=', date('Y-m-t'));
           // $this->db->where( 'students.struck_off =', 0);
            $this->db->where( 'student_session.session_id', $this->current_session );
           
    
        if($class_id !== null){
            $this->db->where( 'student_advance.class_id', $class_id);
        }
        if($section_id !== null){
            $this->db->where( 'student_advance.section_id', $section_id);
        }

         $this->db->order_by( 'student_advance.created_at','DESC' );
         
         $q = $this->db->get()->row()->advance;
        
         if($q == null){
            $q = 0;
         }

        return $q;
    }


    public function get_advance_month($data)
    {
        $this->db->select( '*')
            ->from( 'student_advance' );
        if (!empty($data['date_from']) &&  !empty($data['date_to']) ) {
            $this->db->where( 'created_at >=', date( 'Y-m-d', strtotime( $data['date_from']) ));
            $this->db->where( 'created_at <=', date( 'Y-m-d', strtotime($data['date_to']) ));
        }else{
            $this->db->where( 'created_at >=', date("Y-m-1"));
            $this->db->where( 'created_at <=', date("Y-m-30"));
        }
        $q = $this->db->get();
        return $q->result_array();
    }

    public function get_advance_adjusted($data,$class_id = null,$section_id = null)
    {
        $this->db->select( 'student_advance.*')
            //          ->from( 'student_advance' );
            ->from( 'students' )
            ->join( 'student_session', 'student_session.student_id = students.id', 'inner' )
            ->join( 'student_advance', 'student_advance.student_id= student_session.student_id', 'inner' );
        $this->db->where( 'student_session.session_id', $this->current_session );

        if (!empty($data['date_from']) &&  !empty($data['date_to']) ) {
                  $this->db->where( 'created_at >=', date( 'Y-m-d', strtotime( $data['date_from']) ));
                  $this->db->where( 'created_at <=', date( 'Y-m-d', strtotime($data['date_to']) ));
        }else{
            $this->db->where( 'student_advance.created_at >=', date("Y-m-1"));
            $this->db->where( 'student_advance.created_at <=', date("Y-m-t"));
        }
        if($class_id !== null){
            $this->db->where( 'student_advance.class_id', $class_id);
        }
        if($section_id !== null){
            $this->db->where( 'student_advance.section_id', $section_id);
        }

        $q = $this->db->get();

        $rows =      $q->result_array();

        $advance_adjusted_fee = 0;
        foreach($rows as $row){
            $advance_adjusted_fee += abs($row['advance_fee']);
        }
        return $advance_adjusted_fee;

    }

    public function free_students( $class_id = null, $section_id = null )
    {
        $this->db->from( 'students' )
            ->join( 'student_session', 'student_session.student_id = students.id', 'inner' )
            ->join( 'classes', 'classes.id = student_session.class_id', 'inner' )
            ->where( '(`classes`.`fee` - `students`.`discount` = 0)', null, false );

        if ( $class_id !== null ) {
            $this->db->where( 'student_session.class_id', $class_id );
        }

        if ( $section_id !== null ) {
            $this->db->where( 'student_session.section_id', $section_id );
        }

        return intval( $this->db->count_all_results() );
    }

    public function struckoff_students($class_id = null, $section_id = null, $date_from = null, $date_to = null, $gender = null,$current_session =null )
    {
      
        $this->db->select( 'students.*,classes.class,classes.fee,classes.id AS class_id,sections.id as section_id, sections.section' )
            ->from( 'students' )
            ->join( 'student_session', 'student_session.student_id = students.id', 'inner' )
            ->join( 'classes', 'classes.id = student_session.class_id', 'inner' )
            ->join( 'sections', 'sections.id = student_session.section_id', 'inner' )
            ->where( 'students.struck_off' , 1 );
            
           
            if($current_session != null){
                $this->db->where( 'student_session.session_id', $current_session );
            }else{
                $this->db->where( 'student_session.session_id', $this->current_session );
            }
            
            
        // ->like( 'students.updated_at', date('Y-m-d',now()), 'before' );

        if ($date_from == null && $date_to == null) {
            # code...
           
            $this->db->where( 'students.updated_at >=', date('Y-m-d',strtotime('first day of this month')));
            $this->db->where( 'students.updated_at <=', date('Y-m-t',strtotime('first day of this month')));
    
        }
       
        // ->where( 'students.updated_at', date('Y-m-d',strtotime('first day of -1 month')));

        if ( $class_id !== null ) {
            $this->db->where( 'student_session.class_id', $class_id );
        }

        if ( $section_id !== null ) {
            $this->db->where( 'student_session.section_id', $section_id );
        }

        if ( $date_from !== null ) {
            $this->db->where( 'students.updated_at >=', date( 'Y-m-d',strtotime ( $date_from)  ) );
        }

        if ( $date_to !== null ) {
            $this->db->where( 'students.updated_at <=', date( 'Y-m-d',strtotime (  $date_to)  ) );
        }

        if ( $gender !== null ) {
            $this->db->where( 'LOWER(students.gender)', strtolower( $gender ) );
        }
        $this->db->order_by( 'classes.id' );
        $q = $this->db->get();
        return $q->result_array();
    }

    public function withdrawl_students($class_id = null, $section_id = null,$other=null )
    {
        $days_in_month  = cal_days_in_month( CAL_GREGORIAN, date( 'm', strtotime('first day of this month') ), date( 'Y', now() ) );
        $lastmonth_to   =  date( "Y-m-{$days_in_month}", strtotime( 'first day of this month' ) );
        $this->db->select( 'students.fee_arrears,students.discount,classes.class,classes.fee,classes.id AS class_id,sections.id as section_id, sections.section' )
            ->from( 'students' )
            ->join( 'student_session', 'student_session.student_id = students.id', 'inner' )
            ->join( 'classes', 'classes.id = student_session.class_id', 'inner' )
            ->join( 'sections', 'sections.id = student_session.section_id', 'inner' )
            ->where( 'students.struck_off' , 1 );
            $this->db->where( 'student_session.session_id', $this->current_session );
            $this->db->where( 'students.updated_at >=', date('Y-m-d',strtotime('first day of this month')));
            $this->db->where( 'students.updated_at <=', date('Y-m-t',strtotime('first day of this month')));
            if($other == null){
                $this->db->where( 'student_session.class_id', $class_id );
                $this->db->where( 'student_session.section_id', $section_id );
            $q = $this->db->get();
            $withdrawl = $q->result_array();
            $data = [];
            $data['total_arrears']       = 0;
            $data['total_due_fee']       = 0;
            $data['total_advance']       = 0;
           
            foreach($withdrawl as $student){
                $student_fee = $student['fee'] -   $student['discount'];
                if($student['fee_arrears'] < 0){
                    $advance = abs($student['fee_arrears']);
                    $arrears = 0;
                    $due_fee = 0;
                }else{
                    $arrears =    $student['fee_arrears'] - $student_fee;
                    if($arrears > 0){
                        $arrears = $student['fee_arrears'] - $student_fee;
                        $due_fee = $student_fee;
                        $advance = 0;
                    }else{
                        if($arrears == $student_fee){
                            $due_fee = $student_fee;
                            $arrears = 0;
                            $advance = 0;
                        }else{
                            $arrears = 0;
                            $advance = 0;
                            $due_fee = $student['fee_arrears'];
                        }
                    }
                }
            $data['total_arrears']     += $arrears;
            $data['total_due_fee']     += $due_fee;
            $data['total_advance']     += $advance;
            }
            
            
            return $data;

       }
         
    }


    public function student_discount_sum( $id = null, $class_id = null, $section_id = null )
    {
        $this->db->select( '`students`.`admission_date`, `students`.`discount`, `students`.`fee_arrears`, `students`.`fee_starting_date`, `classes`.`fee`' )
            ->from( 'students' )
            ->join( 'student_session', 'student_session.student_id = students.id', 'inner' )
            ->join( 'sch_settings', 'sch_settings.session_id = student_session.session_id', 'inner' )
            ->join( 'classes', '`classes`.`id` = `student_session`.`class_id`', 'inner' )
            ->where( 'students.fee_arrears >=', 0 );

        if ( $id !== null ) {
            if ( is_array( $id ) ) {
                $this->db->where_in( 'students.id', $id );
            } else {
                $this->db->where( 'students.id', $id );
            }
        }

        if ( $class_id !== null ) {
            $this->db->where( 'student_session.class_id', $class_id );
        }

        if ( $section_id !== null ) {
            $this->db->where( 'student_session.section_id', $section_id );
        }

        $q = $this->db->get();
        $rows = $q->result_array();
        $discount = 0;

        for ( $i = 0; $i < count( $rows ); $i++ ) {
            // if student student isn't given full fee concession
            if ( floatval( $rows[$i]['fee'] ) - floatval( $rows[$i]['discount'] ) > 0 ) {

                // if fee start date is greater than current date and time
                if ( now() >= strtotime( $rows[$i]['fee_starting_date'] ) ) {
                    $discount += floatval( $rows[$i]['discount'] );
                }

                // if admission is not of current year
                // and not of current month
                // and is between 1 and 20
//                if (
//                    date( 'Y', strtotime( $rows[$i]['admission_date'] ) ) != date( 'Y', now() )
//                    &&
//                    date( 'n', strtotime( $rows[$i]['admission_date'] ) ) != date( 'n', now() )
//                    &&
//                    intval( date( 'j', strtotime( $rows[$i]['admission_date'] ) ) ) >= 1
//                    &&
//                    intval( date( 'j', strtotime( $rows[$i]['admission_date'] ) ) ) <= 20
//                ) {
//                    $discount += floatval( $rows[$i]['discount'] );
//                }
            }
        }

        return $discount;
    }

    public function student_without_fee( $session = null, $class = null, $section = null, $year = null, $month = null )
    {
        $this->db->from( 'students' )
            ->join( 'student_session', 'student_session.student_id = students.id', 'inner' );

        if ( $session !== null ) {
            $this->db->where( 'student_session.session_id', $session );
        }
        if ( $class !== null ) {
            $this->db->where( 'student_session.class_id', $class );
        }
        if ( $section !== null ) {
            $this->db->where( 'student_session.section_id', $section );
        }
        if ( $year !== null ) {
            $this->db->where( 'YEAR(students.admission_date)', $year );
        }
        if ( $month !== null ) {
            $this->db->where( 'MONTH(students.admission_date)', $month );
        }
        $this->db->where( 'DAY(students.admission_date) >', 20 );

        $count = $this->db->count_all_results();

        return intval( $count );
    }

    public function family_list()
    {
        $distinct_father_cnics = $this->get_distinct_father_phone();

        if ( $distinct_father_cnics !== false ) {
            $q = $this->db->select( '*' )
                ->from( 'students' )
                ->where_in( $distinct_father_cnics )
                ->group_by( 'father_phone' )
                ->get();

            if ( $q->num_rows() > 0 ) {
                return $q->result_array();
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function get_distinct_father_phone()
    {
        $q = $this->db->distinct()
            ->select( 'father_phone' )
            ->from( 'students' )
            ->order_by( 'father_phone' )
            ->get();

        if ( $q->num_rows() > 0 ) {
            return $q->result_array();
        } else {
            return false;
        }
    }

    public function family_children( $phone= null , $cnic = null )
    {
        $this->db->select( 'students.*, classes.class AS class_name, classes.fee AS class_fee, sections.section AS section_name' )
            ->from( 'students' );
        $this->db->join( 'student_session', 'student_session.student_id = students.id' );
        $this->db->join( 'classes', 'student_session.class_id = classes.id' );
        $this->db->join( 'sections', 'sections.id = student_session.section_id' );
        $this->db->where( 'student_session.session_id', $this->current_session );
        if($phone !=  null){
            if ( is_array( $phone ) ) {
                $this->db->where_in( 'students.father_phone', $phone );
            } else {
                $this->db->group_start();
                $this->db->like( 'students.father_name', $phone );
                $this->db->or_where( 'students.father_phone', $phone );
                $this->db->group_end();
            }
        }

        if($cnic !=  null){
            if ( is_array( $cnic ) ) {
                $this->db->where_in( 'students.father_cnic', $cnic );
            } else {
                $this->db->group_start();
                $this->db->like( 'students.father_name', $cnic );
                $this->db->or_where( 'students.father_cnic', $cnic );
                $this->db->group_end();
            }
        }

        $q = $this->db->get();
        
        if ( $q->num_rows() > 0 ) {
            return $q->result_array();
        } else {
            return false;
        }
    }

    public function students_pending_fee( $class_id = null, $section_id = null )
    {
        $this->db->select( 'students.*, classes.class AS class_name, classes.fee AS class_fee, sections.section AS section_name' )
            ->from( 'students' )
            ->join( 'student_session', 'student_session.student_id = students.id', 'inner' )
            ->join( 'sch_settings', 'sch_settings.session_id = student_session.session_id', 'inner' )
            ->join( 'classes', 'classes.id = student_session.class_id', 'left' )
            ->join( 'sections', 'sections.id = student_session.section_id', 'left' )
            ->where('`students`.`fee_arrears` > ',0)
            ->where('`students`.`struck_off` ',0)
            ->where('students.fee_arrears - ( classes.fee - students.discount) - students.late_payment_fee');
        if ( $class_id !== null ) {
            $this->db->where( 'student_session.class_id', $class_id );
        }

        $next_month = date("Y-m-d",strtotime("first day of +1 month"));
        $this->db->where("(students.updated_at >= '$next_month' OR students.updated_at  = '0000-00-00 00:00:00' OR students.updated_at IS Null)");

        if ( $section_id !== null ) {
            $this->db->where( 'student_session.section_id', $section_id );
        }

        $this->db->query('SET sql_mode = NO_UNSIGNED_SUBTRACTION');
        
        $q = $this->db->get();

        if ( $q->num_rows() > 0 ) {
            $students = $q->result_array();
            return $students;

        } else {
            return false;
        }
    }
  public function students_due_fee( $class_id = null, $section_id = null )
    {
        $this->db->select( 'students.fee_arrears,students.struck_off,students.late_payment_fee,students.discount, classes.class AS class_name, classes.fee AS class_fee, sections.section AS section_name' )
            ->from( 'students' )
            ->join( 'student_session', 'student_session.student_id = students.id', 'inner' )
            ->join( 'sch_settings', 'sch_settings.session_id = student_session.session_id', 'inner' )
            ->join( 'classes', 'classes.id = student_session.class_id', 'left' )
            ->join( 'sections', 'sections.id = student_session.section_id', 'left' );
           
        if ( $class_id !== null ) {
            $this->db->where( 'student_session.class_id', $class_id );
        }
        if ( $section_id !== null ) {
            $this->db->where( 'student_session.section_id', $section_id );
        }
        $this->db->where( 'students.struck_off', 0 );
        $q = $this->db->get();
        if ( $q->num_rows() > 0 ) {
            $students = $q->result_array();
            $total_due = 0;

            foreach($students as $student){
                if($student['struck_off'] != 1){

              
                $discount_fee           = $student['class_fee'] - $student['discount'];
                if ($student['fee_arrears'] > 0) {
                    // calculate current student arrears
                $fee_arrears = $student['fee_arrears'] - $discount_fee - $student['late_payment_fee'];  // 3150 -1200 -150  
                    // calculate current student fine
                $late_payment_fee = $student['late_payment_fee'];              // 150
                $current_fee = $student['fee_arrears'] - $late_payment_fee;      // 3150 - 150
                    if ($current_fee > $discount_fee) {                             //3000 >1200
                        $due_fee     = $discount_fee;                               //  1200
                    }else{
                        $due_fee     = $current_fee;                                // 500 ok
                    }
                    $total_due += $due_fee;

                }
            }
              
            }
            return $total_due;

        } else {
            return false;
        }
    }
    /**
     * This funtion takes id as a parameter and will fetch the record.
     * If id is not provided, then it will fetch all the records form the table.
     * @param int|array $id
     * @return mixed
     */
    
    public function get( $id = null, $where = null, $session = true,$others = null ,$admission = null )
    {
        $this->db->select( 'student_session.transport_fees,student_session.vehroute_id,student_session.id as `student_session_id`,student_session.fees_discount,classes.id AS `class_id`,classes.class,classes.fee,sections.id AS `section_id`,sections.section,students.id,students.fee_update_date,students.fee_arrears,students.admission_no , students.roll_no,students.admission_date,students.firstname,students.admission_class,  students.lastname,students.image,    students.mobileno, students.email ,students.state ,   students.city , students.pincode ,     students.religion, students.cast,    students.dob ,students.current_address, students.previous_school,
            students.guardian_is, students.late_payment_fee,students.b_form, students.late_payment_fee_update_date,
            students.permanent_address,students.category_id,students.adhar_no,students.samagra_id,students.bank_account_no,students.bank_name, students.ifsc_code , students.guardian_name , students.guardian_relation,students.guardian_phone,students.guardian_address,students.is_active ,students.created_at ,students.updated_at,students.father_name,students.father_phone,students.father_occupation,students.father_cnic,students.mother_name,students.mother_phone,students.mother_occupation,students.guardian_occupation,students.struck_off,students.gender,students.guardian_is,students.rte, students.discount, students.fee_starting_date' )
            ->from( 'students' );
        $this->db->join( 'student_session', 'student_session.student_id = students.id' );
        $this->db->join( 'classes', 'student_session.class_id = classes.id' );
        $this->db->join( 'sections', 'sections.id = student_session.section_id' );

        if ( $session !== false ) {
            $this->db->where( 'student_session.session_id', $this->current_session );
        }
        if ( $id != null ) {
            if ( is_array( $id ) ) {
                $this->db->where_in( 'students.id', $id );
            } else {
                $this->db->where( 'students.id', $id );
            }
        }elseif ($id != null && $where == null) {
            $this->db->where( 'students.struck_off' , 0 );

        } else {
            $this->db->order_by( 'students.id', 'desc' );
        }

        if($admission != null){
            $this->db->where( 'students.admission_no' , $admission );
        }

        if ( $where !== null ) {

            $this->db->where( $where );
            if ($others == 'phone') {
                
            }elseif ($others !== null) {
             //   $next_month = date("Y-m-d",strtotime("first day of +1 month"));
              //  $this->db->where("(students.updated_at >= '$next_month' OR students.updated_at  = '0000-00-00 00:00:00')");
            }else{
                $this->db->where( 'students.updated_at <', date('Y-m-d',strtotime('first day of +1 month')));
                $this->db->where( 'students.updated_at >', date('Y-m-d',strtotime('first day of -1 month')));
            }
        }

        $query = $this->db->get();

        if ( $id != null ) {
            if ( is_array( $id ) ) {
                return $query->result_array();
            } else {
                return $query->row_array();
            }
        } else {
            return $query->result_array();
        }
    }


    public function sibli(){
            $this->db->query('SELECT users.id,
            count(*) AS c
            FROM students
            join users ON students.id =  users.user_id 
            where  users.role = "parent"
            GROUP BY father_phone
            HAVING c > 1
            ORDER BY c DESC');
            $query = $this->db->get();
            return $query->result_array();
    }
    public function get_sib( $id = null, $where = null, $session = true,$others = null ,$admission = null , $count = null )
    {
        $this->db->select( 'student_session.transport_fees, count(*) AS c ,student_session.vehroute_id,student_session.id as `student_session_id`,student_session.fees_discount,classes.id AS `class_id`,classes.class,classes.fee,sections.id AS `section_id`,sections.section,students.id,students.fee_update_date,students.fee_arrears,students.admission_no , students.roll_no,students.admission_date,students.firstname,students.admission_class,  students.lastname,students.image,    students.mobileno, students.email ,students.state ,   students.city , students.pincode ,     students.religion, students.cast,    students.dob ,students.current_address, students.previous_school,
            students.guardian_is, students.late_payment_fee, students.late_payment_fee_update_date,
            students.permanent_address,students.category_id,students.adhar_no,students.samagra_id,students.bank_account_no,students.bank_name, students.ifsc_code , students.guardian_name , students.guardian_relation,students.guardian_phone,students.guardian_address,students.is_active ,students.created_at ,students.updated_at,students.father_name,students.father_phone,students.father_occupation,students.father_cnic,students.mother_name,students.mother_phone,students.mother_occupation,students.guardian_occupation,students.struck_off,students.gender,students.guardian_is,students.rte, students.discount, students.fee_starting_date' )
            ->from( 'students' );
        $this->db->join( 'student_session', 'student_session.student_id = students.id' );
        $this->db->join( 'classes', 'student_session.class_id = classes.id' );
        $this->db->join( 'sections', 'sections.id = student_session.section_id' );

        if ( $session !== false ) {
            $this->db->where( 'student_session.session_id', $this->current_session );
        }
        if ( $id != null ) {
            if ( is_array( $id ) ) {
                $this->db->where_in( 'students.id', $id );
            } else {
                $this->db->where( 'students.id', $id );
            }
        }elseif ($id != null && $where == null) {
   
            $this->db->where( 'students.struck_off' , 0 );

        } else {
            $this->db->order_by( 'students.id', 'desc' );
        }

        if($admission != null){
            $this->db->where( 'students.admission_no' , $admission );
        }
        $this->db->where( 'students.father_phone != ' , null );
   
        
        if($count != null){
       
            $this->db->group_by('father_phone')->having('COUNT(c)', $count);
       
        }else{
       
            $this->db->group_by('father_phone')->having('COUNT(c) >', 0);
       
        }
        
        
        if ( $where !== null ) {

            $this->db->where( $where );
            if ($others == 'phone') {
                
            }elseif ($others !== null) {
             //   $next_month = date("Y-m-d",strtotime("first day of +1 month"));
              //  $this->db->where("(students.updated_at >= '$next_month' OR students.updated_at  = '0000-00-00 00:00:00')");
            }else{
                $this->db->where( 'students.updated_at <', date('Y-m-d',strtotime('first day of +1 month')));
                $this->db->where( 'students.updated_at >', date('Y-m-d',strtotime('first day of -1 month')));
            }
        }

        $query = $this->db->get();

        if ( $id != null ) {
            if ( is_array( $id ) ) {
                return $query->result_array();
            } else {
                return $query->row_array();
            }
        } else {
            return $query->result_array();
        }
    }
    public function get_atten( $id = null, $where = null, $session = true,$others = null )
    {
        $this->db->select( 'student_session.transport_fees,student_session.vehroute_id,student_session.id as `student_session_id`,student_session.fees_discount,classes.id AS `class_id`,classes.class,classes.fee,sections.id AS `section_id`,sections.section,students.id,students.fee_update_date,students.fee_arrears,students.admission_no , students.roll_no,students.admission_date,students.firstname,students.admission_class,  students.lastname,students.image,    students.mobileno, students.email ,students.state ,   students.city , students.pincode ,     students.religion, students.cast,    students.dob ,students.current_address, students.previous_school,
            students.guardian_is, students.late_payment_fee, students.late_payment_fee_update_date,
            students.permanent_address,students.category_id,students.adhar_no,students.samagra_id,students.bank_account_no,students.bank_name, students.ifsc_code , students.guardian_name , students.guardian_relation,students.guardian_phone,students.guardian_address,students.is_active ,students.created_at ,students.updated_at,students.father_name,students.father_phone,students.father_occupation,students.father_cnic,students.mother_name,students.mother_phone,students.mother_occupation,students.guardian_occupation,students.struck_off,students.gender,students.guardian_is,students.rte, students.discount, students.fee_starting_date' )
            ->from( 'students' );
        $this->db->join( 'student_session', 'student_session.student_id = students.id' );
        $this->db->join( 'classes', 'student_session.class_id = classes.id' );
        $this->db->join( 'sections', 'sections.id = student_session.section_id' );
        $this->db->where( 'students.struck_off' , 0 );
        if ( $session !== false ) {
            $this->db->where( 'student_session.session_id', $this->current_session );
        }
        if ( $id != null ) {
            if ( is_array( $id ) ) {
                $this->db->where_in( 'students.id', $id );
            } else {
                $this->db->where( 'students.id', $id );
            }
        }elseif ($id != null && $where == null) {
            $this->db->where( 'students.struck_off' , 0 );

        } else {
            $this->db->order_by( 'students.id', 'desc' );
        }
        if ( $where !== null ) {

            $this->db->where( $where );
            if ($others == 'phone') {
            }elseif ($others !== null) {
                $next_month = date("Y-m-d",strtotime("first day of +1 month"));
                $this->db->where("(students.updated_at >= '$next_month' OR students.updated_at  = '0000-00-00 00:00:00' OR students.updated_at IS Null)");
            }else{
                $this->db->where( 'students.updated_at <', date('Y-m-d',strtotime('first day of +1 month')));
                $this->db->where( 'students.updated_at >', date('Y-m-d',strtotime('first day of -1 month')));
            }
        }

        $query = $this->db->get();


        // echo $this->db->last_query();
        // exit;
        if ( $id != null ) {
            if ( is_array( $id ) ) {
                return $query->result_array();
            } else {
                return $query->row_array();
            }
        } else {
            return $query->result_array();
        }
    }

    public function get_other_unpaid( $id = null, $where = null,$others = null )
    {
        $this->db->select( 'student_session.id as `student_session_id`,student_session.fees_discount,classes.id AS `class_id`,classes.class,classes.fee,sections.id AS `section_id`,sections.section,students.id,students.fee_update_date,students.fee_arrears,students.admission_no , students.roll_no,students.admission_date,students.firstname,students.admission_class,  students.lastname,
             students.late_payment_fee, students.late_payment_fee_update_date,
           students.is_active ,students.created_at ,students.updated_at,students.father_name,students.father_phone,students.father_cnic,students.struck_off,students.gender, students.discount' )
            ->from( 'students' );
        $this->db->join( 'student_session', 'student_session.student_id = students.id' );
        $this->db->join( 'classes', 'student_session.class_id = classes.id' );
        $this->db->join( 'sections', 'sections.id = student_session.section_id' );

            $this->db->where( 'student_session.session_id', $this->current_session );
		
        if ( $id != null ) {
            
			if ( is_array( $id ) ) {
                $this->db->where_in( 'students.id', $id );
            } else {
                $this->db->where( 'students.id', $id );
            }
        }elseif ($id != null && $where == null) {
            $this->db->where( 'students.struck_off' , 0 );

        } else {
            $this->db->order_by( 'students.id', 'desc' );
        }
        if ( $where !== null ) {

            $this->db->where( $where );
           
        }

        $query = $this->db->get();


        // echo $this->db->last_query();
        // exit;
        if ( $id != null ) {
            if ( is_array( $id ) ) {
                return $query->result_array();
            } else {
                return $query->row_array();
            }
        } else {
            return $query->result_array();
        }
    }


    public function get_student_fee_ajax( $id = null, $where = null, $session = true,$others = null )
    {
        $this->db->select( 'student_session.id as `student_session_id`,student_session.fees_discount,classes.fee,sections.section,students.id,students.fee_arrears,       
             students.late_payment_fee, students.late_payment_fee_update_date,
             students.father_phone,students.struck_off, students.discount, students.fee_starting_date' )
            ->from( 'students' );
        $this->db->join( 'student_session', 'student_session.student_id = students.id' );
        $this->db->join( 'classes', 'student_session.class_id = classes.id' );
        $this->db->join( 'sections', 'sections.id = student_session.section_id' );

        if ( $session !== false ) {
            $this->db->where( 'student_session.session_id', $this->current_session );
        }
        if ( $id != null ) {
            if ( is_array( $id ) ) {
                $this->db->where_in( 'students.id', $id );
            } else {
                $this->db->where( 'students.id', $id );
            }
        }elseif ($id != null && $where == null) {
            $this->db->where( 'students.struck_off' , 0 );

        } else {
            $this->db->order_by( 'students.id', 'desc' );
        }
        if ( $where !== null ) {

            $this->db->where( $where );
            if ($others == 'phone') {
            }elseif ($others !== null) {
                $next_month = date("Y-m-d",strtotime("first day of +1 month"));
                $this->db->where("(students.updated_at >= '$next_month' OR students.updated_at  = '0000-00-00 00:00:00' OR students.updated_at IS Null)");
            }else{
                $this->db->where( 'students.updated_at <', date('Y-m-d',strtotime('first day of +1 month')));
                $this->db->where( 'students.updated_at >', date('Y-m-d',strtotime('first day of -1 month')));
            }
        }

        $query = $this->db->get();
        // echo $this->db->last_query();
        // exit;
        if ( $id != null ) {
            return $query->row_array();
        } else {
            return null;
        }
    }

    public function get_student_fee_discount( $id = null, $where = null, $session = true)
    {
        $this->db->select( 'classes.fee,students.id,students.fee_arrears,  
             students.late_payment_fee, students.late_payment_fee_update_date,
          students.updated_at,students.struck_off, students.discount' )
            ->from( 'students' );
        $this->db->join( 'student_session', 'student_session.student_id = students.id' );
        $this->db->join( 'classes', 'student_session.class_id = classes.id' );
        $this->db->join( 'sections', 'sections.id = student_session.section_id' );

        if ( $session !== false ) {
            $this->db->where( 'student_session.session_id', $this->current_session );
        }
        if ( $id != null ) {
            if ( is_array( $id ) ) {
                $this->db->where_in( 'students.id', $id );
            } else {
                $this->db->where( 'students.id', $id );
            }
        }elseif ($id != null && $where == null) {
            $this->db->where( 'students.struck_off' , 0 );

        } else {
            $this->db->order_by( 'students.id', 'desc' );
        }

        $query = $this->db->get();
        if ( $id != null ) {
            if ( is_array( $id ) ) {
                return $query->result_array();
            } else {
                return $query->row_array();
            }
        } else {
            return $query->result_array();
        }
    }


    public function get_message( $id= null )
    {
        $this->db->select( '*' )
            ->from( 'new_message' );


        if ( $id !== null ) {
            $this->db->where( 'id', $id );
        }

        $query = $this->db->get();
        if ( $id != null ) {
            return $query->row_array();
        } else {
            return $query->result_array();
        }


    }

    public function get_student_fee( $date_from,$date_to  )
    {
        $this->db->select( 'classes.fee,students.id,student_fee_payments.*,              
               students.discount' )
            ->from( 'students' );
        $this->db->join( 'student_session', 'student_session.student_id = students.id' );
        $this->db->join( 'classes', 'student_session.class_id = classes.id' );
        $this->db->join( 'sections', 'sections.id = student_session.section_id' );
        $this->db->join( 'student_fee_payments', 'student_session.student_id = student_fee_payments.student_id' );
        $this->db->order_by("students.id", "desc");
        if ( $this->current_session !== false ) {
            $this->db->where( 'student_session.session_id', $this->current_session );
        }
        $this->db->where( 'student_fee_payments.voucher_id  !=', 1 );


        $date_from = date( 'Y-m-d', strtotime( $date_from ) );
        $this->db->where( 'student_fee_payments.payment_date >=', $date_from );
        $date_to = date( 'Y-m-d', strtotime( $date_to ) );
        $this->db->where( 'student_fee_payments.payment_date <=', $date_to );
        $query = $this->db->get();
        // echo $this->db->last_query();
        // exit;
       
            return $query->result_array();
      
    }

    public function total_students()
    {
        return $this->db->from( 'students' )->count_all_results();
    }

    public function ad_id()
    {
        $this->db->select('id, admission_no')->order_by('id','desc')->limit(1);
        $result = $this->db->get('students')->row();
        return $result;
    }

    public function new_students( $class = null, $section = null, $date_from = null, $date_to = null, $gender = null )
    {
        $this->db->select( 'students.*, classes.class, classes.fee AS class_fee, sections.section' )
            ->from( 'students' )
            ->join( 'student_session', 'student_session.student_id = students.id', 'inner' )
            ->join( 'classes', 'classes.id = student_session.class_id', 'inner' )
            ->join( 'sections', 'sections.id = student_session.section_id', 'inner' );

        if ( $class !== null ) {
            $this->db->where( 'student_session.class_id', $class );
        }

        if ( $section !== null ) {
            $this->db->where( 'student_session.section_id', $section );
        }

        if ( $date_from !== null ) {
            $this->db->where( 'students.admission_date >=', date( 'Y-m-d', strtotime( $date_from ) ) );
        }

        if ( $date_to !== null ) {
            $this->db->where( 'students.admission_date <=', date( 'Y-m-d', strtotime( $date_to ) ) );
        }

        if ( !empty( $gender ) ) {
            $this->db->where( 'LOWER(students.gender)', strtolower( $gender ) );
        }

        $q = $this->db->get();

        return $q->result_array();
    }


    public function new_students1( $class = null, $section = null, $date_from = null, $date_to = null, $gender = null )
    {
        $this->db->select( 'students.*, classes.class, classes.fee AS class_fee, sections.section' )
        ->join( 'student_session', 'student_session.student_id = students.id', 'inner' )
            ->join( 'classes', 'classes.id = student_session.class_id', 'inner' )
            ->join( 'sections', 'sections.id = student_session.section_id', 'inner' )
            ->from( 'students' );
        
        if ( $date_from !== null ) {
            $this->db->where( 'students.admission_date >=', date( 'Y-m-d', strtotime( $date_from ) ) );
        }

        if ( $date_to !== null ) {
            $this->db->where( 'students.admission_date <=', date( 'Y-m-d', strtotime( $date_to ) ) );
        }

        if ( !empty( $gender ) ) {
            $this->db->where( 'LOWER(students.gender)', strtolower( $gender ) );
        }
        $q = $this->db->get();
        $students = $q->result_array();

        for ( $i = 0; $i < count( $students ); $i++ ) {
            $students[$i]['class'] = $this->student_model->get_session_class( $students[$i]['id'] );
        }
        return $students;

    
    }
   
    public function get_session_class( $student_id  )
    {
        $this->db->select( 'classes.class,sections.section' )
        ->join( 'classes', 'classes.id = student_session.class_id', 'inner' )
        ->join( 'sections', 'sections.id = student_session.section_id', 'inner' )
        ->from( 'student_session' );

        $this->db->where( 'student_session.session_id', $this->current_session );
        if (!empty($student_id)) {
            $this->db->where( 'student_session.student_id', $student_id);
        }  
    
         $q = $this->db->get();
         return $q->row_array();   
    }

    public function gender_wise_count( $class = null, $section = null, $gender = null )
    {
        $this->db
            ->from( 'student_session' )
            ->join( 'students', 'students.id = student_session.student_id', 'inner' );

        if ( $class !== null ) {
            $this->db->where( 'student_session.class_id', $class );
        }

        if ( $section !== null ) {
            $this->db->where( 'student_session.section_id', $section );
        }

        if ( $gender != null ) {
            $this->db->where( 'LOWER(students.gender)', strtolower( $gender ) );
        }

        $cnt = $this->db->count_all_results();

        return $cnt;
    }

    public function free_students_from_logs( $class_id = null, $section_id = null, $date_from = null, $date_to = null, $gender = null )
    {

        $this->db
            ->select( 'students.*, classes.class,classes.fee, sections.section' )
            ->from( 'student_logs' )
            ->join( 'student_session', 'student_session.id = student_logs.student_session_id', 'inner' )
            ->join( 'students', 'students.id = student_session.student_id', 'inner' )
            ->join( 'classes', 'classes.id = student_session.class_id', 'inner' )
            ->join( 'sections', 'sections.id = student_session.section_id', 'inner' )
            ->where( 'student_logs.free', 1 );
        $next_month = date("Y-m-d",strtotime("first day of +1 month"));
        $this->db->where("(students.updated_at >= '$next_month' OR students.updated_at  = '0000-00-00 00:00:00' OR students.updated_at IS Null)");

        if ( $class_id !== null ) {
            $this->db->where( 'student_session.class_id', $class_id );
        }

        if ( $section_id !== null ) {
            $this->db->where( 'student_session.section_id', $section_id );
        }

        if ( $date_from !== null ) {
            $this->db->where( 'student_logs.created_on >=', date( 'Y-m-d', strtotime( $date_from ) ) );
        }

        if ( $date_to !== null ) {
            $this->db->where( 'student_logs.created_on <=', date( 'Y-m-d', strtotime( $date_to ) ) );
        }

        if ( $gender !== null ) {
            $this->db->where( 'LOWER(students.gender)', strtolower( $gender ) );
        }

        $q = $this->db->get();

        return $q->result_array();
    }

    public function total_student_from_logs( $class_id = null, $section_id = null, $date_from = null, $date_to = null, $gender = null )
    {
        $this->db
            ->select( 'students.*, classes.class, sections.section' )
            ->from( 'student_session' )
            ->join( 'students', 'students.id = student_session.student_id', 'inner' )
            ->join( 'classes', 'classes.id = student_session.class_id', 'inner' )
            ->join( 'sections', 'sections.id = student_session.section_id', 'inner' );

        if ( $class_id !== null ) {
            $this->db->where( 'student_session.class_id', $class_id );
        }

        if ( $section_id !== null ) {
            $this->db->where( 'student_session.section_id', $section_id );
        }

        if ( $date_from !== null ) {
            $this->db->where( 'student_session.created_at >=', date( 'Y-m-d', strtotime( $date_from ) ) );
        }

        if ( $date_to !== null ) {
            $this->db->where( 'student_session.created_at <=', date( 'Y-m-d', strtotime( $date_to ) ) );
        }

        if ( !empty( $gender ) ) {
            $this->db->where( 'LOWER(students.gender)', strtolower( $gender ) );
        }

        $q = $this->db->get();

        return $q->result_array();
    }

    public function getStudentsForLatePaymentFee( $current_date = null )
    {
        if ( $current_date === null ) {
            $current_date = new DateTime( date( 'Y-m-d', now() ) );
        } else {
            $current_date = new DateTime( date( 'Y-m-d', strtotime( $current_date ) ) );
        }

        $current_session_students = $this->searchCurrentSessionStudents();
        $students = array();
        foreach ( $current_session_students as $session_student ) {
            $student_advance_status = false;
            $student_fee_payment = $this->student_fee_payments->get( null, $session_student['id'], null, 'DESC', $current_date->format( 'Y-m-' ) );

            if ( $student_fee_payment === false ) {
                $student_fee_payment = $this->student_advance->get($session_student['id'], $current_date->format( 'Y-m-' ) );
                $student_advance_status = true;
            }

            if ( $student_fee_payment === false ) {
                $students[] = $session_student;
            } else {
                // by default assume there is not tuition fee
                $tuition_fee = false;
                // calculate if there is tuition fee in current month
                foreach ( $student_fee_payment as $sfp ) {
                    if ($student_advance_status == true) {
                        if ( floatval( $sfp['advance_fee'] ) > 0 ) {
                            $tuition_fee = true;
                            break;
                        }
                    }else{
                        if ( floatval( $sfp['tuition_fee'] ) > 0 ) {
                            $tuition_fee = true;
                            break;
                        }
                    }
                }

                // if there is not tuition fee in payments
                if ( $tuition_fee === false ) {
                    $students[] = $session_student;
                }
            }
        }

        return $students;
    }
    public function keepUpdatingLatePaymentFee()
    {

        $last_date_for_receiving_fee    = $this->custom_option_model->get( 'last_date_for_receiving_fee' );
        $last_date_for_receiving_fee    = intval( $last_date_for_receiving_fee['value'] );
        $fine_per_day_for_fee           = $this->custom_option_model->get( 'fine_per_day_for_fee' );
        $fine_per_day_for_fee           = intval( $fine_per_day_for_fee['value'] );
        $student_fee_fine_type          = $this->custom_option_model->get( 'student_fee_fine_type' );
        $student_fee_fine_type          = $student_fee_fine_type['value'];  
     
        $current_date = new DateTime( date( 'Y-m-d', now() ) );

        if ( intval( $current_date->format( 'j' ) ) > $last_date_for_receiving_fee ) {
            // get students who haven't paid their fee yet.
            $students = $this->getStudentsForLatePaymentFee( $current_date->format( 'Y-m-d' ) );

            foreach ( $students as $student ) {

                // if student fee starting date is null or current date is greater or equal to fee starting date
                if ( empty( $student['fee_starting_date'] ) || now() >= strtotime( $student['fee_starting_date'] ) ) {
                    // if last payment update date is 0000-00-00 OR month year are NOT same as current month
                    if ( $student['late_payment_fee_update_date'] == '0000-00-00' || date( 'Y-m', strtotime( $student['late_payment_fee_update_date'] ) ) != $current_date->format( 'Y-m' ) ) {
                        $old_update_date = $current_date->format( "Y-m-{$last_date_for_receiving_fee}" );
                        
                    } else {
                        $old_update_date = $student['late_payment_fee_update_date'];
                        
                    }
                    
                    // if fine type is of fine per day
                    if ( $student_fee_fine_type == 'per_day_fine_after_due_date' ) {
                        // if old update date is not today's date
                        // and old update date is less than today's date
                        
                        if (
                            $old_update_date != $current_date->format( 'Y-m-d' )
                            &&
                            strtotime( $old_update_date ) < $current_date->getTimestamp()
                        ) {
                            $difference_of_days = $this->general_library->day_difference_between_two_dates( $current_date->format( 'Y-m-d' ), $old_update_date, true );

                            $fine = $difference_of_days * $fine_per_day_for_fee;

                            $student['late_payment_fee'] = floatval( $student['late_payment_fee'] ) + $fine;

                            // updating late payment fee, late payment updation date and fee arrears
                            $this->db->update( 'students', [
                                'late_payment_fee' => $student['late_payment_fee'],
                                'late_payment_fee_update_date' => $current_date->format( 'Y-m-d' ),
                                'fee_arrears' => floatval( $student['fee_arrears'] ) + $fine
                            ], [
                                'id' => $student['id']
                            ] );
                        }
                    } elseif ( $student_fee_fine_type == 'fixed_fine_after_due_date' ) {
                        if ( $student['late_payment_fee_update_date'] == '0000-00-00' || date( 'Y-m', strtotime( $student['late_payment_fee_update_date'] ) ) != $current_date->format( 'Y-m' ) ) {
                            $old_update_date = $student['late_payment_fee_update_date'];
                        }
                        $ldfrf = date( 'Y-m-' . $last_date_for_receiving_fee, now() );

                        // if last update date is less than due date

                        if ( strtotime( $old_update_date ) < strtotime( $ldfrf ) ) {
                            // adding fine to late payment fee
                            $student['late_payment_fee'] = floatval( $student['late_payment_fee'] ) + $fine_per_day_for_fee;
                            // updating late payment fee, late payment updation date and fee arrears
                            $this->db->update( 'students', [
                                'late_payment_fee' => $student['late_payment_fee'],
                                'late_payment_fee_update_date' => $current_date->format( 'Y-m-d' ),
                                'fee_arrears' => floatval( $student['fee_arrears'] ) + $fine_per_day_for_fee
                            ], [
                                'id' => $student['id']
                            ] );
                        }
                    }

                }

            }
        }
    }

    public function calculate_attendance( $class_id = null, $section_id = null, $attendance_date = null )
    {
        $this->db
            ->select( 'attendence_type.type, attendence_type.key_value, COUNT(attendence_type.type) AS attendance_count' )
            ->from( 'student_session' )
            ->join( 'student_attendences', 'student_attendences.student_session_id = student_session.id', 'inner' )
            ->join( 'attendence_type', 'student_attendences.attendence_type_id = attendence_type.id', 'inner' )
            ->group_by( 'attendence_type.type' );

        if ( $class_id !== null ) {
            $this->db->where( 'student_session.class_id', $class_id );
        }

        if ( $section_id !== null ) {
            $this->db->where( 'student_session.section_id', $section_id );
        }

        if ( $attendance_date !== null ) {
            $this->db->where( 'student_attendences.date', $attendance_date );
        }

        $q = $this->db->get();

        $results = $q->result_array();

        $total = 0;
        foreach ( $results as $result ) {
            $total += intval( $result['attendance_count'] );
        }


        return [
            'attendance_types' => $results,
            'total_attendance' => $total
        ];
    }



    public function total_absent_students( $date = null )
    {
        $this->db->select( '*' )
            ->from( 'student_attendences' )
            ->join( 'attendence_type', 'attendence_type.id = student_attendences.attendence_type_id', 'inner' )
            ->join( 'student_session', 'student_session.id = student_attendences.student_session_id', 'inner' )
            ->join( 'students', 'students.id = student_session.student_id', 'inner' )
            ->where( "LOWER(attendence_type.type) = 'absent'" );

        if ( $date !== null ) {
            $this->db->where( 'student_attendences.date', date( 'Y-m-d', strtotime( $date ) ) );
        }

        $q = $this->db->get();

        $students = $q->result_array();

        for ( $i = 0; $i < count( $students ); $i++ ) {
            $students[$i]['class'] = $this->class_model->get( $students[$i]['class_id'] );
            $students[$i]['section'] = $this->section_model->get( $students[$i]['section_id'] );
        }

        return $students;
    }

    public function total_leave_students( $date = null )
    {
        $this->db->select( '*' )
            ->from( 'student_attendences' )
            ->join( 'attendence_type', 'attendence_type.id = student_attendences.attendence_type_id', 'inner' )
            ->join( 'student_session', 'student_session.id = student_attendences.student_session_id', 'inner' )
            ->join( 'students', 'students.id = student_session.student_id', 'inner' )
            ->where( "LOWER(attendence_type.type) = 'leave'" );

        if ( $date !== null ) {
            $this->db->where( 'student_attendences.date', date( 'Y-m-d', strtotime( $date ) ) );
        }

        $q = $this->db->get();

        $students = $q->result_array();

        for ( $i = 0; $i < count( $students ); $i++ ) {
            $students[$i]['class'] = $this->class_model->get( $students[$i]['class_id'] );
            $students[$i]['section'] = $this->section_model->get( $students[$i]['section_id'] );
        }

        return $students;
    }

}
