<?php
include("conn.php");
$flag['code']=0;
 $result = array();
//$name['namee']="";
?>
<?php

$parent_id=$_POST['parent_id'];


$list_noti=mysqli_query($conn,"SELECT send_notification.id,send_notification.title,send_notification.publish_date,send_notification.date,send_notification.message, IF (read_notification.id IS NULL,'unread','read') as notification_id FROM send_notification LEFT JOIN read_notification ON send_notification.id = read_notification.notification_id and read_notification.parent_id='$parent_id' where send_notification.visible_parent='Yes' order by send_notification.publish_date desc
	");


$num=mysqli_num_rows($list_noti);

while($ok=mysqli_fetch_array($list_noti)){
$id=$ok['id'];
$title=$ok['title'];
$publish_date=$ok['publish_date'];
$date=$ok['date'];
$notification_id=$pk['notification_id'];
$message=strip_tags($ok['message']);

//echo $messege=strip_tags($messege);

 array_push($result,array(
"id"=>$id,
"title"=>$title,
"publish_date"=>$publish_date,
"date"=>$date,
"notification_id"=>$notification_id,
"message"=>$message,
"num"=>$num
 )
 );



}

 
 


echo json_encode(array("notification_list"=>$result));	
?>
