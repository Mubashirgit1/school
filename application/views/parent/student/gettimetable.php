<div class="content-wrapper" style="min-height: 946px;">
<section class="content-header">
        <div class="box box-primary" style="margin-bottom: 0px;">
            <div class="box-body">
            <div class="col-xs-5 col-sm-3 col-md-2"  > 
            <?php  $url = $student['image'] != null ? $student['image'] : 'uploads/student_images/no_image.png';  ?>
                <img style='height:100px;width:100px' class="student-image profile-user-img img-responsive img-circle" src="<?= base_url().$url ?>" alt="User profile picture">
            </div> 
           
            <div class="col-xs-7 col-sm-9 col-md-10"> 
                <div class="card-body-right">
                    <h4 class="card-title"><?= $student['firstname'].' '.$student['lastname']?></h4>
                    <h5><?= $student['class'].' / '.$student['section']?></h5>
                    <p class="card-text"><?= admission_text() ?> <?= $student['admission_no'] ?>  </p>
                </div>
            </div>
            </div>
        </div>
    </section> 
    <section class="content">
        <div class="row">



            <div class="col-md-12">
<?php
           
$tab_menu = '';
$tab_content = '';
$i = 0;
foreach($result_array as $key => $row )
{
   
 if($i == 0)
 {
  $tab_menu .= '
   <li class="active"><a href="#'.$key.'" data-toggle="tab">'.$key.'</a></li>
  ';
  $tab_content .= '
   <div id="'.$key.'" class="tab-pane fade in active">
  ';
 }
 else
 {
  $tab_menu .= '
   <li><a href="#'.$key.'" data-toggle="tab">'.$key.'</a></li>
  ';
  $tab_content .= '
   <div id="'.$key.'" class="tab-pane fade">
  ';
 }



 $i = 0;
 foreach($row as $key1 => $sub_row)
 {
     
    
     $url = $sub_row->teacher['image'] != null ? $sub_row->teacher['image'] : 'uploads/student_images/no_image.png'; 
if($sub_row->start_time){
     $i++;
  $tab_content .= '
  <div class="row" style="margin-bottom:20px;">

    <div class="col-sm-2 col-xs-3"  style="    ;background: #f4f4f4;"  > 
        <h1 style="text-align: center; height: 50px;">'.$i.'</h1>
    </div> 

    <div class="col-sm-2 col-xs-5"> 
        <div class="card-body-right">
                <h6>'.$sub_row->start_time.'   </h6>
                <h4 class="card-title">'.$key1.'</h4>
                <p class="card-text">'.$sub_row->teacher['name'].' </p>
        </div>
    </div>

    
 

   

  </div>
  ';
//   <div class="col-sm-2 col-xs-4"> 
    
//         <img style="height:70px;width:70px" class="student-image profile-user-img img-responsive img-circle" src="'.base_url().$url.'" alt="User profile picture">
//     </div> 
}else{
    $tab_content .= '
  <div class="row" >

     
   

  </div>
  ';
}

 }
 
 $tab_content .= '<div style="clear:both"></div></div>';
 $i++;
}
?>


            
        <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <?php
                    echo $tab_menu;
                    ?>
                </ul>
                <div class="tab-content">
                    <?php
                    echo $tab_content;
                    ?>
                </div>

        </div>
</div>
</section>
</div>