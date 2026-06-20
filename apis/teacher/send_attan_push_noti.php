<?php
#API access key from Google API's Console
    define( 'API_ACCESS_KEY', 'AAAAyPAXiNw:APA91bGdlWVvKlOFnYuAn7ncREfPnIaPcjpEYJwJ1sgSN-fDmobSzXz7nlCGZ7wxHfAfnc49B5AHdntGAougwdsysK-jRgQlv_VifKf0gpX-w8K6JEAE2gI7DsXu8bnIO84V8bcLEXbI' );
//    $registrationIds = $_GET['id'];
// $registrationIds="eEMd6_J6bC4:APA91bHRucw7L_MyffzXXJlQYtdfYIvUSJR0S0UWQR-oYmBXkLXZdHK4Sn9tqPSHDpqHiGjJdw35iRxK8Vol0pCvlUY3wMU50s-TN2KeIJS52bAua4s8obaxaJP4o61_Jm-5Q8pFR8i4";
#prep the bundle

$info="Your child is present on ".$date_ok;



     $msg = array
          (
		'body' 	=> $info,
		'title'	=> 'Attandance Notification.',
             	'icon'	=> 'myicon',/*Default Icon*/
              	'sound' => 'mySound'/*Default sound*/
          );
	$fields = array
			(
				'to'		=> $registrationIds,
				'notification'	=> $msg
			);
	
	
	$headers = array
			(
				'Authorization: key=' . API_ACCESS_KEY,
				'Content-Type: application/json'
			);
#Send Reponse To FireBase Server	
		$ch = curl_init();
		curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
		curl_setopt( $ch,CURLOPT_POST, true );
		curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
		curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
		$result = curl_exec($ch );
		curl_close( $ch );
#Echo Result Of FireBase Server
echo $result;


?>