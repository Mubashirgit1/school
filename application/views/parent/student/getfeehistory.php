<?php
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
?>
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
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#activity" data-toggle="tab" aria-expanded="true"> Fee History </a></li>
                     </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="activity">  
                        
                            <div class="table-responsive">
                                <table class="table  table-bordered " id="transation_history">
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
                                        <th class="text-right">Fee Due</th>
                                        <th class="text-right">Fee Paid</th>
                                        <th class="text-right">Fee Desc</th>
                                        <th class="text-right">Fee Waived</th>
                                        <th class="text-right">Balance</th>
                                        <th class="text-right">Other Paid Details</th>
                                        <th class="text-right">Other Paid</th>
                                        <th class="text-right">Other Waived Details</th>
                                        <th class="text-right">Other Waived</th>
                                        <th class="text-right">Total</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
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
            "searching": false,
            "aoColumns" : [null, null, null, null, null,null,null,null,null,null,null,null,null, { "bSearchable": true, "bVisible": false }],
            'columnDefs': [
                {
                    "targets": '_all',
                    "className": "outlined",
                }],
               
            "ajax": {
                url : "<?php echo site_url( "parent/parents/transaction_history" ) ?>",
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