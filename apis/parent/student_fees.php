<?php
include("../conn.php");
$flag['code']=0;
 $result = array();
//$name['namee']="";
?>
<?php
$student_id=$_POST['student_id'];
$date=$_POST['date'];
$stu_edu_info=mysqli_query($conn,"SELECT `id`, `session_id`, `student_id`, `class_id`, `section_id`, `route_id`, `vehroute_id`, `transport_fees`, `fees_discount`, `is_active`, `created_at`, `updated_at` FROM `student_session` WHERE student_id='$student_id'");

///  One table is ==>  "student_fees_master"
/// Second table is ==> "student_session"


// SELECT `id`, `student_session_id`, `fee_session_group_id`, `is_active`, `created_at` FROM `student_fees_master` WHERE 1

$stu_fees_info=mysqli_query($conn,"SELECT student_fees_master.id, student_fees_master.student_session_id, student_fees_master.fee_session_group_id, student_fees_master.is_active , student_fees_master.created_at ,student_session.student_id
FROM student_fees_master
INNER JOIN student_session ON student_session.session_id=student_fees_master.student_session_id and student_session.student_id='$student_id'");


while($info_about_fees=mysqli_fetch_array($stu_fees_info)){
$fees_master_id=$info_about_fees['id'];
$fee_session_group_id=$info_about_fees['fee_session_group_id'];
}


$fees_ok=mysqli_query($conn,"SELECT student_fees_master.*,fee_groups_feetype.id as `fee_groups_feetype_id`,fee_groups_feetype.amount,fee_groups_feetype.due_date,fee_groups_feetype.fee_groups_id,fee_groups.name,fee_groups_feetype.feetype_id,feetype.code,feetype.type, IFNULL(student_fees_deposite.id,0) as `student_fees_deposite_id`, IFNULL(student_fees_deposite.amount_detail,0) as `amount_detail` FROM `student_fees_master` INNER JOIN fee_session_groups on fee_session_groups.id = student_fees_master.fee_session_group_id INNER JOIN fee_groups_feetype on  fee_groups_feetype.fee_session_group_id = fee_session_groups.id  INNER JOIN fee_groups on fee_groups.id=fee_groups_feetype.fee_groups_id INNER JOIN feetype on feetype.id=fee_groups_feetype.feetype_id LEFT JOIN student_fees_deposite on student_fees_deposite.student_fees_master_id=student_fees_master.id and student_fees_deposite.fee_groups_feetype_id=fee_groups_feetype.id WHERE student_fees_master.fee_session_group_id ='$fee_session_group_id' and student_fees_master.id='$fees_master_id' order by fee_groups_feetype.due_date asc
");


$num=mysqli_num_rows($fees_ok);


while($ok=mysqli_fetch_array($fees_ok)){
$amount=$ok['amount'];

// $fee_session_group_id=$ok['']
}
 array_push($result,array(
"type"=>$amount,
"num"=>$num
 )
 );

 
echo json_encode(array("fees_info"=>$result));	





?>