<?php
include("../conn.php");
$flag['code']=0;
 $result = array();
//$name['namee']="";
?>
<?php
$student_id=$_POST['student_id'];

// $student_id=1;

//$student_id=3;
//$date=$_POST['date'];


$stu_fees_info=mysqli_query($conn,"SELECT `id`, `student_id`, `tuition_fee`, `due_fee`, `total_paid_fee`, `payment_date` FROM `student_fee_payments` WHERE student_id='$student_id'");

$total=0;

$num=mysqli_num_rows($stu_fees_info);

while($ok=mysqli_fetch_array($stu_fees_info)){
$tuition_fee=$ok['tuition_fee'];
$payment_date=$ok['payment_date'];
//$total=$total+$tuition_fee;

 array_push($result,array(
"tuition_fee"=>$tuition_fee,
"num"=>$num,
"payment_date"=>$payment_date
 )
 );


// $fee_session_group_id=$ok['']
}

 
echo json_encode(array("fees_info"=>$result));	






?>