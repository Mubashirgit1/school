<?php
include("../conn.php");
$flag['code']=0;

//$name['namee']="";
?>
<?php
$user_id=$_POST['teacher_cnic'];
$user_type=$_POST['user_type'];

$sho=mysqli_query($conn,"SELECT `id`, `user_id`, `leave_date_added`, `student_leave_for_date`, `leave_reason`, `leave_day`, `role` FROM `leaves` WHERE user_id='$user_id' and role='$user_type'  ORDER BY `id` DESC");

if(!$sho){}
//else{
$flag['code']=1;	   
$num=mysqli_num_rows($sho);
$result = array();
while($dis=mysqli_fetch_array($sho)){

 array_push($result,array(
 "leave_date_added"=>$dis['leave_date_added'],
 "student_leave_for_date"=>$dis['student_leave_for_date'],
 "leave_reason"=>$dis['leave_reason'],
 "leave_day"=>$dis['leave_day'],
 "reason"=>$dis['leave_reason']
  )
 );

  }

echo json_encode(array("leave_list"=>$result));	
?>
