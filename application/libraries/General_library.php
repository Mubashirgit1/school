<?php

class General_library
{
    public $ci;

    public function __construct()
    {
        $this->ci =& get_instance();

        $this->redirect_non_https();
    }

    public function redirect_non_https()
    {
        if ( ENVIRONMENT == 'production' && !isset( $_SERVER['HTTPS'] ) ) {
            redirect( current_url() );
        }
    }

    public function err_msg()
    {
        $msg = $this->ci->session->flashdata( 'msg' );
        if ( !empty( $msg ) ) {
            echo "<div class='alert alert-success'>{$msg}</div>";
        }

        $err = $this->ci->session->flashdata( 'err' );
        if ( !empty( $err ) ) {
            echo "<div class='alert alert-danger'>{$err}</div>";
        }
    }

    public function week_start_end_date( $date )
    {
        $ts = strtotime( $date );

        $start = ( date( 'w', $ts ) == 0 ) ? $ts : strtotime( 'last sunday', $ts );

        $value = array(
            'start' => date( 'Y-m-d', $start ),
            'end' => date( 'Y-m-d', strtotime( 'next saturday', $start ) )
        );

        return $value;
    }

    public function get_day_name( $date, $lowercase = true )
    {
        $day = date( 'l', strtotime( $date ) );

        if ( $lowercase === true ) {
            $day = strtolower( $day );
        }

        return $day;
    }

    /**
     * Calculates difference of days between two dates.
     * @param $date 2010-10-02
     * @param $past_date 2010-10-01
     * @param bool $round
     * @return false|float|int
     */
    public function day_difference_between_two_dates( $date, $past_date, $round = true )
    {
        $date = strtotime( $date );
        $past_date = strtotime( $past_date );

        $difference = $date - $past_date;

        $difference = ( ( $difference / 60 ) / 60 ) / 24;

        if ( $round === true ) {
            return floor( $difference );
        } else {
            return $difference;
        }
    }
}