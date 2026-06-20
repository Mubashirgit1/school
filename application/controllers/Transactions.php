<?php

class Transactions extends Admin_Controller
{
    function __construct()
    {
        parent::__construct();
        
        $this->load->helper( 'file' );
        $this->lang->load( 'message', 'english' );
    }

    public function daily()
    {
        $this->session->set_userdata( 'top_menu', 'Reports' );
        $this->session->set_userdata( 'sub_menu', 'transactions/daily' );

        $date = date( 'Y-m-d h:i:s', now() );

        $date_from = $this->input->get( 'date_from' );

        $date_to = $this->input->get( 'date_to' );


        $date_from= $date_from;
        $date_to =$date_to;


        $data = [
            'title'     => 'Daily Transactions',
            'date'      => $date,
            'date_from' => $date_from,
            'date_to'   => $date_to
        ];

        $advance_payments = $this->student_model->get_advance_month($data);

        $transactions = $this->transactions_model->get( $date, $date_from, $date_to );

        if ( $transactions !== false ) {

            $date_from_to = "";

            if ( $date !== null || $date_from !== null || $date_to !== null ) {
                if ( $date_from !== null && $date_to !== null ) {
                    $date_from_to = "date_from=" . urlencode( date( 'm/d/Y', strtotime( $date_from ) ) ) . "&date_to=" . urlencode( date( 'm/d/Y', strtotime( $date_to ) ) );
                } else if ( $date !== null ) {
                    $date_from_to = "date_from=" . urlencode( date( 'm/d/Y', strtotime( $date ) ) ) . "&date_to=" . urlencode( date( 'm/d/Y', strtotime( $date ) ) );
                }
            }

            for ( $i = 0; $i < count( $transactions ); $i++ ) {

                switch ( $transactions[$i]['head'] ) {
                    case 'fee':
                        $url = "Fee_management/fee_reports?search=search_filter&" . $date_from_to;
                        break;
                    case 'expense':
                        $url = "admin/expense/expenseSearch?head_name=" . urlencode( $transactions[$i]['name'] ) . "&search=search_filter&" . $date_from_to;
                        break;
                    case 'salary':
                        $url = "admin/teacher/salary_report?" . $date_from_to;
                        break;
                    case 'staff_salary':
                        $url = "admin/staff/salary_report?" . $date_from_to;
                        break;
                    case 'inventory':
                        $url = "admin/inventory/inventorysearch?" . $date_from_to;
                        break;
                    default:
                        $url = null;
                }

                $transactions[$i]['link'] = $url;
            }
        }

        $data['transactions']       = $transactions;

        $data['advance_payments']   = $advance_payments;

        $total = new stdClass();
        $total->in = 0;
        $total->out = 0;
        if ( $transactions !== false ) {
            foreach ( $transactions as $transaction ) {
                if ( $transaction['type'] == 'in' ) {
                    $total->in += intval( $transaction['amount'] );
                }

                if ( $transaction['type'] == 'out' ) {
                    $total->out += intval( $transaction['amount'] );
                }
            }
        }



        $data['total'] = $total;

        $date                       = "(".$date_from." - ".$date_to.")";
        $data['print_title']        = "Financial Transactions (Revenue & Payments) ".$date;

        $this->load->view( 'layout/header', $data );
        $this->load->view( 'transactions/daily', $data );
        $this->load->view( 'layout/footer', $data );
    }

    public function credit_process()
    {

      
        $id                 = $this->input->post( 'id' );

        $account_name       = $this->input->post( 'account_name' );

        $account_date       = $this->input->post( 'account_date' );

        $assets             = $this->input->post( 'assets' );

        $account_opening    = $this->input->post( 'opening_balance' );

        $transfer_date      = $this->input->post( 'transfer_date' );

        $transfer_debit     = $this->input->post( 'transfer_debit' );

        $transfer_credit    = $this->input->post( 'transfer_credit' );

        $cheque             = $this->input->post( 'cheque' );

        $description        = $this->input->post( 'description' );

        $amount             = $this->input->post( 'amount' );

        if($transfer_date == null){
         
            if($account_date !== null){
                // insert record in account
                $data_account = array(
                    'name' => $account_name,
                    'opening_account' =>$account_opening,
                    'type' => $assets,
                    'date' => date('Y-m-d', strtotime($account_date)),
                );
                $this->transactions_model->add_account( $data_account );
            }


        }else{

            $credit      = $this->transactions_model->get_account($transfer_credit);

            $debit      = $this->transactions_model->get_account($transfer_debit);

            if($id != null){



                $bank    = $this->transactions_model->get_bank($id);
                exit;

                /*    if($amount == $bank['amount']){
                       $total_debit  = floatval($debit['opening_account']);
                       $total_credit = floatval($credit['opening_account']);
                    }elseif($amount > $bank['amount']){
                       $rupee = $bank['amount'] - $amount;
                       $total_debit  = floatval($debit['opening_account']) + floatval($rupee);
                       $total_credit = floatval($credit['opening_account']) - floatval($rupee);
                    }elseif($amount < $bank['amount']){
                       $rupee =  $amount - $bank['amount'];
                       $total_debit  = floatval($debit['opening_account']) - floatval($rupee);
                       $total_credit = floatval($credit['opening_account']) + floatval($rupee);
                   }*/
            }else{
                $total_debit  = floatval($debit['opening_account']) - floatval($amount);
                $total_credit = floatval($credit['opening_account']) + floatval($amount);
            }
            
            $data_history = array(
                'id'    => $id,
                'date'   =>   date('Y-m-d', strtotime($transfer_date)),
                'credit' => $transfer_credit,
                'debit' => $transfer_debit,
                'type' => $cheque,
                'description' => $description,
                'debit_balance' => $total_debit,
                'credit_balance' => $total_credit,
                'amount' => $amount,

            );
           
            $this->db->update( 'account', array(
                'opening_account' => $total_debit,
            ), array(
                'id' => $transfer_debit
            ) );

            $this->db->update( 'account', array(
                'opening_account' => $total_credit,
            ), array(
                'id' => $transfer_credit
            ) );

            $this->transactions_model->add_transfer( $data_history );
      
        }

        redirect('transactions/bank');

    }

