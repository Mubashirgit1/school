<?php

if ( !defined( 'BASEPATH' ) )
    exit( 'No direct script access allowed' );

class Inventory extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper( 'file' );
        $this->lang->load( 'message', 'english' );
        $this->load->model( 'inventoryhead_model' );
    }

    function index()
    {
        $this->session->set_userdata( 'top_menu', 'Expenses' );
        $this->session->set_userdata( 'sub_menu', 'expenseshead/index' );
        $data['title'] = 'Inventory Head List';
        $inventoryList = $this->inventoryhead_model->get();
        $data['inventoryList'] = $inventoryList;
        $this->load->view( 'layout/header', $data );
        $this->load->view( 'admin/inventory/inventoryList', $data );
        $this->load->view( 'layout/footer', $data );
    }

    function create()
    {
        $data['title'] = 'Add Inventory Item';
        $inventoryList = $this->inventoryhead_model->get();
        $data['categorylist'] = $inventoryList;
        $this->form_validation->set_rules( 'inventoryhead', 'Inventory Head', 'trim|required|xss_clean' );
        if ( $this->form_validation->run() == FALSE ) {
            $this->load->view( 'layout/header', $data );
            $this->load->view( 'admin/inventory/inventoryList', $data );
            $this->load->view( 'layout/footer', $data );
        } else {
            $data = array(
                'inventory_title' => $this->input->post( 'inventoryhead' ),
                'description' => $this->input->post( 'description' ),
            );
            $this->inventoryhead_model->add( $data );
            $this->session->set_flashdata( 'msg', '<div class="alert alert-success text-left">Inventory Head added successfully</div>' );
            redirect( 'admin/inventory/index' );
        }
    }

    function delete( $id )
    {
        $data['title'] = 'Inventory Head List';
        $redirect = $this->input->post_get( 'redirect' );
        $redirect = ( !empty( $redirect ) ? urldecode( $redirect ) : "admin/inventory/index" );

        $this->inventoryhead_model->remove( $id );
        redirect( $redirect );
    }

    function deletest( $id )
    {
        $redirect = $this->input->post_get( 'redirect' );
        $redirect = ( !empty( $redirect ) ? urldecode( $redirect ) : "admin/inventory/inventorysearch" );

        $this->inventoryhead_model->removest( $id );
        redirect( $redirect );
    }

    function edit( $id )
    {
        $data['title'] = 'Edit Inventory Head';
        $category_result = $this->inventoryhead_model->get();
        $data['categorylist'] = $category_result;
        $data['id'] = $id;
        $category = $this->inventoryhead_model->get( $id );
        $data['inventoryhead'] = $category;
        $this->form_validation->set_rules( 'inventoryhead', 'Inventory Head', 'trim|required|xss_clean' );
        if ( $this->form_validation->run() == FALSE ) {
            $this->load->view( 'layout/header', $data );
            $this->load->view( 'admin/inventory/inventoryheadEdit', $data );
            $this->load->view( 'layout/footer', $data );
        } else {
            $data = array(
                'id' => $id,
                'inventory_title' => $this->input->post( 'inventoryhead' ),
                'description' => $this->input->post( 'description' ),
            );
            $this->inventoryhead_model->add( $data );
            $this->session->set_flashdata( 'msg', '<div class="alert alert-success">Inventory Head updated successfully</div>' );
            redirect( 'admin/inventory/index' );
        }
    }

    function inventorySearch()
    {
        $this->session->set_userdata( 'top_menu', 'Daily Task' );
        $this->session->set_userdata( 'sub_menu', 'inventory/inventorysearch' );
        $data['title'] = 'Search Inventory';

        if ( $this->input->post_get( 'date_from' ) !== null || $this->input->post_get( 'date_to' ) !== null ) {
            $search = $this->input->post_get( 'search' );

            $data['inv_title'] = 'Inventory Result From ' . $this->input->post_get( 'date_from' ) . " To " . $this->input->post_get( 'date_to' );
            $date_from = date( 'Y-m-d', strtotime( $this->input->post_get( 'date_from' ) ) );
            $date_to = date( 'Y-m-d', strtotime( $this->input->post_get( 'date_to' ) ) );

            $resultList = $this->inventoryhead_model->search( "", $date_from, $date_to );
            $data['resultList'] = $resultList;


            $this->load->view( 'layout/header', $data );
            $this->load->view( 'admin/inventory/inventorySearch', $data );
            $this->load->view( 'layout/footer', $data );
        } else {
            $this->load->view( 'layout/header', $data );
            $this->load->view( 'admin/inventory/inventorySearch', $data );
            $this->load->view( 'layout/footer', $data );
        }
    }
}

?>