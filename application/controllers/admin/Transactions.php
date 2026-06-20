<?php

class Transactions extends Admin_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper( 'file' );
        $this->lang->load( 'message', 'english' );
    }

    public function index()
    {
        $this->session->set_userdata( 'top_menu', 'Expenses' );
        $this->session->set_userdata( 'sub_menu', 'transactions' );

        $this->form_validation->set_data($_GET);
        $this->form_validation->set_rules('date_from', 'Date from', 'trim|urldecode');
        $this->form_validation->set_rules('date_to', 'Date to', 'trim|urldecode');
        $this->form_validation->run();

        $data['title'] = "Transactions";

        $from_date = $this->input->get( 'date_from' );
        $to_date = $this->input->get( 'date_to' );
        if ( !empty( $to_date ) ) {
            $to_date = urldecode( $to_date );
            $to_date = date('Y-m-d', strtotime($to_date));
            $to_date = new DateTime($to_date);
            $to_date->add(new DateInterval('PT23H59M59S'));
            $to_date = $to_date->format('Y-m-d H:i:s');
        }
        if ( !empty( $from_date ) ) {
            $from_date = urldecode( $from_date );
            $from_date = date('Y-m-d H:i:s', strtotime($from_date));
        }

        $transactions = $this->transaction_model->get( null, $from_date, $to_date );

        $data['transactions'] = $transactions;

        $this->load->view( 'layout/header', $data );
        $this->load->view( 'admin/transactions/index', $data );
        $this->load->view( 'layout/footer', $data );
    }
}