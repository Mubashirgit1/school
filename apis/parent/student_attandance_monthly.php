<?php
include("../conn.php");
$flag['code']=0;
 $result = array();
//$name['namee']="";
?>
<?php
$student_id=$_POST['student_id'];
$date=$_POST['date'];
$comparison_date=$_POST['comparison_date'];

$session_id_get_from_sch=mysqli_query($conn,"SELECT `id`, `name`, `email`, `phone`, `address`, `lang_id`, `dise_code`, `date_format`, `currency`, `currency_symbol`, `is_rtl`, `timezone`, `session_id`, `start_month`, `image`, `is_active`, `created_at`, `updated_at` FROM `sch_settings` WHERE 1");

while($id_get=mysqli_fetch_array($session_id_get_from_sch)){
$sess_id=$id_get['session_id'];	
}
///Get record from student session

$student_sess_record=mysqli_query($conn,"SELECT `id`, `session_id`, `student_id`, `class_id`, `section_id`, `route_id`, `vehroute_id`, `transport_fees`, `fees_discount`, `is_active`, `created_at`, `updated_at` FROM `student_session` WHERE session_id='$sess_id' and student_id='$student_id'");

while($sess_id_get=mysqli_fetch_array($student_sess_record)){
	$id=$sess_id_get['id'];
}


////End of number of Absents

/////Number of absent
$num_absent=mysqli_query($conn,"SELECT attendence_type.type FROM `student_attendences` INNER JOIN attendence_type ON attendence_type.id=4 where  student_attendences.`student_session_id`='$id' and student_attendences.date LIKE '$comparison_date%'");

$number_absent=mysqli_num_rows($num_absent);

/////End of Absents Count,


/////Number of present
$num_present=mysqli_query($conn,"SELECT attendence_type.type FROM `student_attendences` INNER JOIN attendence_type ON attendence_type.id=1 where  student_attendences.`student_session_id`='$id' and student_attendences.date LIKE '$comparison_date%'");

$num_of_present=mysqli_num_rows($num_present);

/////End of present Count,

$atta=mysqli_query($conn,"SELECT attendence_type.type FROM `student_attendences` INNER JOIN attendence_type ON attendence_type.id=student_attendences.attendence_type_id where  student_attendences.`student_session_id`='$session_id' and student_attendences.date='$date'");
while($ty=mysqli_fetch_array($atta)){
	$type=$ty['type'];
}

$num=mysqli_num_rows($atta);


 array_push($result,array(
"type"=>$type,
"num"=>$num,
"num_of_present"=>$num_of_present,
"num_of_absent"=>$number_absent
 )
 );

 
echo json_encode(array("attandance"=>$result));	
?>