    public function bank()
    {

        $this->session->set_userdata( 'top_menu', 'TeacherAttendance' );
        $this->session->set_userdata( 'sub_menu', 'teacher/index' );
        $date_to            = $this->input->get( 'date_to' );
        $date_from            = $this->input->get( 'date_from' );
        if($date_from == null ){
            $date_from = date("m/d/Y", now());
        }
        if($date_to == null ){
            $date_to = date("m/d/Y", now());
        }
        $data = array(
            'title'         => "Amount Transfer/Withdrawl Section",
            'date_from'     => $date_from,
            'date_to'       => $date_to,
        );
        $account_cash      = $this->transactions_model->get_account(null,null,'cash in hand');
        $account      = $this->transactions_model->get_account();
        
        if($account_cash){
            $debit_transfer2    = $this->transactions_model->get_account_transfer($account_cash[0]['id'],null, null);
        }
        foreach($debit_transfer2 as $debit){
            $total_debit = 0;
            foreach($debit['debit'] as $debit2){
                $total_debit   += $debit2['amount'];
            }
            $total_credit = 0;
            foreach($debit['credit'] as $credit){
                $total_credit    += $credit['amount'];
            }
        }
        $day        = date("d");
        $month      = ( !empty( $month ) ? $month : date( 'm' ) );
        $year       = ( !empty( $year ) ? $year : date( 'Y') );
        $date_to    = date( 'Y-m-d', strtotime( "{$year}-{$month}-{$day}" ));
        $date       = date( 'Y-m-d');
        $date_previous  = date("m") <= 2 ? date("Y-03-01",strtotime("-1 year")) : date("Y-03-01");
        $transactions_year   = $this->transactions_model->get( $date, $date_previous, $date_to );
        $total_year = 0;
        foreach ( $transactions_year as $transaction_year ){
            if ( $transaction_year['type'] == 'out' ){
                $revenue_year  = $transaction_year['amount'];
                $total_year += $revenue_year;
            }
        }
        $total_year_fee = 0;
        foreach ( $transactions_year as $transaction_year ){
            if ( $transaction_year['type'] == 'in' ){
                $revenue_year_fee  = $transaction_year['amount'];
                $total_year_fee += $revenue_year_fee;
            }
        }
        $total_year_collection = $total_year_fee -  $total_year ;

        $total_year_collection_debit_credit = $total_year_collection - $total_debit  + $total_credit;

            if($account_cash){
                $data_account = array(
                    'id' => $account_cash[0]['id'],
                    'name' => 'cash in hand',
                    'opening_account' =>   $total_year_collection_debit_credit,
                    'type' => 'assets',
                    'date' => date('Y-m-d', now()),
                );
                $this->transactions_model->add_account( $data_account );
            }
        


        $payment_type      = $this->transactions_model->get_payment_type();

        $assets            = $this->transactions_model->get_account(null, 'assets');

        $liabilties        = $this->transactions_model->get_account(null, 'liabilties');

        $debit_transfer    = $this->transactions_model->get_account_transfer(null,$date_from, $date_to);

        $bank_transfer     = $this->transactions_model->get_bank_transfer(null,$date_from, $date_to);

        $opening = 0;
           foreach($assets as $asset){

               if($asset['name'] == 'cash in hand' ){
                $opening  = $asset['opening_account'];
               }
           }


        $date_from_msg = date( 'Y-m-d', now() ) ;
        $date_to_msg = date( 'Y-m-d', now() );

        $transactions = $this->transactions_model->get( $date,  $date_from_msg , $date_to_msg  );
        $expense = 0;
        $collection = 0;

        foreach($transactions as $tran){
            if($tran['type'] == 'in'){
                $collection += $tran['amount'];
            }
            if($tran['type'] == 'out'){
                $expense +=$tran['amount'];
            }
        }

        foreach ( $debit_transfer as $debit ) {
            if($debit['name'] == "cash in hand") {
             $total_debit = 0;
            foreach($debit['debit'] as $debit2){
                    $total_debit += $debit2['amount'];
            }
            $total_credit = 0;
            foreach($debit['credit'] as $credit){
             $total_credit    += $credit['amount'];
            }
            }

        }

        $admin_phone = $this->custom_option_model->get( 'admin_phone' );
        $date_now = date('M-Y');

        $this->sms_library->send_sms( $admin_phone['value'], $this->sms_messages->daily_balance( $date_now, $opening , $expense, $collection,$total_credit , $total_debit ) );

        $data['assets']            = $assets;
        $data['liabilties']        = $liabilties;
        $data['account']           = $account;
        $data['bank_transfer']     = $bank_transfer;
        $data['debit_transfer']    = $debit_transfer;
        $data['payment_type']      = $payment_type;

        $this->load->view( 'layout/header', $data );

        $this->load->view( 'transactions/bank_list', $data );

        $this->load->view( 'layout/footer', $data );
    }


