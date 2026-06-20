<?php

class Custom_option_model extends CI_Model
{
    public $table_name = "custom_options";

    /**
     * Get name and values from Database
     * @param null $name
     * @return mixed
     */
    public function get( $name = null )
    {
        $this->db
            ->select( '*' )
            ->from( $this->table_name );

        if ( $name !== null ) {
            $this->db->where( 'name', $name );
        }

        $q = $this->db->get();

        if ( $name !== null ) {
            return $q->row_array();
        } else {
            return $q->result_array();
        }
    }

    /**
     * Add or update name and value in database
     * @param $name
     * @param $value
     * @return mixed
     */
    public function add( $name, $value )
    {
        $option = $this->get( $name );

        // if option does not exists in table already
        if ( !empty( $option ) ) {
            $this->db->update( $this->table_name, ['value' => $value], $option );
        } else { // option exists in db already
            $this->db->insert( $this->table_name, [
                'name' => $name,
                'value' => $value
            ] );
        }

        return $this->get( $name );
    }
}