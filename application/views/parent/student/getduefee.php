<?php
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
?>
<div class="content-wrapper" style="min-height: 946px;">
    <section class="content-header">
        <h1>
            <i class="fa fa-user-plus"></i> <?php echo $this->lang->line('student_information'); ?> <small><?php echo $this->lang->line('student1'); ?></small></h1>
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
    $arrears_advance  = floatval( $student['fee_arrears'] ) - floatval( $late_payment );
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
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#activity" data-toggle="tab" aria-expanded="true"> Due fee </a></li>
                     </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="activity">  
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
                                            
                        
                    </div>
            </div>
    </section>  


</div>
   

<script type="text/javascript">
 $(document).ready(function () {
  transaction_history(); 
   });
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
</script>

 

<script type="text/javascript">
 
    $(document).ready(function () {
        $('.example').dataTable({
            "bSort": false,
            "paging": false,

        });

    })

    $(document).ready(function () {
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