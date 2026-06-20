<?php

if ( !defined( 'BASEPATH' ) )
    exit( 'No direct script access allowed' );

class Class_group_model extends CI_Model
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
        $this->db->select( '*');
        $this->db->from( 'class_group' );
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
        $this->db->delete( 'class_group' );
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
            $this->db->update( 'class_group', $data );
        } else {
            $this->db->insert( 'class_group', $data );
            return $this->db->insert_id();
        }
    }

    public function getCurrentSession()
    {
        $session_result = $this->get();
        return $session_result[0]['session_id'];
    }

    public function getCurrentSessionName()
    {
        $session_result = $this->get();
        return $session_result[0]['session'];
    }

    public function getCurrentSchoolName()
    {
        $session_result = $this->get();
        return $session_result[0]['name'];
    }

    public function getStartMonth()
    {
        $session_result = $this->get();
        return $session_result[0]['start_month'];
    }
    public function getSaturday()
    {
        $session_result = $this->get();
        return $session_result[0]['saturday'];
    }
    public function getadmissionkey()
    {
        $session_result = $this->get();
        return $session_result[0]['admission_key'];
    }
    public function getCurrentSessiondata()
    {
        $session_result = $this->get();
        return $session_result[0];
    }

    public function getDateYmd()
    {
        return date( 'Y-m-d' );
    }

    public function getDateDmy()
    {
        return date( 'd-m-Y' );
    }

    public function getCurrentImage()
    {
        $session_result = $this->get();
        return $session_result[0]['image'];
    }

}
