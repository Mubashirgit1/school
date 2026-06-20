<style type="text/css">
    @media print {
        .no-print, .no-print * {
            display: none !important;
        }
    }
</style>


<div class="content-wrapper" style="min-height: 946px;">
<?php  $this->load->view('layout/message_link'); ?>
    <section class="content-header">

    <div class="box box-primary" >  
      <div class="box-header with-border" style="">
                    <div class="row">
    <div class="col-sm-6 col-md-4">
    <h4>
           <?= $title ?>
        </h4>
    </div>
  </div>
        </div>
          </div>
    </section>
    
    
    <div class="col-md-12">
            <div class="col-md-4">
                <div class="box box-primary">
                    <div class="box-header with-border">
                    Create New Tempelate
                    </div>
                <form id="form1" action="<?php echo site_url( 'student/send_message_process' ) ?>" id="employeeform" name="employeeform" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                    <div class="box-body">
                            <div class="form-group">
                                <label>Title Of Message</label>
                                <input type="text" id="message_title" class="form-control" name="message_title">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Type Your Message Here</label>
<textarea name="message" id="" class="form-control" cols="30" rows="10" placeholder="Enter Message here..."  onkeyup="countChar(this)"></textarea>

                                <div id="charNum"></div>
                            </div>
                            <div class="form-group">
                                <label>Date Of Message</label>
                                <input type="text" id="message_date" class="form-control _date" name="message_date" value="<?= set_value( 'date', date( 'm/d/Y', now() ) ) ?>" readonly>
                                <span class="text-danger"><?php echo form_error( 'joining_date' ); ?></span>
                            </div>
                    </div>
                    <div class="box-footer">
                            <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line( 'save' ); ?> Template</button>
                    </div>
                </form>
                </div>
            </div>
              <div class="col-md-8">
                <div class="box box-primary" id="tachelist">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix">Templates in Store</h3>
                    </div>
                    <br><br>
                    <div class="box-body">
                        <div class="mailbox-controls">
                        </div>
                        <div class="table-responsive mailbox-messages">
                            <table class="table     table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Message ID</th>
                                        <th>Title</th>
                                        <th>Message</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php  $count = 1;
                                    foreach ( $messages as $message ) { ?>
                                        <tr>
                                            <td class="mailbox-name"> <?= $message['id'] ?></td>
                                             <td class="mailbox-name">
                                                <a href="<?php echo base_url(); ?>student/view_message/<?php echo $message['id'] ?>" >
                                                     <?= $message['title'] ?>
                                                </a>
                                              </td>
                                            <td class="mailbox-name"> <?php echo $message['message'] ?></td>
                                            <td class="mailbox-name"> <?php echo $message['date'] ?></td>
                                            <td class="mailbox-date pull-right no-print">
                                             <?php /*?>  <a href="<?php echo base_url(); ?>student/view_message/<?php echo $message['id'] ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line( 'show' ); ?>">
                                                    <i class="fa fa-reorder"></i>
                                                </a><?php */?>
                                               
                                                <a href="<?php echo base_url(); ?>student/delete_message/<?php echo $message['id'] ?>" class="btn btn-default btn-xs" data-toggle="tooltip" title="<?php echo $this->lang->line( 'delete' ); ?>" onclick="return confirm('Are you sure you want to delete this item?')" ;>
                                                    <i class="fa fa-remove"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    $count++; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
</div>
</div>

<script>
    $(document).ready(function () {
           
        $('.detail_popover').popover({
			placement: 'right',
            trigger: 'hover',
            container: 'body',
            html: true,
            content: function () {
                return $(this).closest('td').find('.fee_detail_popover').html();
            }
        });

    });
	
    function countChar(val) {
        var len = val.value.length;
        if (len >= 155) {
          val.value = val.value.substring(0, 155);
        } else {
          $('#charNum').text(155 - len);
        }
      };
	 


</script>



<script type="text/javascript">
    $( document ).ready( function () {
        var date_format = '<?php echo $result = strtr( $this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy',] ) ?>';
        $( '#dob, #admission_date' ).datepicker( {
            format: date_format,
            autoclose: true
        } );
        $( "#btnreset" ).click( function () {
            $( "#form1" )[0].reset();
        } );
    } );
</script>







<div id="scheduleModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <br>

                <h4 class="modal-title view_exam_model_title"></h4>


            </div>

            <div class="modal-body">
            
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $this->lang->line('cancel'); ?></button>
            </div>
        </div>
    </div>
</div>