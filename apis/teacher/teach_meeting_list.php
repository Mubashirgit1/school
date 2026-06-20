<?php
include("../conn.php");
$flag['code']=0;
$num=0;
$result = array();
//$name['namee']="";
?>
<?php
// $teacher_list=array();
$teacher_id=$_POST['teacher_id'];


$info=mysqli_query($conn,"SELECT meeting.`id`, meeting.`teacher_id`, meeting.`meet_date_time_id`, meeting_time_date.time,meeting_time_date.date FROM `meeting` INNER JOIN  meeting_time_date ON meeting.meet_date_time_id=meeting_time_date.id and meeting.`teacher_id`='$teacher_id' and meeting_time_date.status='princ_teacher'");



while($sho=mysqli_fetch_array($info)){
 array_push($result,array(
"time"=>$sho['time'],
"date"=>$sho['date']
 )
 );

}




echo json_encode(array("meeting_list"=>$result));	



// SELECT `id`, `time`, `date`, `status` FROM `meeting_time_date` WHERE 1




?>