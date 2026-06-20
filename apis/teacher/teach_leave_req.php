<?php
include("../conn.php");
$flag['code']=0;
$num=0;
//$name['namee']="";
?>
<?php
$teacher_id=$_POST['teacher_id'];
$leave_date_added=$_POST['leave_date_added'];
$student_leave_for_date=$_POST['student_leave_for_date'];
$leave_reason=$_POST['leave_reason'];
$leave_day=$_POST['leave_days'];
$user_type=$_POST['user_type'];
$class_id=$_POST['class_id'];
$section_id=$_POST['section_id'];
$incharge_id=$_POST['incharge_id'];

if($user_type=="parent"){
$role="parent";
$leave=mysqli_query($conn,"INSERT INTO `leaves`( `user_id`, `leave_date_added`, `student_leave_for_date`, `leave_reason`, `leave_day`, `role`,`class_id`,`section_id`,`incharge_id`) VALUES ('$teacher_id','$leave_date_added','$student_leave_for_date','$leave_reason','$leave_day','$role','$class_id','$section_id','$incharge_id')");

}else if($user_type=="teacher"){
$role="teacher";

$leave=mysqli_query($conn,"INSERT INTO `leaves`( `user_id`, `leave_date_added`, `student_leave_for_date`, `leave_reason`, `leave_day`, `role`,`class_id`,`section_id`) VALUES ('$teacher_id','$leave_date_added','$student_leave_for_date','$leave_reason','$leave_day','$role','class_id','section_id')");


}else if($user_type=="student"){
	$role="student";
$leave=mysqli_query($conn,"INSERT INTO `leaves`( `user_id`, `leave_date_added`, `student_leave_for_date`, `leave_reason`, `leave_day`, `role`,`class_id`,`section_id`,`incharge_id`) VALUES ('$teacher_id','$leave_date_added','$student_leave_for_date','$leave_reason','$leave_day','$role','$class_id','$section_id','$incharge_id')");


}





if(!$leave){
// echo "Error ";
}else{
$flag['code']=1;	 
$num=1;
}


$result = array();
 
 array_push($result,array(
"num"=>$num
 )
 );


echo json_encode(array("leave_okay"=>$result));	
?>