    public function assets_liabilties()
    {

        $this->session->set_userdata( 'top_menu', 'TeacherAttendance' );
        $this->session->set_userdata( 'sub_menu', 'teacher/index' );
        $date_to            = $this->input->get( 'date_to' );
        $date_from            = $this->input->get( 'date_from' );
        if($date_from == null ){
            $date_from = date("m/d/Y", now());
        }
        if($date_to == null ){
            $date_to = date("m/d/Y", now());
        }
        $data = array(
            'title'         => "Amount Transfer/Withdrawl Section",
            'date_from'     => $date_from,
            'date_to'       => $date_to,
        );
        $account_cash      = $this->transactions_model->get_account(null,null,'cash in hand');
        
        if($account_cash){
            $debit_transfer2    = $this->transactions_model->get_account_transfer($account_cash[0]['id'],null, null);
        }
        foreach($debit_transfer2 as $debit){
            $total_debit = 0;
            foreach($debit['debit'] as $debit2){
                $total_debit   += $debit2['amount'];
            }
            $total_credit = 0;
            foreach($debit['credit'] as $credit){
                $total_credit    += $credit['amount'];
            }
        }
        $day        = date("d");
        $month      = ( !empty( $month ) ? $month : date( 'm' ) );
        $year       = ( !empty( $year ) ? $year : date( 'Y') );
        $date_to    = date( 'Y-m-d', strtotime( "{$year}-{$month}-{$day}" ));
        $date       = date( 'Y-m-d');
        $date_previous  = date("m") <= 2 ? date("Y-03-01",strtotime("-1 year")) : date("Y-03-01");
        $transactions_year   = $this->transactions_model->get( $date, $date_previous, $date_to );
        $total_year = 0;
        foreach ( $transactions_year as $transaction_year ){
            if ( $transaction_year['type'] == 'out' ){
                $revenue_year  = $transaction_year['amount'];
                $total_year += $revenue_year;
            }
        }
        $total_year_fee = 0;
        foreach ( $transactions_year as $transaction_year ){
            if ( $transaction_year['type'] == 'in' ){
                $revenue_year_fee  = $transaction_year['amount'];
                $total_year_fee += $revenue_year_fee;
            }
        }
        $total_year_collection = $total_year_fee -  $total_year ;

        $total_year_collection_debit_credit = $total_year_collection - $total_debit  + $total_credit;

            if($account_cash){
                $data_account = array(
                    'id' => $account_cash[0]['id'],
                    'name' => 'cash in hand',
                    'opening_account' =>   $total_year_collection_debit_credit,
                    'type' => 'assets',
                    'date' => date('Y-m-d', now()),
                );
                $this->transactions_model->add_account( $data_account );
            }
        
        $assets            = $this->transactions_model->get_account(null, 'assets');

        $liabilties        = $this->transactions_model->get_account(null, 'liabilties');

     

        $data['assets']            = $assets;
        $data['liabilties']        = $liabilties;
      

        $this->load->view( 'layout/header', $data );

        $this->load->view( 'transactions/assets_liabilties', $data );

        $this->load->view( 'layout/footer', $data );
    }
    public function transaction_history()
    {

        $this->session->set_userdata( 'top_menu', 'TeacherAttendance' );
        $this->session->set_userdata( 'sub_menu', 'teacher/index' );
        $date_to            = $this->input->get( 'date_to' );
        $date_from            = $this->input->get( 'date_from' );
        if($date_from == null ){
            $date_from = date("m/d/Y", now());
        }
        if($date_to == null ){
            $date_to = date("m/d/Y", now());
        }
        $data = array(
            'title'         => "Amount Transfer/Withdrawl Section",
            'date_from'     => $date_from,
            'date_to'       => $date_to,
        );
        $account_cash      = $this->transactions_model->get_account(null,null,'cash in hand');
        $account      = $this->transactions_model->get_account();
        
        if($account_cash){
            $debit_transfer2    = $this->transactions_model->get_account_transfer($account_cash[0]['id'],null, null);
        }
        foreach($debit_transfer2 as $debit){
            $total_debit = 0;
            foreach($debit['debit'] as $debit2){
                $total_debit   += $debit2['amount'];
            }
            $total_credit = 0;
            foreach($debit['credit'] as $credit){
                $total_credit    += $credit['amount'];
            }
        }
        $day        = date("d");
        $month      = ( !empty( $month ) ? $month : date( 'm' ) );
        $year       = ( !empty( $year ) ? $year : date( 'Y') );
        $date_to    = date( 'Y-m-d', strtotime( "{$year}-{$month}-{$day}" ));
        $date       = date( 'Y-m-d');
        $date_previous  = date("m") <= 2 ? date("Y-03-01",strtotime("-1 year")) : date("Y-03-01");
        $transactions_year   = $this->transactions_model->get( $date, $date_previous, $date_to );
        $total_year = 0;
        foreach ( $transactions_year as $transaction_year ){
            if ( $transaction_year['type'] == 'out' ){
                $revenue_year  = $transaction_year['amount'];
                $total_year += $revenue_year;
            }
        }
        $total_year_fee = 0;
        foreach ( $transactions_year as $transaction_year ){
            if ( $transaction_year['type'] == 'in' ){
                $revenue_year_fee  = $transaction_year['amount'];
                $total_year_fee += $revenue_year_fee;
            }
        }
        $total_year_collection = $total_year_fee -  $total_year ;

        $total_year_collection_debit_credit = $total_year_collection - $total_debit  + $total_credit;

            if($account_cash){
                $data_account = array(
                    'id' => $account_cash[0]['id'],
                    'name' => 'cash in hand',
                    'opening_account' =>   $total_year_collection_debit_credit,
                    'type' => 'assets',
                    'date' => date('Y-m-d', now()),
                );
                $this->transactions_model->add_account( $data_account );
            }
        


        $payment_type      = $this->transactions_model->get_payment_type();

        $bank_transfer     = $this->transactions_model->get_bank_transfer(null,$date_from, $date_to);

        $data['account']           = $account;
        $data['bank_transfer']     = $bank_transfer;
   
        $data['payment_type']      = $payment_type;

        $this->load->view( 'layout/header', $data );

        $this->load->view( 'transactions/transaction_history', $data );

        $this->load->view( 'layout/footer', $data );
    }

    public function account()
    {

        $this->session->set_userdata( 'top_menu', 'TeacherAttendance' );
        $this->session->set_userdata( 'sub_menu', 'teacher/index' );
        $date_to            = $this->input->get( 'date_to' );
        $date_from            = $this->input->get( 'date_from' );
        if($date_from == null ){
            $date_from = date("m/d/Y", now());
        }
        if($date_to == null ){
            $date_to = date("m/d/Y", now());
        }
        $data = array(
            'title'         => "Amount Transfer/Withdrawl Section",
            'date_from'     => $date_from,
            'date_to'       => $date_to,
        );
        $account_cash      = $this->transactions_model->get_account(null,null,'cash in hand');
        $account      = $this->transactions_model->get_account();
        
        if($account_cash){
            $debit_transfer2    = $this->transactions_model->get_account_transfer($account_cash[0]['id'],null, null);
        }
        foreach($debit_transfer2 as $debit){
            $total_debit = 0;
            foreach($debit['debit'] as $debit2){
                $total_debit   += $debit2['amount'];
            }
            $total_credit = 0;
            foreach($debit['credit'] as $credit){
                $total_credit    += $credit['amount'];
            }
        }
        $day        = date("d");
        $month      = ( !empty( $month ) ? $month : date( 'm' ) );
        $year       = ( !empty( $year ) ? $year : date( 'Y') );
        $date_to    = date( 'Y-m-d', strtotime( "{$year}-{$month}-{$day}" ));
        $date       = date( 'Y-m-d');
        $date_previous  = date("m") <= 2 ? date("Y-03-01",strtotime("-1 year")) : date("Y-03-01");
        $transactions_year   = $this->transactions_model->get( $date, $date_previous, $date_to );
        $total_year = 0;
        foreach ( $transactions_year as $transaction_year ){
            if ( $transaction_year['type'] == 'out' ){
                $revenue_year  = $transaction_year['amount'];
                $total_year += $revenue_year;
            }
        }
        $total_year_fee = 0;
        foreach ( $transactions_year as $transaction_year ){
            if ( $transaction_year['type'] == 'in' ){
                $revenue_year_fee  = $transaction_year['amount'];
                $total_year_fee += $revenue_year_fee;
            }
        }
        $total_year_collection = $total_year_fee -  $total_year ;

        $total_year_collection_debit_credit = $total_year_collection - $total_debit  + $total_credit;

            if($account_cash){
                $data_account = array(
                    'id' => $account_cash[0]['id'],
                    'name' => 'cash in hand',
                    'opening_account' =>   $total_year_collection_debit_credit,
                    'type' => 'assets',
                    'date' => date('Y-m-d', now()),
                );
                $this->transactions_model->add_account( $data_account );
            }
        


        $payment_type      = $this->transactions_model->get_payment_type();

        $assets            = $this->transactions_model->get_account(null, 'assets');

        $liabilties        = $this->transactions_model->get_account(null, 'liabilties');

        $debit_transfer    = $this->transactions_model->get_account_transfer(null,$date_from, $date_to);

        $bank_transfer     = $this->transactions_model->get_bank_transfer(null,$date_from, $date_to);

        $opening = 0;
           foreach($assets as $asset){

               if($asset['name'] == 'cash in hand' ){
                $opening  = $asset['opening_account'];
               }
           }


        $date_from_msg = date( 'Y-m-d', now() ) ;
        $date_to_msg = date( 'Y-m-d', now() );

        $transactions = $this->transactions_model->get( $date,  $date_from_msg , $date_to_msg  );
        $expense = 0;
        $collection = 0;

        foreach($transactions as $tran){
            if($tran['type'] == 'in'){
                $collection += $tran['amount'];
            }
            if($tran['type'] == 'out'){
                $expense +=$tran['amount'];
            }
        }

        foreach ( $debit_transfer as $debit ) {
            if($debit['name'] == "cash in hand") {
            $total_debit = 0;
            foreach($debit['debit'] as $debit2){
                    $total_debit += $debit2['amount'];
            }
            $total_credit = 0;
            foreach($debit['credit'] as $credit){
             $total_credit    += $credit['amount'];
            }
            }

        }

        $admin_phone = $this->custom_option_model->get( 'admin_phone' );
        $date_now = date('M-Y');

        $this->sms_library->send_sms( $admin_phone['value'], $this->sms_messages->daily_balance( $date_now, $opening , $expense, $collection,$total_credit , $total_debit ) );

        $data['assets']            = $assets;
        $data['liabilties']        = $liabilties;
        $data['account']           = $account;
        $data['bank_transfer']     = $bank_transfer;
        $data['debit_transfer']    = $debit_transfer;
        $data['payment_type']      = $payment_type;

        $this->load->view( 'layout/header', $data );

        $this->load->view( 'transactions/account', $data );

        $this->load->view( 'layout/footer', $data );
    }

