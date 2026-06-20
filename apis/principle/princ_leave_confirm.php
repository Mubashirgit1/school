<?php
include("../conn.php");
$flag['code']=0;

//$name['namee']="";
?>
<?php

$leave_id=$_POST['leave_id'];
$accept=$_POST['accept'];
$reject=$_POST['reject'];

 $result = array();

if($accept=="accept"){

$accept_ok=mysqli_query($conn,"UPDATE `leaves` SET `status`='Accept' WHERE id='$leave_id'");

if(!$accept_ok){
	$confirm="error";
}else{
	$confirm="Accept Application";
}


///=============== End Accept code is here........
}else if($reject=="reject"){

$reject_ok=mysqli_query($conn,"UPDATE `leaves` SET `status`='reject' WHERE id='$leave_id'");

if(!$reject_ok){
	$confirm="Error in reject.";
}else{
	$confirm="Reject Application.";
}

//////============ End Reject code is here.....
}

	 array_push($result,array(
 "confirm"=>$confirm
 )
 );



echo json_encode(array("leave_status"=>$result));	
?>
