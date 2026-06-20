<?php

if ( !defined( 'BASEPATH' ) )
    exit( 'No direct script access allowed' );

class InventoryItems extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper( 'file' );
        $this->lang->load( 'message', 'english' );
        $this->load->model( 'inventoryitem_model' );
        $this->load->model( 'inventoryhead_model' );
    }

    function index()
    {
        $this->session->set_userdata( 'top_menu', 'Expenses' );
        $this->session->set_userdata( 'sub_menu', 'expense/index' );

        $data['title'] = 'Add Inventory Item';
        $data['title_list'] = 'Recent Inventories';

        $redirect_url = $this->input->post_get( 'redirect' );

        if ( $this->input->method() == 'get' ) {
            $this->form_validation->set_data( $this->input->get() );
        }

        $this->form_validation->set_rules( 'inv_head_id', 'Inventory Head', 'trim|required|xss_clean' );
        $this->form_validation->set_rules( 'amount', 'Amount', 'trim|required|xss_clean' );
        $this->form_validation->set_rules( 'quantity', 'Quantity', 'trim|required|xss_clean' );
        $this->form_validation->set_rules( 'date', 'Date', 'trim|required|xss_clean' );
        

        if ( $this->form_validation->run() == FALSE ) {
            if ( !empty( $redirect_url ) ) {
                $this->session->set_flashdata( 'expense_err', "Some information is missing, inventory items wasn't added. Try again." );
                redirect( urldecode( $redirect_url ) );
            }
        } else {
            $data = array(
                'inv_head_id' => $this->input->post_get( 'inv_head_id' ),
                'quantity' => $this->input->post_get( 'quantity' ),
                'amount' => $this->input->post_get( 'amount' ),
                'date' => $this->input->post_get( 'date' ),
                'note' => ( $this->input->post_get( 'description' ) !== null ? $this->input->post_get( 'description' ) : "" )
            );
            $this->inventoryitem_model->add( $data );

            if ( empty( $redirect_url ) ) {
                $this->session->set_flashdata( 'msg', '<div class="alert alert-success text-left">Inventory Item added successfully</div>' );
                redirect( 'admin/inventoryItems/index' );
            } else {
                $this->session->set_flashdata( 'expense_msg', "Inventory Item has been added to the system." );
                redirect( urldecode( $redirect_url ) );
            }
        }
        $inventory_item_result = $this->inventoryitem_model->get();
        $data['inventoryitemslist'] = $inventory_item_result;
        $inventoryHead = $this->inventoryhead_model->get();
        $data['invheadlist'] = $inventoryHead;
        $this->load->view( 'layout/header', $data );
        $this->load->view( 'admin/inventoryItems/inventoryList', $data );
        $this->load->view( 'layout/footer', $data );
    }

    function view( $id )
    {
        $data['title'] = 'Fees Master List';
        $expense = $this->expense_model->get( $id );
        $data['expense'] = $expense;
        $this->load->view( 'layout/header', $data );
        $this->load->view( 'expense/expenseShow', $data );
        $this->load->view( 'layout/footer', $data );
    }

    function getByFeecategory()
    {
        $feecategory_id = $this->input->get( 'feecategory_id' );
        $data = $this->feetype_model->getTypeByFeecategory( $feecategory_id );
        echo json_encode( $data );
    }

    function getStudentCategoryFee()
    {
        $type = $this->input->post( 'type' );
        $class_id = $this->input->post( 'class_id' );
        $data = $this->expense_model->getTypeByFeecategory( $type, $class_id );
        if ( empty( $data ) ) {
            $status = 'fail';
        } else {
            $status = 'success';
        }
        $array = array('status' => $status, 'data' => $data);
        echo json_encode( $array );
    }

    function delete( $id )
    {
        $data['title'] = 'Fees Master List';
        $this->inventoryitem_model->remove( $id );

        $redirect_url = $this->input->get( 'redirect' );
        $redirect_url = ( $redirect_url !== null ? urldecode( $redirect_url ) : 'admin/inventoryItems/index' );
        redirect( $redirect_url );
    }

    function create()
    {
        $data['title'] = 'Add Fees Master';
        $this->form_validation->set_rules( 'expense', 'Fees Master', 'trim|required|xss_clean' );
        if ( $this->form_validation->run() == FALSE ) {
            $this->load->view( 'layout/header', $data );
            $this->load->view( 'expense/expenseCreate', $data );
            $this->load->view( 'layout/footer', $data );
        } else {
            $data = array(
                'expense' => $this->input->post( 'expense' ),
            );
            $this->expense_model->add( $data );
            $this->session->set_flashdata( 'msg', '<div class="alert alert-success text-left">Expense added successfully</div>' );
            redirect( 'expense/index' );
        }
    }

    function edit( $id )
    {
        $data['title'] = 'Edit Fees Master';
        $data['id'] = $id;
        $expense = $this->expense_model->get( $id );
        $data['expense'] = $expense;
        $data['title_list'] = 'Fees Master List';
        $expense_result = $this->expense_model->get();
        $data['expenselist'] = $expense_result;
        $expnseHead = $this->expensehead_model->get();
        $data['expheadlist'] = $expnseHead;
        $this->form_validation->set_rules( 'exp_head_id', 'Expense Head', 'trim|required|xss_clean' );
        $this->form_validation->set_rules( 'amount', 'Amount', 'trim|required|xss_clean' );
        $this->form_validation->set_rules( 'name', 'Name', 'trim|required|xss_clean' );
        $this->form_validation->set_rules( 'date', 'Date', 'trim|required|xss_clean' );
        if ( $this->form_validation->run() == FALSE ) {
            $this->load->view( 'layout/header', $data );
            $this->load->view( 'admin/expense/expenseEdit', $data );
            $this->load->view( 'layout/footer', $data );
        } else {
            $data = array(
                'id' => $id,
                'exp_head_id' => $this->input->post( 'exp_head_id' ),
                'name' => $this->input->post( 'name' ),
                'date' => date( 'Y-m-d', $this->customlib->datetostrtotime( $this->input->post( 'date' ) ) ),
                'amount' => $this->input->post( 'amount' ),
                'note' => $this->input->post( 'description' ),
            );
            $this->expense_model->add( $data );
            $this->session->set_flashdata( 'msg', '<div class="alert alert-success text-left">Expense updated successfully</div>' );
            redirect( 'admin/expense/index' );
        }
    }

    function expenseSearch()
    {
        $this->session->set_userdata( 'top_menu', 'Expenses' );
        $this->session->set_userdata( 'sub_menu', 'expense/expensesearch' );
        $data['title'] = 'Search Expense';
        if ( $this->input->post_get( 'date_from' ) !== null || $this->input->post_get( 'date_to' ) !== null ) {
            $search = $this->input->post_get( 'search' );
            if ( $search == "search_filter" ) {
                $data['exp_title'] = 'Expense Result From ' . $this->input->post_get( 'date_from' ) . " To " . $this->input->post_get( 'date_to' );
                $date_from = date( 'Y-m-d', $this->customlib->datetostrtotime( $this->input->post_get( 'date_from' ) ) );
                $date_to = date( 'Y-m-d', $this->customlib->datetostrtotime( $this->input->post_get( 'date_to' ) ) );
                $resultList = $this->expense_model->search( "", $date_from, $date_to );
                $data['resultList'] = $resultList;
            } else {
                $data['exp_title'] = 'Expense Result';
                $search_text = $this->input->post_get( 'search_text' );
                $resultList = $this->expense_model->search( $search_text, "", "" );
                $data['resultList'] = $resultList;
            }
            $this->load->view( 'layout/header', $data );
            $this->load->view( 'admin/expense/expenseSearch', $data );
            $this->load->view( 'layout/footer', $data );
        } else {
            $this->load->view( 'layout/header', $data );
            $this->load->view( 'admin/expense/expenseSearch', $data );
            $this->load->view( 'layout/footer', $data );
        }
    }

}

?>