<?php

class Class_promotion_demotion_model extends CI_Model
{

    public $table_name = 'class_promotion_demotion';

    public function add( $data )
    {
        if ( !empty( $data['id'] ) ) {
            $data_found = $this->get( $data['id'] );
        } else {
            $data_found = $this->get( null, $data['session_id'], $data['class_id'], $data['section_id'] );
        }

        // if data is found
        if ( $data_found !== false ) {
            // if promoted is present in new data
            // add it to already available value in db
            if ( !empty( $data['promoted'] ) ) {
                $data['promoted'] = intval( $data['promoted'] ) + intval( $data_found['promoted'] );
            }

            // if demoted is present in new data
            // add it to already available value in db
            if ( !empty( $data['demoted'] ) ) {
                $data['demoted'] = intval( $data['demoted'] ) + intval( $data_found['demoted'] );
            }

            // if admission is present in new data
            // add its value to already available value in DB
            if ( !empty( $data['new_admission'] ) ) {
                $data['new_admission'] = intval( $data['new_admission'] ) + intval( $data_found['new_admission'] );
            }

            // update the data
            $this->db->update( $this->table_name, $data, ['id' => $data_found['id']] );
        } else {

            $this->db->insert( $this->table_name, $data );

        }
    }

    public function get( $id = null, $session_id = null, $class_id = null, $section_id = null )
    {

        $this->db->select( "*" )
            ->from( $this->table_name );

        if ( $id !== null ) {
            $this->db->where( 'id', $id );
        }

        if ( $session_id !== null ) {
            $this->db->where( 'session_id', $session_id );
        }

        if ( $class_id !== null ) {
            $this->db->where( 'class_id', $class_id );
        }

        if ( $section_id !== null ) {
            $this->db->where( 'section_id', $section_id );
        }

        $q = $this->db->get();

        if ( $q->num_rows() > 0 ) {
            if ( $id !== null || ( $session_id !== null && $class_id !== null && $section_id !== null ) ) {
                return $q->row_array();
            } else {
                return $q->result_array();
            }
        } else {
            return false;
        }

    }

}