<link rel="stylesheet" href="<?php echo base_url(); ?>backend/calender/zabuto_calendar.min.css">
<script type="text/javascript" src="<?php echo base_url(); ?>backend/calender/zabuto_calendar.min.js"></script>
<style>
    .grade-1 {
        background-color: #FA2601;
    }
    .grade-2 {
        background-color: #FA8A00;
    }
    .grade-3 {
        background-color: #FFEB00;
    }
    .grade-4 {
        background-color: #27AB00;
    }
    .grade-5 {
        background-color: #a7a7a7;
    }
</style>

<div class="content-wrapper" style="min-height: 946px;">
<section class="content-header">
        <div class="box box-primary" style="margin-bottom: 0px;">
            <div class="box-body">
            <div class="col-xs-5 col-sm-3 col-md-2"  > 
            <?php  $url = $student['image'] != null ? $student['image'] : 'uploads/student_images/no_image.png';  ?>
                <img class="student-image profile-user-img img-responsive img-circle" src="<?= base_url().$url ?>" alt="User profile picture">
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

            
                <div class="box box-primary">


                
                    <div class="box-header with-border">
                        <h3 class="box-title">
                         Attendence Report ( <?= $student['firstname']." ".$student['lastname']." / ".$student['class']." / ".$student['section']?>)
                        </h3>
                    </div>                  
                    <div class="box-body">
             

<?php


if ( isset( $resultlist ) ) {
?>

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
                </div>
            </div>
        </div>
</div>
</section>
</div

<!-- initialize the calendar on ready -->
<script type="application/javascript">
    $(document).ready(function () {
    var  base_url = '<?php echo base_url() ?>';
    var student_session_id='<?php echo $student['student_session_id']; ?>';
    $("#my-calendar").zabuto_calendar({
    legend: [
    {type: "block", label: "<?php echo $this->lang->line('absent')?>", classname: 'grade-1'},
    {type: "block", label: "<?php echo $this->lang->line('present')?>", classname: 'grade-4'},
    {type: "block", label: "<?php echo $this->lang->line('late')?>", classname: 'grade-3'},
    {type: "block", label: "<?php echo $this->lang->line('late_with_excuse')?>", classname: 'grade-2'},
    {type: "block", label: "<?php echo $this->lang->line('holiday')?>", classname: 'grade-5'},
    ],
    ajax: {
    url: base_url+"parent/parents/getAjaxAttendence?grade=1&student_session="+student_session_id,
    }
    });
    });
</script>