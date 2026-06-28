
<style type="text/css">
    
    .outlined {
        border: 1px solid #CBCBC9 !important;
        text-align: center;
   
    }
    .removeout{
        border: none !important;       
    }
    .bottomb{
        border-bottom: 1px solid #CBCBC9 !important; 
    }
    .bottomb{
  color: #6666;
    }

</style>

<?php
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();

?>

<div class="content-wrapper" style="min-height: 946px;">
    <section class="content-header">

    <div class="box box-primary " style="margin-bottom:0px">
        
        <div class="box-header with-border" style="text-align: center;">
            <div class="pull-left" style="padding-right:40px">
                <div class="btn-group" role="group" aria-label="#">
                    <?php  $admind = $this->session->userdata( 'admin' );
                    $this->load->helper('menu_helper');
                    $permission = admin_permission($admind['id']); ?>
                    <?php foreach($children as $child){
                        if($child['id'] !== $student['id'] ){  ?>
                            <a href="<?php echo base_url(); ?>student/view/<?php echo $child['id'] ?>" class="btn btn-default" ><?php
                                echo $child['firstname']." ".$child['lastname']; ?>
                            </a>
                        <?php }else{  ?>
                            <a href="<?php echo base_url(); ?>student/view/<?php echo $child['id'] ?>" class="btn btn-default" ><?php
                                echo '<span class="text-blue" style="">'.$child['firstname'].' '.$child['lastname'].'</span>'; ?>
                            </a>
                        
                        <?php } } ?>
                </div>
            </div>
            <div class="pull-right">
                <a href="<?php echo base_url(); ?>family/children_summary/<?php echo $child['id'] ?>" class="btn btn-default" >Sibling Summary
                </a>
            </div>
            </div>
        </div>
    </section>
    <?php
    
    $arrears = 0;
    $monthly_fee = $student['fee'] - $student['discount'];
    $_fee_tuition =  floatval( $student['fee_arrears'] ) - floatval( $student['late_payment_fee']) ;
    

    $_fee_tuition = ( $_fee_tuition > 0 ? $_fee_tuition : 0 );
    if ($_fee_tuition > $monthly_fee) {
        $arrears        = $_fee_tuition - $monthly_fee;
        $_fee_tuition   = $monthly_fee;
    }
    $total_arrears = $arrears;
    $arrears_advance  = floatval( $student['fee_arrears'] ) - floatval( $student['late_payment_fee'] );
    if ($arrears_advance >= 0) {
        $arrears_advance = 0;
    }else{
        $arrears_advance = abs($arrears_advance);
    }
   
    $total_other_fee  = 0;
    foreach ( $unpaid_students_other as $unpaid_student_other ):
        $total_other_fee +=  $unpaid_student_other['total_fee'];
    endforeach; ?>

                                                                                                                                                                                           
    <section class="content">
        <div class="row">
            <div class="col-md-3">
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive img-circle" src="<?php echo base_url() . $student['image'] ?>" alt="User profile picture">
                        <h3 class="profile-username text-center"><?php echo $student['firstname'] . " " . $student['lastname']; ?></h3>
                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b><?= admission_text() ?></b> <a class="pull-right text-aqua"><?php echo $student['admission_no']; ?></a>
                            </li>
                            <li class="list-group-item">
                                <b><?php echo $this->lang->line('roll_no'); ?></b> <a class="pull-right text-aqua"><?php echo $student['roll_no']; ?></a>
                            </li>
                            <li class="list-group-item">
                                <b><?php echo $this->lang->line('class'); ?></b> <a class="pull-right text-aqua"><?php echo $student['class']; ?></a>
                            </li>
                            <li class="list-group-item">
                                <b><?php echo $this->lang->line('section'); ?></b> <a class="pull-right text-aqua"><?php echo $student['section']; ?></a>
                            </li>
                            <li class="list-group-item">
                                <b><?php echo $this->lang->line('rte'); ?></b> <a class="pull-right text-aqua"><?php echo $student['rte']; ?></a>
                            </li>

                            <li class="list-group-item">
                                <b><?php echo $this->lang->line('gender'); ?></b> <a class="pull-right text-aqua"><?php echo $this->lang->line(strtolower($student['gender'])); ?></a>
                            </li>


                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#activity" data-toggle="tab" aria-expanded="true"><?php echo $this->lang->line('profile'); ?></a></li>
                        <!--<li class=""><a href="#fee" data-toggle="tab" aria-expanded="true">< ?php echo $this->lang->line('fees'); ?></a></li>-->
                        <li class=""><a href="#exam" data-toggle="tab" aria-expanded="true"><?php echo $this->lang->line('exam'); ?></a></li>
                        <li class=""><a href="#documents" data-toggle="tab" aria-expanded="true"><?php echo $this->lang->line('documents'); ?></a></li>
                        <li class=""><a href="#annual" data-toggle="tab" aria-expanded="true">Attendendance </a></li>
                        <li class=""><a href="#discount" data-toggle="tab" aria-expanded="true">Discount </a></li>
                        <li class=""><a href="#graph" data-toggle="tab" aria-expanded="true">Graph </a></li>
                        <li class=""><a href="#fee" data-toggle="tab" aria-expanded="true">Fee History</a></li>
                        <li class=""><a href="#due_fee" data-toggle="tab" aria-expanded="true">Due Fee</a></li>
                        <li class=""><a href="#timetable" data-toggle="tab" aria-expanded="true">Timetable</a></li>
                        <li class=""><a href="#subjects" data-toggle="tab" aria-expanded="true">Subjects</a></li>

                        <?php $admind = $this->session->userdata( 'admin' );
                        $this->load->helper('menu_helper');
                        $permission = admin_permission($admind['id']); ?>
                        <?php if ($permission->student_access == 1) {	?>
                            <?php /*?>         <li class="pull-right"><a href="<?php echo base_url() ?>/student/delete/<?php echo $student['id']; ?>" class="text-red" onclick="return confirm('Are you sure you want to delete this Student? All related data can not be recovered!');"><i class="fa fa-trash"></i> <?php echo $this->lang->line('delete'); ?> <?php echo $this->lang->line('student'); ?></a></li><?php */?>


                            <?php if ($student['struck_off'] == 0): ?>

                                <li class="pull-right">
                                    <a href="<?php echo base_url() ?>/student/struckof/<?php echo $student['id']; ?>"  class="" onclick="return confirm('Are you sure you want to struck off this Student?');" title="struckoff"><i class="fa fa-user"></i>   
                                    </a>
                                </li>

                            <?php endif ?>

                            <li class="pull-right">
                                <a href="#"  class="schedule_modal " data-toggle="tooltip" title="<?php echo $this->lang->line('login_detail'); ?>"><i class="fa fa-key"></i>
                                  
                                </a>
                            </li>
                            
                            <?php if ($student['struck_off'] == 0): ?>
                                <li class="pull-right">
                                    <a href="<?php echo base_url(); ?>student/edit/<?php echo $student['id'] ?>?redirect=<?= urlencode( $redirect_url ) ?>" class="" >
                                        <i class="fas fa-pencil-alt"></i> 
                                    </a>
                                </li>
                            <?php endif ?>

                        <?php }?>
                            <li class="pull-right">
                                <a href="<?php echo base_url(); ?>fee_management/receive_fee/<?php echo $student['id'] ?>"   class="" data-toggle="tooltip"><i class="fa fa-money"></i></a>
                            </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="activity">
                            <div class="table-responsive">
                                <table class="table table-hover    ">
                                    <tbody>
                                    <tr>
                                        <td class="col-md-4"><?php echo $this->lang->line('admission_date'); ?></td>
                                        <td class="col-md-5">
                                            <?php echo date('d-M-Y', $this->customlib->dateyyyymmddTodateformat($student['admission_date'])); ?></td>
                                    </tr>
                                    <tr>
                                        <td class="col-md-4">Admission Class</td>
                                        <td class="col-md-5">
                                            <?php echo $class_details['class']; ?></td>
                                    </tr>

                                    <tr>
                                        <td><?php echo $this->lang->line('date_of_birth'); ?></td>
                                        <td><?php echo date('d-M-Y', $this->customlib->dateyyyymmddTodateformat($student['dob'])); ?></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo $this->lang->line('category'); ?></td>
                                        <td>
                                            <?php
                                            foreach ($category_list as $value) {
                                                if ($student['category_id'] == $value['id']) {
                                                    echo $value['category'];
                                                }
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><?php echo $this->lang->line('mobile_no'); ?></td>
                                        <td><?php echo $student['mobileno']; ?></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo $this->lang->line('cast'); ?></td>
                                        <td><?php echo $student['cast']; ?></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo $this->lang->line('religion'); ?></td>
                                        <td><?php echo $student['religion']; ?></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo $this->lang->line('email'); ?></td>
                                        <td><?php echo $student['email']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>B Form</td>
                                        <td><?php echo $student['b_form']; ?></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <h3><?php echo $this->lang->line('address'); ?> <?php echo $this->lang->line('detail'); ?></h3><hr/>
                            <div class="table-responsive">
                                <table class="table table-hover    "><tbody>
                                    <tr>
                                        <td><?php echo $this->lang->line('current_address'); ?></td>
                                        <td><?php echo $student['current_address']; ?></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo $this->lang->line('permanent_address'); ?></td>
                                        <td><?php echo $student['permanent_address']; ?></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <h3><?php echo $this->lang->line('parent'); ?> / <?php echo $this->lang->line('guardian_details'); ?> </h3><hr/>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <tr>
                                        <td  class="col-md-4"><?php echo $this->lang->line('father_name'); ?></td>
                                        <td  class="col-md-5"><?php echo $student['father_name']; ?></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo $this->lang->line('father_phone'); ?></td>
                                        <td><?php echo $student['father_phone']; ?></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo $this->lang->line('father_occupation'); ?></td>
                                        <td><?php echo $student['father_occupation']; ?></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo $this->lang->line('mother_name'); ?></td>
                                        <td><?php echo $student['mother_name']; ?></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo $this->lang->line('mother_phone'); ?></td>
                                        <td><?php echo $student['mother_phone']; ?></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo $this->lang->line('mother_occupation'); ?></td>
                                        <td><?php echo $student['mother_occupation']; ?></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo $this->lang->line('guardian_name'); ?></td>
                                        <td><?php echo $student['guardian_name']; ?></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo $this->lang->line('guardian_relation'); ?></td>
                                        <td><?php echo $student['guardian_relation']; ?></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo $this->lang->line('guardian_phone'); ?></td>
                                        <td><?php echo $student['guardian_phone']; ?></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo $this->lang->line('guardian_occupation'); ?></td>
                                        <td><?php echo $student['guardian_occupation']; ?></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo $this->lang->line('guardian_address'); ?></td>
                                        <td><?php echo $student['guardian_address']; ?></td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                            <h3><?php echo $this->lang->line('miscellaneous_details'); ?></h3><hr/>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <tbody>
                                    <tr>
                                        <td  class="col-md-4"><?php echo $this->lang->line('previous_school_details'); ?></td>
                                        <td  class="col-md-5"><?php echo $student['previous_school']; ?></td>
                                    </tr>
                                    <tr>
                                        <td  class="col-md-4"><?php echo $this->lang->line('national_identification_no'); ?></td>
                                        <td  class="col-md-5"><?php echo $student['adhar_no']; ?></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo $this->lang->line('local_identification_no'); ?></td>
                                        <td><?php echo $student['samagra_id']; ?></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo $this->lang->line('bank_account_no'); ?></td>
                                        <td><?php echo $student['bank_account_no']; ?></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo $this->lang->line('bank_name'); ?></td>
                                        <td><?php echo $student['bank_name']; ?></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo $this->lang->line('ifsc_code'); ?></td>
                                        <td><?php echo $student['ifsc_code']; ?></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane" id="fee">
                            <h2 class="page-header">Fee Transaction History</h2>
                            
                            <div class="table-responsive">
                                <table class="table    table-bordered " id="transation_history">
                                    <thead>
                          

                                    <tr class="">
                                        <th colspan="3" class="bottomb" > </th>
                                        <th colspan="5"  class="text-center outlined" style="" >Tuition Fee</th>
                                        <th colspan="4" class="text-center outlined" >Other Fee</th>
                                        <th class="bottomb"></th>
                                        <th class="bottomb"></th>
                                        
                                    </tr>

                                    <tr >
                                        <th class="text-center">Pay Date</th>
                                        <th class="text-center">User ID</th>
                                        <th class="text-center">Vr ID</th>
                                        <th class="text-center">Fee Due</th>
                                        <th class="text-center">Fee Paid</th>
                                        <th class="text-center">Fee Desc</th>
                                        <th class="text-center">Fee Waived</th>
                                        <th class="text-center">Balance</th>
                                        <th class="text-center">Other Paid Details</th>
                                        <th class="text-center">Other Paid</th>
                                        <th class="text-center">Other Waived Details</th>
                                        <th class="text-center">Other Waived</th>
                                        <th class="text-center">Total</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                              

                        </div>
                        <div class="tab-pane" id="due_fee">
                            <h2 class="page-header">Due Fee</h2>
                            
                            <div class="table-responsive">
                                <table class="table table-hover    ">
                                    <tbody>
                                        <tr>
                                            <td class="col-md-4"><?= date('M')?> Fee</td>
                                            <td class="col-md-5">
                                                <?php echo $_fee_tuition; ?></td>
                                        </tr>
                                        <tr>
                                            <td class="col-md-4">Arrears</td>
                                            <td class="col-md-5">
                                                <?php echo $arrears ; ?></td>
                                        </tr>
                                        <tr>
                                            <td class="col-md-4">Advance</td>
                                            <td class="col-md-5">
                                                <?php echo $arrears_advance; ?></td>
                                        </tr>
                                        <tr>
                                            <td class="col-md-4">Other Fee</td>
                                            <td class="col-md-5">
                                                <?php echo $total_other_fee; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane" id="exam">
                            <h2 class="page-header"><?php echo $this->lang->line('exam'); ?> <?php echo $this->lang->line('list'); ?></h2>
                            <?php
                            if (empty($examSchedule)) {
                                ?>
                                <div class="alert alert-danger">
                                    No Exam Found.
                                </div>
                                <?php
                            } else {
                                foreach ($examSchedule as $key => $value) {
                                   
                                    ?>
                                    <h4 class="page-header"><?php echo $value['exam_name']; ?></h4>
                                    <?php
                                    if (empty($value['exam_result'])) {
                                        ?>
                                        <div class="alert alert-info"><?php echo $this->lang->line('no_result_prepare'); ?></div>
                                        <?php
                                    } else {
                                        ?>
                                        <div class="table-responsive">
                                            <table class="table table-hover     example">
                                                <thead>
                                                <tr>
                                                    <th>
                                                        <?php echo $this->lang->line('subject'); ?>
                                                    </th>
                                                    <th>
                                                        <?php echo $this->lang->line('full_marks'); ?>
                                                    </th>
                                                    <th>
                                                        <?php echo $this->lang->line('passing_marks'); ?>
                                                    </th>
                                                    <th>
                                                        <?php echo $this->lang->line('obtain_marks'); ?>
                                                    </th>
                                                    <th class="text text-right">
                                                        <?php echo $this->lang->line('result'); ?>
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                $obtain_marks = "";
                                                $total_marks = "";
                                                $result = "Pass";
                                                $exam_results_array = $value['exam_result'];

                                                $s = 0;
                                                foreach ($exam_results_array as $result_k => $result_v) {
                                                    $total_marks = $total_marks + $result_v['full_marks'];
                                                    ?>
                                                    <tr>
                                                        <td>  <?php                                                             echo $result_v['exam_name'] . " (" . substr($result_v['exam_type'], 0, 2) . ".) ";                                ?></td>
                                                        <td><?php echo $result_v['full_marks']; ?></td>
                                                        <td><?php echo $result_v['passing_marks']; ?></td>
                                                        <td>

                                                            <?php
                                                            if ($result_v['attendence'] == "pre") {
                                                                echo $get_marks_student = $result_v['get_marks'];
                                                                $passing_marks_student = $result_v['passing_marks'];
                                                                if ($result == "Pass") {
                                                                    if ($get_marks_student < $passing_marks_student) {
                                                                        $result = "Fail";
                                                                    }
                                                                }
                                                                $obtain_marks = $obtain_marks + $result_v['get_marks'];
                                                            } else {
                                                                $result = "Fail";
                                                                echo ($result_v['attendence']);
                                                            }
                                                            ?>
                                                        </td>
                                                        <td class="text text-center">
                                                            <?php
                                                            if ($result_v['attendence'] == "pre") {
                                                                $passing_marks_student = $result_v['passing_marks'];

                                                                if ($get_marks_student < $passing_marks_student) {
                                                                    echo "<span class='pull-right text-red'>".$this->lang->line('fail')."</span>";
                                                                } else {
                                                                    echo "<span class='pull-right text-green'>Pass</span>";
                                                                }
                                                            } else {
                                                                echo "<span class='label pull-right bg-red'>".$this->lang->line('fail')."</span>";
                                                                $s++;
                                                            }
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                    if ($s == count($exam_results_array)) {
                                                        $obtain_marks = 0;
                                                    }
                                                }
                                                ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="row">
                                            <?php
                                            $foo = "";
                                            ?>
                                            <div class="col-sm-3 border-right">
                                                <div class="description-block">
                                                    <h5 class="description-header"><?php echo $this->lang->line('grand_total'); ?> :
                                                        <span class="description-text"><?php echo $obtain_marks . "/" . $total_marks; ?></span>

                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="col-sm-3 border-right">
                                                <div class="description-block">
                                                    <h5 class="description-header"><?php echo $this->lang->line('percentage'); ?>:
                                                        <span class="description-text"><?php
                                                            $foo = ($obtain_marks * 100) / $total_marks;
                                                            echo number_format((float) $foo, 2, '.', '');
                                                            ?>
                                                        </span>
                                                    </h5>
                                                </div>
                                            </div>                                            <div class="col-sm-3 pull">
                                                <div class="description-block">
                                                    <h5 class="description-header"><?php echo $this->lang->line('result'); ?> :
                                                        <span class="description-text">
                                                            <?php
                                                            if ($result == "Pass") {
                                                                ?>
                                                                <b class='text text-success'><?php echo $result; ?></b>
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <b class='text text-danger'><?php echo $result; ?></b>
                                                                <?php
                                                            }
                                                            ?>
                                                        </span>
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="col-sm-3 border-right">
                                                <div class="description-block">
                                                    <h5 class="description-header">
                                                        <span class="description-text"><?php
                                                            if (!empty($gradeList)) {
                                                                foreach ($gradeList as $key => $value) {
                                                                    if ($foo >= $value['mark_from'] && $foo <= $value['mark_upto']) {
                                                                        ?>
                                                                        <?php echo $this->lang->line('grade')." : " . $value['name']; ?>
                                                                        <?php
                                                                        break;
                                                                    }
                                                                }
                                                            }
                                                            ?></span>
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                                    <?php }
                                    ?>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                        <div class="tab-pane" id="graph">
                            <div class="box box-primary" >
                                <div class="box-header with-border">

                                    <h4 class="pull-left" style="margin-top: 0px;">
                                        <?= $student_monthly ?? '' ?>
                                    </h4>
                                    <div class="pull-right">
                                        <form action="" method="post" class="form-inline">
                                            <div class="form-group">
                                                <label>Year</label>
                                                <select class="form-control" name="year" id="year_student_monthly">
                                                    <?php
                                                    $date = new DateTime( date( 'Y-m-d', now() ) );
                                                    $date->sub( new DateInterval( 'P6Y' ) );
                                                    for ( $i = 0; $i <= 6; $i++ ):
                                                        ?>
                                                        <option value="<?= $date->format( 'Y' ) ?>" <?= ( $year == $date->format( 'Y' ) ? "selected" : "" ) ?>><?= $date->format( 'Y' ) ?></option>
                                                        <?php
                                                        $date->add( new DateInterval( 'P1Y' ) );
                                                    endfor;
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">

                                                <input type="button" id="fetch_student_monthly" class="btn btn-primary" value="Get Graph">

                                            </div>
                                        </form>
                                    </div>

                                </div>
                                <div class="box-body">

                                    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
                                    <canvas id="Chart_student_monthly" width="200" height="70" class=""></canvas>

                                </div>
                            </div>

                        </div>
                        <div class="tab-pane" id="discount">
                            <h2 class="page-header"> Fee/Discount History
                            </h2>
                            <div class="table-responsive">
                                <table class="table     table-bordered table-hover example">
                                    <thead>
                                    <tr>
                                        <th class="text-center" >
                                            SrNo.
                                        </th>
                                        <th class="text-center">
                                            Date
                                        </th>


                                        <th  class="text-center">
                                            Class Fee
                                        </th >
                                        <th class="text-center">
                                            Monthly Fee
                                        </th>
                                        <th class="text-center">
                                            Update Discount
                                        </th>
                                        <th class="text-center">
                                            Action
                                        </th>


                                    </tr>
                                    </thead>
                                    <div class="row">
                                        <tbody>
                                        <?php
                                        if (empty($discount_history)) {
                                            ?>
                                            <tr>
                                                <td colspan="6" class="text-danger text-center"><?php echo $this->lang->line('no_record_found'); ?></td>
                                            </tr>
                                            <?php
                                        } else {
                                            foreach ($discount_history as $key=>$value) {
                                                ?>
                                                <tr>
                                                    <td class="text-center"><?= $key+1; ?></td>

                                                    <td class="text-center"><?=   date('d-M-Y', strtotime($value['date'])); ?></td>
                                                    <td class="text-center"><?= $value['class_fee']; ?></td>
                                                    <td class="text-center"><?= $value['monthly_fee']; ?></td>
                                                    <td class="text-center"><?= $value['latest_discount']; ?></td>


                                                    <td class="mailbox-date text-center">
                                                        <a href="<?php echo base_url(); ?>student/discount_delete/<?php echo $value['id'] . "/" . $value['student_id']; ?>"class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('Are you sure you want to delete this item?');">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        ?>
                                        </tbody>
                                </table>
                            </div>

                        </div>

                        <div class="tab-pane" id="annual">
                            <h2 class="page-header">Annual Attendence Report</h2>


                            <?php


                            if ( isset( $resultlist ) ) {
                            ?>
                            <div class="box box-primary" id="attendencelist">
                                <div class="box-header with-border">
                                    <div class="row">


                                        <div class="col-md-4 col-sm-4">
                                            <h3 class="box-title attendance_report_title">

                                                <?= $student_details['firstname']." ".$student_details['lastname'] ?>   (<?= $student_details['class']."/".$student_details['section'] ?>)
                                            </h3>
                                        </div>
                                        <div class="col-md-8 col-sm-8">
                                            <div class="pull-right">
                                                <?php

                                                foreach ( $attendencetypeslist as $key_type => $value_type ) {
                                                    ?>
                                                    &nbsp;&nbsp;
                                                    <b>
                                                        <?php
                                                        $att_type = str_replace( " ", "_", strtolower( $value_type['type'] ) );
                                                        echo $this->lang->line( $att_type ) . ": " . $value_type['key_value'] . "";
                                                        ?>
                                                    </b>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-body table-responsive">
                                    <?php
                                    if ( !empty( $resultlist ) ) {
                                    ?>
                                    <div class="mailbox-controls">
                                        <div class="pull-right">
                                        </div>
                                    </div>
                                    <table class="table     table-bordered table-hover  xyz">
                                        <thead>
                                        <tr>
                                            <th>

                                            </th>
                                            <th class="text-success text-center">P</th>
                                            <th class="text-danger text-center">A</th>
                                            <th class="text-blue text-center">L</th>

                                            <?php
                                            foreach ( $attendence_array as $at_key => $at_value ) {
                                                if ( date( 'D', $this->customlib->dateyyyymmddTodateformat( $at_value ) ) == "Sun" ) {
                                                    ?>
                                                    <th class="tdcls text text-center bg-danger">
                                                        <?php
                                                        echo date( 'd', $this->customlib->dateyyyymmddTodateformat( $at_value ) ) . "<br/>" .
                                                            date( 'D', $this->customlib->dateyyyymmddTodateformat( $at_value ) );
                                                        ?>
                                                    </th>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <th class="tdcls text text-center">
                                                        <?php
                                                        echo date( 'd', $this->customlib->dateyyyymmddTodateformat( $at_value ) ) . "<br/>" .
                                                            date( 'D', $this->customlib->dateyyyymmddTodateformat( $at_value ) );
                                                        ?>
                                                    </th>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </tr>
                                        </thead>
                                        <tbody>




                                                <?php
                                                for ( $m = 1; $m < 13; $m++ ):

                                                    $total_present =0;
                                                    $total_absent = 0;
                                                    $total_leave = 0;

                                                    foreach ( $resultlist[$m]['day_attendance'] as $at_key => $at_value):
                                                        $attLetter = $at_value['0'];

                                                        //	echo	"<pre>";
                                                        //		print_r($attLetter);
                                                        //	echo	"<pre>";





                                                        if ( $attLetter['key'] == 'P') {

                                                            $total_present += 1;

                                                        }


                                                        if ($attLetter['attendence_id'] == '3') {

                                                            $total_absent += 1;

                                                        }
                                                        if ( $attLetter['attendence_id'] == '4' ) {

                                                            $total_leave += 1;

                                                        }


                                                    endforeach;
                                                    $annual = str_pad($m,2,0,STR_PAD_LEFT);
                                                    $monthNum  = $annual;
                                                    $dateObj   = DateTime::createFromFormat('!m', $monthNum);
                                                    $monthName = $dateObj->format('F');
                                                    ?>
                                                    <tr>
                                                        <th><?=$monthName ?></th>

                                                        <td  class="text-success text-center"><?= $total_present ?></td>
                                                        <td class="text-danger text-center"><?= $total_absent ?></td>
                                                        <td class="text-blue text-center"><?= $total_leave ?></td>


                                                        <?php
                                                        foreach ( $resultlist[$m]['day_attendance'] as $at_key => $at_value){
                                                            ?>
                                                            <th><?php print_r($at_value['0']['key']); ?></th>
                                                            <?php

                                                        }
                                                        ?>
                                                    </tr>
                                                <?php
                                                endfor;
                                                ?>






                                                <?php


                                                }

                                                ?>
                                        </tbody>
                                    </table>
                                    <?php
                                    } else {
                                        ?>
                                        <div class="alert alert-info">
                                            <?php echo $this->lang->line( 'no_attendance_prepare' ); ?>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="timetable">
                            <div class="box-body">
                                <?php
                                if (!empty($result_array)) {                          
                                    ?>
                                    <div class="table-responsive">
                                        <table class="table     table-bordered table-hover example">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        <?php echo $this->lang->line('subject'); ?>
                                                    </th>
                                                    <?php foreach ($getDaysnameList as $key => $value) {
                                                        ?>
                                                        <th class="text text-center">
                                                            <?php echo $value; ?>
                                                        </th>
                                                    <?php }
                                                    ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($result_array as $key => $timetable) {
                                                    ?>
                                                    <tr>
                                                        <th><?php echo $key; ?></th>
                                                        <?php
                                                    //   pp($timetable);
                                                        foreach ($timetable as $key => $value) {
                                                    //     pp($value);
                                                            $status = $value->status;
                                                            if ($status == "Yes") {
                                                                ?>
                                                                <td class="text text-center">
                                                                    <div class="attachment-block clearfix">
                                                                        <?php
                                                                        if ($value->start_time != " " && $value->end_time != " ") {
                                                                            ?>
                                                                            <strong class=""><?php echo $value->start_time; ?></strong>
                                                                            <b class="text text-center">-</b>
                                                                            <strong class=""><?php echo $value->end_time; ?></strong><br/>
                                                                            <!-- <strong class=""><?php echo $this->lang->line('room_no'); ?>:<?php echo $value->room_no; ?>:</strong> -->
                                                                            <?php
                                                                        } else {
                                                                            ?>
                                                                            <b class="text text-center"><?php echo $this->lang->line('not'); ?> <br/><?php echo $this->lang->line('scheduled'); ?></b><br/>
                                                                            <strong class="text-green"></strong>
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </td>
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <td class="text text-center">
                                                                    <div class="attachment-block clearfix">
                                                                        <strong class="text-red"><?php echo $value->start_time; ?></strong><br/>
                                                                    </div>
                                                                </td>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    </tr>
                                                    <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <?php
                                } else {
                                    ?>
                                    <div class="alert alert-info"><?php echo $this->lang->line('no_record_found'); ?></div>
                                    <?php
                                }
                                ?>
                            </div> 
                        </div>
                        <div class="tab-pane" id="subjects">
                        <div class="box box-primary">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix">
                            <?php echo $this->lang->line('subject_list'); ?>
                        </h3>
                    </div>                   
                    <div class="box-body">
                        <table class="table     table-bordered table-hover example">
                            <thead>
                                <tr>
                                    <th><?php echo $this->lang->line('teacher_name'); ?></th>
                                    <th><?php echo $this->lang->line('subject'); ?></th>
                                    <th class="text-right"><?php echo $this->lang->line('type'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($subject_array)) {
                                    ?>
                                    <tr>
                                        <td colspan="12" class="text-danger text-center"><?php echo $this->lang->line('no_record_found'); ?></td>
                                    </tr>
                                    <?php
                                } else {
                                    foreach ($subject_array as $key => $value) {
                                        ?>
                                        <tr>
                                            <td><?php echo $value['teacher_name'] ?></td>
                                            <td><?php echo $value['name'] ?></td>
                                            <td class="text-right"><?php echo $value['type'] ?></td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                        </div>
                        <div class="tab-pane" id="documents">
                            <div class="timeline-header no-border">
                                <button type="button"  data-student-session-id="<?php echo $student['student_session_id'] ?>" class="btn btn-xs btn-primary pull-right myTransportFeeBtn"> <i class="fa fa-upload"></i>  <?php echo $this->lang->line('upload_documents'); ?></button>

                                <h2 class="page-header"><?php echo $this->lang->line('documents'); ?> <?php echo $this->lang->line('list'); ?></h2>
                                <div class="table-responsive">
                                    <table class="table     table-bordered table-hover example">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <?php echo $this->lang->line('title'); ?>
                                                </th>
                                                <th>
                                                    <?php echo $this->lang->line('file'); ?> <?php echo $this->lang->line('name'); ?>
                                                </th>
                                                <th class="mailbox-date text-right">
                                                    <?php echo $this->lang->line('action'); ?>
                                                </th>
                                            </tr>
                                        </thead>
                                        <div class="row">
                                        <tbody>
                                                <?php
                                                if (empty($student_doc)) {
                                                    ?>
                                                    <tr>
                                                        <td colspan="5" class="text-danger text-center"><?php echo $this->lang->line('no_record_found'); ?></td>
                                                    </tr>
                                                    <?php
                                                } else {
                                                    foreach ($student_doc as $value) {
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $value['title']; ?></td>
                                                            <td><?php echo $value['doc']; ?></td>
                                                            <td class="mailbox-date pull-right">
                                                                <a href="<?php echo base_url(); ?>student/download/<?php echo $value['student_id'] . "/" . $value['doc']; ?>"class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('download'); ?>">
                                                                    <i class="fa fa-download"></i>
                                                                </a>
                                                                <a href="<?php echo base_url(); ?>student/doc_delete/<?php echo $value['id'] . "/" . $value['student_id']; ?>"class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('Are you sure you want to delete this item?');">
                                                                    <i class="fa fa-remove"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            </table>
                        </div>


                    </div>
                </div>
            </div>
    </section>
</div>
<script type="text/javascript">
    $(".myTransportFeeBtn").click(function () {
        $("span[id$='_error']").html("");
        $('#transport_amount').val("");
        $('#transport_amount_discount').val("0");
        $('#transport_amount_fine').val("0");
        var student_session_id = $(this).data("student-session-id");
        $('.transport_fees_title').html("<b>Upload Document</b>");
        $('#transport_student_session_id').val(student_session_id);
        $('#myTransportFeesModal').modal({
            backdrop: 'static',
            keyboard: false,
            show: true

        });
    });
</script>
<div class="modal fade" id="myTransportFeesModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title title text-center transport_fees_title"></h4>
            </div>
            <div class="">
                <div class="form-horizontal">
                    <div class="">
                        <input  type="hidden" class="form-control" id="transport_student_session_id"  value="0" readonly/>
                        <form id="form1" action="<?php echo site_url('student/create_doc') ?>"  id="employeeform" name="employeeform" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                            <?php echo $this->customlib->getCSRF(); ?>
                            <div id='upload_documents_hide_show'>
                                <input type="hidden" name="student_id" value="<?php echo $student_doc_id; ?>" id="student_id">
                                <h4><?php echo $this->lang->line('upload_documents1'); ?></h4>
                                <div class="col-md-12">
                                    <div class="">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"><?php echo $this->lang->line('title'); ?></label>
                                                <input id="first_title" name="first_title" placeholder="" type="text" class="form-control"  value="<?php echo set_value('first_title'); ?>" />
                                                <span class="text-danger"><?php echo form_error('first_title'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"><?php echo $this->lang->line('Documents'); ?></label>
                                                <input id="first_doc_id" name="first_doc" placeholder="" type="file" style="margin-top:8px; border:0; outline:none;" class="form-control"  value="<?php echo set_value('first_doc'); ?>" />
                                                <span class="text-danger"><?php echo form_error('first_doc'); ?></span>
                                            </div>
                                        </div>
                                    </div></div>
                            </div>
                            <div class="modal-footer" style="clear:both">
                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><?php echo $this->lang->line('cancel'); ?></button>
                                <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="scheduleModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title_logindetail"></h4>
            </div>
            <div class="modal-body_logindetail">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $this->lang->line('cancel'); ?></button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).on('click', '.schedule_modal', function () {
        $('.modal-title_logindetail').html("");
        $('.modal-title_logindetail').html("<?php echo $this->lang->line('login_details'); ?>");
        var base_url = '<?php echo base_url() ?>';
        var student_id = '<?php echo $student["id"] ?>';
        var student_first_name = '<?php echo $student["firstname"] ?>';
        var student_last_name = '<?php echo $student["lastname"] ?>';
        $.ajax({
            type: "post",
            url: base_url + "student/getlogindetail",
            data: {'student_id': student_id},
            dataType: "json",
            success: function (response) {
                var data = "";
                data += '<div class="col-md-12">';
                data += '<div class="table-responsive">';
                data += '<p class="lead text text-center">' + student_first_name + ' ' + student_last_name + '</p>';
                data += '<table class="table table-hover">';
                data += '<thead>';
                data += '<tr>';
                data += '<th>'+"<?php echo $this->lang->line('user_type'); ?>"+'</th>';
                data += '<th class="text text-center">'+"<?php echo $this->lang->line('username'); ?>"+'</th>';
                data += '<th class="text text-center">'+"<?php echo $this->lang->line('password'); ?>"+'</th>';
                data += '</tr>';
                data += '</thead>';
                data += '<tbody>';
                $.each(response, function (i, obj)
                {
                    data += '<tr>';
                    data += '<td><b>' + firstToUpperCase(obj.role) + '</b></td>';
                    data += '<td class="text text-center">' + obj.username + '</td> ';
                    data += '<td class="text text-center">' + obj.password + '</td> ';
                    data += '</tr>';
                });
                data += '</tbody>';
                data += '</table>';
                data += '<b class="lead text text-danger" style="font-size:14px;"> '+"<?php echo $this->lang->line('login_url'); ?>"+': ' + base_url + 'site/userlogin</b>';
                data += '</div>  ';
                data += '</div>  ';
                $('.modal-body_logindetail').html(data);
                $("#scheduleModal").modal('show');
            }
        });
    });

    function firstToUpperCase(str) {
        return str.substr(0, 1).toUpperCase() + str.substr(1);
    }

</script>


<script>



function transaction_history(){
        var student_id  =  <?= $student['id']; ?>;
        $('#transation_history').DataTable({
            "orderClasses": false,
            "bSort": false,
            "paging": false,
            "aoColumns" : [null, null, null, null, null,null,null,null,null,null,null,null,null, { "bSearchable": true, "bVisible": false }],
            'columnDefs': [
                {
                    "targets": '_all',
                    "className": "outlined",
                }],
               
            "ajax": {
                url : "<?php echo site_url( "fee_management/transaction_history" ) ?>",
                type : 'GET',
                dataType: 'JSON',
                data: {
                    'student_id': student_id,
                },
            },
        });
    }

    var student_monthly = [];
    var student_monthly1 = [];
    var student_monthly2 = [];
    var student_monthly3 = [];
    var student_monthly4 = [];
    var dates_student_monthly = [];
    var total1_student_monthly = [];

    $("#fetch_student_monthly").on('click', function(){
        $(this).prop('disabled', true);
        var year =  $("#year_student_monthly").val();
        var id = $("#student_id").val();
        $.ajax({
            method: 'POST',
            url: '<?php echo base_url() ?>transactions/student_all_specific',
            data: { 'year': year, 'student_id': id },
            success: function(data){
                obj  = JSON.parse(data);
                console.log(obj);

                $.each(obj,function(i,item){

                    dates_student_monthly.push(i)
                    var count_month = 0
                    var count_month_absent = 0
                    var count_month_leave = 0
                    var count_month_late = 0
                    var count_month_holiday = 0
                    var total = 0;
                    var total_teacher = 0;

                    $.each(item,function(j,item){
                        var count = 0;
                        var count_absent = 0;
                        var count_leave = 0;
                        var count_late = 0;
                        var count_holiday = 0;

                        total = j++;
                        $.each(item,function(k,item){
                            total_teacher = k++;
                            if(item != false){
                                if(item.attendence_type_id == 1  ){
                                    count++;
                                }
                                if(item.attendence_type_id == 2  ){
                                    count_absent++;
                                }
                                if(item.attendence_type_id == 3  ){

                                    count_leave++;
                                }
                                if(item.attendence_type_id == 4  ){

                                    count_late++;
                                }
                                if(item.attendence_type_id == 5  ){

                                    count_holiday++;
                                }


                            }

                        })

                        count_month = count_month + count;
                        count_month_absent = count_month_absent + count_absent;
                        count_month_leave = count_month_leave  + count_leave;
                        count_month_late = count_month_late + count_late;
                        count_month_holiday = count_month_late + count_holiday;

                    })

                    var count_percent = parseInt(count_month) * 100 / parseInt(total);
                    var count_percent_absent = parseInt(count_month_absent) * 100 / parseInt(total);
                    var count_percent_leave = parseInt(count_month_leave) * 100 / parseInt(total);
                    var count_percent_late = parseInt(count_month_late) * 100 / parseInt(total);
                    var count_percent_holiday = parseInt(count_month_holiday) * 100 / parseInt(total);



                    total_teacher_to =total_teacher+1


                    total_percent =count_percent/total_teacher_to;
                    total_percent_absent =count_percent_absent/total_teacher_to;
                    total_percent_leave =count_percent_leave/total_teacher_to;
                    total_percent_late =count_percent_late/total_teacher_to;
                    total_percent_holiday =count_percent_holiday/total_teacher_to;



                    student_monthly.push(total_percent);
                    student_monthly1.push(total_percent_absent);
                    student_monthly2.push(total_percent_leave);
                    student_monthly3.push(total_percent_late);
                    student_monthly4.push(total_percent_holiday);



                })


                var ctx = $("#Chart_student_monthly");


                var color = dates_student_monthly;

                var vertical = student_monthly;
                var vertical1 = student_monthly1;
                var vertical2 = student_monthly2;
                var vertical3 = student_monthly3;
                var vertical4 = student_monthly4;


                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: color,
                        datasets: [{
                            label: "Absent",
                            backgroundColor: "red",
                            data: vertical1,
                        }, {
                            label: "Present",
                            backgroundColor: "green",
                            data: vertical,
                        },{
                            label: "Late",
                            backgroundColor: "purple",
                            data: vertical3,
                        },{
                            label: "Leave",
                            backgroundColor: "blue",
                            data: vertical2
                        }, {
                            label: "Holiday",
                            backgroundColor: "Black",
                            data: vertical4,

                        }]

                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    min: 0,
                                    max: 100,
                                    callback: function(value) {
                                        return value + "%"
                                    }
                                },
                                scaleLabel: {
                                    display: true,
                                    labelString: "Percentage"
                                }
                            }]

                        }
                    }
                });

            },

        });

    });

</script>

<script>
    $(document).ready(function () {
  


        transaction_history();
        $('.detail_popover').popover({
            placement: 'right',
            title: '',
            trigger: 'hover',
            container: 'body',
            html: true,
            content: function () {
                return $(this).closest('td').find('.fee_detail_popover').html();
            }
        });
    });
</script>