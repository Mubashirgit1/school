<?php

class Student_log_model extends CI_Model
{
    public $table_name = "student_logs";

    /**
     * @param int $student_session_id
     * @param bool $new_admission
     * @param bool $promote
     * @param bool $demote
     * @param bool $free
     * @param bool $without_fee
     * @param bool $struck_off
     * @param null|Date $created_on
     */
    public function add( $student_session_id, $created_on = null, $new_admission = 0, $promote = 0, $demote = 0, $free = 0, $without_fee = 0, $struck_off = 0 )
    {
        // managing created on date
        if ( $created_on === null ) {
            $created_on = now();
        } else {
            $created_on = strtotime( $created_on );
        }

        $this->db->insert( $this->table_name, [
            'student_session_id' => $student_session_id,
            'new_admission' => $new_admission,
            'promote' => $promote,
            'demote' => $demote,
            'free' => $free,
            'without_fee' => $without_fee,
            'struck_off' => $struck_off,
            'created_on' => date( 'Y-m-d', $created_on )
        ] );

    }

    public function update( $student_session_id, $free = 0 )
    {
        $data = array(
        'free'  => $free
        );
        
        $this->db->where( 'student_session_id', $student_session_id );
        $this->db->update( $this->table_name, $data );
    }

    /**
     * @param null|int $id
     * @param null|int $student_session_id
     * @param null|DateTime $created_on
     * @param null|int $year
     * @param null|int $month
     * @return bool|array result Array
     */
    public function get( $id = null, $student_session_id = null, $created_on = null, $year = null, $month = null )
    {
        $this->db->select( '*' )
            ->from( $this->table_name );

        if ( $id !== null ) {
            $this->db->where( 'id', $id );
        }

        if ( $student_session_id !== null ) {
            $this->db->where( 'student_session_id', $student_session_id );
        }

        if ( $created_on !== null ) {
            $this->db->where( 'created_on', $created_on );
        }

        if ( $year !== null ) {
            $this->db->where( "YEAR(created_on) = " . $year );
        }

        if ( $month !== null ) {
            $this->db->where( 'MONTH(created_on) = ' . $month );
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

    public function calculate( $class_id = null, $section_id = null, $created_on = null,$date_from = null,$date_to = null )
    {
        $this->db->select( "IFNULL(sum(student_logs.new_admission), '0') as new_admission, IFNULL(sum(student_logs.promote), '0') as promote, IFNULL(sum(student_logs.demote), '0') as demote, IFNULL(sum(student_logs.free), '0') as free, IFNULL(sum(student_logs.without_fee), '0') as without_fee, IFNULL(sum(student_logs.struck_off), '0') as struck_off" )
            ->from( 'student_logs' )
            ->join( 'student_session', 'student_session.id = student_logs.student_session_id', 'inner' );

        if ( $class_id !== null ) {
            $this->db->where( 'student_session.class_id', $class_id );
        }

        if ( $section_id !== null ) {
            $this->db->where( 'student_session.section_id', $section_id );
        }

        if ( $date_from !== null ) {
            $this->db->where( 'student_logs.created_on >=', date( 'Y-m-d', strtotime( $date_from ) ) );
        }

        if ( $date_to !== null ) {
            $this->db->where( 'student_logs.created_on <=', date( 'Y-m-d', strtotime( $date_to ) ) );
        }

        // if ( $created_on !== null ) {
        //     $this->db->like( 'student_logs.created_on', date( "Y-m-", strtotime( $created_on ) ), 'after' );
        // }

        $q = $this->db->get();
        // var_dump($this->db->last_query());exit;
        
        if ( $q->num_rows() > 0 ) {
            return $q->row_array();
        } else {
            return false;
        }
    }


    public function total_calculate()
    {
        $this->db->select( "sum(student_logs.free) as free,sum(student_logs.without_fee) as without_fee, sum(student_logs.struck_off) as struck_off" )
            ->from( 'student_logs' )
            ->join( 'student_session', 'student_session.id = student_logs.student_session_id', 'inner' );


        $q = $this->db->get();
        // var_dump($this->db->last_query());exit;
        
        if ( $q->num_rows() > 0 ) {
            return $q->row_array();
        } else {
            return false;
        }
    }
}