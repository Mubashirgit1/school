<?php

if ( !defined( 'BASEPATH' ) )
    exit( 'No direct script access allowed' );

class Inventoryhead_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * This funtion takes id as a parameter and will fetch the record.
     * If id is not provided, then it will fetch all the records form the table.
     * @param int $id
     * @return mixed
     */
    public function get( $id = null )
    {
        $this->db->select()->from( 'inventory_head' );
        if ( $id != null ) {
            $this->db->where( 'id', $id );
        } else {
            $this->db->order_by( 'id' );
        }
        $query = $this->db->get();
        if ( $id != null ) {
            return $query->row_array();
        } else {
            return $query->result_array();
        }
    }

    /**
     * This function will delete the record based on the id
     * @param $id
     */
    public function remove( $id )
    {
        $this->db->where( 'id', $id );
        $this->db->delete( 'inventory_head' );
    }

    public function removest( $id )
    {
        $this->db->where( 'id', $id );
        $this->db->delete( 'inventory_stock' );
    }

    /**
     * This function will take the post data passed from the controller
     * If id is present, then it will do an update
     * else an insert. One function doing both add and edit.
     * @param $data
     */
    public function add( $data )
    {
        if ( isset( $data['id'] ) ) {
            $this->db->where( 'id', $data['id'] );
            $this->db->update( 'inventory_head', $data );
        } else {
            $this->db->insert( 'inventory_head', $data );
        }
    }

    public function addStock( $data )
    {
        $this->db->insert( 'inventory_stock', $data );
    }

    public function search( $text = null, $start_date = null, $end_date = null )
    {

        if ( !empty( $text ) ) {
            $this->db->select( 'inventory_stock.id, inventory_stock.created_at, inventory_stock.amount, inventory_head.inventory_title, inventory_stock.inventory_head_id' )->from( 'inventory_stock' );
            $this->db->join( 'inventory_head', 'inventory_stock.inventory_head_id = inventory_head.id' );

            $this->db->like( 'inventory_head.inventory_title', $text );
            $query = $this->db->get();
            return $query->result_array();
        } else {

            $this->db->select( 'inventory_stock.id, inventory_stock.created_at, inventory_stock.amount, inventory_head.inventory_title, inventory_stock.inventory_head_id' )->from( 'inventory_stock' );
            $this->db->join( 'inventory_head', 'inventory_stock.inventory_head_id = inventory_head.id' );
            $this->db->where( 'date(inventory_stock.created_at) >=', $start_date );
            $this->db->where( 'date(inventory_stock.created_at) <=', $end_date );
            $query = $this->db->get();

            return $query->result_array();
        }
    }
}