    public function edit_bank($id)
    {
        $this->session->set_userdata( 'top_menu', 'TeacherAttendance' );
        $this->session->set_userdata( 'sub_menu', 'teacher/index' );

        $date_to            = $this->input->get( 'date_to' );

        $date_from            = $this->input->get( 'date_from' );

        if($date_from == null ){
            $date_from = date("m/d/Y", now());
        }

        if($date_to == null ){
            $date_to = date("m/d/Y", now());
        }

        $data = array(
            'title'         => "Amount Transfer/Withdrawl Section",
            'date_from'     => $date_from,
            'date_to'       => $date_to,
        );

        $bank    = $this->transactions_model->get_bank($id);

        $account      = $this->transactions_model->get_account();

        $assets      = $this->transactions_model->get_account(null, 'assets');

        $liabilties      = $this->transactions_model->get_account(null, 'liabilties');

        $bank_transfer    = $this->transactions_model->get_bank_transfer(null,$date_from, $date_to);

        $debit_transfer    = $this->transactions_model->get_account_transfer(null,$date_from, $date_to);

        $payment_type     = $this->transactions_model->get_payment_type();

        $data['payment_type']           = $payment_type;
        $data['assets']           = $assets;
        $data['liabilties']           = $liabilties;
        $data['account']           = $account ;
        $data['bank_transfer']     = $bank_transfer ;
        $data['debit_transfer']    = $debit_transfer ;
        $data['bank']    = $bank ;

        $this->load->view( 'layout/header', $data );

        $this->load->view( 'transactions/bank_edit', $data );

        $this->load->view( 'layout/footer', $data );
    }

    public function view_transaction($id)
    {
        $this->session->set_userdata( 'top_menu', 'TeacherAttendance' );

        $this->session->set_userdata( 'sub_menu', 'teacher/index' );

        $date_to              = $this->input->get( 'date_to' );

        $date_from            = $this->input->get( 'date_from' );

        $id1                   = $this->input->get( 'search' );

        if($date_from == null ){
            $date_from = date("m/d/Y", now());
        }

        if($date_to == null ){
            $date_to = date("m/d/Y", now());
        }

        $data = array(
            'title'         => "Transactions History",
            'date_from'     => $date_from,
            'date_to'       => $date_to,
        );

        if($id1 == null){
            $id = $id;
        }else{
            $id= $id1;
        }

        $account      = $this->transactions_model->get_account();

        $transfer    = $this->transactions_model->get_account_transfer_id($id,$date_from, $date_to);


        $data['transfer']       = $transfer;

        $data['account']       = $account;

        $this->load->view( 'layout/header', $data );
        $this->load->view( 'transactions/transactions_view', $data );
        $this->load->view( 'layout/footer', $data );
    }

    public function delete_account( $id )
    {
        $this->transactions_model->remove( $id );

        $this->session->set_flashdata( 'msg', '<i class="far fa-check-square" aria-hidden="true"></i> Record Deleted Successfully' );
        redirect( 'transactions/bank' );
    }

    public function delete_bank_transfer( $id )
    {
        $bank_transfer    = $this->transactions_model->get_transfer_id($id);

        $credit      = $this->transactions_model->get_account($bank_transfer[0]['credit']);

        $debit      = $this->transactions_model->get_account($bank_transfer[0]['debit']);

        $total_debit	= $debit['opening_account'] + $bank_transfer[0]['amount'];

        $total_credit = $credit['opening_account'] - $bank_transfer[0]['amount'];


        $this->db->update( 'account', array(
            'opening_account' => $total_debit,
        ), array(
            'id' =>$bank_transfer[0]['debit']
        ) );

        $this->db->update( 'account', array(
            'opening_account' => $total_credit,
        ), array(
            'id' => $bank_transfer[0]['credit']
        ) );

        $this->transactions_model->remove_bank( $id );

        $this->session->set_flashdata( 'msg', '<i class="far fa-check-square" aria-hidden="true"></i> Record Deleted Successfully' );
        redirect( 'transactions/bank' );
    }

    public function check_account()
    {

        $debit_id = $this->input->post( 'debit_id' );
        $debit      = $this->transactions_model->get_account($debit_id);
        echo json_encode($debit);


    }

