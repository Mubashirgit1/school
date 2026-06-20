<?php

class Sms_library
{
    const LINK = "https://regularsms.pk/api/sendmultisms";

    const ID = '03333484848';

    const PASS = 'riicQOUkIZsyGV190795335';

    const MASK = 'AKSPK';

    const LANG = 'English';

    const TYPE = 'json';

    const METHOD = 'php';
    /**
     * Convert numbers to 92xxxxxxxxxx format
     * @param $number array|string
     */


    function __construct()
	{
		$this->ci =& get_instance();
		$this->ci->load->database();
	}
    
    public function validate_number( $number )
    {
        
        if ( is_array( $number ) ) {
            $processed_numbers = [];

            for ( $i = 0; $i < count( $number ); $i++ ) {
                $number[$i] = preg_replace( '/\D/', '', $number[$i] );

                if ( !empty( $number[$i] ) ) {
                    $number[$i]  =  str_replace("-", '' , $number[$i]);
                    $number[$i] = (int)$number[$i];
                    $number[$i] = "92".$number[$i];
                    $processed_numbers[] = $number[$i];
                }
            }

            $number = $processed_numbers;
        } else {

            $number = preg_replace( '/\D/', '', $number );

            if ( !empty( $number ) ) {

             $number  =  str_replace("-", '' , $number);
             $number = (int)$number;
             $number = "92".$number;
            }
        }

        return $number;
    }

    /**
     * @param $to array|string Array or string of number
     * @param $message
     */
    public function send_sms( $to, $message )
    {
        
        if ( !empty( $to ) && is_array( $to ) ) {

            $to = $this->validate_number( $to );
            $to = implode( ',', $to );

        } else if ( !empty( $to ) ) {

            $to = $this->validate_number( $to );
         
        }
        
        $SMS_config  = $this->ci->setting_model->get(1);
        if ( !empty( $to ) ) {
            // $arr = [
            //     'mobile' => $SMS_config['username'],
            //     'apikey' => $SMS_config['password'],
            //     'to' => $to,
            //     'message' => $message,
            //     'mask' => 'AKSPK'
            // ];
            
            $arr = [
                'clientid' => $SMS_config['username'],
                'apikey' => $SMS_config['password'],
                'msisdn' => $to,
                'sid' => 'DAR-E-ARQAM' ,
                'msg' => $message,
                'fl'=> 0,
             ];
            
           if($SMS_config['message_type']  == 0  ){
            $link ="http://sms.paigam.pk/vendorsms/pushsms.aspx";
           }else{
            $link ="http://sms.paigam.pk/vendorsms/pushsms.aspx";
           }

            $request = $link . '?' . http_build_query( $arr );
    //   pp($request);
   //  pp($message);
            $ch = curl_init();
            curl_setopt_array( $ch, [
                CURLOPT_URL => $request,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HEADER => false
            ] );
            $response = curl_exec( $ch );
            $status = curl_getinfo( $ch, CURLINFO_HTTP_CODE );
            curl_close( $ch );

        }

        return true;
    }

}