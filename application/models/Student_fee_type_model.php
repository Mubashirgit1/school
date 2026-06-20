<?php

class Student_fee_type_model extends CI_Model
{
    public $table_name = 'student_fee_types';

    public function get( $id = null, $order = 'ASC' , $name = null )
    {
        $this->db->select( '*' )
            ->from( $this->table_name )
            ->order_by('id', 'ASC');

        if ( $name !== null ) {
            $this->db->like( 'name', $name );
        }
        if ( $id !== null ) {
            $this->db->where( 'id', $id );
        } else {
            $this->db->order_by('name', $order);
        }

        $q = $this->db->get();

        if ( $q->num_rows() > 0 ) {

            if ( $id !== null ) {
                return $q->row_array();
            } else {
                return $q->result_array();
            }

        } else {
            return false;
        }
    }

    public function insert($data_arr){
        $this->db->insert($this->table_name, $data_arr);
    }

    public function delete($id){
        $this->db->delete($this->table_name, [
            'id' => $id
        ]);
    }
	
	 public function insert_incentive($data_arr){
        $this->db->insert('teacher_incentive', $data_arr);
    }
	
	
	public function get_incentive( $id = null, $order = 'ASC', $type )
    {
        $this->db->select( '*' )
            ->from( 'teacher_incentive' )
            ->order_by('id', 'ASC');

        if ( $type !== null ) {
            $this->db->where( 'type', $type );
        }


        if ( $id !== null ) {
            $this->db->where( 'id', $id );
        } else {
            $this->db->order_by('name', $order);
        }

        $q = $this->db->get();

        if ( $q->num_rows() > 0 ) {

            if ( $id !== null ) {
                return $q->row_array();
            } else {
                return $q->result_array();
            }

        } else {
            return false;
        }
    }
	
	public function delete_incentive($id){
        $this->db->delete('teacher_incentive', [
            'id' => $id
        ]);
    }
	
	
}