



<div class="content-wrapper" style="min-height: 946px;">
    <!-- Main content -->
<style>
@media print {
  #printPageButton {
    display: none;
  }
}

</style>
    <section class="content">
        <div class="col-md-12">
            
            <button class="pull-right" id="printPageButton" onclick="window.print()"><i class="fa fa-print"></i></button>
       
        </div>
        <div class="row">
            <div class="col-md-10 col-sm-offset-1" style="background-color: #fff; border:1px solid #000;">
            <div class="row">
            <div class="col-sm-12"> 
           <table class="table">
            <tbody>
                    <tr>
                        <td style="border-top: 0px; width:60px;">
                            File.no :
                        </td>
                        <td style="border-top: 0px; border-bottom: 1px solid #000;">
                            <?php echo $examSchedule['father_name'] ?>
                        </td>
                        
                            <td style="border-top: 0px; width:50px; float:right">
                            Sr.no :
                        </td>
                        <td style="border-top: 0px; border-bottom: 1px solid #000; ">
                            <?php echo $examSchedule['father_name'] ?>
                        </td>
                    </tr>
                </tbody>
            </table>
            
            </div>
            
            </div>
            <div class="row">
            <div class="col-md-8 col-md-offset-1" >
                <h2 class="">
                <span>
                        <img src="<?= base_url( "uploads/school_content/logo/{$school_logo}" ) ?>" title="<?= $school_name ?>" style="height:200px; width:180px;" >
                    </span>
                    <span style="margin-left:140px">
                    <?= $school_name ?>
                    </span>
                    </h2>
            </div> 
            <div class="col-md-2">
            <h2 class="text-right">
            <span>
            <?php  $url = $student['image'] != null ? $student['image'] : '/uploads/student_images/no_image.png';  ?>
                        <img src="<?= base_url( "$url" ) ?>" title="" style="height:200px; width:180px;" >
                    </span>
                    </h2>
            </div>
            </div>
            <div class="col-sm-12">
            <h3 class="text-center">Clearance Certificate </h3>
            </div>
                <div class="col-md-10 col-md-offset-1" >
                     <table class="table" style="margin:10px 10px 10px 10x !important;">
                        <tbody>
                            <tr>
                                <td width="12%" style="border-top: 0px;">
                                    Name :
                                </td>
                                <td width="65%" style="border-top: 0px; border-bottom: 1px solid #000;">
                                    <?php echo $student['firstname'] . " " . $student['lastname']; ?>
                                </td>
                          
                            </tr>
                            <tr>
                                <td style="border-top: 0px;">
                                    Father Name :
                                </td>
                                <td style="border-top: 0px; border-bottom: 1px solid #000;">
                                    <?php echo $student['father_name'] ?>
                                </td>
                            </tr>
                            <tr>
                                <td style="border-top: 0px;">
                                    Class : 
                                </td>
                                <td style="border-top: 0px; border-bottom: 1px solid #000;">
                                    <?= $class_details['class'] ?> / <?= $section ?>
                                </td>
                            </tr>
                            <tr>
                                <td width="10%" style="border-top: 0px;">
                                    Roll No :
                                </td>
                                <td style="border-top: 0px; border-bottom: 1px solid #000;">
                                    <?= $student['roll_no'] ?>
                                </td>
                            </tr>
                            <tr>
                            
                                <td width="10%" style="border-top: 0px;">
                                <?= admission_text() ?> :
                                </td>
                                
                                <td  style="border-top: 0px; border-bottom: 1px solid #000; ">
                                    <?= $student['admission_no'] ?>
                                </td>
                                
                                
                            </tr>
                              <tr>
                                <td width="20%" style="border-top: 0px;">
                                    Admission To Class :
                                </td>
                                <td style="border-top: 0px; border-bottom: 1px solid #000;">
                                    <?= $class_details2['class'] ?>
                                </td>
                            </tr>
                              <tr>
                                <td width="10%" style="border-top: 0px;">
                                    School left On :
                                </td>
                                <td style="border-top: 0px; border-bottom: 1px solid #000;">
                              <?php $struck = $student['updated_at']  ?>
                               
                                     <?php    echo $struck  ?>
                                </td>
                            </tr>
                              <tr>
                                <td width="10%" style="border-top: 0px;">
                                    Game played:
                                </td>
                                <td style="border-top: 0px; border-bottom: 1px solid #000;">
                                    <?= $examSchedule['admission_no'] ?>
                                </td>
                            </tr>
                              <tr>
                                <td width="10%" style="border-top: 0px;">
                                    Conduct Character :
                                </td>
                                <td style="border-top: 0px; border-bottom: 1px solid #000;">
                                    <?= $examSchedule['admission_no'] ?>
                                </td>
                            </tr>
                              <tr>
                                <td width="10%" style="border-top: 0px;">
                                    Any Other Remarks :
                                </td>
                                <td style="border-top: 0px; border-bottom: 1px solid #000;">
                                    <?= $examSchedule['admission_no'] ?>
                                </td>
                            </tr>
                              <tr>
                                <td width="10%" style="border-top: 0px;">
                                    Last Class Attend :
                                </td>
                                <td style="border-top: 0px; border-bottom: 1px solid #000;">
                                    <?= $class_details['class'] ?> / <?= $section ?>
                                </td>
                            </tr>
                            <tr>
                                <td width="10%" style="border-top: 0px;">
                                     Comments :
                                </td>
                                <td style="border-top: 0px; border-bottom: 1px solid #000;">
                                    
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                
                <!-- <div class="row">
                <div class="col-md-2">
                    <h4>Comments</h4>
                </div>
                <div class="col-md-10">
                    <div style="border-bottom: 1px solid #000;height:30px;"></div>
                </div>
                </div> -->
                <div style="clear: both;"></div>
                <div class="col-md-12" style="margin-top: 50px;">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td width="16%">Class Teacher</td>
                                <td width="25%"></td>
                                <td width="15%">Principal</td>
                                <td width="25%"></td>
                                <td width="8%">Print Date : </td>
                                <td width="10%"><?= date('M-d-Y',now())?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section><!-- /.content -->
</div>
