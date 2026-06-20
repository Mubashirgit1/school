<?php
include("conn.php");
$flag['code']=0;
$result = array();
?>
<?php
$ag_num=$_POST['ag_num'];
$pass=$_POST['password'];
$date=$_POST['date'];
$user_type=$_POST['user_type'];
$token=$_POST['regId'];
if($user_type=="principle"){
    
    

    
$login=mysqli_query($conn,"SELECT `id`, `username`, `name`, `email`, `CNIC`, `password` FROM `principal` WHERE username='$ag_num' and password='$pass'");

$num=mysqli_num_rows($login);

while($info=mysqli_fetch_array($login)){
$role_db=$user_type;
$user_id=$info['id'];
}


 array_push($result,array(
 "num"=>$num,
 "user_ok"=>$role_db,
  "user_id"=>$user_id
 )
 );




}else{



$login=mysqli_query($conn,"SELECT `id`, `user_id`, `username`, `password`, `childs`, `role`, `is_active`, `created_at`, `updated_at` FROM `users` WHERE username='$ag_num' and password='$pass'");

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


    
    
}

// // ///////////////////  Registration Token Is here.,...

////Code to check token is present or not....

$check=mysqli_query($conn,"SELECT `id`, `user_id`, `token`, `user_type` FROM `user_token` WHERE user_id='$user_id'");

$check_num=mysqli_num_rows($check);

if($check_num==0){
    $add_token=mysqli_query($conn,"INSERT INTO `user_token`(`user_id`, `token`,`user_type`,`login_date`) VALUES ('$user_id','$token','$role_db','$date')");
}else{
    ////Code of updation token....
    $update_token=mysqli_query($conn,"UPDATE `user_token` SET `token`='$token' WHERE user_id='$user_id'");
    
    /////End code of updation token.....
}

///================End code is here.....==============

    // $add_token=mysqli_query($conn,"INSERT INTO `user_token`(`user_id`, `token`,`user_type`) VALUES ('$user_id','$token','$role_db')");
    



// $check_token=mysqli_query($conn,"SELECT `id`, `user_id`, `token` FROM `user_token` WHERE token='$token'");
// $num_token=mysqli_num_rows($check_token);
// if($num_token==1){
    
// }else{


////}



// ////end Token Code.......




echo json_encode(array("profile"=>$result));

//echo json_encode($flag);


?>
