<?php
include("../conn.php");
$flag['code']=0;
$result = array();
?>
<?php
$ag_num=$_POST['ag_num'];
$pass=$_POST['password'];
$date=$_POST['date'];
$user_type=$_POST['user_type'];


$login=mysqli_query($conn,"SELECT `id`, `user_id`, `username`, `password`, `childs`, `role`, `is_active`, `created_at`, `updated_at` FROM `users` WHERE username='$ag_num' and password='$pass' and role='$user_type'");

$num=mysqli_num_rows($login);

while($info=mysqli_fetch_array($login)){
$role_db=$info['role'];
$user_id=$info['user_id'];
}


 array_push($result,array(
 "num"=>$num,
 "user_ok"=>$role_db,
  "user_id"=>$user_id
 )
 );



echo json_encode(array("profile"=>$result));

//echo json_encode($flag);


?>
