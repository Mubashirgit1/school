<?php
include("../conn.php");
$flag['code']=0;
 $result = array();
//$name['namee']="";

?>
<?php
$student_id=$_POST['student_id'];
$date=$_POST['date'];
$date_yyyy_mm=$_POST['date_yyyy_mm'];

$session_id_get_from_sch=mysqli_query($conn,"SELECT `id`, `name`, `email`, `phone`, `address`, `lang_id`, `dise_code`, `date_format`, `currency`, `currency_symbol`, `is_rtl`, `timezone`, `session_id`, `start_month`, `image`, `is_active`, `created_at`, `updated_at` FROM `sch_settings` WHERE 1");

while($id_get=mysqli_fetch_array($session_id_get_from_sch)){
$sess_id=$id_get['session_id'];	
}
///Get record from student session

$student_sess_record=mysqli_query($conn,"SELECT `id`, `session_id`, `student_id`, `class_id`, `section_id`, `route_id`, `vehroute_id`, `transport_fees`, `fees_discount`, `is_active`, `created_at`, `updated_at` FROM `student_session` WHERE session_id='$sess_id' and student_id='$student_id'");

while($sess_id_get=mysqli_fetch_array($student_sess_record)){
	$id=$sess_id_get['id'];
}

//////End session
/////Number of absent
$num_absent=mysqli_query($conn,"SELECT attendence_type.type FROM `student_attendences` INNER JOIN attendence_type ON attendence_type.id=student_attendences.attendence_type_id where  student_attendences.`student_session_id`='$id' and student_attendences.date LIKE '2017-10%'");

if(!$num_absent){
//echo "Error ";
}

while($ok=mysqli_fetch_array($num_absent)){
// echo "Type: ".$ok['type']."<br>";
    
    if($ok['type']=="Present"){
        $pre=$pre+1;
    }else{
        $ab=$ab+1;
    }
    

// echo "Num of Present ".$pre."<br>";

// echo "Num of absent ".$ab."<br>";

    
}


// echo "Num of absent ".$number_absent=mysqli_num_rows($num_absent);

/////End of Absents Count,


$atta=mysqli_query($conn,"SELECT attendence_type.type FROM `student_attendences` INNER JOIN attendence_type ON attendence_type.id=student_attendences.attendence_type_id where  student_attendences.`student_session_id`='$id' and  student_attendences.date='$date'");


while($ty=mysqli_fetch_array($atta)){
	$type=$ty['type'];
}

$num=mysqli_num_rows($atta);


 array_push($result,array(
"type"=>$type,
"num"=>$num,
"num_of_present"=>$pre,
"num_of_absent"=>$ab,
"error"=>$error_in_absent,
"error_atta"=>$err
 )
 );

 
echo json_encode(array("attandance"=>$result));	
?>