    public function daily_net()
    {
        $this->session->set_userdata( 'top_menu', 'Reports' );
        $this->session->set_userdata( 'sub_menu', 'transactions/daily' );

        $date = date( 'Y-m-d', now() );

        $date_from = $this->input->get( 'date_from' );

        $date_to = $this->input->get( 'date_to' );

        $data = [
            'title' => 'Daily Transactions',
            'date' => $date,
            'date_from' => $date_from,
            'date_to' => $date_to
        ];

        $advance_payments = $this->student_model->get_advance_month($data);

        $transactions = $this->transactions_model->get( $date, $date_from, $date_to );
        if ( $transactions !== false ) {

            $date_from_to = "";

            if ( $date !== null || $date_from !== null || $date_to !== null ) {
                if ( $date_from !== null && $date_to !== null ) {
                    $date_from_to = "date_from=" . urlencode( date( 'm/d/Y', strtotime( $date_from ) ) ) . "&date_to=" . urlencode( date( 'm/d/Y', strtotime( $date_to ) ) );
                } else if ( $date !== null ) {
                    $date_from_to = "date_from=" . urlencode( date( 'm/d/Y', strtotime( $date ) ) ) . "&date_to=" . urlencode( date( 'm/d/Y', strtotime( $date ) ) );
                }
            }

            for ( $i = 0; $i < count( $transactions ); $i++ ) {

                switch ( $transactions[$i]['head'] ) {
                    case 'fee':
                        $url = "fee_management/fee_reports?search=search_filter&" . $date_from_to;
                        break;
                    case 'expense':
                        $url = "admin/expense/expenseSearch?head_name=" . urlencode( $transactions[$i]['name'] ) . "&search=search_filter&" . $date_from_to;
                        break;
                    case 'salary':
                        $url = "admin/teacher/salary_report?" . $date_from_to;
                        break;
                    case 'staff_salary':
                        $url = "admin/staff/salary_report?" . $date_from_to;
                        break;
                    case 'inventory':
                        $url = "admin/inventory/inventorysearch?" . $date_from_to;
                        break;
                    default:
                        $url = null;
                }

                $transactions[$i]['link'] = $url;
            }
        }
        $data['transactions']       = $transactions;
        $data['advance_payments']   = $advance_payments;

        $total = new stdClass();
        $total->in = 0;
        $total->out = 0;
        if ( $transactions !== false ) {
            foreach ( $transactions as $transaction ) {
                if ( $transaction['type'] == 'in' ) {
                    $total->in += intval( $transaction['amount'] );
                }

                if ( $transaction['type'] == 'out' ) {
                    $total->out += intval( $transaction['amount'] );
                }
            }
        }
        $data['total'] = $total;

        $date                       = "(".$date_from." - ".$date_to.")";
        $data['print_title']        = "Financial Transactions (Revenue & Payments) ".$date;

        $this->load->view( 'layout/header', $data );
        $this->load->view( 'transactions/daily_net', $data );
        $this->load->view( 'layout/footer', $data );
    }

    public function teacher_graph2()
    {

        $month = $this->input->post( 'month' );

        $year = $this->input->post( 'year' );

        $year = ( $year !== null ? $year : date( 'Y', now() ) );

        $month = ( $month !== null ? $month : date( 'm', now() ) );

        $days_in_month = cal_days_in_month( CAL_GREGORIAN, $month, $year );

        $attendance_dates = [];
        for ( $day_number = 1; $day_number <= $days_in_month; $day_number++ ) {
            $attendance_dates[] = "{$year}-{$month}-{$day_number}";
        }


        $teachers = $this->teacher_model->get();

        $teache = array();

        for ( $day_number = 1; $day_number <= $days_in_month; $day_number++ ) {


            for ( $i = 0; $i < count( $teachers ); $i++ ) {

                $teache[$day_number][$i] = $this->teacher_attendance_model->search_attendance( $teachers[$i]['id'], "{$year}-{$month}-{$day_number}" );

            }


        }

        echo json_encode($teache);




    }

    public function teacher_graph()
    {

        $data['title'] = 'Teacher Attendance Report (Daily Wise)';

        $year = ( $year !== null ? $year : date( 'Y', now() ) );

        $data['year'] = $year;


        $month = ( $month !== null ? $month : date( 'm', now() ) );
        $data['month'] =$month;

        $days_in_month = cal_days_in_month( CAL_GREGORIAN, $month, $year );


        $attendance_dates = [];
        for ( $day_number = 1; $day_number <= $days_in_month; $day_number++ ) {
            $attendance_dates[] = "{$year}-{$month}-{$day_number}";
        }


        $teachers = $this->teacher_model->get();


        for ( $day_number = 1; $day_number <= $days_in_month; $day_number++ ) {



            for ( $i = 0; $i < count( $teachers ); $i++ ) {

                $teache[$day_number][$i] = $this->teacher_attendance_model->search_attendance( $teachers[$i]['id'], "{$year}-{$month}-{$day_number}" );

            }


        }

        $data['teachers'] = $teache;

        $this->load->view('layout/header', $data);
        $this->load->view('graph/graph', $data);
        $this->load->view( 'layout/footer', $data );
    }

    public function teacher_graph_month2()
    {
        $session = $this->input->post( 'session_id' );

        $first = strtok($session, '-');

        $year = $first + 1;

        $year = ( $year !== null ? $year : date( 'Y', now() ) );

        $data['year'] = $year;

        $month = ( $month !== null ? $month : date( 'm', now() ) );

        $data['month'] =$month;

        $days_in_month = cal_days_in_month( CAL_GREGORIAN, $month, $year );

        $attendance_dates = [];
        for ( $day_number = 1; $day_number <= $days_in_month; $day_number++ ) {
            $attendance_dates[] = "{$year}-{$month}-{$day_number}";
        }
        $teachers = $this->teacher_model->get();

        for ( $j = 3; $j < 15; $j++ ){

            $annual = str_pad($j,2,0,STR_PAD_LEFT);

            if($j >  12){
                $year1 = $year;
                if($annual == 13){
                    $annual = 01;
                }
                if($annual == 14){
                    $annual = 02;
                }
            }else{
                $year1 = $year - 1;
            }
            $days_in_month = cal_days_in_month( CAL_GREGORIAN, $month, $year1 );
            for ( $day_number = 1; $day_number <= $days_in_month; $day_number++ ) {
                for ( $i = 0; $i < count( $teachers ); $i++ ) {
                    $teache[$j][$day_number][$i] = $this->teacher_attendance_model->search_attendance( $teachers[$i]['id'], "{$year1}-{$annual}-{$day_number}" );

                }
            }
        }
        echo json_encode($teache);
    }

    public function teacher_graph_month()
    {

        $year = ( $year !== null ? $year : date( 'Y', now() ) );
        $data['title'] = 'Teacher Attendance Report (Monthly Wise)';
        $data['year'] = $year;



        $this->load->view( 'layout/header', $data );
        $this->load->view('graph/teacher_month_graph', $data);
        $this->load->view( 'layout/footer', $data );
    }

    public function teacher_wise_graph2()
    {

        $month = $this->input->post( 'month' );

        $year = $this->input->post( 'year' );

        $year = ( $year !== null ? $year : date( 'Y', now() ) );



        $month = ( $month !== null ? $month : date( 'm', now() ) );


        $days_in_month = cal_days_in_month( CAL_GREGORIAN, $month, $year );


        $attendance_dates = [];
        for ( $day_number = 1; $day_number <= $days_in_month; $day_number++ ) {
            $attendance_dates[] = "{$year}-{$month}-{$day_number}";
        }


        $teachers = $this->teacher_model->get();

        for ( $i = 0; $i < count( $teachers ); $i++ ) {
            $teachers[$i]['day_attendance'] = array();

            for ( $day_number = 1; $day_number <= $days_in_month; $day_number++ ) {
                $teachers[$i]['day_attendance'][$day_number] = $this->teacher_attendance_model->search_attendance( $teachers[$i]['id'], "{$year}-{$month}-{$day_number}" );


            }
        }
        echo json_encode($teachers);




    }

