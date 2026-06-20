<?php

if ( !defined( 'BASEPATH' ) )
    exit( 'No direct script access allowed' );

class InventoryItemIssue extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper( 'file' );
        $this->lang->load( 'message', 'english' );
        $this->load->model('inventoryitem_model');
        $this->load->model('inventoryhead_model');
    }

    function index()
    {
        $this->session->set_userdata( 'top_menu', 'Expenses' );
        $this->session->set_userdata( 'sub_menu', 'expense/index' );

        $data['title'] = 'Issue Inventory Item';
        $data['title_list'] = 'Recent Inventories';

        $redirect_url = $this->input->get( 'redirect' );

        $this->form_validation->set_rules( 'inv_head_id', 'Inventory Head', 'trim|required|xss_clean' );
        //$this->form_validation->set_rules( 'amount', 'Amount', 'trim|required|xss_clean' );
        $this->form_validation->set_rules( 'quantity', 'Quantity', 'trim|required|xss_clean' );

        if ( $this->form_validation->run() == FALSE ) {
            if ( !empty( $redirect_url ) ) {
                $this->session->set_flashdata( 'expense_err', "Some information is missing, inventory items wasn't added. Try again." );
                redirect( urldecode( $redirect_url ) );
            }
        } else {
            $data = array(
                'inv_head_id' => $this->input->post( 'inv_head_id' ),
                'quantity' => $this->input->post( 'quantity' )
            );
            $iresult = $this->inventoryitem_model->issueItem( $data );

            if($iresult == false) {
                $this->session->set_flashdata( 'msg', '<div class="alert alert-danger text-left">Item is not in stock for issue.</div>' );
                redirect( 'admin/inventoryItemIssue/index' );
            } else if ( empty( $redirect_url ) ) {
                $this->session->set_flashdata( 'msg', '<div class="alert alert-success text-left">Inventory Item Issued successfully</div>' );
                redirect( 'admin/inventoryItemIssue/index' );
            } else {
                $this->session->set_flashdata( 'expense_msg', "Inventory Item has been issued to the system." );
                redirect( urldecode( $redirect_url ) );
            }
        }
        $inventory_item_result = $this->inventoryitem_model->get();
        $data['inventoryitemslist'] = $inventory_item_result;
        $inventoryHead = $this->inventoryhead_model->get();
        $data['invheadlist'] = $inventoryHead;
        $this->load->view( 'layout/header', $data );
        $this->load->view( 'admin/inventoryItems/inventoryissue', $data );
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
}

?>