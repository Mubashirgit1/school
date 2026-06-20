<?php
class Family extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper( 'file' );
        $this->lang->load( 'message', 'english' );
    }

    public function index()
    {
        $this->session->set_userdata( 'top_menu', 'Reports' );
        $this->session->set_userdata( 'sub_menu', 'family/index' );

        $data = [
            'title' => 'Family List'
        ];

        $family_list = $this->student_model->family_list();
        $data['family_list'] = $family_list;

        $this->load->view( 'layout/header', $data );
        $this->load->view( 'family/index', $data );
        $this->load->view( 'layout/footer', $data );
    }

    public function children( $id = null )
    {


        $student  =$this->student_model->get($id);

        if ( $student['father_phone'] === null && $student['father_cnic'] === null ) {
            show_404( 'Page you are trying to access does not exists!' );
        } else {

            $data = [
                'title' => "Family children details"
            ];

            $sibling_type = $this->custom_option_model->get( 'sibling_type' );
        
            if($sibling_type['value'] == "phone_sibling" && $student['father_phone'] != null){

                $children = $this->student_model->family_children( $student['father_phone'] , null  ); 

            }elseif( $sibling_type['value'] == "cnic_sibling" && $student['father_cnic'] != null){

                $children  = $this->student_model->family_children(null,$student['father_cnic']);

            }
            if ( $children !== false ) {
                for ( $i = 0; $i < count( $children ); $i++ ) {
                    $children[$i]['std_details'] = $this->student_model->get($children[$i]['id']);
                }
            }
            $data['children'] = $children;
            $this->load->view( 'layout/header', $data );
            $this->load->view( 'family/children', $data );
            $this->load->view( 'layout/footer', $data );

        }
    }
    public function children_summary( $id = null  )
    {
        if ( $id === null ) {
            $phone = $this->input->post( 'phone' );

            $children = $this->student_model->family_children(  $phone);

        }else{

            $student  =$this->student_model->get($id);

            $sibling_type = $this->custom_option_model->get( 'sibling_type' );
           
            if($sibling_type['value'] == "phone_sibling" && $student['father_phone'] != null){

                $children = $this->student_model->family_children( $student['father_phone'] , null  ); 

            }elseif( $sibling_type['value'] == "cnic_sibling" && $student['father_cnic'] != null){

                $children  = $this->student_model->family_children(null,$student['father_cnic']);

            }

        }

        if (  $children === null ) {
            show_404( 'Page you are trying to access does not exists!' );
        } else {
            $data = [
                'title' => "Family children details"
            ];

            $data['children2'] =    $children;
            if(date('m', now()) > '2'){
                $start = 1;
                $end = 13;
            }else{
                $start = 3;
                $end = 15;
            }
            for ( $i = 0; $i < count($children); $i++ ){
                $children[$i]['voucher_id'] = $this->student_fee_voucher_model->get_unpaid_sibling($children[$i]['id'],null );
                for ( $j = $start; $j < $end; $j++ ){
                    $year_child =  date( 'Y', now());
                    if( $j >= 13 ){
                        $annual_child = $j - 12;
                    }elseif( $j<=12){
                        if(date('m', now()) > '2'){
                            $year_child =  date( 'Y', now());
                        }
                        else{
                            $year_child =  date("Y",strtotime("-1 year"));
                        }
                        $annual_child = str_pad($j,2,0,STR_PAD_LEFT);
                    }
                    $data3 = [
                        'year' => "{$year_child}",
                        'month' => "{$annual_child}", ];
                    $children[$i]['advance'][$j]      = $this->student_model->get_advance_annual_sibling($children[$i]['id'], $data3);
                    $children[$i]['tuition'][$annual_child]         = $this->student_fee_payments->get_total_received_fee_per_month2( "{$year_child}-{$annual_child}-01",$children[$i]['id']  );
                    $children[$i]['other_fee'][$annual_child] = $this->student_fee_payments_other->sum_by_month2("{$year_child}-{$annual_child}-01",$children[$i]['id'] );
                }
                $children[$i]['other_fee_due'] = $this->student_fee_voucher_model->get_unpaid_other2($children[$i]['id'] );
            }

            $data['children']                    = $children;

            $this->load->view( 'layout/header', $data );
            $this->load->view( 'family/children_summary', $data );
            $this->load->view( 'layout/footer', $data );

        }
    }

}