    public function teacher_wise_graph()
    {

        $year = ( $year !== null ? $year : date( 'Y', now() ) );
        $data['year'] = $year;
        $data['title'] = 'Teacher Attendance Report (Teacher Wise)';

        $month = ( $month !== null ? $month : date( 'm', now() ) );
        $data['month'] = $month;


        $this->load->view('layout/header', $data);
        $this->load->view('graph/teacher_wise', $data);
        $this->load->view( 'layout/footer', $data );
    }

    public function student_month_graph2()
    {

        $month = $this->input->post( 'month' );

        $year = $this->input->post( 'year' );


        $year = ( $year !== null ? $year : date( 'Y', now() ) );

        $month = ( $month !== null ? $month : date( 'm', now() ) );

        $days_in_month = cal_days_in_month( CAL_GREGORIAN, $month, $year );

        $attendance_dates = [];
        for ( $day_number = 1; $day_number <= $days_in_month; $day_number++ ) {
            $attendance_dates[] = "{$year}-{$month}-{$day_number}";
        }


        $studentlist                = $this->student_model->getstudent_id(  );


        for ( $day_number = 1; $day_number <= $days_in_month; $day_number++ ) {


            for ( $i = 0; $i < count( $studentlist ); $i++ ) {

                $teache[$day_number][$i] = $this->stuattendence_model->searchAttendencestudent2( $studentlist[$i]['id'], "{$year}-{$month}-{$day_number}" );

            }


        }
        echo json_encode($teache);

    }

    public function student_month_graph()
    {

// echo "<pre>";
        //     print_r( $students);
        //  echo "</pre>";
        //      exit;
//exit;

        $year = ( $year !== null ? $year : date( 'Y', now() ) );
        $data['year'] = $year;
        $month = ( $month !== null ? $month : date( 'm', now() ) );
        $data['month'] =$month;
        $days_in_month = cal_days_in_month( CAL_GREGORIAN, $month, $year );
        $data['title'] = 'Student Attendance Report (Daily Wise)';

        $this->load->view('layout/header', $data);
        $this->load->view('graph/student_graph', $data);
        $this->load->view( 'layout/footer', $data );
    }

    public function student_all_month2()
    {

        $session = $this->input->post( 'year' );

        $first = strtok($session, '-');

        $year = $first + 1;

        $year = ( $year !== null ? $year : date( 'Y', now() ) );

        $data['session_id'] = $year;

        $month = ( $month !== null ? $month : date( 'm', now() ) );

        $data['month'] =$month;

        $days_in_month = cal_days_in_month( CAL_GREGORIAN, $month, $year );
        $attendance_dates = [];

        $studentlist                = $this->student_model->getstudent_id();

        for ( $j = 3; $j < 15; $j++ ){

            $annual = str_pad($j,2,0,STR_PAD_LEFT);

            if($j >  12){
                $year1 = $year;
                if($annual == 13){
                    $annual = 01;
                }
                if($annual == 14){
                    $annual = 02;
                }
            }else{
                $year1 = $year - 1;
            }
            $days_in_month = cal_days_in_month( CAL_GREGORIAN, $month, $year );
            for ( $day_number = 1; $day_number <= $days_in_month; $day_number++ ) {
                for ( $i = 0; $i < count(  $studentlist  ); $i++ ) {
                    $teache[$j][$day_number][$i] = $this->stuattendence_model->searchAttendencestudent2( $studentlist[$i]['id'], "{$year1}-{$annual}-{$day_number}" );

                }
            }
        }

        echo json_encode($teache);

    }

    public function student_all_specific()
    {

        $year = $this->input->post( 'year' );

        $student_id = $this->input->post( 'student_id' );


        $year = ( $year !== null ? $year : date( 'Y', now() ) );

        $data['year'] = $year;

        $month = ( $month !== null ? $month : date( 'm', now() ) );

        $data['month'] =$month;

        $days_in_month = cal_days_in_month( CAL_GREGORIAN, $month, $year );


        $attendance_dates = [];
        for ( $day_number = 1; $day_number <= $days_in_month; $day_number++ ) {
            $attendance_dates[] = "{$year}-{$month}-{$day_number}";
        }

        $studentlist                = $this->student_model->getstudent_id();
        for ( $j = 1; $j < 13; $j++ ){

            $annual = str_pad($j,2,0,STR_PAD_LEFT);
            $days_in_month = cal_days_in_month( CAL_GREGORIAN, $month, $year );
            for ( $day_number = 1; $day_number <= $days_in_month; $day_number++ ) {

                $teache[$j][$day_number][$i] = $this->stuattendence_model->searchAttendencestudent2( $student_id, "{$year}-{$annual}-{$day_number}" );


            }
        }

        /*echo "<pre>";
        print_r($student_id);
        echo "</pre>";
        exit;*/

        echo json_encode($teache);
    }

    public function student_all_month()
    {

        $year = ( $year !== null ? $year : date( 'Y', now() ) );
        $data['title'] = 'Student Attendance Report (Monthly)';

        $data['year'] = $year;



        $this->load->view( 'layout/header', $data );
        $this->load->view('graph/student_month_graph', $data);
        $this->load->view( 'layout/footer', $data );
    }

    public function class_graph_month2()
    {

        $year = $this->input->post( 'year' );
        $month = $this->input->post( 'month' );
        $year = ( $year !== null ? $year : date( 'Y', now() ) );
        $month = ( $month !== null ? $month : date( 'm', now() ) );
        $attendencetypes = $this->attendencetype_model->get();
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        $data['monthlist'] = $this->customlib->getMonthDropdown();
        $data['month_selected'] = date( 'F', now() );
        $class_sections = $this->classsection_model->class_sections();
        $days_in_month = cal_days_in_month( CAL_GREGORIAN, $month, $year );
        for ( $day_number = 1; $day_number <= $days_in_month; $day_number++ ) {
            $date = "{$year}-{$month}-{$day_number}";
            for ( $i = 0; $i < count( $class_sections ); $i++ ) {
                $class_sections[$i]['monthly'][$day_number]       = $this->stuattendence_model->searchAttendenceClassSection( $class_sections[$i]['class_id'], $class_sections[$i]['section_id'], $date );
            }
        }
        echo json_encode($class_sections);
    }

