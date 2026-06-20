<?php

if ( !defined( 'BASEPATH' ) )
    exit( 'No direct script access allowed' );

class Setting_model extends CI_Model
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
        $this->db->select( 'sch_settings.id,sch_settings.splash,sch_settings.lang_id,sch_settings.is_rtl,sch_settings.timezone,
          sch_settings.name,sch_settings.email,sch_settings.phone,languages.language,
          sch_settings.address,sch_settings.saturday,sch_settings.dise_code,sch_settings.date_format,sch_settings.currency,sch_settings.currency_symbol,sch_settings.start_month,sch_settings.username,sch_settings.password,sch_settings.message_type,sch_settings.session_id,sch_settings.image,sch_settings.admission_key,sch_settings.vr_fine,sch_settings.staff_saturday,sessions.session'
        );
        $this->db->from( 'sch_settings' );
        $this->db->join( 'sessions', 'sessions.id = sch_settings.session_id' );
        $this->db->join( 'languages', 'languages.id = sch_settings.lang_id' );
        if ( $id != null ) {
            $this->db->where( 'sch_settings.id', $id );
        } else {
            $this->db->order_by( 'sch_settings.id' );
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
        $this->db->delete( 'sch_settings' );
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
            $this->db->update( 'sch_settings', $data );
        } else {
            $this->db->insert( 'sch_settings', $data );
            return $this->db->insert_id();
        }
    }

    public function getCurrentSession()
    {
        $session_result = $this->get();
        return $session_result[0]['session_id'];
    }
    public function getSchoolAddress()
    {
        $session_result = $this->get();
        return $session_result[0]['address'];
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
    public function getStaffSaturday()
    {
        $session_result = $this->get();
        
        return $session_result[0]['staff_saturday'];
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
