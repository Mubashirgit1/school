<?php

class Transaction_model extends CI_Model
{
    public function addTransaction( $transactionName, $in = 0, $out = 0, $extra = null, $datetime = null )
    {

        if ( $datetime === null ) {
            $datetime = date( 'Y-m-d H:i:s', now() );
        }

        $data = array();
        $data['transaction_date'] = $datetime;
        $data['transaction_name'] = $transactionName;
        $data['transaction_in'] = intval($in);
        $data['transaction_out'] = intval($out);

        if ( $extra !== null ) {
            $data['transaction_extra'] = json_encode( $extra );
        }

        $this->db->insert( 'transactions', $data );

    }

    public function get($id = null, $from_date = null, $to_date = null){
        $this->db->select("*");
        $this->db->from('transactions');

        if($id !== null){
            $this->db->where('transaction_id', $id);
        }

        if($from_date !== null){
            $this->db->where('transaction_date >=', $from_date);
        }
        if($to_date !== null){
            $this->db->where('transaction_date <=', $to_date);
        }

        $q = $this->db->get();

        if($q->num_rows() > 0){

            if($id !== null){
                return $q->row_array();
            } else {
                return $q->result_array();
            }

        } else {
            return false;
        }
    }
}