    public function class_graph_month3()
    {


        $exam_id = $this->input->post( 'exam_id' );

        $class = $this->class_model->get();

        $class_sections = $this->classsection_model->class_sections();

        for ( $i = 0; $i < count( $class_sections ); $i++ ) {


            $dt = $this->classsection_model->getDetailbyClassSection( $class_sections[$i]['class_id'], $class_sections[$i]['section_id']);
            $class  =  $dt['class'].$dt['section'];

            $examSchedule[$class]          = $this->examschedule_model->getDetailbyClsandSection($class_sections[$i]['class_id'], $class_sections[$i]['section_id'], $exam_id);


            $studentList[$class]            = $this->student_model->searchByClassSection($class_sections[$i]['class_id'], $class_sections[$i]['section_id']);

            $class  =  $dt['class'].$dt['section'];

            $data[$class]   = array();
            if (!empty($examSchedule[$class])) {
                $new_array = array();
                foreach ($studentList[$class] as $stu_key => $stu_value) {
                    $array = array();
                    $array['student_id']    = $stu_value['id'];
                    $array['class']       = $stu_value['class'];
                    $array['section']       = $stu_value['section'];

                    $array['firstname']     = $stu_value['firstname'];
                    $array['lastname']      = $stu_value['lastname'];
                    $x = array();
                    foreach ($examSchedule[$class] as $ex_key => $ex_value) {
                        $session_result = $this->session_model->get($ex_value['session_id']);
                        $exam_array = array();
                        $exam_array['exam_schedule_id'] = $ex_value['id'];
                        $exam_array['exam_id']          = $ex_value['exam_id'];
                        $exam_array['full_marks']       = $ex_value['full_marks'];
                        $exam_array['passing_marks']    = $ex_value['passing_marks'];
                        $exam_array['exam_name']        = $ex_value['name'];
                        $exam_array['exam_type']        = $ex_value['type'];
                        $student_exam_result            = $this->examresult_model->get_result($ex_value['id'], $stu_value['id']);			   if (empty($student_exam_result)) {
                        } else {
                            $exam_array['attendence']   = $student_exam_result->attendence;
                            $exam_array['get_marks']    = $student_exam_result->get_marks;
                            $exam_array['total']      = $student_exam_result->total;
                        }
                        $x[] = $exam_array;
                    }
                    //for each exam schedule
                    if(empty($x)){
                    }
                    $array['exam_array'] = $x;
                    $new_array[] = $array;
                }
                $data[$class] = $new_array;
            } else {
            }


        }


        echo json_encode($data);



    }

    public function class_graph_month4()
    {

        $exam_id_array = $this->input->post( 'exam_id' );

        $class = $this->class_model->get();
        $class_sections = $this->classsection_model->class_sections();

        for ( $i = 0; $i < count( $class_sections ); $i++ ) {
            //  print_r($class_sections);
            foreach($exam_id_array as $exam_id){


                $dt = $this->classsection_model->getDetailbyClassSection( $class_sections[$i]['class_id'], $class_sections[$i]['section_id']);


                $class  =  $dt['class'].$dt['section'];


                $examSchedule[$class]         = $this->examschedule_model->getDetailbyClsandSection($class_sections[$i]['class_id'], $class_sections[$i]['section_id'], $exam_id);

                $studentList[$class]            = $this->student_model->searchByClassSection($class_sections[$i]['class_id'], $class_sections[$i]['section_id']);


                $class  =  $dt['class'].$dt['section'];

                $data[$class][$exam_id]   = array();
                if (!empty($examSchedule[$class])) {
                    $new_array = array();
                    foreach ($studentList[$class] as $stu_key => $stu_value) {
                        $array = array();
                        $array['student_id']    = $stu_value['id'];
                        $array['class']       = $stu_value['class'];
                        $array['section']       = $stu_value['section'];

                        $array['firstname']     = $stu_value['firstname'];
                        $array['lastname']      = $stu_value['lastname'];
                        $x = array();
                        foreach ($examSchedule[$class] as $ex_key => $ex_value) {
                            $session_result = $this->session_model->get($ex_value['session_id']);
                            $exam_array = array();
                            $exam_array['exam_schedule_id'] = $ex_value['id'];
                            $exam_array['exam_id']          = $ex_value['exam_id'];
                            $exam_array['full_marks']       = $ex_value['full_marks'];
                            $exam_array['passing_marks']    = $ex_value['passing_marks'];
                            $exam_array['exam_name']        = $ex_value['name'];
                            $exam_array['exam_type']        = $ex_value['type'];
                            $student_exam_result            = $this->examresult_model->get_result($ex_value['id'], $stu_value['id']);			   if (empty($student_exam_result)) {
                            } else {
                                $exam_array['attendence']   = $student_exam_result->attendence;
                                $exam_array['get_marks']    = $student_exam_result->get_marks;
                                $exam_array['total']      = $student_exam_result->total;
                            }
                            $x[] = $exam_array;
                        }
                        //for each exam schedule
                        if(empty($x)){
                        }
                        $array['exam_array'] = $x;
                        $new_array[] = $array;
                    }
                    $data[$class][$exam_id] = $new_array;
                } else {
                }

            }
        }

        echo json_encode($data);

    }

    public function teacher_exam_result()
    {

        $exam_id = $this->input->post( 'exam_id' );
        $teachers = $this->teacher_model->get();

        for ( $i = 0; $i < count( $teachers ); $i++ ) {

            // $teachers[$i]['exam']         = $this->examschedule_model->getDetailbyClsandSection($teachers[$i]['class_id'], $teachers[$i]['section_id'], $exam_id);

            $teachers[$i]['subject']        = $this->teachersubject_model->getTeacherClassSubjects2($teachers[$i]['id']);

            for ( $j = 0; $j < count( $teachers[$i]['subject'] ); $j++ ) {

                $teachers[$i]['subject'][$j]['exam']   = $this->examschedule_model->getDetailbyClsandSection2($teachers[$i]['subject'][$j]['class_id'], $teachers[$i]['subject'][$j]['section_id'], $exam_id ,$teachers[$i]['subject'][$j]['subject_id']);

                for ( $k = 0; $k < count($teachers[$i]['subject'][$j]['exam']); $k++ ) {

                    $teachers[$i]['subject'][$j]['exam'][$k]['result']  =  $this->examresult_model->get_result_exam($teachers[$i]['subject'][$j]['exam'][$k]['id']);

                }
            }
        }

        echo json_encode($teachers);

    }

    public function class_wise_graph()
    {


        $exam_id_array = ["1","2"];

        $exam_name          = $this->exam_model->get();

        $data['exams']   = $exam_name;

        $teachers = $this->teacher_model->get();

        for ( $i = 0; $i < count( $teachers ); $i++ ) {
            // $teachers[$i]['exam']         = $this->examschedule_model->getDetailbyClsandSection($teachers[$i]['class_id'], $teachers[$i]['section_id'], $exam_id);
            $teachers[$i]['subject']        = $this->teachersubject_model->getTeacherClassSubjects2($teachers[$i]['id']);
            for ( $j = 0; $j < count( $teachers[$i]['subject'] ); $j++ ) {
                $teachers[$i]['subject'][$j]['exam']   = $this->examschedule_model->getDetailbyClsandSection2($teachers[$i]['subject'][$j]['class_id'], $teachers[$i]['subject'][$j]['section_id'], 1 ,$teachers[$i]['subject'][$j]['subject_id']);
                for ( $k = 0; $k < count($teachers[$i]['subject'][$j]['exam']); $k++ ) {
                    $teachers[$i]['subject'][$j]['exam'][$k][]  =  $this->examresult_model->get_result_exam(10);

                }
            }
        }


        $this->load->view( 'layout/header', $data );
        $this->load->view('graph/class_wise_graph', $data);
        $this->load->view( 'layout/footer', $data );
    }

