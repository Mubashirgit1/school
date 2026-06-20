<?php

defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Fee_voucher extends CI_Model
{

    public function getFeeHeads()
    {
        $query = $this->db->select( '*' )->from( 'student_fee_types' )->get();
        $results = $query->result();

        return $results;
    }

}

/* End of file Fee_voucher.php */
/* Location: ./application/models/Fee_voucher.php */
?>