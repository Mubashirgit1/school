<?php
include("../conn.php");
$flag['code']=0;
$num=0;
//$name['namee']="";
?>
<?php
// $teacher_list=array();

$teacher_list=$_POST['teacher_list'];
$date1=$_POST['date1'];
$date_ok=date("Y-m-d");

/////Add Meeting Time and Date.

// $meet_add=mysqli_query($conn,"INSERT INTO `meeting_time_date`(`time`, `date`, `status`) VALUES ('$meeting_time','$meeting_date','$meeting_status')");
/////End meeting time And Date.....


// $key=mysqli_query($conn,"SELECT `id`, `time`, `date`, `status` FROM `meeting_time_date` where status='$meeting_status' ORDER BY `id` DESC LIMIT 1");

// while($op=mysqli_fetch_array($key)){
// 	$meet_time_date_id=$op['id'];
// }


// for($a=0;$a<=count($teacher_list);$a++){


// }

// $n=count($teacher_list);

// $stu_registration_id=$_POST['stu_registration_id'];
// $school_branch=$_POST['school_branch'];
// $leave_class=$_POST['leave_class'];
// $leave_section=$_POST['leave_section'];
// $leave_date_added=$_POST['leave_date_added'];
// $student_leave_for_date=$_POST['student_leave_for_date'];

// $leave_reason=$_POST['leave_reason'];

// $leave_day=$_POST['leave_days'];


// INSERT INTO `meeting`(`ok`) VALUES ('$teacher_list')

//$num=json_decode($teacher_list,true);
////$v=$num[0]

//$jsonData= ''; // put here your json object
$arrayData = json_decode($teacher_list, true);
// if (isset($arrayData['data']))
// {

foreach ($arrayData as $data)
{
$v=$data['number'];

$get_session=mysqli_query($conn,"SELECT `id`, `session_id`, `student_id`, `class_id`, `section_id`, `route_id`, `vehroute_id`, `transport_fees`, `fees_discount`, `is_active`, `created_at`, `updated_at` FROM `student_session` WHERE student_id='$v'");

while($get_ses=mysqli_fetch_array($get_session)){
    $session_id=$get_ses['id'];
}


$leave=mysqli_query($conn,"INSERT INTO `student_attendences`( `student_session_id`, `date`, `attendence_type_id`, `is_active`, `created_at`, `updated_at`) VALUES ('$session_id','$date_ok','1','Active','Created ','Updated At')");

////// Send push notification is here....

////////IDS 


$get_token=mysqli_query($conn,"SELECT `id`, `user_id`, `token`, `user_type`, `login_date` FROM `user_token` WHERE user_type='parent' and user_id='$v'");

while($token=mysqli_fetch_array($get_token)){
$registrationIds=$token['token'];

include("send_attan_push_noti.php");
    
    
}


/////

    
    
    
}



//}
//$v->number;
if(!$leave){

}else{
$flag['code']=1;	 
$num=1;
}


$result = array();
 
 array_push($result,array(
"num"=>$num
 )
 );





/////===============End end Push notification.....



echo json_encode(array("leave_okay"=>$result));	
?>