    public function expense_line_graph2()
    {

        $this->session->set_userdata( 'top_menu', 'Reports' );
        $this->session->set_userdata( 'sub_menu', 'transactions/daily' );

        $year = $this->input->post( 'year' );

        $month = $this->input->post( 'month' );

        $advance_payments = $this->student_model->get_advance_month($data);


        $year = ( $year !== null ? $year : date( 'Y', now() ) );
        $month = ( $month !== null ? $month : date( 'm', now() ) );

        $days_in_month = cal_days_in_month( CAL_GREGORIAN, $month, $year );

        for ( $day_number = 1; $day_number <= $days_in_month; $day_number++ ) {

            $date_from = "{$year}-{$month}-{$day_number}";

            $date_to = "{$year}-{$month}-{$day_number}";

            $transactions['collection'][$day_number] = $this->transactions_model->get2( null, $date_from, $date_to );
            $transactions['expense'][$day_number] = $this->transactions_model->get3( null, $date_from, $date_to );

        }


        echo json_encode($transactions);

    }

    public function expense_line_graph()
    {

        $this->session->set_userdata( 'top_menu', 'Reports' );
        $this->session->set_userdata( 'sub_menu', 'transactions/daily' );
        $data['title'] = 'Daywise Collection and Expense Report';
        $advance_payments = $this->student_model->get_advance_month($data);


        $year = ( $year !== null ? $year : date( 'Y', now() ) );

        $data['year'] = $year;

        $month = ( $month !== null ? $month : date( 'm', now() ) );

        $data['month'] =$month;

        $days_in_month = cal_days_in_month( CAL_GREGORIAN, $month, $year );

        for ( $day_number = 1; $day_number <= $days_in_month; $day_number++ ) {



            $date_from = "{$year}-{$month}-{$day_number}";

            $date_to = "{$year}-{$month}-{$day_number}";

            $transactions['collection'][$day_number] = $this->transactions_model->get2( null, $date_from, $date_to );
            $transactions['expense'][$day_number] = $this->transactions_model->get3( null, $date_from, $date_to );

        }



        $data['transactions'] = $transactions;


        $this->load->view( 'layout/header', $data );
        $this->load->view('graph/expense_line_graph', $data);
        $this->load->view( 'layout/footer', $data );
    }

    public function expense_comparison_graph2()
    {

        $year = $this->input->post( 'year' );

        $month = $this->input->post( 'month' );

        $this->session->set_userdata( 'top_menu', 'Reports' );
        $this->session->set_userdata( 'sub_menu', 'transactions/daily' );

        $data['title'] = 'Comparison Collection and Expense Report';

        $advance_payments = $this->student_model->get_advance_month($data);


        $year = ( $year !== null ? $year : date( 'Y', now() ) );

        $data['year'] = $year;

        $month = ( $month !== null ? $month : date( 'm', now() ) );

        $data['month'] =$month;

        $previous_month =$month-1;


        for ( $j = $previous_month; $j <= $month; $j++ ){

            $annual = str_pad($j,2,0,STR_PAD_LEFT);

            $days_in_month = cal_days_in_month( CAL_GREGORIAN, $annual, $year );

            for ( $day_number = 1; $day_number <= $days_in_month; $day_number++ ) {

                $date_from = "{$year}-{$annual}-{$day_number}";

                $date_to = "{$year}-{$annual}-{$day_number}";

                $transactions['collection'][$j][$day_number] = $this->transactions_model->get2( null, $date_from, $date_to );
                $transactions['expense'][$j][$day_number] = $this->transactions_model->get3( null, $date_from, $date_to );

            }

        }

        echo json_encode($transactions);

    }

    public function expense_comparison_graph()
    {

        $this->session->set_userdata( 'top_menu', 'Reports' );
        $this->session->set_userdata( 'sub_menu', 'transactions/daily' );

        $data['title'] = 'Comparison Collection and Expense Report';

        $advance_payments = $this->student_model->get_advance_month($data);


        $year = ( $year !== null ? $year : date( 'Y', now() ) );

        $data['year'] = $year;

        $month = ( $month !== null ? $month : date( 'm', now() ) );

        $data['month'] =$month;

        $previous_month =$month-1;


        for ( $j = $previous_month; $j <= $month; $j++ ){

            $annual = str_pad($j,2,0,STR_PAD_LEFT);

            $days_in_month = cal_days_in_month( CAL_GREGORIAN, $annual, $year );

            for ( $day_number = 1; $day_number <= $days_in_month; $day_number++ ) {

                $date_from = "{$year}-{$annual}-{$day_number}";

                $date_to = "{$year}-{$annual}-{$day_number}";

                $transactions['collection'][$j][$day_number] = $this->transactions_model->get2( null, $date_from, $date_to );
                $transactions['expense'][$j][$day_number] = $this->transactions_model->get3( null, $date_from, $date_to );

            }

        }
        $data['transactions'] = $transactions;

        $this->load->view( 'layout/header', $data );
        $this->load->view('graph/comparison_expense', $data);
        $this->load->view( 'layout/footer', $data );
    }

    public function graph1()
    {

        $data['title'] = 'Graph';

        $session_result = $this->session_model->get();

        $data['sessionlist'] = $session_result;

        $setting = $this->setting_model->get(1);

        $data['setting'] = $setting;

        $exam_name          = $this->exam_model->get();

        $data['exams']   = $exam_name;

        $year = ( $year !== null ? $year : date( 'Y', now() ) );

        $data['year'] = $year;

        $month = ( $month !== null ? $month : date( 'm', now() ) );

        $data['month'] =$month;

        $this->load->view( 'layout/header', $data );
        $this->load->view('graph/expense_monthly_graph', $data);
        $this->load->view( 'layout/footer', $data );
    }

    public function expense_line_monthly2()
    {
        $session = $this->input->post( 'session_id' );
        $first = strtok($session, '-');
        $year = $first + 1;

        $advance_payments = $this->student_model->get_advance_month($data);
        $year = ( $year !== null ? $year : date( 'Y', now() ) );
        for ( $j = 3; $j < 15; $j++ ){

            $annual = str_pad($j,2,0,STR_PAD_LEFT);
            if($j >  12){
                $year1 = $year;
                if($annual == 13){
                    $annual = 01;
                }
                if($annual == 14){
                    $annual = 02;
                }
            }else{
                $year1 = $year - 1;
            }


            $days_in_month = cal_days_in_month( CAL_GREGORIAN, $annual, $year1 );
            $date_from = "{$year1}-{$annual}-01";
            $date_to = "{$year1}-{$annual}-{$days_in_month}";
            $transactions['collection'][$j] = $this->transactions_model->get2( null, $date_from, $date_to );
            $transactions['expense'][$j] = $this->transactions_model->get3( null, $date_from, $date_to );
        }

        echo json_encode($transactions);
    }



}